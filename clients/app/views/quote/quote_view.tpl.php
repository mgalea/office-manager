<?php include (DIR_CLIENTS.'app/views/common/header.tpl.php'); ?>

<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<i class="icon-calculator panel-head-icon"></i>
			<span class="panel-title-text"><?php echo $page_title; ?></span>
		</div>
		<div class="panel-action">
			
		</div>
	</div>
	<div class="panel-wrapper">
		<div class="panel-body">
			<div class="inv-template">
				<div class="inv-template-hdr">
					<div class="row">
						<div class="col-12 text-right">
							<?php if (empty($result['invoice_id'])) { ?>
							<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#acceptQuote"><i class="icon-docs mr-2"></i> <?php echo $lang['quotes']['text_accept']; ?></a>
							<?php } else { ?>
							<a href="<?php echo URL_CLIENTS.DIR_ROUTE.'invoice/view&id='.$result['invoice_id']; ?>" class="btn btn-primary btn-sm"><i class="icon-docs mr-2"></i> <?php echo $lang['quotes']['text_quotation_invoiced']; ?></a>
							<?php } ?>
							<a href="<?php echo URL_CLIENTS.DIR_ROUTE .'quote/pdf&id='.$result['id']; ?>" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o mr-2"></i> <?php echo $lang['quotes']['text_pdf']; ?></a>
							<a href="<?php echo URL_CLIENTS.DIR_ROUTE .'quote/print&id='.$result['id']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="icon-printer mr-2"></i><?php echo $lang['quotes']['text_print']; ?></a>
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
										<p class="body"><?php echo $address['address2'].' '.$address['city']; ?></p>
										<p class="body"><?php echo $address['country'].'  '.$address['pincode']; ?></p>
									</div>
								</td>
								<td class="font-24 text-right">
									<div class="inv-title"><?php echo $lang['common']['text_quotation']; ?></div>
								</td>
							</tr>
							<tr class="inv-meta-container">
								<td>
									<div class="inv-bill-to">
										<p><?php echo $lang['quotes']['text_quote_to']; ?></p>
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
										<p><span># : </span><span>QTN-<?php echo str_pad($result['id'], 4, '0', STR_PAD_LEFT); ?></span></p>
										<p><span><?php echo $lang['quotes']['text_quote_date']; ?> : </span><span><?php echo date_format(date_create($result['date']), 'd-m-Y'); ?></span></p>
										<p><span><?php echo $lang['quotes']['text_expiry_date']; ?> : </span><span><?php echo date_format(date_create($result['expiry']), 'd-m-Y'); ?></span></p>
										<p><span><?php echo $lang['quotes']['text_payment_method']; ?> : </span><span><?php echo $result['payment_method']; ?></span></p>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="inv-template-item">
						<table>
							<thead>
								<tr>
									<th><?php echo $lang['quotes']['text_item_description']; ?></th>
									<th><?php echo $lang['quotes']['text_quantity']; ?></th>
									<th><?php echo $lang['quotes']['text_unit_cost']; ?> (<?php echo $result['currency_abbr']; ?>)</th>
									<th><?php echo $lang['quotes']['text_tax']; ?> (<?php echo $result['currency_abbr']; ?>)</th>
									<th><?php echo $lang['quotes']['text_price']; ?> (<?php echo $result['currency_abbr']; ?>)</th>
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
								<?php } } if (!empty($result['total'])) { $total = json_decode($result['total'], true); } else { $total = NULL; } ?>
								<tr class="total">
									<td rowspan="4" colspan="2">
										<p><?php echo $result['note']; ?></p>
									</td>
									<td colspan="2"><span><?php echo $lang['quotes']['text_sub_total']; ?></span></td>
									<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$total['subtotal']; ?></span></td>
								</tr>
								<tr class="total">
									<td colspan="2"><span><?php echo $lang['quotes']['text_tax']; ?></span></td>
									<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$total['tax']; ?></span></td>
								</tr>
								<tr class="total">
									<td colspan="2"><span><?php echo $lang['quotes']['text_discount']; ?></span></td>
									<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$total['discount_value']; ?></span></td>
								</tr>
								<tr class="total">
									<td colspan="2"><span><?php echo $lang['quotes']['text_total']; ?></span></td>
									<td colspan="2"><span><?php echo $result['currency_abbr'].' '.$total['amount']; ?></span></td>
								</tr>
								<tr>
									<td colspan="6">
										<p class="font-12"><?php echo $lang['quotes']['text_terms_conditions']; ?></p>
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
</div>

<div class="modal fade" id="acceptQuote">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p><?php echo $lang['quotes']['text_are_you_sure_you_want_to_accept_this_quotation']; ?></p>
			</div>
			<div class="modal-footer">
				<form action="<?php echo URL_CLIENTS.DIR_ROUTE.'convertquote'; ?>" method="post">
					<input type="hidden" name="id" value="<?php echo $result['id']; ?>">
					<button type="submit" name="submit" class="btn btn-info"><?php echo $lang['quotes']['text_yes']; ?></button>
				</form>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['quotes']['text_no']; ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php include (DIR_CLIENTS.'app/views/common/footer.tpl.php'); ?>