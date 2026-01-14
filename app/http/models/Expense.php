<?php

/**
 * Expense
 */
class Expense extends Model
{

	public function getExpenses()
	{
		$query = $this->model->query("SELECT e.*, et.name AS expense_type_name, pt.name AS payment_type_name, c.abbr AS abbr, s.name AS supplier, p.name AS payor, ROUND(((COALESCE(e.VAT_full, 0)-COALESCE(e.VAT_full, 0)/1.18) + COALESCE(e.Vat_exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + (COALESCE(e.VAT_reduced, 0)-COALESCE(e.VAT_reduced, 0)/1.05)),2) AS total_vat FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" .
			DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON pt.id = e.payment_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `"
			. DB_PREFIX . "companies` AS s ON " . "s.id = e.supplier_id  LEFT JOIN `"
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by WHERE e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) ORDER BY e.purchase_date DESC");
		return $query->rows;
	}

	public function getLocalExpenses()
	{
		$query = $this->model->query("SELECT e.*, et.name AS expense_type_name, pt.name AS payment_type_name, c.abbr AS abbr, s.name AS supplier, p.name AS payor, (COALESCE(e.VAT_full, 0) + COALESCE(e.VAT_Exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0)) AS total_vat FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" .
			DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON pt.id = e.payment_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `"
			. DB_PREFIX . "companies` AS s ON " . "s.id = e.supplier_id  LEFT JOIN `"
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by WHERE e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND (COALESCE(e.VAT_full, 0) + COALESCE(e.VAT_Exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0)) = 0 AND (e.foreign = 0 OR e.foreign IS NULL) ORDER BY e.purchase_date DESC");
		return $query->rows;
	}

	public function getForeignExpenses()
	{
		$query = $this->model->query("SELECT e.*, et.name AS expense_type_name, pt.name AS payment_type_name, c.abbr AS abbr, s.name AS supplier, p.name AS payor, (COALESCE(e.VAT_full, 0) + COALESCE(e.Vat_exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0)) AS total_vat FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" .
			DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON pt.id = e.payment_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `"
			. DB_PREFIX . "companies` AS s ON " . "s.id = e.supplier_id  LEFT JOIN `"
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by WHERE e.purchase_date >= '2023-01-01' AND e.foreign = 1 ORDER BY e.purchase_date DESC");
		return $query->rows;
	}

	public function getExpensesbyMonth()
	{
		$query = $this->model->query("SELECT  e.*, et.name, c.abbr, s.name AS supplier, p.name AS payor FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" .
			DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `"
			. DB_PREFIX . "companies` AS s ON " . "s.id = e.supplier_id  LEFT JOIN `"
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by ORDER BY e.purchase_date DESC");
		return $query->rows;
	}

	public function getExpense($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "expenses` WHERE `id` = ? LIMIT 1", array($id));
		return $query->row;
	}

	public function getCurrency()
	{
		$query = $this->model->query("SELECT `id`, `name`, `abbr` FROM `" . DB_PREFIX . "currency` WHERE `status` = ?", array(1));
		return $query->rows;
	}

	public function getSuppliers()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "companies`  ORDER BY `name` ASC ");
		return $query->rows;
	}

	public function getClients()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "companies` WHERE `type`=3 ORDER BY `name` ASC ");
		return $query->rows;
	}

	public function getSubsidiaries()
    {
        $query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "companies`  WHERE `type` = 2 ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

	public function expensesType()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "expense_type` WHERE `status` = ? ", array(1));
		return $query->rows;
	}

	public function getReceipt($id)
	{
		$query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('expense', $id));
		return $query->rows;
	}

	public function paymentType()
	{
		$query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "payment_type` WHERE `status` = ? ", array(1));
		return $query->rows;
	}

	public function updateExpense($data)
	{
		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "expenses` SET `purchase_by` = ?, `expense_type` = ?, `currency` = ?, `purchase_amount` = ?, 
		`payment_type` = ?, `purchase_date` = ?, `description` = ? , `supplier_id` = ?, `inv_number` = ?, 
		`paid_amount` = ?, `paid_date` = ? , `charge_client_id` = ?, `VAT_full` = ?, `VAT_Exempt` = ?, `VAT_NT` = ?, `VAT_reduced` = ?, `VAT_T8` = ?, `foreign` = ?, `eu_zone` = ? WHERE `id` = ?",
			array(
				$this->model->escape($data['purchaseby']),
				(int)$data['expensetype'],
				(int)$data['currency'],
				$this->model->escape($data['amount']),
				(int)$data['paymenttype'],
				$data['purchasedate'],
				$data['description'],
				$data['supplier_id'],
				$data['inv_number'],
				$data['paid_amount'],
				$data['paiddate'],
				(int)$data['charge_client_id'],
				$data['VAT_full'],
				$data['VAT_Exempt'],
				$data['VAT_NT'],
				$data['VAT_reduced'],
				$data['VAT_T8'],
				$data['foreign'],
				(int)$data['eu_zone'],
				(int)$data['id']
			)
		);

		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function createExpense($data)
	{
		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "expenses` (`purchase_by`, `expense_type`, `currency`,
		 `purchase_amount`, `payment_type`, `purchase_date`, `description`,`inv_number`, `paid_amount`, `supplier_id`, `VAT_full`, `VAT_Exempt`, `VAT_NT`, `VAT_reduced`, `VAT_T8`, `foreign`, `eu_zone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
			array(
				$this->model->escape($data['purchaseby']),
				(int)$data['expensetype'],
				(int)$data['currency'],
				$this->model->escape($data['amount']),
				(int)$data['paymenttype'],
				$data['purchasedate'],
				$data['description'],
				$data['inv_number'],
				$data['paid_amount'],
				$data['supplier_id'],
				$data['VAT_full'],
				$data['VAT_Exempt'],
				$data['VAT_NT'],
				$data['VAT_reduced'],
				$data['VAT_T8'],
				$data['foreign'],
				(int)$data['eu_zone']
			)
		);

		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function deleteExpense($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "expenses` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateForeignStatus($id, $foreign)
	{
		$current = $this->model->query(
			"SELECT `foreign` FROM `" . DB_PREFIX . "expenses` WHERE `id` = ? LIMIT 1",
			array((int)$id)
		);
		$value = 0;
		if (isset($current->row['foreign'])) {
			$value = (int)$current->row['foreign'];
		}
		$next = $value ? 0 : 1;
		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "expenses` SET `foreign` = ? WHERE `id` = ?",
			array($next, (int)$id)
		);
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}
