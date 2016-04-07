<?php $this->load->view("header"); ?>

<div class="container">
    <div class="col-md-12">
        <div class="main-title">
            <h1>إضافة فيديو جديد</h1>
        </div>
    </div>
    <div class="row">
        <div class="masonary-grids">
            <form action="" method="post" enctype="multipart/form-data" id="insert-form">
                <input class="input-style" type="hidden" name="time_spent_creating" />

                <div class="col-md-12">
                    <div class="widget-area">
                        <?php if (isset($status)): ?>
                            <div class="col-md-122" style="margin-top: -15px;">
                                <?= $status; ?>
                            </div>
                        <?php endif; ?>
                        <div class="inline-form">
                            <label class="c-label">العنوان</label>
                            <input type="text" value="<?php if (isset($title)) echo htmlspecialchars(trim($title)); ?>" name="video_title" autofocus required />
                        </div>
                        <div class="inline-form">
                            <label class="c-label">المصور/الكاتب </label>
                            <input type="text" value="<?php if (isset($author_name)) echo htmlspecialchars(trim($author_name)); ?>" id="author" name="video_author" required />
                        </div>
                    </div>
                    <div class="widget-area">
                         <div class="col-md-122" style="float: right;">
                            <div class="inline-form">
                                <label class="c-label">نوع الفيديو</label>
                                <select name="video_type">
                                <?php if (isset($_POST['video_type']) && $_POST['video_type'] == 0): ?>
                                    <option value="0" selected>Youtube</option>
                                <?php else: ?>
                                     <option value="0">Youtube</option>
                                <?php endif; ?>
                                <?php if (isset($_POST['video_type']) && $_POST['video_type'] == 1): ?>
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
                                <button id="add_main_image_btn" data-toggle='modal' data-target='.add-image-modal'
                                class="btn btn-primary btn-font" type="button" style="margin-bottom: 10px; width: 150px;">إضافة صورة رئيسية
                                </button>
                                <input type="hidden" name="video_img" id="main_img" value="<?php if (isset($_POST['video_img'])) echo $_POST['video_img']; ?>" required />
                                <div id="img-div">
                                    <?php if (isset($_POST["main_img"])): ?>
                                        <img src="<?= SMALL_IMG . $_POST['main_img']; ?>" width="220" height="110" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 clear">
                    <div class="widget-area">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php if (isset($_POST["publish"])): ?>
                                        <input type="checkbox" name="publish" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="publish" value="1">
                                    <?php endif; ?>
                                </span>
                                <p class="form-control"> نشر</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="حفظ الفيديو" class="btn btn-success btn-font" />
                        </div>
                    </div>
                </div>
            </form>
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
                        $.post('../news/getTags', {string: ed.getContent()}, function (data) {
                            // alert(data);
                            $('#tags').val(data);
                        });
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                // this_window_title = window.document.title;
                // // Choosing main image code
                // $("#add_main_image_btn").click(function () {
                //     images_window = window.open("<?= ROOT; ?>images/list_images", "_blank", "titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, top=0, left=0, width=1050, height=" + window.innerHeight);
                //     var timer = setInterval(check_window_close, 500);
                //
                //     function check_window_close() {
                //         image = images_window.document.title;
                //         if (images_window.closed)
                //         {
                //             // Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
                //             if (image != this_window_title)
                //             {
                //                 // Stop the timer
                //                 clearInterval(timer);
                //
                //                 var result = image.split('&');
                //
                //                 // Set the hidden input value to the video name
                //                 $("#video_img").val(result[1]);
                //                 var html = "<img src='<?= IMG_ARCHIVE; ?>647x471/" + result[1] + "' width='220' height='110'>";
                //
                //                 $('#img-div').html(html);
                //             }
                //         }
                //     }
                // });

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

                $.post('../related_articles/relatedArticlesForVideos', {article_id: $('#related_hidden').val()}, function (data) {
                    //	alert(data);
                    $('.related_articles').html(data);

                });
            });


            $("#save_rvideos_btn").click(function () {
                $.post('../related_articles/checkValidations', {slected: $('#destinationFields').html()}, function (data) {
                    if (data == 0 && data != '')
                    {
                        $('.res').html("يوجد فيديوهات مكررة يرجي حذفها وإعادة المحاولة!");
                    }
                    else if (data == 1)
                    {
                        $('.res').html("من فضلك قم بإضافة 4 فيديوهات علي الأقل!");
                    }
                    else
                    {
                        $('#related_videos_hidden').val(data);
                        $('#related_videos_hidcont').html($('#destinationFields').html());
                        $('.res').html("تم ربط الفيديوهات المتعلقة بالفيديو!");
                        $('#related_videos_modal').modal('toggle');
                    }
                });
            });

            $("#add_coverage_btn").click(function () {
                $('#add_coverage_modal').modal('toggle');

            });

            $("#save_coverage_btn").click(function () {
                if ($('#coverage_name').val() && $('#coverage_type').val()) {
                    $.post('../coverages/add', {submit: "yes", name: $('#coverage_name').val(), type: $('#coverage_type').val(), active: $('#coverage_active_flag').val()}, function (data) {
                        //	alert(data);
                        $('#add_coverage_modal').modal('toggle');
                        $.post('../coverages/getAll', {}, function (data) {
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
                $.post('../news/autocompAuthors', {}, function (data) {
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

        </script>
        </body>
        </html>
