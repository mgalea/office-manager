<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>$('#contact').show();$('#contact-li').addClass('active');</script>
<div class="row">
    <div class="col-lg-4">
        <div class="contact-panel">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="user-details text-center">
                    <h2><?php echo $result['company']; ?></h2>
                    <p class="font-16 mb-1 font-500"><?php echo $result['salutation'].' '.$result['firstname'].' '.$result['lastname']; ?></p>
                    <p class="mb-1"><i class="icon-envelope"></i> <?php echo $result['email']; ?></p>
                    <p class="mb-1"><i class="icon-screen-smartphone"></i> <?php echo $result['phone']; ?></p>
                    <p><i class="icon-globe"></i> <?php echo $result['website']; ?></p>
                    <ul class="nav flex-column vnav-tabs text-left">
                        <li class="nav-item">
                            <a href="#contacts" class="nav-link active" data-toggle="tab"><i class="icon-user"></i> <span><?php echo $lang['common']['text_contact']; ?></span></a>
                        </li>
                        <?php  if((int)$result['contact_type']>2){  ?>
                        <li class="nav-item">
                            <a href="#invoice" class="nav-link" data-toggle="tab"><i class="icon-docs"></i> <span><?php echo $lang['common']['text_invoices']; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#quotes" class="nav-link" data-toggle="tab"><i class="icon-calculator"></i> <span><?php echo $lang['common']['text_quotes']; ?></span></a>
                        </li>
                        <?php }?>
                        <li class="nav-item">
                            <a data-toggle="modal" data-target="#contactMail"><i class="icon-paper-plane"></i> <span><?php echo $lang['contact']['text_send_mail']; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URL.DIR_ROUTE.'contact/edit&id='.$result['id']; ?>"><i class="icon-pencil"></i> <span><?php echo $lang['common']['text_edit']; ?></span></a>
                        </li>
                        <li class="nav-item">
                        <a href="<?php echo URL . DIR_ROUTE . 'contacts'; ?>"><i class="fa fa-reply"> </i><span><?php echo $lang['common']['text_back_to_list']; ?></span></a>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-lg-8">
        <div class="tab-content m-0">
            <div id="contacts" class="tab-pane active">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <i class="far fa-address-book panel-head-icon"></i>
                            <span class="panel-title-text"><?php echo $result['company']; ?></span>
 
                        </div>
                        <div class="panel-action">
                        <a href="<?php echo URL . DIR_ROUTE . 'contacts'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>
  
                        </div>  
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-500 text-green font-20 m-0"><?php echo $lang['common']['text_address']; ?></h5>
                            </div>
                            <div class="col-12">
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['address1'].', '.$result['address']['address2']; ?></p>
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['city'].', '.$result['address']['state'].', '; ?></p>
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['country']; ?></p>
                                <p class="mb-1"><span class="font-500"><?php echo $lang['contact']['text_pincode'] ?> </span> : <?php echo $result['address']['pin']; ?></p>
                                <p class="mb-1"><span class="font-500"><?php echo $lang['common']['text_phone_number'] ?></span> : <?php echo $result['address']['phone1']; ?></p>
                            </div>
                        </div>
                        <h5 class="font-500 font-20 text-green mt-3"><?php echo $lang['contact']['text_contact_persons']; ?></h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang['common']['text_name']; ?></th>
                                        <th><?php echo $lang['common']['text_email_address']; ?></th>
                                        <th><?php echo $lang['common']['text_mobile_number']; ?></th>
                                        <th><?php echo $lang['common']['text_skype']; ?></th>
                                        <th><?php echo $lang['contact']['text_designation']; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result['persons']) { foreach ($result['persons'] as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['salutation'].' '.$value['name']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['mobile']; ?></td>
                                        <td><?php echo $value['skype']; ?></td>
                                        <td><span class="badge badge-light badge-sm badge-pill"><?php echo $value['designation']; ?></span></td>
                                    </tr>
                                    <?php } } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><?php echo $lang['common']['text_no_records_available']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="font-500 font-20 text-green mt-4"><?php echo $lang['contact']['text_remark']; ?></h5>
                        <div class="mb-1"><?php echo html_entity_decode($result['remark']); ?></div>
                    </div>
                </div>
            </div>
        <?php if((int)$result['contact_type']>2){ ?>
            <div id="invoice" class="tab-pane">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <i class="icon-user panel-head-icon"></i>
                            <span class="panel-title-text"><?php echo $lang['common']['text_invoices']; ?></span>
                        </div>
                        <div class="panel-action">

                        </div>  
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $lang['contact']['text_company']; ?></th>
                                        <th><?php echo $lang['contact']['text_amount']; ?></th>
                                        <th><?php echo $lang['contact']['text_balance_due']; ?></th>
                                        <th><?php echo $lang['common']['text_created_date']; ?></th>
                                        <th><?php echo $lang['common']['text_status']; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($invoices)) { foreach ($invoices as $key => $value) { ?>
                                    <tr>
                                        <td><a href="<?php echo URL.DIR_ROUTE . 'invoice/view&id=' .$value['id']; ?>" class="text-primary">INV-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                                        <td><?php echo $result['company']; ?></td>
                                        <td><?php echo $value['abbr'].' '.$value['amount']; ?></td>
                                        <td><?php echo $value['abbr'].' '.$value['due']; ?></td>
                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></td>
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
                                    <?php } } else { ?>
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
                </div>
            </div>
            <div id="quotes" class="tab-pane">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <i class="icon-user panel-head-icon"></i>
                            <span class="panel-title-text"><?php echo $lang['common']['text_quotes']; ?></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                    <?php if (!empty($quotes)) { foreach ($quotes as $key => $value) { $amount = json_decode($value['total'], true)['amount']; ?>
                                    <tr>
                                        <td><a href="<?php echo URL.DIR_ROUTE . 'invoice/view&id=' .$value['id']; ?>" class="text-primary">QTN-<?php echo str_pad($value['id'], 4, '0', STR_PAD_LEFT); ?></a></td>
                                        <td><?php echo $value['project_name']; ?></td>
                                        <td><?php echo $result['company']; ?></td>
                                        <td><?php echo $value['abbr'].' '.$amount; ?></td>
                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['expiry']), 'd-m-Y'); ?></td>
                                        <td><i class="far fa-clock mr-2 text-muted"></i><?php echo date_format(date_create($value['date']), 'd-m-Y'); ?></td>
                                    </tr>
                                    <?php } } else { ?>
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
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- Send Email Modal -->
<div id="contactMail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['contact']['text_send_mail']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo URL.DIR_ROUTE .'contact/sentmail';?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="col-form-label"><?php echo $lang['contact']['text_to']; ?></label>
                            <input type="text" class="form-control" value="<?php echo $result['email'] ?>" placeholder="<?php echo $lang['contact']['text_to']; ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label"><?php echo $lang['contact']['text_bcc']; ?></label>
                            <input type="email" class="form-control" name="mail[bcc]" value="" placeholder="<?php echo $lang['contact']['text_bcc']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['contact']['text_subject']; ?></label>
                        <input type="text" class="form-control" name="mail[subject]" value="Invoice Reminder" placeholder="<?php echo $lang['contact']['text_subject']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['contact']['text_message']; ?></label>
                        <textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['contact']['text_message']; ?>"></textarea>
                    </div>
                    <input type="hidden" name="mail[contact]" value="<?php echo $result['id']; ?>">
                    <input type="hidden" name="mail[to]" value="<?php echo $result['email']; ?>">
                    <input type="hidden" name="mail[name]" value="<?php echo $result['company']; ?>">
                    <input type="hidden" name="_token" value="<?php echo $token; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit"><?php echo $lang['contact']['text_send']; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- include summernote css/js-->
<link href="public/css/summernote-bs4.css" rel="stylesheet">
<script type="text/javascript" src="public/js/summernote-bs4.min.js"></script>
<script type="text/javascript" src="public/js/custom.summernote.js"></script>
<script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      });
    </script>
<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>