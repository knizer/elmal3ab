<?php $this->load->view("header"); ?>

<div class="container">
    <div class="col-md-12">
		<div class="col-md-62">
			<div class="main-title">
				<h1>إدارة الملاعب</h1>
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
									<th>Title</th>
									<th class="custom-width">Control</th>
								</tr>
							</thead>
							<tbody class="tbody_admin">
								<?php if (isset($stadiums)): ?>
								<?php foreach ($stadiums as $stadiums_item): ?>
                                    <tr>
                                        <td><?= $stadiums_item['id']; ?></td>
                                        <td>
                                            <img class="img-mang-arti" src="<?= IMG_ARCHIVE . "647x471/" . $stadiums_item['image']; ?>" />
                                            <div class="des-sum-arti">
                                                <p class="p-title-14"><?= $stadiums_item['title']; ?></p>
                                                <div style="width: 650px; height: 20px; overflow: hidden; float: right; display: table;">
                                                    <p class="sub-menus"> منذ: <?= $stadiums_item['published_at']; ?></p>
                                                    <?php if ($stadiums_item['published'] == 1): ?>
                                                        <p class="p-title-14" style="color: green;margin-top:14px;">منشور</p>
                                                    <?php elseif ($stadiums_item['published'] == 0): ?>
                                                        <p class="p-title-14" style="color: red;margin-top:14px;">غير منشور</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a onclick="viewInModal('stadiums/view/<?= $stadiums_item['id']; ?>');" href="javascript:void(null);">
                                                <button class="btn btn-primary btn-font tables-full-width-btn" data-toggle="modal" data-target=".bs-example-modal-lg" type="button"> التفاصيل</button>
                                            </a>
                                            <a href="<?= ROOT; ?>stadiums/edit/<?= $stadiums_item['id']; ?>">
                                                <button class="btn btn-warning btn-font new-width" type="button">تعديل</button>
                                            </a>
                                            <a onclick="alertDelete('stadiums/delete/<?= $stadiums_item['id']; ?>', 'هل أنت متأكد من حذف هذا الفيديو؟');" href="javascript:void(null);">
                                                <button class="btn btn-danger btn-font new-width" type="button" >حذف</button>
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
                <!-- Empty modal -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"></div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div><!-- Page Container -->
<?php $this->load->view("footer"); ?>
