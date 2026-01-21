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
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by WHERE e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH) AND (e.foreign = 0 OR e.foreign IS NULL) ORDER BY e.purchase_date DESC");
		return $query->rows;
	}

	public function getForeignExpenses()
	{
		$query = $this->model->query("SELECT e.*, et.name AS expense_type_name, pt.name AS payment_type_name, c.abbr AS abbr, s.name AS supplier, p.name AS payor, (COALESCE(e.VAT_full, 0) + COALESCE(e.Vat_exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0)) AS total_vat FROM `" . DB_PREFIX . "expenses` AS e LEFT JOIN `" .
			DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON pt.id = e.payment_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `"
			. DB_PREFIX . "companies` AS s ON " . "s.id = e.supplier_id  LEFT JOIN `"
			. DB_PREFIX . "companies` AS p ON " . "p.id = e.purchase_by WHERE e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH) AND e.foreign = 1 ORDER BY e.purchase_date DESC");
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

	public function updateEuZoneStatus($id)
	{
		$current = $this->model->query(
			"SELECT `eu_zone`, `purchase_amount` FROM `" . DB_PREFIX . "expenses` WHERE `id` = ? LIMIT 1",
			array((int)$id)
		);
		$value = 0;
		if (isset($current->row['eu_zone'])) {
			$value = (int)$current->row['eu_zone'];
		}
		$next = $value ? 0 : 1;
		$purchase_amount = $current->row['purchase_amount'] ?? '0.00';
		$vat_t8 = $next ? $purchase_amount : '0.00';
		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "expenses` SET `eu_zone` = ?, `VAT_T8` = ? WHERE `id` = ?",
			array($next, $vat_t8, (int)$id)
		);
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getExpensesDataTable($params, $scope = 'all')
	{
		$start = isset($params['start']) ? (int)$params['start'] : 0;
		$length = isset($params['length']) ? (int)$params['length'] : 25;
		$search = isset($params['search']) ? trim((string)$params['search']) : '';
		$order_column = isset($params['order_column']) ? (int)$params['order_column'] : 4;
		$show_eu = !empty($params['show_eu_zone_column']);
		$order_dir = isset($params['order_dir']) && strtolower($params['order_dir']) === 'asc' ? 'ASC' : 'DESC';

		if ($show_eu) {
			$columns = array(
				0 => null,
				1 => null,
				2 => 's.name',
				3 => 'e.inv_number',
				4 => 'e.purchase_date',
				5 => 'p.name',
				6 => 'e.purchase_amount',
				7 => 'total_vat',
				8 => 'e.foreign',
				9 => 'e.eu_zone',
				10 => null,
			);
		} else {
			$columns = array(
				0 => null,
				1 => null,
				2 => 's.name',
				3 => 'e.inv_number',
				4 => 'e.purchase_date',
				5 => 'p.name',
				6 => 'e.purchase_amount',
				7 => 'total_vat',
				8 => 'e.foreign',
				9 => null,
			);
		}

		$where = array();
		$params_list = array();

		if ($scope === 'local') {
			$where[] = "(e.foreign = 0 OR e.foreign IS NULL)";
			$where[] = "e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH)";
		} elseif ($scope === 'foreign') {
			$where[] = "e.foreign = 1";
		}

		if ($search !== '') {
			$total_vat_expr = "(COALESCE(e.VAT_full, 0) + COALESCE(e.VAT_Exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0))";
			$status_expr = "CASE
				WHEN COALESCE(e.paid_amount, 0) = 0 THEN 'unpaid'
				WHEN COALESCE(e.purchase_amount, 0) > 0 AND (COALESCE(e.paid_amount, 0) / COALESCE(e.purchase_amount, 0)) = 1 THEN 'paid'
				WHEN COALESCE(e.purchase_amount, 0) > 0 AND (COALESCE(e.paid_amount, 0) / COALESCE(e.purchase_amount, 0)) > 0 AND (COALESCE(e.paid_amount, 0) / COALESCE(e.purchase_amount, 0)) < 1 THEN 'partial'
				WHEN COALESCE(e.purchase_amount, 0) > 0 AND (COALESCE(e.paid_amount, 0) / COALESCE(e.purchase_amount, 0)) > 1 THEN 'overpaid'
				ELSE '' END";
			$foreign_expr = "CASE WHEN COALESCE(e.foreign, 0) = 1 THEN 'foreign' ELSE 'local' END";
			$eu_expr = "CASE WHEN COALESCE(e.eu_zone, 0) = 1 THEN 'eu zone' ELSE 'non-eu' END";
			$where[] = "(s.name LIKE ?
				OR e.inv_number LIKE ?
				OR DATE_FORMAT(e.purchase_date, '%Y-%m-%d') LIKE ?
				OR p.name LIKE ?
				OR CAST(e.purchase_amount AS CHAR) LIKE ?
				OR CAST(" . $total_vat_expr . " AS CHAR) LIKE ?
				OR " . $status_expr . " LIKE ?
				OR " . $foreign_expr . " LIKE ?
				OR " . $eu_expr . " LIKE ?)";
			$like = '%' . $search . '%';
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
			$params_list[] = $like;
		}

		$join_sql = " LEFT JOIN `" . DB_PREFIX . "expense_type` AS et ON et.id = e.expense_type LEFT JOIN `" . DB_PREFIX . "payment_type` AS pt ON pt.id = e.payment_type LEFT JOIN `" . DB_PREFIX . "currency` AS c ON c.id = e.currency  LEFT JOIN `" . DB_PREFIX . "companies` AS s ON s.id = e.supplier_id  LEFT JOIN `" . DB_PREFIX . "companies` AS p ON p.id = e.purchase_by";
		$where_sql = '';
		if (!empty($where)) {
			$where_sql = ' WHERE ' . implode(' AND ', $where);
		}

		$total_query_params = !empty($params_list) ? $params_list : null;
		$total_query = $this->model->query(
			"SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "expenses` AS e" . $join_sql . $where_sql,
			$total_query_params
		);
		$records_filtered = isset($total_query->row['total']) ? (int)$total_query->row['total'] : 0;

		$total_all_query = $this->model->query(
			"SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "expenses` AS e" . ($scope === 'local' ? " WHERE (e.foreign = 0 OR e.foreign IS NULL) AND e.purchase_date >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH)" : ($scope === 'foreign' ? " WHERE e.foreign = 1" : "")),
			null
		);
		$records_total = isset($total_all_query->row['total']) ? (int)$total_all_query->row['total'] : 0;

		$order_by = $columns[$order_column] ?? 'e.purchase_date';
		if ($order_by === null) {
			$order_by = 'e.purchase_date';
		}

		$query = $this->model->query(
			"SELECT e.*, et.name AS expense_type_name, pt.name AS payment_type_name, c.abbr AS abbr, s.name AS supplier, p.name AS payor, (COALESCE(e.VAT_full, 0) + COALESCE(e.VAT_Exempt, 0) + COALESCE(e.VAT_NT, 0) + COALESCE(e.VAT_T8, 0) + COALESCE(e.VAT_reduced, 0)) AS total_vat FROM `" . DB_PREFIX . "expenses` AS e" . $join_sql . $where_sql .
				" ORDER BY " . $order_by . " " . $order_dir . " LIMIT ?, ?",
			array_merge($params_list, array($start, $length))
		);

		return array(
			'rows' => $query->rows,
			'records_total' => $records_total,
			'records_filtered' => $records_filtered,
		);
	}
}
