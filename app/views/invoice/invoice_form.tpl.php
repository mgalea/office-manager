<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#invoice-li').addClass('active');
</script>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo $token; ?>">
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
        <div class="panel-wrapper p-3">
            <div class="panel-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group customer-search">
                            <label class="col-form-label"><?php echo $lang['invoices']['text_from']; ?></label>
                            <div class="input-group">

                                <select class="selectpicker" data-width="100%" data-live-search="true" data-placeholder="Select Billing Company" name="invoice[billing_id]">
                                    <?php if (!empty($subsidiaries)) {
                                        foreach ($subsidiaries as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if (isset($result['billing_id']) && $result['billing_id'] == $value['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['name'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group customer-search">
                            <label class="col-form-label"><?php echo $lang['common']['text_customer']; ?></label>
                            <div class="input-group">
                                <select class="selectpicker" name="invoice[customer]" data-width="100%" data-live-search="true" title="<?php echo $lang['common']['text_customer']; ?>" required>
                                    <?php if (!empty($customers)) {
                                        foreach ($customers as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if (isset($result['customer']) && $value['id'] == $result['customer']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['company']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['invoices']['text_due_date']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-event"></i></span>
                                </div>
                                <?php if (!isset($result['duedate'])) {
                                    $result['duedate'] = date("Y/m/d");
                                } ?>
                                <input type="text" id="duedate" name="invoice[duedate]" class="form-control date" value="<?php echo date_format(date_create($result['duedate'])->add(new DateInterval('P30D')), 'd-m-Y') ?>" placeholder="<?php echo $lang['invoices']['text_due_date']; ?>">

                            </div>
                            <a class="badge badge-warning" onclick="document.getElementById('duedate').value = '<?php echo date_format(date_create($result['duedate'])->add(new DateInterval('P1D')), 'd-m-Y') ?>'">On Receipt</a>
                            <a class="badge badge-warning" onclick="document.getElementById('duedate').value = '<?php echo date_format(date_create($result['duedate'])->add(new DateInterval('P15D')), 'd-m-Y') ?>'">15 days</a>
                            <a class="badge badge-warning" onclick="document.getElementById('duedate').value = '<?php echo date_format(date_create($result['duedate'])->add(new DateInterval('P30D')), 'd-m-Y') ?>'">30 days</a>
                            <a class="badge badge-warning" onclick="document.getElementById('duedate').value = '<?php echo date_format(date_create($result['duedate'])->add(new DateInterval('P90D')), 'd-m-Y') ?>'">90 days</a>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['common']['text_currency']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-credit-card"></i></span>
                                </div>
                                <select name="invoice[currency]" class="custom-select" required>
                                    <?php if ($currency) {
                                        foreach ($currency as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if (isset($result['currency']) && $result['currency'] == $value['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['invoices']['text_payment_method']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-credit-card"></i></span>
                                </div>
                                <select name="invoice[paymenttype]" class="custom-select" required>
                                    <option value=""><?php echo $lang['invoices']['text_payment_method']; ?></option>
                                    <?php if ($payment_type) {
                                        foreach ($payment_type as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if (isset($result['paymenttype']) && $result['paymenttype'] == $value['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['invoices']['text_invoice_status']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-check"></i></span>
                                </div>
                                <select name="invoice[inv_status]" class="custom-select" required>
                                    <option value="0" <?php if (isset($result['inv_status']) && $result['inv_status'] == "0") {
                                                            echo "selected";
                                                        } ?>><?php echo $lang['invoices']['text_draft']; ?></option>
                                    <option value="1" <?php if (isset($result['inv_status']) && $result['inv_status'] == "1") {
                                                            echo "selected";
                                                        } ?>><?php echo $lang['invoices']['text_published']; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-items pt-3 ml-3 mr-3">
                <table class="table-input">
                    <thead>
                        <tr>
                            <th><?php echo $lang['invoices']['text_item_name']; ?></th>
                            <th><?php echo $lang['invoices']['text_item_description']; ?></th>
                            <th><?php echo $lang['invoices']['text_quantity']; ?></th>
                            <th><?php echo $lang['invoices']['text_unit_cost']; ?></th>
                            <th><?php echo $lang['invoices']['text_tax']; ?></th>
                            <th><?php echo $lang['invoices']['text_price']; ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($result['items'])) {
                            $inv_items = json_decode($result['items'], true);
                            foreach ($inv_items as $key => $value) { ?>
                                <tr class="item-row">
                                    <td class="">
                                        <textarea name="invoice[item][<?php echo $key; ?>][name]" class="item-name"><?php echo $value['name']; ?></textarea>
                                    </td>
                                    <td class="invoice-item">
                                        <textarea name="invoice[item][<?php echo $key; ?>][descr]" class="item-descr"><?php echo $value['descr']; ?></textarea>
                                    </td>
                                    <td class="">
                                        <textarea type="text" name="invoice[item][<?php echo $key; ?>][quantity]" class="item-quantity"><?php echo $value['quantity']; ?></textarea>
                                    </td>
                                    <td class="">
                                        <textarea type="text" name="invoice[item][<?php echo $key; ?>][cost]" class="item-cost"><?php echo $value['cost']; ?></textarea>
                                    </td>
                                    <td class="invoice-tax">
                                        <?php if (!empty($value['tax'])) {
                                            foreach ($value['tax'] as $tax_key => $tax_value) { ?>
                                                <p class="badge badge-light badge-sm badge-pill">
                                                    <?php echo $tax_value['name']; ?>
                                                    <input type="text" name="invoice[item][<?php echo $key ?>][tax][<?php echo $tax_key ?>][tax_price]" class="single-tax-price" value="<?php echo $tax_value['tax_price']; ?>" readonly>
                                                    <input type="hidden" name="invoice[item][<?php echo $key ?>][tax][<?php echo $tax_key ?>][id]" class="invoice-tax-id" value="<?php echo $tax_value['id']; ?>">
                                                    <input type="hidden" name="invoice[item][<?php echo $key ?>][tax][<?php echo $tax_key ?>][name]" value="<?php echo $tax_value['name']; ?>">
                                                    <input type="hidden" class="invoice-tax-rate" name="invoice[item][<?php echo $key ?>][tax][<?php echo $tax_key ?>][rate]" value="<?php echo $tax_value['rate']; ?>">
                                                </p>
                                        <?php }
                                        } ?>
                                        <input type="hidden" name="invoice[item][<?php echo $key; ?>][taxprice]" class="item-tax-price" value="<?php echo $value['taxprice']; ?>" readonly>
                                    </td>
                                    <td>
                                        <textarea type="text" name="invoice[item][<?php echo $key; ?>][price]" class="item-total-price" readonly><?php echo $value['price']; ?></textarea>
                                        <input type="hidden" class="item-price" value="<?php echo $value['price']; ?>">
                                    </td>
                                    <td>
                                        <a class="badge badge-warning badge-sm badge-pill add-taxes m-1"><?php echo $lang['invoices']['text_add_taxes']; ?></a>
                                        <a class="badge badge-danger badge-sm badge-pill delete m-1"><?php echo $lang['common']['text_delete']; ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } else {  ?>
                            <tr class="item-row">
                                <td class="">
                                    <textarea name="invoice[item][0][name]" class="item-name"></textarea>
                                </td>
                                <td class="invoice-item">
                                    <textarea name="invoice[item][0][descr]" class="item-descr"></textarea>
                                </td>
                                <td class="">
                                    <textarea type="text" name="invoice[item][0][quantity]" class="item-quantity">1</textarea>
                                </td>
                                <td class="">
                                    <textarea type="text" name="invoice[item][0][cost]" class="item-cost"></textarea>
                                </td>
                                <td class="invoice-tax">
                                    <input type="hidden" name="invoice[item][0][taxprice]" class="item-tax-price" value="0" readonly>
                                </td>
                                <td class="">
                                    <textarea type="text" name="invoice[item][0][price]" class="item-total-price" readonly></textarea>
                                    <input type="hidden" class="item-price">
                                </td>
                                <td>
                                    <a class="badge badge-warning badge-sm badge-pill add-taxes m-1"><?php echo $lang['invoices']['text_add_taxes']; ?></a>
                                    <a class="badge badge-danger badge-sm badge-pill delete m-1"><?php echo $lang['common']['text_delete']; ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" class="p-2">
                                <div class="add-items d-inline-block">
                                    <a class="btn btn-success btn-sm m-1"><i class="icon-plus mr-1"></i> <?php echo $lang['invoices']['text_add_item']; ?></a>
                                </div>
                            </td>
                            <td colspan="2" class="total-line">
                                <label><?php echo $lang['invoices']['text_sub_total']; ?></label>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[subtotal]" class="form-transparent sub-total" value="<?php if (isset($result['subtotal'])) echo $result['subtotal'] ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="blank">
                            </td>
                            <td colspan="2" class="total-line">
                                <label><?php echo $lang['invoices']['text_tax']; ?></label>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[tax]" class="form-transparent tax-total" value="<?php if (isset($result['tax'])) echo $result['tax'] ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="blank">
                            </td>
                            <td colspan="2" class="total-line">
                                <div class="row align-items-center">
                                    <div class="col-8"><label><?php echo $lang['invoices']['text_discount']; ?></label></div>
                                    <div class="col-4">
                                        <select name="invoice[discounttype]" class="form-control discount-type">
                                            <option value="1" <?php if (isset($result['discount_type']) && $result['discount_type'] == 1) {
                                                                    echo "selected";
                                                                } ?>>%</option>
                                            <option value="2" <?php if (isset($result['discount_type']) && $result['discount_type'] == 2) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_flat']; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[discount]" class="form-transparent discount-total" value="<?php if (isset($result['discount'])) echo $result['discount']; ?>">
                                <input type="hidden" class="discount_amount" name="invoice[discount_value]" value="<?php if (isset($result['discount_value'])) echo $result['discount_value']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="blank">
                            </td>
                            <td colspan="2" class="total-line">
                                <label><?php echo $lang['invoices']['text_total']; ?></label>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[amount]" class="form-transparent  total-amount" value="<?php if (isset($result['amount'])) {
                                                                                                                            echo $result['amount'];
                                                                                                                        } else {
                                                                                                                            echo '';
                                                                                                                        } ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="blank">
                            </td>
                            <td colspan="2" class="total-line">
                                <label><?php echo $lang['invoices']['text_paid']; ?></label>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[paid]" class="form-transparent paid-amount" value="<?php if (isset($result['paid']))  echo $result['paid'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="blank">
                            </td>
                            <td colspan="2" class="total-line">
                                <label><?php echo $lang['invoices']['text_due']; ?></label>
                            </td>
                            <td colspan="2" class="total-value">
                                <input type="text" name="invoice[due]" class="form-transparent due-amount" value="<?php if (isset($result['due'])) echo $result['due'] ?>" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pt-5">


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $lang['invoices']['text_customer_note']; ?></label>
                                <textarea class="form-control" name="invoice[note]" rows="3"><?php if (isset($result['note '])) echo $result['note']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $lang['invoices']['text_terms_Conditions']; ?></label>
                                <textarea class="form-control" name="invoice[tc]" rows="3"><?php if (isset($result['tc'])) echo $result['tc']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['invoices']['text_payment_status']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-check"></i></span>
                                    </div>
                                    <?php if (!isset($result['status'])) $result['status'] = "Unpaid"; ?>
                                    <select name="invoice[status]" id="" class="custom-select" required>
                                        <option value="Paid" <?php if ("paid" == $result['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_paid']; ?></option>
                                        <option value="Partially Paid" <?php if ("Partially Paid" == $result['status']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $lang['invoices']['text_partially_paid']; ?></option>
                                        <option value="Unpaid" <?php if ("Unpaid" == $result['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_unpaid']; ?></option>
                                        <option value="Pending" <?php if ("Pending" == $result['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_pending']; ?></option>
                                        <option value="In Process" <?php if ("In Process" == $result['status']) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $lang['invoices']['text_in_process']; ?></option>
                                        <option value="Cancelled" <?php if ("Cancelled" == $result['status']) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $lang['invoices']['text_cancelled']; ?></option>
                                        <option value="Other" <?php if ($lang['invoices']['text_other'] == $result['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_other']; ?></option>
                                        <option value="Unknown" <?php if ("Unknown" == $result['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $lang['invoices']['text_unknown']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['invoices']['text_paid_date']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" name="invoice[paiddate]" class="form-control date" value="<?php if (isset($result['paiddate'])) echo date_format(date_create($result['paiddate']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['invoices']['text_paid_date']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" name="submit" class="btn btn-info"><?php echo $lang['common']['text_save']; ?></button>
                </div>
            </div>
        </div>
        <input type="hidden" class="items" value="<?php echo htmlspecialchars(htmlspecialchars_decode(json_encode($items), JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <input type="hidden" class="lang_add_tax" value="<?php echo $lang['invoices']['text_add_taxes']; ?>">
        <input type="hidden" class="lang_delete" value="<?php echo $lang['common']['text_delete']; ?>">
    </div>
</form>

<div class="modal fade" id="addTax">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['invoices']['text_tax']; ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php if ($taxes) {
                    foreach ($taxes as $key => $value) { ?>
                        <div class="custom-control custom-checkbox custom-checkbox-1 mb-3">
                            <input type="checkbox" class="custom-control-input" id="inv-taxes-<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>" data-rate="<?php echo $value['rate'] ?>" data-name="<?php echo $value['name'] ?>" name="modaltax">
                            <label class="custom-control-label" for="inv-taxes-<?php echo $value['id'] ?>"><?php echo $value['name'] . ' (' . $value['rate'] . '%)'; ?></label>
                        </div>
                <?php }
                } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add-modal-taxes"><?php echo $lang['invoices']['text_add_taxes']; ?></button>
            </div>
        </div>
    </div>
</div>

<script>
</script>

<script src="public/js/invoice.js"></script>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>