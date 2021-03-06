<?php

/**
 * CompanyController
 */
class BankController extends Controller
{
	private $bankModel;

	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();

		/*Intilize Company model*/
		$this->bankAccountModel = new Bank_Account();
	}

	/**
	 * Bank Accounts index method
	 * This method will be called on Bank Accounts list view
	 **/
	public function index()
	{
		if (!$this->commons->hasPermission('bank_accounts')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();

		/**
		 * Get all User data from DB using User model 
		 **/
		$data['accounts'] = $this->bankAccountModel->getAccounts();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/bank.php';
		$data['lang']['bank'] = $bank;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_bank_accounts'];

		/*Render Bank Accounts list view*/
		$this->view->render('bank/bank_accounts_list.tpl', $data);
	}

	/**
	 * Bank Accounts index method
	 * This method will be called on Bank Accounts Detailed view
	 **/
	public function indexView()
	{
		if (!$this->commons->hasPermission('bank_accounts/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('bank_accounts');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['accounts'] = $this->bankAccountModel->getAccounts();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['bank'] . '/bank.php';
		$data['lang']['bank'] = $bank;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['bank']['text_view_account'];
		$data['action'] = URL . DIR_ROUTE . 'contact/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('bank_account/bank_account_view.tpl', $data);
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
		$data['types'] = $this->companyModel->getCompanyTypes();
		$data['activity'] = $this->companyModel->getActivityTypes();

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
		if (!$this->commons->hasPermission('bank_account/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Item list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('bank_accounts');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->bankAccountModel->getAccount($id);
		$data['banks'] = $this->bankAccountModel->getBanks();
		$data['types'] = $this->bankAccountModel->getAccountTypes();
		$data['currencies'] = $this->bankAccountModel->getCurrencies();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/bank.php';
		$data['lang']['bank'] = $bank;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['bank']['text_account'];
		$data['action'] = URL . DIR_ROUTE . 'bank_account/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('bank/bank_account_form.tpl', $data);
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
			$data['postal_address'] = json_encode($data['postal_address']);
			$data['status'] = (!empty($this->url->post('status'))) ? $this->url->post('status') : 1;
			$data['formation_date'] = date_format(date_create($data['formation_date']), 'Y-m-d');
			$data['id'] = $this->url->post('id');
			$result = (int)$this->companyModel->updateCompany($data);

			if ($result <1) {
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Company updated successfully.');
				$this->url->redirect('company/edit&id=' . $this->url->post('id'));
				echo $result;
			} else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => $result);
				$this->url->redirect('company/edit&id=' . $this->url->post('id'));
				echo $result;
			}

		} else {
			$data = $this->url->post('company');
			$data['address'] = json_encode($data['address']);
			$data['postal_address'] = json_encode($data['postal_address']);
			$data['status'] = (!empty($this->url->post('status'))) ? $this->url->post('status') : 1;
			$data['formation_date'] = date_format(date_create($data['formation_date']), 'Y-m-d');
			$result = $this->companyModel->createCompany($data);
			if ($result != 0) {
				$this->session->data['message'] = array('alert' => 'success', 'value' => 'Company created successfully.');
				$this->url->redirect('company/edit&id=' . $result);
			} else {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Company failed to create.');
				$this->url->redirect('company/edit');
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
		if (!$this->commons->hasPermission('bank_account/delete')) {
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

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
}
