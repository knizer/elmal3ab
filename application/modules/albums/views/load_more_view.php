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
    });
    </script>
<?php endif; ?>
