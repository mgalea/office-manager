<?php

/**
 * MailController
 */
class MailController extends Controller
{
    private $personModel;
    function __construct()
    {
        parent::__construct();
        $this->commons = new CommonsController();
        /*Intilize User model*/
        $this->personModel = new Person();
    }

    public function sendEmail()
    {
        $mailer = new Mailer();

        /* Set page title */
        $data = $this->commons->getUser();
        $data['addressbook'] = $this->commons->getAddressBook();

        /*Load Language File*/
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/common.php';
        $data['lang']['common'] = $lang;
        require DIR_BUILDER . 'language/' . $data['info']['language'] . '/person.php';
        $data['lang']['person'] = $person;

        $data['page_title'] = $data['lang']['common']['text_send_email'];
        $data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

        $this->view->render('mail/mail_view.tpl', $data);
    }

    /**
     * Mail index method
     * This method will be called on Mail list view
     **/
    public function indexMail()
	{
		if (!$this->commons->hasPermission('mail/view')) {
			Not_foundController::show('403');
			exit();
		}
		$data = $this->url->post('mail');
		if (empty($data['message'])) {
			$data['message'] = '<p>No message content</p>';
		}

		if ($validate_field = $this->validateMailField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid ' . implode(", ", $validate_field) . '!');
			$this->url->redirect('mail');
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('mail');
		}

		$mailer = new Mailer();
		$emailData = $this->commons->getUser();
		$emailData = $emailData['user'];
		/* SMTP authentication username. */
	
		$mailer->mail->Username = $emailData['email'];

		/* SMTP authentication password. */
		$mailer->mail->Password = $emailData['email_password'];

		/* Set the mail sender. */
		$mailer->mail->setFrom($emailData['email'], $emailData['firstname'] . ' ' . $emailData['lastname']);
		$mailer->mail->addReplyTo($emailData['email'], $emailData['firstname'] . ' ' . $emailData['lastname']);
		/*
		$useornot = $mailer->getData();
		if (!$useornot) {
			$mailer->mail->setFrom($info['email'], $info['name']);
		}
		*/

		$mailer->mail->addAddress($data['to'], '');
		if (!empty($data['bcc'])) {
			$mailer->mail->addBCC($data['bcc'], $data['bcc']);
		}
		echo $data['message'];
		$mailer->mail->isHTML(true);
		$mailer->mail->Subject = $data['subject'];
		$mailer->mail->Body = html_entity_decode($data['message']);

		$mailer->sendMail();
		$data['type'] = "person";
		$data['type_id'] = 1;
		$data['user_id'] = $this->session->data['user_id'];

		$this->personModel->emailLog($data);
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Sent successfully.' );
		$this->url->redirect('mail');
    }
    
    private function validateMailField($data)
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateEmail($data['to'])) {
			$error_flag = true;
			$error['to'] = 'Email!';
		}

		if ($this->commons->validateText($data['subject'])) {
			$error_flag = true;
			$error['subject'] = 'Subject!';
		}

		if ($this->commons->validateText($data['message'])) {

			$error_flag = false;
			$error['message'] = 'Message!';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}
}
