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
									<h4><input type="checkbox" name="add_news" value="1" <?php if ($user_permissions["add_news"] == 1) echo "checked"; ?> /> إضافة خبر</h4>
									<h4><input type="checkbox" name="add_news_without_related_articles" value="1" <?php if ($user_permissions["add_news_without_related_articles"] == 1) echo "checked"; ?> /> إضافة خبر بدون أخبار متعلقة</h4>
									<h4><input type="checkbox" name="manage_news" value="1" <?php if ($user_permissions["manage_news"] == 1) echo "checked"; ?> /> إدارة الأخبار</h4>
									<h4><input type="checkbox" name="view_news_history" value="1" <?php if ($user_permissions["view_news_history"] == 1) echo "checked"; ?> /> تتبع خبر</h4>
									<h4><input type="checkbox" name="edit_news" value="1" <?php if ($user_permissions["edit_news"] == 1) echo "checked"; ?> /> تعديل خبر</h4>
									<h4><input type="checkbox" name="delete_news" value="1" <?php if ($user_permissions["delete_news"] == 1) echo "checked"; ?> /> مسح خبر</h4>
									<h4><input type="checkbox" name="move_news_to_urgent" value="1" <?php if ($user_permissions["move_news_to_urgent"] == 1) echo "checked"; ?> /> نقل الأخبار إلي عاجل</h4>
									<h4><input type="checkbox" name="move_news_to_reviewed" value="1" <?php if ($user_permissions["move_news_to_reviewed"] == 1) echo "checked"; ?> /> نقل الأخبار إلي تمت المراجعة</h4>
									<h4><input type="checkbox" name="move_news_to_published" value="1" <?php if ($user_permissions["move_news_to_published"] == 1) echo "checked"; ?> /> نشر الأخبار</h4>
									<h4><input type="checkbox" name="unlock_news" value="1" <?php if ($user_permissions["unlock_news"] == 1) echo "checked"; ?> /> إلغاء تعليق الأخبار</h4>
									<h4><input type="checkbox" name="review_news" value="1" <?php if ($user_permissions["review_news"] == 1) echo "checked"; ?> /> تقييم الأخبار</h4>
									<h4><input type="checkbox" name="featured_news_control" value="1" <?php if ($user_permissions["featured_news_control"] == 1) echo "checked"; ?> /> التحكم بالرئيسيات</h4>
									<h4><input type="checkbox" name="banners_control" value="1" <?php if ($user_permissions["banners_control"] == 1) echo "checked"; ?> /> التحكم بالبنرات</h4>
									<h4><input type="checkbox" name="view_original_image" value="1" <?php if ($user_permissions["view_original_image"] == 1) echo "checked"; ?> > عرض الصورة الأصلية</h4>
									<h4><input type="checkbox" name="delete_image" value="1" <?php if ($user_permissions["delete_image"] == 1) echo "checked"; ?> /> مسح صورة</h4>
									<h4><input type="checkbox" name="delete_album" value="1" <?php if ($user_permissions["delete_album"] == 1) echo "checked"; ?> /> مسح ألبوم</h4>
									<h4><input type="checkbox" name="featured_albums" value="1" <?php if ($user_permissions["featured_albums"] == 1) echo "checked"; ?> /> التحكم برئيسية الألبومات</h4>
									<h4><input type="checkbox" name="add_section" value="1" <?php if ($user_permissions["add_section"] == 1) echo "checked"; ?> />إضافة أو تعديل قسم رئيسي</h4>
									<h4><input type="checkbox" name="manage_sections" value="1" <?php if ($user_permissions["manage_sections"] == 1) echo "checked"; ?> /> إدارة الأقسام الرئيسية</h4>
									<h4><input type="checkbox" name="arrange_sections" value="1" <?php if ($user_permissions["arrange_sections"] == 1) echo "checked"; ?> /> ترتيب الأقسام الرئيسية</h4>
									<h4><input type="checkbox" name="delete_section" value="1" <?php if ($user_permissions["delete_section"] == 1) echo "checked"; ?> /> مسح قسم رئيسي</h4>
									<h4><input type="checkbox" name="add_subsection" value="1" <?php if ($user_permissions["add_subsection"] == 1) echo "checked"; ?> /> إضافة أو تعديل قسم فرعي</h4>
									<h4><input type="checkbox" name="manage_subsections" value="1" <?php if ($user_permissions["manage_subsections"] == 1) echo "checked"; ?> /> إدارة الأقسام الفرعية</h4>
									<h4><input type="checkbox" name="delete_subsection" value="1" <?php if ($user_permissions["delete_subsection"] == 1) echo "checked"; ?> /> مسح قسم فرعي</h4>
									<h4><input type="checkbox" name="add_coverage" value="1" <?php if ($user_permissions["add_coverage"] == 1) echo "checked"; ?> /> إضافة أو تعديل تغطية</h4>
									<h4><input type="checkbox" name="manage_coverages" value="1" <?php if ($user_permissions["manage_coverages"] == 1) echo "checked"; ?> /> إدارة التغطيات</h4>
									<h4><input type="checkbox" name="delete_coverage" value="1" <?php if ($user_permissions["delete_coverage"] == 1) echo "checked"; ?> /> مسح تغطية</h4>
									<h4><input type="checkbox" name="add_paper_version" value="1" <?php if ($user_permissions["add_paper_version"] == 1) echo "checked"; ?> /> إضافة أو تعديل نسخة ورقية</h4>
									<h4><input type="checkbox" name="manage_paper_versions" value="1" <?php if ($user_permissions["manage_paper_versions"] == 1) echo "checked"; ?> /> إدارة النسخ الورقية</h4>
									<h4><input type="checkbox" name="delete_paper_version" value="1" <?php if ($user_permissions["delete_paper_version"] == 1) echo "checked"; ?> /> مسح نسخة ورقية</h4>
									<h4><input type="checkbox" name="add_writer" value="1" <?php if ($user_permissions["add_writer"] == 1) echo "checked"; ?> /> إضافة أو تعديل كاتب</h4>
									<h4><input type="checkbox" name="manage_writers" value="1" <?php if ($user_permissions["manage_writers"] == 1) echo "checked"; ?> /> إدارة الكتاب</h4>
									<h4><input type="checkbox" name="delete_writer" value="1" <?php if ($user_permissions["delete_writer"] == 1) echo "checked"; ?> /> مسح كاتب</h4>
									<h4><input type="checkbox" name="manage_keywords" value="1" <?php if ($user_permissions["manage_keywords"] == 1) echo "checked"; ?> /> إدارة الكلمات الدالة</h4>
									<h4><input type="checkbox" name="delete_keyword" value="1" <?php if ($user_permissions["delete_keyword"] == 1) echo "checked"; ?> /> مسح كلمة دالة</h4>
									<h4><input type="checkbox" name="add_interactive_file" value="1" <?php if ($user_permissions["add_interactive_file"] == 1) echo "checked"; ?> /> إضافة أو تعديل ملف تفاعلي</h4>
									<h4><input type="checkbox" name="manage_interactive_files" value="1" <?php if ($user_permissions["manage_interactive_files"] == 1) echo "checked"; ?> /> إدارة الملفات التفاعلية</h4>
									<h4><input type="checkbox" name="delete_interactive_file" value="1" <?php if ($user_permissions["delete_interactive_file"] == 1) echo "checked"; ?> /> مسح ملف تفاعلي</h4>
									<h4><input type="checkbox" name="add_user" value="1" <?php if ($user_permissions["add_user"] == 1) echo "checked"; ?> /> إضافة أو تعديل مستخدم</h4>
									<h4><input type="checkbox" name="manage_users" value="1" <?php if ($user_permissions["manage_users"] == 1) echo "checked"; ?> /> إدارة المستخدمين</h4>
									<h4><input type="checkbox" name="delete_user" value="1" <?php if ($user_permissions["delete_user"] == 1) echo "checked"; ?> /> مسح مستخدم</h4>
									<h4><input type="checkbox" name="add_group" value="1" <?php if ($user_permissions["add_group"] == 1) echo "checked"; ?> /> إضافة أو تعديل مجموعة</h4>
									<h4><input type="checkbox" name="manage_groups" value="1" <?php if ($user_permissions["manage_groups"] == 1) echo "checked"; ?> /> إدارة المجموعات</h4>
									<h4><input type="checkbox" name="delete_group" value="1" <?php if ($user_permissions["delete_group"] == 1) echo "checked"; ?> /> مسح مجموعة</h4>
									<h4><input type="checkbox" name="add_video" value="1" <?php if ($user_permissions["add_video"] == 1) echo "checked"; ?> /> إضافة فيديو</h4>
									<h4><input type="checkbox" name="manage_videos" value="1" <?php if ($user_permissions["manage_videos"] == 1) echo "checked"; ?> /> إدارة الفيديوهات</h4>
									<h4><input type="checkbox" name="edit_video" value="1" <?php if ($user_permissions["edit_video"] == 1) echo "checked"; ?> /> تعديل فيديو</h4>
									<h4><input type="checkbox" name="delete_video" value="1" <?php if ($user_permissions["delete_video"] == 1) echo "checked"; ?> /> مسح فيديو</h4>
									<h4><input type="checkbox" name="users_monitor" value="1" <?php if ($user_permissions["users_monitor"] == 1) echo "checked"; ?> /> مراقبة المستخدمين</h4>
									<h4><input type="checkbox" name="users_monitor_archive" value="1" <?php if ($user_permissions["users_monitor_archive"] == 1) echo "checked"; ?> /> أرشيف مراقبة المستخدمين</h4>
									<h4><input type="checkbox" name="add_metadata" value="1" <?php if ($user_permissions["add_metadata"] == 1) echo "checked"; ?> /> إضافة أو تعديل إعدادات</h4>
									<h4><input type="checkbox" name="manage_metadata" value="1" <?php if ($user_permissions["manage_metadata"] == 1) echo "checked"; ?> /> إدارة الإعدادات</h4>
									<h4><input type="checkbox" name="delete_metadata" value="1" <?php if ($user_permissions["delete_metadata"] == 1) echo "checked"; ?> /> مسح الإعدادات</h4>
									<h4><input type="checkbox" name="manage_horoscope" value="1" <?php if ($user_permissions["manage_horoscope"] == 1) echo "checked"; ?> /> إدارة الأبراج</h4>
									<hr />
									<h4>صلاحيات الأقسام</h4>
									<?php if (isset($sections)): ?>
									<?php foreach ($sections as $section): ?> 
										<h4><input type="checkbox" name="<?= $section['id']; ?>" value="1"
												   <?php if (in_array($section["id"], explode(",", $user_permissions["open_sections"]))) echo "checked"; ?> /> <?= $section["name"]; ?></h4>
									<?php endforeach; ?> 
									<?php endif; ?>
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