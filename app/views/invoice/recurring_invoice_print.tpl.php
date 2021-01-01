<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Dosis:500,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
	<link rel="stylesheet" href="public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="public/css/style.css" />
	<style>.badge { border: 0; }</style>
</head>
<body>
	<div class="div-center mt-3 mb-3">
		<div class="inv-template">
			<div class="inv-template-bdy">
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
<script>
	window.print();
</script>
</body>
</html>