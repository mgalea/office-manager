<?php

/**
 * ExpenseController
 */
class ExpenseController extends Controller
{
	private $expenseModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->expenseModel = new Expense();
	}

	/**
	 * Expense index method
	 * This method will be called on Expense list view
	 **/
	public function index()
	{

		if (!$this->commons->hasPermission('expenses')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		/**
		 * Get all Expenses data from DB using User model 
		 **/
		$data['result'] = $this->expenseModel->getExpenses();
		$data['suppliers'] = $this->expenseModel->getSuppliers();

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_expenses'];

		/*Render User list view*/
		$this->view->render('expense/expense_list.tpl', $data);
	}
	/**
	 * Expense index ADD method
	 * This method will be called on Expense ADD view
	 **/
	public function indexAdd()
	{

		if (!$this->commons->hasPermission('expense/add')) {
			Not_foundController::show('403');
			exit();
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = NULL;
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['currency'] = $this->expenseModel->getCurrency();
		$data['expensetype'] = $this->expenseModel->expensesType();
		$data['paymenttype'] = $this->expenseModel->paymentType();
		$data['suppliers'] = $this->expenseModel->getSuppliers();
		$data['clients'] = $this->expenseModel->getClients();
		$data['subsidiaries'] = $this->expenseModel->getSubsidiaries();

		/* Set page title */
		$data['page_title'] = $data['lang']['expenses']['text_add_expense'];
		$data['action'] = URL . DIR_ROUTE . 'expense/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('expense/expense_form.tpl', $data);
	}
	/**
	 * Expense index Edit method
	 * This method will be called on Expense Edit view
	 **/
	public function indexEdit()
	{

		if (!$this->commons->hasPermission('expense/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Expenses list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('expenses');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->expenseModel->getExpense($id);
		if (empty($data['result'])) {
			$this->url->redirect('expenses');
		}
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['currency'] = $this->expenseModel->getCurrency();
		$data['expensetype'] = $this->expenseModel->expensesType();
		$data['paymenttype'] = $this->expenseModel->paymentType();
		$data['receipt'] = $this->expenseModel->getReceipt($id);
		$data['suppliers'] = $this->expenseModel->getSuppliers();
		$data['clients'] = $this->expenseModel->getClients();
		$data['subsidiaries'] = $this->expenseModel->getSubsidiaries();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		/* Set page title */
		$data['page_title'] = $data['lang']['expenses']['text_edit_expense'];
		$data['action'] = URL . DIR_ROUTE . 'expense/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('expense/expense_form.tpl', $data);
	}
	/**
	 * Expense index Action method
	 * This method will be called on Expense Save or Update view
	 **/
	public function indexAction()
	{
		/**
		 * Check if from is submitted or not 
		 **/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('expenses');
			exit();
		}
		/**
		 * Validate form data
		 * If some data is missing or data does not match pattern
		 * Return to info view 
		 **/

		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			if (!empty($this->url->post('id'))) {
			$this->url->redirect('expense/edit&id='.$this->url->post('id'));}
			else{
				$this->url->redirect('expense/edit');
			}
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('expenses');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('expense');
			$data['id'] = $this->url->post('id');
			if (!empty($data['purchasedate'])) {
				$data['purchasedate'] = date_format(date_create($data['purchasedate']), 'Y-m-d');
			} else {
				$data['purchasedate'] = NULL;
			}
			if (!empty($data['paiddate'])) {
				$data['paiddate'] = date_format(date_create($data['paiddate']), 'Y-m-d');
			} else {
				$data['paiddate'] = NULL;
			}
			$result = $this->expenseModel->updateExpense($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Expense created successfully.');
			$this->url->redirect('expense/edit&id=' . $data['id']);
		} else {
			$data = $this->url->post('expense');
			$data['purchasedate'] = date_format(date_create($data['purchasedate']), 'Y-m-d');
			$data['paiddate'] = date_format(date_create($data['paiddate']), 'Y-m-d');

			$result = $this->expenseModel->createExpense($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Expense created successfully.');
			$this->url->redirect('expense/edit&id=' . $result);
		}
	}
	/**
	 * Expense index Delete method
	 * This method will be called on Expense Delete view
	 **/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('expense/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->expenseModel->deleteExpense($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Expense deleted successfully.');
		$this->url->redirect('expenses');
	}

	/**
	 * Expense Validate method
	 * Validate input field
	 **/
	public function validateField()
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateDate(date_format(date_create($this->url->post('expense')['paiddate']), 'Y-m-d') )) {
			$error_flag = true;
			$error['error1'] = 'paid date '. $this->url->post('expense')['paiddate'];
		}
		if ($this->commons->validateDate(date_format(date_create($this->url->post('expense')['purchasedate']), 'Y-m-d'))) {
			$error_flag = true;
			$error['error2'] = 'purchase date '. $this->url->post('expense')['purchasedate'];
		}


		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
}
