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
								<div style="padding: 10px; margin-bottom: 40px;">
									<div class="col-md-122">
										<div id="news-div" style="display: none; padding-right: 20px;">
											<h4><input type="checkbox" name="stadiums" value="stadiums" />الملاعب</h4>
											<h4><input type="checkbox" name="images_albums" value="images_albums" />الصور</h4>
											<h4><input type="checkbox" name="videos" value="videos" />الفيديوهات</h4>
											<h4><input type="checkbox" name="users_groups" value="users_groups" />المستخدمين</h4>
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
