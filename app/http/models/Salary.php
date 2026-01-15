<?php
/**
 * Salary Model
 */
class Salary extends Model
{
	public function getSalaries()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "salaries` ORDER BY `month_paye` DESC, `id` DESC");
		return $query->rows;
	}

	public function getSalary($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "salaries` WHERE `id` = ? LIMIT 1", array((int)$id));
		return $query->row;
	}

	public function createSalary($data)
	{
		$columns = $this->getSalaryColumns();
		$payload = $this->filterSalaryPayload($data, $columns);

		if (empty($payload)) {
			return false;
		}

		$fields = array_keys($payload);
		$placeholders = implode(', ', array_fill(0, count($fields), '?'));
		$values = $this->prepareValues($payload);

		$query = $this->model->query(
			"INSERT INTO `" . DB_PREFIX . "salaries` (`" . implode("`, `", $fields) . "`) VALUES (" . $placeholders . ")",
			$values
		);

		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function updateSalary($data)
	{
		if (empty($data['id'])) {
			return false;
		}

		$columns = $this->getSalaryColumns();
		$payload = $this->filterSalaryPayload($data, $columns);
		unset($payload['id']);

		if (empty($payload)) {
			return false;
		}

		$set = implode(', ', array_map(function ($column) {
			return "`" . $column . "` = ?";
		}, array_keys($payload)));

		$values = $this->prepareValues($payload);
		$values[] = (int)$data['id'];

		$query = $this->model->query(
			"UPDATE `" . DB_PREFIX . "salaries` SET " . $set . " WHERE `id` = ?",
			$values
		);

		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteSalary($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "salaries` WHERE `id` = ?", array((int)$id));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	private function getSalaryColumns()
	{
		$query = $this->model->query("SHOW COLUMNS FROM `" . DB_PREFIX . "salaries`");
		$columns = array();
		if (!empty($query->rows)) {
			foreach ($query->rows as $row) {
				if (isset($row['Field'])) {
					$columns[] = $row['Field'];
				}
			}
		}
		return $columns;
	}

	private function filterSalaryPayload($data, $columns)
	{
		$payload = array();
		foreach ($data as $key => $value) {
			if (in_array($key, $columns, true)) {
				$payload[$key] = $value;
			}
		}
		return $payload;
	}

	private function prepareValues($payload)
	{
		$values = array();
		foreach ($payload as $value) {
			if ($value === null) {
				$values[] = null;
			} else {
				$values[] = $this->model->escape($value);
			}
		}
		return $values;
	}
}
