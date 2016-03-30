<?php $this->load->view("header"); ?>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-62">
			<div class="main-title">
				<h1>إدارة المستخدمين</h1>
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
									<th>الاسم</th>
									<th>إسم الدخول</th>
									<th class="tables-15-width-th">التفاصيل</th>
									<th class="tables-15-width-th">تعديل</th>
									<th class="tables-15-width-th">حذف</th>
								</tr>
							</thead>
							<tbody class="tbody_admin">
								<?php if (isset($users)): ?>
								<?php foreach ($users as $user): ?>
								<tr>
									<td><?= $user["id"]; ?></td>
									<td class="tables-centered-both-td"><?= $user["name"]; ?></td>
									<td class="tables-centered-both-td"><?= $user["username"]; ?></td>
									<td>
										<a onclick="viewInModal('users/view/<?= $user['id']; ?>');" href="javascript:void(null);">
											<button class="btn btn-primary btn-font tables-full-width-btn" data-toggle="modal" data-target=".bs-example-modal-lg" type="button">التفاصيل</button>
										</a>
									</td>
									<td>
										<a href="<?= site_url(); ?>users/edit/<?= $user['id']; ?>">
											<button class="btn btn-warning btn-font tables-full-width-btn" type="button">تعديل</button>
										</a>
									</td>
									<td>
										<a onclick="alertDelete('users/delete/<?= $user['id']; ?>', 'هل أنت متأكد من حذف هذا المستخدم؟');" href="javascript:void(null);">
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
</body>
</html>
