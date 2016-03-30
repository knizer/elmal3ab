<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>تعديل ألبوم</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<div class="wizard-form-h">
						<form action="" method="post">
							<?php if (isset($status)): ?>
								<div style="padding-right: 20px;"><?= $status; ?></div>
							<?php endif; ?>

							<input type="hidden" name="main_image" id="main_image" value="<?= $album['main_image']; ?>" />
							<input type="hidden" name="album_images" id="album_images" value="" />
							<div class="col-md-122">
								<div class="col-md-122">
									<div class="inline-form">
										<label class="c-label">العنوان *</label>
										<input type="text" name="title" value="<?= $album['title']; ?>" required />
									</div>
									<div class="inline-form">
										<label class="c-label">تصوير</label>
										<input type="text" name="photographer" value="<?= $album['photographer']; ?>" />
									</div>
									<div class="inline-form">
										<label class="c-label">صور الألبوم *</label>
										<div class="col-md-122" id="uploaded-images" style="margin-top: 30px;">
											<?php if (isset($album_images)): ?>
											<?php foreach ($album_images as $image): ?>
												<div class="album-img">
													<button type="button" class="fa fa-remove remove-img-btn" onclick="remove_image_from_album(this);"></button>
													<img src="<?= IMG_ARCHIVE . '622x307/' . $image['image_name']; ?>" class="edit-album-img"
														 id="<?= $image['image_id']; ?>&<?= $image['image_name']; ?>" width="185" height="110"
														 onclick="select_as_main_image(this);"
													<?php if ($image["image_name"] == $album["main_image"]) echo "style='opacity: 0.5; border: 2px solid red;'"; ?> />
												</div>
											<?php endforeach; ?>
											<?php endif; ?>
										</div>
										<div class="col-md-122" style="margin-right: 30px; margin-bottom: 30px;">
											<button type="button" class="btn btn-primary btn-font" id="add-images" style="font-size: 35px; width: 60px; padding: 0px;">+</button>
										</div>
									</div>
									<div class="inline-form">
										<h5 style="margin-right: 10px;">
											<input type="checkbox" name="published" value="1" <?php if ($album["published"] == 1) echo "checked"; ?> /> نشر
										</h5>
									</div>
								</div>
								<div class="col-md-122" style="margin-top: 20px;">
									<input type="submit" name="submit" value="حفظ" class="btn btn-success btn-font">
								</div>
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
		// Adding images to album code
		$(document).ready(function() {
			album_images = "<?php foreach($album_images as $image) echo $image["image_id"] . ","; ?>";
			if ( ! album_images)
			{
				album_images_arr = [];
			}
			else
			{
				album_images = album_images.slice(0, -1);
				$("#album_images").val(album_images);

				album_images_arr = album_images.split(",");
			}

			this_window_title = window.document.title;

			$("#add-images").click(function () {
				images_window = window.open("<?= ROOT; ?>images/list_images", "_blank", "toolbar=yes, scrollbars=yes, top=0, left=0, width=1050, height=" + window.innerHeight);
				var timer = setInterval(check_window_close, 500);

				images_path = "<?= IMG_ARCHIVE . '622x307/'; ?>";

				function check_window_close() {
					image = images_window.document.title;

					if (images_window.closed)
					{
						// Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
						if (image != this_window_title)
						{
							// Stop the timer
							clearInterval(timer);

							var result = image.split("&");

							if (jQuery.inArray(result[0], album_images_arr) === -1)
							{
								// Append the image to the images div
								var html = "<div class='album-img'>" +
												"<button type='button' class='fa fa-remove remove-img-btn' onclick='remove_image_from_album(this);'></button>" +
												"<img src='" + images_path + result[1] + "' class='edit-album-img'" +
												"id='" + result[0] + "&" + result[1] + "' width='185' height='110'" +
												"onclick='select_as_main_image(this);' />" +
											"</div>";

								$("#uploaded-images").append(html);

								// Append the image id to the album images array then update the album images hidden input value
								album_images_arr.push(result[0]);
								$("#album_images").val(album_images_arr.join(","));
							}
						}
					}
				}
			});
		});


		function select_as_main_image(image) {
			img = $(image);

			img.css({"opacity": "0.5", "border" : "2px solid red"});
			$(".edit-album-img").not(img).css({"opacity": "1", "border" : "none"});

			var image_info = img.attr("id").split('&');
			$("#main_image").val(image_info[1]);
		}


		function remove_image_from_album(remove_button) {
			btn = $(remove_button);

			// Remove the image from the images div
			var image_info = btn.next().attr("id").split('&');
			var removed_img_id = image_info[0];

			btn.parent().remove();

			// Remove the image id from the album images array then update the album images hidden input value
			var index = jQuery.inArray(removed_img_id, album_images_arr);
			if (index > -1)
			{
				album_images_arr.splice(index, 1);
				$("#album_images").val(album_images_arr.join(","));
			}
		}
</script>
</body>
</html>
