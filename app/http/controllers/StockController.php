<?php

/**
 * Stock Controller
 */
class StockController extends Controller
{
    private $stockModel;
    function __construct()
    {
        parent::__construct();
        $this->commons = new CommonsController();
        /*Intilize User model*/
        $this->stockModel = new Stock();
    }

    /**
     * Item index method
     * This method will be called on Stock Items list view
     **/
    public function index()
    {
        if (!$this->commons->hasPermission('companies')) {
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
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/stock.php';
        $data['lang']['stock'] = $stock;

        /**
         * Get all User data from DB using User model 
         **/

        $data['result'] = $this->stockModel->getStock();

        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }
        /* Set page title */
        $data['page_title'] = $data['lang']['common']['text_stock'];

        /*Render User list view*/
        $this->view->render('stock/stock_list.tpl', $data);
    }

    /**
     * Stock index ADD method
     * This method will be called on Stock ADD view
     **/
    public function indexAdd()
    {
        if (!$this->commons->hasPermission('companies')) {
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
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/stock.php';
        $data['lang']['stock'] = $stock;

        /**
         * Get all Stock data from DB using Stock model 
         **/

        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }
        $data['result'] = NULL;
        $data['type'] = $this->stockModel->getStockTypes();
        $data['location'] = $this->stockModel->getLocationTypes();
        $data['record'] = ($this->stockModel->getNextID());

        /* Set page title */
        $data['page_title'] = $data['lang']['settings']['text_new_stock_item'];
        $data['action'] = URL . DIR_ROUTE . 'stock/action';
        $data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

        /*Render User list view*/
        $this->view->render('stock/stock_form.tpl', $data);
    }
    /**
     * Item index Edit method
     * This method will be called on Stock Item Edit view
     **/
    public function indexEdit()
    {
        if (!$this->commons->hasPermission('companies')) {
            Not_foundController::show('403');
            exit();
        }
        /**
         * Check if id exist in url if not exist then redirect to Item list view 
         **/
        $id = (int)$this->url->get('id');
        if (empty($id) || !is_int($id)) {
            //$this->url->redirect('stock');
        }
        /*Get User name and role*/
        $data = $this->commons->getUser();

        /*Load Language File*/
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
        $data['lang']['common'] = $lang;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/settings.php';
        $data['lang']['settings'] = $settings;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/stock.php';
        $data['lang']['stock'] = $stock;

        /**
         * Get all Stock data from DB using Stock model 
         **/

        $data['result'] = $this->stockModel->getStockItem($id);

        if (empty($data['result'])) {
            $this->url->redirect('stock');
        }

        $data['type'] = $this->stockModel->getStockTypes();
        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }

        $data['location'] = $this->stockModel->getLocationTypes();
        /* Set confirmation message if page submitted before */
        if (isset($this->session->data['message'])) {
            $data['message'] = $this->session->data['message'];
            unset($this->session->data['message']);
        }

        $data['documents'] = $this->stockModel->getDocuments($id);
        $data['record'] = ($this->stockModel->getNextID());
        /* Set page title */
        $data['page_title'] = $data['lang']['settings']['text_edit_stock_item'];
        $data['action'] = URL . DIR_ROUTE . 'stock/action';
        $data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

        /*Render User list view*/
        $this->view->render('stock/stock_form.tpl', $data);
    }

    /**
     * Stock index Action method
     * This method will be called on Stock Item Save or Stock Update view
     **/
    public function indexAction()
    {
        if (!$this->commons->hasPermission('companies')) {
            Not_foundController::show('403');
            exit();
        }
        /**
         * Check if from is submitted or not 
         **/
        if (!isset($_POST['submit'])) {
            $this->url->redirect('stock');
            exit();
        }

        /**
         * Validate form data
         * If some data is missing or data does not match pattern
         * Return to info view 
         **/
        if ($validate_field = $this->validateField()) {
            $this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter a valid ' . implode(" and ", $validate_field) . '!');
            $this->url->redirect('stock/add');
        }

        if ($this->commons->validateToken($this->url->post('_token'))) {
            $this->url->redirect('stock/add');
        }

        if (!empty($this->url->post('id'))) {
            $result = $this->stockModel->updateStockItem($this->url->post);
            $this->session->data['message'] = array('alert' => 'success', 'value' => 'Stock item updated successfully.');
            $this->url->redirect('stock/edit&id=' . $this->url->post('id'));
        } else {
            $result = $this->stockModel->createStockItem($this->url->post);
            if ($result > 0) {
                $this->session->data['message'] = array('alert' => 'success', 'value' => 'Stock item created successfully.');
                $this->url->redirect('stock/edit&id=' . $result);
            } else {
                $this->session->data['message'] = array('alert' => 'error', 'value' => 'Stock item failed to create.');
                $this->url->redirect('stock/edit&id=' . $result);
            }
        }
    }

    /**
     * Item index Delete method
     * This method will be called on Item Delete view
     **/
    public function indexDelete()
    {
        if (!$this->commons->hasPermission('companies')) {
            Not_foundController::show('403');
            exit();
        }

        $result = $this->stockModel->deleteStockItem($this->url->post('id'));
        $this->session->data['message'] = array('alert' => 'success', 'value' => 'Stock Item deleted successfully.');
        $this->url->redirect('stock');
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

        if (($this->stockModel->getItemInvNumber($this->url->post('inv_number')) > 0) && (null == ($this->url->post('id')))) {
            $error_flag = true;
            $error['title4'] = 'stock Number (already exists)';
        }

        if ($this->commons->validateDate($this->url->post('purchase_date'))) {
            $error_flag = true;
            $error['title5'] = 'Item Purchase Date! ' . $this->url->post('purchase_date');
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
}
