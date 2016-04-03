<?php $this->load->view("header"); ?>

<div class="container">
    <div class="col-md-12">
        <div class="main-title">
            <h1>تعديل ملعب</h1>
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
                                   value="<?= $stadiums_item["title"]; ?>" required autofocus />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">عنوان الملعب *</label>
                            <input type="text" name="address"
                                   value="<?= $stadiums_item["address"]; ?>" required />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">التليفون</label>
                            <input type="tel" name="phone"
                                   value="<?= $stadiums_item["phone"]; ?>" required />
                        </div>
                        <div>
                            <?php $workhours_from = explode(":", $stadiums_item['workhours_from']); ?>
                            <div class="inline-form inline-form2">
                                <label class="c-label">ساعات العمل من *</label>
                                <input type="nuber" name="workhours_from"
                                       value="<?= $workhours_from[1]; ?>" required />
                            </div>
                            <div class="inline-form inline-form2">
                                <label class="c-label">الفترة *</label>
                                <select class="from" name="workhours_from_time" style="height: 37px;">
                                        <option value="0" <?php if ($workhours_from[0] == 0) echo "selected";?>>ص</option>
                                        <option value="1" <?php if ($workhours_from[0] == 1) echo "selected";?>>م</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <?php $workhours_to = explode(":", $stadiums_item['workhours_to']); ?>
                            <div class="inline-form inline-form2">
                                <label class="c-label">ساعات العمل إلى *</label>
                                <input type="number" name="workhours_to"
                                       value="<?= $workhours_to[1]; ?>" required />
                            </div>
                            <div class="inline-form inline-form2">
                                <label class="c-label">الفترة *</label>
                                <select class="from" name="workhours_to_time" style="height: 37px;">
                                    <option value="0" <?php if ($workhours_to[0] == 0) echo "selected";?>>ص</option>
                                    <option value="1" <?php if ($workhours_to[0] == 1) echo "selected";?>>م</option>
                                </select>
                            </div>
                        </div>
                        <div class="inline-form">
                            <label class="c-label">نوع الأرض *</label>
                            <input type="text" name="ground_type"
                                   value="<?= $stadiums_item["ground_type"]; ?>" required />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">سعر الساعة *</label>
                            <input type="number" name="hour_price"
                                   value="<?= $stadiums_item["hour_price"]; ?>" required />
                        </div>
                        <div class="inline-form">
                            <button id="add_main_image_btn" class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px;">صورة الملعب</button>
                            <input type="hidden" name="main_img" id="main_img" value="<?= $stadiums_item['image']; ?>" />
                            <div id="img-div">
                                <img src="<?= IMG_ARCHIVE . '647x471/' . $stadiums_item['image']; ?>" width="220" height="110" />
                            </div>
                        </div>
                        <div class="inline-form">
                            <div><button id="add_main_video_btn" class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px; width: 150px;">إضافة فيديو رئيسي</button></div>
                            <input type="hidden" name="main_video" id="main_video" value="<?= $stadiums_item['video_link']; ?>" />
                            <div id="main-media-div">
                                <?php if (isset($stadiums_item['video_link']) && ($stadiums_item['video_link'] != 0)): ?>
                                    <?php
                                    $video_url = explode(':', $stadiums_item['video_link']);
                                    $video_url_ = $video_url[1];
                                    ?>
                                    <iframe frameborder="0" width="220" height="110" src="<?php if ($video_url[2] == 0): echo"https://www.youtube.com/embed/";
                                else: echo"//www.dailymotion.com/embed/video/";
                                endif; ?><?= $video_url_; ?>"></iframe>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php if ($stadiums_item["published"] == 1): ?>
                                        <input type="checkbox" name="publish" value="1" checked />
                                    <?php else: ?>
                                        <input type="checkbox" name="publish" value="1" />
                                    <?php endif; ?>
                                </span>
                                <p class="form-control">نشر</p>
                            </div>
                        </div>
                        <input type="submit" name="submit_btn" value="حفظ" class="btn btn-success btn-font" style="margin-top: 20px; width: 10%;" />
                    </div>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                this_window_title = window.document.title;

                // Choosing main image code
                $("#add_main_image_btn").click(function () {
                    images_window = window.open("<?= ROOT; ?>images/list_images", "_blank", "titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, top=0, left=0, width=1050, height=" + window.innerHeight);
                    var timer = setInterval(check_window_close, 500);

                    function check_window_close() {
                        image = images_window.document.title;
                        if (images_window.closed)
                        {
                            // Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
                            if (image != this_window_title)
                            {
                                // Stop the timer
                                clearInterval(timer);

                                var result = image.split('&');

                                // Set the hidden input value to the video name
                                $("#main_img").val(result[1]);
                                var html = "<img src='<?= IMG_ARCHIVE; ?>647x471/" + result[1] + "' width='220' height='110'>";

                                $('#img-div').html(html);
                            }
                        }
                    }
                });

                // Choosing main video code
                $("#add_main_video_btn").click(function () {
                    videos_window = window.open("<?= ROOT; ?>videos/list_videos", "_blank", "titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, top=0, left=0, width=1050, height=" + window.innerHeight);
                    var timer = setInterval(check_window_close, 500);

                    function check_window_close() {
                        video = videos_window.document.title;

                        if (videos_window.closed)
                        {
                            // Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
                            if (video != this_window_title)
                            {
                                // Stop the timer
                                clearInterval(timer);

                                var result = video.split(':');

                                // Set the hidden input value to the video name
                                $("#main_video").val(video);
                                if (result[2] == 0)
                                    var html = "<iframe frameborder='0' width='220' height='110' src='https://www.youtube.com/embed/" + result[1] + "'></iframe>";
                                else
                                    var html = "<iframe frameborder='0' width='220' height='110' src='//www.dailymotion.com/embed/video/" + result[1] + "'></iframe>";

                                $('#main-media-div').html(html);
                                $(".del_btn").css('display', 'block');
                            }
                        }
                    }
                });

            });
        </script>
    </div>
</div>
<?php $this->load->view("footer"); ?>
