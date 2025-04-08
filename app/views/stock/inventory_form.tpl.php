<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#setting').show();
    $('#setting-li').addClass('active');
</script>
<link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
<script src="public/js/jquery.fancybox.min.js"></script>

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
            <input type="hidden" name="id" value="<?php echo isset($result['id']) ? $result['id'] : '' ?>">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <div class="mt-3">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_name']; ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo isset($result['item']) ? $result['item'] : '' ?>" name="item" placeholder="<?php echo $lang['inventory']['text_inventory_name']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_type']; ?></label>
                    <div class="col-sm-4">
                        <select class="custom-select background-default" name="type">
                            <option value="0" selected disabled><?php echo $lang['inventory']['text_select_category']; ?></option>
                            <?php if (!empty($type)) {
                                foreach ($type as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($result['type']) && $result['type'] == $value['id']) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $value['name']; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_item_location']; ?></label>
                    <div class="col-sm-4">
                        <select class="custom-select background-default" name="location">
                            <option value="0" ?><?php echo $lang['inventory']['text_select_location']; ?></option>
                            <?php if (!empty($location)) {

                                foreach ($location as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($result['location']) && $result['location'] == $value['id']) {
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
                        <input type="text" class="form-control" value="<?php echo isset($result['storage']) ? $result['storage'] : '' ?>" name="stored" placeholder="<?php echo $lang['inventory']['text_item_stored']; ?>">
                    </div>
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_inventory_number']; ?></label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" value="<?php echo (empty($result['inv_number']) ? '1' :  $result['inv_number']) ?>" name="inv_number" placeholder="<?php echo $lang['inventory']['text_inventory_number']; ?> " required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['inventory']['text_quantity']; ?></label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" value="<?php echo (empty($result['quantity']) ? '1' :  $result['quantity'])  ?>" min="1" name="quantity" placeholder="<?php echo $lang['inventory']['text_quantity']; ?>">
                    </div>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="stock" name="stock" class="custom-control-input" value="1" <?php if (isset($result['is_stock']) && $result['is_stock'] == "1") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
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
                        <input type="text" class="form-control date" name="purchase_date" value="<?php if (isset($result['purchase_date'])) echo date_format(date_create($result['purchase_date']), 'Y-m-d'); ?>" placeholder="<?php date_format(new DateTime(), 'Y-m-d'); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $lang['common']['text_description']; ?></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="description" value="" placeholder="<?php echo $lang['common']['text_description']; ?>"><?php echo isset($result['description']) ? $result['description'] : '' ?></textarea>
                    </div>
                </div>

            </div>
</form>
<div class="form-group row">
    <div class="col-sm-12 col-md-6">
        <div class="tab-pane" id="documents">

            <div class="attach-file col-md-10">
                <a data-toggle="modal" class="text-white bg-primary float-left" data-target="#attach-file"><?php echo $lang['inventory']['text_upload_file']; ?></a>
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
                <?php }
                    }
                } ?>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="tab-pane" id="images">

            <div class="attach-file col-md-10">
                <a data-toggle="modal" class="text-white bg-primary float-right" data-target="#attach-picture"><?php echo $lang['inventory']['text_upload_image']; ?></a>
            </div>
            <div class="attached-images">
                <?php if (!empty($documents)) {
                    foreach ($documents as $key => $value) {
                        $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                        if ($file_ext == "png" || $file_ext == "jpg") { ?>
                            <div class="attached-files-block">
                                <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-image"><i class="fa fa-file-image"></i></a>
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

<!-- Attach File Modal -->
<div id="attach-file" class="modal hide fade" role="dialog">
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


<div id="attach-picture" class="modal hide fade" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="webcam" class="mx-auto" style="display:flex; flex-direction: column; align-items:center;justify-content:center">
                <p><span id="errorMsg"></span></p>
                <div class="row modal-header">
                    <div class="select">
                        <label id="myModalLabel" for="videoSource">Camera: </label>
                        <select id="videoSource"></select>
                    </div>

                    <div class="mx-auto live-cam">
                        <video id="video" playsinline autoplay controls width="480" height="405"></video>
                    </div>
                </div>
                <div class="row">
                    <h4>
                        <button class="btn btn-primary mx-auto mt-3" id="btnImageCapture">Take Picture</button>
                    </h4>
                </div>
            </div>
            <canvas style="display:none"></canvas>
            <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>

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
                        var id = $('input[name=id]').val();
                        type = 'inventory';
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
                                '<div class="delete-file"><a class="icon-trash"></a></div>' + '<div class="font-8">' + file.xhr.response + '</div>' +
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
                    type: 'inventory'
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

<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="public/js/scan.js" async></script>

<script>
    function saveImgtoDB(file_type) {
        drawVideoCanvas();

        canvas.toBlob(
            function(blob) {
                var id = $("input[name=id]").val();
                const d = new Date();
                let time = d.getTime();
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "index.php?route=attachFile", false);
                xhr.onreadystatechange = function() {
                    console.log(xhr.responseText);
                    $('#attach-scan').modal('toggle');
                    $('#attach-scan').modal('hide');
                };
                const filename = id + "_" + time + "_img.jpg";
                const formData = new FormData();
                formData.append("file", blob, filename);
                formData.append("type", file_type);
                formData.append("id", id);
                xhr.send(formData);
            },
            'image/jpeg', 0.85
        );
    }

    const buttonCapture = document.querySelector("#btnImageCapture");

    buttonCapture.onclick = function(e) {
        e.preventDefault();
        saveImgtoDB("inventory");
    };
</script>

<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>