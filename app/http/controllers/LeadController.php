<?php

/**
* LeadController
*/
class LeadController extends Controller
{
	private $leadModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->leadModel = new Lead();
	}
	public function index()
	{
		if (!$this->commons->hasPermission('leads')) {
			Not_foundController::show('403');
			exit();
		}
		
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using User model 
		**/
		$data['result'] = $this->leadModel->getLeads();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_leads'];
		
		/*Render User list view*/
		$this->view->render('contact/leads_list.tpl', $data);
	}

	public function indexAdd()
	{
		if (!$this->commons->hasPermission('lead/add')) {
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
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['contact']['text_add_lead'];
		$data['action'] = URL.DIR_ROUTE.'lead/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		/*Render User list view*/
		$this->view->render('contact/lead_form.tpl', $data);
	}

	public function indexEdit()
	{
		if (!$this->commons->hasPermission('lead/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		* Check if id exist in url if not exist then redirect to Item list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('leads');
		}
		
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using User model 
		**/
		$data['result'] = $this->leadModel->getLead($id);
		if (empty($data['result'])) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Leads does not exist in database.');
			$this->url->redirect('leads');
		}

		$data['result']['address'] = json_decode($data['result']['address'], true);

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/contact.php';
		$data['lang']['contact'] = $contact;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['contact']['text_edit_lead'];
		$data['action'] = URL.DIR_ROUTE.'lead/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		/*Render User list view*/
		$this->view->render('contact/lead_form.tpl', $data);
	}

	public function indexAction()
	{
		/**
		* Check if from is submitted or not 
		**/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('leads');
			exit();
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('leads');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('contact');
			$data['id'] = $this->url->post('id');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);

			$result = $this->leadModel->updateLead($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Leads updated successfully.');
			$this->url->redirect('lead/edit&id='.$data['id']);
		}
		else {
			$data = $this->url->post('contact');
			$data['country'] = $data['address']['country'];
			$data['address'] = json_encode($data['address']);
			$result = $this->leadModel->createLead($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Leads created successfully.');
			$this->url->redirect('lead/edit&id='.$result);
		}
	}

	public function convertLead()
	{
		if (!$this->commons->hasPermission('lead/edit')) {
			Not_foundController::show('403');
			exit();
		}

		/**
		* Check if id exist in url if not exist then redirect to Item list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('leads');
		}

		if ($this->commons->validateToken($this->url->get('token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('leads');
		}

		$data['result'] = $this->leadModel->getLead($id);
		if (empty($data['result'])) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Leads does not exist in database.');
			$this->url->redirect('leads');
		}
		$address = json_decode($data['result']['address'], true);
		$address['phone1'] = '';
		$address['fax'] = '';
		$data['result']['address'] = json_encode($address);

		$result = $this->leadModel->convertLeadToContact($data['result']);

		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Contact created successfully.');
		$this->url->redirect('contact/edit&id='.$result);
	}
	/**
	* lead index Delete method
	* This method will be called on lead Delete view
	**/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('lead/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->leadModel->deleteLead($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Lead deleted successfully.');
		$this->url->redirect('leads');
	}
}