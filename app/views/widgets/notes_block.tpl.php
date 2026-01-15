<div class="notes-block mb-3">
    <?php if (!empty($notes)) {
        foreach ($notes as $key => $value) { ?>

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
                            <p class=" mb-0"><i class="icon-calendar mr-1"></i><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?route=note/edit&id=<?php echo $value['id']; ?>"><i class="icon-pencil"></i></a>

                        </div>
                    </div>
                </div>
            </div>

        <?php }
    } else { ?>
        <p class="mb-0 font-18">No Note Found</p>

    <?php } ?>
    <div class="row">
        <div class="col-6 text-center">
            <a href="<?php echo URL . DIR_ROUTE . 'notes'; ?>" class="btn btn-red mt-3">See More Notes</a>
        </div>
        <div class="col-6 text-center">
            <a href="<?php echo URL . DIR_ROUTE . 'note/add'; ?>" class="btn btn-success mt-3">Create New Note</a>
        </div>
    </div>
</div>
