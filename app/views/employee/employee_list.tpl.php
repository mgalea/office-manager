<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#employee-li').addClass('active');
</script>
<!-- Employee list page start -->
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-people panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL . DIR_ROUTE . 'employee/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['common']['text_add']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-dark table-striped datatable-table" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th class="table-srno">#</th>
                            <th><?php echo $lang['common']['text_name']; ?></th>
                            <th><?php echo $lang['common']['text_email_address']; ?></th>
                            <th><?php echo $lang['common']['text_mobile_number']; ?></th>
                            <th>Employee Code</th>
                            <th>Hire Date</th>
                            <th><?php echo $lang['common']['text_status']; ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result) {
                            foreach ($result as $key => $value) {
                                $first = isset($value['first_name']) ? $value['first_name'] : (isset($value['firstname']) ? $value['firstname'] : '');
                                $last = isset($value['last_name']) ? $value['last_name'] : (isset($value['lastname']) ? $value['lastname'] : '');
                                $full_name = trim($first . ' ' . $last);
                                $name = !empty($value['name']) ? $value['name'] : (!empty($value['full_name']) ? $value['full_name'] : $full_name);
                                $email = !empty($value['email']) ? $value['email'] : (isset($value['email_address']) ? $value['email_address'] : '');
                                $mobile = !empty($value['mobile']) ? $value['mobile'] : (!empty($value['phone']) ? $value['phone'] : (isset($value['phone_number']) ? $value['phone_number'] : ''));
                                $employee_code = isset($value['employee_code']) ? $value['employee_code'] : '';
                                $hire_date = '';
                                if (!empty($value['hire_date'])) {
                                    $hire_date = $value['hire_date'];
                                } elseif (!empty($value['date_hired'])) {
                                    $hire_date = $value['date_hired'];
                                }
                                if (!empty($hire_date) && strtotime($hire_date) !== false) {
                                    $hire_date = date('d-m-Y', strtotime($hire_date));
                                }
                                $status = isset($value['status']) ? $value['status'] : null;
                                $employee_id = isset($value['id']) ? $value['id'] : 0;
                        ?>
                                <tr>
                                    <td class="table-srno"><?php echo $key + 1; ?></td>
                                    <td><?php echo !empty($name) ? $name : '-'; ?></td>
                                    <td><?php echo !empty($email) ? $email : '-'; ?></td>
                                    <td><?php echo !empty($mobile) ? $mobile : '-'; ?></td>
                                    <td><?php echo !empty($employee_code) ? $employee_code : '-'; ?></td>
                                    <td><?php echo !empty($hire_date) ? $hire_date : '-'; ?></td>
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
                                    <td class="table-action">
                                        <a href="<?php echo URL . DIR_ROUTE . 'employee/view&id=' . $employee_id; ?>" class="btn btn-info btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_view']; ?>"><i class="icon-eye"></i></a>
                                        <a href="<?php echo URL . DIR_ROUTE . 'employee/edit&id=' . $employee_id; ?>" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                        <span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $employee_id; ?>"></span>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div id="delete-card" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
            </div>
            <div class="modal-footer">
                <form action="<?php echo URL . DIR_ROUTE . 'employee/delete'; ?>" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
