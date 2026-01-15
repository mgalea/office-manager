<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#salary-li').addClass('active');
</script>
<?php
$month_paye_value = '';
if (!empty($result['month_paye'])) {
    $month_paye_value = $result['month_paye'];
}
if (!empty($month_paye_value) && strtotime($month_paye_value) !== false) {
    $month_paye_value = date('Y-m-d', strtotime($month_paye_value));
}
?>
<div class="row">
    <div class="col-10 mx-auto">
        <form action="<?php echo $action; ?>" method="post">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-wallet panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                    <div class="panel-action">
                        <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                        <a href="<?php echo URL . DIR_ROUTE . 'salaries'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
                    </div>
                </div>
                <div class="panel-wrapper p-2">
                    <input type="hidden" name="id" value="<?php if (isset($result['id'])) echo $result['id']; ?>">
                    <input type="hidden" name="_token" value="<?php echo $token; ?>">
                    <div class="mt-3 pl-4 pr-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Month Paye</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="salary[month_paye]" value="<?php echo $month_paye_value; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="salary[employee_code]" value="<?php if (isset($result['employee_code'])) echo $result['employee_code']; ?>" placeholder="Employee Code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Work Hours</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input type="number" step="0.1" class="form-control" name="salary[workhours]" value="<?php if (isset($result['workhours'])) echo $result['workhours']; ?>" placeholder="Work Hours" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Basic Pay</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-coins"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[basic_pay]" value="<?php if (isset($result['basic_pay'])) echo $result['basic_pay']; ?>" placeholder="Basic Pay" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Overtime Normal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[overtime_normal]" value="<?php if (isset($result['overtime_normal'])) echo $result['overtime_normal']; ?>" placeholder="Overtime Normal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Overtime Special</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[overtime_special]" value="<?php if (isset($result['overtime_special'])) echo $result['overtime_special']; ?>" placeholder="Overtime Special" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Bonus</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[bonus]" value="<?php if (isset($result['bonus'])) echo $result['bonus']; ?>" placeholder="Bonus" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Car Allowance</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-car"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[car_allowance]" value="<?php if (isset($result['car_allowance'])) echo $result['car_allowance']; ?>" placeholder="Car Allowance" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Other Allowance</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[other_allowance]" value="<?php if (isset($result['other_allowance'])) echo $result['other_allowance']; ?>" placeholder="Other Allowance" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Government Bonus</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[government_bonus]" value="<?php if (isset($result['government_bonus'])) echo $result['government_bonus']; ?>" placeholder="Government Bonus" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Post Tax Adjustment</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-exchange-alt"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[post_tax_adjustment]" value="<?php if (isset($result['post_tax_adjustment'])) echo $result['post_tax_adjustment']; ?>" placeholder="Post Tax Adjustment" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">FSS Main</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[fss_main]" value="<?php if (isset($result['fss_main'])) echo $result['fss_main']; ?>" placeholder="FSS Main" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Company NI Contribution</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[company_ni_contribution]" value="<?php if (isset($result['company_ni_contribution'])) echo $result['company_ni_contribution']; ?>" placeholder="Company NI Contribution" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee NI Contribution</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[employee_ni_contribution]" value="<?php if (isset($result['employee_ni_contribution'])) echo $result['employee_ni_contribution']; ?>" placeholder="Employee NI Contribution" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Parental Leave Contribution</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-people"></i></span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control" name="salary[parental_leave_contribution]" value="<?php if (isset($result['parental_leave_contribution'])) echo $result['parental_leave_contribution']; ?>" placeholder="Parental Leave Contribution" required>
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
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>
