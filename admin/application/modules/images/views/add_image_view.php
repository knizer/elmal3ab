<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>إضافة صور/ألبوم</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<div class="wizard-form-h" id="upload-form">
						<form action="<?= ROOT . 'images/add'; ?>" class="dropzone" id="myDropzone">
							<input type="hidden" name="session_id" id="session_id" value="<?= $timestamp; ?>" />
						</form>
						<button type="button" id="done" class="btn btn-success btn-font" style="float: left; margin-top: 6px; display: none;">تم</button>
					</div>
					<div class="col-md-122" id="toolbar" style="background-color: #EEE; padding: 15px; display: none;">
						<button type="button" id="mark-all" class="btn btn-info btn-font">إختيار علامة مائية للكل</button>
						<button type="button" id="unmark-all" class="btn btn-info btn-font">إلغاء إختيار علامة مائية للكل</button>
						<a onclick="viewInModal('albums/add');" href="javascript:void(null);">
							<button type="button" id="add-to-album" class="btn btn-primary btn-font" data-toggle="modal" data-target=".bs-example-modal-lg">إضافة الكل لألبوم جديد</button>
						</a>
					</div>

					<!-- Empty modal -->
					<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content"></div>
						</div>
					</div>

					<!-- Placeholder for images that will load here -->
					<div class="col-md-122" id="uploaded-images" style="margin-top: 50px; margin-right: 15px;">
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
		startedUploading = false;
		stoppedUploading = false;
		session_id = $("#session_id").val();

		setInterval(function() {
			if (startedUploading && ! stoppedUploading)
			{
				$.ajax({
					type: "POST",
					url: "<?= ROOT; ?>images/check_for_images_just_uploaded",
					data: {session_id: session_id},
					success: function(response) {
						if (response != 0)
						{
							// Clear div containing images then repopulate it
							$("#uploaded-images").html("");

							response = JSON.parse(response);
							var imagesPath = "<?= SMALL_IMG; ?>";
							var newImages = "<form action='' method='post'>";
							for (var i = 0; i < response.length; i++)
							{
								newImages +=
								"<div class='uploaded-img' style='float: right; margin-left: 15px; margin-bottom: 30px;'>" +
									"<img src='" + imagesPath + response[i].name + "' width='210' height='110' />" +
									"<div style='margin-top: 5px;'>" +
										"<input type='text' name='desc:" + response[i].id + ":" + response[i].name + "' placeholder='اسم الصورة' class='img-controls' style='width: 100%; padding-right: 6px; display: none;' required />" +
									"</div>" +
									"<div style='margin-top: 5px;'>" +
										"<input type='checkbox' name='watermarked_" + response[i].id + "' value='1' class='img-controls' style='display: none;' /> <span class='img-controls' style='display: none;'>علامة مائية</span>" +
									"</div>" +
									"<div style='margin-top: 5px; margin-right: 53px;'>" +
										"<a onclick=\"viewInModal('images/view/" + response[i].id + "');\" href='javascript:void(null);'>" +
											"<button class='btn btn-primary mini btn-font' data-toggle='modal' data-target='.bs-example-modal-lg' type='button'>عرض</button>" +
										"</a> " +
										"<a onclick='deleteImage(" + response[i].id + ", this);' href='javascript:void(null);'>" +
											"<button class='btn btn-danger mini btn-font' type='button'>حذف</button>" +
										"</a> " +
									"</div>" +
								"</div>";
							}
							newImages += "<div class='col-md-122' style='margin-top: 40px; margin-right: -16px;'>";
							newImages += "<input type='submit' name='submit' value='حفظ' class='btn btn-success btn-font img-controls' style='width: 80px; display: none;' />";
							newImages += "</div>";
							newImages += "</form>";

							$(newImages).appendTo("#uploaded-images").fadeIn("slow");
						}
					}
				});
			}
        }, 3000);

		// Done button logic
		$("#done").click(function() {
			stoppedUploading = true;
			$("#upload-form").remove();
			$("#toolbar").css("display", "block");
			$(".img-controls").css("display", "initial");
			// Do it again after a moment to avoid a bug where one last request happen after clicking done and messes things up
			setTimeout(function() {
				$("#toolbar").css("display", "block");
				$(".img-controls").css("display", "initial");
			}, 2000);
		});

		// Mark all and unmark all buttons logic
		$("#mark-all").click(function() {
			$(":checkbox").prop("checked", true);
		});

		$("#unmark-all").click(function() {
			$(":checkbox").prop("checked", false);
		});
	});

	// Function attached to the images delete button (in case of user confirmation)
	function deleteImage(ID, btn) {
		var targetURL = "<?= ROOT; ?>images/delete/" + ID;

		$.ajax({
			type: "POST",
			url: targetURL,
			data: {token: "ajax_request"},
			success: function(response) {
				$(btn).closest(".uploaded-img").remove();
			}
		});
	}

	Dropzone.options.myDropzone = {
		init: function() {
			this.on("processing", function(file) { $("#done").attr("disabled", "disabled"); });
			this.on("success", function(file, response) {
				$("#done").removeAttr("disabled");
				if (response == "quality_error")
				{
					var faulty_file_html = file.previewElement;
					$(faulty_file_html).addClass("dz-error");
					$(faulty_file_html).find(".dz-error-message span").text("هذة الصورة لم يتم رفعها بسبب الجودة السيئة");
				}
			});
		},
		paramName: "image",
		maxFilesize: 10,
		acceptedFiles: "image/*",
		parallelUploads: 1,
		autoProcessQueue: true,
		dictDefaultMessage: "إضغط هنا أو إسحب الصور لرفعها",
		accept: function(file, done) {
			var reader = new FileReader();
			reader.onload = (function(file) {
				var image = new Image();
				image.src = file.target.result;
				image.onload = function() {
					var imgWidth = this.width;
					if (imgWidth < 400)
					{
						done("يجب أن يزيد عرض الصورة عن 400px");
					}
					else
					{
						done();
						startedUploading = true;
						$("#done").css("display", "block");
					}
				};
			});
			reader.readAsDataURL(file);
		}
	};
</script>
</body>
</html>
