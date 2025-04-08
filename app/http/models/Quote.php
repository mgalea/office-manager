<?php

/**
 * Proposal Model
 */
class Quote extends Model
{

	public function getQuotes()
	{
		$query = $this->model->query("SELECT p.*, c.name AS company, c.address AS customer_address FROM `" . DB_PREFIX . "proposal` AS p LEFT JOIN `" . DB_PREFIX . "companies` AS c ON c.id = p.customer ORDER BY p.date_of_joining DESC");
		return $query->rows;
	}

	public function getQuote($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "proposal` WHERE `id` = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
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


	public function getSubdiaries()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` WHERE type=2 ORDER BY `name` ASC");
		return $query->rows;
	}

	public function getBiller($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` WHERE `id`=?", array((int)$id));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getCustomers()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` WHERE type=3 ORDER BY `name` ASC");
		return $query->rows;
	}

	public function getInvoiceBankAccountDetails($id)

	{
		$statement = "SELECT acc.name as account_name, acc.number as account_number, acc.sort_code as sort_code,acc.iban,  acc.swift as swift_code, curr.name as currency, curr.abbr as abbr, bank.name as bank_name,acc.bank_branch as bank_branch, acc.remittance as remittance FROM " . DB_PREFIX . "companies as sub, " . DB_PREFIX . "bank_accounts as acc INNER JOIN " . DB_PREFIX . "currency as curr ON acc.currency=curr.id INNER JOIN " . DB_PREFIX . "companies as bank ON acc.bank=bank.id WHERE sub.id=(SELECT billing_id FROM " . DB_PREFIX . "proposal where id=?)";

		$query = $this->model->query($statement, array($id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return '';
		}
	}

	public function getQuoteView($id)
	{
		$query = $this->model->query("SELECT p.*, b.name as biller, b.address as biller_address,c.name AS customer_name, c.email, c.address, cr.name AS currency_name, cr.abbr AS currency_abbr, pt.name AS `payment_method` FROM `" . DB_PREFIX . "proposal` AS p LEFT JOIN `" . DB_PREFIX . "companies` AS c ON p.customer = c.id LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON p.paymenttype = pt.id LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON p.currency = cr.id LEFT JOIN `" . DB_PREFIX . "companies` AS b ON p.billing_id = b.id WHERE p.id = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getInoviceView($id)
	{
		$query = $this->model->query("SELECT i.*, c.company, c.email, p.name AS payment, cr.name AS currency_name, cr.abbr AS currency_abbr FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "contacts` AS c ON i.customer = c.id LEFT JOIN `" . DB_PREFIX . "payment_type` AS p ON i.paymenttype = p.id LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id WHERE i.id = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function paymentType()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "payment_type` WHERE `status` = ? ", array(1));
		return $query->rows;
	}

	public function getTaxes()
	{
		$query = $this->model->query("SELECT `id`, `name`, `rate` FROM `" . DB_PREFIX . "taxes`");
		return $query->rows;
	}

	public function getItems()
	{
		$query = $this->model->query("SELECT `id`, `name` AS `label`, `price` AS `cost`, `description` AS `desc` FROM `" . DB_PREFIX . "items`");
		return $query->rows;
	}

	public function getPaymentStatus()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "payment_status`");
		return $query->rows;
	}

	public function getCurrency()
	{
		$query = $this->model->query("SELECT `id`, `name`, `abbr` FROM `" . DB_PREFIX . "currency`");
		return $query->rows;
	}

	public function createQuote($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "proposal` (`billing_id`, `customer`, `project_name`, `paymenttype`, `currency`, `date`, `expiry`, `items`, `total`, `note`, `tc`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)",
			array((int)$data['billing_id'], (int)$data['customer'], $this->model->escape($data['project_name']), $this->model->escape($data['paymenttype']), $data['currency'], $data['date'], $data['expiry'], $data['item'], $data['total'], $data['note'], $data['tc'])
		);
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function createInvoice($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "invoice` (`customer`, `currency`, `duedate`, `paiddate`, `paymenttype`, `items`, `subtotal`, `tax`, `discount`, `discount_type`, `discount_value`, `amount`, `paid`, `due`, `note`, `tc`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array((int)$data['customer'], (int)$data['currency'], $this->model->escape($data['duedate']), $this->model->escape($data['paiddate']), (int)$data['paymenttype'], $data['items'], $data['subtotal'], $data['tax'], $data['discount'], $data['discounttype'], $data['discount_value'], $data['amount'], $data['paid'], $data['due'], $data['note'], $data['tc'], $data['status']));

		if ($query->num_rows > 0) {
			$id = $this->model->last_id();
			$this->model->query("UPDATE `" . DB_PREFIX . "proposal` SET `invoice_id` = ? WHERE `id` = ?", array((int)$id, (int)$data['id']));
			return $id;
		} else {
			return false;
		}
	}

	public function updateQuote($data)
	{
		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "proposal` SET `billing_id` = ?,`customer` = ?, `project_name` = ?, `paymenttype` = ?, `currency` = ?, `date` = ?, `expiry` = ?, `items` = ?, `total` = ?, `note` = ?, `tc` = ? WHERE `id` = ?",
			array(
				(int)$data['billing_id'], (int)$data['customer'],
				$this->model->escape($data['project_name']),
				$this->model->escape($data['paymenttype']),
				$data['currency'], $data['date'], $data['expiry'], $data['item'], $data['total'], $data['note'], $data['tc'], (int)$data['id']
			)
		);
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getTemplate($name)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "template` WHERE `template` = ? LIMIT 1", array($name));
		return $query->row;
	}

	public function deleteQuote($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "proposal` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}
