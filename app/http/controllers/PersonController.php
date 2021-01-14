<?php

/**
 * PersonController
 */
class PersonController extends Controller
{
	private $personModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Initialize User model*/
		$this->personModel = new Person();
	}
	/**
	 * Person index method
	 * This method will be called on Person list view
	 **/
	public function index()
	{
		if (!$this->commons->hasPermission('persons')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->personModel->getPersons();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/person.php';
		$data['lang']['person'] = $person;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_contacts'];

		/*Render User list view*/
		$this->view->render('person/person_list.tpl', $data);
	}

	public function indexView()
	{
		if (!$this->commons->hasPermission('person/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('persons');
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->personModel->getPerson($id);
		$data['documents'] = $this->personModel->getDocuments($id);		
		$data['result']['address'] = json_decode($data['result']['address'], true);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/person.php';
		$data['lang']['person'] = $person;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['person']['text_view_contact'];
		$data['action'] = URL . DIR_ROUTE . 'person/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('person/person_view.tpl', $data);
	}
	/**
	 * Person index ADD method
	 * This method will be called on ADD page
	 **/
	public function indexAdd()
	{
		if (!$this->commons->hasPermission('person/add')) {
			Not_foundController::show('403');
			exit();
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = NULL;

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/person.php';
		$data['lang']['person'] = $person;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_contact'];
		$data['action'] = URL . DIR_ROUTE . 'person/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['companies'] = $this->personModel->getCompanies();

		/*Render User list view*/
		$this->view->render('person/person_form.tpl', $data);
	}
	/**
	 * Person index Edit method
	 * This method will be called on Person Edit view
	 **/
	public function indexEdit()
	{
		if (!$this->commons->hasPermission('person/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('persons');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->personModel->getPerson($id);
		$data['documents'] = $this->personModel->getDocuments($id);
		$data['companies'] = $this->personModel->getCompanies();
		$data['result']['address'] = json_decode($data['result']['address'], true);
		$data['result']['persons'] = json_decode($data['result']['persons'], true);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/person.php';
		$data['lang']['person'] = $person;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_contact'];
		$data['action'] = URL . DIR_ROUTE . 'person/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('person/person_form.tpl', $data);
	}
	/**
	 * Person index method
	 * This method will be called on Person ADD or Update view
	 **/
	public function indexAction()
	{
		if ((!$this->commons->hasPermission('person/edit')) && (!$this->commons->hasPermission('person/add'))) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if from is submitted or not 
		 **/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('persons');
			exit();
		}
		/**
		 * Validate form data
		 * If some data is missing or data does not match pattern
		 * Return to info view 
		 **/
		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('persons');
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('persons');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('person');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);
			$data['persons'] = json_encode($data['persons']);
			$data['id'] = $this->url->post('id');
			$result = $this->personModel->updatePerson($data);
			if($result){
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact Person updated successfully.');
			}else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Contact Person failed to update.');
			}
			$this->url->redirect('person/edit&id=' . $this->url->post('id'));

		} else {
			$data = $this->url->post('person');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);
			$data['persons'] = json_encode($data['persons']);
			$result = $this->personModel->createPerson($data);
			if ($result>0) {
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact Person created successfully.');
				$this->url->redirect('person/edit&id=' . $result);
			} else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Contact Person failed to create.');
				$this->url->redirect('person/edit');
			}

			
		}
	}
	/**
	 * Person index Delete method
	 * This method will be called on Person Delete view
	 **/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('person/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->personModel->deletePerson($this->url->post('id'));
		
		if ($result) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact Person deleted successfully.');
			$this->url->redirect('persons');
		} else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Contact Person failed to delete.');
			$this->url->redirect('person/edit&id=' . $this->url->post('id'));
		}

		
	}

	public function indexMail()
	{
		if (!$this->commons->hasPermission('person/view')) {
			Not_foundController::show('403');
			exit();
		}
		$data = $this->url->post('mail');

		if ($validate_field = $this->validateMailField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('person/view&id=' . $data['person']);
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('person/view&id=' . $data['person']);
		}

		$info = $this->personModel->getOrganization();

		$mailer = new Mailer();
		$useornot = $mailer->getData();
		if (!$useornot) {
			$mailer->mail->setFrom($info['email'], $info['name']);
		}

		$mailer->mail->addAddress($data['to'], $data['name']);
		if (!empty($data['bcc'])) {
			$mailer->mail->addBCC($data['bcc'], $data['bcc']);
		}

		$mailer->mail->isHTML(true);
		$mailer->mail->Subject = $data['subject'];
		$mailer->mail->Body = html_entity_decode($data['message']);

		$mailer->sendMail();
		$data['type'] = "person";
		$data['type_id'] = $data['person'];
		$data['user_id'] = $this->session->data['user_id'];

		$this->personModel->emailLog($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Sent successfully.');
		$this->url->redirect('person/view&id=' . $data['person']);
	}
	/**
	 * Validate Field Method
	 * This method will be called on to validate invoice field
	 **/
	private function validateMailField($data)
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateText($data['to'])) {
			$error_flag = true;
			$error['to'] = 'Email!';
		}

		if ($this->commons->validateText($data['subject'])) {
			$error_flag = true;
			$error['subject'] = 'Subject!';
		}

		if ($this->commons->validateText($data['message'])) {
			$error_flag = true;
			$error['message'] = 'Message!';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
	/**
	 * Person validate field method
	 * This method will be called for validate input field
	 **/
	public function validateField()
	{
		$error = [];
		$error_flag = false;
		$data = $this->url->post('person');
		if ($this->commons->validateText($data['firstname'])) {
			$error_flag = true;
			$error['author'] = "Name";
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
}