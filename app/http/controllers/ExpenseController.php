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

	public function indexLocal()
	{
		if (!$this->commons->hasPermission('expenses')) {
			Not_foundController::show('403');
			exit();
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		$data['result'] = $this->expenseModel->getLocalExpenses();
		$data['suppliers'] = $this->expenseModel->getSuppliers();

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['page_title'] = 'Local Expenses';

		$this->view->render('expense/expense_list.tpl', $data);
	}

	public function indexForeignList()
	{
		if (!$this->commons->hasPermission('expenses')) {
			Not_foundController::show('403');
			exit();
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		$data['result'] = $this->expenseModel->getForeignExpenses();
		$data['suppliers'] = $this->expenseModel->getSuppliers();

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['page_title'] = 'Foreign Expenses';

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
				$this->url->redirect('expense/edit&id=' . $this->url->post('id'));
			} else {
				$this->url->redirect('expense/edit');
			}
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('expenses');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('expense');
			$data['id'] = $this->url->post('id');
			$data['VAT_full'] = isset($data['VAT_full']) ? $data['VAT_full'] : (isset($data['vat_full']) ? $data['vat_full'] : '0.00');
			$data['VAT_Exempt'] = isset($data['VAT_Exempt']) ? $data['VAT_Exempt'] : (isset($data['vat_exempt']) ? $data['vat_exempt'] : '0.00');
			$data['VAT_reduced'] = isset($data['VAT_reduced']) ? $data['VAT_reduced'] : (isset($data['vat_reduced']) ? $data['vat_reduced'] : '0.00');
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
			$data['VAT_full'] = isset($data['VAT_full']) ? $data['VAT_full'] : (isset($data['vat_full']) ? $data['vat_full'] : '0.00');
			$data['VAT_Exempt'] = isset($data['VAT_Exempt']) ? $data['VAT_Exempt'] : (isset($data['vat_exempt']) ? $data['vat_exempt'] : '0.00');
			$data['VAT_reduced'] = isset($data['VAT_reduced']) ? $data['VAT_reduced'] : (isset($data['vat_reduced']) ? $data['vat_reduced'] : '0.00');
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

	public function indexForeign()
	{
		if (!$this->commons->hasPermission('expense/edit')) {
			Not_foundController::show('403');
			exit();
		}

		$id = (int)$this->url->post('id');
		if (empty($id)) {
			header('Content-Type: application/json');
			echo json_encode(array('status' => 'error'));
			exit();
		}

		$updated = $this->expenseModel->updateForeignStatus($id, null);
		header('Content-Type: application/json');
		echo json_encode(array('status' => $updated ? 'ok' : 'error'));
		exit();
	}

	/**
	 * Expense export method
	 * This method will export expenses as CSV
	 **/
	public function indexExport()
	{
		if (!$this->commons->hasPermission('expenses')) {
			Not_foundController::show('403');
			exit();
		}

		$rows = $this->expenseModel->getExpenses();
		$filename = 'expenses_' . date('Y-m-d_His') . '.csv';

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="' . $filename . '"');

		$output = fopen('php://output', 'w');
		fputcsv($output, array(
			'Purchase Date',
			'ID',
			'Supplier',
			'Invoice Number',
			'Purchase By',
			'Purchase Amount',
			'Payment Method',
			'Currency',
			'Paid Amount',
			'Paid Date',
			'VAT Full',
			'VAT Exempt',
			'VAT Reduced',
			'Total VAT',
			'Foreign Invoice',
			'Expense Type',
			'Description'
		));

		$currency_map = array(
			'EUR' => "\xE2\x82\xAC",
			'€' => "\xE2\x82\xAC",
		);

		if (!empty($rows)) {
			foreach ($rows as $row) {
				$purchase_date = !empty($row['purchase_date']) ? date_format(date_create($row['purchase_date']), 'Y-m-d') : '';
				$paid_date = !empty($row['paid_date']) ? date_format(date_create($row['paid_date']), 'Y-m-d') : '';
				$currency = $row['abbr'] ?? '';
				if (isset($currency_map[$currency])) {
					$currency = $currency_map[$currency];
				}
				$vat_full = !empty($row['VAT_full']) ? $row['VAT_full'] : '0.00';
				$vat_exempt = !empty($row['Vat_exempt']) ? $row['Vat_exempt'] : '0.00';
				$vat_reduced = !empty($row['VAT_reduced']) ? $row['VAT_reduced'] : '0.00';
				$foreign = (isset($row['foreign']) && (int)$row['foreign'] === 1) ? 'foreign' : 'local';

				fputcsv($output, array(
					$purchase_date,
					$row['id'] ?? '',
					$row['supplier'] ?? '',
					isset($row['inv_number']) ? "'" . $row['inv_number'] . "'" : '',
					$row['payor'] ?? '',
					$row['purchase_amount'] ?? '',
					$row['payment_type_name'] ?? '',
					$currency,
					$row['paid_amount'] ?? '',
					$paid_date,
					$vat_full,
					$vat_exempt,
					$vat_reduced,
					$row['total_vat'] ?? '0.00',
					$foreign,
					$row['expense_type_name'] ?? '',
					$row['description'] ?? ''
				));
			}
		}

		fclose($output);
		exit();
	}

	/**
	 * Expense Validate method
	 * Validate input field
	 **/
	public function validateField()
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateDate(date_format(date_create($this->url->post('expense')['paiddate']), 'Y-m-d'))) {
			$error_flag = true;
			$error['error1'] = 'paid date ' . $this->url->post('expense')['paiddate'];
		}
		if ($this->commons->validateDate(date_format(date_create($this->url->post('expense')['purchasedate']), 'Y-m-d'))) {
			$error_flag = true;
			$error['error2'] = 'purchase date ' . $this->url->post('expense')['purchasedate'];
		}


		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
}

