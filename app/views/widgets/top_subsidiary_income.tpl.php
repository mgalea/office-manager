<div class="col-md-6 col-lg-6">
    <div class="dashboard-stat color-primary">
        <div class="content">
            <h4>Subsidiaries</h4>
            <?php if (!empty($top_subsidiary_income)) { ?>
                <?php foreach ($top_subsidiary_income as $row) { ?>
                    <div class="font-12">
                        <?php echo $row['subsidiary']; ?>: <?php echo $row['total']; ?>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="font-12">No data</div>
            <?php } ?>
        </div>
        <div class="icon"><i class="icon-briefcase"></i></div>
    </div>
</div>
