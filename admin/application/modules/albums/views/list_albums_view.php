<?php $this->load->view("head.php"); ?>
<body>
	<div class="row">
		<div class="col-md-62" style="position: relative; top: 8px; right: 480px;">
			<form action="" method="post" class="search">
				<input type="text" name="search" placeholder="بحث" required autofocus />
				<button name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="widget-area" style="padding-right: 50px;">
			<div class="col-md-122">
				<?php if (isset($albums)): ?>
				<?php foreach ($albums as $album): ?>
					<div class="archive-img-div" style="margin-bottom: 25px;">
						<?php if ($album['old_album'] == 0): ?>
							<img class="archive-img" src="<?= IMG_ARCHIVE . '622x307/' . $album['main_image'] . '?' . filemtime(IMG_ARCHIVE_PATH . '622x307/' . $album['main_image']); ?>"
								 width="180" height="100" id="<?= $album['id']; ?>&<?= $album['main_image']; ?>" />
						<?php else: ?>
							<img class="archive-img" src="<?= OLD_IMG_ARCHIVE . $album['main_image'] . '?' . filemtime(IMG_ARCHIVE_PATH . '622x307/' . $album['main_image']); ?>"
								 width="180" height="100" id="<?= $album['id']; ?>&<?= $album['main_image']; ?>" />
						<?php endif; ?>
						<div>
							<span style="margin: 0px 6px;" title="<?= $album['title']; ?>"><?= trim(mb_substr($album["title"], 0, 16, "utf-8")); ?></span>|<span style="float: left; margin: 0px 6px;">منذ: <?= $album["created_at"]; ?></span>
						</div>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>

				<?php if (isset($pagination)): ?>
					<div style="float: left; direction: ltr; font-weight: bold; font-size: 18px; margin-top: 10px; margin-left: 22px;">
						<?= $pagination; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<script>
		$(".archive-img").click(function() {
			var album = $(this).attr("id");
			window.document.title = album;
			window.close();
		});
	</script>
</body>
</html>
