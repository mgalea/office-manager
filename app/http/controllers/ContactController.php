<?php

/**
 * ContactController
 */
class ContactController extends Controller
{
	private $contactModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->contactModel = new Contact();
	}
	/**
	 * Contact index method
	 * This method will be called on Contact list view
	 **/
	public function index()
	{
		if (!$this->commons->hasPermission('contacts')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->contactModel->getContacts();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_contacts'];

		/*Render User list view*/
		$this->view->render('contact/contact_list.tpl', $data);
	}

	public function indexView()
	{
		if (!$this->commons->hasPermission('contact/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('contacts');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->contactModel->getContact($id);
		$data['client'] = $this->contactModel->getClient($data['result']['email']);
		$data['invoices'] = $this->contactModel->getInvoices($id);
		$data['quotes'] = $this->contactModel->getQuotes($id);
		$data['types'] = $this->contactModel->getContactType();
		$data['documents'] = $this->contactModel->getDocuments($id);
		
		$data['result']['address'] = json_decode($data['result']['address'], true);
		$data['result']['persons'] = json_decode($data['result']['persons'], true);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['contact']['text_view_contact'];
		$data['action'] = URL . DIR_ROUTE . 'contact/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('contact/contact_view.tpl', $data);
	}
	/**
	 * Contact index ADD method
	 * This method will be called on ADD page
	 **/
	public function indexAdd()
	{
		if (!$this->commons->hasPermission('contact/add')) {
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
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_contact'];
		$data['action'] = URL . DIR_ROUTE . 'contact/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('contact/contact_form.tpl', $data);
	}
	/**
	 * Contact index Edit method
	 * This method will be called on Contact Edit view
	 **/
	public function indexEdit()
	{
		if (!$this->commons->hasPermission('contact/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('contacts');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->contactModel->getContact($id);
		$data['client'] = $this->contactModel->getClient($data['result']['email']);
		$data['invoices'] = $this->contactModel->getInvoices($id);
		$data['quotes'] = $this->contactModel->getQuotes($id);
		$data['types'] = $this->contactModel->getContactType($id);
		$data['documents'] = $this->contactModel->getDocuments($id);

		$data['result']['address'] = json_decode($data['result']['address'], true);
		$data['result']['persons'] = json_decode($data['result']['persons'], true);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_contact'];
		$data['action'] = URL . DIR_ROUTE . 'contact/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('contact/contact_form.tpl', $data);
	}
	/**
	 * Contact index method
	 * This method will be called on Contact ADD or Update view
	 **/
	public function indexAction()
	{
		if ((!$this->commons->hasPermission('contact/edit')) && (!$this->commons->hasPermission('contact/add'))) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if from is submitted or not 
		 **/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('contacts');
			exit();
		}
		/**
		 * Validate form data
		 * If some data is missing or data does not match pattern
		 * Return to info view 
		 **/
		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('contacts');
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('contacts');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('contact');
			$data['client'] = $this->url->post('client');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);
			$data['person'] = json_encode($data['person']);
			$data['contact_type'] = $this->url->post('contact_type');
			$data['id'] = $this->url->post('id');
			$result = $this->contactModel->updateContact($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact updated successfully.');
			$this->url->redirect('contact/edit&id=' . $this->url->post('id'));
		} else {
			$data = $this->url->post('contact');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);
			$data['person'] = json_encode($data['person']);
			$data['contact_type'] = (!empty($this->url->post('id'))) ? $this->url->post('contact_type') : 1;
			$result = $this->contactModel->createContact($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact created successfully.');
			$this->url->redirect('contact/edit&id=' . $result);
		}
	}
	/**
	 * Contact index Delete method
	 * This method will be called on Contact Delete view
	 **/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('contact/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->contactModel->deleteContact($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact deleted successfully.');
		$this->url->redirect('contacts');
	}

	public function indexMail()
	{
		if (!$this->commons->hasPermission('contact/view')) {
			Not_foundController::show('403');
			exit();
		}
		$data = $this->url->post('mail');

		if ($validate_field = $this->vaildateMailField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('contact/view&id=' . $data['contact']);
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('contact/view&id=' . $data['contact']);
		}

		$info = $this->contactModel->getOrganization();

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
		$data['type'] = "contact";
		$data['type_id'] = $data['contact'];
		$data['user_id'] = $this->session->data['user_id'];

		$this->contactModel->emailLog($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Sent successfully.');
		$this->url->redirect('contact/view&id=' . $data['contact']);
	}
	/**
	 * Validate Field Method
	 * This method will be called on to validate invoice field
	 **/
	private function vaildateMailField($data)
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
	 * Contact validate field method
	 * This method will be called for validate input field
	 **/
	public function validateField()
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateText($this->url->post('contact')['company'])) {
			$error_flag = true;
			$error['author'] = 'Item Rate!';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
	/**
	 * Contact index Client method
	 * This method will be called on Client list view
	 **/
	public function indexClients()
	{
		if (!$this->commons->hasPermission('clients')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->contactModel->getClients();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_clients'];

		/*Render User list view*/
		$this->view->render('contact/client_list.tpl', $data);
	}
	/**
	 * Contact index CLient Edit method
	 * This method will be called on Client Edit view
	 **/
	public function indexClientEdit()
	{
		if (!$this->commons->hasPermission('client/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Client list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('clients');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all Client data from DB using Client model 
		 **/
		$data['result'] = $this->contactModel->getClientByID($id);

		if (empty($data['result'])) {
			$this->url->redirect('clients');
		}

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_client'];
		$data['action'] = URL . DIR_ROUTE . 'client/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('contact/client_form.tpl', $data);
	}
	/**
	 * Contact index Client Action method
	 * This method will be called on Client Action view
	 **/
	public function indexClientAction()
	{
		if ((!$this->commons->hasPermission('client/edit'))) {
			Not_foundController::show('403');
			exit();
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('contacts');
		}

		$data = $this->url->post('client');
		$result = $this->contactModel->updateClient($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Client updated successfully.');
		$this->url->redirect('client/edit&id=' . $data['id']);
	}
	/**
	 * Contact index Client Delete method
	 * This method will be called on Client Delete view
	 **/
	public function indexClientDelete()
	{
		if (!$this->commons->hasPermission('client/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->contactModel->deleteClient($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Client deleted successfully.');
		$this->url->redirect('clients');
	}
}
