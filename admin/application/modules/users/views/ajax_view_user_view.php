<div class="widget-area" style="margin-top: 0px;">
	<?php if ( ! empty($user["picture"])): ?>
		<div style="float: right;">
			<img src="<?= USER_PHOTOS . $user['picture']; ?>" alt="<?= $user['name']; ?>" />
		</div>
	<?php endif; ?>
	<div style="float: right; padding-right: 20px;">
		<h3>الإسم: <span style="color: #2083A6;"><?= $user["name"]; ?></span></h3>
		<h3>المجموعة: <span style="color: #2083A6;"><?= $user["group_name"]; ?></span></h3>
		<h3>إسم الدخول: <span style="color: #2083A6;"><?= $user["username"]; ?></span></h3>
		<h3>الموبايل: <span style="color: #2083A6;"><?= $user["mobile"]; ?></span></h3>
		<h3>الإيميل: <span style="color: #2083A6;"><?= $user["email"]; ?></span></h3>
	</div>
	<div style="clear: both;"></div>
	<button type="button" id="show-permissions" class="btn btn-primary btn-font" style="width: 130px; margin-top: 20px; margin-bottom: 10px;">عرض الصلاحيات</button>
	<div id="permissions" style="display: none;">
		<h3>الصلاحيات:</h3>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["stadiums"] == 1) echo "checked"; ?> />الملاعب</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["images_albums"] == 1) echo "checked"; ?> />الصور</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["videos"] == 1) echo "checked"; ?> />الفيديوهات</h4>
		<h4><input type="checkbox" disabled <?php if ($user_permissions["users_groups"] == 1) echo "checked"; ?> />المستخدمين</h4>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#show-permissions").click(function () {
		    $("#permissions").toggle();
		});
	});
</script>
