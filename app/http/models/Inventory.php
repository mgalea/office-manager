<?php

/**
 * Inventory
 */
class Inventory extends Model
{
    public function getInventory()

    {
        $query = $this->model->query("SELECT ". DB_PREFIX ."inventory.id,inv_number,item, quantity, ". DB_PREFIX ."inventory_type.name AS type, ". DB_PREFIX ."location_type.name AS location FROM ". DB_PREFIX ."inventory, ". DB_PREFIX ."location_type,". DB_PREFIX ."inventory_type 
        WHERE ". DB_PREFIX ."location_type.id=". DB_PREFIX ."inventory.type AND ". DB_PREFIX ."inventory_type.id=". DB_PREFIX ."inventory.type");

        //$query = $this->model->query("SELECT `id`, `inv_number`, `item`, `description` FROM `" . DB_PREFIX . "inventory`");
        return $query->rows;
    }

    public function getInventoryItem($id)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "inventory` WHERE `id` = ? LIMIT 1", array((int)$id));
        return $query->row;
    }

    public function getInventoryTypes()
    {
        $query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "inventory_type`");
        return $query->rows;
    }

    public function getLocationTypes()
    {
        $query = $this->model->query("SELECT `id`, `name` FROM `" . DB_PREFIX . "location_type`");
        return $query->rows;
    }

    public function updateInventoryItem($data)
    {
        if (!isset($data['stock'])) {
            $data['stock'] = 0;
        } 

        $query = $this->model->query(
            "UPDATE `" . DB_PREFIX . "inventory` SET `item` = ?, `location` = ?, `inv_number` = ?, 
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

    public function createInventoryItem($data)
    {
        if (!isset($data['stock'])) {
            $data['stock'] = 0;
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
            return false;
        }
    }

    public function deleteInventoryItem($id)
    {
        $query = $this->model->query("DELETE FROM `" . DB_PREFIX . "inventory` WHERE `id` = ?", array((int)$id));
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
