<!-- Start  Vertical Menu -->
<div class="menu-wrapper">
    <div class="menu">
        <ul>
            <li class="menu-title"><?php echo $lang['common']['text_main']; ?></li>
            <li id="dashboard-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>dashboard"><i class="icon-screen-desktop"></i><span><?php echo $lang['common']['text_dashboard']; ?></span></a>
            </li>
            <li id="supplier-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>suppliers"><i class="icon-social-dropbox"></i><span><?php echo $lang['common']['text_suppliers']; ?></span></a>
            </li>
            <li id="contact-li" class="has-sub">
                <a><i class="far fa-address-book"></i><span><?php echo $lang['common']['text_contacts']; ?></span><i class="arrow rotate"></i></a>
                <ul id="contact" class="sub-menu">
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>persons"><span><?php echo $lang['common']['text_by'] . ' ' . $lang['common']['text_name']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>companies"><span><?php echo $lang['common']['text_by'] . ' ' . $lang['common']['text_company']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>clients"><span><?php echo $lang['common']['text_by'] . ' ' . $lang['common']['text_clients'] . ' ' . $lang['common']['text_portal']; ?></span></a>
                    </li>
                </ul>
            </li>
            <li id="company-li" class="has-sub">
                <a><i class="far fa-building"></i><span><?php echo $lang['common']['text_corporate_info']; ?></span><i class="arrow rotate"></i></a>
                <ul id="company" class="sub-menu">
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>info"><span><?php echo $lang['common']['text_organisation_info']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>subsidiaries"><span><?php echo $lang['common']['text_subsidiaries']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>bank_accounts"><span><?php echo $lang['common']['text_bank_accounts']; ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo URL . DIR_ROUTE; ?>employees"><span><?php echo $lang['common']['text_employees'] ?></span></a>
                    </li>
                </ul>
            </li>
            <li class="menu-title"><?php echo $lang['common']['text_others']; ?></li>
            <li id="expense-li" class="has-sub">
                <a><i class="icon-handbag"></i><span><?php echo $lang['common']['text_expenses']; ?></span><i class="arrow rotate"></i></a>
                <ul id="expense" class="sub-menu">
                    <li><a href="<?php echo URL . DIR_ROUTE; ?>expenses"><span><?php echo $lang['common']['text_all_expenses']; ?></span></a></li>
                    <li><a href="<?php echo URL . DIR_ROUTE; ?>expenses/local"><span><?php echo $lang['common']['text_local_expenses']; ?></span></a></li>
                    <li><a href="<?php echo URL . DIR_ROUTE; ?>expenses/foreign"><span><?php echo $lang['common']['text_foreign_expenses']; ?></span></a></li>
                </ul>
            </li>
            <li id="calendar-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>calendar"><i class="icon-event"></i><span><?php echo $lang['common']['text_calendar']; ?></span></a>
            </li>
            <li id="mail-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>mail"><i class="icon-envelope"></i><span><?php echo $lang['common']['text_send_email']; ?></span></a>
            </li>
            <li id="note-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>notes"><i class="icon-notebook"></i><span><?php echo $lang['common']['text_notes']; ?></span></a>
            </li>
            <li id="lead-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>leads"><i class="fas fa-bullhorn"></i><span><?php echo $lang['common']['text_leads']; ?></span></a>
            </li>
            <li id="project-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>projects"><i class="icon-layers"></i><span><?php echo $lang['common']['text_projects']; ?></span></a>
            </li>
            <li id="project-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>inventory"><i class="icon-layers"></i><span><?php echo $lang['common']['text_inventory']; ?></span></a>
            </li>
            <li class="menu-title"><?php echo $lang['common']['text_sales']; ?></li>
            <li id="quotes-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>quotes"><i class="icon-calculator"></i><span><?php echo $lang['common']['text_quotes'] . '/' . $lang['common']['text_estimates']; ?></span></a>
            </li>
            <li id="items-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>items"><i class="icon-doc"></i><span><?php echo $lang['common']['text_items']; ?></span></a>
            </li>
            <li id="invoice-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>invoices"><i class="icon-doc"></i><span><?php echo $lang['common']['text_invoices']; ?></span></a>
            </li>
            <li id="rinvoice-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>recurring"><i class="icon-docs"></i><span><?php echo $lang['common']['text_recurring_invoices']; ?></span></a>
            </li>
            <li class="menu-title"><?php echo $lang['common']['text_support']; ?></li>
            <li id="ticket-li">
                <a href="<?php echo URL . DIR_ROUTE; ?>tickets"><i class="fas fa-ticket-alt"></i><span><?php echo $lang['common']['text_tickets']; ?></span></a>
            </li>
            <?php if ($user['role'] == 'Admin') { ?>
                <li class="menu-title"><?php echo $lang['common']['text_domains']; ?></li>
                <li id="domain-li">
                    <a href="<?php echo URL . DIR_ROUTE; ?>domains"><i class="fas fa-server"></i><span><?php echo $lang['common']['text_domains']; ?></span></a>
                </li>

                <li class="menu-title"><?php echo $lang['common']['text_users']; ?></li>
                <li id="user-li" class="has-sub">
                    <a><i class="icon-people"></i><span><?php echo $lang['common']['text_users']; ?></span><i class="arrow rotate"></i></a>
                    <ul id="user" class="sub-menu">
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>user"><span><?php echo $lang['common']['text_users']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>role"><span><?php echo $lang['common']['text_user_role']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>subscriber"><span><?php echo $lang['common']['text_subscribers']; ?></span></a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title"><?php echo $lang['common']['text_utilities']; ?></li>
                <li id="utilities-li" class="has-sub">
                    <a><i class="icon-puzzle"></i><span><?php echo $lang['common']['text_utilities']; ?></span><i class="arrow rotate"></i></a>
                    <ul id="utilities" class="sub-menu">
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>emaillog"><span><?php echo $lang['common']['text_email_log']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>cronlog"><span><?php echo $lang['common']['text_cron_log']; ?></span></a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title"><?php echo $lang['common']['text_settings']; ?></li>
                <li id="setting-li" class="has-sub">
                    <a><i class="icon-settings"></i><span><?php echo $lang['common']['text_settings']; ?></span><i class="arrow rotate"></i></a>
                    <ul id="setting" class="sub-menu">
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>info"><span><?php echo $lang['common']['text_organisation_info']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>taxes"><span><?php echo $lang['common']['text_finance']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>emailtemplate&for=newticket"><span><?php echo $lang['common']['text_email_template']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>setting&page=emailsetting"><span><?php echo $lang['common']['text_email_settings']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>items"><span><?php echo $lang['common']['text_items']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>departments"><span><?php echo $lang['common']['text_departments']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>documenttype"><span><?php echo $lang['common']['text_document_type']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>documentformat"><span><?php echo $lang['common']['text_document_format']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>suppliestype"><span><?php echo $lang['common']['text_supplies_types']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>contacttype"><span><?php echo $lang['common']['text_contact_types']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>expensetype"><span><?php echo $lang['common']['text_expense_types']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>inventorytype"><span><?php echo $lang['common']['text_inventory_types']; ?></span></a>
                        </li>
                        <li>
                            <a href="<?php echo URL . DIR_ROUTE; ?>setting&page=recurring"><span><?php echo $lang['common']['text_cron_setting']; ?></span></a>
                        </li>
                        <li>
                            <span>
                                <p></p>
                            </span>
                        </li>
                    </ul>
                </li>
                <li id="customization-li">
                    <a href="<?php echo URL . DIR_ROUTE; ?>customization"><i class="icon-target"></i><span><?php echo $lang['common']['text_theme_customization']; ?></span></a>
                </li>
            <?php } ?>
            <li id="none-li">
                <span class="placeholder"> </span>
                <span class="placeholder"> </span>

                <span class="placeholder"> </span>


            </li>
        </ul>
    </div>
    <!-- End Vertical Menu -->
</div>