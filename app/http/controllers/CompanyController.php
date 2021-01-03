<?php

/**
 * CompanyController
 */
class CompanyController extends Controller
{
	private $companyModel;

	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();

		/*Intilize Company model*/
		$this->companyModel = new Company();
	}
	/**
	 * Company index method
	 * This method will be called on Company list view
	 **/
	public function index()
	{
		if (!$this->commons->hasPermission('companies')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();

		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->companyModel->getCompanies();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/company.php';
		$data['lang']['company'] = $company;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_companies'];

		/*Render User list view*/
		$this->view->render('company/company_list.tpl', $data);
	}

	public function indexView()
	{
		if (!$this->commons->hasPermission('company/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('companies');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->companyModel->getCompany($id);
		$data['result']['address'] = json_decode($data['result']['address'], true);
		$data['documents'] = $this->companyModel->getDocuments($id);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/company.php';
		$data['lang']['company'] = $company;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['company']['text_edit_company'];
		$data['action'] = URL . DIR_ROUTE . 'company/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('company/company_view.tpl', $data);
	}
	/**
	 * Company index ADD method
	 * This method will be called on ADD page
	 **/
	public function indexAdd()
	{
		if (!$this->commons->hasPermission('company/add')) {
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
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/company.php';
		$data['lang']['company'] = $company;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_add'] . ' ' . $data['lang']['company']['text_company'];
		$data['action'] = URL . DIR_ROUTE . 'company/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('company/company_form.tpl', $data);
	}
	/**
	 * Company index Edit method
	 * This method will be called on Company Edit view
	 **/
	public function indexEdit()
	{
		if (!$this->commons->hasPermission('company/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('company');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->companyModel->getCompany($id);
		$data['documents'] = $this->companyModel->getDocuments($id);

		$data['result']['address'] = json_decode($data['result']['address'], true);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/company.php';
		$data['lang']['company'] = $company;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['company']['text_company'];
		$data['action'] = URL . DIR_ROUTE . 'company/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('company/company_form.tpl', $data);
	}
	/**
	 * Company index method
	 * This method will be called on Company Add or Update view
	 **/
	public function indexAction()
	{
		if ((!$this->commons->hasPermission('company/edit')) && (!$this->commons->hasPermission('company/add'))) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if from is submitted or not 
		 **/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('companies');
			exit();
		}
		/**
		 * Validate form data
		 * If some data is missing or data does not match pattern
		 * Return to info view 
		 **/
		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter a valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('companies');
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('companies');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('company');
			$data['address'] = json_encode($data['address']);
			$data['status'] = (!empty($this->url->post('status'))) ? $this->url->post('status') : 1;
			$data['date_formed'] = date_format(date_create($data['date_formed']), 'Y-m-d');
			$data['id'] = $this->url->post('id');
			$result = $this->companyModel->updateCompany($data);
			if ($result) {
                $this->session->data['message'] = array('alert' => 'success', 'value' => 'Inventory item created successfully.');
				$this->url->redirect('company/edit&id=' . $result);
				echo $result;
            } else {
                $this->session->data['message'] = array('alert' => 'error', 'value' => 'Company failed to update.');
				$this->url->redirect('company/edit&id='.$this->url->post('id'));
				echo $result;
            }
		
		} else {
			$data = $this->url->post('company');
			$data['address'] = json_encode($data['address']);
			$data['status'] = (!empty($this->url->post('status'))) ? $this->url->post('status') : 1;
			$data['date_formed'] = date_format(date_create($data['date_formed']), 'Y-m-d');
			$result = $this->companyModel->createCompany($data);
			if ($result) {
                $this->session->data['message'] = array('alert' => 'success', 'value' => 'Company created successfully.');
				$this->url->redirect('company/edit&id=' . $result);
				echo $result;
            } else {
                $this->session->data['message'] = array('alert' => 'error', 'value' => 'Company failed to create.');
				$this->url->redirect('company/edit&id=' . $result);
				echo $result;
            }
		}
	}
	/**
	 * Company index Delete method
	 * This method will be called on Company Delete view
	 **/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('company/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->companyModel->deleteCompany($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Company deleted successfully.');
		$this->url->redirect('companies');
	}

	/**
	 * Company validate field method
	 * This method will be called for validate input field
	 **/
	public function validateField()
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateText($this->url->post('company')['name'])) {
			$error_flag = true;
			$error['title1'] = 'company name';
		}
		
		if ($this->commons->validateText($this->url->post('company')['reg_no'])) {
			$error_flag = true;
			$error['title2'] = 'registration number';
		}
		if ($this->commons->validateText($this->url->post('company')['vat_no'])) {
			$error_flag = true;
			$error['title3'] = 'vat number';
		}
		if ($this->commons->validateText($this->url->post('company')['address']['address1'])) {
			$error_flag = true;
			$error['title4'] = 'company address';
		}

		if ($this->commons->validateDate($this->url->post('company')['date_formed'])) {
			$error_flag = true;
			$error['title5'] = 'date of formation: '. $this->url->post('purchase_date');
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
	
}