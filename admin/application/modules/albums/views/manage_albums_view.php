<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-62">
			<div class="main-title">
				<h1>إدارة الألبومات</h1>
			</div>
		</div>
		<div class="col-md-62" style="position: relative; top: 10px; right: 30px;">
			<form action="" method="post" class="search">
				<input type="text" name="search" placeholder="بحث" required autofocus />
				<button name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
					<?php if ($this->session->flashdata("status")): ?>
						<div class="col-md-122" id="status" style="background-color: #EEE; padding: 10px;"><p class="success-msg"><?= $this->session->flashdata("status"); ?></p></div>
					<?php endif; ?>
					<div class="streaming-table">
						<span id="found" class="label label-info"></span>
						<table id="stream_table" class='table table-striped table-bordered'>
							<thead>
								<tr>
									<th>ID</th>
									<th>الألبوم</th>
									<th class="custom-width">التحكم</th>
								</tr>
							</thead>
							<tbody class="tbody_admin">
								<?php if (isset($albums)): ?>
								<?php foreach ($albums as $album): ?>
								<tr>
									<td><?= $album["id"]; ?></td>
									<td class="tables-padded-td">
										<img src="<?= IMG_ARCHIVE . '622x307/' . $album['main_image']; ?>" alt="<?= $album['title']; ?>"
											 style="width: 200px; height: 120px; float: right; margin-top: 15px; margin-left: 25px;" />
										<div style="float: right; width: 70%;">
											<h3><?= $album["title"]; ?></h3>
											<h4>تصوير: <?= ( ! is_null($album["photographer"])) ? $album["photographer"] : "<span style='color: red;'>غير محدد</span>"; ?></h4>
											<h4>منذ: <?= $album["created_at"]; ?></h4>
											<?php if ($album["published"] == 1): ?>
												<h4 style="color: green;">منشور</h4>
											<?php elseif ($album["published"] == 0): ?>
												<h4 style="color: red;">غير منشور</h4>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<a href="<?= ROOT; ?>albums/view/<?= $album['id']; ?>">
											<button class="btn btn-primary btn-font tables-full-width-btn" type="button">عرض</button>
										</a>
										<a href="<?= ROOT; ?>albums/edit/<?= $album['id']; ?>">
											<button class="btn btn-warning btn-font tables-full-width-btn" type="button">تعديل</button>
										</a>
										<a onclick="alertDelete('albums/delete/<?= $album['id']; ?>', 'هل أنت متأكد من حذف هذا الألبوم؟');" href="javascript:void(null);">
											<button class="btn btn-danger btn-font tables-full-width-btn" type="button" >حذف</button>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>

					<?php if (isset($pagination)): ?>
						<div class="pagination-news">
							<?= $pagination; ?>
						</div>
					<?php endif; ?>

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
