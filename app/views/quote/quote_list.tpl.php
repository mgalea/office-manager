<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#quotes-li').addClass('active');</script>
<!-- Project list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-calculator panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL.DIR_ROUTE . 'quote/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['quotes']['text_new_quote']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-striped table-dark datatable-table" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th>#</th>
                            <th><?php echo $lang['quotes']['text_project_name']; ?></th>
                            <th><?php echo $lang['common']['text_customer']; ?></th>
                            <th><?php echo $lang['common']['text_created_date']; ?></th>
                            <th><?php echo $lang['quotes']['text_expiry_date']; ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result) { foreach ($result as $key => $value) { ?>
                        <tr>
                            <td><a href="<?php echo URL.DIR_ROUTE . 'quote/view&id=' .$value['id']; ?>" class="text-primary font-14">QTN-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                            <td><?php echo $value['project_name']; ?></td>
                            <td><a href="<?php echo URL.DIR_ROUTE . 'contact/edit&id=' .$value['customer']; ?>" class="text-primary font-14" target="_blank"><?php echo $value['company']; ?></a></td>
                            <td><?php echo date_format(date_create($value['date']), 'd-m-Y'); ?></td>
                            <td><?php echo date_format(date_create($value['expiry']), 'd-m-Y'); ?></td>
                            <td class="table-action">
                                <a href="<?php echo URL.DIR_ROUTE . 'quote/view&id=' .$value['id']; ?>" class="btn btn-success" data-toggle="tooltip" title="<?php echo $lang['common']['text_view']; ?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo URL.DIR_ROUTE . 'quote/edit&id=' .$value['id']; ?>" class="btn btn-primary text-info  " data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                <p class="btn btn-danger btn-circle btn-outline btn-outline-1x table-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id'] ?>"></p>
                            </td>
                        </tr>
                        <?php } } ?>
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
                <form action="<?php echo URL.DIR_ROUTE . 'quote/delete'; ?>" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>