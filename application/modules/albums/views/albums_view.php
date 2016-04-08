<?php $this->load->view('header');?>
<section class="stadium" style="min-height: 350px;">
    <div class="container" id="startchange">
        <div class="row">
            <div class="col-md-12 col-md-11-nofloat col-md-offset-1">
                <div class="stadium-content text-center">
                    <div class="col-md-12">
                        <p class="stadium-title">بإمكانك اختيار ملعبك الآن</p>
                        <span class="stadium-desc">كل الملاعب أمامك بإمكانك الاختيار</span>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</section>
<section class="intro section-padding">
    <div class="container">
        <div id="circles-sup">
            <p class="circles-title">ألبومات الصور</p>
        </div>

        <div id="all-albums">
            <?php if (isset($albums)): ?>
                <?php foreach($albums as $album): ?>
                    <div class="one_album_div">
                        <a class="fancybox<?= $album['id']; ?> one_album" data-fancybox-group="thumb" href="<?= LARGE_IMG . $album['main_image']; ?>">
                            <img src="<?= SMALL_IMG . $album['main_image']; ?>" alt="" />
                        </a>
                        <p hidden>
                            <?php foreach ($album['album_images'] as $album_image): ?>
                                <?php if ($album_image['image_name'] != $album['main_image']): ?>
                                    <a class="fancybox<?= $album['id']; ?>" data-fancybox-group="thumb" href="<?= LARGE_IMG . $album_image['image_name']; ?>">
                                        <img src="<?= SMALL_IMG . $album_image['image_name']; ?>" alt="" />
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
        <?php if (isset($albums) && count($albums) == 12): ?>
            <div class="row">
                <div style="width: 25%; margin: 40px auto;">
                    <button type="button" class="btn btn-info load-more-btn" style="width: 100%;">مزيد من الألبومات</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</section>
<script>
$(document).ready(function() {
    // fancybox
    $(".one_album").each(function(){
        var main_class = $(this).attr("class");
        var class_needed = main_class.split(" ");
        $('.' + class_needed[0]).fancybox({
            prevEffect : 'none',
            nextEffect : 'none',
            closeBtn  : false,
            arrows    : false,
            nextClick : true,
            helpers : {
                thumbs : {
                    width  : 50,
                    height : 50
                }
            }
        });
    });
    //end fancybox

    // Load more logic
    $('.load-more-btn').click(function() {
        var offset = $('.one_album_div').length;
        $.ajax({
            type: "POST",
            url: "<?= SITE_URL; ?>albums/load_more_albums",
            data: {offset: offset},
            success: function (response) {
                if (response == '')
                {
                    var loadMoreBtn = $('.load-more-btn');
                    loadMoreBtn.hide('slow', function() { loadMoreBtn.remove(); });
                }
                else
                {
                    $('#all-albums').append(response);
                }
            }
        });
    });
    //end Load more logic
});
</script>
<?php $this->load->view('footer');?>
