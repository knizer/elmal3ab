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
                            <div class="inline-form inline-form2">
                                <label class="c-label">ساعات العمل من *</label>
                                <input type="nuber" name="workhours_from"
                                       value="<?= trim(@$_POST["workhours_from"]); ?>" required />
                            </div>
                            <div class="inline-form inline-form2">
                                <label class="c-label">الفترة *</label>
                                <select class="from" name="workhours_from_time" style="height: 37px;">
                                    <option value="0">ص</option>
                                    <option value="1">م</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="inline-form inline-form2">
                                <label class="c-label">ساعات العمل إلى *</label>
                                <input type="number" name="workhours_to"
                                       value="<?= trim(@$_POST["workhours_to"]); ?>" required />
                            </div>
                            <div class="inline-form inline-form2">
                                <label class="c-label">الفترة *</label>
                                <select class="from" name="workhours_to_time" style="height: 37px;">
                                    <option value="0">ص</option>
                                    <option value="1">م</option>
                                </select>
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
                            <button id="add_main_image_btn" class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px;">صورة الملعب</button>
                            <input type="hidden" name="main_img" id="main_img" value="<?php if (isset($_POST['main_img'])) echo $_POST['main_img']; ?>"required />
                            <div id="img-div">
                                <?php if (isset($_POST["main_img"])): ?>
                                    <img src="<?= IMG_ARCHIVE . '647x471/' . $_POST['main_img']; ?>" width="220" height="110" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div><button id="add_main_video_btn" class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px; width: 150px;">إضافة فيديو رئيسي</button></div>
                            <input type="hidden" name="main_video" id="main_video" value="<?= @$_POST['main_video']; ?>" />
                            <div id="main-media-div">
                                <?php if (isset($_POST["main_image"]) && ! empty($_POST["main_image"])): ?>
                                    <img src="<?= IMG_ARCHIVE . '312x158/' . $_POST['main_image']; ?>" width="220" height="110">
                                <?php elseif (isset($_POST["main_video"]) && ! empty($_POST["main_video"])): ?>
                                    <?php
                                    $video_url = explode(':', $_POST['main_video']);
                                    $video_url_ = $video_url[1];
                                    ?>
                                    <iframe frameborder="0" width="220" height="110" src="<?php if ($video_url[2] == 0): echo"https://www.youtube.com/embed/";
                                else: echo"//www.dailymotion.com/embed/video/";
                                endif; ?><?= $video_url_; ?>"></iframe>
                                <?php elseif ( ! empty($_POST["main_album"]) && ! empty($_POST["main_album"])): ?>
                                    <?php
                                    $album = explode('&', $_POST['main_album']);
                                    $album_img = $album[1];
                                    ?>
                                    <img src="<?= IMG_ARCHIVE . '312x158/' . $album_img; ?>" width="220" height="110">
                                <?php endif; ?>
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

                // Ensure user chooses image
                $("#insert-form").submit(function (e) {
                    if ( ! $("#main_img").val())
                    {
                        e.preventDefault();
                        swal("لم تقوم بإختيار صورة رئيسية");

                    }
                     else
                    {

                        $( "#insert-form" ).submit();
                    }
                });
            });
        </script>
    </div>
</div>
<?php $this->load->view("footer"); ?>
