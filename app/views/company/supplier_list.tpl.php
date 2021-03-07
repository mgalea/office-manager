<?php include(DIR . 'app/views/common/header.tpl.php'); ?>

<script>
    $('#supplier').show();
    $('#supplier-li').addClass('active');
</script>

<!-- User list page start -->
<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-head">
                    <div class="panel-title">
                        <i class="far fa-address-book panel-head-icon"></i>
                        <span class="panel-title-text"><?php echo $page_title; ?></span>
                    </div>
                </div>
                <div class="panel-wrapper">
                    <div class="table-container">
                        <table class="table table-dark table-striped datatable-table" width="100%">
                            <thead>
                                <tr class="table-heading">
                                    <th><?php echo $lang['company']['text_company']; ?></th>
                                    <th><?php echo $lang['company']['text_brand']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result) {
                                    foreach ($result as $key => $value) { ?>
                                        <tr>
                                            <td><a href="<?php echo URL . DIR_ROUTE . 'supplier/view&id=' . $value['id']; ?>"><?php echo $value['name']; ?></td>
                                            <td><a href="<?php echo URL . DIR_ROUTE . 'supplier/view&id=' . $value['id']; ?>"><?php echo $value['short_name']; ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($result['name'])) { ?>
            <div class="col-sm-12 col-md-6">

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

                        <?php if (!empty($result['address']['address1']  . $result['address']['address2'] . $result['address']['city'] .  $result['address']['country'])) { ?>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="font-500 text-green font-20 m-0"><?php echo $lang['common']['text_address']; ?></h5>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1 d-inline-block"><?php echo $result['address']['address1'] . ', ' . $result['address']['address2']; ?></p>
                                    <p class="mb-1 d-inline-block"><?php echo $result['address']['city'] . ', ' . $result['address']['state'] . ', '; ?></p>
                                    <p class="mb-1 d-inline-block"><?php echo $result['address']['country']; ?></p>
                                    <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_pincode'] ?> </span> : <?php echo $result['address']['pincode']; ?></p>
                                    <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_company_id'] ?> </span> : <?php echo $result['reg_no']; ?></p>
                                    <p class="mb-1"><span class="font-500"><?php echo $lang['company']['text_vat_no'] ?> </span> : <?php echo $result['vat_no']; ?></p>
                                </div>
                            </div>


                            <?php if ($result['online_services'] == true) { ?>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="font-500 text-green font-20 m-0"><?php echo $lang['common']['text_online']; ?></h5>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <h5 class="font-500 font-20 text-green mt-4"><?php echo $lang['company']['text_documents']; ?></h5>
                            </div>
                            <div class="attached-files">
                                <?php if (!empty($documents)) {
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
                                    }
                                } ?>
                            </div>
                            <div class="row">
                                <h5 class="font-500 font-20 text-green mt-4"><?php echo $lang['company']['text_description']; ?></h5>
                            </div>
                            <div><?php echo html_entity_decode($result['description']); ?></div>

                    </div><?php }  ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>