<?php

/**
 * COmpany Model
 */
class Company extends Model
{
    public function getCompanies()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies`");
        return $query->rows;
    }

    public function getCompany($id)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies` WHERE `id` = ? LIMIT 1", array((int)$id));
        return $query->row;
    }

    public function createInventoryItem($data)
    {
        if (!isset($data['stock'])) {
            $data['stock'] = 0;
        }
        if (!isset($data['stored'])) {
            $data['stored'] = 'Unknown Location';
        }

        $query = $this->model->query(
            "INSERT INTO `" . DB_PREFIX . "inventory` (`item`, `location`, `inv_number`, `type`, `storage`,  
            `description`, `purchase_date`,`is_stock`, `quantity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            array(
                $data['item'], (int)$data['location'], (int)$data['inv_number'],
                (int)$data['type'], $data['stored'], $data['description'],
                $data['purchase_date'], (bool)$data['stock'], (int)$data['quantity']
            )
        );

        if ($query->num_rows > 0) {
            return $this->model->last_id();
        } else {
            return 0;
        }
    }


    public function createCompany($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        $query = $this->model->query(
            "INSERT INTO `" . DB_PREFIX . "companies` (`name`, `reg_no`,`address`,`vat_no`,`date_formed`,`description`,`status`,`website`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            array(
                    $this->model->escape($data['name']), $data['reg_no'], $data['address'], $data['vat_no'],
                    $data['date_formed'], $this->model->escape($data['description']), (int)$data['status'], $this->model->escape($data['website'])
        ));

        if ($query->num_rows > 0) {
            return $this->model->last_id();
        } else {
            return 0;
        }
    }
    /* 'Random', 1, "{}", 123, "2020-10-01", "hello", 1, "www.rng.com"
    
        )*/

    public function updateCompany($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 1;
        }

        $query = $this->model->query(
            "UPDATE `" . DB_PREFIX . "companies` SET `name`=?, `reg_no`=?, `address` = ?, `vat_no` = ?, `website`=?, `description`=?, `date_formed`=? WHERE `id` = ? ",
            array(
                $data['name'],
                $data['reg_no'],
                $data['address'],
                $data['vat_no'],
                $this->model->escape($data['website']),
                $data['description'],
                $this->model->escape($data['date_formed']),
                (int)$data['id'],
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
