<?php

/**
* InvoiceController
*/

require DIR_BUILDER.'libs/tcpdf/tcpdf.php';

class InvoiceController extends Controller
{
	private $invoiceModel;
	function __construct()
	{
		parent::__construct();
		$this->commons = new CommonsController();
		/*Intilize User model*/
		$this->invoiceModel = new Invoice();
	}
	/**
	* Contact index method
	* This method will be called on Contact list view
	**/
	public function index()
	{
		
		$customer = $this->session->data['customer'];


		/**
		* Get all User data from DB using User model 
		**/

		$data = $this->commons->getUser();

		if (!empty($customer)) {
			$data['result'] = $this->invoiceModel->getInvoices($customer);
		} else {
			$data['result'] = NULL;
		}
		$data['customer'] = $customer;
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

		/* Set page title */
		$data['page_title'] = $data['lang']['common']['text_invoices'];
		
		/*Render User list view*/
		$this->view->render('invoice/invoice_list.tpl', $data);
	}

	public function indexView()
	{
		
		$data = $this->commons->getUser();
		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$data['id'] = (int)$this->url->get('id');
		if (empty($data['id']) || !is_int($data['id'])) {
			$this->url->redirect('invoices');
		}

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		$data['customer'] = $this->session->data['customer'];
		
		if (empty($data['customer'])) {
			$this->url->redirect('invoices');
		}

		$data['result'] = $this->invoiceModel->getInvoiceView($data);

		$data['payments'] = $this->invoiceModel->getPayments($data['id']);

		if (empty($data['result'])) {
			//$this->url->redirect('invoices');
		}

		$data['attachments'] = $this->invoiceModel->getAttachments($data['id']);
		
		$data['taxes'] = $this->invoiceModel->getTaxes();
		$data['payment_type'] = $this->invoiceModel->paymentType();
		
		$data['address'] = json_decode($data['info']['address'], true);
		/* Set confirmation message if page submitted before */
		if (isset($this->session->data['message'])) {
			$data['message'] = $this->session->data['message'];
			unset($this->session->data['message']);
		}
		/**
		* Get all User data from DB using Invoice model 
		**/
		/* Set page title */
		$data['page_title'] = $data['lang']['invoices']['text_invoice_view'];
		$data['action'] = URL_CLIENTS.DIR_ROUTE.'invoicePayment/action';
		$data['token'] = hash('sha512', TOKEN . TOKEN_SALT);
		
		/*Render User list view*/
		$this->view->render('invoice/invoice_view.tpl', $data);
	}

	public function indexPrint()
	{

		$data = $this->commons->getUser();

		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$data['id'] = (int)$this->url->get('id');
		if (empty($data['id']) || !is_int($data['id'])) {
			$this->url->redirect('invoices');
		}

		$data['customer'] = $this->session->data['customer'];
		if (empty($data['customer'])) {
			$this->url->redirect('invoices');
		}

		$data['result'] = $this->invoiceModel->getInvoiceView($data);
		if (empty($data['result'])) {
			$this->url->redirect('invoices');
		}

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$data['info']['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$data['info']['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		/**
		* Get all User data from DB using Invoice model 
		**/

		$info = $data['info'];
		$data['organization'] = $info['name'];
		$data['logo'] = $info['logo'];
		$data['address'] = json_decode($info['address'], true);
		
		$data['taxes'] = $this->invoiceModel->getTaxes();
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
		$this->view->render('invoice/invoice_print.tpl', $data);
	}

	public function indexPdf()
	{
		/**
		* Check if id exist in url if not exist then redirect to Invoice list view 
		**/
		$data['id'] = (int)$this->url->get('id');
		if (empty($data['id']) || !is_int($data['id'])) {
			$this->url->redirect('invoices');
		}


		$data['customer'] = $this->session->data['customer'];
		if (empty($data['customer'])) {
			$this->url->redirect('invoices');
		}

		$result = $this->invoiceModel->getInvoice($data);
		if (empty($result)) {
			$this->url->redirect('invoices');
		}
		
		$caddress = json_decode($result['address'], true);
		$items = json_decode($result['items'], true);
		
		$commonsModel = new Commons();
		$info = $commonsModel->getInfo();
		$organization = $info['name'];
		$logo = $info['logo'];
		$address = json_decode($info['address'], true);
		$item = '';
		/*Get User name and role*/
		$data = $this->commons->getUser();

		/*Load Language File*/
		require DIR_BUILDER.'language/'.$info['language'].'/common.php';
		$data['lang']['common'] = $lang;
		require DIR_BUILDER.'language/'.$info['language'].'/invoices.php';
		$data['lang']['invoices'] = $invoices;

		foreach ($items as $key => $value) {
			$tax = NULL;
			if (!empty($value['tax'])) { 
				foreach ($value['tax'] as $tax_key => $tax_value) {
					$tax .= '<p class="badge badge-light badge-sm badge-pill d-block m-1 text-left">'.$tax_value['name'].' &#8658; '.$tax_value['tax_price'].'</p>';
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

		if ($result['status'] == "Paid") 
		{
			$result['status'] = $data['lang']['invoices']['text_paid']; 
		} elseif ($result['status'] == "Unpaid") { 
			$result['status'] = $data['lang']['invoices']['text_unpaid']; 
		} elseif ($result['status'] == "Pending") { 
			$result['status'] = $data['lang']['invoices']['text_pending'];
		} elseif ($result['status'] == "In Process") {
			$result['status'] = $data['lang']['invoices']['text_in_process']; 
		} elseif ($result['status'] == "Cancelled") {
			$result['status'] = $data['lang']['invoices']['text_cancelled']; 
		} elseif ($result['status'] == "Other") {
			$result['status'] = $data['lang']['invoices']['text_other']; 
		} elseif ($result['status'] == "Partially Paid") { 
			$result['status'] = $data['lang']['invoices']['text_partially_paid']; 
		} else { 
			$result['status'] = $data['lang']['invoices']['text_unknown']; 
		}

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($organization);
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject($organization.' | Invoice');
		$pdf->SetKeywords('PDF, Invoice');
		
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
			padding: 0 20px 0 20px;
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
		<thead style="max-height: 1px;">
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
		<span><span># : </span><span>INV-'.str_pad($result['id'], 4, '0', STR_PAD_LEFT).'</span></span>
		<p><span>'.$data['lang']['common']['text_created_date'].' : </span><span>'.date_format(date_create($result['date_of_joining']), 'd-m-Y').'</span></p>
		<p><span>'.$data['lang']['invoices']['text_due_date'].' : </span><span>'.date_format(date_create($result['duedate']), 'd-m-Y').'</span></p>
		<p><span>'.$data['lang']['invoices']['text_payment_method'].': </span><span>'.$result['payment'].'</span></p>
		<p><span>'.$data['lang']['common']['text_status'].' : </span><span>'.$result['status'].'</span></p>
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
		<td width="330" rowspan="6" colspan="3">'.$result['note'].'</td>
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_sub_total'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['subtotal'].'</td>
		</tr>
		<tr class="total">
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_tax'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['tax'].'</td>
		</tr>
		<tr class="total">
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_discount'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['discount_value'].'</td>
		</tr>
		<tr class="total">
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_total'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['amount'].'</td>
		</tr>
		<tr class="total">
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_paid'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['paid'].'</td>
		</tr>
		<tr class="total" style="background-color: #f8f8f8;">
		<td width="180" colspan="2" align="right">'.$data['lang']['invoices']['text_due'].'</td>
		<td width="200" colspan="2">'.$result['currency_abbr'].' '.$result['due'].'</td>
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
		$pdf->Output('invoice.pdf', 'I');
	}
}