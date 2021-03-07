<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#mail-li').addClass('active');
</script>
<!-- User list page start -->
<div class="content">

    <div class="col-lg-6 panel panel-default">
        <div class="panel-head">
            <div class="panel-title">
                <i class="icon-note panel-head-icon"></i>
                <span class="panel-title-text"><?php echo $page_title; ?></span>
            </div>
            <div class="panel-action">
            </div>
        </div>
        <div class="panel-wrapper">
            <div class="panel-body">
                <div class="row">

                    <form action="<?php echo URL . DIR_ROUTE . 'mail/sendmail'; ?>" method="post" enctype="multipart/form-data">
                        <div class="panel-body">

                                <div class="form-group customer-search">
                                    <label class="col-form-label"><?php echo $lang['person']['text_to']; ?></label>

                                    <select class="form-control selectpicker" data-width="100%" data-live-search="true" name="mail[to]" >
                                        <option value=""><?php echo $lang['person']['text_to']; ?></option>
                                        <?php if (!empty($addressbook)) {
                                            foreach ($addressbook as $key => $value) { ?>
                                                <option value="<?php echo $value['email'] ?>"> 
                                                                                        <b><?php echo $value['firstname'].' '.$value['lastname'].'</b> ('.$value['company'].')'  ?></option>
                                        <?php }
                                        } ?>
                                    </select>

                                <div class="form-group">
                                    <label class="col-form-label"><?php echo $lang['person']['text_bcc']; ?></label>
                                    <input type="email" class="form-control" name="mail[bcc]" value="" placeholder="<?php echo $lang['person']['text_bcc']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['person']['text_subject']; ?></label>
                                <input type="text" class="form-control" name="mail[subject]" value="" placeholder="<?php echo $lang['person']['text_subject']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['person']['text_message']; ?></label>
                                <textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['person']['text_message']; ?>"></textarea>
                            </div>

                            <input type="hidden" name="_token" value="<?php echo $token; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit"><?php echo $lang['person']['text_send']; ?></button>
                        </div>
                    </form>

                </div>
            </div>
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