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
		$this->getPage();
	}

	protected function getPage()
	{
		/*Get User name and role*/
		$data = $this->commons->getUser();
		
		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		
		$data['result'] = $this->profileModel->getProfile($this->session->data['user_id']);
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		/*call profile view*/
		$this->view->render('profile/profile.tpl', $data);
	}
	/**
	* Info index action method
	* This method will be called on Info submit/save view
	**/
	public function indexAction()
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
		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid '.implode(", ",$validate_field).'!');
			$this->url->redirect('profile');
		}
		
		if ($this->commons->validateToken($this->url->post('_token'))){
			$this->url->redirect('profile');
		}

		$this->update();
	}

	public function indexPassword()
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
		if ($validate_field = $this->validatePasswordField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => implode(", ",$validate_field).'!');
			$this->url->redirect('profile');
		}

		if ($this->commons->validateToken($this->url->post('_token'))){
			$this->url->redirect('profile');
		}

		$this->changePassword();
	}

	protected function update()
	{
		$data = $this->url->post;
		$data['user_id'] = $this->session->data['user_id'];

		$check_user = $this->profileModel->checkUserName($this->url->post('username'), $this->url->post('email'));
		if ($check_user >= 1) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => "User Name ".$data['username']." already exist in database.");
			$this->url->redirect('profile');
		}
		
		if ($this->profileModel->updateProfile($data)) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Profile updated successfully.');
			$this->url->redirect('profile');
		} else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Profile does not updated (Server Error).');
			$this->url->redirect('profile');
		}
	}

	protected function changePassword()
	{
		$data['user_id'] = $this->url->post('id');
		$data['old_password'] = $this->url->post('old-password');
		$data['new_password'] = $this->url->post('new-password');

		$password = $this->profileModel->getUserData($data['user_id']);

		if (password_verify( $data['old_password'], $password)) {
			$data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
			$result = $this->profileModel->updatePassword($data);
			if ($result) {
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Account Password updated successfully.');
				$this->url->redirect('profile');
			} else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Account Password does not updated(Server Error).');
				$this->url->redirect('profile');
			}
		} else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Current Password is not correct.');
			$this->url->redirect('profile');
		}
		
	}

	protected function validateField()
	{
		$error = [];
		$error_flag = false;
		if ($this->commons->validateText($this->url->post('username'))) {
			$error_flag = true;
			$error['username'] = 'User name!';
		}

		if ($this->commons->validateText($this->url->post('firstname'))) {
			$error_flag = true;
			$error['firstname'] = 'First Name';
		}

		if ($this->commons->validateText($this->url->post('lastname'))) {
			$error_flag = true;
			$error['lastname'] = 'Last Name';
		}

		if ($this->commons->validateEmail($this->url->post('email')) ) {
			$error_flag = true;
			$error['email'] = 'Email Address';
		}

		if ($this->commons->validatePhoneNumber($this->url->post('mobile')) ) {
			$error_flag = true;
			$error['mobile'] = 'Mobile Number';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}

	protected function validatePasswordField()
	{
		$error = [];
		$error_flag = false;
		if (strlen($this->url->post('old-password')) < 6) {
			$error_flag = true;
			$error['username'] = 'Please enter minimum 6 letters for Old Password';
		}

		if (strlen($this->url->post('new-password')) < 6) {
			$error_flag = true;
			$error['firstname'] = 'Please enter minimum 6 letters for New Password';
		}

		if (strlen($this->url->post('confirm-password')) < 6) {
			$error_flag = true;
			$error['lastname'] = 'Please enter minimum 6 letters for Confirm Password';
		}

		if ($this->url->post('confirm-password') != $this->url->post('new-password')) {
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