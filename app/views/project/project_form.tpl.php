<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#project-li').addClass('active');</script>

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo $token; ?>">
    <div class="panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-layers panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
                <button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
                <a href="<?php echo URL.DIR_ROUTE . 'projects'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="<?php echo $lang['common']['text_back_to_list']; ?>"><i class="fa fa-reply"></i></a>
            </div>  
        </div>
        <div class="panel-wrapper">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary pt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#basic-info" data-toggle="tab"><i class="icon-home mr-2"></i><?php echo $lang['project']['text_basic_info']; ?></a>
                </li>
                <li class="nav-item">  
                    <a class="nav-link" href="#staff" data-toggle="tab"><i class="icon-people mr-2"></i><?php echo $lang['project']['text_staff']; ?></a>
                </li>
                <li class="nav-item">  
                    <a class="nav-link" href="#task" data-toggle="tab"><i class="icon-tag mr-2"></i><?php echo $lang['project']['text_tasks']; ?></a>
                </li>
                <?php if (!empty($result['id'])) { ?>
                <li class="nav-item">  
                    <a class="nav-link" href="#documents" data-toggle="tab"><i class="icon-docs mr-2"></i><?php echo $lang['project']['text_documents']; ?></a>
                </li>
                <li class="nav-item">  
                    <a class="nav-link" href="#comment" data-toggle="tab"><i class="icon-tag mr-2"></i><?php echo $lang['project']['text_comments']; ?></a>
                </li>
                <?php } ?>
            </ul>
            <div class="p-3">
                <div class="tab-content mt-3 pl-4 pr-4">
                    <div class="tab-pane active" id="basic-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['project']['text_project_name']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-layers"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="project[name]" value="<?php echo $result['name'] ?>" placeholder="<?php echo $lang['project']['text_project_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group customer-search">
                                    <label class="col-form-label"><?php echo $lang['common']['text_customer']; ?></label>
                                    <div class="form-group">
                                        <select name="project[customer]" class="selectpicker" data-width="100%" data-live-search="true" title="<?php echo $lang['common']['text_customer']; ?>">
                                            <?php if ($customers) { foreach ($customers as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" data-tokens="<?php echo $value['company']; ?>" <?php if ($result['customer'] == $value['id']) { echo "selected"; } ?> ><?php echo $value['company']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['project']['text_billing_method']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money"></i></span>
                                        </div>
                                        <select class="custom-select billing-method" name="project[billingmethod]">
                                            <option value="1" <?php if ($result['billing_method'] == 1) { echo "selected"; } ?> ><?php echo $lang['project']['text_fixed_cost_for_project']; ?></option>
                                            <option value="2" <?php if ($result['billing_method'] == 2) { echo "selected"; } ?> ><?php echo $lang['project']['text_based_on_project_hours']; ?></option>
                                            <option value="3" <?php if ($result['billing_method'] == 3) { echo "selected"; } ?> ><?php echo $lang['project']['text_based_on_task_hours']; ?></option>
                                            <option value="4" <?php if ($result['billing_method'] == 4) { echo "selected"; } ?> ><?php echo $lang['project']['text_based_on_staff_hours']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_currency']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-credit-card"></i></span>
                                        </div>
                                        <select name="project[currency]" class="custom-select" required>
                                            <?php if ($currency) { foreach ($currency as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if ($result['currency'] == $value['id']) { echo "selected"; } ?>><?php echo $value['name']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group budget-cost">
                                    <label class="col-form-label"><?php echo $lang['project']['text_total_budget_cost']; ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="<?php echo $result['total_cost'] ?>" name="project[totalcost]" placeholder="<?php echo $lang['project']['text_total_budget_cost']; ?>">
                                    </div>
                                </div>
                                <div class="form-group rate-hour">
                                    <label class="col-form-label"><?php echo $lang['project']['text_rate_per_hour']; ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="project[ratehour]" value="<?php echo $result['rate_hour'] ?>" placeholder="<?php echo $lang['project']['text_rate_per_hour']; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text font-12"><?php echo $lang['project']['text_per_hour']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group project-hours">
                                    <label class="col-form-label"><?php echo $lang['project']['text_project_hours']; ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="project[projecthour]" value="<?php echo $result['project_hour'] ?>" placeholder="<?php echo $lang['project']['text_project_hours']; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text font-12"><?php echo $lang['project']['text_hours']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['project']['text_project_start_date']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control date" name="project[start_date]" value="<?php echo date_format(date_create($result['start_date']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['project']['text_project_start_date']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['project']['text_project_due_date']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-event"></i></span>
                                        </div>
                                        <input type="text" class="form-control date" name="project[due_date]" value="<?php echo date_format(date_create($result['due_date']), 'd-m-Y'); ?>" placeholder="<?php echo $lang['project']['text_project_due_date']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">% <?php echo $lang['project']['text_complete']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-battery-half"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="project[completed]" value="<?php echo $result['completed'] ?>" placeholder="% <?php echo $lang['project']['text_complete']; ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['common']['text_description']; ?></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-note"></i></span>
                                        </div>
                                        <textarea class="form-control" rows="5" name="project[description]" placeholder="<?php echo $lang['common']['text_description']; ?>"><?php echo $result['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="staff">
                        <div class="">
                            <table class="table table-input font-12">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang['project']['text_staff']; ?></th>
                                        <th><?php echo $lang['project']['text_hours']; ?></th>
                                        <th><?php echo $lang['project']['text_rate_per_hour']; ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result['staff']) { foreach ($result['staff'] as $key => $value) { ?> 
                                    <tr>
                                        <td>
                                            <select class="selectpicker" name="project[staff][<?php echo $key ?>][name]" data-width="100%" data-live-search="true" title="<?php echo $lang['project']['text_staff']; ?>">
                                                <?php if ($staff) { foreach ($staff as $staff_key => $staff_value) { ?>
                                                <option value="<?php echo $staff_value['user_id']; ?>" <?php if ($value['name'] == $staff_value['user_id']) { echo "selected"; } ?> ><?php echo $staff_value['name'].' <small> ('. $staff_value['email'].')</small>'; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-transparent" name="project[staff][<?php echo $key; ?>][hours]" value="<?php echo $value['hours'] ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-transparent" name="project[staff][<?php echo $key; ?>][rate]" value="<?php echo $value['rate'] ?>">
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="Delete"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>
                                        </td>
                                    </tr>
                                    <?php  } } else { ?>
                                    <tr>
                                        <td>
                                            <select class="selectpicker" name="project[staff][0][name]" data-width="100%" data-live-search="true" title="<?php echo $lang['project']['text_staff']; ?>">
                                                <?php if ($staff) { foreach ($staff as $staff_key => $staff_value) { ?>
                                                <option value="<?php echo $staff_value['user_id']; ?>" ><?php echo $staff_value['name'].' <small> ('. $staff_value['email'].')</small>'; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-transparent" name="project[staff][0][hours]" value="">
                                        </td>
                                        <td>
                                            <input type="text" class="form-transparent" name="project[staff][0][rate]" value="">
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3 mt-3">
                            <a href="#" class="btn btn-success btn-sm add-staff"><i class="icon-plus mr-2"></i> <?php echo $lang['common']['text_add'].' '.$lang['project']['text_staff']; ?></a>
                        </div>
                    </div>
                    <div class="tab-pane" id="task">
                        <div class="table-responsive">
                            <table class="table table-input font-12">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang['project']['text_task_name']; ?></th>
                                        <th><?php echo $lang['project']['text_description']; ?></th>
                                        <th><?php echo $lang['project']['text_rate_per_hour']; ?></th>
                                        <th><?php echo $lang['project']['text_work_hours']; ?> (HH)</th>
                                        <th><?php echo $lang['common']['text_status']; ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result['task']) { foreach ($result['task'] as $key => $value) { ?> 
                                    <tr>
                                        <td>
                                            <input type="text" name="project[task][<?php echo $key ?>][name]" value="<?php echo $value['name'] ?>" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][<?php echo $key ?>][description]" value="<?php echo $value['description'] ?>" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][<?php echo $key ?>][ratehour]" value="<?php echo $value['ratehour'] ?>" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][<?php echo $key ?>][budgethour]" value="<?php echo $value['budgethour'] ?>" class="form-transparent">
                                        </td>
                                        <td>
                                            <select name="project[task][<?php echo $key ?>][status]" class="custom-select">
                                                <option><?php echo $lang['common']['text_status']; ?></option>
                                                <option value="1" <?php if ($value['status'] == "1") { echo "selected"; }?>><?php echo $lang['project']['text_started']; ?></option>
                                                <option value="2" <?php if ($value['status'] == "2") { echo "selected"; }?>><?php echo $lang['project']['text_in_process']; ?></option>
                                                <option value="3" <?php if ($value['status'] == "3") { echo "selected"; }?>><?php echo $lang['project']['text_testing']; ?></option>
                                                <option value="4" <?php if ($value['status'] == "4") { echo "selected"; }?>><?php echo $lang['project']['text_completed']; ?></option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>
                                        </td>
                                    </tr>
                                    <?php  } } else { ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="project[task][0][name]" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][0][description]" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][0][ratehour]" class="form-transparent">
                                        </td>
                                        <td>
                                            <input type="text" name="project[task][0][budgethour]" class="form-transparent">
                                        </td>
                                        <td>
                                            <select name="project[task][0][status]" class="custom-select">
                                                <option><?php echo $lang['common']['text_status']; ?></option>
                                                <option value="1"><?php echo $lang['project']['text_started']; ?></option>
                                                <option value="2"><?php echo $lang['project']['text_in_process']; ?></option>
                                                <option value="3"><?php echo $lang['project']['text_testing']; ?></option>
                                                <option value="4"><?php echo $lang['project']['text_completed']; ?></option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3 mt-3">
                            <a href="#" class="btn btn-success btn-sm add-task"><i class="icon-plus mr-2"></i> <?php echo $lang['project']['text_add_task']; ?></a>
                        </div>
                    </div>
                    <?php if (!empty($result['id'])) { ?>
                    <div class="tab-pane" id="documents">
                        <div class="form-group row pb-3">
                            <div class="attach-file col-md-10">
                                <a data-toggle="modal" class="text-white bg-primary" data-target="#attach-file"><?php echo $lang['project']['text_upload_image']; ?></a>
                            </div>
                        </div>
                        <div class="attached-files">
                            <?php if (!empty($documents)) { foreach ($documents as $key => $value) { $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION); if ($file_ext == "pdf") { ?>
                            <div class="attached-files-block">
                                <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf-o"></i></a>
                                <input type="hidden" name="expense[attached][]" value="<?php echo $value['file_name']; ?>">
                                <div class="delete-file"><a class="icon-trash"></a></div>
                            </div>
                            <?php } else { ?>
                            <div class="attached-files-block">
                                <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""></a>
                                <input type="hidden" name="expense[attached][]" value="<?php echo $value['file_name']; ?>">
                                <div class="delete-file"><a class="icon-trash"></a></div>
                            </div>
                            <?php } } } ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="comment">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea id="project-comment" rows="4" class="form-control"></textarea>
                                </div>
                                <div>
                                    <p id="comment-submit" class="btn btn-warning btn-sm m-o"><?php echo $lang['project']['text_add_comment']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="timeline">
                                    <?php if (!empty($comments)) { foreach ($comments as $key => $value) { ?>
                                    <li>
                                        <div class="time"><small><?php echo $value['date_of_joining']; ?></small></div>
                                        <div class="timeline-container">
                                            <div class="arrow"></div>
                                            <div class="description"><?php echo $value['comment']; ?></div>
                                            <div class="author"><?php echo $value['user']; ?></div>
                                        </div>
                                    </li>
                                    <?php } } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
</form>

<!-- Attach File Modal -->
<div id="attach-file" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['project']['text_upload_documents']; ?></h5>
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

<script>
    var staff = "";
    <?php foreach ($staff as $key => $value) { ?> var temp = '<option value="<?php echo $value['user_id'] ?>" data-email="<?php echo $value['email'] ?>"><?php echo $value['name'].' <small> ('. $value['email'].')</small>' ?></option>';
    staff += temp;<?php } ?>
    $('#staff').on('click', '.add-staff', function () {
        var count = $('#staff table tr:last select').attr('name').split('[')[2];
        count = parseInt(count.split(']')[0]) + 1;
        $('#staff table tbody').append('<tr>'+
            '<td>'+
            '<select class="selectpicker" name="project[staff]['+count+'][name]" data-width="100%" data-live-search="true" title="<?php echo $lang['project']['text_staff']; ?>"></select>'+
            '</td>'+
            '<td>'+
            '<input type="text" class="form-transparent" name="project[staff]['+count+'][hours]" value="">'+
            '</td>'+
            '<td>'+
            '<input type="text" class="form-transparent" name="project[staff]['+count+'][rate]" value="">'+
            '</td>'+
            '<td class="text-center">'+
            '<a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="Delete"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>'+
            '</td></tr>');
        $('#staff table tr:last select').append(staff);
        $('#staff table tr:last select').selectpicker('refresh');

        return false;
    });

    $('#staff').on('click', '.delete', function () {
        $(this).parents('tr').remove();
    })

    $('body').on('change', '.billing-method', function() {
        var val = $(this).val();
        $('.budget-cost, .project-hours, .rate-hour').hide();
        if (val === "1") {
            $('.budget-cost').show();
        } else if (val === "2") {
            $('.project-hours').show();
            $('.rate-hour').show();
        } else if (val === "3") {

        } else if (val === "4") {

        }
    });
    <?php if ($result['billing_method'] == 1) { ?> $('.rate-hour, .project-hours').hide(); $('.budget-cost').show(); <?php } else if ($result['billing_method'] == 2) { ?> $('.budget-cost').hide(); $('.rate-hour, .project-hours').show(); <?php } ?>

    $('body').on('click', '#comment-submit', function () {
        var id = $('input[name="id"]').val(), comment = $('#project-comment').val(), comment_to = 'project';

        $.ajax({
            method: "POST",
            url: 'index.php?route=make_comment',
            data: { id: id, comment : comment, comment_to : comment_to },
            error: function () {
                toastr.error('Comment could not added', 'Server Error');
            },
            success: function (response) {
                $('#project-comment').val('');
                $('.timeline').prepend('<li>'+
                    '<div class="time"><small>Now</small></div>'+
                    '<div class="timeline-container">'+
                    '<div class="arrow"></div>'+
                    '<div class="description">'+comment+'</div>'+
                    '<div class="author">'+$('.menu-user-info p:nth-child(1)').text()+'</div>'+
                    '</div>'+
                    '</li>');
                toastr.success('Comment added Succefully', 'Success');
            }
        });
    });



    //********************************************
    //Add Task ***********************************
    //********************************************
    $('#task').on('click', '.add-task', function () {
        var count = $('#task table tr:last input').attr('name').split('[')[2];
        count = parseInt(count.split(']')[0]) + 1;
        $('#task table tbody').append('<tr><td>'+
            '<input type="text" name="project[task]['+count+'][name]" class="form-transparent">'+
            '</td>'+
            '<td>'+
            '<input type="text" name="project[task]['+count+'][description]" class="form-transparent">'+
            '</td>'+
            '<td>'+
            '<input type="text" name="project[task]['+count+'][ratehour]" class="form-transparent">'+
            '</td>'+
            '<td>'+
            '<input type="text" name="project[task]['+count+'][budgethour]" class="form-transparent">'+
            '</td>'+
            '<td>'+
            '<select name="project[task]['+count+'][status]" class="custom-select">'+
            '<option>Select Status</option>'+
            '<option value="1">Started</option>'+
            '<option value="2">In Process</option>'+
            '<option value="3">Testing</option>'+
            '<option value="4">Completed</option>'+
            '</select>'+
            '</td>'+
            '<td class="text-center">'+
            '<a href="#" class="delete font-20 mt-3" data-toggle="tooltip" data-placement="top" title="Delete"><i class="icon-close text-danger text-danger p-1 m-1"></i></a>'+
            '</td></tr>');

        return false;
    });

    $('#task').on('click', '.delete', function () {
        $(this).parents('tr').remove();
    })

    $(document).ready(function () {

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
            dictDefaultMessage: '<?php echo $lang['common']['text_drop_message'].'<br /><br />'.$lang['common']['text_allowed_file']; ?>',
            init: function() {
                this.on("sending", function(file, xhr, formData){
                    var id = $('input[name=id]').val(),
                    type = 'project';
                    formData.append("id", id);
                    formData.append("type", type);
                }),
                this.on("success", function(file, xhr){
                    var ext = file.xhr.response.substr(file.xhr.response.lastIndexOf('.') + 1);
                    if (ext === "pdf") {
                        $('.attached-files').append('<div class="attached-files-block attached-'+ file.xhr.response.slice(0, -4)+'">'+
                           '<a href="public/uploads/'+ file.xhr.response +'" class="open-pdf"><i class="fa fa-file-pdf-o"></i></a>'+
                           '<input type="hidden" name="expense[attached][]" value="'+ file.xhr.response +'">'+
                           '<div class="delete-file"><a class="icon-trash"></a></div>'+
                           '</div>');
                    } else {
                        $('.attached-files').append('<div class="attached-files-block attached-'+ file.xhr.response.slice(0, -4)+'">'+
                         '<a href="public/uploads/'+ file.xhr.response +'" data-fancybox="gallery"><img src="public/uploads/'+ file.xhr.response +'" alt=""></a>'+
                         '<input type="hidden" name="expense[attached][]" value="'+ file.xhr.response +'">'+
                         '<div class="delete-file"><a class="icon-trash"></a></div>'+
                         '</div>');
                    }
                    toastr.success('Document added Succefully', 'Success');
                })
            },
            renameFile: function (file) {
                return file.name.split('.')[0] + new Date().valueOf() + "." + file.name.split('.').pop();
            },
            removedfile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: 'index.php?route=attachFile/delete',
                    data: {name: name, type: 'project'},
                    error: function() {
                        toastr.error('File could not be deleted', 'Server Error');
                    },
                    success: function(data) {
                        $('.attached-'+name.slice(0, -4)+'').remove();
                        toastr.success('File Deleted Succefully', 'Success');
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

        $('.attached-files-block').on('click', '.delete-file a', function () {
            var ele = $(this),
            name = ele.parents('.attached-files-block').find('input').val();
            $.ajax({
                type: 'POST',
                url: 'index.php?route=attachFile/delete',
                data: {name: name, type: 'project'},
                error: function() {
                    toastr.error('File could not be deleted', 'Server Error');
                },
                success: function(data) {
                    $('.attached-'+name.slice(0, -4)+'').remove();
                    toastr.success('File Deleted Succefully', 'Success');
                }
            });
            ele.parents('.attached-files-block').remove();
        });
    });
</script>
<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>