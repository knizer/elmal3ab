<?php $this->load->view("head.php"); ?>
<body>
	<div class="row">
		<div class="col-md-62" style="position: relative; top: 8px; left: 28px; float: left;">
			<form action="" method="post" class="search">
				<input type="text" name="search" placeholder="بحث" required autofocus />
				<button name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="widget-area" style="padding-right: 50px;">
			<div class="col-md-122">
				<?php if (isset($videos)): ?>
				<?php foreach ($videos as $video_item): ?>
					<div class="archive-img-div" style="margin-bottom: 25px;">
						<img class="archive-img" src="<?= IMG_ARCHIVE . '312x158/' . $video_item['image'] ; ?>"
							 width="180" height="100" style="cursor: pointer;"
							 id="<?php echo $video_item['id'] ?>:<?php echo $video_item['link'] ?>:<?php echo $video_item['video_type'] ?>" />
						<div>
							<span style="margin: 0px 6px;" title="<?= $video_item['title']; ?>"><?= trim(mb_substr($video_item["title"], 0, 16, "utf-8")); ?></span>|<span style="float: left; margin: 0px 6px;"><?php if ($video_item["published"] == 1): echo "منشور"; else: echo "غير منشور"; endif;?></span>
						</div>
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
		$(".archive-img").click(function() {
			var video_id_link = $(this).attr("id");

			window.document.title = video_id_link;
			window.close();
		});
	</script>
</body>
</html>
