<?php include (DIR.'app/views/common/header.tpl.php'); ?>
<script>
	$('#setting').show();
	$('#setting-li').addClass('active');</script>
</script>
<form action="<?php echo $action; ?>" method="post">
	<input type="hidden" name="_token" value="<?php echo $token; ?>">
	<div class="panel panel-default">
		<div class="panel-head">
			<div class="panel-title">
				<i class="icon-notebook panel-head-icon"></i>
				<span class="panel-title-text"><?php echo $page_title; ?></span>
			</div>
			<div class="panel-action">
				<button type="submit" class="btn btn-info btn-icon" name="submit" data-toggle="tooltip" data-placement="left" title="<?php echo $lang['common']['text_save']; ?>"><i class="far fa-save"></i></button>
			</div>  
		</div>
		<div class="panel-wrapper p-3">
			<div class="panel-body pl-4 pr-4">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_website_url']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-globe-alt"></i></span>
								</div>
								<input type="text" name="info[url]" class="form-control" value="<?php echo $result['url']; ?>" placeholder="<?php echo $lang['settings']['text_website_url']; ?>">
							</div>
						</div>
						<div class="form-group info-logo">
							<label class="pt-2"><text>*</text><?php echo $lang['settings']['text_logo']; ?> : </label>
							<div class="image-upload" <?php if (!empty($result['logo'])) { echo " style=\"display: none\" "; }?> >
								<a class="ml-4">Upload</a>
							</div>
							<div class="saved-picture" <?php if (empty($result['logo'])) { echo " style=\"display: none\" "; } ?> >
								<?php if (!empty($result['logo'])) { ?><img class="img-thumbnail" src="public/uploads/<?php echo $result['logo']; ?>" alt="">
								<?php } ?>
								<input type="hidden" name="info[logo]" value="<?php echo $result['logo']; ?>">
							</div>
							<div class="saved-picture-delete" data-toggle="tooltip" data-placement="right" title="Remove" <?php if (empty($result['logo'])) { echo " style=\"display: none\" "; } ?>><a class="fa fa-times"></a></div>
							<div class="text-muted pt-2 pl-5"><?php echo $lang['settings']['text_size_max_height_35px']; ?></div>
						</div>
						<div class="form-group info-logo">
							<label class="pt-2"><text>*</text><?php echo $lang['settings']['text_favicon']; ?> : </label>
							<div class="image-upload" <?php if (!empty($result['favicon'])) { echo " style=\"display: none\" "; }?> >
								<a class="ml-3">Upload</a>
							</div>
							<div class="saved-picture" <?php if (empty($result['favicon'])) { echo " style=\"display: none\" "; } ?> >
								<?php if (!empty($result['favicon'])) { ?><img class="img-thumbnail" src="public/uploads/<?php echo $result['favicon']; ?>" alt="">
								<?php } ?>
								<input type="hidden" name="info[favicon]" value="<?php echo $result['favicon']; ?>">
							</div>
							<div class="saved-picture-delete" data-toggle="tooltip" data-placement="right" title="Remove" <?php if (empty($result['favicon'])) { echo " style=\"display: none\" "; } ?> ><a class="fa fa-times"></a></div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_organization_name']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-organization"></i></span>
								</div>
								<input type="text" name="info[name]" class="form-control" value="<?php echo $result['name']; ?>" placeholder="<?php echo $lang['settings']['text_organization_name']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_legal_organization_name']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-organization"></i></span>
								</div>
								<input type="text" name="info[legal_name]" class="form-control" value="<?php echo $result['legal_name']; ?>" placeholder="<?php echo $lang['settings']['text_legal_organization_name']; ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['common']['text_email_address']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-envelope"></i></span>
								</div>
								<input type="text" name="info[email]" class="form-control" value="<?php echo $result['email']; ?>" placeholder="<?php echo $lang['common']['text_email_address']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_language']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-envelope"></i></span>
								</div>
								<select name="info[language]" class="custom-select">
									<option value="eng" <?php if ($result['language'] == "eng") { echo "selected"; } ?>>English</option>
									<option value="pt-br" <?php if ($result['language'] == "pt-br") { echo "selected"; } ?>>Portuguese (Brazil)</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label"><?php echo $lang['settings']['text_address_line_1']; ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-direction"></i></span>
										</div>
										<input type="text" name="info[address][address1]" class="form-control" value="<?php echo $address['address1']; ?>" placeholder="<?php echo $lang['settings']['text_address_line_1']; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label"><?php echo $lang['settings']['text_address_line_2']; ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-direction"></i></span>
										</div>
										<input type="text" name="info[address][address2]" class="form-control" value="<?php echo $address['address2']; ?>" placeholder="<?php echo $lang['settings']['text_address_line_2']; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label"><?php echo $lang['settings']['text_area_or_city']; ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-location-pin"></i></span>
										</div>
										<input type="text" name="info[address][city]" class="form-control" value="<?php echo $address['city']; ?>" placeholder="<?php echo $lang['settings']['text_area_or_city']; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label"><?php echo $lang['settings']['text_country']; ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-location-pin"></i></span>
										</div>
										<input type="text" name="info[address][country]" class="form-control" value="<?php echo $address['country']; ?>" placeholder="<?php echo $lang['settings']['text_country']; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_pincode']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-map-pin"></i></span>
								</div>
								<input type="text" name="info[address][pincode]" class="form-control" value="<?php echo $address['pincode']; ?>" placeholder="<?php echo $lang['settings']['text_pincode']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['common']['text_phone_number']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-screen-smartphone"></i></span>
								</div>
								<input type="text" name="info[phone]" class="form-control" value="<?php echo $result['phone']; ?>" placeholder="<?php echo $lang['common']['text_phone_number']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label"><?php echo $lang['settings']['text_fax_number']; ?></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-envelope-letter"></i></span>
								</div>
								<input type="text" name="info[fax]" class="form-control" value="<?php echo $result['fax']; ?>" placeholder="<?php echo $lang['settings']['text_fax_number']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer text-center">
			<button type="submit" class="btn btn-info" name="submit"><?php echo $lang['common']['text_save']; ?></button>
		</div>
	</div>
</form>

<!-- Footer -->
<?php include (DIR.'app/views/common/footer.tpl.php'); ?>