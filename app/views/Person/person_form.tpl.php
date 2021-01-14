<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#person').show();
    $('#person-li').addClass('active');
</script>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="far fa-address-book panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="Save Page"><i class="far fa-save"></i></button>
                <a href="<?php echo URL . DIR_ROUTE . 'persons'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary pt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#basic-info" data-toggle="tab"><i class="icon-home mr-2"></i><?php echo $lang['person']['text_basic_info']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#address" data-toggle="tab"><i class="icon-location-pin mr-2"></i><?php echo $lang['person']['text_address']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#person-contacts" data-toggle="tab"><i class="icon-screen-smartphone mr-2"></i><?php echo $lang['person']['text_contact_persons']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#remarks" data-toggle="tab"> <i class="fas fa-info mr-2"></i><?php echo $lang['person']['text_remark']; ?></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#documents" data-toggle="tab"><i class="far fa-file-alt mr-2"></i><?php echo $lang['person']['text_document']; ?></a>
                </li>
            </ul>
            <div class="panel-wrapper p-3">
                <div class="tab-content mt-3 pl-4 pr-4">
                    <div class="tab-pane active" id="basic-info">
                        <div class="form-group row align-items-start">
                            <div class="col-md-2">
                                <label class="col-form-label pt-3"><?php echo $lang['common']['text_name']; ?></label>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-hand-spock"></i></span>
                                    </div>
                                    <select class="custom-select" name="person[salutation]">
                                        <option value=""><?php echo $lang['person']['text_salutation']; ?></option>
                                        <option value="<?php echo $lang['person']['text_mr.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_mr.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_mr.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_mrs.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_mrs.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_mrs.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_ms.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_ms.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_ms.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_dr.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_dr.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_dr.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_prof.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_prof.']) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $lang['person']['text_prof.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_rev.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_rev.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_rev.']; ?></option>
                                        <option value="<?php echo $lang['person']['text_hon.']; ?>" <?php if ($result['salutation'] == $lang['person']['text_hon.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['person']['text_hon.']; ?></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="person[firstname]" value="<?php echo $result['firstname']; ?>" placeholder="<?php echo $lang['common']['text_first_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="person[lastname]" value="<?php echo $result['lastname']; ?>" placeholder="<?php echo $lang['common']['text_last_name']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="person[email]" value="<?php echo $result['email']; ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_phone_number']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="number" class="form-control" name="person[phone]" value="<?php echo $result['phone']; ?>" placeholder="<?php echo $lang['common']['text_phone_number']; ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <label class="col-md-2 col-form-label pt-3"><?php echo $lang['person']['text_company']; ?></label>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>

                                    <select data-placeholder="Choose a Company..." class="chosen-select custom-select background-default" name="person[company]" tabindex="4">
                                        <option value="0">Select a company </option>
                                        <?php if (!empty($companies)) {

                                            foreach ($companies as $key => $value) { ?>

                                                <option value="<?php echo $value['id'] ?>" <?php if ($result['company'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                    <?php echo $value['name']; ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <label class="col-md-2 col-form-label pt-3"><?php echo $lang['person']['text_designation']; ?></label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="person[designation]" value="<?php echo $result['designation']; ?>" placeholder="<?php echo $lang['person']['text_designation']; ?>">
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
                                    <input type="text" class="form-control" name="person[address][address1]" value="<?php echo $result['address']['address1'] ?>" placeholder="<?php echo $lang['person']['text_address_line_1'] ?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-directions"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="person[address][address2]" value="<?php echo $result['address']['address2'] ?>" placeholder="<?php echo $lang['person']['text_address_line_2'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['person']['text_city'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-location-pin"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][city]" value="<?php echo $result['address']['city'] ?>" placeholder="<?php echo $lang['person']['text_city'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['person']['text_state'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-map"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][state]" value="<?php echo $result['address']['state'] ?>" placeholder="<?php echo $lang['person']['text_state'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['person']['text_country'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-globe"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][country]" value="<?php echo $result['address']['country'] ?>" placeholder="<?php echo $lang['person']['text_country'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['person']['text_pincode'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-flag"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][pin]" value="<?php echo $result['address']['pin'] ?>" placeholder="<?php echo $lang['person']['text_pincode'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_phone_number'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][phone1]" value="<?php echo $result['address']['phone1'] ?>" placeholder="<?php echo $lang['common']['text_phone_number'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['person']['text_fax']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-call-in"></i></span>
                                </div>
                                <input type="text" class="form-control" name="person[address][fax]" value="<?php echo $result['address']['fax'] ?>" placeholder="<?php echo $lang['person']['text_fax']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="person-contacts">
                        <div class="row">
                            <label class="col-form-label"><?php echo $lang['person']['text_contact_persons'] . ' (' . $lang['person']['text_for_emergency'] . ')'; ?></label>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-input font-12">
                                        <thead>
                                            <tr>
                                                <th><?php echo $lang['person']['text_salutation']; ?></th>
                                                <th><?php echo $lang['common']['text_name']; ?></th>
                                                <th><?php echo $lang['common']['text_email_address']; ?></th>
                                                <th><?php echo $lang['common']['text_mobile_number']; ?></th>
                                                <th><?php echo $lang['person']['text_country']; ?></th>
                                                <th><?php echo $lang['person']['text_designation']; ?></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($result['persons'])) {
                                                foreach ($result['persons'] as $key => $value) { ?>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control form-transparent" name="person[persons][<?php echo $key; ?>][salutation]">
                                                                <option value=""><?php echo $lang['person']['text_salutation']; ?></option>
                                                                <option value="<?php echo $lang['person']['text_mr.']; ?>" <?php if ($value['salutation'] == $lang['person']['text_mr.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['person']['text_mr.']; ?></option>
                                                                <option value="<?php echo $lang['person']['text_mrs.']; ?>" <?php if ($value['salutation'] == $lang['person']['text_mrs.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['person']['text_mrs.']; ?></option>
                                                                <option value="<?php echo $lang['person']['text_ms.']; ?>" <?php if ($value['salutation'] == $lang['person']['text_ms.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['person']['text_ms.']; ?></option>
                                                                <option value="<?php echo $lang['person']['text_dr.']; ?>" <?php if ($value['salutation'] == $lang['person']['text_dr.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['person']['text_dr.']; ?></option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="person[persons][<?php echo $key; ?>][name]" value="<?php echo $value['name'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="person[persons][<?php echo $key; ?>][email]" value="<?php echo $value['email'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="person[persons][<?php echo $key; ?>][mobile]" value="<?php echo $value['mobile'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="person[persons][<?php echo $key; ?>][country]" value="<?php echo $value['country'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="person[persons][<?php echo $key; ?>][designation]" value="<?php echo $value['designation'] ?>">
                                                        </td>
                                                        <td class="table-icon text-center">
                                                            <a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="table-icon fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>
                                                        <select class="form-control form-transparent" name="person[person][0][salutation]">
                                                            <option value=""><?php echo $lang['person']['text_salutation']; ?></option>
                                                            <option value="<?php echo $lang['person']['text_mr.']; ?>"><?php echo $lang['person']['text_mr.']; ?></option>
                                                            <option value="<?php echo $lang['person']['text_mrs.']; ?>"><?php echo $lang['person']['text_mrs.']; ?></option>
                                                            <option value="<?php echo $lang['person']['text_ms.']; ?>"><?php echo $lang['person']['text_ms.']; ?></option>
                                                            <option value="<?php echo $lang['person']['text_dr.']; ?>"><?php echo $lang['person']['text_dr.']; ?></option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="person[persons][0][name]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="person[persons][0][email]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="person[persons][0][mobile]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="person[persons][0][country]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="person[persons][0][designation]">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="fa fa-close text-danger text-danger p-1 m-1"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3 mt-3">
                                    <a href="#" class="btn btn-success btn-sm add-person"><i class="icon-plus mr-2"></i> <?php echo $lang['person']['text_add_person']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="remarks">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['person']['text_remark'] . ' (' . $lang['person']['text_for_internal_use'] . ')'; ?></label>
                            <textarea id='summernote' class="summernote" name="person[remark]"><?php echo $result['remark']; ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="documents">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['person']['text_document'] . ' (' . $lang['person']['text_for_internal_use'] . ')'; ?></label>
                            <?php if (!empty($result['id'])) { ?>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-1"><?php echo $lang['person']['text_document']; ?></label>
                                        <div class="attach-file col-md-10">
                                            <a data-toggle="modal" data-target="#attach-file"><?php echo $lang['person']['text_upload_document']; ?></a>
                                        </div>
                                    </div>
                                    <div class="attached-files">
                                        <?php if (!empty($documents)) {
                                            foreach ($documents as $key => $value) {
                                                $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                                                if ($file_ext == "pdf") { ?>
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
                <h5 class="modal-title"><?php echo $lang['person']['text_upload_document']; ?></h5>
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
<link href="public/css/summernote-bs4.css" rel="stylesheet">
<script type="text/javascript" src="public/js/summernote-bs4.min.js"></script>
<script type="text/javascript" src="public/js/custom.summernote.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Type a note here... ',
        tabsize: 2,
        height: 600
    });

    //********************************************
    //Add person Persons ************************
    //********************************************
    $('#person-person').on('click', '.add-person', function() {
        var count = $('#person-person table tr:last select').attr('name').split('[')[2];
        count = parseInt(count.split(']')[0]) + 1;
        $('#person-person table tbody').append('<tr><td>' +
            '<select class="form-control form-transparent" name="person[person][' + count + '][salutation]">' +
            '<option>Salutation</option>' +
            '<option value="<?php echo $lang['person']['text_mr.']; ?>"><?php echo $lang['person']['text_mr.']; ?></option>' +
            '<option value="<?php echo $lang['person']['text_mrs.']; ?>"><?php echo $lang['person']['text_mrs.']; ?></option>' +
            '<option value="<?php echo $lang['person']['text_ms.']; ?>"><?php echo $lang['person']['text_ms.']; ?></option>' +
            '<option value="<?php echo $lang['person']['text_dr.']; ?>"><?php echo $lang['person']['text_dr.']; ?></option>' +
            '<option value="<?php echo $lang['person']['text_prof.']; ?>"><?php echo $lang['person']['text_prof.']; ?></option>' +
            '<option value="<?php echo $lang['person']['text_hon.']; ?>"><?php echo $lang['person']['text_hon.']; ?></option>' +
            '</select>' +
            '</td>' +
            '<td><input type="text" class="form-transparent" name="person[person][' + count + '][name]"></td>' +
            '<td><input type="text" class="form-transparent" name="person[person][' + count + '][email]"></td>' +
            '<td><input type="text" class="form-transparent" name="person[person][' + count + '][mobile]"></td>' +
            '<td><input type="text" class="form-transparent" name="person[person][' + count + '][skype]"></td>' +
            '<td><input type="text" class="form-transparent" name="person[person][' + count + '][designation]"></td>' +
            '<td class="text-center">' +
            '<a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger text-danger p-1 m-1"></i></a>' +
            '</td></tr>');

        return false;
    });

    $('#person-person').on('click', '.delete', function() {
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
                            type = 'person';
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
            removedFile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: 'index.php?route=attachFile/delete',
                    data: {
                        name: name,
                        type: 'person'
                    },
                    error: function() {
                        toastr.error('File could not be deleted', 'Server Error');
                    },
                    success: function(data) {
                        $('.attached-' + name.slice(0, -4) + '').remove();
                        toastr.success('File Deleted Successfully', 'Success');
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
                    type: 'person'
                },
                error: function() {
                    toastr.error('File could not be deleted', 'Server Error');
                },
                success: function(data) {
                    $('.attached-' + name.slice(0, -4) + '').remove();
                    toastr.success('File Deleted Successfully', 'Success');
                }
            });
            ele.parents('.attached-files-block').remove();
        });
    });
</script>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>