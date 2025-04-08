<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#expense-li').addClass('active');
</script>
<div class='row'>
    <div class="col-10 mx-auto">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-rocket panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                    <div class="panel-action">
                        <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                        <a href="<?php echo URL . DIR_ROUTE . 'expenses'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
                    </div>
                </div>
                <div class="panel-wrapper p-3">
                    <input type="hidden" name="_token" value="<?php echo $token; ?>">
                    <div class="mt-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['expenses']['text_payee']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <select class="custom-select" name="expense[supplier_id]" required>
                                            <option value="0"><?php echo $lang['expenses']['text_payee']; ?></option>
                                            <?php if (!empty($suppliers)) {
                                                foreach ($suppliers as $key => $value) { ?>
                                                    <option value=" <?php echo $value['id'] ?>" <?php if (isset($result['supplier_id']) && $result['supplier_id'] == $value['id']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $value['name'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['expenses']['text_invoice_number']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                                        </div>
                                        <input type="text" name="expense[inv_number]" class="form-control" value="<?php if (isset($result['inv_number'])) echo $result['inv_number']; ?>" placeholder="<?php echo $lang['expenses']['text_invoice_number']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['expenses']['text_purchase_by']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <select name="expense[purchaseby]" class="custom-select">
                                            <option value=""><?php echo $lang['expenses']['text_purchase_by']; ?></option>
                                            <?php if (!empty($subsidiaries)) {
                                                foreach ($subsidiaries as $key => $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php if (isset($result['purchase_by']) && $result['purchase_by'] == $value['id']) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                        <?php echo $value['name'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_purchase_date']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" name="expense[purchasedate]" class="form-control date" value="<?php if (isset($result['purchase_date'])) echo date_format(date_create($result['purchase_date']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['expenses']['text_purchase_date']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['common']['text_currency']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-euro-sign"></i></span>
                                    </div>
                                    <select name="expense[currency]" class="custom-select" required>
                                        <?php if (!empty($currency)) {
                                            foreach ($currency as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if (isset($result['currency']) && $result['currency'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $value['name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_purchase_amount']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-coins"></i></span>
                                    </div>
                                    <input type="text" name="expense[amount]" class="form-control" value="<?php if (isset($result['purchase_amount'])) echo ltrim($result['purchase_amount'], '0'); ?>" placeholder="<?php echo $lang['expenses']['text_purchase_amount']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['expenses']['text_charge_client']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <select class="custom-select" name="expense[charge_client_id]" required>
                                            <option value="0">Select Client</option>
                                            <?php if (!empty($clients)) {
                                                foreach ($clients as $key => $value) { ?>
                                                    <option value=" <?php echo $value['id'] ?>" <?php if (isset($result['charge_client_id']) &&  $result['charge_client_id'] == $value['id']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $value['name'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3  col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_paid_date']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" name="expense[paiddate]" class="form-control date" value="<?php if (isset($result['paid_date'])) echo date_format(date_create($result['paid_date']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['expenses']['text_paid_date']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_amount_paid']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                    </div>

                                    <input type="text" name="expense[paid_amount]" class="form-control" value="<?php if (isset($result['paid_amount'])) echo $result['paid_amount']; ?>" placeholder="<?php echo $lang['expenses']['text_amount_paid']; ?>" required>
                                </div>

                            </div>
                            <div class="col-sm-4 col-lg-4 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_payment_method']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-credit-card"></i></span>
                                    </div>
                                    <select name="expense[paymenttype]" class="custom-select">
                                        <option value=""><?php echo $lang['expenses']['text_payment_method']; ?></option>
                                        <?php if (!empty($paymenttype)) {
                                            foreach ($paymenttype as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if (isset($result['payment_type']) && $result['payment_type'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $value['name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_expense_type']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-badge"></i></span>
                                    </div>
                                    <select class="custom-select" name="expense[expensetype]">
                                        <?php if (!empty($expensetype)) {
                                            foreach ($expensetype as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if (isset($result['expense_type']) && $result['expense_type'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $value['name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="col-form-label"><?php echo $lang['common']['text_description']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-speech"></i></span>
                                    </div>
                                    <textarea name="expense[description]" class="form-control" rows="10"><?php if (isset($result['description']))  echo $result['description']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($result['id'])) { ?>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-1"><?php echo $lang['expenses']['text_receipt']; ?></label>
                                    <div class="attach-file col-md-10">
                                        <a data-toggle="modal" data-target="#attach-file"><?php echo $lang['expenses']['text_upload_receipt']; ?></a>
                                        <a data-toggle="modal" data-target="#attach-scan"><?php echo $lang['expenses']['text_scan_receipt']; ?></a>
                                    </div>
                                </div>
                                <div class="attached-files">
                                    <?php if (!empty($receipt)) {
                                        foreach ($receipt as $key => $value) {
                                            $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                                            if (strtolower($file_ext) == "pdf") { ?>
                                                <div class="attached-files-block">
                                                    <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i></a>
                                                    <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                                    <div class="delete-file"><a class="fa fa-trash"></a></div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="attached-files-block">
                                                    <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""></a>
                                                    <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                                    <div class="delete-file"><a class="fa fa-trash"></a></div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php if (isset($result['id']))  echo $result['id']; ?>">
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo $lang['common']['text_save']; ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<!-- Attach File Modal -->
<div id="attach-file" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['expenses']['text_upload_receipt']; ?></h5>
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

        $("a.open-pdf").fancybox({
            'frameWidth': 800,
            'frameHeight': 900,
            'overlayShow': true,
            'hideOnContentClick': false,
            'type': 'iframe'
        });

        $("#attach-file-upload").dropzone({
            addRemoveLinks: true,
            acceptedFiles: "image/*,application/pdf",
            maxFilesize: 50000,
            dictDefaultMessage: '<?php echo $lang['common']['text_drop_message'] . '<br /><br />' . $lang['common']['text_allowed_file']; ?>',
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                        var id = $('input[name=id]').val(),
                            type = 'expense';
                        formData.append("id", id);
                        formData.append("type", type);
                    }),
                    this.on("success", function(file, xhr) {
                        var ext = file.xhr.response.substr(file.xhr.response.lastIndexOf('.') + 1);
                        if (ext === "pdf") {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" class="open-pdf"><i class="fa fa-file-pdf"></i></a>' +
                                '<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="fa fa-trash"></a></div>' +
                                '</div>');
                        } else {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" data-fancybox="gallery"><img src="public/uploads/' + file.xhr.response + '" alt=""></a>' +
                                '<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="fa fa-trash"></a></div>' +
                                '</div>');
                        }

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
                        type: 'expense'
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
                    type: 'expense'
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
</script>


<div id="attach-scan" class="modal hide fade" class="modal" role="dialog">
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
            'image/jpeg',
            0.85
        );
    }

    const buttonCapture = document.querySelector("#btnImageCapture");

    buttonCapture.onclick = function(e) {
        e.preventDefault();
        saveImgtoDB("expense");
    };
</script>

<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>