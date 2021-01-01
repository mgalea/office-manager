<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>
    $('#setting').show();
    $('#setting-li').addClass('active');</script>
</script>
<!-- Tax list page start -->
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-credit-card panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                    <div class="panel-action">
                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTaxModel"><i class="icon-plus mr-1"></i> <?php echo $lang['settings']['text_new_tax']; ?></a>
                    </div>  
                </div>
                <div class="panel-wrapper">
                    <div class="table-container">
                        <table class="table table-bordered table-striped datatable-table" width="100%">
                            <thead>
                                <tr class="table-heading">
                                    <th class="table-srno">#</th>
                                    <th><?php echo $lang['settings']['text_tax_name']; ?></th>
                                    <th><?php echo $lang['settings']['text_rate']; ?>(%)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result) { foreach ($result as $key => $value) { ?>
                                <tr> 
                                    <td class="table-srno"><?php echo $key+1; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['rate']; ?></td>
                                    <td class="table-action">
                                        <a class="btn btn-info btn-circle btn-outline btn-outline-1x edit-tax" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>" data-name="<?php echo $value['name'] ?>" data-rate="<?php echo $value['rate'] ?>" data-id="<?php echo $value['id'] ?>">
                                            <i class="icon-pencil"></i>
                                        </a>
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
        <div class="col-md-4">
            <?php include (DIR.'app/views/common/setting_menu_finance.tpl.php'); ?>
        </div>
    </div>

</div>
<!-- Delete Modal -->
<div id="delete-card" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
            </div>
            <div class="modal-footer">
                <form action="index.php?route=tax/delete" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- ADD EDIT MODAL -->
<div class="modal fade" id="addTaxModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['settings']['text_new_tax']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <div class="modal-body">
                    <div class="pt-4 pr-5 pl-5 pb-1">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?php echo $lang['settings']['text_tax_name']; ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="<?php echo $lang['settings']['text_tax_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?php echo $lang['settings']['text_rate']; ?> (%)</label>
                            <div class="col-sm-10 input-group">
                                <input type="text" class="form-control" name="rate" placeholder="<?php echo $lang['settings']['text_rate']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="hidden" name="_token" value="<?php echo $token; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-info font-12"><?php echo $lang['common']['text_save']; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //New Tax or Edit Tax Modal ******************

        $('body').on('click', '.edit-tax', function () {
            var ele = $(this);
            $('#addTaxModel input[name="name"]').val(ele.data("name"));
            $('#addTaxModel input[name="rate"]').val(ele.data("rate"));
            $('#addTaxModel input[name="id"]').val(ele.data("id"));
            $('#addTaxModel .modal-title').text('<?php echo $lang['settings']['text_edit_tax']; ?>');
            $('#addTaxModel').modal('show');
        });

        $('#addTaxModel').on('hidden.bs.modal', function (e) {
            $('#addTaxModel .modal-title').text('<?php echo $lang['settings']['text_new_tax']; ?>');
            $('#addTaxModel input[name="name"]').val('');
            $('#addTaxModel input[name="rate"]').val('');
            $('#addTaxModel input[name="id"]').val('');
        });

        $('#finance-tax').addClass('active');
    });
</script>
<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>