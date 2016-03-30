<div class="widget-area" style="margin-top: 0px;">
	<div class="col-md-122" style="padding: 20px; margin-bottom: 30px; background-color: #EEE;">
		<div class="col-md-62" style="position: relative; right: 120px;">
			<?php if ($video->video_type == 0): ?>
				<center><iframe frameborder="0" width="480" height="270" src="https://www.youtube.com/embed/<?=$video->link ?>" allowfullscreen></iframe></center>
			<?php else: ?>
				<center><iframe width="560" height="315" src="//www.dailymotion.com/embed/video/<?=$video->link ?>" frameborder="0" allowfullscreen></iframe></center>
			<?php endif; ?>
		</div>
	</div>
	<div class="fon-bo-y">
		<?= $video->description; ?>
	</div>
</div>
