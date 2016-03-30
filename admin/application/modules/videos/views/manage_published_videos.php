<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12" style="margin-bottom: 30px;">
		<div class="main-title">
			<h1>إدارة الفيديوهات</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div style="position: relative; width: 100%;">
					<a class="tabs-area" href= "<?= ROOT; ?>videos/unpublished">
						<i class="icon-ty"><?php echo $unpublished_count ?> </i>غير منشور
					</a>
					<a class="tabs-area" id="bottom-zero">
						 منشور
					</a>
				</div>
                <div class="widget-area" style="margin-top: 0;">
					<?php if ($this->session->flashdata("status")): ?>
						<div class="col-md-122" id="status" style="background-color: #EEE; padding: 10px; margin-bottom: 15px;"><p class="success-msg"><?= $this->session->flashdata("status"); ?></p></div>
					<?php endif; ?>

					   <div class="col-md-5" >
						<form class="search" id="search_by" style="  margin-top: -2%;margin-left: 800px;">
							<input type="text" class="serch_txt" name="search" value="<?php if (!is_numeric($this->uri->segment(3))) echo urldecode($this->uri->segment(3)) ?>" placeholder="بحث" />
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="streaming-table" style="padding-top: 0px; margin-top: 0px;">
						<span id="found" class="label label-info"></span>
						<table id="stream_table" class='table table-striped table-bordered test'>
							<thead>
								<tr>
									<th>ID</th>
									<th>الفيديو</th>
									<th>التحكم</th>
								</tr>
							</thead>
							<tbody class="tbody_admin">
								<?php if (isset($videos)): ?>
								<?php foreach ($videos as $video_item): ?>
									<tr>
										<td><?= $video_item->id; ?></td>
										<td>
											<img class="img-mang-arti" src="<?= IMG_ARCHIVE . "647x471/" . $video_item->image; ?>" />
											<div class="des-sum-arti">
												<p class="p-title-14"><?= $video_item->title; ?></p>
												<p class="p-desc-ription"><?= mb_substr($video_item->breif, 0, 170, "utf-8"); ?></p>
                                                <div style="width: 650px; height: 20px; overflow: hidden; float: right; display: table;">
													<p class="sub-menus"><?= $video_item->section_name; ?></p>
													<p class="sub-menus">كتب: <?= $video_item->author; ?></p>
													<p class="sub-menus"> منذ: <?= $video_item->published_at; ?></p>
                                                </div>
											</div>
										</td>
										<td>
											<a onclick="viewInModal('videos/view/<?= $video_item->id; ?>');" href="javascript:void(null);">
												<button class="btn btn-primary btn-font tables-full-width-btn" data-toggle="modal" data-target=".bs-example-modal-lg" type="button"> التفاصيل</button>
											</a>
											<a href="<?= ROOT; ?>videos/edit/<?= $video_item->id; ?>">
												<button class="btn btn-warning btn-font new-width" type="button">تعديل</button>
											</a>
											<a onclick="alertDelete('videos/delete/<?= $video_item->id; ?>', 'هل أنت متأكد من حذف هذا الفيديو؟');" href="javascript:void(null);">
												<button class="btn btn-danger btn-font new-width" type="button" >حذف</button>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>

								<?php endif; ?>
							</tbody>
						</table>
						<div class="pagination-news">
                            <?= $paging; ?>
                        </div>
					</div>

					<!-- Empty modal -->
					<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content"></div>
						</div>
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
<script>
	$(document).ready(function() {
		$("#section_id").on("change", function() {
			if (this.value == 0)
			{
				window.location.href = "<?= ROOT; ?>news/unpublished_news";
			}
			else
			{
				window.location.href = "<?= ROOT; ?>news/unpublished_news/" + this.value;
			}
		});
	});


$("#search_by").submit(function(event) {
	event.preventDefault();
	window.location.href = "<?php echo ROOT ?>videos/published/"+$('.serch_txt').val()+"/<?php echo (int) $this->uri->segment(4) ?>";
});
</script>
</body>
</html>
