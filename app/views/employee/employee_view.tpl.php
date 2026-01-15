<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#employee-li').addClass('active');
</script>
<?php
$first = isset($result['first_name']) ? $result['first_name'] : (isset($result['firstname']) ? $result['firstname'] : '');
$last = isset($result['last_name']) ? $result['last_name'] : (isset($result['lastname']) ? $result['lastname'] : '');
$full_name = trim($first . ' ' . $last);
$name = !empty($result['name']) ? $result['name'] : (!empty($result['full_name']) ? $result['full_name'] : $full_name);
$email = !empty($result['email']) ? $result['email'] : (isset($result['email_address']) ? $result['email_address'] : '');
$mobile = !empty($result['mobile']) ? $result['mobile'] : (!empty($result['phone']) ? $result['phone'] : (isset($result['phone_number']) ? $result['phone_number'] : ''));
$employee_code = isset($result['employee_code']) ? $result['employee_code'] : '';
$id_number = isset($result['id_number']) ? $result['id_number'] : '';
$pe_number = isset($result['pe_number']) ? $result['pe_number'] : '';
$hire_date = '';
if (!empty($result['hire_date'])) {
    $hire_date = $result['hire_date'];
} elseif (!empty($result['date_hired'])) {
    $hire_date = $result['date_hired'];
}
if (!empty($hire_date) && strtotime($hire_date) !== false) {
    $hire_date = date('d-m-Y', strtotime($hire_date));
}
$status = isset($result['status']) ? $result['status'] : null;
?>
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-people panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL . DIR_ROUTE . 'employee/edit&id=' . $result['id']; ?>" class="btn btn-info btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                <a href="<?php echo URL . DIR_ROUTE . 'employees'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th><?php echo $lang['common']['text_name']; ?></th>
                                <td><?php echo !empty($name) ? $name : '-'; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $lang['common']['text_email_address']; ?></th>
                                <td><?php echo !empty($email) ? $email : '-'; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $lang['common']['text_mobile_number']; ?></th>
                                <td><?php echo !empty($mobile) ? $mobile : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Employee Code</th>
                                <td><?php echo !empty($employee_code) ? $employee_code : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>ID Number</th>
                                <td><?php echo !empty($id_number) ? $id_number : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>PE Number</th>
                                <td><?php echo !empty($pe_number) ? $pe_number : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Hire Date</th>
                                <td><?php echo !empty($hire_date) ? $hire_date : '-'; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $lang['common']['text_status']; ?></th>
                                <td>
                                    <?php
                                    if ($status === null) {
                                        echo '-';
                                    } elseif ((string)$status === '1') {
                                        echo $lang['common']['text_active'];
                                    } else {
                                        echo $lang['common']['text_inactive'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
