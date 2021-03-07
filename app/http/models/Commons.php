<?php

/**
 * Commmons Model
 */
class Commons extends Model
{
	public function getUserData($id)
	{
		$query = $this->model->query("SELECT u.firstname, u.lastname,u.email, u.email_password, ur.name AS role FROM `" . DB_PREFIX . "users` AS u LEFT JOIN `" . DB_PREFIX . "user_role` AS ur ON u.user_role = ur.id WHERE u.user_id = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return '';
		}
	}

	public function getAddressBook()
	{
		$query = $this->model->query("SELECT p.firstname, p.lastname, c.name AS company, p.email, p.id FROM `" . DB_PREFIX . "persons` AS p INNER JOIN `". DB_PREFIX . "companies` AS c ON c.id=p.company ORDER BY `firstname` ASC");
		if ($query->num_rows > 0) {
			return $query->rows;
		} else {
			return '';
		}
	}

	public function getUserEmail($id)
	{
		$query = $this->model->query("SELECT u.email AS `account`, u.email_password AS `password`,  FROM `" . DB_PREFIX . "users` AS u WHERE u.user_id = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return '';
		}
	}

	public function getOrganization()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "info` WHERE `id` = ?", array(1));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return '';
		}
	}

	public function getRoleString($role)
	{
		$query = $this->model->query("SELECT `permission` FROM `" . DB_PREFIX . "user_role` WHERE `id` = ? LIMIT 1", array((int)$role));

		return $query->row['permission'];
	}

	public function getInvoiceBasics()
	{
		$query = $this->model->query("SELECT `logo`, `favicon`, `name`, `address`, `currency` FROM `" . DB_PREFIX . "info` WHERE `id` = ?", array(1));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return '';
		}
	}

	public function insertAttchedFile($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "attached_files` (`file_name`, `file_type`, `file_type_id`) VALUES (?, ?, ?) ",
			array($this->model->escape($data['name']), $data['type'], $data['type_id'])
		);
	}

	public function deleteAttchedFile($data)
	{
		$query = $this->model->query(
			"DELETE FROM `" . DB_PREFIX . "attached_files` WHERE `file_name` = ? AND `file_type` = ?",
			array($this->model->escape($data['name']), $data['type'])
		);
	}
}
