<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>تعديل صورة</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<div class="wizard-form-h">
						<form action="" method="post">
							<?php foreach ($image_sizes as $key => $value): ?>
								<?php if (file_exists(IMG_ARCHIVE_PATH . "cache/{$key}_" . $image['name'])): ?>
									<div>
										<img id="<?= $key; ?>"
										src="<?= IMG_ARCHIVE . 'cache/' . $key . '_' . $image['name']; ?>" />
									</div><br />
								<?php endif; ?>
							<?php endforeach; ?>

							<div class="col-md-62" style="margin-bottom: 10px;">
								<div class="inline-form">
									<label class="c-label">الوصف</label>
									<input type="text" name="description" value="<?= $image['description']; ?>" required />
								</div>
							</div>
							<div style="clear: both;"></div>
							<div class="col-md-122">
								<h4><input type="checkbox" name="watermarked" value="1" <?php if ($image["watermarked"] == 1) echo "checked"; ?> /> علامة مائية</h4>
							</div>
							<?php foreach ($image_sizes as $key => $value): ?>
								<input type="hidden" name="<?= $key; ?>_x" id="<?= $key; ?>_x" />
								<input type="hidden" name="<?= $key; ?>_y" id="<?= $key; ?>_y" />
							<?php endforeach; ?>
							<input type="submit" name="submit" value="حفظ" class="btn btn-success btn-font" style="width: 90px; margin-top: 20px;" />
						</form>
					</div>
				</div>
				<div class="widget-area">
					<h4 style="margin-bottom: 0px; margin-top: -5px;">تبديل الصورة:</h4>
					<div class="col-md-122">
						<form action="<?= ROOT . 'images/add'; ?>" method="post" enctype="multipart/form-data">
							<div class="inline-form" style="margin-bottom: 15px;">
								<label class="c-label">الصورة الجديدة</label>
								<input type="file" name="image" title="jpg, jpeg, png, or gif" required />
							</div>
							<h4><input type="checkbox" name="watermark_new" value="1" /> علامة مائية</h4>
							<input type="hidden" name="existing_name" value="<?= $image['name']; ?>" />
							<input type="hidden" name="existing_id" value="<?= $image['id']; ?>" />
							<input type="hidden" name="existing_watermark" value="<?= $image['watermarked']; ?>" />
							<input type="submit" name="replace" value="تنفيذ" class="btn btn-primary btn-font" style="width: 90px; margin-top: 15px;" />
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
	// This will fire after the entire page is loaded, including images
	$(window).load(function() {
		<?php foreach ($image_sizes as $key => $value): ?>
			/* start <?= $key; ?> */
			var api_<?= $key; ?>;
			<?php $x = explode("x", $key)[0]; ?>
			<?php $y = explode("x", $key)[1]; ?>
			var crop_width_<?= $key; ?> = "<?= $x; ?>";
			var crop_height_<?= $key; ?> = "<?= $y; ?>";

			var opt_<?= $key; ?> = {
				onChange: editCoords<?= $key; ?>,
				onSelect: editCoords<?= $key; ?>
			};
			opt_<?= $key; ?>.allowResize = false;
			opt_<?= $key; ?>.allowSelect = false;
			api_<?= $key; ?> = $.Jcrop('#<?= $key; ?>', opt_<?= $key; ?>);
			api_<?= $key; ?>.setSelect([0, 0, crop_width_<?= $key; ?>, crop_height_<?= $key; ?>]);

			function editCoords<?= $key; ?>(c) {
				$("#<?= $key; ?>_x").val(c.x);
				$("#<?= $key; ?>_y").val(c.y);
			};
			/* end <?= $key; ?> */

		<?php endforeach; ?>
	});
</script>
</body>
</html>
