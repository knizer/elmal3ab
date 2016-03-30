<div class="widget-area" style="margin-top: 0px;">
	<?php if ( ! empty($user["picture"])): ?> 
		<div style="float: right;">
			<img src="<?= USER_PHOTOS . $user['picture']; ?>" alt="<?= $user['name']; ?>" />
		</div>
	<?php endif; ?> 
	<div style="float: right; padding-right: 20px;">
		<h3>الإسم: <span style="color: #2083A6;"><?= $user["name"]; ?></span></h3>
		<h3>المجموعة: <span style="color: #2083A6;"><?= $user["group_name"]; ?></span></h3>
		<h3>إسم الدخول: <span style="color: #2083A6;"><?= $user["username"]; ?></span></h3>
		<h3>الموبايل: <span style="color: #2083A6;"><?= $user["mobile"]; ?></span></h3>
		<h3>الإيميل: <span style="color: #2083A6;"><?= $user["email"]; ?></span></h3>
	</div>
	<div style="clear: both;"></div>
	<button type="button" id="show-permissions" class="btn btn-primary btn-font" style="width: 130px; margin-top: 20px; margin-bottom: 10px;">عرض الصلاحيات</button>
	<div id="permissions" style="display: none;">
		<h3>الصلاحيات:</h3>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_news"] == 1) echo "checked"; ?> /> إضافة خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_news_without_related_articles"] == 1) echo "checked"; ?> /> إضافة خبر بدون أخبار متعلقة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_news"] == 1) echo "checked"; ?> /> إدارة الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["view_news_history"] == 1) echo "checked"; ?> /> تتبع خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["edit_news"] == 1) echo "checked"; ?> /> تعديل خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_news"] == 1) echo "checked"; ?> /> مسح خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["move_news_to_urgent"] == 1) echo "checked"; ?> /> نقل الأخبار إلي عاجل</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["move_news_to_reviewed"] == 1) echo "checked"; ?> /> نقل الأخبار إلي تمت المراجعة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["move_news_to_published"] == 1) echo "checked"; ?> /> نشر الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["unlock_news"] == 1) echo "checked"; ?> /> إلغاء تعليق الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["review_news"] == 1) echo "checked"; ?> /> تقييم الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["featured_news_control"] == 1) echo "checked"; ?> /> التحكم بالرئيسيات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["banners_control"] == 1) echo "checked"; ?> /> التحكم بالبنرات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["view_original_image"] == 1) echo "checked"; ?> /> عرض الصورة الأصلية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_image"] == 1) echo "checked"; ?> /> مسح صورة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_album"] == 1) echo "checked"; ?> /> مسح ألبوم</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["featured_albums"] == 1) echo "checked"; ?> /> التحكم برئيسية الألبومات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_section"] == 1) echo "checked"; ?> />إضافة أو تعديل قسم رئيسي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_sections"] == 1) echo "checked"; ?> /> إدارة الأقسام الرئيسية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["arrange_sections"] == 1) echo "checked"; ?> /> ترتيب الأقسام الرئيسية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_section"] == 1) echo "checked"; ?> /> مسح قسم رئيسي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_subsection"] == 1) echo "checked"; ?> /> إضافة أو تعديل قسم فرعي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_subsections"] == 1) echo "checked"; ?> /> إدارة الأقسام الفرعية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_subsection"] == 1) echo "checked"; ?> /> مسح قسم فرعي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_coverage"] == 1) echo "checked"; ?> /> إضافة أو تعديل تغطية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_coverages"] == 1) echo "checked"; ?> /> إدارة التغطيات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_coverage"] == 1) echo "checked"; ?> /> مسح تغطية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_paper_version"] == 1) echo "checked"; ?> /> إضافة أو تعديل نسخة ورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_paper_versions"] == 1) echo "checked"; ?> /> إدارة النسخ الورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_paper_version"] == 1) echo "checked"; ?> /> مسح نسخة ورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_writer"] == 1) echo "checked"; ?> /> إضافة أو تعديل كاتب</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_writers"] == 1) echo "checked"; ?> /> إدارة الكتاب</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_writer"] == 1) echo "checked"; ?> /> مسح كاتب</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_keywords"] == 1) echo "checked"; ?> /> إدارة الكلمات الدالة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_keyword"] == 1) echo "checked"; ?> /> مسح كلمة دالة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_interactive_file"] == 1) echo "checked"; ?> /> إضافة أو تعديل ملف تفاعلي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_interactive_files"] == 1) echo "checked"; ?> /> إدارة الملفات التفاعلية</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_interactive_file"] == 1) echo "checked"; ?> /> مسح ملف تفاعلي</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_user"] == 1) echo "checked"; ?> /> إضافة أو تعديل مستخدم</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_users"] == 1) echo "checked"; ?> /> إدارة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_user"] == 1) echo "checked"; ?> /> مسح مستخدم</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_group"] == 1) echo "checked"; ?> /> إضافة أو تعديل مجموعة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_groups"] == 1) echo "checked"; ?> /> إدارة المجموعات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_group"] == 1) echo "checked"; ?> /> مسح مجموعة</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_video"] == 1) echo "checked"; ?> /> إضافة فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_videos"] == 1) echo "checked"; ?> /> إدارة الفيديوهات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["edit_video"] == 1) echo "checked"; ?> /> تعديل فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_video"] == 1) echo "checked"; ?> /> مسح فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["users_monitor"] == 1) echo "checked"; ?> /> مراقبة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["users_monitor_archive"] == 1) echo "checked"; ?> /> أرشيف مراقبة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["add_metadata"] == 1) echo "checked"; ?> /> إضافة أو تعديل إعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_metadata"] == 1) echo "checked"; ?> /> إدارة الإعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["delete_metadata"] == 1) echo "checked"; ?> /> مسح الإعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["manage_horoscope"] == 1) echo "checked"; ?> /> إدارة الأبراج</h4>
		<hr>
		<h3>- صلاحيات الأقسام:</h3>
		<?php if (isset($sections)): ?>
		<?php foreach ($sections as $section): ?> 
			<h4><input type="checkbox" disabled <?php if (in_array($section["id"], explode(",", $user_permissions["open_sections"]))) echo "checked"; ?> /> <?= $section["name"]; ?></h4>
		<?php endforeach; ?> 
		<?php endif; ?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#show-permissions").click(function () {
		    $("#permissions").toggle();
		});
	});
</script>