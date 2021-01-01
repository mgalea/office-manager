<?php

/**
* Profile
*/
class Profile extends Model
{
	public function updateProfile($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "clients` SET `name` = ?, `mobile` = ? WHERE `id` = ? AND `email` = ?", array($this->model->escape($data['name']), $this->model->escape($data['mobile']), (int)$data['id'], $this->model->escape($data['email'])));
		if ($this->model->error()) {
			return $this->model->error();
		} else {
			return true;
		}
	}

	public function updatePassword($data)
	{
		$query = $this->model->query("UPDATE `" . DB_PREFIX . "clients` SET `password` = ? WHERE `id` = ? AND `email` = ?" , array($this->model->escape($data['password']), (int)$data['id'], $this->model->escape($data['email'])));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserData($data)
	{
		 $query = $this->model->query("SELECT `password` FROM `" . DB_PREFIX . "clients` WHERE `id` = ? AND `email` = ? LIMIT 1", array($this->model->escape($data['id']), $this->model->escape($data['email'])));
		if ($query->num_rows > 0) {
			return  $query->row['password'];
		} else {
			return false;
		}
	}
}