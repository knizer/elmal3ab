<div class="widget-area" style="margin-top: 0px;">
	<h1 style="margin-top: 0px; margin-bottom: 20px;"><?= $group["name"]; ?></h1>
	<div class="col-md-122" style="margin-bottom: 10px;">
		<h3>- الصلاحيات:</h3>
		<h4><input type="checkbox" disabled <?php if ($group["add_news"] == 1) echo "checked"; ?> /> إضافة خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_news_without_related_articles"] == 1) echo "checked"; ?> /> إضافة خبر بدون أخبار متعلقة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_news"] == 1) echo "checked"; ?> /> إدارة الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($group["view_news_history"] == 1) echo "checked"; ?> /> تتبع خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($group["edit_news"] == 1) echo "checked"; ?> /> تعديل خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_news"] == 1) echo "checked"; ?> /> مسح خبر</h4>
		<h4><input type="checkbox" disabled <?php if ($group["move_news_to_urgent"] == 1) echo "checked"; ?> /> نقل الأخبار إلي عاجل</h4>
		<h4><input type="checkbox" disabled <?php if ($group["move_news_to_reviewed"] == 1) echo "checked"; ?> /> نقل الأخبار إلي تمت المراجعة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["move_news_to_published"] == 1) echo "checked"; ?> /> نشر الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($group["unlock_news"] == 1) echo "checked"; ?> /> إلغاء تعليق الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($group["review_news"] == 1) echo "checked"; ?> /> تقييم الأخبار</h4>
		<h4><input type="checkbox" disabled <?php if ($group["featured_news_control"] == 1) echo "checked"; ?> /> التحكم بالرئيسيات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["banners_control"] == 1) echo "checked"; ?> /> التحكم بالبنرات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["view_original_image"] == 1) echo "checked"; ?> /> عرض الصورة الأصلية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_image"] == 1) echo "checked"; ?> /> مسح صورة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_album"] == 1) echo "checked"; ?> /> مسح ألبوم</h4>
		<h4><input type="checkbox" disabled <?php if ($group["featured_albums"] == 1) echo "checked"; ?> /> التحكم برئيسية الألبومات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_section"] == 1) echo "checked"; ?> />إضافة أو تعديل قسم رئيسي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_sections"] == 1) echo "checked"; ?> /> إدارة الأقسام الرئيسية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["arrange_sections"] == 1) echo "checked"; ?> /> ترتيب الأقسام الرئيسية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_section"] == 1) echo "checked"; ?> /> مسح قسم رئيسي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_subsection"] == 1) echo "checked"; ?> /> إضافة أو تعديل قسم فرعي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_subsections"] == 1) echo "checked"; ?> /> إدارة الأقسام الفرعية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_subsection"] == 1) echo "checked"; ?> /> مسح قسم فرعي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_coverage"] == 1) echo "checked"; ?> /> إضافة أو تعديل تغطية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_coverages"] == 1) echo "checked"; ?> /> إدارة التغطيات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_coverage"] == 1) echo "checked"; ?> /> مسح تغطية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_paper_version"] == 1) echo "checked"; ?> /> إضافة أو تعديل نسخة ورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_paper_versions"] == 1) echo "checked"; ?> /> إدارة النسخ الورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_paper_version"] == 1) echo "checked"; ?> /> مسح نسخة ورقية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_writer"] == 1) echo "checked"; ?> /> إضافة أو تعديل كاتب</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_writers"] == 1) echo "checked"; ?> /> إدارة الكتاب</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_writer"] == 1) echo "checked"; ?> /> مسح كاتب</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_keywords"] == 1) echo "checked"; ?> /> إدارة الكلمات الدالة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_keyword"] == 1) echo "checked"; ?> /> مسح كلمة دالة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_interactive_file"] == 1) echo "checked"; ?> /> إضافة أو تعديل ملف تفاعلي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_interactive_files"] == 1) echo "checked"; ?> /> إدارة الملفات التفاعلية</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_interactive_file"] == 1) echo "checked"; ?> /> مسح ملف تفاعلي</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_user"] == 1) echo "checked"; ?> /> إضافة أو تعديل مستخدم</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_users"] == 1) echo "checked"; ?> /> إدارة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_user"] == 1) echo "checked"; ?> /> مسح مستخدم</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_group"] == 1) echo "checked"; ?> /> إضافة أو تعديل مجموعة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_groups"] == 1) echo "checked"; ?> /> إدارة المجموعات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_group"] == 1) echo "checked"; ?> /> مسح مجموعة</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_video"] == 1) echo "checked"; ?> /> إضافة فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_videos"] == 1) echo "checked"; ?> /> إدارة الفيديوهات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["edit_video"] == 1) echo "checked"; ?> /> تعديل فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_video"] == 1) echo "checked"; ?> /> مسح فيديو</h4>
		<h4><input type="checkbox" disabled <?php if ($group["users_monitor"] == 1) echo "checked"; ?> /> مراقبة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($group["users_monitor_archive"] == 1) echo "checked"; ?> /> أرشيف مراقبة المستخدمين</h4>
		<h4><input type="checkbox" disabled <?php if ($group["add_metadata"] == 1) echo "checked"; ?> /> إضافة أو تعديل إعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_metadata"] == 1) echo "checked"; ?> /> إدارة الإعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["delete_metadata"] == 1) echo "checked"; ?> /> مسح الإعدادات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["manage_horoscope"] == 1) echo "checked"; ?> /> إدارة الأبراج</h4>
		<hr>
		<h3>- صلاحيات الأقسام:</h3>
		<?php if (isset($sections)): ?>
		<?php foreach ($sections as $section): ?> 
			<h4><input type="checkbox" disabled <?php if (in_array($section["id"], explode(",", $group["open_sections"]))) echo "checked"; ?> /> <?= $section["name"]; ?></h4>
		<?php endforeach; ?> 
		<?php endif; ?>
	</div>
</div>
