<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
	$('#invoice-li').addClass('active');
</script>

<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<i class="icon-docs panel-head-icon"></i>
			<span class="panel-title-text"><?php echo $page_title; ?></span>
		</div>
		<div class="panel-action">
			<button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
			<a href="<?php echo URL . DIR_ROUTE . 'invoices'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
		</div>
	</div>
	<div class="panel-wrapper">
		<div class="inv-template">
			<div class="inv-template-hdr">
				<div class="row">
					<div class="col-md-2">
						<div class="ribbon ribbon-warning"><?php if ($result['inv_status'] == "0") {
																echo $lang['invoices']['text_draft'];
															} elseif ($result['status'] == "Paid") {
																echo $lang['invoices']['text_paid'];
															} elseif ($result['status'] == "Unpaid") {
																echo $lang['invoices']['text_unpaid'];
															} elseif ($result['status'] == "Pending") {
																echo $lang['invoices']['text_pending'];
															} elseif ($result['status'] == "In Process") {
																echo $lang['invoices']['text_in_process'];
															} elseif ($result['status'] == "Cancelled") {
																echo $lang['invoices']['text_cancelled'];
															} elseif ($result['status'] == "Other") {
																echo $lang['invoices']['text_other'];
															} elseif ($result['status'] == "Partially Paid") {
																echo $lang['invoices']['text_partially_paid'];
															} else {
																echo $lang['invoices']['text_unknown'];
															} ?></div>
					</div>
					<div class="col-md-10 text-right">
						<div class="">
							<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#invoiceMail"><i class="icon-envelope mr-2"></i><?php echo $lang['invoices']['text_send_email']; ?></a>
							<a href="<?php echo URL . DIR_ROUTE . 'invoice/pdf&id=' . $result['id']; ?>" class="btn btn-danger btn-sm" target="_blank"><i class="far fa-file-pdf mr-2"></i> <?php echo $lang['invoices']['text_pdf']; ?></a>
							<a href="<?php echo URL . DIR_ROUTE . 'invoice/print&id=' . $result['id']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="icon-printer mr-2"></i><?php echo $lang['invoices']['text_print']; ?></a>
							<a href="<?php echo URL . DIR_ROUTE . 'invoice/edit&id=' . $result['id']; ?>" class="btn btn-info btn-sm"><i class="icon-pencil mr-2"></i> <?php echo $lang['common']['text_edit']; ?></a>
							<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addPayment"><i class="icon-credit-card mr-2"></i> <?php echo $lang['invoices']['text_add_payment']; ?></a>
							<a data-toggle="modal" class="btn btn-info btn-sm" data-target="#attach-file" class="btn btn-secondary btn-sm"><i class="icon-paper-clip"></i></a>
						</div>
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
									<p class="body"><?php echo $address['address2'] . ' ' . $address['city']; ?></p>
									<p class="body"><?php echo $address['country'] . '  ' . (isset($address['pincode'])) ? $address['pincode'] : ''; ?></p>
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
									<?php $caddress = json_decode($result['address'], true); ?>
									<p class="body"><?php echo $caddress['address1'] . ', ' . $caddress['address2'] . '<br />'; ?></p>
									<p class="body"><?php echo $caddress['city'] . ' ' . $caddress['state'] . '<br />'; ?></p>
									<p class="body"><?php echo $caddress['country'] . '  ' . $caddress['pincode']; ?></p>
									<p class="font-500 font-12">Attention: <?php echo $result['customer_email']; ?></p>
								</div>
							</td>
							<td class="text-right">
								<div class="inv-meta">
									<p><span># : </span><span>INV-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?></span></p>
									<p><span><?php echo $lang['invoices']['text_invoice_date']; ?> : </span><span><?php echo date_format(date_create($result['inv_date']), 'd-m-Y'); ?></span></p>
									<p><span><?php echo $lang['invoices']['text_due_date']; ?> : </span><span><?php echo date_format(date_create($result['duedate']), 'd-m-Y'); ?></span></p>
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
								<th><?php echo $lang['invoices']['text_tax'] . '(' . $result['currency_abbr']; ?>)</th>
								<th><?php echo $lang['invoices']['text_price'] . '(' . $result['currency_abbr']; ?>)</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($result['items'])) {
								$inv_items = json_decode($result['items'], true);
								foreach ($inv_items as $inv_key => $inv_value) {
									if (!empty($inv_value)) { ?>
										<tr>
											<td class="item">
												<p><?php echo $inv_value['name']; ?></p>
												<span><?php echo $inv_value['descr']; ?></span>
											</td>
											<td><?php echo $inv_value['quantity']; ?></td>
											<td><?php echo $inv_value['cost']; ?></td>
											<td class="">
												<?php if (!empty($inv_value['tax'])) {
													foreach ($inv_value['tax'] as $tax_key => $tax_value) { ?>
														<p class="badge badge-light badge-sm badge-pill d-block m-1 text-left">
															<?php echo $tax_value['name'] . ' &#8658; ' . $tax_value['tax_price']; ?>
														</p>
												<?php }
												} ?>
											</td>
											<td><?php echo $inv_value['price']; ?></td>
										</tr>

							<?php }
								}
							} ?>
							<tr class="total">
								<td rowspan="6" colspan="1">
								<?php if (!empty($account)) {
										foreach ($account as $key=>$value) { ?>
									<span class="font-500"><?php echo $lang['invoices']['text_remittance']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_account']; ?></span>: <span class="font-100"><?php echo $account[$key]['account_name']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_number']; ?></span>: <span class="font-100"><?php echo $account[$key]['account_number']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_currency']; ?></span>: <span class="font-100"><?php echo $account[$key]['currency']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_bank']; ?></span>: <span class="font-100"><?php echo $account[$key]['bank_name']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_branch']; ?></span>: <span class="font-100"><?php echo $account[$key]['bank_branch']; ?></span></br>
									<span class="font-500"><?php echo $lang['bank']['text_iban']; ?></span>: <span class="font-100"><?php echo $account[$key]['iban']; ?></span></br>
									</br></br>
									<?php }
												} ?>
								</td>

								<td rowspan="6" colspan="1">
									<p><?php echo $result['note']; ?></p>
								</td>
								<td colspan="2"><span><?php echo $lang['invoices']['text_sub_total']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'] . ' ' . $result['subtotal']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_tax']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'] . ' ' . $result['tax']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_discount']; ?></span></td>
								<td colspan="3"><span><?php echo $result['currency_abbr'] . ' ' . $result['discount_value']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_total']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'] . ' ' . $result['amount']; ?></span></td>
							</tr>
							<tr class="total">
								<td colspan="2"><span><?php echo $lang['invoices']['text_paid']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'] . ' ' . $result['paid']; ?></span></td>
							</tr>
							<tr class="total balance-due">
								<td colspan="2"><span><?php echo $lang['invoices']['text_due']; ?></span></td>
								<td colspan="2"><span><?php echo $result['currency_abbr'] . ' ' . $result['due']; ?></span></td>
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
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-head">
				<div class="panel-title">
					<i class="icon-credit-card panel-head-icon"></i>
					<span class="panel-title-text"><?php echo $lang['invoices']['text_payment_history']; ?></span>
				</div>
				<div class="panel-action">
					<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addPayment"><i class="icon-credit-card mr-1"></i> <?php echo $lang['invoices']['text_add_payment']; ?></a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?php echo $lang['common']['text_date']; ?></th>
							<th><?php echo $lang['invoices']['text_method']; ?></th>
							<th><?php echo $lang['invoices']['text_amount'] . '(' . $result['currency_abbr']; ?>)</th>
						</tr>
					</thead>
					<tbody>
						<?php $total  = 0;
						if (!empty($payments)) {
							foreach ($payments as $key => $value) { ?>
								<tr>
									<td><?php echo date_format(date_create($value['payment_date']), 'd-m-Y'); ?></td>
									<td><?php if (!empty($value['method_name'])) {
											echo $value['method_name'];
										} else {
											echo "Paypal";
										} ?></td>
									<td><?php echo $value['amount']; ?></td>
								</tr>
							<?php $total = $total + $value['amount'];
							} ?>
							<tr>
								<td colspan="2" class="text-right">Total</td>
								<td><?php echo $result['currency_abbr'] . ' ' . $total; ?></td>
							</tr>
						<?php } else { ?>
							<tr>
								<td colspan="3"><?php echo $lang['invoices']['text_no_payment_history']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-head">
				<div class="panel-title">
					<i class="icon-paper-clip panel-head-icon"></i>
					<span class="panel-title-text"><?php echo $lang['invoices']['text_attachments']; ?></span>
				</div>
				<div class="panel-action">
					<a data-toggle="modal" class="btn btn-info btn-sm" data-target="#attach-file" class="btn btn-secondary btn-sm"><i class="icon-paper-clip"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="attached-files">
					<?php if (!empty($attachments)) {
						foreach ($attachments as $key => $value) {
							$file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
							if ($file_ext == "pdf") { ?>
								<div class="attached-files-block">
									<a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf-o"></i></a>
									<input type="hidden" name="expense[attached][]" value="<?php echo $value['file_name']; ?>">
									<div class="delete-file"><a class="fa fa-trash"></a></div>
								</div>
							<?php } else { ?>
								<div class="attached-files-block">
									<a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""></a>
									<input type="hidden" name="expense[attached][]" value="<?php echo $value['file_name']; ?>">
									<div class="delete-file"><a class="fa fa-trash"></a></div>
								</div>
					<?php }
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Send Email Modal -->
<div id="invoiceMail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $lang['invoices']['text_send_email']; ?></h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="<?php echo URL . DIR_ROUTE . 'invoice/sentmail'; ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_to']; ?></label>
							<input type="text" class="form-control" value="<?php echo $result['customer_email'] ?>" placeholder="<?php echo $lang['invoices']['text_to']; ?>" readonly>
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
						<label class="col-form-label">Attach PDF?</label>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="mail[attachPdf]" class="custom-control-input" value="1" id="mailPdf" checked>
							<label class="custom-control-label" for="mailPdf"><i class="icon-paper-clip ml-2"></i> invoice-<?php echo $result['id']; ?>.pdf</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label"><?php echo $lang['invoices']['text_message']; ?></label>
						<textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['invoices']['text_message']; ?>">
						Hello,<br/><br/>Your new invoice has been created.</br> Invoice Number - <b>INV-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?>
						</b><br/>You can also view this invoice online by <a href="<?php echo URL . 'clients/index.php?route=invoice/view&id=' . $result['id']; ?>">
						clicking here</a>.<br/><br/>Thank you,<br/>Administrator</textarea>
					</div>
					<input type="hidden" name="mail[invoice]" value="<?php echo $result['id']; ?>">
					<input type="hidden" name="mail[to]" value="<?php echo $result['customer_email']; ?>">
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

<!-- Add Payment Modal -->
<div id="addPayment" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $lang['invoices']['text_add_payment']; ?></h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="<?php echo $action; ?>" method="post">
				<div class="modal-body">
					<div class="pt-3 pr-3 pl-3 pb-1">
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_payment_method']; ?></label>
							<select name="payment[method]" class="custom-select" required>
								<option value=""><?php echo $lang['invoices']['text_payment_method']; ?></option>
								<?php if ($payment_type) {
									foreach ($payment_type as $key => $value) { ?>
										<option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
								<?php }
								} ?>
							</select>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_amount'] . '(' . $result['currency_abbr']; ?>)</label>
							<input type="text" class="form-control" name="payment[amount]" value="<?php echo $result['due']; ?>" placeholder="<?php echo $lang['invoices']['text_amount']; ?>" required>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['invoices']['text_payment_date']; ?></label>
							<input type="text" class="form-control date" name="payment[date]" value="<?php echo date_format(date_create(), 'd-m-Y'); ?>" placeholder="<?php echo $lang['invoices']['text_payment_date']; ?>" required>
						</div>
						<input type="hidden" name="payment[customer]" value="<?php echo $result['customer']; ?>">
						<input type="hidden" name="payment[invoice]" value="<?php echo $result['id']; ?>">
						<input type="hidden" name="payment[currency]" value="<?php echo $result['currency']; ?>">
						<input type="hidden" name="_token" value="<?php echo $token; ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit" class="btn btn-primary font-12"><?php echo $lang['common']['text_save']; ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Attach File Modal -->
<div id="attach-file" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $lang['invoices']['text_upload_attachments']; ?></h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="<?php echo $result['id']; ?>">
				<form action="index.php?route=attachFile" class="dropzone" id="attach-file-upload"></form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
			</div>
		</div>
	</div>
</div>

<!-- include summernote css/js-->
<link href="public/css/summernote-bs4.css" rel="stylesheet">
<script type="text/javascript" src="public/js/summernote-bs4.min.js"></script>
<script type="text/javascript" src="public/js/custom.summernote.js"></script>

<link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
<script src="public/js/jquery.fancybox.min.js"></script>

<script src="public/js/printThis.js"></script>

<script>
	$(document).ready(function() {

		$("a.open-pdf").fancybox({
			'frameWidth': 800,
			'frameHeight': 900,
			'overlayShow': true,
			'hideOnContentClick': false,
			'type': 'iframe'
		});

		$("#attach-file-upload").dropzone({
			addRemoveLinks: true,
			acceptedFiles: "image/*,application/pdf",
			maxFilesize: 50000,
			dictDefaultMessage: '<?php echo $lang['common']['text_drop_message'] . '<br /><br />' . $lang['common']['text_allowed_file']; ?>',
			init: function() {
				this.on("sending", function(file, xhr, formData) {
						var id = $('input[name=id]').val(),
							type = 'invoice';
						formData.append("id", id);
						formData.append("type", type);
					}),
					this.on("success", function(file, xhr) {
						var ext = file.xhr.response.substr(file.xhr.response.lastIndexOf('.') + 1);
						if (ext === "pdf") {
							$('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
								'<a href="public/uploads/' + file.xhr.response + '" class="open-pdf"><i class="fa fa-file-pdf-o"></i></a>' +
								'<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
								'<div class="delete-file"><a class="fa fa-trash"></a></div>' +
								'</div>');
						} else {
							$('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
								'<a href="public/uploads/' + file.xhr.response + '" data-fancybox="gallery"><img src="public/uploads/' + file.xhr.response + '" alt=""></a>' +
								'<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
								'<div class="delete-file"><a class="fa fa-trash"></a></div>' +
								'</div>');
						}
						toastr.success('Document added Succefully', 'Success');
					})
			},
			renameFile: function(file) {
				return file.name.split('.')[0] + new Date().valueOf() + "." + file.name.split('.').pop();
			},
			removedfile: function(file) {
				var name = file.upload.filename;
				$.ajax({
					type: 'POST',
					url: 'index.php?route=attachFile/delete',
					data: {
						name: name,
						type: 'invoice'
					},
					error: function() {
						toastr.error('File could not be deleted', 'Server Error');
					},
					success: function(data) {
						$('.attached-' + name.slice(0, -4) + '').remove();
						toastr.success('File Deleted Succefully', 'Success');
					}
				});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			}
		});

		$('.attached-files-block').on('click', '.delete-file a', function() {
			var ele = $(this),
				name = ele.parents('.attached-files-block').find('input').val();
			$.ajax({
				type: 'POST',
				url: 'index.php?route=attachFile/delete',
				data: {
					name: name,
					type: 'invoice'
				},
				error: function() {
					toastr.error('File could not be deleted', 'Server Error');
				},
				success: function(data) {
					$('.attached-' + name.slice(0, -4) + '').remove();
					toastr.success('File Deleted Succefully', 'Success');
				}
			});
			ele.parents('.attached-files-block').remove();
		});
	});
</script>

<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>