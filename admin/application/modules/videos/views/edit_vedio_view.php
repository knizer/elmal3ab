<?php $this->load->view("header"); ?> 

<div class="container">
    <div class="col-md-12">
        <div class="main-title">
            <h1>تعديل فيديو</h1>
        </div>
    </div>
    <div class="row">
        <div class="masonary-grids">
            <form  enctype="multipart/form-data" action="" method="post" id="insert-form">
                <input class="input-style" type="hidden" name="time_spent_creating" />
                <div class="col-md-62">
                    <div class="widget-area">
                        <?php if (isset($status)): ?>
                            <div class="col-md-122" style="margin-top: -15px;">
                                <?= $status; ?>
                            </div>
                        <?php endif; ?>
                        <div class="inline-form">
                            <label class="c-label">العنوان</label>
                            <input type="text" value="<?php if (isset($title)) echo htmlspecialchars(trim($title)); ?>"  name="video_title" required/>
                        </div>
                        <div class="inline-form">
                            <label class="c-label">عنوان سوشيال ميديا </label>
                            <input type="text" value="<?php if (isset($soc_title)) echo htmlspecialchars(trim($soc_title)); ?>" name="social_title"/>
                        </div>
                        <div class="inline-form">
                            <label class="c-label">المصور/الكاتب </label>
                            <input type="text" value="<?php if (isset($author_name)) echo htmlspecialchars(trim($author_name)); ?>" id="author" name="video_author" required/>
                        </div>
                    </div>
                    <div class="widget-area">
                        <div class="inline-form">
                            <label>الملخص </label>
                            <textarea name="breif" required style="height: 60px; resize: vertical;"><?php if (isset($breif)) echo htmlspecialchars(trim($breif)); ?></textarea>
                        </div>

                    </div>
                    <div class="widget-area">
                           <div class="col-md-122" style="float: right;">
                            <div class="inline-form">
                                 <label class="c-label">نوع الفيديو</label>
                                <select name="video_type">
                            <?php if (isset($video_type) && $video_type == 0): ?>
                                <option value="0" selected>Youtube</option>
                            <?php else: ?>
                                 <option value="0"  >Youtube</option>
                            <?php endif; ?>
                            <?php if (isset($video_type) && $video_type == 1): ?>
                                 <option value="1" selected>Dailymotion</option>
                            <?php else: ?>
                                <option value="1">Dailymotion</option>
                            <?php endif; ?>
                                    </select>


                            </div>
                        </div>
                        <div class="col-md-122" style="float: right;">
                            <div class="inline-form">
                                <label class="c-label">الرابط youtube او dailymotion</label>
                                <input type="text" value="<?php if (isset($link)) echo htmlspecialchars(trim($link)); ?>" name="video_link" required/>
                            </div>
                        </div>
                        <div class="col-md-5 widget-area" style="float: right;">
                            <div class="col-md-2" style="float: right;">
                                <button id="add_main_image_btn" class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px;">صورة الفيديو</button>
                                <input type="hidden" name="video_img" id="video_img" value="<?= $image; ?>" />
                                <div id="img-div">
                                    <img src="<?= IMG_ARCHIVE . '647x471/' . $image; ?>" width="220" height="110" />
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-62">

                    <div class="widget-area">
                        <div class="col-md-72">
                            <div class="inline-form">
                                <label class="c-label">التغطية</label>
                                <select name="coverage_id" id="coverage_id">
                                    <option value=""></option>
                                    <?php if (isset($coverages)): ?>
                                        <?php foreach ($coverages as $coverage): ?>
                                            <?php if (isset($_POST["coverage_id"]) && $_POST["coverage_id"] == $coverage["id"]): ?>
                                                <option value="<?= $coverage["id"]; ?>" selected><?= $coverage["name"]; ?></option>
                                            <?php elseif (isset($coverage_id) && $coverage_id == $coverage["id"]): ?>
                                                <option value="<?= $coverage["id"]; ?>" selected><?= $coverage["name"]; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $coverage["id"]; ?>"><?= $coverage["name"]; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <?php if ($this->session->userdata("add_coverage") == 1): ?>
                            <div class="col-md-3">
                                <input type="button" value="أضافة تغطية" class="btn btn-primary btn-font marginright-btn margin-btn" id="add_coverage_btn">
                            </div>
                        <?php endif; ?>


                    </div>

                    <div class="widget-area">
                        <div class="inline-form">
                            <label>إختيار الأقسام</label>
                            <span class="span-sections">
                                <?php
                                $sections_arr = explode(",", $this->session->userdata("open_sections"));
                                foreach ($sections as $section) {

                                    echo "<input type='checkbox' name='section[]' class='section_check' value='" . $section["id"] . "'/><p>" . $section["name"] . "</p><br>";

                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-62 clear">
                    <div class="widget-area">
                        <div class="col-md-62">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php if (isset($publish) && $publish == 1): ?>
                                        <input type="checkbox" name="publish" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="publish" value="1">
                                    <?php endif; ?>
                                </span>
                                <p class="form-control"> نشر</p>
                            </div>
                        </div>
                        <div class="col-md-62">
                            <input type="submit" name="submit" value="حفظ الفيديو" class="btn btn-success btn-font" />
                        </div>
                    </div>
                </div>
            </form>
            <?php //$this->load->view("slide_panel"); ?>
        </div><!-- Page Container -->
        <div class="modal fade bs-example-modal-lg" id="myModal_related" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;   margin-right: -45%;   top: 1%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 150%;  left: -16%;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope" style="  margin: 11px;  font-size: 26px;"></i>أختيار الأخبار </h4><div class="add_list"></div>
                    </div>
                    <div class="modal-body">
                        <div class="related_articles"></div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary btn-font"  data-dismiss="modal">
                            حفظ التغييرات
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="related_videos_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;   margin-right: -45%;   top: 1%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 150%;  left: -16%;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope" style="  margin: 11px;  font-size: 26px;"></i> إضافة فيديوهات متعلقة</h4><div class="add_list"></div>
                    </div>

                    <div class="modal-body">
                        <div class="related_videos_content"></div>
                    </div>
                    <div class="modal-footer" style="border-top:none; ">
                        <button type="button" class="btn btn-default btn-font" data-dismiss="modal">
                            إغلاق
                        </button>
                        <button type="button" class="btn btn-primary btn-font" id="save_rvideos_btn">
                            حفظ التغييرات
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" id="add_coverage_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;   margin-right: -45%;   top: 1%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 150%;  left: -16%;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope" style="  margin: 11px;  font-size: 26px;"></i> إضافة تغطية جديدة </h4><div class="add_list"></div>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-62">
                            <div class="inline-form sp-height">
                                <label class="c-label">إسم التغطية</label>
                                <input type="text" type="text" name="name" id="coverage_name" required autofocus />
                            </div>
                        </div>
                        <div class="col-md-62">
                            <div class="inline-form">
                                <label class="c-label"> النوع</label>
                                <select id="coverage_type">
                                    <option value="1">تغطية خاصة</option>
                                    <option value="2">ملف خاص</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-122" style="margin-top: 10px;">
                            <input type="checkbox" name="active" id="coverage_active_flag" value="1"  />
                            نشط
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="modal-footer" style="border-top:none; ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            إغلاق
                        </button>
                        <button type="button" class="btn btn-primary" id="save_coverage_btn">
                            حفظ التغييرات
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("footer"); ?>
        <script>

            $(document).ready(function () {

                var users = [
<?php if (isset($users)): ?>
    <?php foreach ($users as $user): ?>
        <?= "\"" . $user["name"] . "\"" . ","; ?>
    <?php endforeach; ?>
<?php endif; ?>
                ];
                        $("#author").autocomplete({source: users});
                $("#photography").autocomplete({source: users});
            });
        </script>
        <script>
            tinymce.init({
                selector: "textarea#tinymce-content",
                theme: "modern",
                height: 400,
                directionality: "rtl",
                language: "ar",
                menubar: false,
                content_css: "<?= ASSETS; ?>css/content.css",
                plugins: [
                    "preview searchreplace fullscreen wordcount charcount paste link"
                ],
                toolbar: "searchreplace | undo redo | bold | bullist numlist | preview | link | fullscreen",
                paste_as_text: true,
                setup: function (ed) {
                    ed.on('blur', function (e) {
                        $.post('<?php echo ROOT ?>/news/getTags', {string: ed.getContent()}, function (data) {
                            // alert(data);
                            $('#tags').val(data);
                        }); //--end post
                    });
                }
            });
        </script>
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
                                $("#video_img").val(result[1]);
                                var html = "<img src='<?= IMG_ARCHIVE; ?>647x471/" + result[1] + "' width='220' height='110'>";

                                $('#img-div').html(html);
                            }
                        }
                    }
                });

                // Ensure user chooses image
                $("#submit_form").click(function (e) {
                    if ( ! $("input[name=video_img]").val())
                    {
                        e.preventDefault();
                        swal("لم تقوم بإختيار صورة الفيديو");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#datetimepicker').datetimepicker();

                $("#datepicker").datepicker();
                // Record page viewing time
                start_time = new Date();

                $("#insert-form").submit(function (ev) {
                    var elapsed = new Date() - start_time;
                    $("input[name='time_spent_creating']").val(elapsed);
                });
            });



            $("#related_modal").click(function () {
                $('.related_videos_content').html("");

                $('#myModal_related').modal('toggle');

                $.post('<?php echo ROOT ?>/related_articles/relatedArticlesForVideos', {article_id: $('#related_hidden').val()}, function (data) {
                    //	alert(data);
                    $('.related_articles').html(data);

                });//--end post


            });

//            $("#related_videos_btn").click(function () {
//
//                if ($('#tags').val() != '') {
//
//                    $('.related_articles').html("");
//                    $('#related_videos_modal').modal('toggle');
//
//                    $.post('<?php echo ROOT ?>/related_articles/relatedVideos', {tags: $('#tags').val()}, function (data) {
//
//                        $('.related_videos_content').html(data);
//                        if ($('#related_videos_hidcont').html() != '') {
//
//                            $('#destinationFields').html($('#related_videos_hidcont').html());
//                        } else {
//
//                            $.post('<?php echo ROOT ?>/related_articles/listVideosEdit', {ids: "<?php echo $related_ids ?>"}, function (data) {
//
//                                $('#destinationFields').html(data);
//                            });
//                        }
//                    });
//                } else {
//
//                    alert("من فضلك قم بكتابة الكلمات الدليلية أولاً!");
//                }
//            });

            $("#save_rvideos_btn").click(function () {
                $.post('<?php echo ROOT ?>/related_articles/checkValidations', {slected: $('#destinationFields').html()}, function (data) {


                    if (data == 0 && data != '')
                        $('.res').html("يوجد فيديوهات مكررة يرجي حذفها وإعادة المحاولة!");

                    else if (data == 1)
                        $('.res').html("من فضلك قم بإضافة 4 فيديوهات علي الأقل!");
                    else {
                        $('#related_videos_hidden').val(data);
                        $('#related_videos_hidcont').html($('#destinationFields').html());
                        $('.res').html("تم ربط الأخبار المتعلقة بالخبر قم بحفظ الخبر الأن!");
                        $('#related_videos_modal').modal('toggle');
                    }
                });//--end post

            });

            $("#add_coverage_btn").click(function () {
                $('#add_coverage_modal').modal('toggle');

            });

            $("#save_coverage_btn").click(function () {
                if ($('#coverage_name').val() && $('#coverage_type').val()) {
                    $.post('<?php echo ROOT ?>/coverages/add', {submit: "yes", name: $('#coverage_name').val(), type: $('#coverage_type').val(), active: $('#coverage_active_flag').val()}, function (data) {
                        //	alert(data);
                        $('#add_coverage_modal').modal('toggle');
                        $.post('<?php echo ROOT ?>/coverages/getAll', {}, function (data) {
                            var obj = jQuery.parseJSON(data);

                            var html = '<option value="">- اختر التغطية- </option>';
                            $.each(obj, function (index, value) {

                                html += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                            });

                            $('#coverage_id').html(html);
                        });//--end post
                    });//--end post
                } else
                    alert("جميع الحفول مطلوبة!");
                //--end if
            });
            $("#author").keyup(function () {
                $.post('<?php echo ROOT ?>/news/autocompAuthors', {}, function (data) {
                    var obj = jQuery.parseJSON(data);
                    $(function () {

                        $("#author").autocomplete({
                            source: obj
                        });
                    });
                });//--end post
            });

            $('.section_check').click(function () {
                if ($(this).is(":checked"))
                {
                    $('.section_check').attr('disabled', true);
                    $(this).attr('disabled', false);
                }
                else
                {
                    $('.section_check').attr('disabled', false);
                }
            });
            //console.log("<?php echo str_replace(array('[',']'),'', $sections_) ?>");
            if ("<?= str_replace(array('[',']'),'', $sections_); ?>" != 0)
            {
                $('input[value="<?= @str_replace(array('[',']'),'', $sections_) ?>"]').trigger("click");
                console.log('input[value="<?= @str_replace(array('[',']'),'', $sections_) ?>"]');
            }

                // Ensure user chooses image
                $("#insert-form").submit(function (e) {
                    if ( ! $("#video_img").val())
                    {
                        e.preventDefault();
                        swal("لم تقوم بإختيار صورة الفيديو");

                    }
                    else
                    {

                        $( "#insert-form" ).submit();
                    }
                });
        </script>
</body>
</html>
