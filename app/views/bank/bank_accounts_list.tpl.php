<?php include(DIR . 'app/views/common/header.tpl.php'); ?>

<script>
    $('#corporate').show();
    $('#corporate-li').addClass('active');
</script>

<!-- User list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="far fa-bank panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">

                <a href="<?php echo URL . DIR_ROUTE . 'bank/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['bank']['text_new_account']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-dark table-striped datatable-table" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th><?php echo $lang['bank']['text_name']; ?></th>
                            <th><?php echo $lang['bank']['text_number']; ?></th>
                            <th><?php echo $lang['bank']['text_company']; ?></th>
                            <th><?php echo $lang['bank']['text_bank']; ?></th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($accounts) {
                            foreach ($accounts as $key => $value) { ?>

                                <tr>
                                    <td><a href="<?php echo URL . DIR_ROUTE . 'bank/view&id=' . $value['id']; ?>"><?php echo $value['account_name']; ?></td>
                                    <td><a href="<?php echo URL . DIR_ROUTE . 'bank/view&id=' . $value['id']; ?>"><?php echo $value['account_number']; ?></td>
                                    <td><a href="<?php echo URL . DIR_ROUTE . 'bank/view&id=' . $value['id']; ?>"><?php echo $value['company']; ?></a></td>
                                    <td><a href="<?php echo URL . DIR_ROUTE . 'bank/view&id=' . $value['id']; ?>"><?php echo $value['bank']; ?></a></td>
                                    <td class="table-action">
                                        <p><a href="<?php echo URL . DIR_ROUTE . 'bank_account/edit&id=' . $value['id']; ?>" class="btn btn-primary text-info " data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                            <span class="btn btn-warning text-dark table-delete" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></span>
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
                <form action="<?php echo URL . DIR_ROUTE . 'company/delete'; ?>" class="delete-card-button" method="post">
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