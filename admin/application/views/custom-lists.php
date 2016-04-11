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

    });

    function get_image_value(image_val) {
        var result = image_val.split('&');
        $("#main_img").val(result[1]);
        var html = "<img src='<?= SMALL_IMG; ?>" + result[1] + "' width='220' height='110'>";
        $('#img-div').html(html);
        $('#list-modal').modal('toggle');
    }

    function get_album_value(album) {
        var result = album.split('&');
        $("#main_album").val(album);
        var html = "<img src='<?= SMALL_IMG; ?>" + result[1] + "' width='220' height='110'>";
        $('#main-album-div').html(html);
        $('#album-sec .main-btn-clear').css('display', 'block');
        $('#list-modal').modal('toggle');
    }

    function get_video_value(video) {
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
</script>
