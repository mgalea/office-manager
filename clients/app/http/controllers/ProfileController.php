<?php

/**
* Profile Controller
*/
class ProfileController extends Controller
{
	private $profileModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize appointment model*/
		$this->profileModel = new Profile();	
	}

	public function index()
	{	
		$data = $this->commons->getUser();
		
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;

		$data['action'] = URL_CLIENTS.DIR_ROUTE.'profile';
		$this->view->render('profile/profile.tpl', $data);
	}

	/**
	* Info index action method
	* This method will be called on Info submit/save view
	**/
	public function profileAction()
	{
		
		/**
		* Check if from is submitted or not 
		**/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('profile');
			exit();
		}
		/**
		* Validate form data
		* If some data is missing or data does not match pattern
		* Return to info view 
		**/
		$data = $this->url->post('profile');
		
		if ($validate_field = $this->validateField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid '.implode(", ",$validate_field).'!');
			$this->url->redirect('profile');
		}
		
		if ($this->commons->validateToken($this->url->post('_token'))){
			$this->url->redirect('profile');
		}
		
		$this->update($data);
	}

	public function indexChangePassword()
	{
		$data = $this->commons->getUser();
		
		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;		
		
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['action'] = URL_CLIENTS.DIR_ROUTE.'changePassword';
		$this->view->render('profile/change-password.tpl', $data);
	}

	public function changePasswordAction()
	{
		/**
		* Check if from is submitted or not 
		**/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('profile');
			exit();
		}
		/**
		* Validate form data
		* If some data is missing or data does not match pattern
		* Return to info view 
		**/
		$data = $this->url->post('profile');
		if ($validate_field = $this->validatePasswordField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => implode(", ",$validate_field).'!');
			$this->url->redirect('profile');
		}

		if ($this->commons->validateToken($this->url->post('_token'))){
			$this->url->redirect('profile');
		}

		$this->changePassword($data);
	}

	protected function update($data)
	{
		
		if ($this->profileModel->updateProfile($data)) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Profile updated successfully.');
			$this->url->redirect('profile');
		}
		else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Profile does not updated (Server Error).');
			$this->url->redirect('profile');
		}
	}

	protected function changePassword($data)
	{
		$data['id'] = $data['id'];
		$data['email'] = $data['email'];
		$data['old_password'] = $data['old-password'];
		$data['new_password'] = $data['new-password'];

		$password = $this->profileModel->getUserData($data);
		
		if (password_verify( $data['old_password'], $password)) {
			$data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
			$result = $this->profileModel->updatePassword($data);
			if ($result) {
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Account Password updated successfully.');
				$this->url->redirect('changepassword');
			} else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Account Password does not updated(Server Error).');
				$this->url->redirect('changepassword');
			}
		}
		else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Current Password is not correct.');
			$this->url->redirect('changepassword');
		}
		
	}

	protected function validateField($data)
	{
		$error = [];
		$error_flag = false;
		
		if ($this->commons->validateText($data['name'])) {
			$error_flag = true;
			$error['firstname'] = 'First Name';
		}

		if ($this->commons->validateEmail($data['email']) ) {
			$error_flag = true;
			$error['email'] = 'Email Address';
		}

		if ($this->commons->validatePhoneNumber($data['mobile'])) {
			$error_flag = true;
			$error['mobile'] = 'Mobile Number';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}

	protected function validatePasswordField($data)
	{
		$error = [];
		$error_flag = false;
		if (strlen($data['old-password']) < 6) {
			$error_flag = true;
			$error['username'] = 'Please enter minimum 6 letters for Old Password';
		}

		if (strlen($data['new-password']) < 6) {
			$error_flag = true;
			$error['firstname'] = 'Please enter minimum 6 letters for New Password';
		}

		if (strlen($data['confirm-password']) < 6) {
			$error_flag = true;
			$error['lastname'] = 'Please enter minimum 6 letters for Confirm Password';
		}

		if ($data['confirm-password'] != $data['new-password']) {
			$error_flag = true;
			$error['match'] = 'Confirm Password does not match with new password';
		}

		if ($error_flag) {
			return $error;
		}
		else {
			return false;
		}
	}
}