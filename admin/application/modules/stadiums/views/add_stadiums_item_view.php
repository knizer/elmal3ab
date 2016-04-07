<?php $this->load->view("header"); ?>

<div class="container">
    <div class="col-md-12">
        <div class="main-title">
            <h1>إضافة ملعب جديد</h1>
        </div>
    </div>
    <div class="row">
        <div class="masonary-grids">
            <form action="" method="post" enctype="multipart/form-data" id="insert-form">
                <div class="col-md-12">
                    <div class="widget-area">
                        <?php if (isset($status)): ?>
                            <div style="margin-bottom: 30px;"><?= $status; ?></div>
                        <?php endif; ?>
                        <div class="inline-form">
                            <label class="c-label">اسم الملعب *</label>
                            <input type="text" name="title"
                                   value="<?= trim(@$_POST["title"]); ?>" required autofocus />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">تفاصيل الملعب *</label>
                            <input type="text" name="description"
                                   value="<?= trim(@$_POST["description"]); ?>" required autofocus />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">عنوان الملعب *</label>
                            <input type="text" name="address"
                                   value="<?= trim(@$_POST["address"]); ?>" required />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">التليفون</label>
                            <input type="tel" name="phone"
                                   value="<?= trim(@$_POST["phone"]); ?>" required />
                        </div>
                        <div>
                            <div class="inline-form inline-form2 input-group" id='datetimepicker3'>
                                <label class="c-label">ساعات العمل من *</label>
                                <input type="text" class="form-control" name="workhours_from"
                                value="<?= trim(@$_POST["workhours_from"]); ?>" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            <div class="inline-form inline-form2 input-group" id='datetimepicker4'>
                                <label class="c-label">ساعات العمل إلى *</label>
                                <input type="text" class="form-control" name="workhours_to"
                                value="<?= trim(@$_POST["workhours_to"]); ?>" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="inline-form">
                            <label class="c-label">نوع الأرض *</label>
                            <input type="text" name="ground_type"
                                   value="<?= trim(@$_POST["ground_type"]); ?>" required />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">سعر الساعة *</label>
                            <input type="number" name="hour_price"
                                   value="<?= trim(@$_POST["hour_price"]); ?>" required />
                        </div>
                        <div class="inline-form">
                            <button id="add_main_image_btn" data-toggle='modal' data-target='.add-image-modal'
                            class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px; width: 150px;">إضافة صورة رئيسية
                            </button>
                            <input type="hidden" name="main_img" id="main_img" value="<?php if (isset($_POST['main_img'])) echo $_POST['main_img']; ?>"required />
                            <div id="img-div">
                                <?php if (isset($_POST["main_img"])): ?>
                                    <img src="<?= SMALL_IMG . $_POST['main_img']; ?>" width="220" height="110" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="inline-form">
                            <button id="add_main_album_btn" data-toggle='modal' data-target='.add-image-modal' class="btn btn-primary btn-font"
                                 type="button" style="margin-bottom: 10px; width: 150px;">إضافة ألبوم رئيسي</button>
                            <div id="album-sec">
                                <input type="hidden" name="main_album" id="main_album" value="<?= @$_POST['main_album']; ?>" />
                                <button type="button" class="fa fa-remove remove-img-btn main-btn-clear" style='position: inherit;display:none'></button>
                                <div id="main-album-div">
                                    <?php if (isset($_POST["main_album"])): ?>
                                        <?php
                                        $album = explode('&', $_POST['main_album']);
                                        $album_img = $album[1];
                                        ?>
                                        <img src="<?= SMALL_IMG . $album_img; ?>" width="220" height="110">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div><button id="add_main_video_btn" data-toggle='modal' data-target='.add-image-modal' class="btn btn-primary btn-font"
                                 type="button" style="margin-bottom: 10px; width: 150px;">إضافة فيديو رئيسي</button></div>
                            <div id="video-sec">
                                <input type="hidden" name="main_video" id="main_video" value="<?= @$_POST['main_video']; ?>" />
                                <button type="button" class="fa fa-remove remove-img-btn main-btn-clear" style='position: inherit;display:none'></button>
                                <div id="main-video-div">
                                    <?php if (isset($_POST["main_video"]) && ! empty($_POST["main_video"])): ?>
                                        <?php
                                            $video_url = explode(':', $_POST['main_video']);
                                            $video_url_val = $video_url[1];
                                            $video_url_link = ($video_url[2] == 0) ? "https://www.youtube.com/embed/" : "//www.dailymotion.com/embed/video/";
                                        ?>
                                        <iframe frameborder="0" width="220" height="110" src="<?= $video_url_link . $video_url_val; ?>"></iframe>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php if (isset($_POST["publish"])): ?>
                                        <input type="checkbox" name="publish" value="1" checked />
                                    <?php else: ?>
                                        <input type="checkbox" name="publish" value="1" />
                                    <?php endif; ?>
                                </span>
                                <p class="form-control">نشر</p>
                            </div>
                        </div>
                        <input type="submit" name="submit_btn" value="حفظ"
                               class="btn btn-success btn-font" style="margin-top: 20px; width: 10%;" />
                    </div>

                    <!-- Empty modal -->
					<div id="list-modal" class="modal fade add-image-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg custom-modal-list-images modal-new">
							<div class="modal-content" id="list-modal-content">
                                <iframe id="modal-iframe" src='' class='list-iframe'></iframe>
                                <!-- Custom Lists (Images, Albums, and Videos) -->
                                <?php $this->load->view('custom-lists');?>
                                <!-- End Custom Lists (Images, Albums, and Videos) -->
                            </div>
						</div>
					</div>
                    <!-- End Empty modal -->
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("footer"); ?>
