<?php $this->load->view("header"); ?> 

<div class="container">
	<div class="col-md-12">
		<div class="main-title">
			<h1>تغيير كلمة السر</h1>
		</div>
	</div>
	<div class="row">
		<div class="masonary-grids">
			<div class="col-md-12">
				<div class="widget-area">
                    <div class="wizard-form-h">
						<?php if (isset($status)): ?> 
							<div class="col-md-122" style="margin-bottom: 10px;">
								<?= $status; ?> 
							</div>
						<?php endif; ?> 
						<div class="col-md-122">
							<form action="" method="post">
								<div class="inline-form">
									<label class="c-label">كلمة السر الجديدة *</label>
									<input type="password" name="password" required />
								</div>
								<div class="inline-form">
									<label class="c-label">تأكيد كلمة السر الجديدة *</label>
									<input type="password" name="confirm_password" required />
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