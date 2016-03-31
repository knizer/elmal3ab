<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-62">
			<div class="main-title">
				<h1>إدارة الصور</h1>
			</div>
		</div>
		<div class="col-md-62" style="position: relative; top: 10px; right: 50px;">
			<form action="" method="post" class="search">
				<input type="text" name="search" placeholder="بحث" required autofocus />
				<button name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="widget-area" style="padding-right: 100px;">
			<?php if ($this->session->flashdata("status")): ?>
				<div class="col-md-122" id="status" style="margin-bottom: 20px; background-color: #EEE; padding: 10px; margin-right: -10px;"><p class="success-msg"><?= $this->session->flashdata("status"); ?></p></div>
			<?php endif; ?>
			<div class="col-md-122">
				<?php if (isset($images)): ?>
				<?php foreach ($images as $image): ?>
					<div class="archive-img-div">
						<img class="archive-img" src="<?= IMG_ARCHIVE . '622x307/' . $image['name'] . '?' . @filemtime(IMG_ARCHIVE_PATH . '622x307/' . $image['name']); ?>"
							 style="width: 210px; height: 120px;" data-toggle="modal" data-target=".bs-example-modal-lg"
							 onclick="viewInModal('images/view/<?= $image['id']; ?>');" href="javascript:void(null);" />
						<div title="<?= $image['description']; ?>">
							<span style="margin: 0px 6px;"><?= trim(mb_substr($image["description"], 0, 15, "utf-8")); ?></span>|<span style="float: left; margin: 0px 6px;">منذ: <?= $image["uploaded_at"]; ?></span>
						</div>
						<div style="width: 80%; margin: 5px auto; position: relative;">
							<a target="_blank" href="<?= IMG_ARCHIVE . 'original/' . $image['name']; ?>"><i class="fa fa-external-link-square long-url-btn"
							   style="cursor: pointer; position: absolute; right: -16px; color: #333;" title="الصورة الأصلية"></i></a>
							<a href="<?= ROOT; ?>images/edit/<?= $image['id']; ?>">
								<button class="btn btn-warning mini btn-font" style="width: 80px;" type="button">تعديل</button>
							</a>
                            <a onclick="alertDelete('images/delete/<?= $image['id']; ?>', 'هل أنت متأكد من حذف هذه الصورة؟');" href="javascript:void(null);">
                                <button class="btn btn-danger mini btn-font" style="width: 80px;" type="button">حذف</button>
                            </a>
						</div>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>

				<?php if (isset($pagination)): ?>
					<div class="pagination-news" style="margin-top: 16px; margin-left: -18px;">
						<?= $pagination; ?>
					</div>
				<?php endif; ?>

				<!-- Empty modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content"></div>
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
		setTimeout(function() {
			$("#status").fadeOut(2000);
		}, 3000);
	});
</script>
</body>
</html>
