<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>
	$('#user').show();
	$('#user-li').addClass('active');
</script>
<!-- User list page start -->

<div class="content">
	<div class="panel panel-default">
		<div class="panel-head">
			<div class="panel-title">
				<i class="icon-people panel-head-icon"></i>
				<span class="panel-title-text"><?php echo $page_title; ?></span>
			</div>
			<div class="panel-action">
				<a href="<?php echo URL . DIR_ROUTE . 'user/add'; ?>" class="btn btn-success btn-sm"><i class="icon-plus mr-1"></i> <?php echo $lang['users']['text_new_user']; ?></a>
			</div>
		</div>
		<?php if (!empty($password_reset)) { ?>
		<div class="panel-wrapper px-3 pt-3">
			<div class="alert alert-success d-flex align-items-center mb-0" role="alert">
				<span class="mr-2">Password reset for user ID <?php echo (int)$password_reset_user; ?>.</span>
				<button type="button" class="btn btn-sm btn-info ml-auto" id="copy-reset-password"><?php echo $lang['common']['text_copy']; ?></button>
				<span id="reset-password-text" class="d-none"><?php echo $password_reset; ?></span>
			</div>
		</div>
		<script>
			$(function () {
				var password = $('#reset-password-text').text();
				function copyPassword() {
					if (navigator.clipboard && navigator.clipboard.writeText) {
						return navigator.clipboard.writeText(password);
					}
					var $temp = $('<textarea>');
					$('body').append($temp);
					$temp.val(password).select();
					document.execCommand('copy');
					$temp.remove();
					return Promise.resolve();
				}
				copyPassword();
				$('#copy-reset-password').on('click', function () {
					copyPassword();
				});
			});
		</script>
		<?php } ?>
		<div class="panel-wrapper">
			<div class="table-container">
				<table class="table table-dark table-striped datatable-table" width="100%">
					<thead>
						<tr class="table-heading">
							<th class="table-srno">#</th>
							<th><?php echo $lang['users']['text_person_info']; ?></th>
							<th><?php echo $lang['users']['text_username']; ?></th>
							<th><?php echo $lang['users']['text_user_role']; ?></th>
							<th><?php echo $lang['common']['text_status']; ?></th>
							<th><?php echo $lang['common']['text_created_date']; ?></th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($result)) { foreach ($result as $key => $value) { ?>
						<tr>
							<td class="table-srno"><?php echo $key+1; ?></td>
							<td>
								<p class="font-16 m-0"><?php echo $value['firstname'] .' '. $value['lastname']; ?></p>
								<p class="font-12 m-0"><?php echo $value['email']; ?></p>
								<p class="font-12 m-0"><?php echo $value['mobile']; ?></p>
							</td>
							<td><?php echo $value['user_name']; ?></td>
							<td><?php echo $value['role']; ?></td>
							<td><?php echo $value['status'] == '0' ? $lang['users']['text_inactive'] : $lang['users']['text_active']; ?></td>
							<td><?php echo date_format(date_create($value['date_of_joining']), 'd-m-Y'); ?></td>
							<td class="table-action">
								<?php if ($role == "1") { ?>
								<a href="<?php echo URL . DIR_ROUTE . 'user/edit&id=' . $value['user_id']; ?>" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
								<form action="<?php echo $password_reset_action; ?>" method="post" class="d-inline">
									<input type="hidden" name="_token" value="<?php echo $token; ?>">
									<input type="hidden" name="id" value="<?php echo $value['user_id']; ?>">
									<button type="submit" name="reset" class="btn btn-info btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['users']['text_reset_password']; ?>" onclick="return confirm('<?php echo $lang['users']['text_reset_password_confirm']; ?>');"><i class="icon-lock"></i></button>
								</form>
								<?php if ((string)$value['user_id'] !== '1') { ?>
								<span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['user_id'];?>"></span>
								<?php } ?>
								<?php } elseif ($role != "1" && $value['user_role'] != "1") { ?>
								<a href="<?php echo URL . DIR_ROUTE . 'user/edit&id=' . $value['user_id']; ?>" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['common']['text_edit']; ?>"><i class="icon-pencil"></i></a>
								<form action="<?php echo $password_reset_action; ?>" method="post" class="d-inline">
									<input type="hidden" name="_token" value="<?php echo $token; ?>">
									<input type="hidden" name="id" value="<?php echo $value['user_id']; ?>">
									<button type="submit" name="reset" class="btn btn-info btn-icon mr-2" data-toggle="tooltip" title="<?php echo $lang['users']['text_reset_password']; ?>" onclick="return confirm('<?php echo $lang['users']['text_reset_password_confirm']; ?>');"><i class="icon-lock"></i></button>
								</form>
								<?php if ((string)$value['user_id'] !== '1') { ?>
								<span class="btn btn-warning btn-icon table-delete text-black" data-toggle="tooltip" title="<?php echo $lang['common']['text_delete']; ?>"><i class="icon-trash"></i><input type="hidden" value="<?php echo $value['user_id'];?>"></span>
								<?php } ?>
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
				<h5 class="modal-title"><?php echo $lang['common']['text_confirm_delete']; ?></h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p class="delete-card-ttl"><?php echo $lang['common']['text_are_you_sure_you_want_to_delete?']; ?></p>
			</div>
			<div class="modal-footer">
				<form action="<?php echo URL . DIR_ROUTE . 'user/delete'; ?>" class="delete-card-button" method="post">
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
