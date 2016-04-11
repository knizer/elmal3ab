<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>تعديل مستخدم</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
                    <div class="wizard-form-h">
						<?php if (isset($status)): ?>
							<div class="col-md-122" style="margin-top: -20px; margin-bottom: 20px;">
								<?= $status; ?>
							</div>
						<?php endif; ?>
						<div class="col-md-122" style="margin-bottom: 15px;">
							<button type="button" id="change-info-btn" class="btn btn-primary btn-font" style="width: 140px;">تعديل البيانات</button>
							<div id="change-info-div" style="display: none; padding-top: 10px;">
								<form action="" method="post">
									<div class="col-md-62">
										<div class="inline-form">
											<label class="c-label">الإسم *</label>
											<input type="text" name="name" value="<?= $user['name']; ?>" required autofocus />
										</div>
									</div>
									<div class="col-md-62">
										<div class="inline-form" style="height: 40px;">
											<label class="c-label">المجموعة *</label>
											<select name="group_id" required>
												<option value=""></option>
												<?php if (isset($groups)): ?>
												<?php foreach ($groups as $group): ?>
													<?php if ($group["id"] == $user["group_id"]): ?>
														<option value="<?= $group['id']; ?>" selected><?= $group['name']; ?></option>
													<?php else: ?>
														<option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
												<?php endif; ?>
											</select>
										</div>
									</div>
									<div class="col-md-62">
										<div class="inline-form">
											<label class="c-label">الموبايل</label>
											<input type="text" name="mobile" value="<?= $user['mobile']; ?>" />
										</div>
									</div>
									<div class="col-md-62">
										<div class="inline-form">
											<label class="c-label">البريد الالكترونى</label>
											<input type="email" name="email" value="<?= $user['email']; ?>" />
										</div>
									</div>
									<div class="col-md-122" style="margin-top: 15px;">
										<input type="submit" name="info_submit" value="حفظ" class="btn btn-success btn-font" />
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-122" style="margin-bottom: 15px;">
							<button type="button" id="change-password-btn" class="btn btn-primary btn-font" style="width: 140px;">تعديل كلمة السر</button>
							<div id="change-password-div" style="display: none; padding-top: 10px;">
								<form action="" method="post">
									<div class="inline-form">
										<label class="c-label">كلمة السر الجديدة *</label>
										<input type="password" name="password" required />
									</div>
									<div class="inline-form">
										<label class="c-label">تأكيد كلمة السر الجديدة *</label>
										<input type="password" name="confirm_password" required />
									</div>
									<div class="col-md-122" style="margin-top: 15px;">
										<input type="submit" name="password_submit" value="حفظ" class="btn btn-success btn-font" />
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-122" style="margin-bottom: 15px;">
							<button type="button" id="change-picture-btn" class="btn btn-primary btn-font" style="width: 140px;">تعديل الصورة</button>
							<div id="change-picture-div" style="display: none; padding-top: 10px;">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="image-crop" style="margin-top: 20px;">
										<h2 class="StepTitle">الصورة الجديدة</h2>
										<div class="bbody">
											<!-- hidden crop params -->
											<input type="hidden" id="x1" name="x1">
											<input type="hidden" id="y1" name="y1">
											<input type="hidden" id="w" name="w" />
											<input type="hidden" id="h" name="h" />
											<h3>Step1: Please select image file</h3>
											<div>
												<input type="file" name="picture" id="image_file" onchange="fileSelectHandler()" required />
											</div>
											<div class="step255">
												<h3 style="padding-top: 45px;">Step2: Please select a crop region</h3>
												<img id="preview" />
											</div>
										</div>
									</div>
									<div class="col-md-122" style="margin-top: 15px;">
										<input type="submit" name="picture_submit" value="حفظ" class="btn btn-success btn-font" />
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-122" style="margin-bottom: 15px;">
							<button type="button" id="change-permissions-btn" class="btn btn-primary btn-font" style="width: 140px;">تعديل الصلاحيات</button>
							<div id="change-permissions-div" style="display: none; padding-top: 10px;">
								<form action="" method="post">
									<h4><input type="checkbox" name="stadiums" value="1" <?php if ($user_permissions["stadiums"] == 1) echo "checked"; ?> />الملاعب</h4>
									<h4><input type="checkbox" name="images_albums" value="1" <?php if ($user_permissions["images_albums"] == 1) echo "checked"; ?> />الصور</h4>
									<h4><input type="checkbox" name="videos" value="1" <?php if ($user_permissions["videos"] == 1) echo "checked"; ?> />الفيديوهات</h4>
									<h4><input type="checkbox" name="users_groups" value="1" <?php if ($user_permissions["users_groups"] == 1) echo "checked"; ?> />المستخدمين</h4>
									<div class="col-md-122" style="margin-top: 15px;">
										<input type="submit" name="permissions_submit" value="حفظ" class="btn btn-success btn-font" />
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //$this->load->view("slide_panel"); ?>
</div><!-- Page Container -->
<?php $this->load->view("footer"); ?>
<script>
	$(document).ready(function() {
		$("#change-info-div").slideDown("slow");

		// Toggle the initially hidden divs on clicks of their respective buttons
		$("#change-info-btn").click(function () {
			$("#change-info-div").slideDown("slow");
			$("#change-password-div").hide();
			$("#change-picture-div").hide();
			$("#change-permissions-div").hide();
		});

		$("#change-password-btn").click(function () {
			$("#change-password-div").slideDown("slow");
			$("#change-info-div").hide();
			$("#change-picture-div").hide();
			$("#change-permissions-div").hide();
		});

		$("#change-picture-btn").click(function () {
			$("#change-picture-div").slideDown("slow");
			$("#change-info-div").hide();
			$("#change-password-div").hide();
			$("#change-permissions-div").hide();
		});

		$("#change-permissions-btn").click(function () {
			$("#change-permissions-div").slideDown("slow");
			$("#change-info-div").slideUp("slow");
			$("#change-password-div").slideUp("slow");
			$("#change-picture-div").slideUp("slow");
		});
	});
</script>
</body>
</html>
