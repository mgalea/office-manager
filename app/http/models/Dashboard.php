<?php

/**
 * Dashboard Model
 */

class Dashboard extends Model
{
	public function getCurrency()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "currency`");
		return $query->rows;
	}

	public function getstatistics()
	{
		$query = $this->model->query("(SELECT count(*) AS `total` FROM `" . DB_PREFIX . "contacts`) UNION ALL (SELECT count(*) AS `total` FROM `" . DB_PREFIX . "projects`) UNION ALL (SELECT count(*) AS `total` FROM `" . DB_PREFIX . "invoice`) UNION ALL (SELECT count(*) AS `total` FROM `" . DB_PREFIX . "proposal`)");
		return $query->rows;
	}

	public function getInvoiceByStatus()
	{
		$query = $this->model->query("SELECT COUNT(id) AS value, `status` AS `label` FROM `" . DB_PREFIX . "invoice` GROUP BY `status`");
		return $query->rows;
	}

	public function getTicketByStatus()
	{
		$query = $this->model->query("SELECT COUNT(id) AS value, IF(`status` = 1, 'Closed', 'Open') AS `label` FROM `" . DB_PREFIX . "tickets` GROUP BY `status`");
		return $query->rows;
	}

	public function getRecentlyAdded()
	{
		$data = array();
		$contact = $this->model->query("SELECT `id`, concat(`salutation`, ' ', `firstname`, ' ', `lastname`) AS name, `company`, `date_of_joining` FROM `" . DB_PREFIX . "contacts` ORDER BY `date_of_joining` DESC LIMIT 5");
		$data['contacts'] = $contact->rows;

		$invoice = $this->model->query("SELECT i.id, c.company, i.amount, cr.abbr, i.date_of_joining FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "contacts` AS c ON c.id = i.customer LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON cr.id = i.currency ORDER BY i.date_of_joining DESC LIMIT 5");

		$data['invoices'] = $invoice->rows;

		$quotes = $this->model->query("SELECT p.id, p.project_name, c.company, p.date_of_joining FROM `" . DB_PREFIX . "proposal` AS p LEFT JOIN `" . DB_PREFIX . "contacts` AS c ON c.id = p.customer ORDER BY p.date_of_joining DESC LIMIT 5");
		$data['quotes'] = $quotes->rows;

		$expense = $this->model->query("SELECT e.id, e.purchase_by, e.purchase_amount, cr.abbr, e.date_of_joining FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON cr.id = e.currency ORDER BY e.date_of_joining DESC LIMIT 5");
		$data['expenses'] = $expense->rows;

		return $data;
	}

	public function getLatestContact()
	{
		$query = $this->model->query("SELECT `id`, `firstname`, `lastname`, `company` FROM `" . DB_PREFIX . "contacts` ORDER BY `date_of_joining` LIMIT 5");
		return $query->rows;
	}

	public function getLatestInvoice()
	{
		$query = $this->model->query("SELECT i.id, c.company, cr.abbr, i.amount, i.status, i.date_of_joining FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "contacts` AS c ON c.id = i.customer LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON cr.id = i.currency ORDER BY i.date_of_joining LIMIT 5");
		return $query->rows;
	}

	public function getIncome()
	{
		$query = $this->model->query("SELECT SUM(amount) AS total, concat(MONTH(date_of_joining), '-', YEAR(date_of_joining)) AS `period`, MONTH(date_of_joining) AS `month`, YEAR(date_of_joining) AS `year` FROM `" . DB_PREFIX . "invoice` GROUP BY MONTH(date_of_joining) ORDER BY `year` ASC");
		return $query->rows;
	}

	public function getExpenses()
	{
		$query = $this->model->query("SELECT COUNT(e.id) AS value, et.name AS `label` FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" . DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type GROUP BY et.name");
		return $query->rows;
	}

	public function getIncomeExpenses()
	{
		$query = $this->model->query("SELECT concat( YEAR(i.date_of_joining), '-',LPAD(MONTH(i.date_of_joining), 2, '0')) AS `period`, SUM(i.amount) AS income, SUM(e.purchase_amount) AS expense FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "expenses` AS e ON MONTH(i.date_of_joining) = MONTH(e.date_of_joining) WHERE i.date_of_joining >= NOW() - INTERVAL 6 MONTH GROUP BY MONTH(i.date_of_joining) UNION 
			SELECT concat(YEAR(e.date_of_joining), '-', LPAD(MONTH(e.date_of_joining), 2, '0')) AS `period`, SUM(i.amount) AS income, SUM(e.purchase_amount) AS expense FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" . DB_PREFIX . "invoice` AS i ON MONTH(i.date_of_joining) = MONTH(e.date_of_joining) WHERE e.date_of_joining >= NOW() - INTERVAL 6 MONTH GROUP BY MONTH(e.date_of_joining)");
		return $query->rows;
	}

	public function getExpensesValue()
	{
		$query = $this->model->query("SELECT COUNT(e.id) AS value, et.name AS `label`, MONTH(e.date_of_joining) AS month FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" . DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type GROUP BY et.name, MONTH(e.date_of_joining) ORDER BY e.date_of_joining");
		return $query->rows;
	}

	public function getEvents()
	{
		$query = $this->model->query("SELECT `id`, `title`, DATE_FORMAT(`start`, '%Y-%m-%d') AS start_date, DATE_FORMAT(`start`, '%H:%i:%s') AS start_time, DATE_FORMAT(`end`, '%Y-%m-%d') AS `end_date`, DATE_FORMAT(`end`, '%H:%i:%s') AS `end_time`, IF(allday = 1, 1, 0) AS `allDay`, `description` FROM `" . DB_PREFIX . "event`");
		return $query->rows;
	}

	public function getUserEvents($id)
	{
		$query = $this->model->query("SELECT `id`, `title`, DATE_FORMAT(`start`, '%Y-%m-%d') AS start_date, DATE_FORMAT(`start`, '%H:%i:%s') AS start_time, DATE_FORMAT(`end`, '%Y-%m-%d') AS `end_date`, DATE_FORMAT(`end`, '%H:%i:%s') AS `end_time`, IF(allday = 1, 1, 0) AS `allDay`, `description` FROM `" . DB_PREFIX . "event` WHERE `user_id` = ?", array((int)$id));
		return $query->rows;
	}

	public function getEvent($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "contacts` WHERE `id` = ? LIMIT 1", array((int)$id));
		return $query->row;
	}

	public function updateEvent($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "event` SET `title` = ?, `description` = ?, `start` = ?, `end` = ?, `allday` = ?, `user_id` = ? WHERE `id` = ? ", array($data['title'], $data['description'], $this->model->escape($data['start']), $this->model->escape($data['end']), $this->model->escape($data['allday']), (int)$data['user_id'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function createEvent($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "event` (`title`, `description`, `start`, `end`, `allday`, `user_id`) VALUES (?, ?, ?, ?, ?, ?)", array($data['title'], $data['description'], $data['start'], $data['end'], $this->model->escape($data['allday']), (int)$data['user_id']));
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function dropEvent($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "event` SET `start` = ? WHERE `id` = ? ", array($this->model->escape($data['start']), (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteEvent($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "event` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getNotes()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "notes` ORDER BY `date_of_joining` DESC");
		return $query->rows;
	}

	public function getUserNotes($user_id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "notes` WHERE `user_id` = ?", array((int)$user_id));
		return $query->rows;
	}

	public function getNote($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "notes` WHERE `id` = ? LIMIT 1", array((int)$id));
		return $query->row;
	}

	public function getUserNote($id, $user_id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "notes` WHERE `id` = ? AND `user_id` = ? LIMIT 1", array((int)$id, (int)$user_id));
		return $query->row;
	}

	public function updateNote($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "notes` SET `title` = ?, `description` = ?, `color` = ?, `background` = ?, `status` = ? WHERE `id` = ? ", array($data['title'], $data['descr'], $data['color'], $data['background'], (int)$data['status'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function createNote($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "notes` (`title`, `description`, `color`, `background`, `status`, `user_id`) VALUES (?, ?, ?, ?, ?, ?)", array($data['title'], $data['descr'], $data['color'], $data['background'], (int)$data['status'], (int)$data['user_id']));
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function deleteNote($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "notes` WHERE `id` = ?", array((int)$id ));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}
