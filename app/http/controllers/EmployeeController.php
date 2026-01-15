<?php

/**
 * EmployeeController
 */
class EmployeeController extends Controller
{
	private $employeeModel;

	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Initialize Employee model*/
		$this->employeeModel = new Employee();
	}

	/**
	 * Employee list view
	 */
	public function index()
	{
		if (!$this->commons->hasPermission('employees')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		$data['result'] = $this->employeeModel->getEmployees();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_employees'];

		$this->view->render('employee/employee_list.tpl', $data);
	}

	public function indexView()
	{
		if (!$this->commons->hasPermission('employee/view')) {
			Not_foundController::show('403');
			exit();
		}

		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('employees');
		}

		$employee = $this->employeeModel->getEmployee($id);
		if (!$employee) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Employee does not exist in database!');
			$this->url->redirect('employees');
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = $employee;
		$data['page_title'] = $data['lang']['common']['text_employee'] . ' ' . $data['lang']['common']['text_view'];

		$this->view->render('employee/employee_view.tpl', $data);
	}

	public function indexAdd()
	{
		if (!$this->commons->hasPermission('employee/add')) {
			Not_foundController::show('403');
			exit();
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = NULL;
		$data['page_title'] = $data['lang']['common']['text_employee'] . ' ' . $data['lang']['common']['text_add'];
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['action'] = URL . DIR_ROUTE . 'employee/action';

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		$this->view->render('employee/employee_form.tpl', $data);
	}

	public function indexEdit()
	{
		if (!$this->commons->hasPermission('employee/edit')) {
			Not_foundController::show('403');
			exit();
		}

		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('employees');
		}

		$employee = $this->employeeModel->getEmployee($id);
		if (!$employee) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Employee does not exist in database!');
			$this->url->redirect('employees');
		}

		$data = $this->commons->getUser();

		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;

		$data['result'] = $employee;
		$data['page_title'] = $data['lang']['common']['text_employee'] . ' ' . $data['lang']['common']['text_edit'];
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		$data['action'] = URL . DIR_ROUTE . 'employee/action';

		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		$this->view->render('employee/employee_form.tpl', $data);
	}

	public function indexAction()
	{
		if (!isset($_POST['submit'])) {
			$this->url->redirect('employees');
			exit();
		}

		if ($validate_field = $this->validateField()) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter/select valid ' . implode(", ", $validate_field) . '!');
			if (!empty($this->url->post('id'))) {
				$this->url->redirect('employee/edit&id=' . $this->url->post('id'));
			} else {
				$this->url->redirect('employee/add');
			}
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			if (!empty($this->url->post('id'))) {
				$this->url->redirect('employee/edit&id=' . $this->url->post('id'));
			} else {
				$this->url->redirect('employee/add');
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
		if (!$this->commons->hasPermission('employee/delete')) {
			Not_foundController::show('403');
			exit();
		}

		if (!isset($_POST['delete']) || empty($this->url->post('id'))) {
			$this->url->redirect('employees');
			exit();
		}

		$this->delete();
	}

	protected function update()
	{
		$data = $this->normalizeEmployeeData($this->url->post('employee'));
		$data['id'] = $this->url->post('id');

		$result = $this->employeeModel->updateEmployee($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Employee updated successfully.');
		$this->url->redirect('employee/edit&id=' . $data['id']);
	}

	protected function create()
	{
		$data = $this->normalizeEmployeeData($this->url->post('employee'));

		$result = $this->employeeModel->createEmployee($data);
		if ($result) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Employee created successfully.');
			$this->url->redirect('employees');
		} else {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Employee does not created (Server Error).');
			$this->url->redirect('employee/add');
		}
	}

	protected function delete()
	{
		$this->employeeModel->deleteEmployee($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Employee deleted successfully.');
		$this->url->redirect('employees');
	}

	protected function validateField()
	{
		$error = [];
		$error_flag = false;
		$employee = $this->url->post('employee');

		$has_name = false;
		if (!empty($employee['name'])) {
			if ($this->commons->validateText($employee['name'])) {
				$error_flag = true;
				$error['name'] = 'Name';
			} else {
				$has_name = true;
			}
		}

		if (!empty($employee['firstname'])) {
			if ($this->commons->validateText($employee['firstname'])) {
				$error_flag = true;
				$error['firstname'] = 'First Name';
			} else {
				$has_name = true;
			}
		}

		if (!empty($employee['lastname']) && $this->commons->validateText($employee['lastname'])) {
			$error_flag = true;
			$error['lastname'] = 'Last Name';
		}

		if (!$has_name) {
			$error_flag = true;
			$error['name'] = 'Name';
		}

		if (!empty($employee['email']) && $this->commons->validateEmail($employee['email'])) {
			$error_flag = true;
			$error['email'] = 'Email Address';
		}

		if (!empty($employee['mobile']) && $this->commons->validatePhoneNumber($employee['mobile'])) {
			$error_flag = true;
			$error['mobile'] = 'Mobile Number';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}

	protected function normalizeEmployeeData($employee)
	{
		$data = $employee;
		$firstname = isset($employee['firstname']) ? trim($employee['firstname']) : '';
		$lastname = isset($employee['lastname']) ? trim($employee['lastname']) : '';

		if ($firstname !== '') {
			$data['first_name'] = $firstname;
		}
		if ($lastname !== '') {
			$data['last_name'] = $lastname;
		}

		$full_name = '';
		if (!empty($employee['name'])) {
			$full_name = trim($employee['name']);
		} else {
			$full_name = trim($firstname . ' ' . $lastname);
		}

		if ($full_name !== '') {
			$data['name'] = $full_name;
			$data['full_name'] = $full_name;
		}

		if (!empty($employee['email'])) {
			$data['email_address'] = $employee['email'];
		}

		if (!empty($employee['mobile'])) {
			$data['phone'] = $employee['mobile'];
			$data['phone_number'] = $employee['mobile'];
		}

		if (!empty($employee['date_of_joining'])) {
			$timestamp = strtotime($employee['date_of_joining']);
			if ($timestamp !== false) {
				$data['date_of_joining'] = date('Y-m-d', $timestamp);
			}
		}

		return $data;
	}
}
