<?php include(DIR_CLIENTS . 'app/views/common/header.tpl.php'); ?>

<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<i class="icon-docs panel-head-icon"></i>
			<span class="panel-title-text"><?php echo $page_title ?></span>
		</div>
		<div class="panel-action">

		</div>
	</div>
	<div class="panel-wrapper">
		<div class="inv-template">
			<div class="inv-template-hdr">
				<div class="row">
					<div class="col-sm-2">
						<div class="ribbon"><?php if ($result['status'] == "Paid") {
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
					<div class="col-sm-10 text-right">
						<a href="<?php echo URL_CLIENTS . DIR_ROUTE . 'invoice/pdf&id=' . $result['id']; ?>" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o mr-2"></i> <?php echo $lang['invoices']['text_pdf']; ?></a>
						<a href="<?php echo URL_CLIENTS . DIR_ROUTE . 'invoice/print&id=' . $result['id']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="icon-printer mr-2"></i> <?php echo $lang['invoices']['text_print']; ?></a>
						<?php if ($result['due'] > "0") { ?>
							<a href="<?php echo URL_CLIENTS . DIR_ROUTE . 'makepayment&invoice=' . $result['id']; ?>" class="btn btn-warning btn-sm"><?php echo $lang['invoices']['text_pay_now']; ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="inv-template-bdy table-responsive">
				<table>
					<tbody>
						<tr class="inv-from-container">
							<td>
								<div class="inv-bill-to">
									<p class="title"><?php echo $info['name']; ?><br></p>
									<p class="body"><?php echo $address['address1']; ?></p>
									<p class="body"><?php echo $address['address2'] . ' ' . $address['city']; ?></p>
									<p class="body"><?php echo $address['country'] . '  ' . $address['pincode']; ?></p>
								</div>
							</td>
							<td class="font-24 text-right">
								<div class="inv-title"><?php echo $lang['common']['text_invoice']; ?></div>
							</td>
						</tr>
						<tr class="inv-meta-container">
							<td>
								<div class="inv-bill-to font-14">
									<p><b><?php echo $lang['invoices']['text_bill_to']; ?></b></p>
									<p class="title"><?php echo $result['company'] ?></p>
									<?php $caddress = json_decode($result['address'], true); ?>
									<p class="body"><?php echo $caddress['address1'] . ',' . $caddress['address2'] . '<br />'; ?></p>
									<p class="body"><?php echo $caddress['city'] . ' ' . $caddress['state'] . '<br />'; ?></p>
									<p class="body"><?php echo $caddress['country'] . '  ' . $caddress['pincode']; ?></p>
									<p class="font-800 font-12">Attention: <?php echo $result['email']; ?></p>
								</div>
							</td>
							<td class="text-right">
								<div class="inv-meta">
									<p><span># : </span><span>INV-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?></span></p>
									<p><span><?php echo $lang['common']['text_created_date']; ?> : </span><span><?php echo date_format(date_create($result['date_of_joining']), 'd-m-Y'); ?></span></p>
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
								foreach ($inv_items as $inv_key => $inv_value) { ?>
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
							} ?>
							<tr class="total">
								<td rowspan="6" colspan="2">
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
				<div class="panel-action"></div>
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
								<td colspan="3" class="text-center"><?php echo $lang['invoices']['text_no_payment_history']; ?></td>
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
				<div class="panel-action"></div>
			</div>
			<div class="panel-body">
				<div class="attached-files">
					<?php if (!empty($attachments)) {
						foreach ($attachments as $key => $value) {
							$file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
							if ($file_ext == "pdf") { ?>
								<div class="attached-files-block">
									<a href="../public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
								</div>
							<?php } else { ?>
								<div class="attached-files-block">
									<a href="../public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery" target="_black"><img src="../public/uploads/<?php echo $value['file_name']; ?>" alt=""></a>
								</div>
					<?php }
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>



<link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
<script src="public/js/jquery.fancybox.min.js"></script>

<script>
	$("a.open-pdf").fancybox({
		'frameWidth': 800,
		'frameHeight': 900,
		'overlayShow': true,
		'hideOnContentClick': false,
		'type': 'iframe'
	});
</script>
<!-- Footer -->
<?php include(DIR_CLIENTS . 'app/views/common/footer.tpl.php'); ?>