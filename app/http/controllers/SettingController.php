<?php

/**
* SettingController
*/
class SettingController extends Controller
{
	private $settingModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->settingModel = new Setting();
	}

	/**
	* Calendar index method
	* This method will be called on Calendar view
	**/
	public function index()
	{
		$this->commons->isAdmin();

		$name = $this->url->get('page');

		$result = $this->settingModel->getSettings($name);

		if (empty($result)) {
			Not_foundController::show('403');
			exit();
		}

		/*Get User name and role*/
		$data = $this->commons->getUser();
		
		$data['result']['data'] = json_decode($result['data'], true);
		$data['result']['status'] = $result['status'];
		$data['result']['name'] = $result['name'];
 		
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/* Set Page title and action */
		$data['action'] = URL.DIR_ROUTE.'setting/action';
		$data['test_action'] = URL.DIR_ROUTE.'setting/test-email';
		
		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/settings.php';
		$data['lang']['settings'] = $settings;
		
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		/*Render Calendar list view*/
		$this->view->render('setting/'.$name.'.tpl', $data);
	}

	public function indexTestEmail()
	{
		$this->commons->isAdmin();

		if (!isset($_POST['test-email'])) {
			Not_foundController::show('404');
			exit();
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('setting&page=emailsetting');
		}

		$to = $this->url->post('test_email');
		if ($this->commons->validateEmail($to)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid Email Address!');
			$this->url->redirect('setting&page=emailsetting');
		}

		$info = $this->commons->getInfo();
		$mailer = new Mailer();
		$useornot = $mailer->getData('emailsetting');

		$this->logEmailTest('Test email requested to ' . $to . '. SMTP enabled: ' . ($useornot ? 'yes' : 'no') . '.');
		$setting = $this->settingModel->getSettings('emailsetting');
		if (!empty($setting)) {
			$smtp = json_decode($setting['data'], true);
			$details = array(
				'host' => isset($smtp['host']) ? $smtp['host'] : '',
				'port' => isset($smtp['port']) ? $smtp['port'] : '',
				'encryption' => isset($smtp['encryption']) ? $smtp['encryption'] : '',
				'authentication' => isset($smtp['authentication']) ? $smtp['authentication'] : ''
			);
			$this->logEmailTest('SMTP settings: ' . json_encode($details));
		}
		if (!$useornot) {
			$mailer->mail->setFrom($info['email'], $info['name']);
		}
		$mailer->mail->addAddress($to, $to);
		$mailer->mail->isHTML(true);
		$mailer->mail->Subject = 'Test Email';
		$mailer->mail->Body = 'This is a test email from ' . $info['name'] . '.';

		if ($mailer->sendMail()) {
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Test email sent successfully.');
			$this->logEmailTest('Test email sent successfully.');
		} else {
			$error = $mailer->lastError;
			if (empty($error) && !empty($mailer->mail->ErrorInfo)) {
				$error = $mailer->mail->ErrorInfo;
			}
			$message = 'Test email could not be sent.';
			if (!empty($error)) {
				$message .= ' ' . $error;
			}
			$this->logEmailTest('Test email failed. ' . $message);
			$this->session->data['message'] = array('alert' => 'error', 'value' => $message);
		}

		$this->url->redirect('setting&page=emailsetting');
	}

	private function logEmailTest($message)
	{
		$logFile = DIR . 'error.log';
		$line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
		file_put_contents($logFile, $line, FILE_APPEND);
	}

	public function indexAction()
	{
		$this->commons->isAdmin();

		/**
		* Check if from is submitted or not 
		**/
		if (!isset($_POST['submit'])) {
			Not_foundController::show('404');
			exit();
		}


		$data['setting'] = $this->url->post('name');

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('setting&page=' . $data['setting']);
		}
		
		if ($data['setting'] == "emailsetting") {
			$data['data'] = $this->url->post('smtp');	
			$data['encryption'] = isset($data['encryption']) ? $data['encryption'] : 0;
			$data['encryption'] = isset($data['authentication']) ? $data['authentication'] : 0;
			$data['status'] = $this->url->post('status');

			if ($validate_field = $this->validateSMTPField($data['data'])) {
				$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid '.implode(", ",$validate_field).'!');
				$this->url->redirect('setting&page='.$data['setting']);
			}
			$data['data'] = json_encode($data['data']);

			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Setting updated successfully.');
		} elseif ($data['setting'] == "recurring") {
			$data['data'] = json_encode(rand(10000000,999999999));
			$data['status'] = 1;
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Setting updated successfully.');
		} else {
			$this->url->redirect('dashboard');
		}

		$result = $this->settingModel->updateSetting($data);
		$this->url->redirect('setting&page='.$data['setting']);
	}

	protected function validateSMTPField($data)
	{
		$error = [];
		$error_flag = false;

		if ($this->commons->validateEmail($data['fromemail'])) {
			$error_flag = true;
			$error['subject'] = 'From Email';
		}

		if ($this->commons->validateText($data['fromname'])) {
			$error_flag = true;
			$error['template'] = 'From Name';
		}

		if (!empty($data['reply'])) {
			if ($this->commons->validateEmail($data['reply'])) {
				$error_flag = true;
				$error['message'] = 'Reply Email Address';
			}
		}

		if ($this->commons->validateText($data['host'])) {
			$error_flag = true;
			$error['message'] = 'SMTP Host';
		}

		if ($this->commons->validateNumber($data['port'])) {
			$error_flag = true;
			$error['message'] = 'SMTP Port';
		}

		if ($this->commons->validateText($data['username'])) {
			$error_flag = true;
			$error['message'] = 'SMTP Username';
		}

		if ($this->commons->validateText($data['password'])) {
			$error_flag = true;
			$error['message'] = 'SMTP Password';
		}

		if ($error_flag) {
			return $error;
		} else {
			return false;
		}
	}

	public function databaseBackup()
	{
		$this->commons->isAdmin();
		$content = $this->settingModel->DBdump();

		// Save the SQL script to a backup file
		$backup_file_name = 'OM_backup_' . time() . '.sql';
		$fileHandler = fopen($backup_file_name, 'w+');
		$number_of_lines = fwrite($fileHandler, $content);
		fclose($fileHandler); 

    	// Download the SQL backup file to the browser
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($backup_file_name));
		ob_clean();
		flush();
		readfile($backup_file_name);
		exec('rm ' . $backup_file_name);

		exit();

		
	}
}
