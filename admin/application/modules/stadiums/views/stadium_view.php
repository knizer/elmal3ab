<div class="widget-area" style="margin-top: 0px;">
	<div class="col-md-122" style="padding: 20px; margin-bottom: 30px; background-color: #EEE;">
        <?php if ( ! empty($stadium)): ?>
    		<div class="col-md-62">
        		<h4>
        			<span class="fon-bo-ba">اسم الملعب:</span>
        			<span class="fon-rg-ba"><?= $stadium['title']; ?></span>
        		</h4>
        		<h4>
        			<span class="fon-bo-ba">العنوان:</span>
        			<span class="fon-rg-ba"><?= $stadium['address']; ?></span>
        		</h4>
                <h4>
                    <span class="fon-bo-ba">نوع الأرض:</span>
                    <span class="fon-rg-ba"><?= $stadium['ground_type']; ?></span>
                </h4>
        		<h4>
        			<span class="fon-bo-ba">تاريخ الإدخال: </span>
        			<span class="fon-rg-ba"><?= $stadium['created_date']; ?></span>
        		</h4>
        		<h4>
        			<span class="fon-bo-ba">الحالة:  </span>
                    <?php if ($stadium['published'] == 0):?>
                        <span class="fon-rg-ba" style="color: red;">غير منشور</span>
                    <?php else:?>
                        <span class="fon-rg-ba" style="color: green;">منشور</span>
                    <?php endif; ?>
        		</h4>
            </div>
        	<div class="col-md-62" style="position: relative; left: 14px;">
    			<img src="<?= MID_IMG . $stadium['image']; ?>">
            </div>
    <?php endif; ?>
	</div>
</div>
