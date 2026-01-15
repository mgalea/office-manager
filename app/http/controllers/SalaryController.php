<?php

/**
 * SalaryController
 */
class SalaryController extends Controller
{
	private $salaryModel;

	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		$this->salaryModel = new Salary();
	}

	public function index()
	{
		if (!$this->commons->hasPermission('salaries')) {
			Not_foundController::show('403');
			exit();
		}

		$data = $this->commons->getUser();
		$data['result'] = $this->salaryModel->getSalaries();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		$data['page_title'] = 'Salaries';

		$this->view->render('salary/salary_list.tpl', $data);
	}

	public function indexView()
	{
		if (!$this->commons->hasPermission('salary/view')) {
			Not_foundController::show('403');
			exit();
		}

		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('salaries');
		}

		$salary = $this->salaryModel->getSalary($id);
		if (!$salary) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Salary does not exist in database!');
			$this->url->redirect('salaries');
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = $salary;
		$data['page_title'] = 'Salary View';

		$this->view->render('salary/salary_view.tpl', $data);
	}

	public function indexAdd()
	{
		if (!$this->commons->hasPermission('salary/add')) {
			Not_foundController::show('403');
			exit();
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = NULL;
		$data['page_title'] = 'Add Salary';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['action'] = URL . DIR_ROUTE . 'salary/action';

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		$this->view->render('salary/salary_form.tpl', $data);
	}

	public function indexEdit()
	{
		if (!$this->commons->hasPermission('salary/edit')) {
			Not_foundController::show('403');
			exit();
		}

		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('salaries');
		}

		$salary = $this->salaryModel->getSalary($id);
		if (!$salary) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Salary does not exist in database!');
			$this->url->redirect('salaries');
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = $salary;
		$data['page_title'] = 'Edit Salary';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['action'] = URL . DIR_ROUTE . 'salary/action';

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		$this->view->render('salary/salary_form.tpl', $data);
	}

	public function indexAction()
	{
		if (!isset($_POST['submit'])) {
			$this->url->redirect('salaries');
			exit();
		}

		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter/select valid ' . implode(", ", $validate_field) . '!');
			if (!empty($this->url->post('id'))) {
				$this->url->redirect('salary/edit&id=' . $this->url->post('id'));
			} else {
				$this->url->redirect('salary/add');
			}
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			if (!empty($this->url->post('id'))) {
				$this->url->redirect('salary/edit&id=' . $this->url->post('id'));
			} else {
				$this->url->redirect('salary/add');
			}
		}

		if (!empty($this->url->post('id'))) {
			$this->update();
		} else {
			$this->create();
		}
	}

	public function indexDelete()
	{
		if (!$this->commons->hasPermission('salary/delete')) {
			Not_foundController::show('403');
			exit();
		}

		if (!isset($_POST['delete']) || empty($this->url->post('id'))) {
			$this->url->redirect('salaries');
			exit();
		}

		$this->delete();
	}

	protected function update()
	{
		$data = $this->normalizeSalaryData($this->url->post('salary'));
		$data['id'] = $this->url->post('id');

		$this->salaryModel->updateSalary($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Salary updated successfully.');
		$this->url->redirect('salary/edit&id=' . $data['id']);
	}

	protected function create()
	{
		$data = $this->normalizeSalaryData($this->url->post('salary'));

		$result = $this->salaryModel->createSalary($data);
		if ($result) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Salary created successfully.');
			$this->url->redirect('salaries');
		} else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Salary does not created (Server Error).');
			$this->url->redirect('salary/add');
		}
	}

	protected function delete()
	{
		$this->salaryModel->deleteSalary($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Salary deleted successfully.');
		$this->url->redirect('salaries');
	}

	protected function validateField()
	{
		$error = [];
		$error_flag = false;
		$salary = $this->url->post('salary');

		$required = array(
			'month_paye' => 'Month Paye',
			'employee_code' => 'Employee Code',
			'workhours' => 'Workhours',
			'basic_pay' => 'Basic Pay',
			'overtime_normal' => 'Overtime Normal',
			'overtime_special' => 'Overtime Special',
			'bonus' => 'Bonus',
			'car_allowance' => 'Car Allowance',
			'other_allowance' => 'Other Allowance',
			'government_bonus' => 'Government Bonus',
			'post_tax_adjustment' => 'Post Tax Adjustment',
			'fss_main' => 'FSS Main',
			'company_ni_contribution' => 'Company NI Contribution',
			'employee_ni_contribution' => 'Employee NI Contribution',
			'parental_leave_contribution' => 'Parental Leave Contribution',
		);

		foreach ($required as $field => $label) {
			if (!isset($salary[$field]) || $salary[$field] === '') {
				$error_flag = true;
				$error[$field] = $label;
				continue;
			}
			if ($field !== 'month_paye' && $field !== 'employee_code' && !is_numeric($salary[$field])) {
				$error_flag = true;
				$error[$field] = $label;
			}
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}

	protected function normalizeSalaryData($salary)
	{
		$data = $salary;
		if (!empty($salary['month_paye'])) {
			$timestamp = strtotime($salary['month_paye']);
			if ($timestamp !== false) {
				$data['month_paye'] = date('Y-m-d', $timestamp);
			}
		}
		return $data;
	}
}
