<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>
	$('#user').show();
	$('#user-li').addClass('active');
</script>
<!-- Subscriber list page start -->
<div class="content">
	<div class="panel panel-default">
		<div class="panel-head">
			<div class="panel-title">
				<i class="icon-people panel-head-icon"></i>
				<span class="panel-title-text"><?php echo $page_title; ?></span>
			</div>
			<div class="panel-action">
				<a href="<?php echo URL.DIR_ROUTE . 'role/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['users']['text_new_user_role']; ?></a>
			</div>
		</div>
		<div class="panel-wrapper">
			<div class="table-container">
				<table class="table table-bordered table-striped datatable-table" width="100%">
					<thead>
						<tr class="table-heading">
							<th class="table-srno">#</th>
							<th><?php echo $lang['users']['text_user_role_name']; ?></th>
							<th><?php echo $lang['common']['text_description']; ?></th>
							<th><?php echo $lang['common']['text_created_date']; ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($result)) { foreach ($result as $key => $value) { ?>
						<tr>
							<td class="table-srno"><?php echo $key+1; ?></td>
							<td><p class="font-14 margin-0"><?php echo $value['name'];?></p></td>
							<td><?php echo $value['description']; ?></td>
							<td><?php echo date_format(date_create($value['date_of_joining']),"d-m-Y"); ?></td>
							<td class="table-action">
								<?php if ($value['id'] != "1") { ?>
								<a href="index.php?route=role/edit&id=<?php echo $value['id']; ?>" class="btn btn-info btn-circle btn-outline btn-outline-1x" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
								<p class="btn btn-danger btn-circle btn-outline btn-outline-1x table-delete" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['id']; ?>"></p>
								<?php } ?>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div id="delete-card" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
			</div>
			<div class="modal-footer">
				<form action="index.php?route=role/delete" class="delete-card-button" method="post">
					<input type="hidden" value="" name="id">
					<button type="submit" class="btn btn-danger" name="delete"><?php echo $lang['common']['text_delete']; ?></button>
				</form>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['common']['text_close']; ?></button>
			</div>
		</div>
	</div>
</div>
<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>