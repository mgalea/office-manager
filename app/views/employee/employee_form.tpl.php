<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#employee-li').addClass('active');
</script>
<?php
$date_value = '';
$hire_value = '';
if (!empty($result['date_of_joining'])) {
    $date_value = $result['date_of_joining'];
} elseif (!empty($result['created_at'])) {
    $date_value = $result['created_at'];
} elseif (!empty($result['created_date'])) {
    $date_value = $result['created_date'];
} elseif (!empty($result['created_on'])) {
    $date_value = $result['created_on'];
}
if (!empty($date_value) && strtotime($date_value) !== false) {
    $date_value = date('Y-m-d', strtotime($date_value));
}
$hire_value = $date_value;
if (!empty($result['hire_date'])) {
    $hire_value = $result['hire_date'];
} elseif (!empty($result['date_hired'])) {
    $hire_value = $result['date_hired'];
}
if (!empty($hire_value) && strtotime($hire_value) !== false) {
    $hire_value = date('Y-m-d', strtotime($hire_value));
}
$status_value = isset($result['status']) ? (string)$result['status'] : '1';
?>
<div class="row">
    <div class="col-10 mx-auto">
        <form action="<?php echo $action; ?>" method="post">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-people panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                    <div class="panel-action">
                        <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                        <a href="<?php echo URL . DIR_ROUTE . 'employees'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
                    </div>
                </div>
                <div class="panel-wrapper p-2">
                    <input type="hidden" name="id" value="<?php if (isset($result['id'])) echo $result['id']; ?>">
                    <input type="hidden" name="_token" value="<?php echo $token; ?>">
                    <div class="mt-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_first_name']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[firstname]" value="<?php if (isset($result['firstname'])) { echo $result['firstname']; } elseif (isset($result['first_name'])) { echo $result['first_name']; } ?>" placeholder="<?php echo $lang['common']['text_first_name']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_last_name']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[lastname]" value="<?php if (isset($result['lastname'])) { echo $result['lastname']; } elseif (isset($result['last_name'])) { echo $result['last_name']; } ?>" placeholder="<?php echo $lang['common']['text_last_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="employee[email]" value="<?php if (isset($result['email'])) { echo $result['email']; } elseif (isset($result['email_address'])) { echo $result['email_address']; } ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_mobile_number']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[mobile]" value="<?php if (isset($result['mobile'])) { echo $result['mobile']; } elseif (isset($result['phone'])) { echo $result['phone']; } elseif (isset($result['phone_number'])) { echo $result['phone_number']; } ?>" placeholder="<?php echo $lang['common']['text_mobile_number']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-badge"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[employee_code]" value="<?php if (isset($result['employee_code'])) { echo $result['employee_code']; } ?>" placeholder="Employee Code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">ID Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[id_number]" value="<?php if (isset($result['id_number'])) { echo $result['id_number']; } ?>" placeholder="ID Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">PE Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="employee[pe_number]" value="<?php if (isset($result['pe_number'])) { echo $result['pe_number']; } ?>" placeholder="PE Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Hire Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="employee[hire_date]" value="<?php echo $hire_value; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_status']; ?></label>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="hidden" name="employee[status]" value="0">
                                        <input type="checkbox" class="custom-control-input" id="employee-status" name="employee[status]" value="1" <?php if ($status_value === '1') { echo "checked"; } ?>>
                                        <label class="custom-control-label" for="employee-status"><?php echo $lang['common']['text_active']; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    </div>
</div>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
