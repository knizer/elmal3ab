<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1><?= $album["title"]; ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<h4>الوصف: <span style="color: #2083A6;"><?= $album["description"]; ?></span></h4>
					<h4>القسم:
						<?php if ( ! is_null($album["section_name"])): ?>
							<span style="color: #2083A6;"><?= $album["section_name"]; ?></span>
						<?php else: ?>
							<span style="color: red;">غير محدد</span>
						<?php endif; ?>
					</h4>
					<h4>تصوير:
						<?php if ( ! is_null($album["photographer"])): ?>
							<span style="color: #2083A6;"><?= $album["photographer"]; ?></span>
						<?php else: ?>
							<span style="color: red;">غير محدد</span>
						<?php endif; ?>
					</h4>
					<h4>رُفع بواسطة: <span style="color: #2083A6;"><?= $album["created_by"]; ?></span></h4>
					<h4>رُفع منذ: <span style="color: #2083A6;"><?= $album["created_at"]; ?></span></h4>
					<h4>الحالة:
						<?php if ($album["published"] == 1): ?>
							<span style="color: green;">منشور</span>
						<?php else: ?>
							<span style="color: red;">غير منشور</span>
						<?php endif; ?>
					</h4>
					<?php if ($album["published"] == 1): ?>
						<h4>نُشر بواسطة: <span style="color: #2083A6;"><?= $album["published_by"]; ?></span></h4>
						<h4>نُشر منذ: <span style="color: #2083A6;"><?= $album["published_at"]; ?></span></h4>
					<?php endif; ?>

					<div class="col-md-122" style="margin-top: 20px; padding-right: 30px;">
						<h4>صور الألبوم:</h4>
						<?php if (isset($album_images)): ?>
							<div>
								<?php foreach ($album_images as $image): ?>
									<?php if ($album['old_album'] == 0): ?>
										<img src="<?= IMG_ARCHIVE . '622x307/' . $image['image_name']; ?>"
											 style="width: 210px; height: 110px; float: right; margin-left: 10px;
													margin-bottom: 10px; <?php if ($image["image_name"] == $album["main_image"]) echo "opacity: 0.5; border: 2px solid red;"; ?>"
													<?php if ($image["image_name"] == $album["main_image"]) echo "title='الصورة الرئيسية'"; ?> />
									<?php else: ?>
										<img src="<?= OLD_IMG_ARCHIVE . $image['image_name']; ?>"
											 style="width: 210px; height: 110px; float: right; margin-left: 10px;
													margin-bottom: 10px; <?php if ($image["image_name"] == $album["main_image"]) echo "opacity: 0.5; border: 2px solid red;"; ?>"
													<?php if ($image["image_name"] == $album["main_image"]) echo "title='الصورة الرئيسية'"; ?> />
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php else: ?>
							<h4 style="color: red;">لا يوجد صور مرتبطة بهذا الألبوم</h4>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //$this->load->view("slide_panel"); ?>
</div><!-- Page Container -->
<?php $this->load->view("footer"); ?>
</body>
</html>
