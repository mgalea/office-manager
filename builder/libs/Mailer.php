<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
//require DIR_BUILDER.'libs/vendor/autoload.php';

require DIR_BUILDER . 'libs/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require DIR_BUILDER . 'libs/vendor/phpmailer/phpmailer/src/Exception.php';
require DIR_BUILDER . 'libs/vendor/phpmailer/phpmailer/src/SMTP.php';

/**
 * Phpmailer Class
 */
class Mailer
{
	public $mail;
	public function __construct()
	{
		$this->mail = new PHPMailer(TRUE);
		if (defined('SMTP_HOST') && defined('SMTP_PORT')) {
			if (!empty(DB_HOSTNAME) || !empty(SMTP_PORT)) {
				$this->mail->isSMTP();
				$this->mail->Host = SMTP_HOST;
				$this->mail->SMTPAuth = TRUE;
				$this->mail->SMTPSecure = 'tls';
				$this->mail->Port = SMTP_PORT;
				$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
				// Send using SMTP
			}
		}
	}

	public function sendMail()
	{
		try {
			/* Finally send the mail. */
			$result=$this->mail->send();
		} catch (Exception $e) {
			/* PHPMailer exception. */
			//echo $e->errorMessage();
		} catch (\Exception $e) {
			/* PHP exception (note the backslash to select the global namespace Exception class). */
			//echo $e->getMessage();
		}
		return $result;
	}

	public function getData($name = 'emailsetting')
	{
		$this->model = Registry::getInstance()->get('database');
		//$this->model->connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		$query = $this->model->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `name` = ? LIMIT 1", array($name));
		$result = $query->row;
		$smtp_crd = json_decode($result['data'], true);

		if ($result['status'] == "1") {
			$this->mail->Host = $smtp_crd['host'];
			$this->mail->SMTPAuth = $smtp_crd['authentication'];
			$this->mail->SMTPSecure = $smtp_crd['encryption'];
			$this->mail->Port = $smtp_crd['port'];

			$this->mail->setFrom($smtp_crd['fromemail'], $smtp_crd['fromname']);
			if (!empty($smtp_crd)) {
				$this->mail->addReplyTo($smtp_crd['reply'], $smtp_crd['fromname']);
			} else {
				$this->mail->addReplyTo($smtp_crd['fromemail'], $smtp_crd['fromname']);
			}

			return true;
		} else {
			return false;
		}
	}
}
