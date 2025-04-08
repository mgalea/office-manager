<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#contact').show();
    $('#contact-li').addClass('active');
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
                <a href="<?php echo URL . DIR_ROUTE . 'contacts'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary pt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#basic-info" data-toggle="tab"><i class="icon-home mr-2"></i><?php echo $lang['contact']['text_basic_info']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#address" data-toggle="tab"><i class="icon-location-pin mr-2"></i><?php echo $lang['common']['text_address']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#contact-person" data-toggle="tab"><i class="icon-screen-smartphone mr-2"></i><?php echo $lang['contact']['text_contact_persons']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#remarks" data-toggle="tab"><?php echo ($result['contact_type'] == '2') ? '<i class="far fa-file-alt mr-2">' : '<i class="icon-bubbles mr-2">'; ?></i><?php echo $lang['contact']['text_remark']; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#documents" data-toggle="tab"><i class="far fa-file-alt mr-2"></i><?php echo $lang['contact']['text_document']; ?></a>
                </li>
                <?php if (!empty($result['id'])) {
                    if ($result['contact_type'] > 2) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#client" data-toggle="tab"><i class="icon-bubbles mr-2"></i><?php echo $lang['common']['text_client'] . ' ' . $lang['common']['text_portal']; ?></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#invoices" data-toggle="tab"><i class="icon-docs mr-2"></i><?php echo $lang['common']['text_invoices']; ?> (<?php echo count($invoices); ?>)</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#quotes" data-toggle="tab"><i class="icon-calculator mr-2"></i><?php echo $lang['common']['text_quotes']; ?> (<?php echo count($quotes); ?>)</a>
                        </li>
                <?php }
                } ?>
            </ul>
            <div class="panel-wrapper p-3">
                <div class="tab-content mt-3 pl-4 pr-4">
                    <div class="tab-pane active" id="basic-info">
                        <div class="form-group row align-items-start">
                            <div class="col-md-2">
                                <label class="col-form-label pt-3"><?php echo $lang['contact']['text_primary_contact']; ?></label>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-hand-spock"></i></span>
                                    </div>
                                    <select class="custom-select" name="contact[salutation]" required>
                                        <option value=""><?php echo $lang['contact']['text_salutation']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_mr.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_mr.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['contact']['text_mr.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_mrs.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_mrs.']) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $lang['contact']['text_mrs.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_ms.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_ms.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['contact']['text_ms.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_dr.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_dr.']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $lang['contact']['text_dr.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_prof.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_prof.']) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $lang['contact']['text_prof.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_rev.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_rev.']) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $lang['contact']['text_rev.']; ?></option>
                                        <option value="<?php echo $lang['contact']['text_hon.']; ?>" <?php if ($result['salutation'] == $lang['contact']['text_hon.']) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $lang['contact']['text_hon.']; ?></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contact[firstname]" value="<?php if($result['firstname']) echo $result['firstname']; ?>" placeholder="<?php echo $lang['common']['text_first_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contact[lastname]" value="<?php if($result['lastname'])  echo $result['lastname']; ?>" placeholder="<?php echo $lang['common']['text_last_name']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <label class="col-md-2 col-form-label pt-3"><?php echo $lang['contact']['text_company']; ?></label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contact[company]" value="<?php echo $result['company']; ?>" placeholder="<?php echo $lang['contact']['text_company']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="contact[email]" value="<?php echo $result['email']; ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_phone_number']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="number" class="form-control" name="contact[phone]" value="<?php echo $result['phone']; ?>" placeholder="<?php echo $lang['common']['text_phone_number']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_website']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-globe"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[website]" value="<?php echo $result['website']; ?>" placeholder="<?php echo $lang['common']['text_website']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_contact_type']; ?></label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                    </div>
                                    <select class="custom-select background-default" name="contact_type">
                                        <option value="0">Select a contact type </option>
                                        <?php if (!empty($types)) {

                                            foreach ($types as $key => $value) { ?>

                                                <option value="<?php echo $value['id'] ?>" <?php if ($result['contact_type'] == $value['id']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                    <?php echo $value['name']; ?>
                                                </option>
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
                                    <input type="text" class="form-control" name="contact[address][address1]" value="<?php echo $result['address']['address1'] ?>" placeholder="<?php echo $lang['contact']['text_address_line_1'] ?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-directions"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="contact[address][address2]" value="<?php echo $result['address']['address2'] ?>" placeholder="<?php echo $lang['contact']['text_address_line_2'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_city'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-location-pin"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][city]" value="<?php echo $result['address']['city'] ?>" placeholder="<?php echo $lang['contact']['text_city'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_state'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-map"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][state]" value="<?php echo $result['address']['state'] ?>" placeholder="<?php echo $lang['contact']['text_state'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_country'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-globe"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][country]" value="<?php echo $result['address']['country'] ?>" placeholder="<?php echo $lang['contact']['text_country'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_pincode'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-flag"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][pin]" value="<?php echo $result['address']['pin'] ?>" placeholder="<?php echo $lang['contact']['text_pincode'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['common']['text_phone_number'] ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][phone1]" value="<?php echo $result['address']['phone1'] ?>" placeholder="<?php echo $lang['common']['text_phone_number'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"><?php echo $lang['contact']['text_fax']; ?></label>
                            <div class="col-md-10 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-call-in"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contact[address][fax]" value="<?php echo $result['address']['fax'] ?>" placeholder="<?php echo $lang['contact']['text_fax']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="contact-person">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-input font-12">
                                        <thead>
                                            <tr>
                                                <th><?php echo $lang['contact']['text_salutation']; ?></th>
                                                <th><?php echo $lang['common']['text_name']; ?></th>
                                                <th><?php echo $lang['common']['text_email_address']; ?></th>
                                                <th><?php echo $lang['common']['text_mobile_number']; ?></th>
                                                <th><?php echo $lang['common']['text_skype']; ?></th>
                                                <th><?php echo $lang['contact']['text_designation']; ?></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result['persons']) {
                                                foreach ($result['persons'] as $key => $value) { ?>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control form-transparent" name="contact[person][<?php echo $key; ?>][salutation]">
                                                                <option value=""><?php echo $lang['contact']['text_salutation']; ?></option>
                                                                <option value="<?php echo $lang['contact']['text_mr.']; ?>" <?php if ($value['salutation'] == $lang['contact']['text_mr.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['contact']['text_mr.']; ?></option>
                                                                <option value="<?php echo $lang['contact']['text_mrs.']; ?>" <?php if ($value['salutation'] == $lang['contact']['text_mrs.']) {
                                                                                                                                    echo "selected";
                                                                                                                                } ?>><?php echo $lang['contact']['text_mrs.']; ?></option>
                                                                <option value="<?php echo $lang['contact']['text_ms.']; ?>" <?php if ($value['salutation'] == $lang['contact']['text_ms.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['contact']['text_ms.']; ?></option>
                                                                <option value="<?php echo $lang['contact']['text_dr.']; ?>" <?php if ($value['salutation'] == $lang['contact']['text_dr.']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?php echo $lang['contact']['text_dr.']; ?></option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="contact[person][<?php echo $key; ?>][name]" value="<?php echo $value['name'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="contact[person][<?php echo $key; ?>][email]" value="<?php echo $value['email'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="contact[person][<?php echo $key; ?>][mobile]" value="<?php echo $value['mobile'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="contact[person][<?php echo $key; ?>][skype]" value="<?php echo $value['skype'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-transparent" name="contact[person][<?php echo $key; ?>][designation]" value="<?php echo $value['designation'] ?>">
                                                        </td>
                                                        <td class="table-icon text-center">
                                                            <a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="table-icon fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>
                                                        <select class="form-control form-transparent" name="contact[person][0][salutation]">
                                                            <option value=""><?php echo $lang['contact']['text_salutation']; ?></option>
                                                            <option value="<?php echo $lang['contact']['text_mr.']; ?>"><?php echo $lang['contact']['text_mr.']; ?></option>
                                                            <option value="<?php echo $lang['contact']['text_mrs.']; ?>"><?php echo $lang['contact']['text_mrs.']; ?></option>
                                                            <option value="<?php echo $lang['contact']['text_ms.']; ?>"><?php echo $lang['contact']['text_ms.']; ?></option>
                                                            <option value="<?php echo $lang['contact']['text_dr.']; ?>"><?php echo $lang['contact']['text_dr.']; ?></option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="contact[person][0][name]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="contact[person][0][email]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="contact[person][0][mobile]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="contact[person][0][skype]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-transparent" name="contact[person][0][designation]">
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
                                    <a href="#" class="btn btn-success btn-sm add-person"><i class="icon-plus mr-2"></i> <?php echo $lang['contact']['text_add_person']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="remarks">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['contact']['text_remark'] . ' (' . $lang['contact']['text_for_internal_use'] . ')'; ?></label>
                            <textarea id='summernote' class="summernote" name="contact[remark]"><?php echo $result['remark']; ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="documents">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['contact']['text_document'] . ' (' . $lang['contact']['text_for_internal_use'] . ')'; ?></label>
                            <?php if (!empty($result['id'])) { ?>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-1"><?php echo $lang['contact']['text_document']; ?></label>
                                        <div class="attach-file col-md-10">
                                            <a data-toggle="modal" data-target="#attach-file"><?php echo $lang['contact']['text_upload_document']; ?></a>
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
                    <?php if (!empty($result['id'])) {
                        if ($result['contact_type'] > 2) { ?>
                            <div class="tab-pane" id="client">
                                <?php if (!empty($client['id'])) { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $lang['common']['text_name']; ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $client['name']; ?>" placeholder="<?php echo $lang['common']['text_name']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-envelope"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $client['email']; ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $lang['common']['text_mobile_number']; ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $client['mobile']; ?>" placeholder="<?php echo $lang['common']['text_mobile_number']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo $lang['common']['text_created_date']; ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo date_format(date_create($client['date_of_joining']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['common']['text_created_date']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="col-form-label"><?php echo $lang['common']['text_status']; ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="icon-check"></i></span>
                                                    </div>
                                                    <select class="custom-select" name="client[status]" required>
                                                        <option value="1" <?php if ($client['status'] == "1") {
                                                                                echo "selected";
                                                                            } ?>><?php echo $lang['common']['text_active']; ?></option>
                                                        <option value="0" <?php if ($client['status'] == "0") {
                                                                                echo "selected";
                                                                            } ?>><?php echo $lang['common']['text_inactive']; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="client[client_id]" value="<?php echo $client['id']; ?>">
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="font-16"><?php echo $lang['contact']['text_client_has_not_created_account_at_client_portal']; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane" id="invoices">
                                <div class="table-responsive-xl">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $lang['contact']['text_company']; ?></th>
                                                <th><?php echo $lang['contact']['text_amount']; ?></th>
                                                <th><?php echo $lang['contact']['text_balance_due']; ?></th>
                                                <th><?php echo $lang['common']['text_created_date']; ?></th>
                                                <th><?php echo $lang['contact']['text_due_date']; ?></th>
                                                <th><?php echo $lang['common']['text_status']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($invoices)) {
                                                foreach ($invoices as $key => $value) { ?>
                                                    <tr>
                                                        <td><a href="<?php echo URL . DIR_ROUTE . 'invoice/view&id=' . $value['id']; ?>" class="text-primary">INV-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                                                        <td><?php echo $result['company']; ?></td>
                                                        <td><?php echo $value['abbr'] . ' ' . $value['amount']; ?></td>
                                                        <td><?php echo $value['abbr'] . ' ' . $value['due']; ?></td>
                                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></td>
                                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['duedate']), 'd-m-Y'); ?></td>
                                                        <td>
                                                            <?php if ($value['status'] == "Paid") { ?>
                                                                <span class="badge badge-Paid badge-pill badge-sm"><?php echo $lang['contact']['text_paid']; ?></span>
                                                            <?php } elseif ($value['status'] == "Unpaid") { ?>
                                                                <span class="badge badge-Unpaid badge-pill badge-sm"><?php echo $lang['contact']['text_unpaid']; ?></span>
                                                            <?php } elseif ($value['status'] == "Pending") { ?>
                                                                <span class="badge badge-Pending badge-pill badge-sm"><?php echo $lang['contact']['text_pending']; ?></span>
                                                            <?php } elseif ($value['status'] == "In Process") { ?>
                                                                <span class="badge badge-In-Process badge-pill badge-sm"><?php echo $lang['contact']['text_in_process']; ?></span>
                                                            <?php } elseif ($value['status'] == "Cancelled") { ?>
                                                                <span class="badge badge-Cancelled badge-pill badge-sm"><?php echo $lang['contact']['text_cancelled']; ?></span>
                                                            <?php } elseif ($value['status'] == "Other") { ?>
                                                                <span class="badge badge-Other badge-pill badge-sm"><?php echo $lang['contact']['text_other']; ?></span>
                                                            <?php } elseif ($value['status'] == "Partially Paid") { ?>
                                                                <span class="badge badge-Partially-Paid badge-pill badge-sm"><?php echo $lang['contact']['text_partially_paid']; ?></span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-Unknown badge-pill badge-sm"><?php echo $lang['contact']['text_unknown']; ?></span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <span class="font-16"><?php echo $lang['common']['text_no_data_found']; ?></span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="quotes">
                                <div class="table-responsive-xl">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $lang['common']['text_project']; ?></th>
                                                <th><?php echo $lang['contact']['text_company']; ?></th>
                                                <th><?php echo $lang['contact']['text_amount']; ?></th>
                                                <th><?php echo $lang['contact']['text_expiry_date']; ?></th>
                                                <th><?php echo $lang['common']['text_created_date']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($quotes)) {
                                                foreach ($quotes as $key => $value) {
                                                    $amount = json_decode($value['total'], true)['amount']; ?>
                                                    <tr>
                                                        <td><a href="<?php echo URL . DIR_ROUTE . 'invoice/view&id=' . $value['id']; ?>" class="text-primary">QTN-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                                                        <td><?php echo $value['project_name']; ?></td>
                                                        <td><?php echo $result['company']; ?></td>
                                                        <td><?php echo $value['abbr'] . ' ' . $amount; ?></td>
                                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['expiry']), 'd-m-Y'); ?></td>
                                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['date']), 'd-m-Y'); ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <span class="font-16"><?php echo $lang['common']['text_no_data_found']; ?></span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    <?php }
                    } ?>
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
                <h5 class="modal-title"><?php echo $lang['contact']['text_upload_document']; ?></h5>
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
    //Add Contact Persons ************************
    //********************************************
    $('#contact-person').on('click', '.add-person', function() {
        var count = $('#contact-person table tr:last select').attr('name').split('[')[2];
        count = parseInt(count.split(']')[0]) + 1;
        $('#contact-person table tbody').append('<tr><td>' +
            '<select class="form-control form-transparent" name="contact[person][' + count + '][salutation]">' +
            '<option>Salutation</option>' +
            '<option value="<?php echo $lang['contact']['text_mr.']; ?>"><?php echo $lang['contact']['text_mr.']; ?></option>' +
            '<option value="<?php echo $lang['contact']['text_mrs.']; ?>"><?php echo $lang['contact']['text_mrs.']; ?></option>' +
            '<option value="<?php echo $lang['contact']['text_ms.']; ?>"><?php echo $lang['contact']['text_ms.']; ?></option>' +
            '<option value="<?php echo $lang['contact']['text_dr.']; ?>"><?php echo $lang['contact']['text_dr.']; ?></option>' +
            '<option value="<?php echo $lang['contact']['text_prof.']; ?>"><?php echo $lang['contact']['text_prof.']; ?></option>' +
            '<option value="<?php echo $lang['contact']['text_hon.']; ?>"><?php echo $lang['contact']['text_hon.']; ?></option>' +
            '</select>' +
            '</td>' +
            '<td><input type="text" class="form-transparent" name="contact[person][' + count + '][name]"></td>' +
            '<td><input type="text" class="form-transparent" name="contact[person][' + count + '][email]"></td>' +
            '<td><input type="text" class="form-transparent" name="contact[person][' + count + '][mobile]"></td>' +
            '<td><input type="text" class="form-transparent" name="contact[person][' + count + '][skype]"></td>' +
            '<td><input type="text" class="form-transparent" name="contact[person][' + count + '][designation]"></td>' +
            '<td class="text-center">' +
            '<a href="#" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close text-danger text-danger p-1 m-1"></i></a>' +
            '</td></tr>');

        return false;
    });

    $('#contact-person').on('click', '.delete', function() {
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
                            type = 'contact';
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
                        type: 'contact'
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
                    type: 'contact'
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