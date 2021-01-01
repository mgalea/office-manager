<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#setting').show();
    $('#setting-li').addClass('active');
</script>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default col-lg-8">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-list panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                <a href="<?php echo URL . DIR_ROUTE . 'inventory'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper p-3">
            <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <div class="mt-3">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_name']; ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $result['item'] ?>" name="item" placeholder="<?php echo $lang['inventory']['text_inventory_name']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_type']; ?></label>
                    <div class="col-sm-4">
                        <select class="custom-select background-default" name="type">
                            <?php if (!empty($type)) {
                                foreach ($type as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php if ($result['type'] == $value['id']) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $value['name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_item_location']; ?></label>
                    <div class="col-sm-4">
                        <select class="custom-select background-default" name="location">
                            <?php if (!empty($location)) {
                                foreach ($location as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php if ($result['location'] == $value['id']) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $value['name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_item_stored']; ?></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $result['storage'] ?>" name="stored" placeholder="<?php echo $lang['inventory']['text_item_stored']; ?>" >
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_number']; ?></label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" value="<?php echo (empty($result['inv_number'])? '1':  $result['inv_number'] ) ?>" name="inv_number" placeholder="<?php echo $lang['inventory']['text_inventory_number']; ?> " required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_quantity']; ?></label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" value="<?php echo (empty($result['quantity'])? '1':  $result['quantity'] )  ?>" min="1" name="quantity" placeholder="<?php echo $lang['inventory']['text_quantity']; ?>">
                    </div>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="stock" name="stock" class="custom-control-input" value="1" <?php if ($result['is_stock'] == "1") {
                                                                                                                        echo "checked";
                                                                                                                    } ?> >
                            <label class="custom-control-label" for="stock"><?php echo $lang['inventory']['text_stock']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="col-form-label"><?php echo $lang['inventory']['text_purchase_date']; ?></label>
                    </div>
                    <div class="col-sm-4 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control date" name="purchase_date" value="<?php echo date_format(date_create($result['purchase_date']), 'Y-m-d'); ?>" placeholder="<?php echo $lang['inventory']['text_purchase_date']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['common']['text_description']; ?></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="description" placeholder="<?php echo $lang['common']['text_description']; ?>"><?php echo $result['description'] ?></textarea>
                    </div>
                </div>

            </div>
            <div class="form-group row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-10">
                    <div class="tab-pane" id="documents">
                        <div class="form-group row pb-3">
                            <div class="attach-file col-md-10">
                                <a data-toggle="modal" class="text-white bg-primary float-right" data-target="#attach-file"><?php echo $lang['inventory']['text_upload_image']; ?></a>
                            </div>
                        </div>
                        <div class="attached-files">
                            <?php if (!empty($documents)) {
                                foreach ($documents as $key => $value) {
                                    $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                                    if ($file_ext == "pdf") { ?>
                                        <div class="attached-files-block">
                                            <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i></a>
                                            <input type="hidden" name="inventory[attached][]" value="<?php echo $value['file_name']; ?>">
                                            <div class="delete-file"><a class="icon-trash"></a></div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="attached-files-block">
                                            <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""></a>
                                            <input type="hidden" name="inventory[attached][]" value="<?php echo $value['file_name']; ?>">
                                            <div class="delete-file"><a class="icon-trash"></a></div>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
                <button type="submit" name="submit" class="btn btn-info"><?php echo $lang['common']['text_save']; ?></button>
            </div>
        </div>
</form>
<!-- Attach File Modal -->
<div id="attach-file" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['inventory']['text_upload_image']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="index.php?route=attachFile" class="dropzone" id="attach-file-upload"></form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
<script src="public/js/jquery.fancybox.min.js"></script>

<script>
    $(document).ready(function() {

        $("a.open-pdf").fancybox({
            'frameWidth': 800,
            'frameHeight': 900,
            'overlayShow': true,
            'hideOnContentClick': false,
            'type': 'iframe'
        });

        $("#attach-file-upload").dropzone({
            addRemoveLinks: true,
            acceptedFiles: "image/*,application/pdf,application/doc",
            maxFilesize: 50000,
            dictDefaultMessage: '<?php echo $lang['common']['text_drop_message'] . '<br /><br />' . $lang['common']['text_allowed_file']; ?>',
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                        var id = $('input[name=id]').val(),
                            type = 'project';
                        formData.append("id", id);
                        formData.append("type", type);
                    }),
                    this.on("success", function(file, xhr) {
                        var ext = file.xhr.response.substr(file.xhr.response.lastIndexOf('.') + 1);
                        if (ext === "pdf") {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" class="open-pdf"><i class="fa fa-file-pdf"></i></a>' +
                                '<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="icon-trash"></a></div>' + '<div class="font-8">' + file.xhr.response + '</div>' +
                                '</div>');
                        } else {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" data-fancybox="gallery"><img src="public/uploads/' + file.xhr.response + '" alt=""></a>' +
                                '<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="icon-trash"></a></div>' + '<div class="font-8">' + file.xhr.response + '</div>'+
                                '</div>');
                        }
                        toastr.success('Document added Succefully', 'Success');
                    })
            },
            renameFile: function(file) {
                return file.name.split('.')[0] + new Date().valueOf() + "." + file.name.split('.').pop();
            },
            removedfile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: 'index.php?route=attachFile/delete',
                    data: {
                        name: name,
                        type: 'project'
                    },
                    error: function() {
                        toastr.error('File could not be deleted', 'Server Error');
                    },
                    success: function(data) {
                        $('.attached-' + name.slice(0, -4) + '').remove();
                        toastr.success('File Deleted Succefully', 'Success');
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

        $('.attached-files-block').on('click', '.delete-file a', function() {
            var ele = $(this),
                name = ele.parents('.attached-files-block').find('input').val();
            $.ajax({
                type: 'POST',
                url: 'index.php?route=attachFile/delete',
                data: {
                    name: name,
                    type: 'project'
                },
                error: function() {
                    toastr.error('File could not be deleted', 'Server Error');
                },
                success: function(data) {
                    $('.attached-' + name.slice(0, -4) + '').remove();
                    toastr.success('File Deleted Succefully', 'Success');
                }
            });
            ele.parents('.attached-files-block').remove();
        });
    });
</script>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>