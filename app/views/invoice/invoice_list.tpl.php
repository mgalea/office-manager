<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#invoice-li').addClass('active');
</script>
<!-- Invoice list page start -->
<div class="panel panel-default">
    <div class="panel-head">
        <div class="panel-title">
            <i class="icon-docs panel-head-icon"></i>
            <span class="panel-title-text"><?php echo $page_title; ?></span>
        </div>
        <div class="panel-action">
            <a href="<?php echo URL . DIR_ROUTE . 'invoice/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['invoices']['text_new_invoice']; ?></a>
        </div>
    </div>
    <div class="panel-wrapper">
        <div class="table-container">
            <table class="table table-striped table-dark datatable-table" width="100%">
                <thead>
                    <tr class="table-heading">
                        <th><?php echo $lang['invoices']['text_invoice_date']; ?></th>
                        <th>#</th>
                        <th><?php echo $lang['common']['text_customer']; ?></th>
                        <th><?php echo $lang['common']['text_subsidiary']; ?></th>
                        <th><?php echo $lang['invoices']['text_amount']; ?></th>
                        <th><?php echo $lang['invoices']['text_due']; ?></th>
                        <th><?php echo $lang['invoices']['text_payment_status']; ?></th>
                        <th><?php echo $lang['common']['text_status']; ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($result)) {
                        foreach ($result as $key => $value) { ?>
                            <tr>
                                <td><?php echo date_format(date_create($value['inv_date']), 'd-m-Y'); ?></td>
                                <td><a href="<?php echo URL . DIR_ROUTE . 'invoice/view&id=' . $value['id']; ?>" class="text-warning">INV-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                                <td><a href="<?php echo URL . DIR_ROUTE . 'company/view&id=' . $value['customer']; ?>" class="text-warning" target="_blank"><?php echo $value['customer_name']; ?></a></td>
                                <td><a href="<?php echo URL . DIR_ROUTE . 'company/view&id=' . $value['customer']; ?>" class="text-warning" target="_blank"><?php echo $value['subsidiary']; ?></a></td>
                                <td><?php echo $value['abbr'] . ' ' . $value['amount']; ?></td>
                                <td><?php echo $value['abbr'] . ' ' . $value['due']; ?></td>
                                <td>
                                    <?php if ($value['status'] == "Paid") { ?>
                                        <span class="badge badge-Paid badge-pill badge-sm badge-success"><?php echo $lang['invoices']['text_paid']; ?></span>
                                    <?php } elseif ($value['status'] == "Unpaid") { ?>
                                        <span class="badge badge-Unpaid badge-pill badge-sm badge-danger"><?php echo $lang['invoices']['text_unpaid']; ?></span>
                                    <?php } elseif ($value['status'] == "Pending") { ?>
                                        <span class="badge badge-Pending badge-pill badge-sm badge-warning"><?php echo $lang['invoices']['text_pending']; ?></span>
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

                                <td>
                                    <?php if ($value['inv_status'] == "0") { ?>
                                        <span class="badge badge-light badge-pill badge-sm"><?php echo $lang['invoices']['text_draft'] ?></span>
                                    <?php } else { ?>
                                        <span class="badge badge-default badge-pill badge-success badge-sm"><?php echo $lang['invoices']['text_published'] ?></span>
                                    <?php } ?>
                                </td>
                                <td class="table-action">
                                    <a target="_blank" href="<?php echo URL . DIR_ROUTE . 'invoice/view&id=' . $value['id']; ?>" class="btn btn-success " data-toggle="tooltip" title="<?php echo $lang['common']['text_view']; ?>"><i class="fa fa-eye"></i></a>
                                    <a target="_blank" href="<?php echo URL . DIR_ROUTE . 'invoice/edit&id=' . $value['id']; ?>" class="btn btn-primary text-info  " data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                    <p class="btn btn-warning  text-dark table-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></p>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="delete-card" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
            </div>
            <div class="modal-footer">
                <form action="index.php?route=invoice/delete" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>