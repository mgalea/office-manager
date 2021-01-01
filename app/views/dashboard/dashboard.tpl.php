<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#dashboard-li').addClass('active');
</script>
<!-- Moris Chart Plugin -->
<script type="text/javascript" src="public/js/raphael-min.js"></script>
<!-- Dahsboard Body -->
<div class="content">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-success">
                <div class="content">
                    <h4><?php echo $statistics['0']['total']; ?></h4> <span><?php echo $lang['common']['text_contact']; ?></span>
                </div>
                <div class="icon"><i class="icon-people"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-warning">
                <div class="content">
                    <h4><?php echo $statistics['1']['total']; ?></h4> <span><?php echo $lang['common']['text_projects']; ?></span>
                </div>
                <div class="icon"><i class="icon-layers"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-primary">
                <div class="content">
                    <h4><?php echo $statistics['2']['total']; ?></h4> <span><?php echo $lang['common']['text_invoices']; ?></span>
                </div>
                <div class="icon"><i class="icon-docs"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-danger">
                <div class="content">
                    <h4><?php echo $statistics['3']['total']; ?></h4> <span><?php echo $lang['common']['text_quotes']; ?></span>
                </div>
                <div class="icon"><i class="icon-envelope-letter"></i></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="icon-widget-heading pb-3"><?php echo $lang['dashboard']['text_notes']; ?></div>
                    <div id="inv-exp-chart" style="height: 380px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="">
                    <div class="icon-widget-heading pr-3 pl-3 pt-3 pb-0"><?php echo $lang['dashboard']['text_ticket_status_breakdown']; ?></div>
                    <div id="ticket-chart" style="height: 180px;"></div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="">
                    <div class="icon-widget-heading pr-3 pl-3 pt-3 pb-0"><?php echo $lang['dashboard']['text_expense_categories_breakdown']; ?></div>
                    <div id="exp-catg-chart" style="height: 180px;"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">

        </div>
        <div class="col-lg-4">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="icon-credit-card panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $lang['dashboard']['text_latest_contacts']; ?></span>
                    </div>
                    <div class="panel-action"></div>
                </div>
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $lang['dashboard']['text_company']; ?></th>
                                    <th><?php echo $lang['common']['text_first_name']; ?></th>
                                    <th><?php echo $lang['common']['text_last_name']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($contacts)) {
                                    foreach ($contacts as $key => $value) { ?>
                                        <tr>
                                            <td><a href="<?php echo URL . DIR_ROUTE . 'contact/edit&id=' . $value['id']; ?>" class="text-primary"><?php echo $value['company']; ?></a></td>
                                            <td class="text-dark"><?php echo $value['firstname']; ?></td>
                                            <td class="text-dark"><?php echo $value['lastname']; ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="3" class="text-center font-18"><?php echo $lang['dashboard']['text_no_record_found']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>