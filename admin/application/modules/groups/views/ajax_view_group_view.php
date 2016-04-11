<div class="widget-area" style="margin-top: 0px;">
	<h1 style="margin-top: 0px; margin-bottom: 20px;"><?= $group["name"]; ?></h1>
	<div class="col-md-122" style="margin-bottom: 10px;">
		<h3>- الصلاحيات:</h3>
        <h4><input type="checkbox" disabled <?php if ($group["stadiums"] == 1) echo "checked"; ?> />الملاعب</h4>
		<h4><input type="checkbox" disabled <?php if ($group["images_albums"] == 1) echo "checked"; ?> />الصور</h4>
		<h4><input type="checkbox" disabled <?php if ($group["videos"] == 1) echo "checked"; ?> />الفيديوهات</h4>
		<h4><input type="checkbox" disabled <?php if ($group["users_groups"] == 1) echo "checked"; ?> />المستخدمين</h4>
	</div>
</div>
