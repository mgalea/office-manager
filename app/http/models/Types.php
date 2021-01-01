<?php

/**
 * Types Model
 */

class Types extends Model
{

	//** DEPARTMENT TYPES */

	public function createDepartment($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "departments` (`name`, `status`) VALUES (?, ?)", array($this->model->escape($data['name']), (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getDepartments()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "departments`");
		return $query->rows;
	}

	public function updateDepartment($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "departments` SET `name` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteDepartment($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "departments` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	/** PAYMNET TYPES */

	public function createPaymentType($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "payment_type` (`name`, `description`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getPaymentTypes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "payment_type`");
		return $query->rows;
	}

	public function updatePaymentType($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "payment_type` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePaymentType($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "payment_type` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	/** EXPENSE TYPES */

	public function createExpenseType($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "expense_type` (`name`, `description`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getExpenseTypes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "expense_type`");
		return $query->rows;
	}

	public function updateExpenseType($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "expense_type` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteExpenseType($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "expense_type` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	/** CONTACT TYPES */

	public function createContactType($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "contact_type` (`name`, `description`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getContactTypes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "contact_type`");
		return $query->rows;
	}

	public function updateContactType($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "contact_type` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteContactType($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "contact_type` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	/** INVENTORY TYPES */

	public function createInventoryType($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "inventory_type` (`name`, `description`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getInventoryTypes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "inventory_type`");
		return $query->rows;
	}

	public function updateInventoryType($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "inventory_type` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteInventoryType($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "inventory_type` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	/** SUPPLIES TYPES */

	public function createSuppliesType($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "supplies_type` (`name`, `description`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getSuppliesTypes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "supplies_type`");
		return $query->rows;
	}

	public function updateSuppliesType($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "supplies_type` SET `name` = ?, `description` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteSuppliesType($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "supplies_type` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	/** PAYMENT GATEWAY */

	public function getPaymentGateway()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "payment_gateway` LIMIT 1");
		return $query->row;
	}

	public function updatePaymentGateway($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "payment_gateway` SET `username` = ?, `mode` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['username']), (int)$data['mode'], (int)$data['status'], 1));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	// ** PAYMENT STATUS TYPES

	public function createPaymentStatus($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "payment_status` (`name`, `status`) VALUES (?, ?)", array($this->model->escape($data['name']), (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getPaymentStatus()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "payment_status`");
		return $query->rows;
	}

	public function updatePaymentStatus($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "payment_status` SET `name` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePaymentStatus($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "payment_status` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	// ** CURRENCY TYPES

	public function createCurrency($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "currency` (`name`, `abbr`, `status`) VALUES (?, ?, ?)", array($this->model->escape($data['name']), $this->model->escape($data['abbr']), (int)$data['status']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getCurrency()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "currency`");
		return $query->rows;
	}

	public function updateCurrency($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "currency` SET `name` = ?, `abbr` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $this->model->escape($data['abbr']), (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteCurrency($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "currency` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}
