<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#quotes-li').addClass('active');</script>

<div class="panel panel-default">
	<div class="panel-head">
		<div class="panel-title">
			<i class="icon-calculator panel-head-icon"></i>
			<span class="panel-title-text"><?php echo $page_title; ?></span>
		</div>
		<div class="panel-action">

                <a href="<?php echo URL.DIR_ROUTE . 'quotes'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list'] ?>"><i class="fa fa-reply"></i></a>
            
        </div>
	</div>
	<div class="panel-wrapper">
		<div class="inv-template">
			<div class="inv-template-hdr">
				<div class="row">
					<div class="col-12 text-right">
						<?php if ($result['invoice_id'] == "0" && empty($result['invoice_id'])) { ?>
						<a href="<?php echo URL.DIR_ROUTE .'quote/autoinvoice&id='.$result['id']; ?>" class="btn btn-secondary btn-sm"><i class="icon-printer mr-2"></i><?php echo $lang['quotes']['text_convert_to_invoice']; ?></a>
						<?php } else { ?>
						<a href="<?php echo URL.DIR_ROUTE .'invoice/view&id='.$result['invoice_id']; ?>" class="btn btn-primary btn-sm"><i class="icon-printer mr-2"></i><?php echo $lang['quotes']['text_quotation_invoiced']; ?></a>
						<?php } ?>
						<a href="<?php echo URL.DIR_ROUTE .'quote/pdf&id='.$result['id']; ?>" class="btn btn-danger btn-sm" target="_blank"><i class="far fa-file-pdf mr-2"></i> <?php echo $lang['quotes']['text_pdf']; ?></a>
						<a href="<?php echo URL.DIR_ROUTE .'quote/print&id='.$result['id']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="icon-printer mr-2"></i><?php echo $lang['quotes']['text_print']; ?></a>
						<a href="<?php echo URL.DIR_ROUTE .'quote/edit&id='.$result['id']; ?>" class="btn btn-info btn-sm"><i class="icon-pencil mr-2"></i> <?php echo $lang['common']['text_edit']; ?></a>
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
									<p><?php echo $lang['quotes']['text_quote_to']; ?></p>
									<p class="title"><?php echo $result['customer_name']; ?></p>
									<?php $caddress = json_decode($result['customer_address'], true); ?>
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
									<p class="font-12"><?php echo $lang['quotes']['text_terms_Conditions']; ?></p>
									<p class="font-16"><?php echo $result['tc']; ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="inv-template-ftr"></div>
		</div>
	</div>
</div>

<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>