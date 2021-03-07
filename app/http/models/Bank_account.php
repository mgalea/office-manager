<?php

/**
 * Banking Model
 */
class Bank_Account extends Model
{
    public function getAccounts()
    {
        $query = $this->model->query("SELECT account.id, account.name as account_name, account.number as account_number, company.name as company, bank.name as bank 
        FROM `" . DB_PREFIX . "bank_accounts` as account 
        INNER JOIN `" . DB_PREFIX . "companies` AS company ON company.id=account.company 
        INNER JOIN `" . DB_PREFIX . "companies` AS bank ON bank.id=account.bank");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getAccount($id)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "bank_accounts` WHERE `id` = ? LIMIT 1", array((int)$id));
        return $query->row;
    }

    public function getAccountTypes()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "bank_account_types` ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getBanks()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "companies`  WHERE `type` = 5 ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getCurrencies()
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "currency` ORDER BY `name` ASC");
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getBankAccountDetails($inv_id)
    {
        $query = $this->model->query("SELECT acc.name as account_name, acc.number as account_number, acc.sort_code as sort_code,
                                        acc.iban,  acc.swift as swift_code, curr.name as currency, curr.abbr as abbr, bank.name as bank_name,
                                        acc.bank_branch as bank_branch, acc.remittance as remittance 
                                        FROM kk_companies as sub, kk_bank_accounts as acc 
                                        INNER JOIN kk_currency as curr ON acc.currency=curr.id 
                                        INNER JOIN kk_companies as bank ON acc.bank=bank.id 
                                        WHERE sub.id=(SELECT company FROM office_manager.kk_invoice where id=?)", array((int)$inv_id));
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function getAccountByCompany($company)
    {
        $query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "bank_account`  WHERE `company` = ? ORDER BY `name` ASC", array((int)$company));
        if ($query->num_rows > 0) {
            return $query->rows;
        } else {
            return '';
        }
    }

    public function createAccount($data)
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
            )
        );

        if ($query->num_rows > 0) {
            return $this->model->last_id();
        } else {
            return 0;
        }
    }

    public function updateAccount($data)
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
        $query = $this->model->query("DELETE FROM `" . DB_PREFIX . "companies` WHERE `id` = ?", array((int)$id));
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
