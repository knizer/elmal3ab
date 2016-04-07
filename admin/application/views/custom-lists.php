<script>
$(document).ready(function() {
    $("#add_main_image_btn").click(function(){
          $("#modal-iframe").attr("src", "<?= ROOT; ?>images/list_images");
    });

    $("#add_main_album_btn").click(function(){
        $("#modal-iframe").attr("src", "<?= ROOT; ?>albums/list_albums");
    });

    $("#add_main_video_btn").click(function(){
        $("#modal-iframe").attr("src", "<?= ROOT; ?>videos/list_videos");
    });

    var original_list_modal = $("#list-modal-content").clone();
    $('#list-modal').on('hidden.bs.modal', function () {
        $(".list-iframe").attr('src', '');
    });

    // Ensure user chooses image
    $("#insert-form").submit(function (e) {
        if ( ! $("#main_img").val()) { e.preventDefault(); swal("لم تقوم بإختيار صورة رئيسية"); }
        else { $( "#insert-form" ).submit(); }
    });

    //bootstrape timepicker
    $(function () {
        $('#datetimepicker3').datetimepicker({ format: 'LT' });
        $('#datetimepicker4').datetimepicker({ format: 'LT' });
    });
    //end bootstrape timepicker
});

function get_image_value(image_val)
{
    var result = image_val.split('&');
    $("#main_img").val(result[1]);
    var html = "<img src='<?= SMALL_IMG; ?>" + result[1] + "' width='220' height='110'>";
    $('#img-div').html(html);
    $('#list-modal').modal('toggle');
}

function get_album_value(album)
{
    var result = album.split('&');
    $("#main_album").val(album);
    var html = "<img src='<?= SMALL_IMG; ?>" + result[1] + "' width='220' height='110'>";
    $('#main-album-div').html(html);
    $('#album-sec .main-btn-clear').css('display', 'block');
    $('#list-modal').modal('toggle');
}
function get_video_value(video)
{
    var result = video.split(':');
    $("#main_video").val(video);
    if (result[2] == 0)
        var html = "<iframe frameborder='0' width='220' height='110' src='https://www.youtube.com/embed/" + result[1] + "'></iframe>";
    else
        var html = "<iframe frameborder='0' width='220' height='110' src='//www.dailymotion.com/embed/video/" + result[1] + "'></iframe>";
    $('#main-video-div').html(html);
    $('#video-sec .main-btn-clear').css('display', 'block');
    $('#list-modal').modal('toggle');
}
//delete btns
$(".main-btn-clear").click(function () {
    $(this).hide();
    $(this).prev().val('');
    $(this).next().html("");
});
//end delete btns
// //main_album delete button
// $("#main-album-div-btn-clear").click(function () {
//     $("#main-album-div-btn-clear").hide();
//     $("#main_album").val('');
//     $("#main-album-div").html("");
// });
// //main_video delete button
// $("#main-video-btn-clear").click(function () {
//     $("#main-video-btn-clear").hide();
//     $("#main_video").val('');
//     $("#main-video-div").html("");
// });



$(document).ready(function () {
    // this_window_title = window.document.title;
    //
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
    //                 $("#main_img").val(result[1]);
    //                 var html = "<img src='<?= IMG_ARCHIVE; ?>647x471/" + result[1] + "' width='220' height='110'>";
    //
    //                 $('#img-div').html(html);
    //             }
    //         }
    //     }
    // });
    //
    // // Choosing main album code
    // $("#add_main_album_btn").click(function () {
    //     albums_window = window.open("<?= ROOT; ?>albums/list_albums", "_blank", "titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, top=0, left=0, width=1050, height=" + window.innerHeight);
    //     var timer = setInterval(check_window_close, 500);
    //
    //     function check_window_close() {
    //         album = albums_window.document.title;
    //
    //         if (albums_window.closed)
    //         {
    //             // Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
    //             if (album != this_window_title)
    //             {
    //                 // Stop the timer
    //                 clearInterval(timer);
    //
    //                 var result = album.split('&');
    //
    //                 // Set the hidden input value to the album name
    //                 $("#main_album").val(album);
    //
    //                 var html = "<img src='<?= SMALL_IMG; ?>" + result[1] + "' width='220' height='110'>";
    //
    //                 $('#main-album-div').html(html);
    //                 $("#main-album-div-btn-clear").css('display', 'block');
    //             }
    //         }
    //     }
    // });
    //
    // $("#main-album-div-btn-clear").click(function () {
    //     $("#main-album-div-btn-clear").hide();
    //     $("#main_album").val('');
    //     $("#main-album-div").html("");
    // });
    //
    // // Choosing main video code
    // $("#add_main_video_btn").click(function () {
    //     videos_window = window.open("<?= ROOT; ?>videos/list_videos", "_blank", "titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=no, top=0, left=0, width=1050, height=" + window.innerHeight);
    //     var timer = setInterval(check_window_close, 500);
    //
    //     function check_window_close() {
    //         video = videos_window.document.title;
    //
    //         if (videos_window.closed)
    //         {
    //             // Only do any action if he chooses an image from the opened window and doesn't just close it again without choosing
    //             if (video != this_window_title)
    //             {
    //                 // Stop the timer
    //                 clearInterval(timer);
    //
    //                 var result = video.split(':');
    //
    //                 // Set the hidden input value to the video name
    //                 $("#main_video").val(video);
    //                 if (result[2] == 0)
    //                     var html = "<iframe frameborder='0' width='220' height='110' src='https://www.youtube.com/embed/" + result[1] + "'></iframe>";
    //                 else
    //                     var html = "<iframe frameborder='0' width='220' height='110' src='//www.dailymotion.com/embed/video/" + result[1] + "'></iframe>";
    //
    //                 $('#main-media-div').html(html);
    //                 $("#main-video-btn-clear").css('display', 'block');
    //             }
    //         }
    //     }
    // });
    //
    // //main_video delete button
    // $("#main-video-btn-clear").click(function () {
    //     $("#main-video-btn-clear").hide();
    //     $("#main_video").val('');
    //     $("#main-media-div").html("");
    // });
    //end main_album delete button

    //bootstrape timepicker
    // $(function () {
    //     $('#datetimepicker3').datetimepicker({
    //         format: 'LT'
    //     });
    //
    //     $('#datetimepicker4').datetimepicker({
    //         format: 'LT'
    //     });
    // });
    //end bootstrape timepicker
});
</script>
