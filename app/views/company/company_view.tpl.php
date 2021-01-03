<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#contact').show();
    $('#contact-li').addClass('active');
</script>
<div class="row">
    <div class="col-lg-4">
        <div class="contact-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="user-details text-center">
                        <h2 class="text-warning"><?php echo $result['name']; ?></h2>
                        <p class="mb-1"><i class="icon-envelope"></i><br> <?php echo $result['address']['address1'] . ', ' . $result['address']['address2'] . ', ' . $result['address']['city'] . ', ' . $result['address']['pin'] . ', ' . $result['address']['country']; ?></p>
                        <p><i class="icon-globe"><br></i> <?php echo $result['website']; ?></p>
                        <ul class="nav flex-column vnav-tabs text-left">
                            <li class="nav-item">
                                <a href="#contacts" class="nav-link active" data-toggle="tab"><i class="icon-user"></i> <span><?php echo $lang['common']['text_contact']; ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL . DIR_ROUTE . 'contact/edit&id=' . $result['id']; ?>"><i class="icon-pencil"></i> <span><?php echo $lang['common']['text_edit']; ?></span></a>
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

        <div class="panel panel-default">
            <div class="panel-head">
                <div class="panel-title">
                    <i class="far fa-building panel-head-icon"></i>
                    <span class="panel-title-text"><?php echo $result['name']; ?></span>
                </div>
                <div class="panel-action">
                    <a href="<?php echo URL . DIR_ROUTE . 'companies'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>

                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="font-500 text-green font-20 m-0"><?php echo $lang['common']['text_address']; ?></h5>
                    </div>
                    <div class="col-12">
                        <p class="mb-1 d-inline-block"><?php echo $result['address']['address1'] . ', ' . $result['address']['address2']; ?></p>
                        <p class="mb-1 d-inline-block"><?php echo $result['address']['city'] . ', ' . $result['address']['state'] . ', '; ?></p>
                        <p class="mb-1 d-inline-block"><?php echo $result['address']['country']; ?></p>
                        <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_pincode'] ?> </span> : <?php echo $result['address']['pin']; ?></p>
                        <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_company_id'] ?> </span> : <?php echo $result['reg_no']; ?></p>
                        <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_vat_no'] ?> </span> : <?php echo $result['vat_no']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <h5 class="font-500 font-20 text-green mt-4"><?php echo $lang['company']['text_documents']; ?></h5>
                    </div>
                <div class="attached-files">
                    <?php if (!empty($documents)) {

                        foreach ($documents as $key => $value) {
                            $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                            if ($file_ext == "pdf") { ?>
                                <div class="row">
                                    <div class="attached-files-block">
                                        <a href="public/uploads/<?php echo $value['file_name']; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i><span class="filename"><?php echo $value['file_name']; ?></span></a>
                                        <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="attached-files-block">
                                        <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""><span class="filename"><?php echo $value['file_name']; ?></span></a>
                                        <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                    </div>
                                </div>
                    <?php }
                        }
                    } ?>
                </div>
                <div class="row">
                    <h5 class="font-500 font-20 text-green mt-4"><?php echo $lang['company']['text_description']; ?></h5>
                    </div>
                    <div ><?php echo html_entity_decode($result['description']); ?></div>
    

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
                    <form action="<?php echo URL . DIR_ROUTE . 'contact/sentmail'; ?>" method="post" enctype="multipart/form-data">
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
                placeholder: 'Hello',
                tabsize: 2,
                height: 300
            });
        </script>

        <!-- Footer -->
        <?php include(DIR . 'app/views/common/footer.tpl.php'); ?>