<?php

/**
 * ClientController
 */
class ClientController extends Controller
{
	private $clientModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->clientModel = new Client();
	}

	public function indexClients()
	{
		if (!$this->commons->hasPermission('clients')) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all User data from DB using User model 
		 **/
		$data['result'] = $this->clientModel->getClients();

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/client.php';
		$data['lang']['client'] = $client;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['client']['text_clients'];

		/*Render User list view*/
		$this->view->render('client/client_list.tpl', $data);
	}
	/**
	 * Client index CLient Edit method
	 * This method will be called on Client Edit view
	 **/
	public function indexClientEdit()
	{
		if (!$this->commons->hasPermission('client/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		 * Check if id exist in url if not exist then redirect to Client list view 
		 **/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('clients');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		 * Get all Client data from DB using Client model 
		 **/
		$data['result'] = $this->clientModel->getClientByID($id);

		if (empty($data['result'])) {
			$this->url->redirect('clients');
		}

		/*Load Language File*/
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER . 'language/' . $data['info']['language'] . '/client.php';
		$data['lang']['client'] = $client;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_edit'] . ' ' . $data['lang']['common']['text_client'];
		$data['action'] = URL . DIR_ROUTE . 'client/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/
		$this->view->render('client/client_form.tpl', $data);
	}
	/**
	 * Client index Client Action method
	 * This method will be called on Client Action view
	 **/
	public function indexClientAction()
	{
		if ((!$this->commons->hasPermission('client/edit'))) {
			Not_foundController::show('403');
			exit();
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->session->data['message'] = array('alert' => 'warning', 'value' => 'Token does not match!');
			$this->url->redirect('clients');
		}

		$data = $this->url->post('client');
		$result = $this->clientModel->updateClient($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Client updated successfully.');
		$this->url->redirect('client/edit&id=' . $data['id']);
	}
	/**
	 * Client index Client Delete method
	 * This method will be called on Client Delete view
	 **/
	public function indexClientDelete()
	{
		if (!$this->commons->hasPermission('client/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->clientModel->deleteClient($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Client deleted successfully.');
		$this->url->redirect('clients');
    }

    public function indexMail()
    {
        if (!$this->commons->hasPermission('client/view')) {
            Not_foundController::show('403');
            exit();
        }
        $data = $this->url->post('mail');

        if ($validate_field = $this->vaildateMailField($data)) {
            $this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
            $this->url->redirect('client/view&id=' . $data['client']);
        }

        if ($this->commons->validateToken($this->url->post('_token'))) {
            $this->url->redirect('client/view&id=' . $data['client']);
        }

        $info = $this->clientModel->getOrganization();

        $mailer = new Mailer();
        $useornot = $mailer->getData();
        if (!$useornot) {
            $mailer->mail->setFrom($info['email'], $info['name']);
        }

        $mailer->mail->addAddress($data['to'], $data['name']);
        if (!empty($data['bcc'])) {
            $mailer->mail->addBCC($data['bcc'], $data['bcc']);
        }

        $mailer->mail->isHTML(true);
        $mailer->mail->Subject = $data['subject'];
        $mailer->mail->Body = html_entity_decode($data['message']);

        $mailer->sendMail();
        $data['type'] = "client";
        $data['type_id'] = $data['client'];
        $data['user_id'] = $this->session->data['user_id'];

        $this->clientModel->emailLog($data);
        $this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Sent successfully.');
        $this->url->redirect('client/view&id=' . $data['client']);
    }
    /**
     * Validate Field Method
     * This method will be called on to validate invoice field
     **/
    private function vaildateMailField($data)
    {
        $error = [];
        $error_flag = false;

        if ($this->commons->validateText($data['to'])) {
            $error_flag = true;
            $error['to'] = 'Email!';
        }

        if ($this->commons->validateText($data['subject'])) {
            $error_flag = true;
            $error['subject'] = 'Subject!';
        }

        if ($this->commons->validateText($data['message'])) {
            $error_flag = true;
            $error['message'] = 'Message!';
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
    /**
     * Client validate field method
     * This method will be called for validate input field
     **/
    public function validateField()
    {
        $error = [];
        $error_flag = false;

        if ($this->commons->validateText($this->url->post('client')['company'])) {
            $error_flag = true;
            $error['author'] = 'Item Rate!';
        }

        if ($error_flag) {
            return $error;
        } else {
            return false;
        }
    }
    /**
     * Client index Client method
     * This method will be called on Client list view
     **/
}
