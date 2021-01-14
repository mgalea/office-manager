<?php

/**
 * Person Model
 */
class Person extends Model
{
	public function getPersons()
	{
		$query = $this->model->query("SELECT p.*, c.name AS company , c.short_name FROM `" . DB_PREFIX . "persons` AS p LEFT JOIN `" .
			DB_PREFIX . "companies` AS c ON p.company = c.id ORDER BY p.firstname ASC ");
		return $query->rows;
	}

	public function getPerson($id)
	{
		$query = $this->model->query("SELECT p.* FROM `" . DB_PREFIX . "persons` AS p WHERE `id` = ? LIMIT 1 ", array((int)$id));
		return $query->row;
	}

	public function getDocuments($id)
	{
		$query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('person', $id));
		return $query->rows;
	}

	public function createPerson($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "persons` (`salutation`, `firstname`, `lastname`, `company`, `email`, `phone`,
		 	`address`, `remark`,`designation`,`persons`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)",
			array(
				$this->model->escape($data['salutation']), $this->model->escape($data['firstname']), $this->model->escape($data['lastname']),
				(int)$data['company'],
				$this->model->escape($data['email']), $this->model->escape($data['phone']),
				$data['address'],
				$this->model->escape($data['remark']),
				$this->model->escape($data['designation']),
				$data['persons']
			)
		);

		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function updatePerson($data)
	{

		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "persons` SET `salutation` = ?, `firstname` = ? , `lastname` = ?, 
			`company` = ?, `email` = ?, `phone` = ?,`address` = ?, `remark` = ?, `designation` = ?, `persons` = ? WHERE `id` = ? ",
			array(
				$this->model->escape($data['salutation']), $this->model->escape($data['firstname']), $this->model->escape($data['lastname']),
				(int)$data['company'],
				$this->model->escape($data['email']), $this->model->escape($data['phone']),
				$data['address'],
				$this->model->escape($data['remark']),
				$this->model->escape($data['designation']),
				$data['persons'],
				(int)$data['id']
			)
		);

		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePerson($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "persons` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function emailLog($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "email_logs` (`email_to`, `email_bcc`, `subject`, `message`, `type`, `type_id`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?)", array($data['to'], $data['bcc'], $data['subject'], $data['message'], $data['type'], $data['type_id'], $data['user_id']));
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}
	public function getContactType()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "contact_type`");
		return $query->rows;
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

	public function getCompanies()
	{
		$query = $this->model->query("SELECT `id`,`name` FROM `" . DB_PREFIX . "companies` ORDER BY `name` ASC");
		return $query->rows;
	}
}
