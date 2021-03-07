<?php

/**
 * Company Model
 */
class Company extends Model
{
    public function getCompanies()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` ORDER BY `name` ASC");
        return $query->rows;
    }

    public function getCompany($id)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` WHERE `id` = ? LIMIT 1", array((int)$id));
        return $query->row;
    }

    public function getCompanyTypes()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "company_type` ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getActivityTypes()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "primary_activity_type` ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }


    public function getCompanyByType($type)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies`  WHERE `type` = ? ORDER BY `name` ASC", array((int)$type));
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getSubsidiaries()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies`  WHERE `type` = 2 ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getSuppliers()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies`  WHERE `type` = 1 OR `type`= 5 ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function createCompany($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        $query = $this->model->query(
            "INSERT INTO `" . DB_PREFIX . "companies` (`name`, `reg_no`,`address`,`postal_address`,`vat_no`,`formation_date`,
            `description`,`status`,`type`,`activity`,`phone`,`email`,`website`,`short_name`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            array(
                    $data['name'], 
                    $data['reg_no'], 
                    $data['address'],
                    $data['postal_address'], 
                    $data['vat_no'],
                    $data['formation_date'],
                    $data['description'], 
                    $data['status'],
                    $data['type'],
                    $data['activity'], 
                    $data['phone'], 
                    $data['email'], 
                    $this->model->escape($data['website']), 
                    $data['short_name'] 
        ));

        if ($query->num_rows > 0) {
            return $this->model->last_id();
        } else {
            return 0;
        }
    }

    public function updateCompany($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        $query = $this->model->query(
            "UPDATE `" . DB_PREFIX . "companies` SET `name`=?,`short_name`=?, `reg_no`=?, `address` = ?, `postal_address` = ?, `vat_no` = ?, `website`=?, 
            `description`=?, `type`=?,`activity`=?,`phone`=?,`email`=?,`formation_date`=?,`status`=? WHERE `id` = ? ",
            array(
                $data['name'],
                $data['short_name'],
                $data['reg_no'],
                $data['address'],
                $data['postal_address'],
                $data['vat_no'],
                $this->model->escape($data['website']),
                $data['description'],
                $data['type'],
                $data['activity'],
                $data['phone'],
                $data['email'],
                $data['formation_date'],
                (int)$data['status'],
                (int)$data['id']
            )
        );
        if ($query->num_rows > 0) {
            return $this->model->last_id();
        } else {
            return 0;
        }
    }

    public function deleteCompany($id)
	{
		$query = $this->model->query("DELETE FROM `" . DB_PREFIX . "companies` WHERE `id` = ?", array((int)$id ));
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function getDocuments($id)
    {
        $query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('company', $id));
        return $query->rows;
    }
}
