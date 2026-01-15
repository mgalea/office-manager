<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#salary-li').addClass('active');
</script>
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-wallet panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL . DIR_ROUTE . 'salary/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['common']['text_add']; ?></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="table-container">
                <table class="table table-dark table-striped datatable-table" width="100%">
                    <thead>
                        <tr class="table-heading">
                            <th class="table-srno">#</th>
                            <th>Month Paye</th>
                            <th>Employee Code</th>
                            <th>Work Hours</th>
                            <th>Basic Pay</th>
                            <th>Overtime Total</th>
                            <th>Bonus Total</th>
                            <th>Allowance Total</th>
                            <th>Post Tax Adjustment</th>
                            <th>FSS Main</th>
                            <th>NI Total</th>
                            <th>Parental Leave</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($result)) {
                            foreach ($result as $key => $value) {
                                $month_paye = !empty($value['month_paye']) ? date('d-m-Y', strtotime($value['month_paye'])) : '-';
                                $salary_id = isset($value['id']) ? $value['id'] : 0;
                                $overtime_total = (float)($value['overtime_normal'] ?? 0) + (float)($value['overtime_special'] ?? 0);
                                $bonus_total = (float)($value['bonus'] ?? 0) + (float)($value['government_bonus'] ?? 0);
                                $allowance_total = (float)($value['car_allowance'] ?? 0) + (float)($value['other_allowance'] ?? 0);
                                $ni_total = (float)($value['company_ni_contribution'] ?? 0) + (float)($value['employee_ni_contribution'] ?? 0);
                        ?>
                                <tr>
                                    <td class="table-srno"><?php echo $key + 1; ?></td>
                                    <td><?php echo $month_paye; ?></td>
                                    <td><?php echo isset($value['employee_code']) ? $value['employee_code'] : '-'; ?></td>
                                    <td><?php echo isset($value['workhours']) ? $value['workhours'] : '-'; ?></td>
                                    <td><?php echo isset($value['basic_pay']) ? $value['basic_pay'] : '-'; ?></td>
                                    <td><?php echo number_format($overtime_total, 2, '.', ''); ?></td>
                                    <td><?php echo number_format($bonus_total, 2, '.', ''); ?></td>
                                    <td><?php echo number_format($allowance_total, 2, '.', ''); ?></td>
                                    <td><?php echo isset($value['post_tax_adjustment']) ? $value['post_tax_adjustment'] : '-'; ?></td>
                                    <td><?php echo isset($value['fss_main']) ? $value['fss_main'] : '-'; ?></td>
                                    <td><?php echo number_format($ni_total, 2, '.', ''); ?></td>
                                    <td><?php echo isset($value['parental_leave_contribution']) ? $value['parental_leave_contribution'] : '-'; ?></td>
                                    <td class="table-action">
                                        <a href="<?php echo URL . DIR_ROUTE . 'salary/view&id=' . $salary_id; ?>" class="btn btn-info btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_view']; ?>"><i class="icon-eye"></i></a>
                                        <a href="<?php echo URL . DIR_ROUTE . 'salary/edit&id=' . $salary_id; ?>" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                                        <span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $salary_id; ?>"></span>
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
                <form action="<?php echo URL . DIR_ROUTE . 'salary/delete'; ?>" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
