<!-- Start  Horizontal Menu -->
            <div class="page-hdr<?php if (!empty($theme['header_color'])) {
                                    echo ' ' . $theme['header_color'];
                                } ?>">
                <div class="row align-items-center">
                    <div class="col-4 col-md-7 page-hdr-left">
                        <div id="logo">
                            <div class="tbl-cell logo-icon">
                                <a href="#"><img src="images/icon.png" alt=""></a>
                            </div>
                            <div class="tbl-cell logo">
                                <a href="<?php echo URL . DIR_ROUTE; ?>dashboard"><img src="images/icon.png" alt=""><img src="images/logo-color.png"></a>
                            </div>
                        </div>
                        <div class="page-menu menu-icon">
                            <a class="animated menu-close"><i class="fa fa-angle-left"></i></a>
                        </div>
                        <div class="page-menu page-fullscreen">
                            <a><i class="fas fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="col-8 col-md-5 page-hdr-right">
                        <div class="page-menu open-left-menu">
                            <a href="#"><i class="icon-menu"></i></a>
                        </div>
                        <?php if (isset($recents) && !empty($recents)) { ?>
                            <div class="page-menu menu-dropdown-wrapper menu-recent">
                                <a><i class="icon-bell"></i><span></span></a>
                                <div class="menu-dropdown recent-dropdown menu-dropdown-right menu-dropdown-push-right">
                                    <div class="arrow arrow-right"></div>
                                    <div class="menu-dropdown-inner">
                                        <div class="menu-dropdown-head"><?php echo $lang['dashboard']['text_recently_added']; ?></div>
                                        <div class="menu-dropdown-body pl-1 pr-3">
                                            <ul class="nav nav-tabs font-12 nav-tabs-line nav-tabs-line-primary">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#recent-contact" data-toggle="tab"><?php echo $lang['common']['text_contacts']; ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#recent-expenses" data-toggle="tab"><?php echo $lang['common']['text_expenses']; ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#recent-invoices" data-toggle="tab"><?php echo $lang['common']['text_invoices']; ?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#recent-quotes" data-toggle="tab"><?php echo $lang['common']['text_quotes']; ?></a>
                                                </li>
                                            </ul>
                                            <div class="tab-content m-0 pt-2 pb-2">
                                                <div class="tab-pane active" id="recent-contact">
                                                    <ul class="timeline">
                                                        <?php if (!empty($recents['contacts'])) {
                                                            foreach ($recents['contacts'] as $key => $value) { ?>
                                                                <li>
                                                                    <div class="time"><small><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></small></div>
                                                                    <a href="<?php echo URL . DIR_ROUTE . 'contact/edit&id=' . $value['id']; ?>" target="_blank" class="timeline-container">
                                                                        <div class="arrow"></div>
                                                                        <div class="description"><?php echo $value['company']; ?></div>
                                                                        <div class="author"><?php echo $value['name']; ?></div>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li>
                                                                <div class="time"><small>---</small></div>
                                                                <a class="timeline-container">
                                                                    <div class="arrow"></div>
                                                                    <div class="description"><?php echo $lang['common']['text_no_data_found']; ?></div>
                                                                    <div class="author"></div>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="recent-quotes">
                                                    <ul class="timeline">
                                                        <?php if (!empty($recents['quotes'])) {
                                                            foreach ($recents['quotes'] as $key => $value) { ?>
                                                                <li>
                                                                    <div class="time"><small><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></small></div>
                                                                    <a href="<?php echo URL . DIR_ROUTE . 'quote/view&id=' . $value['id']; ?>" target="_blank" class="timeline-container">
                                                                        <div class="arrow"></div>
                                                                        <div class="description"><?php echo $value['company']; ?></div>
                                                                        <div class="author"><?php echo $value['project_name']; ?></div>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li>
                                                                <div class="time"><small>---</small></div>
                                                                <a class="timeline-container">
                                                                    <div class="arrow"></div>
                                                                    <div class="description"><?php echo $lang['common']['text_no_data_found']; ?></div>
                                                                    <div class="author"></div>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="recent-invoices">
                                                    <ul class="timeline">
                                                        <?php if (!empty($recents['invoices'])) {
                                                            foreach ($recents['invoices'] as $key => $value) { ?>
                                                                <li>
                                                                    <div class="time"><small><?php echo date_format(date_create($value['inv_date']), 'd-m-Y'); ?></small></div>
                                                                    <a href="<?php echo URL . DIR_ROUTE . 'invoice/view&id=' . $value['id']; ?>" target="_blank" class="timeline-container">
                                                                        <div class="arrow"></div>
                                                                        <div class="description"><?php echo $value['company']; ?></div>
                                                                        <div class="author"><?php echo $value['abbr'] . $value['amount']; ?></div>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li>
                                                                <div class="time"><small>---</small></div>
                                                                <a class="timeline-container">
                                                                    <div class="arrow"></div>
                                                                    <div class="description"><?php echo $lang['common']['text_no_data_found']; ?></div>
                                                                    <div class="author"></div>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="recent-expenses">
                                                    <ul class="timeline">
                                                        <?php if (!empty($recents['expenses'])) {
                                                            foreach ($recents['expenses'] as $key => $value) { ?>
                                                                <li>
                                                                    <div class="time"><small><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></small></div>
                                                                    <a href="<?php echo URL . DIR_ROUTE . 'expense/edit&id=' . $value['id']; ?>" target="_blank" class="timeline-container">
                                                                        <div class="arrow"></div>
                                                                        <div class="description"><?php echo $value['purchase_by']; ?></div>
                                                                        <div class="author"><?php echo $value['abbr'] . $value['purchase_amount']; ?></div>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li>
                                                                <div class="time"><small>---</small></div>
                                                                <a class="timeline-container">
                                                                    <div class="arrow"></div>
                                                                    <div class="description"><?php echo $lang['common']['text_no_data_found']; ?></div>
                                                                    <div class="author"></div>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="page-menu menu-dropdown-wrapper">
                            <a><i class="icon-settings"></i><span></span></a>
                            <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                                <div class="arrow arrow-right"></div>
                                <div class="menu-dropdown-inner">
                                    <div class="menu-dropdown-head"><?php echo $lang['common']['text_settings']; ?></div>
                                    <div class="menu-dropdown-body">
                                        <ul class="menu-nav">
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'info'; ?>"><i class="icon-share-alt"></i><span><?php echo $lang['common']['text_organisation_info']; ?></span></a></li>
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'taxes'; ?>"><i class="icon-credit-card"></i><span><?php echo $lang['common']['text_finance']; ?></span></a></li>
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'items'; ?>"><i class="icon-list"></i><span><?php echo $lang['common']['text_items']; ?></span></a></li>
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'expensetype'; ?>"><i class="icon-settings"></i><span><?php echo $lang['common']['text_expense_types']; ?></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="menu-dropdown-footer">
                                        <a href="http://www.rnggaming.com/" class="btn btn-outline btn-primary btn-pill btn-outline-2x font-12 btn-sm" target="_blank"><?php echo $lang['common']['text_support']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-menu menu-dropdown-wrapper menu-quick-links">
                            <a><i class="icon-grid"></i></a>
                            <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                                <div class="arrow arrow-right"></div>
                                <div class="menu-dropdown-inner">
                                    <div class="menu-dropdown-head"><?php echo $lang['common']['text_quick_links']; ?></div>
                                    <div class="menu-dropdown-body p-0">
                                        <div class="row m-0 box">
                                            <div class="col-6 p-0 box">
                                                <a href="<?php echo URL . DIR_ROUTE . 'persons'; ?>">
                                                    <i class="icon-user"></i>
                                                    <span><?php echo $lang['common']['text_list'] . ' ' . $lang['common']['text_contacts']; ?></span>
                                                </a>
                                            </div>
                                            <div class="col-6 p-0 box">
                                                <a href="<?php echo URL . DIR_ROUTE . 'invoice/add'; ?>">
                                                    <i class="icon-docs"></i>
                                                    <span><?php echo $lang['common']['text_new'] . ' ' . $lang['common']['text_invoice']; ?></span>
                                                </a>
                                            </div>
                                            <div class="col-6 p-0 box">
                                                <a href="<?php echo URL . DIR_ROUTE . 'quote/add'; ?>">
                                                    <i class="icon-calculator"></i>
                                                    <span><?php echo $lang['common']['text_new'] . ' ' . $lang['common']['text_quote']; ?></span>
                                                </a>
                                            </div>
                                            <div class="col-6 p-0 box">
                                                <a href="<?php echo URL . DIR_ROUTE . 'expense/add'; ?>">
                                                    <i class="icon-handbag"></i>
                                                    <span><?php echo $lang['common']['text_new'] . ' ' . $lang['common']['text_expense']; ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-menu menu-dropdown-wrapper menu-quick-links ">
                            <a><i class="icon-phone"></i></a>
                            <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                                <div class="arrow arrow-right"></div>
                                <div class="menu-dropdown-inner">
                                    <div class="menu-dropdown-head"><?php echo $lang['common']['text_emergency'] . ' ' . $lang['common']['text_contacts']; ?></div>
                                    <div class="menu-dropdown-body p-0">
                                        <div class="row m-0 box">
                                            <div class="col-12 p-0 box">
                                                <a href="https://pulizija.gov.mt/en/services/Pages/Emergency-Services.aspx">
                                                    <i class="fa fa-first-aid"></i>
                                                    <h2 class="phones">Emergency 112</h2>
                                                </a>
                                            </div>
                                            <div class="col-12 p-0 box">
                                                <a href="https://www.maltalifesciencespark.com/">
                                                    <i class="fa fa-shield-alt"></i>
                                                    <h3 class="phones">Security: 22477605</h3>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-menu menu-dropdown-wrapper menu-user">
                            <a><i class="icon-user-following"></i></a>
                            <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                                <div class="arrow arrow-right"></div>
                                <div class="menu-dropdown-inner">
                                    <div class="menu-dropdown-head pb-3">
                                        <div class="tbl-cell">
                                            <!-- <img src="images/author.jpg" alt=""> -->
                                            <i class="fa fa-user-circle"></i>
                                        </div>
                                        <div class="tbl-cell pl-2 text-left">
                                            <p class="m-0 font-18"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></p>
                                            <p class="m-0 font-14"><?php echo $user['role']; ?></p>
                                        </div>
                                    </div>
                                    <div class="menu-dropdown-body">
                                        <ul class="menu-nav">
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'calendar'; ?>"><i class="icon-event"></i><span><?php echo $lang['common']['text_my_events']; ?></span></a></li>
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'notes'; ?>"><i class="icon-notebook"></i><span><?php echo $lang['common']['text_my_notes']; ?></span></a></li>
                                            <li><a href="<?php echo URL . DIR_ROUTE . 'profile'; ?>"><i class="icon-user"></i><span><?php echo $lang['common']['text_my_profile']; ?></span></a></li>
                                            <li><a href="<?php echo URL_CLIENTS; ?>"><i class="icon-globe"></i><span><?php echo $lang['common']['text_client'] . ' ' . $lang['common']['text_portal']; ?></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="menu-dropdown-footer text-right">
                                        <a href="<?php echo URL . DIR_ROUTE . 'logout'; ?>" class="btn btn-outline btn-primary btn-pill btn-outline-2x font-12 btn-sm"><?php echo $lang['common']['text_logout']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Horizontal Menu -->
