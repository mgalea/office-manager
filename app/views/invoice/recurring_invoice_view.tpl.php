<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#rinvoice-li').addClass('active');</script>

<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<i class="icon-docs panel-head-icon"></i>
			<span class="panel-title-text"><?php echo $page_title; ?></span>
		</div>
	</div>
	<div class="panel-wrapper">
		<div class="inv-template">
			<div class="inv-template-hdr">
				<div class="row">
					<div class="col-sm-2">
						<div class="ribbon"><?php if ($result['inv_status'] == "0") { echo $lang['invoices']['text_draft']; } else { echo $lang['invoices']['text_published']; } ?></div>
					</div>
					<div class="col-sm-10 text-right">
						<a href="<?php echo URL.DIR_ROUTE .'recurring/pdf&id='.$result['id']; ?>" class="btn btn-danger btn-sm" target="_blank"><i class="far fa-file-pdf mr-2"></i> <?php echo $lang['invoices']['text_pdf']; ?></a>
						<a href="<?php echo URL.DIR_ROUTE .'recurring/print&id='.$result['id']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="icon-printer mr-2"></i><?php echo $lang['invoices']['text_print']; ?></a>
						<a href="<?php echo URL.DIR_ROUTE .'recurring/edit&id='.$result['id']; ?>" class="btn btn-info btn-sm"><i class="icon-pencil mr-2"></i> <?php echo $lang['common']['text_edit']; ?></a>
					</div>
				</div>
			</div>
			<div class="inv-template-bdy table-responsive">
				<table>
					<tbody>
						<tr class="inv-from-container">
							<td>
								<div class="inv-bill-to">
									<p class="title"><?php echo $organization; ?><br></p>
									<p class="body"><?php echo $address['address1']; ?></p>
									<p class="body"><?php echo $address['address2'].' '.$address['city']; ?></p>
									<p class="body"><?php echo $address['country'].'  '.$address['pincode']; ?></p>
								</div>
							</td>
							<td class="font-24 text-right">
								<div class="inv-title"><?php echo $lang['common']['text_invoice']; ?></div>
							</td>
						</tr>
						<tr class="inv-meta-container">
							<td>
								<div class="inv-bill-to">
									<p><?php echo $lang['invoices']['text_bill_to']; ?></p>
									<p class="title"><?php echo $result['company']; ?></p>
									<p class="font-500 font-14"><?php echo $result['email']; ?></p>
									<?php $caddress = json_decode($result['address'], true); ?>
									<p class="body"><?php echo $caddress['address1'].', '.$caddress['address2'].'<br />'; ?></p>
									<p class="body"><?php echo $caddress['city'].' '.$caddress['state'].'<br />'; ?></p>
									<p class="body"><?php echo $caddress['country'].'  '.$caddress['pin']; ?></p>
								</div>
							</td>
							<td class="text-right">
								<div class="inv-meta">
									<p><span># : </span><span>RINV-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?></span></p>
									<p><span><?php echo $lang['common']['text_created_date']; ?> : </span><span><?php echo date_format(date_create($result['date_of_joining']), 'd-m-Y'); ?></span></p>
									<p><span><?php echo $lang['invoices']['text_invoice_date']; ?> : </span><span><?php echo date_format(date_create($result['inv_date']), 'd-m-Y'); ?></span></p>
									<p><span><?php echo $lang['invoices']['text_repeat_every']; ?> : </span><span><?php echo $result['repeat_every']; ?></span></p>
									<p><span><?php echo $lang['invoices']['text_payment_method']; ?> : </span><span><?php echo $result['payment']; ?></span></p>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="inv-template-item">
					<table>
						<thead>
							<tr>
								<th><?php echo $lang['invoices']['text_item_and_description']; ?></th>
								<th><?php echo $lang['invoices']['text_quantity']; ?></th>
								<th><?php echo $lang['invoices']['text_unit_cost']; ?>(<?php echo $result['currency_abbr']; ?>)</th>
								<th><?php echo $lang['invoices']['text_tax'].'('.$result['currency_abbr']; ?>)</th>
								<th><?php echo $lang['invoices']['text_price'].'('.$result['currency_abbr']; ?>)</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($result['items'])) {  $inv_items = json_decode($result['items'], true); foreach ($inv_items as $inv_key => $inv_value) { ?>
							<tr>
								<td class="item">
									<p><?php echo $inv_value['name']; ?></p>
									<span><?php echo $inv_value['descr']; ?></span>
								</td>
								<td><?php echo $inv_value['quantity']; ?></td>
								<td><?php echo $inv_value['cost']; ?></td>
								<td class="">
									<?php if (!empty($inv_value['tax'])) { foreach ($inv_value['tax'] as $tax_key => $tax_value) { ?>
									<p class="badge badge-light badge-sm badge-pill d-block m-1 text-left">
										<?php echo $tax_value['name'].' &#8658; '.$tax_value['tax_price']; ?>
									</p>
									<?php } } ?>
								</td>
								<td><?php echo $inv_value['price']; ?></td>
							</tr>
							<?php } } ?>
							<tr class="total">
								<td rowspan="4" colspan="2">
									<p><?php echo $result['note']; ?></p>
								</td>
								<td colspan="2"><span><?php echo $lang['invoices']['text_sub_total']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$result['subtotal']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_tax']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$result['tax']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_discount']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$result['discount_value']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_total']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$result['amount']; ?></span></td>
							</tr>
							<tr>
								<td colspan="6">
									<p class="font-12"><?php echo $lang['invoices']['text_terms_Conditions']; ?></p>
									<p class="font-16"><?php echo $result['tc']; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<span class="panel-title-text"><?php echo $lang['invoices']['text_invoices_created_from_recurring_invoice']; ?></span>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo $lang['common']['text_customer']; ?></th>
						<th><?php echo $lang['invoices']['text_amount']; ?></th>
						<th><?php echo $lang['common']['text_status']; ?></th>
						<th><?php echo $lang['common']['text_date']; ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($recurringInvoices)) { foreach ($recurringInvoices as $key => $value) { ?>
					<tr>
						<td><a href="<?php echo URL.DIR_ROUTE . 'invoice/view&id=' .$value['id']; ?>" class="text-primary">INV-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
						<td class="text-dark"><?php echo $value['company']; ?></td>
						<td class="text-dark"><?php echo $value['abbr'].$value['amount']; ?></td>
						<td>
							<?php if ($value['status'] == "Paid") { ?>
							<span class="badge badge-Paid badge-pill badge-sm"><?php echo $lang['invoices']['text_paid']; ?></span>
							<?php } elseif ($value['status'] == "Unpaid") { ?>
							<span class="badge badge-Unpaid badge-pill badge-sm"><?php echo $lang['invoices']['text_unpaid']; ?></span>
							<?php } elseif ($value['status'] == "Pending") { ?>
							<span class="badge badge-Pending badge-pill badge-sm"><?php echo $lang['invoices']['text_pending']; ?></span>
							<?php } elseif ($value['status'] == "In Process") { ?>
							<span class="badge badge-In-Process badge-pill badge-sm"><?php echo $lang['invoices']['text_in_process']; ?></span>
							<?php } elseif ($value['status'] == "Cancelled") { ?>
							<span class="badge badge-Cancelled badge-pill badge-sm"><?php echo $lang['invoices']['text_cancelled']; ?></span>
							<?php } elseif ($value['status'] == "Other") { ?>
							<span class="badge badge-Other badge-pill badge-sm"><?php echo $lang['invoices']['text_other']; ?></span>
							<?php } elseif ($value['status'] == "Partially Paid") { ?>
							<span class="badge badge-Partially-Paid badge-pill badge-sm"><?php echo $lang['invoices']['text_partially_paid']; ?></span>
							<?php } else { ?>
							<span class="badge badge-Unknown badge-pill badge-sm"><?php echo $lang['invoices']['text_unknown']; ?></span>
							<?php } ?>
						</td>
						<td><i class="fa fa-clock-o mr-2 text-muted"></i><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></td>
						<td>
							<a href="<?php echo URL.DIR_ROUTE . 'invoice/view&id=' .$value['id']; ?>" class="mr-2"><i class="fa fa-eye mr-2 text-dark" data-toggle="tooltip" title="<?php echo $lang['common']['text_view'] ?>"></i></a>
							<a href="<?php echo URL.DIR_ROUTE . 'invoice/edit&id=' .$value['id']; ?>"><i class="icon-pencil mr-2 text-info" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit'] ?>"></i></a>
						</td>
					</tr>
					<?php } } else { ?>
					<tr>
						<td colspan="6" class="text-center font-18"><?php echo $lang['common']['text_no_records_available']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Sent Email -->
<div id="invoiceMail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $lang['invoices']['text_send_email']; ?></h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="<?php echo URL.DIR_ROUTE .'recurring/sentmail';?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_to']; ?></label>
							<input type="text" class="form-control" value="<?php echo $result['email'] ?>" placeholder="<?php echo $lang['invoices']['text_to']; ?>" readonly>
						</div>
						<div class="col-md-6 form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_bcc']; ?></label>
							<input type="email" class="form-control" name="mail[bcc]" value="" placeholder="<?php echo $lang['invoices']['text_bcc']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label"><?php echo $lang['invoices']['text_subject']; ?></label>
						<input type="text" class="form-control" name="mail[subject]" value="Invoice Reminder" placeholder="<?php echo $lang['invoices']['text_subject']; ?>" required>
					</div>
					<div class="form-group">
						<label class="col-form-label"><?php echo $lang['invoices']['text_message']; ?></label>
						<textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['invoices']['text_message']; ?>">Hello Dear,<br/><br/>Your Invoice has been created. Invoice Number - <b>RINV-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?></b><br/>You can also view this invoice online by <a href="<?php echo URL.'clients/index.php?route=invoice/view&id='.$result['id']; ?>">clicking here</a>.<br/><br/>Thank you,<br/>Administrator</textarea>
					</div>
					<input type="hidden" name="mail[invoice]" value="<?php echo $result['id']; ?>">
					<input type="hidden" name="mail[to]" value="<?php echo $result['email']; ?>">
					<input type="hidden" name="mail[name]" value="<?php echo $result['company']; ?>">
					<input type="hidden" name="_token" value="<?php echo $token; ?>">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit"><?php echo $lang['invoices']['text_send']; ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- include summernote css/js-->
<link href="public/css/summernote-bs4.css" rel="stylesheet">
<script type="text/javascript" src="public/js/summernote-bs4.min.js"></script>
<script type="text/javascript" src="public/js/custom.summernote.js"></script>

<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>