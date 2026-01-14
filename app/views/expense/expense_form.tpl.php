<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#expense-li').addClass('active');
</script>
<style>
    .eu-zone-modal-dark .modal-content {
        background-color: #1f1f1f;
        color: #f2f2f2;
        border: 1px solid #333;
    }
    .eu-zone-modal-dark .modal-header,
    .eu-zone-modal-dark .modal-footer {
        border-color: #333;
    }
    .eu-zone-modal-dark .close {
        color: #f2f2f2;
        text-shadow: none;
        opacity: 0.85;
    }
    .eu-zone-modal-dark .close:hover {
        opacity: 1;
    }
    .eu-zone-modal-dark .modal-body li {
        color: #e6e6e6;
    }
</style>
<div class='row'>
    <div class="col-10 mx-auto">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-handbag panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                    <div class="panel-action">
                        <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                        <a href="javascript:window.close();" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="far fa-window-close"></i></a>
                    </div>
                </div>
                <div class="panel-wrapper p-2">
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
                            <div class="col-sm-4 col-lg-3 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_foreign_invoice']; ?></label>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="hidden" name="expense[foreign]" value="0">
                                    <input type="checkbox" class="custom-control-input" id="expense-foreign" name="expense[foreign]" value="1" <?php if (!empty($result['foreign'])) { echo 'checked'; } ?>>
                                    <label class="custom-control-label" for="expense-foreign">Mark as foreign</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-3 form-group">
                                <label class="col-form-label">
                                    <?php echo $lang['expenses']['text_eu_zone']; ?>
                                    <a href="#" class="ml-1 text-muted eu-zone-info" data-toggle="modal" data-target="#eu-zone-modal" aria-label="EU zone countries">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </label>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="hidden" name="expense[eu_zone]" value="0">
                                    <input type="checkbox" class="custom-control-input" id="expense-eu-zone" name="expense[eu_zone]" value="1" <?php if (!empty($result['eu_zone'])) { echo 'checked'; } ?>>
                                    <label class="custom-control-label" for="expense-eu-zone">EU Zone</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-3 form-group" id="expense-vat-t8">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_t8']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_T8]" class="form-control" value="<?php if (isset($result['VAT_T8'])) { echo $result['VAT_T8']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_t8']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="expense-vat-row">
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_full']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_full]" class="form-control" value="<?php if (isset($result['VAT_full'])) { echo $result['VAT_Full']; } elseif (isset($result['VAT_Full'])) { echo $result['VAT_Full']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_full']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_exempt']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="T1"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_Exempt]" class="form-control" value="<?php if (isset($result['VAT_Exempt'])) { echo $result['VAT_Exempt']; } elseif (isset($result['VAT_Exempt'])) { echo $result['VAT_Exempt']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_exempt']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_non_taxable']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_NT]" class="form-control" value="<?php if (isset($result['VAT_NT'])) { echo $result['VAT_NT']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_non_taxable']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_reduced']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_reduced]" class="form-control" value="<?php if (isset($result['VAT_reduced'])) { echo $result['VAT_Reduced']; } elseif (isset($result['VAT_Reduced'])) { echo $result['VAT_Reduced']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_reduced']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-2 form-group">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_out_of_scope']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" name="expense[VAT_T9]" class="form-control" value="<?php if (isset($result['VAT_T9'])) { echo $result['VAT_T9']; } ?>" placeholder="<?php echo $lang['expenses']['text_vat_out_of_scope']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="expense-vat-total-row">
                            <div class="col-sm-4 col-lg-2 form-group" id="expense-vat-total">
                                <label class="col-form-label"><?php echo $lang['expenses']['text_vat_total']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-percent"></i></span>
                                    </div>
                                    <input type="text" class="form-control vat-total-field" value="0.00" placeholder="<?php echo $lang['expenses']['text_vat_total']; ?>" readonly>
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
                                    <textarea name="expense[description]" class="form-control" rows="3"><?php if (isset($result['description']))  echo $result['description']; ?></textarea>
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
                                                    <a href="uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i></a>
                                                    <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                                    <div class="delete-file"><a class="fa fa-trash"></a></div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="attached-files-block">
                                                    <a href="uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="uploads/<?php echo $value['file_name']; ?>" alt=""></a>
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



<link rel="stylesheet" href="css/jquery.fancybox.min.css">
<script src="js/jquery.fancybox.min.js"></script>
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
                                '<a href="uploads/' + file.xhr.response + '" class="open-pdf"><i class="fa fa-file-pdf"></i></a>' +
                                '<input type="hidden" name="expense[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="fa fa-trash"></a></div>' +
                                '</div>');
                        } else {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="uploads/' + file.xhr.response + '" data-fancybox="gallery"><img src="uploads/' + file.xhr.response + '" alt=""></a>' +
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

        function parseAmount(value) {
            if (!value) {
                return 0;
            }
            var cleaned = String(value).replace(/[^0-9.-]/g, '');
            var parsed = parseFloat(cleaned);
            return isNaN(parsed) ? 0 : parsed;
        }

        function updateVatTotal() {
            var vatFull = parseAmount($('input[name="expense[VAT_full]"]').val());
            var vatExempt = parseAmount($('input[name="expense[VAT_Exempt]"]').val());
            var vatNonTaxable = parseAmount($('input[name="expense[VAT_NT]"]').val());
            var vatReduced = parseAmount($('input[name="expense[VAT_reduced]"]').val());
            var vatT8 = parseAmount($('input[name="expense[VAT_T8]"]').val());
            var vatT9 = parseAmount($('input[name="expense[VAT_T9]"]').val());
            var total = vatFull + vatExempt + vatNonTaxable + vatReduced + vatT8 + vatT9;
            var totalAmount = parseAmount($('input[name="expense[amount]"]').val());
            var totalField = $('.vat-total-field');
            totalField.val(total.toFixed(2));
            totalField.toggleClass('bg-success text-white', Math.abs(total - totalAmount) < 0.01);
        }

        var purchaseAmount = $('input[name="expense[amount]"]');
        var paidAmount = $('input[name="expense[paid_amount]"]');
        var foreignCheckbox = $('#expense-foreign');
        var euZoneCheckbox = $('#expense-eu-zone');
        var vatRow = $('#expense-vat-row');
        var vatT8Group = $('#expense-vat-t8');
        var vatInputs = $('input[name="expense[VAT_full]"], input[name="expense[VAT_Exempt]"], input[name="expense[VAT_NT]"], input[name="expense[VAT_reduced]"], input[name="expense[VAT_T9]"]');
        var vatT8Input = $('input[name="expense[VAT_T8]"]');

        function updateVatVisibility() {
            var isForeign = foreignCheckbox.prop('checked');
            var isEuZone = euZoneCheckbox.prop('checked');

            if (isForeign) {
                vatInputs.val('0');
                vatRow.hide();
            } else {
                vatRow.show();
            }

            if (isEuZone) {
                vatT8Group.show();
                vatT8Input.val(purchaseAmount.val());
            } else {
                vatT8Input.val('0');
                vatT8Group.hide();
            }
        }
        if (euZoneCheckbox.prop('checked')) {
            foreignCheckbox.prop('checked', true);
        }

        purchaseAmount.on('input', function() {
            paidAmount.val($(this).val());
            if (euZoneCheckbox.prop('checked')) {
                vatT8Input.val($(this).val());
            }
            updateVatTotal();
        });

        $('input[name="expense[VAT_full]"], input[name="expense[VAT_Exempt]"], input[name="expense[VAT_NT]"], input[name="expense[VAT_reduced]"], input[name="expense[VAT_T8]"], input[name="expense[VAT_T9]"]').on('input', updateVatTotal);
        $('.eu-zone-info').on('click', function(e) {
            e.preventDefault();
            $('#eu-zone-modal').modal('show');
        });

        euZoneCheckbox.on('change', function() {
            if (this.checked) {
                foreignCheckbox.prop('checked', true);
            }
            updateVatVisibility();
            updateVatTotal();
        });
        foreignCheckbox.on('change', function() {
            if (!this.checked) {
                euZoneCheckbox.prop('checked', false);
            }
            updateVatVisibility();
            updateVatTotal();
        });
        updateVatVisibility();
        updateVatTotal();
</script>

<div id="eu-zone-modal" class="modal fade eu-zone-modal-dark" role="dialog" aria-labelledby="eu-zone-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eu-zone-title">EU Zone Countries</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="mb-0">
                    <li>Austria</li>
                    <li>Belgium</li>
                    <li>Bulgaria</li>
                    <li>Croatia</li>
                    <li>Republic of Cyprus</li>
                    <li>Czechia</li>
                    <li>Denmark</li>
                    <li>Estonia</li>
                    <li>Finland</li>
                    <li>France</li>
                    <li>Germany</li>
                    <li>Greece</li>
                    <li>Hungary</li>
                    <li>Ireland</li>
                    <li>Italy</li>
                    <li>Latvia</li>
                    <li>Lithuania</li>
                    <li>Luxembourg</li>
                    <li>Malta</li>
                    <li>Netherlands</li>
                    <li>Poland</li>
                    <li>Portugal</li>
                    <li>Romania</li>
                    <li>Slovakia</li>
                    <li>Slovenia</li>
                    <li>Spain</li>
                    <li>Sweden</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>


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
<script src="js/scan.js" async></script>

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
