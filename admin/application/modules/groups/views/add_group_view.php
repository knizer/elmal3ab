<?php $this->load->view("header"); ?> 

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>إضافة مجموعة</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<div class="wizard-form-h">
						<form action="" method="post">
							<?php if (isset($status)): ?>
								<div class="col-md-122" style="margin-bottom: 10px;">
									<?= $status; ?> 
								</div>
							<?php endif; ?> 
							<div class="col-md-122">
								<div class="inline-form">
									<label class="c-label">إسم المجموعة</label>
									<input class="input-style" type="text" name="name" required autofocus />
								</div>
							</div>
							<div class="col-md-122" style="margin-top: 20px; padding: 15px; background-color: #EEE;">
								<h4 style="margin-top: 0px;">الصلاحيات:</h4>
								<div class="col-md-122" style="margin-bottom: 10px; margin-right: 4px; padding: 10px;">
									<button type="button" id="mark-all" class="btn btn-info btn-font">إختيار الكل</button>
									<button type="button" id="unmark-all" class="btn btn-info btn-font">إلغاء إختيار الكل</button>
								</div>
								<div style="padding: 10px; margin-bottom: 40px;">
									<div class="col-md-122">
										<button type="button" id="news-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الأخبار</button>
										<div id="news-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_news" value="1" /> إضافة خبر</h4>
											<h4><input type="checkbox" name="add_news_without_related_articles" value="1" /> إضافة خبر بدون أخبار متعلقة</h4>
											<h4><input type="checkbox" name="manage_news" value="1" /> إدارة الأخبار</h4>
											<h4><input type="checkbox" name="view_news_history" value="1" /> تتبع خبر</h4>
											<h4><input type="checkbox" name="edit_news" value="1" /> تعديل خبر</h4>
											<h4><input type="checkbox" name="delete_news" value="1" /> مسح خبر</h4>
											<h4><input type="checkbox" name="move_news_to_urgent" value="1" /> نقل الأخبار إلي عاجل</h4>
											<h4><input type="checkbox" name="move_news_to_reviewed" value="1" /> نقل الأخبار إلي تمت المراجعة</h4>
											<h4><input type="checkbox" name="move_news_to_published" value="1" /> نشر الأخبار</h4>
											<h4><input type="checkbox" name="unlock_news" value="1" /> إلغاء تعليق الأخبار</h4>
											<h4><input type="checkbox" name="review_news" value="1" /> تقييم الأخبار</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="featured-news-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الرئيسيات و البنرات</button>
										<div id="featured-news-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="featured_news_control" value="1" /> التحكم بالرئيسيات</h4>
											<h4><input type="checkbox" name="banners_control" value="1" /> التحكم بالبنرات</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="images-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الصور و الألبومات</button>
										<div id="images-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="view_original_image" value="1" /> عرض الصورة الأصلية</h4>
											<h4><input type="checkbox" name="delete_image" value="1" /> مسح صورة</h4>
											<h4><input type="checkbox" name="delete_album" value="1" /> مسح ألبوم</h4>
											<h4><input type="checkbox" name="featured_albums" value="1" /> التحكم برئيسية الألبومات</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="sections-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الأقسام</button>
										<div id="sections-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_section" value="1" />إضافة أو تعديل قسم رئيسي</h4>
											<h4><input type="checkbox" name="manage_sections" value="1" /> إدارة الأقسام الرئيسية</h4>
											<h4><input type="checkbox" name="arrange_sections" value="1" /> ترتيب الأقسام الرئيسية</h4>
											<h4><input type="checkbox" name="delete_section" value="1" /> مسح قسم رئيسي</h4>
											<h4><input type="checkbox" name="add_subsection" value="1" /> إضافة أو تعديل قسم فرعي</h4>
											<h4><input type="checkbox" name="manage_subsections" value="1" /> إدارة الأقسام الفرعية</h4>
											<h4><input type="checkbox" name="delete_subsection" value="1" /> مسح قسم فرعي</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="coverages-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">التغطيات</button>
										<div id="coverages-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_coverage" value="1" /> إضافة أو تعديل تغطية</h4>
											<h4><input type="checkbox" name="manage_coverages" value="1" /> إدارة التغطيات</h4>
											<h4><input type="checkbox" name="delete_coverage" value="1" /> مسح تغطية</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="paper-versions-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">النسخ الورقية</button>
										<div id="paper-versions-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_paper_version" value="1" /> إضافة أو تعديل نسخة ورقية</h4>
											<h4><input type="checkbox" name="manage_paper_versions" value="1" /> إدارة النسخ الورقية</h4>
											<h4><input type="checkbox" name="delete_paper_version" value="1" /> مسح نسخة ورقية</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="writers-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الكتاب</button>
										<div id="writers-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_writer" value="1" /> إضافة أو تعديل كاتب</h4>
											<h4><input type="checkbox" name="manage_writers" value="1" /> إدارة الكتاب</h4>
											<h4><input type="checkbox" name="delete_writer" value="1" /> مسح كاتب</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="keywords-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الكلمات الدالة</button>
										<div id="keywords-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="manage_keywords" value="1" /> إدارة الكلمات الدالة</h4>
											<h4><input type="checkbox" name="delete_keyword" value="1" /> مسح كلمة دالة</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="interactive-files-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الملفات التفاعلية</button>
										<div id="interactive-files-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_interactive_file" value="1" /> إضافة أو تعديل ملف تفاعلي</h4>
											<h4><input type="checkbox" name="manage_interactive_files" value="1" /> إدارة الملفات التفاعلية</h4>
											<h4><input type="checkbox" name="delete_interactive_file" value="1" /> مسح ملف تفاعلي</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="users-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">المستخدمين و المجموعات</button>
										<div id="users-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_user" value="1" /> إضافة أو تعديل مستخدم</h4>
											<h4><input type="checkbox" name="manage_users" value="1" /> إدارة المستخدمين</h4>
											<h4><input type="checkbox" name="delete_user" value="1" /> مسح مستخدم</h4>
											<h4><input type="checkbox" name="add_group" value="1" /> إضافة أو تعديل مجموعة</h4>
											<h4><input type="checkbox" name="manage_groups" value="1" /> إدارة المجموعات</h4>
											<h4><input type="checkbox" name="delete_group" value="1" /> مسح مجموعة</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="videos-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الفيديوهات</button>
										<div id="videos-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_video" value="1" /> إضافة فيديو</h4>
											<h4><input type="checkbox" name="manage_videos" value="1" /> إدارة الفيديوهات</h4>
											<h4><input type="checkbox" name="edit_video" value="1" /> تعديل فيديو</h4>
											<h4><input type="checkbox" name="delete_video" value="1" /> مسح فيديو</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="monitor-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">المراقبة</button>
										<div id="monitor-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="users_monitor" value="1" /> مراقبة المستخدمين</h4>
											<h4><input type="checkbox" name="users_monitor_archive" value="1" /> أرشيف مراقبة المستخدمين</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="metadata-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الإعدادات</button>
										<div id="metadata-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="add_metadata" value="1" /> إضافة أو تعديل إعدادات</h4>
											<h4><input type="checkbox" name="manage_metadata" value="1" /> إدارة الإعدادات</h4>
											<h4><input type="checkbox" name="delete_metadata" value="1" /> مسح الإعدادات</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="horoscope-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">الأبراج</button>
										<div id="horoscope-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="manage_horoscope" value="1" /> إدارة الأبراج</h4>
										</div>
									</div>
									
									<div class="col-md-122" style="margin-top: 10px;">
										<button type="button" id="sections-permissions-btn" class="btn btn-primary btn-font toggling-btn" style="width: 200px;">صلاحيات الأقسام</button>
										<div id="sections-permissions-div" style="display: none; padding-right: 20px;">
											<?php if (isset($sections)): ?>
											<?php foreach ($sections as $section): ?> 
												<h4><input type="checkbox" name="<?= $section['id']; ?>" value="1" /> <?= $section["name"]; ?></h4>
											<?php endforeach; ?> 
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-122" style="margin-top: 15px;">
								<input type="submit" name="submit" value="حفظ" class="btn btn-success btn-font" style="width: 100px;" />
							</div>
						</form>
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
		// Mark all and unmark all buttons logic
		$("#mark-all").click(function() {
			$(":checkbox").prop("checked", true);
		});
		
		$("#unmark-all").click(function() {
			$(":checkbox").prop("checked", false);
		});
		
		// Slide down the news div on page load and toggle the initially hidden divs on clicks of their respective buttons
		var hidden_divs = ["news-div", "featured-news-div", "images-div", "sections-div", "coverages-div", "paper-versions-div", "writers-div", "keywords-div",
						   "interactive-files-div", "users-div", "videos-div", "monitor-div", "metadata-div", "horoscope-div", "sections-permissions-div"];
		
		$("#news-div").slideDown("slow");
		
		$(".toggling-btn").click(function () {
			var target_div_id = $(this).next().prop("id");
			$("#" + target_div_id).slideDown("slow");
			
			for (var i = 0; i < hidden_divs.length; i++)
			{
				if (target_div_id != hidden_divs[i])
				{
					$("#" + hidden_divs[i]).hide();
				}
			}
		});		
	});
</script>
</body>
</html>