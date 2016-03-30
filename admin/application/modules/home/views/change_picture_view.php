<?php $this->load->view("header"); ?> 

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>تغيير صورة المستخدم</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
                    <div class="wizard-form-h">
						<?php if (isset($status)): ?> 
							<div class="col-md-122" style="margin-bottom: 20px;">
								<?= $status; ?> 
							</div>
						<?php endif; ?>
						
						<?php if ($this->session->flashdata("status")): ?> 
							<div class="col-md-122" id="status" style="background-color: #EEE; padding: 10px; margin-bottom: 20px;"><?= $this->session->flashdata("status"); ?></div>
						<?php endif; ?> 
						<div class="col-md-122">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="image-crop">
									<h2 class="StepTitle">الصورة الجديدة</h2>
									<div class="bbody">
										<!-- hidden crop params -->
										<input type="hidden" id="x1" name="x1">
										<input type="hidden" id="y1" name="y1">
										<input type="hidden" id="w" name="w" />
										<input type="hidden" id="h" name="h" />
										<h3>Step1: Please select image file</h3>
										<div>
											<input type="file" name="picture" id="image_file" onchange="fileSelectHandler()" required />
										</div>
										<div class="step255">
											<h3 style="padding-top: 45px;">Step2: Please select a crop region</h3>
											<img id="preview" />
										</div>
									</div>
								</div>
								<div class="col-md-122" style="margin-top: 15px;">
									<input type="submit" name="submit" value="حفظ" class="btn btn-success btn-font" />
								</div>
							</form>
						</div>
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