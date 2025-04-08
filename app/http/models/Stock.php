<?php

/**
 * Stock
 */
class Stock extends Model
{
    public function getStock()

    {
        $query = $this->model->query("SELECT " . DB_PREFIX . "Stock.id, inv_number, item, quantity, " . DB_PREFIX . "Stock_type.name AS type, " . DB_PREFIX . "location_type.name AS location FROM " . DB_PREFIX . "Stock, " . DB_PREFIX . "location_type," . DB_PREFIX . "Stock_type 
        WHERE " . DB_PREFIX . "location_type.id=" . DB_PREFIX . "Stock.location AND " . DB_PREFIX . "Stock_type.id=" . DB_PREFIX . "Stock.type ORDER BY inv_number");

        //$query = $this->model->query("SELECT `id`, `inv_number`, `item`, `description` FROM `" . DB_PREFIX . "Stock`");
        return $query->rows;
    }

    public function getStockItem($id)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "Stock` WHERE `id` = ? LIMIT 1", array((int)$id));
        return $query->row;
    }

    public function getStockTypes()
    {
        $query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "Stock_type`");
        return $query->rows;
    }

    public function getLocationTypes()
    {
        $query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "location_type`");
        return $query->rows;
    }

    public function getNextID()
    {
        $query = $this->model->query("SELECT MAX(id)+1 AS next_id FROM `" . DB_PREFIX . "Stock`");

        if ($query->num_rows > 0) {
            return $query->row;
        } else {
            return 0;
        }
    }

    public function getItemInvNumber($id)
    {
        $query = $this->model->query("SELECT `id`, `item` FROM `" . DB_PREFIX . "Stock` WHERE `inv_number` = ? LIMIT 1", array((int)$id));
        return $query->num_rows;
    }

    public function updateStockItem($data)
    {
        if (!isset($data['stock'])) {
            $data['stock'] = 0;
        }

        $query = $this->model->query(
            "UPDATE `" . DB_PREFIX . "Stock` SET `item` = ?, `location` = ?, `inv_number` = ?, 
        `type` = ?, `storage` = ?, `description` = ?, `purchase_date` = ? ,
         `is_stock` = ?, `quantity` = ? WHERE `id` = ? ",
            array(
                $data['item'], (int)$data['location'], (int)$data['inv_number'],
                (int)$data['type'], $data['stored'], $data['description'],
                $data['purchase_date'], (bool)$data['stock'], (int)$data['quantity'], (int)$data['id']
            )
        );
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createStockItem($data)
    {
        if (!isset($data['stock'])) {
            $data['stock'] = 0;
        }
        if (!isset($data['stored'])) {
            $data['stored'] = 'Unknown Location';
        }

        $query = $this->model->query(
            "INSERT INTO `" . DB_PREFIX . "Stock` (`item`, `location`, `inv_number`, `type`, `storage`,  
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

    public function deleteStockItem($id)
    {
        $query = $this->model->query("DELETE FROM `" . DB_PREFIX . "Stock` WHERE `id` = ?", array((int)$id));
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getDocuments($id)
    {
        $query = $this->model->query("SELECT `id`, `file_name` FROM `" . DB_PREFIX . "attached_files` WHERE `file_type` = ? AND `file_type_id` = ?", array('Stock', $id));
        return $query->rows;
    }
}
