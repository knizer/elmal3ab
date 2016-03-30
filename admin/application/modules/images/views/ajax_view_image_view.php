<div class="widget-area" style="margin-top: 0px; padding: 30px;">
	<h4 style="margin-top: 0px; margin-bottom: 20px;">
		<span style="margin-left: 6px;"><?= $image["description"]; ?> |</span>
		<span style="margin-left: 6px;">رفعها: <?= $image["uploaded_by"]; ?> |</span>
		<span style="margin-left: 6px;">منذ: <?= $image["uploaded_at"]; ?> |</span>
		<span>عدد مرات إستخدامها: <?= $image["times_used"]; ?></span>
	</h4>

	<?php foreach ($image_sizes as $key => $value): ?>
		<?php if (file_exists(IMG_ARCHIVE_PATH . "$key/" . $image['name'])): ?>
			<div><img src="<?= IMG_ARCHIVE . $key . '/' . $image['name'] . '?' . filemtime(IMG_ARCHIVE_PATH . $key . '/' . $image['name']); ?>" /></div><br />
		<?php endif; ?>
	<?php endforeach; ?>

	<?php if (file_exists(IMG_ARCHIVE_PATH . "original_lower_quality/" . $image['name'])): ?>
		<div><img src="<?= IMG_ARCHIVE . 'original_lower_quality/' . $image['name'] . '?' . filemtime(IMG_ARCHIVE_PATH . 'original_lower_quality/' . $image['name']); ?>" /></div><br />
	<?php endif; ?>
</div>
