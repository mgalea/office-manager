<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<style>
    .expense-foreign-toggle {
        cursor: pointer;
    }
</style>
<script>
    $('#expense-li').addClass('active');
</script>
<script>

        $(document).on('click', '.expense-foreign-toggle', function(e) {
        e.preventDefault();
        var badge = $(this);
        if (badge.data('saving')) {
            return;
        }
        var current = badge.data('foreign') ? 1 : 0;
        var next = current ? 0 : 1;
        badge.data('saving', true);
        $.ajax({
            type: 'POST',
            url: '<?php echo URL . DIR_ROUTE . 'expense/foreign'; ?>',
            data: {
                id: badge.data('id'),
                foreign: next
            },
            dataType: 'json',
            success: function(resp) {
                if (resp && resp.status === 'ok') {
                    var isForeign = next === 1;
                    badge.data('foreign', next);
                    badge.toggleClass('badge-warning', isForeign);
                    badge.toggleClass('badge-success', !isForeign);
                    badge.text(isForeign ? 'Foreign' : 'Local');
                } else if (window.toastr) {
                    toastr.error('Could not update invoice type', 'Error');
                }
            },
            error: function() {
                if (window.toastr) {
                    toastr.error('Could not update invoice type', 'Error');
                }
            },
            complete: function() {
                badge.data('saving', false);
            }
        });
    });
    $(function() {
        if ($.fn.DataTable && !$.fn.DataTable.isDataTable('.datatable-expense')) {
            $('.datatable-expense').DataTable({
                "aLengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "All"]],
                "iDisplayLength": 25,
                "order": [],
                'responsive': true,
                "pagingType": 'full_numbers',
                'language': {
                    "lengthMenu": "_MENU_",
                    "zeroRecords": $('#datatable_no_records').val(),
                    "info": $('#datatable_showing_page').val(),
                    "infoEmpty": $('#datatable_no_records').val(),
                    "infoFiltered": "",
                    "search": '<i class="icon-magnifier"></i>',
                    "paginate": {
                        "first": '<i class="fa fa-angle-double-left"></i>',
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>',
                        "last": '<i class="fa fa-angle-double-right"></i>'
                    }
                }
            });
        }
    });


</script>

<!-- Expense list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-rocket panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                           <a target="_blank"  href="<?php echo URL . DIR_ROUTE . 'expense/export'; ?>" class="btn btn-info btn-sm"><i class="icon-arrow-up-circle ml-1"></i> <?php echo $lang['expenses']['text_export_expense']; ?></a>
     
            <a target="_blank"  href="<?php echo URL . DIR_ROUTE . 'expense/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['expenses']['text_new_expense']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-dark table-striped datatable-expense" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th class="table-srno">#</th>
                            <th><?php echo $lang['common']['text_status']; ?></th>
                            <th><?php echo $lang['expenses']['text_supplier']; ?></th>
                            <th width="10%"><?php echo $lang['expenses']['text_invoice_number']; ?></th>
                            <th width="10%"><?php echo $lang['expenses']['text_purchase_date']; ?></th>
                            <th><?php echo $lang['expenses']['text_purchase_by']; ?></th>
                            <th><?php echo $lang['expenses']['text_purchase_amount']; ?></th>
                            <th>Total VAT</th>
                            <th>Invoice Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($result)) {
                            foreach ($result as $key => $value) { ?>
                                <tr>
                                    <td><?php echo ($key + 1); ?> </td>
                                    <td width="10%" class="table-srno">
                                        <?php

                                        $amount_paid = (int)($value['paid_amount']) / (int)($value['purchase_amount']);

                                        if ($amount_paid == 0) {
                                            echo ' <span class="badge badge-pill badge-pinterest badge-min-size small">unpaid</span>';
                                        }

                                        if ($amount_paid == 1) {
                                            echo ' <span class="badge badge-pill badge-success badge-min-size small">paid</span>';
                                        }

                                        if ($amount_paid > 0 && $amount_paid < 1) {
                                            echo ' <span class="badge badge-pill badge-warning badge-min-size small">partial</span>';
                                        }

                                        if ($amount_paid > 0 && $amount_paid > 1) {
                                            echo ' <span class="badge badge-pill badge-primary badge-min-size small">overpaid</span>';
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $value['supplier']; ?>
                                    </td>
                                    <td><?php echo $value['inv_number']; ?></td>
                                    <td><?php echo date_format(date_create($value['purchase_date']), 'Y-m-d'); ?></td>


                                    <td class="font-14"><?php echo $value['payor']; ?></td>

                                    <td><?php echo $value['abbr'] . ' ' . ltrim($value['purchase_amount'], '0'); ?></td>
                                    <td><?php echo $value['abbr'] . ' ' . ltrim($value['total_vat'], '0'); ?></td>
                                    <td>
                                        <?php
                                        $foreign = !empty($value['foreign']) ? 1 : 0;
                                        $foreign_label = $foreign ? 'Foreign' : 'Local';
                                        $foreign_class = $foreign ? 'badge-warning' : 'badge-success';
                                        ?>
                                        <span class="badge badge-pill <?php echo $foreign_class; ?> expense-foreign-toggle" data-id="<?php echo $value['id']; ?>" data-foreign="<?php echo $foreign; ?>"><?php echo $foreign_label; ?></span>
                                    </td>
                                    <td class="table-action">
                                        <a target="_blank" href="<?php  echo URL . DIR_ROUTE . 'expense/edit&id=' . $value['id']; ?>" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                        <span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></span>
                                    </td>
                                </tr>
                        <?php }
                        } ?>

                    </tbody>
                </table>
            </div>
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
                <form action="<?php echo URL . DIR_ROUTE . 'expense/delete'; ?>" class="delete-card-button" method="post">
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
