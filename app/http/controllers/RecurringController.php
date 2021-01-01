<?php

/**
* RecurringController
*/
class RecurringController extends Controller
{
	private $invoiceModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->invoiceModel = new Invoice();
	}

	public function index()
	{
		if (!$this->commons->hasPermission('recurring')) {
			Not_foundController::show('403');
			exit();
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/**
		* Get all User data from DB using User model 
		**/
		$data['result'] = $this->invoiceModel->getRecurringInvoices();
		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_recurring_invoices'];
		
		/*Render User list view*/
		$this->view->render('invoice/recurring_invoice_list.tpl', $data);
	}
	/**
	* Invoice index view method
	* This method will be called on Invoice view
	**/
	public function indexView()
	{
		if (!$this->commons->hasPermission('recurring/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('recurring');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using Invoice model 
		**/
		$data['result'] = $this->invoiceModel->getRecurringInoviceView($id);
		if (empty($data['result'])) {
			$this->url->redirect('recurring');
		}
		$data['recurringInvoices'] = $this->invoiceModel->getInvoicesCreatedfromRecurring($id);

		$data['taxes'] = $this->invoiceModel->getTaxes();
		$data['payment_type'] = $this->invoiceModel->paymentType();

		$data['organization'] = $data['info']['name'];
		$data['logo'] = $data['info']['logo'];
		$data['address'] = json_decode($data['info']['address'], true);

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/**
		* Get all User data from DB using Invoice model 
		**/
		/* Set page title */
		$data['page_title'] = $data['lang']['invoices']['text_recurring_invoice_view'];
		$data['action'] = URL.DIR_ROUTE.'invoicePayment/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		
		/*Render User list view*/
		$this->view->render('invoice/recurring_invoice_view.tpl', $data);
	}
	/**
	* Invoice index print method
	* This method will be called on Invoice print
	**/
	public function indexPrint()
	{
		if (!$this->commons->hasPermission('recurring/view')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('recurring');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using Invoice model 
		**/
		$data['result'] = $this->invoiceModel->getRecurringInoviceView($id);
		if (empty($data['result'])) {
			$this->url->redirect('recurring');
		}
		$commonsModel = new Commons();
		$info = $commonsModel->getOrganization();
		$data['organization'] = $info['name'];
		$data['logo'] = $info['logo'];
		$data['address'] = json_decode($info['address'], true);
		
		$data['taxes'] = $this->invoiceModel->getTaxes();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/**
		* Get all User data from DB using Invoice model 
		**/
		/* Set page title */
		$data['page_title'] = 'Invoice Print';
		
		/*Render User list view*/
		$this->view->render('invoice/recurring_invoice_print.tpl', $data);
	}
	/**
	* Invoice index ADD method
	* This method will be called on add Invoice
	**/
	public function indexAdd()
	{
		if (!$this->commons->hasPermission('recurring/add')) {
			Not_foundController::show('403');
			exit();
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using Invoice model 
		**/
		$data['result'] = NULL;
		$data['payment_type'] = $this->invoiceModel->paymentType();
		$data['taxes'] = $this->invoiceModel->getTaxes();
		$data['items'] = $this->invoiceModel->getItems();
		//$data['payment_status'] = $this->invoiceModel->getPaymentStatus();
		$data['currency'] = $this->invoiceModel->getCurrency();
		$data['customers'] = $this->invoiceModel->getCustomers();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['invoices']['text_new_recurring_invoice'];
		$data['action'] = URL.DIR_ROUTE.'recurring/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render Invoice list view*/
		$this->view->render('invoice/recurring_invoice_form.tpl', $data);
	}
	/**
	* Invoice index edit method
	* This method will be called on edit Invoice
	**/
	public function indexEdit()
	{
		if (!$this->commons->hasPermission('recurring/edit')) {
			Not_foundController::show('403');
			exit();
		}
		/**
		* Check if id exist in url if not exist then redirect to Item list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('recurring');
		}
		/*Get User name and role*/
		$data = $this->commons->getUser();
		/**
		* Get all User data from DB using User model 
		**/
		$data['result'] = $this->invoiceModel->getRecurringInvoice($id);
		if (empty($data['result'])) {
			$this->url->redirect('recurring');
		}

		$data['payment_type'] = $this->invoiceModel->paymentType();
		$data['taxes'] = $this->invoiceModel->getTaxes();
		$data['items'] = $this->invoiceModel->getItems();
		$data['currency'] = $this->invoiceModel->getCurrency();
		$data['customers'] = $this->invoiceModel->getCustomers();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/* Set page title */
		$data['page_title'] = $data['lang']['invoices']['text_edit_recurring_invoice'];
		$data['action'] = URL.DIR_ROUTE.'recurring/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);

		/*Render User list view*/

		$this->view->render('invoice/recurring_invoice_form.tpl', $data);
	}
	/**
	* Invoice index action or submit method
	* This method will be called on Invoice save
	**/
	public function indexAction()
	{
		/**
		* Check if from is submitted or not 
		**/
		if (!isset($_POST['submit'])) {
			$this->url->redirect('recurring');
			exit();
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('recurring');
		}

		if (!empty($this->url->post('id'))) {
			$data = $this->url->post('invoice');
			$data['id'] = $this->url->post('id');
			$data['inv_date'] = date_format(date_create($data['inv_date']), 'Y-m-d');
			$data['item'] = json_encode($data['item']);
			$result = $this->invoiceModel->updateRecurringInvoice($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Recurring Inovice updated successfully.');
			$this->url->redirect('recurring/edit&id='.$data['id']);
		}
		else {
			$data = $this->url->post('invoice');
			$data['item'] = json_encode($data['item']);
			$data['inv_date'] = date_format(date_create($data['inv_date']), 'Y-m-d');
			$result = $this->invoiceModel->createRecurringInvoice($data);
			$this->session->data['message'] = array('alert' => 'success', 'value' => 'Recurring Inovice created successfully.');
			
			$this->url->redirect('recurring/edit&id='.$result);
		}
	}
	/**
	* Invoice index delete method
	* This method will be called on Invoice delete
	**/
	public function indexDelete()
	{
		if (!$this->commons->hasPermission('recurring/delete')) {
			Not_foundController::show('403');
			exit();
		}
		$result = $this->invoiceModel->deleteRecurringInvoice($this->url->post('id'));
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Recurring Invoice deleted successfully.');
		$this->url->redirect('recurring');
	}
	/**
	* Invoice index PDF method
	* This method will be called to create PDF
	**/
	public function indexPdf()
	{
		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$id = (int)$this->url->get('id');
		if (empty($id) || !is_int($id)) {
			$this->url->redirect('invoices');
		}

		require DIR_BUILDER.'libs/tcpdf/tcpdf.php';
		/**
		* Get all User data from DB using Invoice model 
		**/
		$result = $this->invoiceModel->getRecurringInoviceView($id);
		$caddress = json_decode($result['address'], true);
		
		$items = json_decode($result['items'], true);
		

		/*Get User name and role*/
		$data = $this->commons->getUser();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		$info = $data['info'];
		$organization = $info['name'];
		$logo = $info['logo'];
		$address = json_decode($info['address'], true);

		$item = '';
		foreach ($items as $key => $value) {
			$tax = NULL;
			if (!empty($value['tax'])) { 
				foreach ($value['tax'] as $tax_key => $tax_value) {
					$tax .= '<p class="badge badge-light badge-sm badge-pill d-block m-1 text-left">'.$tax_value['name'].' - '.$tax_value['tax_price'].'</p>';
				}
			}
			$item .= '<tr>
			<td class="item" width="280">'.$value['name'].'<br /><span style="color: #555;">'.$value['descr'].'</span></td>
			<td width="50">'.$value['quantity'].'</td>
			<td width="100">'.$value['cost'].'</td>
			<td width="160">'.$tax.'</td>
			<td width="120">'.$value['price'].'</td>
			</tr>';
		}

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($organization);
		$pdf->SetTitle('Invoice | PDF');
		$pdf->SetSubject($info['name'].' | Invoice');
		$pdf->SetKeywords('Invoice PDF');
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetMargins(5, 0, 5);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();
		
		$html = '<style>
		.text-center {
			text-align: center;
		}
		.text-right {
			text-align: right;
		}
		.inv-template {
			width: 100%;
			background-color: #FFF;
			box-shadow: 0 0 10px 0 rgba(150, 150, 150, 0.2); 
		}
		.inv-title {
			font-size: 32px;
			color: #555;
		}
		.inv-head td {
			padding: 0 0 2px 0;
			border-bottom: 1px solid #eee;
		}
		.inv-template-bdy table {
			width: 100%; 
		}

		.inv-template-bdy .inv-logo {
			text-align: center; 
		}
		.inv-template-bdy .inv-logo img {
			height: 40px; 
		}
		.inv-bill-to p {
			font-size: 10px;
			color: #777;
		}
		.inv-bill-to span {
			font-size: 10px;
			color: #777;
		}
		.inv-bill-to .title {
			font-size: 16px;
			color: #333;
			font-weight: 500;
		}

		.inv-bill-to .email {
			color: #333;
			font-weight: 500;
			margin: 0;
		}

		.inv-meta {
			font-size: 10px;
		}

		.inv-template-item {
			font-size: 10px;
			padding: 20px 20px 40px 20px;
		}
		.inv-template-item td {
			border: 1px solid #EEE; 
		}
		.inv-template-item .balance-due {
			background-color: #f8f8f8; 
		}
		.total td {
			vertical-align: middle;
		}
		.inv-template-bdy .inv-meta p span {
			display: inline-block;
			vertical-align: middle;
		}
		.inv-template-bdy .inv-meta p span:nth-last-child(1) {
			font-weight: 500;
			min-width: 100px;
		}
		</style>

		<div class="inv-template">
		<div class="inv-template-bdy">
		<table cellpadding="8">
		<thead>
		<tr>
		<th></th>
		<th></th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		<tr class="inv-head">
		<td class="inv-address" style="vertical-align: middle;">
		<div>
		<span class="head">'.$organization.'<br></span>
		<span class="body">'.$address['address1'].'<br></span>
		<span class="body">'.$address['address2'].' '.$address['city'].'<br></span>
		<span class="body">'.$address['country'].' '.$address['pincode'].'<br></span>
		</div>
		</td>
		<td colspan="2" class="text-right inv-title" style="vertical-align: middle;">'.$data['lang']['common']['text_invoice'].'</td>
		</tr>
		<tr class="inv-meta-container">
		<td valign="middle">
		<div class="inv-bill-to">
		<span class="head">'.$data['lang']['invoices']['text_bill_to'].'</span><br />
		<span class="title">'.$result['company'].'</span><br />
		<span class="email">'.$result['email'].'</span><br />
		<span class="body">'.$caddress['address1'].', '.$caddress['address2'].'</span><br />
		<span class="body">'.$caddress['city'].', '.$caddress['state'].'</span> <br />
		<span class="body">'.$caddress['country'].'  '.$caddress['pin'].'</span>
		</div>
		</td>
		<td colspan="2" valign="middle" class="text-right">
		<div class="inv-meta">
		<span><span># : </span><span>RINV-'.str_pad($result['id'], 4, '0', STR_PAD_LEFT).'</span></span>
		<p><span>'.$data['lang']['invoices']['text_invoice_date'].' : </span><span>'.date_format(date_create($result['inv_date']), 'd-m-Y').'</span></p>
		<p><span>'.$data['lang']['invoices']['text_repeat_every'].' : </span><span>'.$result['repeat_every'].'</span></p>
		<p><span>'.$data['lang']['invoices']['text_payment_method'].': </span><span>'.$result['payment'].'</span></p>
		</div>
		</td>
		</tr>
		</tbody>
		</table>
		<div class="inv-template-item">
		<table cellpadding="8">
		<thead>
		<tr style="background-color: #eee;" border="1">
		<th width="280">'.$data['lang']['invoices']['text_item_and_description'].'</th>
		<th width="50">'.$data['lang']['invoices']['text_quantity'].'</th>
		<th width="100">'.$data['lang']['invoices']['text_unit_cost'].'('.$result['currency_abbr'].')</th>
		<th width="160">'.$data['lang']['invoices']['text_tax'].' ('.$result['currency_abbr'].')</th>
		<th width="120">'.$data['lang']['invoices']['text_price'].' ('.$result['currency_abbr'].')</th>
		</tr>
		</thead>
		<tbody>
		'.$item.'
		<tr class="total">
		<td width="330" rowspan="4" colspan="3">'.$result['note'].'</td>
		<td width="180" align="right">'.$data['lang']['invoices']['text_sub_total'].'</td>
		<td width="200" >'.$result['currency_abbr'].' '.$result['subtotal'].'</td>
		</tr>
		<tr class="total">
		<td width="180" align="right">'.$data['lang']['invoices']['text_tax'].'</td>
		<td width="200">'.$result['currency_abbr'].' '.$result['tax'].'</td>
		</tr>
		<tr class="total">
		<td width="180" align="right">'.$data['lang']['invoices']['text_discount'].'</td>
		<td width="200">'.$result['currency_abbr'].' '.$result['discount_value'].'</td>
		</tr>
		<tr class="total">
		<td width="180" align="right">'.$data['lang']['invoices']['text_total'].'</td>
		<td width="200">'.$result['currency_abbr'].' '.$result['amount'].'</td>
		</tr>
		<tr>
		<td colspan="8">
		<p class="font-12">'.$data['lang']['invoices']['text_terms_Conditions'].'</p>
		<p class="font-16">'.$result['tc'].'</p>
		</td>
		</tr>
		</tbody>
		</table>
		</div>
		</div>
		</div>';

		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('proposal.pdf', 'I');
	}
	/**
	* Invoice index mail method
	* This method will be called to maiil invoice reminder etc
	**/
	public function indexMail()
	{
		$data = $this->url->post('mail');

		if ($validate_field = $this->vaildateMailField($data)) {
			$this->session->data['message'] = array('alert' => 'error', 'value' => 'Please enter valid '.implode(", ",$validate_field).'!');
			$this->url->redirect('recurring/view&id='.$data['invoice']);
		}

		if ($this->commons->validateToken($this->url->post('_token'))) {
			$this->url->redirect('recurring/view&id='.$data['invoice']);
		}
		$info = $this->invoiceModel->getOrganization();

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
		$mailer->mail->AltBody = 'Hello Dear,
		Your Invoice has been created. Invoice Number - RINV-'.str_pad($data['invoice'], 4, '0', STR_PAD_LEFT).'
		You can also view this invoice online by clicking here.
		Thank you,
		Administrator';
		$mailer->sendMail();
		$this->session->data['message'] = array('alert' => 'success', 'value' => 'Email Sent successfully.');
		
		$this->url->redirect('recurring/view&id='.$data['invoice']);
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
}