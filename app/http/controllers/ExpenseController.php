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
		$data['show_eu_zone_column'] = true;
		$data['list_scope'] = 'all';
		$data['server_side'] = true;

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
		$data['show_eu_zone_column'] = false;
		$data['list_scope'] = 'local';
		$data['server_side'] = true;

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['page_title'] = 'Local Purchases';

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
		$data['show_eu_zone_column'] = true;
		$data['list_scope'] = 'foreign';
		$data['server_side'] = true;
		$data['eu_zone_only'] = true;

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		$data['page_title'] = 'Foreign Purchases';

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
		$companyModel = new Company();
		$data['company_types'] = $companyModel->getCompanyTypes();
		$data['default_company_type_id'] = $this->getDefaultSupplierTypeId($companyModel, $data['company_types']);

		/* Set page title */
		$data['page_title'] = $data['lang']['expenses']['text_add_expense'];
		$data['action'] = DIR_ROUTE . 'expense/action';
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
		$companyModel = new Company();
		$data['company_types'] = $companyModel->getCompanyTypes();
		$data['default_company_type_id'] = $this->getDefaultSupplierTypeId($companyModel, $data['company_types']);

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/expenses.php';
		$data['lang']['expenses'] = $expenses;

		/* Set page title */
		$data['page_title'] = $data['lang']['expenses']['text_edit_expense'];
		$data['action'] = DIR_ROUTE . 'expense/action';
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
			$data['VAT_Full'] = $data['VAT_full'] ?? '0.00';
			$data['VAT_Exempt'] = $data['VAT_Exempt'] ?? '0.00';
			$data['VAT_NT'] = $data['VAT_NT'] ?? '0.00';
			$data['VAT_Reduced'] = $data['VAT_reduced'] ?? '0.00';
			$data['VAT_T8'] = $data['VAT_T8'] ?? '0.00';
			$data['VAT_T9'] = $data['VAT_T9'] ?? '0.00';
			$data['eu_zone'] = !empty($data['eu_zone']) ? 1 : 0;
			if ($data['eu_zone']) {
				$data['foreign'] = 1;
			}
			if (empty($data['purchaseby'])) {
				$companyModel = new Company();
				$defaultPayorId = $companyModel->getCompanyIdByName('Random Consulting Limited');
				if ($defaultPayorId > 0) {
					$data['purchaseby'] = $defaultPayorId;
				}
			}
			$data['supplier_id'] = isset($data['supplier_id']) ? (int)$data['supplier_id'] : 0;
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
			$data['VAT_Full'] = $data['VAT_full'] ?? '0.00';
			$data['VAT_Exempt'] = $data['VAT_Exempt'] ?? '0.00';
			$data['VAT_NT'] = $data['VAT_NT'] ?? '0.00';
			$data['VAT_Reduced'] = $data['VAT_reduced'] ?? '0.00';
			$data['VAT_T8'] = $data['VAT_T8'] ?? '0.00';
			$data['VAT_T9'] = $data['VAT_T9'] ?? '0.00';
			$data['eu_zone'] = !empty($data['eu_zone']) ? 1 : 0;
			if ($data['eu_zone']) {
				$data['foreign'] = 1;
			}
			if (empty($data['purchaseby'])) {
				$companyModel = new Company();
				$defaultPayorId = $companyModel->getCompanyIdByName('Random Consulting Limited');
				if ($defaultPayorId > 0) {
					$data['purchaseby'] = $defaultPayorId;
				}
			}
			$data['supplier_id'] = isset($data['supplier_id']) ? (int)$data['supplier_id'] : 0;
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

	public function indexEuZone()
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

		$updated = $this->expenseModel->updateEuZoneStatus($id);
		header('Content-Type: application/json');
		echo json_encode(array('status' => $updated ? 'ok' : 'error'));
		exit();
	}

	public function indexListData()
	{
		if (!$this->commons->hasPermission('expenses')) {
			Not_foundController::show('403');
			exit();
		}

		$user = $this->commons->getUser();
		require DIR_BUILDER . 'language/' . $user['info']['language'] . '/common.php';

		$scope = $this->url->post('scope');
		if (!$scope) {
			$scope = 'all';
		}
		$show_eu_zone_column = (int)$this->url->post('show_eu_zone_column') === 1;

		$draw = (int)($this->url->post('draw') ?? 0);
		$start = (int)($this->url->post('start') ?? 0);
		$length = (int)($this->url->post('length') ?? 25);
		$search = '';
		$search_value = $this->url->post('search');
		if (is_array($search_value) && isset($search_value['value'])) {
			$search = (string)$search_value['value'];
		}
		$order = $this->url->post('order');
		$order_column = 4;
		$order_dir = 'desc';
		if (is_array($order) && isset($order[0]['column'])) {
			$order_column = (int)$order[0]['column'];
			$order_dir = isset($order[0]['dir']) && strtolower($order[0]['dir']) === 'asc' ? 'asc' : 'desc';
		}

		$result = $this->expenseModel->getExpensesDataTable(array(
			'start' => $start,
			'length' => $length,
			'search' => $search,
			'order_column' => $order_column,
			'order_dir' => $order_dir,
			'show_eu_zone_column' => $show_eu_zone_column,
		), $scope);

		$data = array();
		if (!empty($result['rows'])) {
			foreach ($result['rows'] as $index => $row) {
				$purchase_amount = (int)($row['purchase_amount'] ?? 0);
				$amount_paid = $purchase_amount > 0 ? (int)($row['paid_amount'] ?? 0) / $purchase_amount : 0;
				if ($amount_paid == 0) {
					$status_badge = '<span class="badge badge-pill badge-pinterest badge-min-size small">unpaid</span>';
				} elseif ($amount_paid == 1) {
					$status_badge = '<span class="badge badge-pill badge-success badge-min-size small">paid</span>';
				} elseif ($amount_paid > 0 && $amount_paid < 1) {
					$status_badge = '<span class="badge badge-pill badge-warning badge-min-size small">partial</span>';
				} else {
					$status_badge = '<span class="badge badge-pill badge-primary badge-min-size small">overpaid</span>';
				}

				$foreign = !empty($row['foreign']) ? 1 : 0;
				$foreign_label = $foreign ? 'Foreign' : 'Local';
				$foreign_class = $foreign ? 'badge-warning' : 'badge-success';
				$foreign_badge = '<span class="badge badge-pill ' . $foreign_class . ' expense-foreign-toggle" data-id="' . (int)$row['id'] . '" data-foreign="' . $foreign . '">' . $foreign_label . '</span>';

				$eu_zone_badge = '';
				if ($show_eu_zone_column) {
					$eu_zone = !empty($row['eu_zone']) ? 1 : 0;
					$eu_zone_label = $eu_zone ? 'EU Zone' : 'Non-EU';
					$eu_zone_class = $eu_zone ? 'badge-success' : 'badge-warning';
					$eu_zone_badge = '<span class="badge badge-pill eu-zone-toggle ' . $eu_zone_class . ' expense-eu-zone-toggle" data-id="' . (int)$row['id'] . '" data-eu-zone="' . $eu_zone . '">' . $eu_zone_label . '</span>';
				}

				$purchase_date = !empty($row['purchase_date']) ? date_format(date_create($row['purchase_date']), 'Y-m-d') : '';
				$abbr = $row['abbr'] ?? '';
				$purchase_amount_display = $abbr . ' ' . ltrim((string)($row['purchase_amount'] ?? '0'), '0');
				$total_vat_display = $abbr . ' ' . ltrim((string)($row['total_vat'] ?? '0'), '0');
				$invoice_number = $row['inv_number'] ?? '';
				$supplier = $row['supplier'] ?? '';
				$payor = $row['payor'] ?? '';

				$actions = '<a target="_blank" href="' . URL . DIR_ROUTE . 'expense/edit&id=' . (int)$row['id'] . '" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="' . $lang['text_edit'] . '"><i class="icon-pencil"></i></a>'
					. '<span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" data-placement="top" title="' . $lang['text_delete'] . '"><i class="icon-trash"></i><input type="hidden" value="' . (int)$row['id'] . '"></span>';

				$row_data = array(
					($start + $index + 1),
					$status_badge,
					$supplier,
					$invoice_number,
					$purchase_date,
					$payor,
					$purchase_amount_display,
					$total_vat_display,
					$foreign_badge,
				);
				if ($show_eu_zone_column) {
					$row_data[] = $eu_zone_badge;
				}
				$row_data[] = $actions;

				$data[] = $row_data;
			}
		}

		header('Content-Type: application/json');
		echo json_encode(array(
			'draw' => $draw,
			'recordsTotal' => $result['records_total'] ?? 0,
			'recordsFiltered' => $result['records_filtered'] ?? 0,
			'data' => $data,
		));
		exit();
	}

	public function indexCreatePayee()
	{
		if (!$this->commons->hasPermission('company/add')) {
			Not_foundController::show('403');
			exit();
		}

		$name = trim((string)$this->url->post('name'));
		$type_id = (int)$this->url->post('type');
		if ($this->commons->validateToken($this->url->post('_token'))) {
			header('Content-Type: application/json');
			echo json_encode(array('status' => 'error', 'message' => 'Invalid token.'));
			exit();
		}
		if ($this->commons->validateText($name)) {
			header('Content-Type: application/json');
			echo json_encode(array('status' => 'error', 'message' => 'Payee name is required.'));
			exit();
		}

		$companyModel = new Company();
		if ($type_id <= 0) {
			$company_types = $companyModel->getCompanyTypes();
			$type_id = $this->getDefaultSupplierTypeId($companyModel, $company_types);
		}
		$data = array(
			'name' => $name,
			'short_name' => $name,
			'reg_no' => '',
			'address' => json_encode(array()),
			'postal_address' => json_encode(array()),
			'vat_no' => '',
			'formation_date' => date('Y-m-d'),
			'description' => '',
			'status' => 1,
			'type' => $type_id,
			'activity' => '',
			'phone' => '',
			'email' => '',
			'website' => ''
		);

		$id = $companyModel->createCompany($data);
		header('Content-Type: application/json');
		if (!empty($id)) {
			echo json_encode(array('status' => 'ok', 'id' => $id, 'name' => $name));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Could not create payee.'));
		}
		exit();
	}

	private function getDefaultSupplierTypeId($companyModel, $companyTypes)
	{
		if (is_array($companyTypes)) {
			foreach ($companyTypes as $type) {
				if (!empty($type['name']) && stripos($type['name'], 'supplier') !== false) {
					return (int)$type['id'];
				}
			}
		}
		$last_id = (int)$companyModel->getLastCompanyTypeId();
		return $last_id > 0 ? $last_id : 1;
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
			'VAT Non Taxable',
			'VAT Reduced',
			'Standard EC Supply',
			'VAT Out of Scope',
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
				$vat_full = !empty($row['VAT_Full']) ? $row['VAT_Full'] : '0.00';
				$vat_exempt = !empty($row['VAT_Exempt']) ? $row['VAT_Exempt'] : '0.00';
				$vat_non_taxable = !empty($row['VAT_NT']) ? $row['VAT_NT'] : '0.00';
				$vat_reduced = !empty($row['VAT_Reduced']) ? $row['VAT_Reduced'] : '0.00';
				$vat_t8 = !empty($row['VAT_T8']) ? $row['VAT_T8'] : '0.00';
				$vat_out_of_scope = !empty($row['VAT_T9']) ? $row['VAT_T9'] : '0.00';
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
					$vat_non_taxable,
					$vat_reduced,
					$vat_t8,
					$vat_out_of_scope,
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
		$expense = $this->url->post('expense');

		if (!isset($expense['supplier_id']) || (int)$expense['supplier_id'] <= 0) {
			$error_flag = true;
			$error[] = 'payee';
		}
		if (empty($expense['inv_number'])) {
			$error_flag = true;
			$error[] = 'invoice number';
		}
		if (!isset($expense['amount']) || !is_numeric($expense['amount']) || (float)$expense['amount'] <= 0) {
			$error_flag = true;
			$error[] = 'purchase amount';
		}
		if (!isset($expense['paymenttype']) || (int)$expense['paymenttype'] <= 0) {
			$error_flag = true;
			$error[] = 'payment method';
		}
		if (empty($expense['purchasedate'])) {
			$error_flag = true;
			$error[] = 'purchase date';
		} else {
			$purchase_date = date_format(date_create($expense['purchasedate']), 'Y-m-d');
			if ($this->commons->validateDate($purchase_date)) {
				$error_flag = true;
				$error[] = 'purchase date ' . $expense['purchasedate'];
			}
		}
		if (!empty($expense['paiddate'])) {
			$paid_date = date_format(date_create($expense['paiddate']), 'Y-m-d');
			if ($this->commons->validateDate($paid_date)) {
				$error_flag = true;
				$error[] = 'paid date ' . $expense['paiddate'];
			}
		}

		if ($error_flag) {
			return $error;
		}
		return false;
	}
}

