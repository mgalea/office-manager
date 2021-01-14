<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#person').show();
    $('#person-li').addClass('active');
</script>
<div class="row">
    <div class="col-lg-4">
        <div class="contact-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="user-details text-center">
                        <h2 class="text-warning"><?php echo $result['salutation'] . ' ' . $result['firstname'] . ' ' . $result['lastname']; ?></h2>
                        <p class="font-16 mb-1 font-500"><?php echo $result['company']; ?></p>
                        <p class="mb-1"><i class="icon-envelope"></i> <?php echo $result['email']; ?></p>
                        <p class="mb-1"><i class="icon-screen-smartphone"></i> <?php echo $result['phone']; ?></p>
                        <ul class="nav flex-column vnav-tabs text-left">
                            <li class="nav-item">
                                <a href="#persons" class="nav-link active" data-toggle="tab"><i class="icon-user"></i> <span><?php echo $lang['common']['text_contact']; ?></span></a>
                            </li>

                            <li class="nav-item">
                                <a data-toggle="modal" data-target="#contactMail"><i class="icon-paper-plane"></i> <span><?php echo $lang['person']['text_send_mail']; ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL . DIR_ROUTE . 'person/edit&id=' . $result['id']; ?>"><i class="icon-pencil"></i> <span><?php echo $lang['common']['text_edit']; ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL . DIR_ROUTE . 'persons'; ?>"><i class="fa fa-reply"> </i><span><?php echo $lang['common']['text_back_to_list']; ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">

    </div>
</div>
<!-- Send Email Modal -->
<div id="personMail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $lang['person']['text_send_mail']; ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo URL . DIR_ROUTE . 'person/sentmail'; ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="col-form-label"><?php echo $lang['person']['text_to']; ?></label>
                            <input type="text" class="form-control" value="<?php echo $result['email'] ?>" placeholder="<?php echo $lang['person']['text_to']; ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label"><?php echo $lang['person']['text_bcc']; ?></label>
                            <input type="email" class="form-control" name="mail[bcc]" value="" placeholder="<?php echo $lang['person']['text_bcc']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['person']['text_subject']; ?></label>
                        <input type="text" class="form-control" name="mail[subject]" value="Invoice Reminder" placeholder="<?php echo $lang['person']['text_subject']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['person']['text_message']; ?></label>
                        <textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['person']['text_message']; ?>"></textarea>
                    </div>
                    <input type="hidden" name="mail[contact]" value="<?php echo $result['id']; ?>">
                    <input type="hidden" name="mail[to]" value="<?php echo $result['email']; ?>">
                    <input type="hidden" name="mail[name]" value="<?php echo $result['company']; ?>">
                    <input type="hidden" name="_token" value="<?php echo $token; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit"><?php echo $lang['person']['text_send']; ?></button>
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
        placeholder: 'Hello',
        tabsize: 2,
        height: 300
    });
</script>

<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>