<div class="widget-area" style="margin-top: 0px;">
	<h1>إضافة ألبوم:</h1>
	<div class="col-md-122" style="margin: 20px 0px;">
		<div class="inline-form">
			<label class="c-label">العنوان *</label>
			<input type="text" id="title" maxlength="120" />
		</div>
		<div class="inline-form">
			<label class="c-label">الوصف *</label>
			<textarea id="description" style="height: 80px;"></textarea>
		</div>
		<div class="inline-form">
			<label class="c-label">القسم *</label>
			<select id="section_id">
				<option value=""></option>
				<?php if (isset($sections)): ?>
				<?php foreach ($sections as $section): ?>
					<option value="<?= $section['id']; ?>"><?= $section["name"]; ?></option>
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="inline-form">
			<label class="c-label">تصوير</label>
			<input type="text" id="photographer" />
		</div>
		<div class="inline-form">
			<label class="c-label">الصورة الرئيسية *</label>
			<input type="hidden" id="main_image" value="" />
			<div class="col-md-122" id="uploaded-images" style="margin-top: 30px; margin-right: 20px;"></div>
		</div>
		<div class="inline-form">
			<h5 style="margin-right: 10px;"><input type="checkbox" id="publish" /> نشر</h5>
		</div>
		<p class="error-msg" id="status" style="margin-top: 10px;"></p>
	</div>
	<div class="col-md-122">
		<button type="button" id="save" class="btn btn-primary btn-font">حفظ</button>
	</div>
</div>

<script>
	$(document).ready(function() {
		var assigned_images;

		function update_assigned_images(value)
		{
			assigned_images = value;
		}

		$.ajax({
			type: "POST",
			url: "<?= site_url(); ?>images/check_for_images_just_uploaded",
			data: {session_id: session_id},
			success: function(response) {
				if (response != 0)
				{
					update_assigned_images(response);

					// Clear div containing images then repopulate it
					$("#uploaded-images").html("");

					response = JSON.parse(response);
					var imagesPath = "<?= IMG_ARCHIVE . '622x307/'; ?>";
					var newImages = "";
					for (var i = 0; i < response.length; i++)
					{
						newImages +=
						"<div style='float: right; margin-left: 20px; margin-bottom: 20px; cursor'>" +
							"<img src='" + imagesPath + response[i].name + "' class='album-main-img' id='" + response[i].name + "' width='185' height='110' />" +
						"</div>";
					}

					$(newImages).appendTo("#uploaded-images").fadeIn("slow");
				}

				// Make first image the main image by default, unless they choose one
				var firstImage = $("#uploaded-images").find("img:first");
				firstImage.css({"opacity": "0.5", "border" : "2px solid red"});
				var firstImageName = firstImage.attr("id");
				$("#main_image").val(firstImageName);

				// Choosing main image code
				$(".album-main-img").click(function() {
					$(this).css({"opacity": "0.5", "border" : "2px solid red"});
					$(".album-main-img").not(this).css({"opacity": "1", "border" : "none"});

					var clickedImageName = $(this).attr("id");
					$("#main_image").val(clickedImageName);
				});
			}
		});

		$("#save").click(function() {
			var title = $("#title").val().trim();
			var description = $("#description").val().trim();
			var section_id = $("#section_id").val();
			var photographer = $("#photographer").val().trim();
			var main_image = $("#main_image").val();
			var publish = 0;
			if ($("#publish").is(":checked")) publish = 1;

			if (title.length > 120)
			{
				$("#status").html("يجب ألا يتعدي عنوان الألبوم 120 حرف");
			}
			else if ( ! (title && description && section_id))
			{
				$("#status").html("يجب إدخال جميع البيانات الإجبارية");
			}
			else
			{
				$.ajax({
					type: "POST",
					url: "<?= site_url(); ?>albums/check_title_exists",
					data: {token: "ajax_request", title: title},
					success: function(response) {
						if (response == 1)
						{
							$("#status").html("يوجد ألبوم بهذا العنوان بالفعل");
						}
						else if (response == 0)
						{
							$.ajax({
								type: "POST",
								url: "<?= site_url(); ?>albums/add",
								data: {token: "ajax_request", title: title, description: description, section_id: section_id, photographer: photographer, main_image: main_image, publish: publish, assigned_images: assigned_images},
								success: function(response) {
									$("#modal").modal("toggle");
									$("#add-to-album").hide();
								}
							});
						}
					}
				});
			}
		});
	});
</script>
