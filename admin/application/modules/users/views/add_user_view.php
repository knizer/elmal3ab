<?php $this->load->view("header"); ?> 

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>مستخدم جديد</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
                    <div class="wizard-form-h">
						<form action="" method="post" enctype="multipart/form-data">
							<?php if (isset($status)): ?> 
								<div class="col-md-122" style="margin-top: -20px;">
									<?= $status; ?> 
								</div>
							<?php endif; ?> 
							<div class="col-md-62">
								<div class="inline-form">
									<label class="c-label">الإسم *</label>
									<input type="text" name="name" value="<?php if (isset($_POST['name'])) echo htmlspecialchars(trim($_POST['name'])); ?>" required autofocus />
								</div>
							</div>
							<div class="col-md-62">
								<div class="inline-form" style="height: 40px;">
									<label class="c-label">المجموعة *</label>
									<select name="group_id" required>
										<option value=""></option>
										<?php if (isset($groups)): ?> 
										<?php foreach ($groups as $group): ?> 
											<?php if (isset($_POST["group_id"]) && $group["id"] == $_POST["group_id"]): ?> 
												<option value="<?= $group['id']; ?>" selected><?= $group['name']; ?></option>
											<?php else: ?> 
												<option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
											<?php endif; ?> 
										<?php endforeach; ?> 
										<?php endif; ?> 
									</select>
								</div>
							</div>
							<div class="col-md-122">
								<div class="inline-form">
									<label class="c-label">إسم المستخدم *</label>
									<input type="text" name="username" value="<?php if (isset($_POST['username'])) echo htmlspecialchars(trim($_POST['username'])); ?>" required />
								</div>
							</div>
							<div class="col-md-62">
								<div class="inline-form">
									<label class="c-label">كلمة السر *</label>
									<input type="password" name="password" required />
								</div>
							</div>
							<div class="col-md-62">
								<div class="inline-form">
									<label class="c-label">تأكيد كلمة السر *</label>
									<input type="password" name="confirm_password" required />
								</div>
							</div>
							<div class="col-md-62">
								<div class="inline-form">
									<label class="c-label">الموبايل</label>
									<input type="text" name="mobile" value="<?php if (isset($_POST['mobile'])) echo htmlspecialchars(trim($_POST['mobile'])); ?>" />
								</div>
							</div>
							<div class="col-md-62">
								<div class="inline-form">
									<label class="c-label">البريد الالكترونى</label>
									<input type="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars(trim($_POST['email'])); ?>" />
								</div>
							</div>
							<div class="col-md-122">
								<div class="image-crop" style="margin-top: 20px;">
									<h2 class="StepTitle">الصورة</h2>
									<div class="bbody">
										<!-- hidden crop params -->
										<input type="hidden" id="x1" name="x1">
										<input type="hidden" id="y1" name="y1">
										<input type="hidden" id="w" name="w" />
										<input type="hidden" id="h" name="h" />
										<h3>Step1: Please select image file</h3>
										<div>
											<input type="file" name="picture" id="image_file" onchange="fileSelectHandler()" />
										</div>
										<div class="step255">
											<h3 style="padding-top: 45px;">Step2: Please select a crop region</h3>
											<img id="preview" />
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-122" style="margin-top: 20px;">
								<input type="submit" name="submit" value="حفظ" class="btn btn-success btn-font" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //$this->load->view("slide_panel"); ?> 
</div><!-- Page Container -->
<?php $this->load->view("footer"); ?> 
</body>
</html>