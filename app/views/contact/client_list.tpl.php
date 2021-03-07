<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#contact').show();
    $('#contact-li').addClass('active');
</script>
<!-- User list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-diamond panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?> </span>
            </div>
            <div class="panel-action">
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-dark table-striped datatable-table dataTable no-footer dtr-inline" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th class="table-srno">#</th>
                            <th><?php echo $lang['common']['text_contact'] . ' ' . $lang['common']['text_name']; ?></th>
                            <th><?php echo $lang['common']['text_email_address']; ?></th>
                            <th><?php echo $lang['common']['text_action']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result) {
                            foreach ($result as $key => $value) { ?>
                                <tr>
                                    <td class="table-srno"><?php echo $key + 1; ?></td>
                                    <td><a class="font-14"><?php echo $value['name']; ?></a></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td class="table-action">
                                        <a href="<?php echo URL . DIR_ROUTE . 'client/edit&id=' . $value['id']; ?>" class="btn btn-primary text-info  btn-square " data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                        <p class="btn text-dark btn-warning btn-square table-delete" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></p>
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
                <form action="<?php echo URL . DIR_ROUTE . 'client/delete'; ?>" class="delete-card-button" method="post">
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