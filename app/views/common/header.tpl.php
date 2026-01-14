<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Office Manager | Admin Panel</title>
    <base href="<?php echo URL; ?>">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <!-- Font Faimily -->
    <link href="https://fonts.googleapis.com/css?family=Dosis:500,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include css files -->
    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="css/morris.css" />
    <link rel="stylesheet" href="css/dropzone.min.css">
    <link rel="stylesheet" href="css/perfect-scrollbar.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/chosen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include js files -->
    <script type="text/javascript" src="js/moment.min.js"></script>

    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/daterangepicker.js"></script>
    <script type="text/javascript" src="js/datatables.min.js"></script>
    <script type="text/javascript" src="js/dropzone.min.js"></script>
    <script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/admin.js"></script>
    <script type="text/javascript" src="js/chosen.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>


<body>
    <!-- Media Modal -->
    <div id="media-upload" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="media-hdr">
                        <p><?php echo $lang['common']['text_media']; ?></p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="media-upload-container">
                        <form action="<?php echo URL . DIR_ROUTE; ?>upload" class="dropzone" id="media-dropzone" method="post" enctype="multipart/form-data">
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                        </form>
                    </div>
                    <div class="media-all">
                        <?php $media_array = [];
                        $allowed =  array('gif', 'png', 'jpg');
                        $images = scandir(DIR . "uploads", 1);
                        foreach ($images as $value) {
                            $ext = pathinfo($value, PATHINFO_EXTENSION);
                            if (in_array($ext, $allowed)) {
                                $media_array[] = $value;
                            }
                        }
                        $media_array = json_encode($media_array); ?>
                        <input type="hidden" name="media_all" value="<?php echo htmlspecialchars($media_array, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="absolute-path" value="<?php echo URL . DIR_ROUTE; ?>">
                        <input type="hidden" name="absolute-upload-path" value="<?php echo htmlspecialchars(URL . 'uploads/', ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="text_language" value="<?php echo $lang['common']['text_drop_message']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-background"></div>
    <div class="wrapper<?php if (!empty($theme['layout'])) {
                            echo ' ' . $theme['layout'];
                        } ?>">
        <!-- Main Container -->
        <div id="main-wrapper" class="<?php if (!empty($theme['layout_fixed'])) {
                                            echo ' ' . $theme['layout_fixed'];
                                        }
                                        if (!empty($theme['side_menu'])) {
                                            echo ' menu-' . $theme['side_menu'];
                                        }
                                        if (!empty($theme['layout_menu'])) {
                                            echo ' ' . $theme['layout_menu'];
                                        } ?>">
            <!-- Vertical Menu -->

            <?php include(DIR . 'app/views/common/partials/menu_vertical.tpl.php'); ?>

            <!-- Horzontal Menu -->
            <?php include(DIR . 'app/views/common/partials/menu_horizontal.tpl.php'); ?>
            <!-- Main Page Wrapper -->
            <div class="page-wrapper">
                <div class="page-body">