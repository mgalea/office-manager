<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#supplier').show();
    $('#supplier-li').addClass('active');
</script>
<div class="row">
    <?php if (isset($result['name'])) { ?>
        <div class="col-sm-12 col-md-6">

            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="far fa-building panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $result['name']; ?></span>
                    </div>
                    <div class="panel-action">
                        <a href="<?php echo URL . DIR_ROUTE . 'suppliers'; ?>" class="btn btn-white btn-icon" data-toggle="tooltip" title="Back to List"><i class="fa fa-reply"></i></a>

                    </div>
                </div>

                <div class="panel-body">

                    <?php if (!empty($result['address']['address1']  . $result['address']['address2'] . $result['address']['city'] .  $result['address']['country'])) { ?>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-500 text-warning text-green font-20 m-0"><?php echo $lang['common']['text_address']; ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['address1'] . ', ' . $result['address']['address2']; ?></p>
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['city'] . ', ' . $result['address']['state'] . ', '; ?></p>
                                <p class="mb-1 d-inline-block"><?php echo $result['address']['country']; ?></p>
                                <p class="mb-1"><span class="font-500 text-warning"><?php echo $lang['company']['text_pincode'] ?> </span> : <?php echo $result['address']['pincode']; ?></p>
                                <p class="mb-1"><span class="font-500 text-warning"><?php echo $lang['company']['text_vat_no'] ?> </span> : <?php echo $result['vat_no']; ?></p>

                            </div>
                        </div>

                    <?php }

                    ?>

                    <?php if ($result['online_services'] == true) { ?>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-500 text-warning text-green font-20 m-0"><?php echo $lang['common']['text_online']; ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-1"><span class="font-500 text-warning"><?php echo $lang['common']['text_website'] ?>: </span><?php echo $result['website']  ?></p>
                                <p class="mb-1"><span class="font-500 text-warning"><?php echo $lang['common']['text_email'] ?>: </span><?php echo $result['email']  ?></p>
                            </div>
                        </div>
                    <?php }
                    if (!empty($result['phone'])) { ?>
                        <p class="mb-1"><span class="font-500 text-warning text-warning"><?php echo $lang['common']['text_phone_number'] ?>: </span><?php echo $result['phone']; ?>
                        <?php } ?>

                        <?php
                        if (!empty($documents)) { ?>
                        <div class="row">
                            <div class='col-12'>
                                <h5 class="font-500 text-warning font-20 text-green mt-4"><?php echo $lang['company']['text_documents']; ?></h5>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-12'>
                                <div class="attached-files">
                                    <?php
                                    foreach ($documents as $key => $value) {
                                        $file_ext = pathinfo($value['file_name'], PATHINFO_EXTENSION);
                                        $file_name = pathinfo($value['file_name'], PATHINFO_FILENAME);
                                        $file_date = preg_split("/_/", $file_name);
                                        $file_date = $file_date[sizeof($file_date) - 1];
                                        $file_date = substr($file_date, 0, 10);
                                        $file_date = new DateTime("@$file_date");
                                        if (strlen($file_name) > 20) {
                                            $show_name = substr($file_name, 0, 20) . '...';
                                        } else {
                                            $show_name = $file_name;
                                        }

                                        if ($file_ext == "pdf") { ?>

                                            <div class="attached-files-block">
                                                <a href="public/uploads/<?php echo $value['file_name']; ?>" data-toggle="tooltip" title="<?php echo $file_name; ?>" class="open-pdf"><i class="fa fa-file-pdf"></i>
                                                    <br><span class="filename"><?php echo $show_name; ?></span><br><span class="filename"><?php echo date_format($file_date, "d-M-Y"); ?></span> </a>
                                                <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                            </div>

                                        <?php } else { ?>

                                            <div class="attached-files-block">
                                                <a href="public/uploads/<?php echo $value['file_name']; ?>" data-fancybox="gallery"><img src="public/uploads/<?php echo $value['file_name']; ?>" alt=""><span class="filename"><?php echo $value['file_name']; ?></span></a>
                                                <input type="hidden" name="document[attached][]" value="<?php echo $value['file_name']; ?>">
                                            </div>

                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                    <?php
                    if (!empty($description)) { ?>
                        <div class="row">
                            <div class='col-12'>
                                <h5 class="font-500 text-warning font-20 text-green mt-4"><?php echo $lang['company']['text_description']; ?></h5>
                            </div>
                        </div>
                        <div class='col-12'>
                            <div><?php echo '<textarea width="100%" rows="8" class="bg-light">' . html_entity_decode($result['description']) . '</textarea>'; ?></div>
                        </div>
                    <?php }  ?>
                </div><?php }  ?>

            </div>
        </div>


        <!-- Send Email Modal -->
        <div id="contactMail" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $lang['company']['text_send_mail']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="<?php echo URL . DIR_ROUTE . 'company/sentmail'; ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="col-form-label"><?php echo $lang['company']['text_to']; ?></label>
                                    <input type="text" class="form-control" value="<?php echo $result['email'] ?>" placeholder="<?php echo $lang['company']['text_to']; ?>" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="col-form-label"><?php echo $lang['company']['text_bcc']; ?></label>
                                    <input type="email" class="form-control" name="mail[bcc]" value="" placeholder="<?php echo $lang['company']['text_bcc']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['company']['text_subject']; ?></label>
                                <input type="text" class="form-control" name="mail[subject]" value="Invoice Reminder" placeholder="<?php echo $lang['company']['text_subject']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['company']['text_message']; ?></label>
                                <textarea name="mail[message]" class="summernote1" placeholder="<?php echo $lang['company']['text_message']; ?>"></textarea>
                            </div>
                            <input type="hidden" name="mail[contact]" value="<?php echo $result['id']; ?>">
                            <input type="hidden" name="mail[to]" value="<?php echo $result['email']; ?>">
                            <input type="hidden" name="mail[name]" value="<?php //echo $result['contact']; 
                                                                            ?>">
                            <input type="hidden" name="_token" value="<?php echo $token; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit"><?php echo $lang['company']['text_send']; ?></button>
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