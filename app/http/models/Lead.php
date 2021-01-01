<?php

/**
* Lead
*/
class Lead extends Model
{
	public function getLeads()
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "leads`");
		return $query->rows;
	}

	public function getLead($id)
	{
		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "leads` WHERE `id` = ? LIMIT 1", array((int)$id));
		return $query->row;
	}

	public function updateLead($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "leads` SET `salutation` = ?, `firstname` = ?, `lastname` = ?, `company` = ?, `email` = ?, `phone` = ?, `website` = ?, `address` = ?, `country` = ?, `remark` = ?, `source` = ?, `status` = ? WHERE `id` = ? ", array($this->model->escape($data['salutation']), $this->model->escape($data['firstname']), $this->model->escape($data['lastname']), $this->model->escape($data['company']), $this->model->escape($data['email']), $this->model->escape($data['phone']), $this->model->escape($data['website']), $data['address'], $this->model->escape($data['country']), $data['remark'], $data['source'], $data['status'], (int)$data['id']));
	}

	public function createLead($data)
	{
		$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "leads` (`salutation`, `firstname`, `lastname`, `company`, `email`, `phone`, `website`, `address`, `country`, `remark`, `source`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($this->model->escape($data['salutation']), $this->model->escape($data['firstname']), $this->model->escape($data['lastname']), $this->model->escape($data['company']), $this->model->escape($data['email']), $this->model->escape($data['phone']), $this->model->escape($data['website']), $data['address'], $this->model->escape($data['country']), $data['remark'], $data['source'], $data['status']));

		if ($query->num_rows > 0) {
			return $this->model->last_id();
		} else {
			return false;
		}
	}

	public function convertLeadToContact($data)
	{
		$query = $this->model->query("SELECT `id` FROM `" . DB_PREFIX . "contacts` WHERE `lead_id` = ?", array((int)$data['id']));
		if ($query->num_rows < 1) {
			
			$query = $this->model->query("INSERT INTO `" . DB_PREFIX . "contacts` (`salutation`, `firstname`, `lastname`, `company`, `email`, `phone`, `website`, `address`, `country`, `remark`, `lead_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($this->model->escape($data['salutation']), $this->model->escape($data['firstname']), $this->model->escape($data['lastname']), $this->model->escape($data['company']), $this->model->escape($data['email']), $this->model->escape($data['phone']), $this->model->escape($data['website']), $data['address'], $this->model->escape($data['country']), $data['remark'], $data['id']));

			if ($query->num_rows > 0) {
				$id = $this->model->last_id();
				$this->model->query("UPDATE `" . DB_PREFIX . "leads` SET `contact_id` = ?, `status` = ? WHERE `id` = ? ", array($id, 6, (int)$data['id']));

				return $id;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function deleteLead($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "leads` WHERE `id` = ?", array((int)$id ));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

}