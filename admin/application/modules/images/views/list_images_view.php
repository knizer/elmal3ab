<?php $this->load->view("head.php"); ?>
<body>
	<div class="row">
		<div class="col-md-62" style="float: right;  position: relative; top: 18px; right: 50px;">
			<a class="btn btn-primary btn-font" href="<?= ROOT; ?>images/add/mini">إضافة صورة جديدة</a>
		</div>
		<div class="col-md-62" style="float: right; position: relative; top: 4px; left: 28px;">
			<form action="" method="post" class="search">
				<input type="text" name="search" placeholder="بحث" required autofocus />
				<button name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="widget-area" style="padding-right: 50px;">
			<div class="col-md-122">
				<?php if (isset($images)): ?>
				<?php foreach ($images as $image): ?>
					<div class="archive-img-div" style="margin-bottom: 25px; position: relative;">
                        <img src="<?= IMG_ARCHIVE . '279x305/' . $image['name'] . '?' . @filemtime(IMG_ARCHIVE_PATH . '279x305/' . $image['name']); ?>"
							 id="<?= $image['id']; ?>&<?= $image['name']; ?>"/>
						<div>
							<span style="margin: 0px 6px;" title="<?= $image['description']; ?>"><?= mb_substr($image["description"], 0, 6, "utf-8"); ?></span>|<span style="float: left; margin: 0px 6px;">منذ: <?= $image["uploaded_at"]; ?></span>
						</div>
						<a style="margin-right: auto">
							<button class="btn btn-warning mini btn-font add-img-btn" style="width: 80px;" id="<?= $image['id']; ?>&<?= $image['name']; ?>&<?= $image['description']; ?>" type="button">إضافة</button>
						</a>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>

				<?php if (isset($pagination)): ?>
					<div class="pagination-news" style="margin-top: 18px;">
						<?= $pagination; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$(".add-img-btn").click(function() {
				var image = $(this).attr("id");
				window.document.title = image;
				window.close();
			});
		});
	</script>
</body>
</html>
