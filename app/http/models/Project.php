<?php

/**
* Project
*/
class Project extends Model
{
	public function getProjects()
	{
		$query = $this->model->query("SELECT p.id, p.name, p.customer, p.description, p.completed, p.date_of_joining, c.company FROM `" . DB_PREFIX . "projects` AS p LEFT JOIN `" . DB_PREFIX . "contacts` AS c ON c.id = p.customer ORDER BY p.date_of_joining DESC");
		return $query->rows;
	}

	public function getCustomers()
	{
		$query = $this->model->query("SELECT `id`, `company` FROM `" . DB_PREFIX . "contacts`");
		return $query->rows;
	}

	public function getCurrency()
	{
		$query = $this->model->query("SELECT `id`, `name`, `abbr` FROM `" . DB_PREFIX . "currency` WHERE `status` = ?", array(1));
		return $query->rows;
	}

	public function getStaff()
	{
		$query = $this->model->query("SELECT `user_id`, CONCAT ( firstname, ' ', lastname ) AS `name`, `email` FROM `" . DB_PREFIX . "users`");
		return $query->rows;
	}

	public function getProject($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "projects` WHERE `id` = ? LIMIT 1", array((int)$id));
		return $query->row;
	}

	public function getDocuments($id)
	{
		$query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('project', $id));
		return $query->rows;
	}

	public function getComments($id)
	{
		$query = $this->model->query("SELECT c.*, CONCAT ( u.firstname, ' ', u.lastname ) AS `user` FROM `" . DB_PREFIX . "comments` AS c LEFT JOIN `" . DB_PREFIX . "users` AS u ON u.user_id = c.comment_by WHERE c.to_id = ? AND c.comment_to = ? ORDER BY c.date_of_joining DESC", array((int)$id, "project"));
		return $query->rows;
	}

	public function updateProject($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "projects` SET `name` = ?, `description` = ?, `customer` = ?, `billing_method` = ?, `currency` = ?, `rate_hour` = ?, `project_hour` = ?, `total_cost` = ?, `staff` = ?, `task` = ?, `completed` = ?, `start_date` = ?, `due_date` = ? WHERE `id` = ? ", array($this->model->escape($data['name']), $data['description'], (int)$data['customer'], (int)$data['billingmethod'], (int)$data['currency'], (int)$data['ratehour'], (int)$data['projecthour'], (int)$data['totalcost'], $data['staff'], $data['task'], $data['completed'], $data['start_date'], $data['due_date'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function createProject($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "projects` (`name`, `description`, `customer`, `billing_method`, `currency`, `rate_hour`, `project_hour`, `total_cost`, `staff`, `task`, `completed`, `start_date`, `due_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($this->model->escape($data['name']), $data['description'], (int)$data['customer'], (int)$data['billingmethod'], (int)$data['currency'], (int)$data['ratehour'], (int)$data['projecthour'], (int)$data['totalcost'], $data['staff'], $data['task'], $data['completed'], $data['start_date'], $data['due_date']));
		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function createComment($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "comments` (`comment`, `comment_by`, `comment_to`, `to_id`) VALUES (?, ?, ?, ?)", array($data['comment'], (int)$data['comment_by'], $data['comment_to'], (int)$data['id']));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteProject($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "projects` WHERE `id` = ?", array((int)$id ));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
}