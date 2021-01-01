<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#domain-li').addClass('active');</script>
<!-- Expense list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-rocket panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL.DIR_ROUTE . 'domain/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['domain']['text_new_domain']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-bordered table-striped datatable-table" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th class="table-srno">#</th>
                            <th><?php echo $lang['common']['text_name']; ?></th>
                            <th><?php echo $lang['domain']['text_url']; ?></th>
                            <th><?php echo $lang['common']['text_customer']; ?></th>
                            <th><?php echo $lang['domain']['text_provider']; ?></th>
                            <th><?php echo $lang['domain']['text_expiry_date']; ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($result)) { foreach ($result as $key => $value) { ?>
                        <tr>
                            <td class="table-srno"><?php echo $key+1; ?></td>
                            <td class="font-14"><?php echo $value['name']; ?></td>
                            <td><a href="<?php echo $value['url']; ?>" class="text-primary" target="_blank"><?php echo $value['url']; ?></a></td>
                            <td><a href="<?php echo URL.DIR_ROUTE.'contact/edit&id='.$value['customer']; ?>" class="text-primary"><?php echo $value['company']; ?></a></td>
                            <td><?php echo $value['provider']; ?></td>
                            <td>
                                <?php if ($value['expire'] == 1) { ?>
                                <span class="badge badge-danger badge-pill"><?php echo date_format(date_create($value['expiry_date']), 'd-m-Y'); ?></span>
                                <?php } else { ?>
                                <span class="badge badge-light badge-pill"><?php echo date_format(date_create($value['expiry_date']), 'd-m-Y'); ?></span>
                                <?php } ?>
                            </td>
                            <td class="table-action">
                                <a href="<?php echo URL.DIR_ROUTE . 'domain/edit&id=' .$value['id']; ?>" class="btn btn-info btn-circle btn-outline btn-outline-1x" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                <p class="btn btn-danger btn-circle btn-outline btn-outline-1x table-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></p>
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
                <form action="<?php echo URL.DIR_ROUTE . 'domain/delete'; ?>" class="delete-card-button" method="post">
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