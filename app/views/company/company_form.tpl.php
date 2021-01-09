<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#company').show();
    $('#company-li').addClass('active');
</script>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="fa fa-building panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="Save Page"><i class="far fa-save"></i></button>
                <a href="<?php echo URL . DIR_ROUTE . 'companies'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary pt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#basic-info" data-toggle="tab"><i class="icon-home mr-2"></i><?php echo $lang['company']['text_basic_info']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#address" data-toggle="tab"><i class="icon-location-pin mr-2"></i><?php echo $lang['common']['text_address']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#contact-person" data-toggle="tab"><i class="fa fa-user mr-2"></i><?php echo $lang['company']['text_employees']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#documents" data-toggle="tab"><i class="far fa-file-alt mr-2"></i><?php echo $lang['company']['text_documents']; ?></a>
                </li>
            </ul>
            <div class="panel-wrapper p-3">
                <div class="tab-content mt-3 pl-4 pr-4">
                    <div class="tab-pane active" id="basic-info">
                        <div class="form-group row align-items-start">
                            <div class=" col-md-5">
                                <label class="col-form-label"><?php echo $lang['company']['text_name']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[name]" value="<?php echo $result['name']; ?>" placeholder="<?php echo $lang['company']['text_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label class="col-form-label"><?php echo $lang['company']['text_brand']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[short_name]" value="<?php echo $result['short_name']; ?>" placeholder="<?php echo $lang['company']['text_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label"><?php echo $lang['company']['text_type']; ?></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>

                                    <select name="company[type]" class="form-control">
                                        <option value="0">List All</option>
                                        <?php if (!empty($types)) {
                                            foreach ($types as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if ($result['type'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $value['name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-3">
                                <label class="col-form-label"><?php echo $lang['company']['text_company_id']; ?></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[reg_no]" value="<?php echo $result['reg_no']; ?>" placeholder="<?php echo $lang['company']['text_company_id']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label"><?php echo $lang['company']['text_vat_no']; ?></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[vat_no]" value="<?php echo $result['vat_no']; ?>" placeholder="<?php echo $lang['company']['text_vat_no']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label"><?php echo $lang['company']['text_date_formed']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" name="company[formation_date]" class="form-control date" value="<?php if($result['formation_date']){echo date_format(date_create($result['formation_date']), 'd-m-Y');} ?>" ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-6">
                                <label class="col-form-label"><?php echo $lang['common']['text_website']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-globe"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[website]" value="<?php echo $result['website']; ?>" placeholder="<?php echo $lang['common']['text_website']; ?>">
                                </div>
                                <label class="col-form-label"><?php echo $lang['company']['text_phone']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[phone]" value="<?php echo $result['phone']; ?>" placeholder="<?php echo $lang['company']['text_phone']; ?>">
                                </div>
                                <label class="col-form-label"><?php echo $lang['company']['text_email']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[email]" value="<?php echo $result['email']; ?>" placeholder="<?php echo $lang['company']['text_email']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label"><?php echo $lang['company']['text_description']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-speech"></i></span>
                                    </div>
                                    <textarea name="company[description]" class="form-control" rows="7"><?php echo $result['description']; ?></textarea>
                                </div>
                                <label class="col-md-5 col-form-label"><?php echo $lang['company']['text_activity']; ?></label>

                                <div class="col-sm-6 col-md-5 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>

                                    <select name="company[activity]" class="form-control">
                                        <option value="0">List All</option>
                                        <?php if (!empty($activity)) {
                                            foreach ($activity as $key => $value) { ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if ($result['activity'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $value['name'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="address">
                        <div class="row form-group">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_address']; ?></label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-direction"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[address][address1]" value="<?php echo $result['address']['address1'] ?>" placeholder="<?php echo $lang['company']['text_address_line_1'] ?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-directions"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="company[address][address2]" value="<?php echo $result['address']['address2'] ?>" placeholder="<?php echo $lang['company']['text_address_line_2'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['company']['text_city'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-location-pin"></i></span>
                                </div>
                                <input type="text" class="form-control" name="company[address][city]" value="<?php echo $result['address']['city'] ?>" placeholder="<?php echo $lang['company']['text_city'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['company']['text_state'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-map"></i></span>
                                </div>
                                <input type="text" class="form-control" name="company[address][state]" value="<?php echo $result['address']['state'] ?>" placeholder="<?php echo $lang['company']['text_state'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['company']['text_country'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-globe"></i></span>
                                </div>
                                <input type="text" class="form-control" name="company[address][country]" value="<?php echo $result['address']['country'] ?>" placeholder="<?php echo $lang['company']['text_country'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['company']['text_pincode'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-flag"></i></span>
                                </div>
                                <input type="text" class="form-control" name="company[address][pin]" value="<?php echo $result['address']['pin'] ?>" placeholder="<?php echo $lang['company']['text_pincode'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="documents">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['company']['text_documents'] . ' (' . $lang['company']['text_for_internal_use'] . ')'; ?></label>
                            <?php if (!empty($result['id'])) { ?>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-1"><?php echo $lang['company']['text_documents']; ?></label>
                                        <div class="attach-file col-md-10">
                                            <a data-toggle="modal" data-target="#attach-file"><?php echo $lang['company']['text_upload_document']; ?></a>
                                        </div>
                                    </div>
                                    <div class="attached-files">
                                        <?php if (!empty($documents)) {
                                            foreach ($documents as $key => $value) {
                                                $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                                                if ($file_ext == "pdf") { ?>
                                                    <div class="attached-files-block">
                                                        <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i><span class="filename"><?php echo $value['file_name']; ?></span></a>
                                                        <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                                        <div class="delete-file"><a class="fa fa-trash"></a></div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="attached-files-block">
                                                        <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""><span class="filename"><?php echo $value['file_name']; ?></span></a>
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
                </div>
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo $lang['common']['text_save']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Attach File Modal -->
<div id="attach-file" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['company']['text_upload_document']; ?></h5>
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
<!-- include summernote css/js-->

<script>
    //********************************************
    //Add Contact Persons ************************
    //********************************************
    $('#company-person').on('click', '.add-person', function() {
        var count = $('#company-person table tr:last select').attr('name').split('[')[2];
        count = parseInt(count.split(']')[0]) + 1;
        $('#company-person table tbody').append('<tr><td>' +
            '<select class="form-control form-transparent" name="company[person][' + count + '][salutation]">' +
            '<option>Salutation</option>' +
            '<option value="<?php echo $lang['company']['text_mr.']; ?>"><?php echo $lang['company']['text_mr.']; ?></option>' +
            '<option value="<?php echo $lang['company']['text_mrs.']; ?>"><?php echo $lang['company']['text_mrs.']; ?></option>' +
            '<option value="<?php echo $lang['company']['text_ms.']; ?>"><?php echo $lang['company']['text_ms.']; ?></option>' +
            '<option value="<?php echo $lang['company']['text_dr.']; ?>"><?php echo $lang['company']['text_dr.']; ?></option>' +
            '<option value="<?php echo $lang['company']['text_prof.']; ?>"><?php echo $lang['company']['text_prof.']; ?></option>' +
            '<option value="<?php echo $lang['company']['text_hon.']; ?>"><?php echo $lang['company']['text_hon.']; ?></option>' +
            '</select>' +
            '</td>' +
            '<td><input type="text" class="form-transparent" name="company[person][' + count + '][name]"></td>' +
            '<td><input type="text" class="form-transparent" name="company[person][' + count + '][email]"></td>' +
            '<td><input type="text" class="form-transparent" name="company[person][' + count + '][mobile]"></td>' +
            '<td><input type="text" class="form-transparent" name="company[person][' + count + '][skype]"></td>' +
            '<td><input type="text" class="form-transparent" name="company[person][' + count + '][designation]"></td>' +
            '<td class="text-center">' +
            '<a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger text-danger p-1 m-1"></i></a>' +
            '</td></tr>');

        return false;
    });

    $('#company-person').on('click', '.delete', function() {
        $(this).parents('tr').remove();
    })

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
            acceptedFiles: "image/*,application/pdf",
            maxFilesize: 50000,
            dictDefaultMessage: '<?php echo $lang['common']['text_drop_message'] . '<br /><br />' . $lang['common']['text_allowed_file']; ?>',
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                        var id = $('input[name=id]').val(),
                            type = 'company';
                        formData.append("id", id);
                        formData.append("type", type);
                    }),
                    this.on("success", function(file, xhr) {
                        var ext = file.xhr.response.substr(file.xhr.response.lastIndexOf('.') + 1);
                        if (ext === "pdf") {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" class="open-pdf"><i class="fa fa-file-pdf"></i><span class="filename">' + file.xhr.response + '</span></a>' +
                                '<input type="hidden" name="document[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="fa fa-trash"></a></div>' +
                                '</div>');
                        } else {
                            $('.attached-files').append('<div class="attached-files-block attached-' + file.xhr.response.slice(0, -4) + '">' +
                                '<a href="public/uploads/' + file.xhr.response + '" data-fancybox="gallery"><img src="public/uploads/' + file.xhr.response + '" alt=""><span class="filename">' + file.xhr.response + '</span></a>' +
                                '<input type="hidden" name="document[attached][]" value="' + file.xhr.response + '">' +
                                '<div class="delete-file"><a class="fa fa-trash"></a></div>' +
                                '</div>');
                        }

                    })
            },
            renameFile: function(file) {
                return file.name.split('.')[0] + '_' + new Date().valueOf() + "." + file.name.split('.').pop();
            },
            removedfile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: 'index.php?route=attachFile/delete',
                    data: {
                        name: name,
                        type: 'company'
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
                    type: 'company'
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