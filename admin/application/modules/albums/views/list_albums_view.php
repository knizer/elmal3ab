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
                        <img class="archive-img" src="<?= SMALL_IMG . $album['main_image'] . '?' . filemtime(SMALL_IMG_PATH . $album['main_image']); ?>"
                        width="180" height="100" id="<?= $album['id']; ?>&<?= $album['main_image']; ?>" />
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
			parent.get_album_value(album);
		});
	</script>
</body>
</html>
