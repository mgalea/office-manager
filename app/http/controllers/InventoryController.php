<?php

/**
 * Inventory Controller
 */
class InventoryController extends Controller
{
    private $inventoryModel;
    function __construct()
    {
        parent::__construct();
        $this->commons = new CommonsController();
        /*Intilize User model*/
        $this->inventoryModel = new Inventory();
    }

    /**
     * Item index method
     * This method will be called on Inventory Items list view
     **/
    public function index()
    {
        if (!$this->commons->hasPermission('inventory')) {
            Not_foundController::show('403');
            exit();
        }

        /*Get User name and role*/
        $data = $this->commons->getUser();

        /*Load Language File*/
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
        $data['lang']['common'] = $lang;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/settings.php';
        $data['lang']['settings'] = $settings;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/inventory.php';
        $data['lang']['inventory'] = $inventory;

        /**
         * Get all User data from DB using User model 
         **/

        $data['result'] = $this->inventoryModel->getInventory();

        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }
        /* Set page title */
        $data['page_title'] = $data['lang']['common']['text_inventory'];

        /*Render User list view*/
        $this->view->render('inventory/inventory_list.tpl', $data);
    }

    /**
     * Inventory index ADD method
     * This method will be called on Inventory ADD view
     **/
    public function indexAdd()
    {
        if (!$this->commons->hasPermission('inventory')) {
            Not_foundController::show('403');
            exit();
        }
        /*Get User name and role*/
        $data = $this->commons->getUser();

        /*Load Language File*/
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
        $data['lang']['common'] = $lang;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/settings.php';
        $data['lang']['settings'] = $settings;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/inventory.php';
        $data['lang']['inventory'] = $inventory;

        /**
         * Get all Inventory data from DB using Inventory model 
         **/

        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }
        $data['result'] = NULL;
        $data['type'] = $this->inventoryModel->getInventoryTypes();
        $data['location'] = $this->inventoryModel->getLocationTypes();
        $data['record'] = ($this->inventoryModel->getNextID());

        /* Set page title */
        $data['page_title'] = $data['lang']['settings']['text_new_inventory_item'];
        $data['action'] = URL . DIR_ROUTE . 'inventory/action';
        $data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

        /*Render User list view*/
        $this->view->render('inventory/inventory_form.tpl', $data);
    }
    /**
     * Item index Edit method
     * This method will be called on Inventory Item Edit view
     **/
    public function indexEdit()
    {
        if (!$this->commons->hasPermission('inventory')) {
            Not_foundController::show('403');
            exit();
        }
        /**
         * Check if id exist in url if not exist then redirect to Item list view 
         **/
        $id = (int)$this->url->get('id');
        if (empty($id) || !is_int($id)) {
            $this->url->redirect('inventory');
        }
        /*Get User name and role*/
        $data = $this->commons->getUser();

        /*Load Language File*/
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
        $data['lang']['common'] = $lang;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/settings.php';
        $data['lang']['settings'] = $settings;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/inventory.php';
        $data['lang']['inventory'] = $inventory;

        /**
         * Get all Inventory data from DB using Inventory model 
         **/

        $data['result'] = $this->inventoryModel->getInventoryItem($id);

        if (empty($data['result'])) {
            $this->url->redirect('inventory');
        }

        $data['type'] = $this->inventoryModel->getInventoryTypes();
        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }

        $data['location'] = $this->inventoryModel->getLocationTypes();
        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }

        $data['documents'] = $this->inventoryModel->getDocuments($id);
        /* Set page title */
        $data['page_title'] = $data['lang']['settings']['text_edit_inventory_item'];
        $data['action'] = URL . DIR_ROUTE . 'inventory/action';
        $data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

        /*Render User list view*/
        $this->view->render('inventory/inventory_form.tpl', $data);
    }

    /**
     * Inventory index Action method
     * This method will be called on Inventory Item Save or Inventory Update view
     **/
    public function indexAction()
    {
        if (!$this->commons->hasPermission('')) {
            Not_foundController::show('403');
            exit();
        }
        /**
         * Check if from is submitted or not 
         **/
        if (!isset($_POST['submit'])) {
            $this->url->redirect('inventory');
            exit();
        }
        /**
         * Validate form data
         * If some data is missing or data does not match pattern
         * Return to info view 
         **/
        if ($validate_field = $this->validateField()) {
            $this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter a valid ' . implode(" and ", $validate_field) . '!');
            $this->url->redirect('inventory/add');
        }

        if ($this->commons->validateToken($this->url->post('_token'))) {
            $this->url->redirect('inventory/add');
        }

        if (!empty($this->url->post('id'))) {
            $data = $this->url->post;
            $data['purchase_date'] = date_format(date_create($data['purchase_date']), 'Y-m-d');

            $result = $this->inventoryModel->updateInventoryItem($data);
            $this->session->data['message'] = array('alert' => 'success', 'value' => 'Inventory item updated successfully.');
            $this->url->redirect('inventory/edit&id=' . $this->url->post('id'));
        } else {
            $data = $this->url->post;
            $data['purchase_date'] = date_format(date_create($data['purchase_date']), 'Y-m-d');
            $result = $this->inventoryModel->createInventoryItem($data);
            if ($result > 0) {
                $this->session->data['message'] = array('alert' => 'success', 'value' => 'Inventory item created successfully.');
                $this->url->redirect('inventory');
            } else {
                $this->session->data['message'] = array('alert' => 'error', 'value' => 'Inventory item failed to create.');
                $this->url->redirect('inventory/edit&id=' . $result);
            }
        }
    }

    /**
     * Item index Delete method
     * This method will be called on Item Delete view
     **/
    public function indexDelete()
    {
        if (!$this->commons->hasPermission('inventory')) {
            Not_foundController::show('403');
            exit();
        }

        $result = $this->inventoryModel->deleteInventoryItem($this->url->post('id'));
        $this->session->data['message'] = array('alert' => 'success', 'value' => 'Inventory Item deleted successfully.');
        $this->url->redirect('inventory');
    }
    /**
     * Item validate method
     * This method will be called to validate input field 
     **/
    public function validateField()
    {
        $error = [];
        $error_flag = false;

        if ($this->commons->validateText($this->url->post('item'))) {
            $error_flag = true;
            $error['title1'] = 'Item Name!';
        }

        if (($this->url->post('type')) == '0') {
            $error_flag = true;
            $error['title2'] = 'Category';
        }

        if (($this->url->post('location')) == '0') {
            $error_flag = true;
            $error['title3'] = 'Location';
        }

        if (($this->inventoryModel->getItemInvNumber($this->url->post('inv_number')) > 0) && (null == ($this->url->post('id')))) {
            $error_flag = true;
            $error['title4'] = 'inventory Number (already exists)';
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
}
