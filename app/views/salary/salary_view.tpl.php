<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#salary-li').addClass('active');
</script>
<?php
$month_paye = !empty($result['month_paye']) ? date('d-m-Y', strtotime($result['month_paye'])) : '-';
?>
<div class="content">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-wallet panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <a href="<?php echo URL . DIR_ROUTE . 'salary/edit&id=' . $result['id']; ?>" class="btn btn-info btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
                <a href="<?php echo URL . DIR_ROUTE . 'salaries'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Month Paye</th>
                                <td><?php echo $month_paye; ?></td>
                            </tr>
                            <tr>
                                <th>Employee Code</th>
                                <td><?php echo !empty($result['employee_code']) ? $result['employee_code'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Work Hours</th>
                                <td><?php echo isset($result['workhours']) ? $result['workhours'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Basic Pay</th>
                                <td><?php echo isset($result['basic_pay']) ? $result['basic_pay'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Overtime Normal</th>
                                <td><?php echo isset($result['overtime_normal']) ? $result['overtime_normal'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Overtime Special</th>
                                <td><?php echo isset($result['overtime_special']) ? $result['overtime_special'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Bonus</th>
                                <td><?php echo isset($result['bonus']) ? $result['bonus'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Car Allowance</th>
                                <td><?php echo isset($result['car_allowance']) ? $result['car_allowance'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Other Allowance</th>
                                <td><?php echo isset($result['other_allowance']) ? $result['other_allowance'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Government Bonus</th>
                                <td><?php echo isset($result['government_bonus']) ? $result['government_bonus'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Post Tax Adjustment</th>
                                <td><?php echo isset($result['post_tax_adjustment']) ? $result['post_tax_adjustment'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>FSS Main</th>
                                <td><?php echo isset($result['fss_main']) ? $result['fss_main'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Company NI Contribution</th>
                                <td><?php echo isset($result['company_ni_contribution']) ? $result['company_ni_contribution'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Employee NI Contribution</th>
                                <td><?php echo isset($result['employee_ni_contribution']) ? $result['employee_ni_contribution'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <th>Parental Leave Contribution</th>
                                <td><?php echo isset($result['parental_leave_contribution']) ? $result['parental_leave_contribution'] : '-'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
