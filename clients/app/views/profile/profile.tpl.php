<?php include (DIR_CLIENTS.'app/views/common/header.tpl.php'); ?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-head">
				<div class="panel-title">
					<i class="icon-user panel-head-icon"></i>
					<span class="panel-title-text"><?php echo $lang['common']['text_my_account']; ?></span>
				</div>
				<div class="panel-action"></div>
			</div>
			<form action="<?php echo $action; ?>" method="post">
				<div class="panel-body">
					<div class="form-group">
						<label for="col-form-label"><?php echo $lang['common']['text_name']; ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon-user"></i></span>
							</div>
							<input type="text" class="form-control" name="profile[name]" value="<?php echo $user['name']; ?>" placeholder="<?php echo $lang['common']['text_name']; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon-envelope"></i></span>
							</div>
							<input type="text" class="form-control" value="<?php echo $user['email']; ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="col-form-label"><?php echo $lang['common']['text_mobile_number']; ?></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="icon-phone"></i></span>
							</div>
							<input type="text" class="form-control" name="profile[mobile]" value="<?php echo $user['mobile']; ?>" placeholder="<?php echo $lang['common']['text_mobile_number']; ?>" required>
						</div>
						<input type="hidden" name="_token" value="<?php echo $token; ?>">
						<input type="hidden" name="profile[id]" value="<?php echo $user['id']; ?>">
						<input type="hidden" name="profile[email]" value="<?php echo $user['email']; ?>">
					</div>
				</div>
				<div class="panel-footer text-center">
					<button type="submit" class="btn btn-info" name="submit"><?php echo $lang['common']['text_save']; ?></button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>	


<!-- Footer -->
<?php include (DIR_CLIENTS.'app/views/common/footer.tpl.php'); ?>