<?php

/**
 * Invoice Model
 */
class Invoice extends Model
{
	public function getInvoices()
	{
		$query = $this->model->query("SELECT i.*, c.name AS `customer_name`, cr.abbr AS `abbr`, s.name AS `subsidiary` FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "companies` AS c ON c.id = i.customer 
		LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id LEFT JOIN `" . DB_PREFIX . "companies` AS s ON s.id = i.billing_id ORDER BY i.inv_date DESC");
		return $query->rows;
	}

	public function getInvoice($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "invoice` WHERE `id` = ? LIMIT 1", array((int)$id));

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


	public function getInvoiceView($id)
	{
		$query = $this->model->query("SELECT i.*, c.name AS company, c.email AS customer_email, c.address, p.name AS payment, cr.name AS currency_name, cr.abbr AS currency_abbr, s.name AS subsidiary, s.address AS sbaddress 
		FROM `" . DB_PREFIX . "invoice` AS i INNER JOIN `" . DB_PREFIX . "companies` AS c ON i.customer = c.id INNER JOIN `"
			. DB_PREFIX . "payment_type` AS p ON i.paymenttype = p.id INNER JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id 
		INNER JOIN `" . DB_PREFIX . "companies` AS s ON i.billing_id = s.id WHERE i.id = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}


	public function getAttachments($id)
	{
		$query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('invoice', $id));
		return $query->rows;
	}

	public function getQuoteView($id)
	{
		$query = $this->model->query("SELECT p.*, c.company, c.email, cr.name AS currency_name, cr.abbr AS currency_abbr, pt.name AS `payment_method` FROM `" . DB_PREFIX . "proposal` AS p LEFT JOIN `" . DB_PREFIX . "persons` AS c ON p.customer = c.id LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON p.paymenttype = pt.id LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON p.currency = cr.id WHERE p.id = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getPayments($id)
	{
		$query = $this->model->query("SELECT p.id, p.amount, p.method, p.payment_date, pm.name AS method_name FROM `" . DB_PREFIX . "payments` AS p LEFT JOIN `" . DB_PREFIX . "payment_type` AS pm ON pm.id = p.method WHERE `invoice_id` = ?", array((int)$id));
		return $query->rows;
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

	public function getCustomers()
	{
		$query = $this->model->query("SELECT `id`, `name` As company FROM `" . DB_PREFIX . "companies` WHERE `type`=3");
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

	public function getCustomer($id)
	{
		$query = $this->model->query("SELECT `id`, `name` As company FROM `" . DB_PREFIX . "companies` WHERE `id`=?", array((int)$id));
		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
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

	public function updateInvoice($data)
	{
		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "invoice` SET `customer` = ?, `duedate` = ?, `paiddate` = ?, `currency` = ?, `paymenttype` = ?, `items` = ?, `subtotal` = ?, `tax` = ?, `discount` = ?, `discount_type` = ?, `discount_value` = ?, `amount` = ?, `paid` = ?, `due` = ?, `note` = ?, `tc` = ?, `billing_id` = ?,  `inv_status` = ? WHERE `id` = ?",
			array(
				(int)$data['customer'],
				$this->model->escape($data['duedate']),
				$this->model->escape($data['paiddate']),
				(int)$data['currency'],
				(int)$data['paymenttype'],
				$data['item'],
				$data['subtotal'],
				$data['tax'],
				$data['discount'],
				$data['discounttype'],
				$data['discount_value'],
				$data['amount'],
				$data['paid'],
				$data['due'],
				$data['note'],
				$data['tc'],
				(int)$data['billing_id'],
				$data['inv_status'],
				(int)$data['id']
			)
		);

		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function createInvoice($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "invoice` (`billing_id`,`customer`, `duedate`, `paiddate`, `currency`, 
		`paymenttype`, `items`, `subtotal`, `tax`, `discount`, `discount_type`, `discount_value`, `amount`, `paid`, `due`, 
		`note`, `tc`, `status`, `inv_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
			array(
				(int)$data['billing_id'],
				(int)$data['customer'], $this->model->escape($data['duedate']), $this->model->escape($data['paiddate']),
				(int)$data['currency'], (int)$data['paymenttype'], $data['item'], $data['subtotal'],
				$data['tax'], $data['discount'], $data['discounttype'], $data['discount_value'], $data['amount'],
				$data['paid'], $data['due'], $data['note'], $data['tc'], $data['status'], $data['inv_status']
			)
		);
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function createQuoteInvoice($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "invoice` (`customer`, `currency`, `duedate`, `paiddate`, `paymenttype`, `items`, `subtotal`, `tax`, `discount`, `discount_type`, `discount_value`, `amount`, `paid`, `due`, `note`, `tc`, `status`) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
			array((int)$data['customer'], (int)$data['currency'], $this->model->escape($data['duedate']), $this->model->escape($data['paiddate']), (int)$data['paymenttype'], $data['items'], $data['subtotal'], $data['tax'], $data['discount'], $data['discounttype'], $data['discount_value'], $data['amount'], $data['paid'], $data['due'], $data['note'], $data['tc'], $data['status'])
		);

		if ($query->num_rows > 0) {
			$id = $this->model->last_id();
			$this->model->query("UPDATE `" . DB_PREFIX . "proposal` SET `invoice_id` = ? WHERE `id` = ?", array((int)$id, (int)$data['id']));
			return $id;
		} else {
			return false;
		}
	}

	public function deleteInvoice($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "invoice` WHERE `id` = ?", array((int)$id));
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

	public function getRecurringInvoices()
	{
		$query = $this->model->query("SELECT i.*, c.company, cr.abbr AS `abbr` FROM `" . DB_PREFIX . "recurring_invoice` AS i LEFT JOIN `" . DB_PREFIX . "persons` AS c ON c.id = i.customer LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id ORDER BY i.inv_date DESC");
		return $query->rows;
	}

	public function getRecurringInvoice($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "recurring_invoice` WHERE `id` = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}

	public function getRecurringInvoiceView($id)
	{
		$query = $this->model->query("SELECT i.*, c.name, c.email, c.address, p.name AS payment, cr.name AS currency_name, 
		cr.abbr AS currency_abbr FROM `" . DB_PREFIX . "recurring_invoice` AS i LEFT JOIN `" . DB_PREFIX . "companies` AS c ON i.customer = c.id 
		LEFT JOIN `" . DB_PREFIX . "payment_type` AS p ON i.paymenttype = p.id LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id WHERE i.id = ? LIMIT 1", array((int)$id));

		if ($query->num_rows > 0) {
			return $query->row;
		} else {
			return false;
		}
	}


	public function getInvoiceBankAccountDetails($id)
	{
		$query = $this->model->query("SELECT acc.name as account_name, acc.number as account_number, acc.sort_code as sort_code,
		acc.iban,  acc.swift as swift_code, bank.name as bank_name,
		acc.bank_branch as bank_branch, acc.remittance as remittance 
		FROM kk_companies as bank, kk_bank_accounts as acc 
		WHERE acc.company= (SELECT billing_id FROM office_manager.kk_invoice WHERE id=?) AND
		bank.id= acc.bank;", array((int)$id));
		if ($query->num_rows > 0) {
			return $query->rows;
		} else {
			return '';
		}
	}


	public function getInvoicesCreatedfromRecurring($id)
	{
		$query = $this->model->query("SELECT i.*, c.company, cr.abbr AS `abbr` FROM `" . DB_PREFIX . "invoice` AS i LEFT JOIN `" . DB_PREFIX . "persons` AS c ON c.id = i.customer LEFT JOIN `" . DB_PREFIX . "currency` AS cr ON i.currency = cr.id WHERE i.rid = ? ORDER BY i.inv_date DESC", array($id));
		return $query->rows;
	}

	public function createRecurringInvoice($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "recurring_invoice` (`customer`, `currency`, `paymenttype`, `items`, `subtotal`, `tax`, `discount`, `discount_type`, `discount_value`, `amount`, `note`, `tc`, `repeat_every`, `inv_status`, `inv_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array((int)$data['customer'], (int)$data['currency'], (int)$data['paymenttype'], $data['item'], $data['subtotal'], $data['tax'], $data['discount'], $data['discounttype'], $data['discount_value'], $data['amount'], $data['note'], $data['tc'], $data['repeat_every'], $data['inv_status'], $data['inv_date']));

		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function updateRecurringInvoice($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "recurring_invoice` SET `customer` = ?, `currency` = ?, `paymenttype` = ?, `items` = ?, `subtotal` = ?, `tax` = ?, `discount` = ?, `discount_type` = ?, `discount_value` = ?, `amount` = ?, `note` = ?, `tc` = ?, `repeat_every` = ?, `inv_status` = ?, `inv_date` = ? WHERE `id` = ?", array((int)$data['customer'], (int)$data['currency'], (int)$data['paymenttype'], $data['item'], $data['subtotal'], $data['tax'], $data['discount'], $data['discounttype'], $data['discount_value'], $data['amount'], $data['note'], $data['tc'], $data['repeat_every'], $data['inv_status'], $data['inv_date'], (int)$data['id']));

		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteRecurringInvoice($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "recurring_invoice` WHERE `id` = ?", array((int)$id));
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
}
