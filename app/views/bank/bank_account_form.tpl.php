<?php include(DIR . 'app/views/common/header.tpl.php'); ?>

<script>
    $('#company').show();
    $('#company-li').addClass('active');
</script>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-bank panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                <a href="<?php echo URL . DIR_ROUTE . 'clients'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper p-3">
            <input type="hidden" name="_token" value="<?php echo $token; ?>">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-form-label"><?php echo $lang['bank']['text_name']; ?></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="account[name]" value="<?php echo $result['name']; ?>" placeholder="<?php echo $lang['bank']['text_name']; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_number']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" name="account[number]" value="<?php echo $result['number']; ?>" placeholder="<?php echo $lang['bank']['text_number']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_currency']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>

                                <select class="custom-select" name="account[currency]" required>
                                    <option value="0"><?php echo $lang['bank']['text_currency']; ?></option>
                                    <?php if (!empty($currencies)) {
                                        foreach ($currencies as $key => $value) { ?>
                                            <option value=" <?php echo $value['id'] ?>" <?php if ($result['currency'] == $value['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['name'] ?></option>
                                    <?php }
                                    } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_type']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <select class="custom-select" name="account[type]" required>
                                    <option value="0"><?php echo $lang['bank']['text_type']; ?></option>
                                    <?php if (!empty($types)) {
                                        foreach ($types as $key => $value) { ?>
                                            <option value=" <?php echo $value['id'] ?>" <?php if ($result['type'] == $value['id']) {
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
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_bank']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <select class="custom-select" name="account[bank]" required>
                                    <option value="0"><?php echo $lang['bank']['text_bank']; ?></option>
                                    <?php if (!empty($banks)) {
                                        foreach ($banks as $key => $value) { ?>
                                            <option value=" <?php echo $value['id'] ?>" <?php if ($result['bank'] == $value['id']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $value['name'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_branch']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="account[bank_branch]" value="<?php echo $result['bank_branch']; ?>" placeholder="<?php echo $lang['bank']['text_branch']; ?>">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_sort_code']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" name="account[sort_code]" value="<?php echo $result['sort_code']; ?>" placeholder="<?php echo $lang['bank']['text_sort_code']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_iban']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="account[iban]" value="<?php echo $result['iban']; ?>" placeholder="<?php echo $lang['bank']['text_iban']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_swift']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="account[swift]" value="<?php echo $result['swift']; ?>" placeholder="<?php echo $lang['bank']['text_swift']; ?>">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['common']['text_created_date']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo date_format(date_create($result['last_updated']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['common']['text_created_date']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="col-form-label"><?php echo $lang['bank']['text_remittance']; ?></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-check"></i></span>
                                </div>
                                <select name="client[status]" class="custom-select">
                                    <option value="1" <?php if ($result['remittance'] == "1") {
                                                            echo "selected";
                                                        } ?>><?php echo $lang['common']['text_active']; ?></option>
                                    <option value="0" <?php if ($result['status'] == "0") {
                                                            echo "selected";
                                                        } ?>>In <?php echo $lang['common']['text_inactive']; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
            <input type="hidden" name="client[id]" value="<?php echo $result['id']; ?>">
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" name="submit" class="btn btn-info"><?php echo $lang['common']['text_save']; ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>