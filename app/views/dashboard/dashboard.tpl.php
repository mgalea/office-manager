<?php include(DIR . 'app/views/common/header.tpl.php'); ?>
<script>
    $('#dashboard-li').addClass('active');
</script>
<!-- Moris Chart Plugin -->
<script type="text/javascript" src="public/js/raphael-min.js"></script>
<!-- Dahsboard Body -->
<div class="content">

    <div class="row">
        <div class="col-12 col-lg-9 mb-3">
            <div id="calendar"></div>
        </div>
        <div class="col-12 col-lg-3 mb-3">
            <div class="notes-block">
                <?php if (!empty($notes)) {
                    foreach ($notes as $key => $value) { ?>
                        <div class="col-md-12">
                            <div class="notes-card" style="background: <?php echo $value['background']; ?>;color: <?php echo $value['color']; ?>">
                                <div class="notes">
                                    <h2><?php echo $value['title']; ?></h2>
                                    <div class="notes-body">
                                        <?php echo html_entity_decode($value['description']); ?>
                                    </div>
                                </div>
                                <div class="notes-footer">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 text-left">
                                            <p class="font-14 mb-0"><i class="icon-calendar mr-2"></i><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="index.php?route=note/edit&id=<?php echo $value['id']; ?>"><i class="icon-pencil"></i></a>
                                            <a class="table-delete"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-12 text-center">
                        <p class="mb-0 font-18">No Note Found</p>
                    </div>

                <?php } ?>
                <div class="col-12 text-center">
                        <a href="<?php echo URL . DIR_ROUTE . 'note/add'; ?>" class="btn btn-success mt-3">Create New Note</a>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-success">
                <div class="content">
                    <h4><?php //echo $statistics['0']['total']; 
                        ?></h4> <span><?php echo $lang['common']['text_contact']; ?></span>
                </div>
                <div class="icon"><i class="icon-people"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-warning">
                <div class="content">
                    <h4><?php //echo $statistics['1']['total']; 
                        ?></h4> <span><?php echo $lang['common']['text_projects']; ?></span>
                </div>
                <div class="icon"><i class="icon-layers"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-primary">
                <div class="content">
                    <h4><?php //echo $statistics['2']['total']; 
                        ?></h4> <span><?php echo $lang['common']['text_invoices']; ?></span>
                </div>
                <div class="icon"><i class="icon-docs"></i></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-stat color-danger">
                <div class="content">
                    <h4><?php //echo $statistics['3']['total']; 
                        ?></h4> <span><?php echo $lang['common']['text_quotes']; ?></span>
                </div>
                <div class="icon"><i class="icon-envelope-letter"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Event Modal -->
<div id="event-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $lang['calendar']['text_calendar_event']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo $calendar_action; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['calendar']['text_event_title']; ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            <input type="text" class="form-control event-title" name="event[title]" value="" placeholder="<?php echo $lang['calendar']['text_event_title']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['calendar']['text_start_date']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control datetime event-start" name="event[start]" value="" placeholder="<?php echo $lang['calendar']['text_start_date']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><?php echo $lang['calendar']['text_end_date']; ?></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control datetime event-end" name="event[end]" value="" placeholder="<?php echo $lang['calendar']['text_end_date']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label><?php echo $lang['calendar']['text_all_day_event_(Select_if_all_day_event)']; ?></label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="event[allday]" class="custom-control-input event-allday" id="allday">
                                <label class="custom-control-label" for="allday"><?php echo $lang['calendar']['text_all_day_event']; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo $lang['common']['text_description']; ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-note"></i></span>
                            </div>
                            <textarea class="form-control event-descr" name="event[description]" placeholder="<?php echo $lang['common']['text_description']; ?>"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info font-12" name="submit"><?php echo $lang['common']['text_save']; ?></button>
                    <a class="btn btn-danger table-delete font-12"><input type="hidden" name="id" class="event-id"> <?php echo $lang['common']['text_delete']; ?></a>
                    <button type="button" class="btn btn-default font-12" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div id="delete-card" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
            </div>
            <div class="modal-footer">
                <form action="index.php?route=calendar/delete" class="delete-card-button" method="post">
                    <input type="hidden" value="" name="id">
                    <button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Full Calendar Plugin -->
<link rel="stylesheet" href="public/css/fullcalendar.min.css" />
<script type="text/javascript" src="public/js/fullcalendar.min.js"></script>

<!-- Calendar script -->
<script>
    var obj = <?php echo $calendar; ?>;
    events = [];
    $.each(obj, function(key, value) {
        var temp = [];
        temp['id'] = value['id'];
        temp['title'] = value['title'];
        temp['start'] = value['start_date'] + 'T' + value['start_time'];
        temp['end'] = value['end_date'] + 'T' + value['end_time'];
        if (value['allDay'] == "1") {
            temp['allday'] = true;
            temp['full'] = 1;
        } else {
            temp['allday'] = false;
            temp['full'] = 0;
        }
        temp['description'] = value['description'];
        events.push(temp);
    });

    console.log(events);
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        editable: true,
        eventLimit: true,
        navLinks: true,
        events: events,
        eventClick: function(event, jsEvent, view) {
            $('.event-title').val(event.title);
            $('.event-start').val(event.start.format('DD-MM-YYYY hh:mm A'));
            $('.event-descr').val(event.description);
            $('.event-id').val(event.id);
            if (event.full === 1) {
                $('.event-allday').prop('checked', true);
                $('.event-end').parents('.form-group').hide();
            } else if (event.end !== null) {
                $('.event-end').val(event.end.format('DD-MM-YYYY hh:mm A'));
            }
            $('#event-modal').modal('show');
        },
        eventDrop: function(event, delta, revertFunc) {
            if (!confirm("Are you sure about this change?")) {
                revertFunc();
            } else {
                $.ajax({
                    method: "POST",
                    url: 'index.php?route=calendar/drop',
                    data: {
                        id: event.id,
                        start: moment(event.start).format('DD-MM-YYYY HH:MM A')
                    },
                    error: function() {
                        alert('Sorry Try Again!');
                    },
                    success: function(response) {
                        alert(response);
                    }
                });
            }
        }
    });

    $('#event-modal').on('hidden.bs.modal', function(e) {
        $('#event-modal input, #event-modal textarea').val('');
        $('.event-allday').prop('checked', false);
        $('.event-end').parents('.form-group').show();
    });

    $('#event-modal').on('click', '.event-allday', function() {
        var ele = $(this);
        $('.event-end').val(moment(Date()).format('DD-MM-YYYY h:mm A'));
        $('.event-end').val('');
        if (ele.prop("checked") === true) {
            $('.event-end').parents('.form-group').hide();
        } else if (ele.prop("checked") === false) {
            $('.event-end').parents('.form-group').show();
        }
    });
</script>
<!-- Footer -->
<?php include(DIR . 'app/views/common/footer.tpl.php'); ?>