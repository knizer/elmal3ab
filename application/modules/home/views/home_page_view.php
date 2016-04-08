<?php $this->load->view('header'); ?>
<style>
    label.star:hover {transform: none !important;}
</style>
<script>
    function rate_event(doc_id, rate){
        <?php if (!$this->session->userdata('logged_in')): ?>
                    swal('برجاء تسجيل الدخول أولا.. ثم الدخول على صفحة الملعب المراد التصويت له..!');
        <?php elseif ($this->session->userdata('logged_in')): ?>
        swal('برجاء الدخول لصفحة الملعب ..!');
        <?php endif; ?>
    }
</script>
<section class="stadium">
    <div class="container" id="startchange">
        <div class="row">
            <div class="col-md-12 col-md-11-nofloat col-md-offset-1">
                <div class="stadium-content text-center">
                    <div class="col-md-6 col-md-5-news1">
                        <div class="stadium-intro">
                            <p class="stadium-title">بإمكانك اختيار ملعبك الآن</p>
                            <span class="stadium-desc">كل الملاعب أمامك بإمكانك الاختيار</span>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-5-news" style="background:white;">
                        <p class="form-title">ابحث عن ملعبك</p>
                        <span class="form-desc">كل الملاعب أمامك بإمكانك الاختيار</span>
                        <form action="" method="post">
                            <div class="form-group col-sm-12">
                                 <div class="input-group merged">
                                      <span class="input-group-addon input-group-addon-new"><i class="fa fa-search fa-fw"></i></span>
                                      <input class="form-control form-control-new" placeholder="اسم الملعب">
                                 </div>
                            </div>
                            <div class="form-group col-sm-12">
                                 <div class="input-group merged">
                                     <label class="city-select-arrow">
                                         <select class="city-select">
                                              <option>المحافظة</option>
                                              <option>الجيزة</option>
                                              <option>القاهرة</option>
                                              <option>المنوفية</option>
                                        </select>
                                    </label>
                                 </div>
                            </div>
                            <div class="form-group col-sm-12">
                                 <div class="input-group merged">
                                     <label class="city-select-arrow">
                                         <select class="city-select">
                                              <option>السعر بالساعة يتراوح من : إلى</option>
                                              <option>الجيزة</option>
                                              <option>القاهرة</option>
                                              <option>المنوفية</option>
                                        </select>
                                    </label>
                                 </div>
                            </div>
                            <div class="form-group col-sm-12">
                                 <div class="input-group merged">
                                      <input class="form-control form-control-new" placeholder="اكتب اسم الملعب للبحث عنه">
                                 </div>
                            </div>
                            <div class="clear"></div>
                            <button class="search-btn" type="submit">ابحث عن الملعب</button>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="intro-desc">
        <div class="container">
            <p class="intro-desc-text">
                الآن متاح لديك التعرف على جميع الملاعب في محافظتك وأيضًا المحافظات الأخرى لمعرفة أفضل ملعب من الممكن اختياره أنت وزملائك لقضاء وقت ممتع في لعبة كرة القدم
            </p>
        </div>
    </div>
</section>
<section class="ads">
    <div class="container">
        <div class="row">
            <div class="ads">
                <div class="ad_728">
                    <img src="<?= IMG; ?>ad_728x90.jpg"  />
                </div>
                <div class="ad_320" style="display:none;">
                    <img src="<?= IMG; ?>ad_320x50.jpg"  />
                </div>
            </div>
        </div>
    </div>
</section>
<section class="intro section-padding">
    <div class="container">
        <div id="circles-sup">
            <p class="circles-title">أحدث الملاعب التي تمت اضافتها</p>
        </div>
        <div class="row rowcircles">
            <div class="col-md-3 ad_banner">
                <div class="ad_300">
                    <img src="<?= IMG; ?>ad_300x250.jpg" />
                </div>
            </div>
            <div class="col-md-8 circle_news">
                <?php if ( ! empty($latest_stadiums)): ?>
                    <?php foreach ($latest_stadiums as $latest_stadium): ?>
                        <div class="circle_new" style="background: transparent url('<?= LARGE_IMG . $latest_stadium['image']; ?>') no-repeat center center;">
                            <a href="<?= SITE_URL . "stadiums/details/" . $latest_stadium['id']; ?>" class="circle_news_btn"><?= $latest_stadium['title']; ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php endif;?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>
<section class="intro section-padding best-stad-bg">
    <div class="container">
        <div id="circles-sup">
            <p class="circles-title" style="color:#fff;">أفضل ملاعب قام الزوار باللعب عليها</p>
            <span class="circles-desc" style="color:#fff;margin-bottom: 60px;">لقد قمنا بتحديد هذه الملاعب عن طريق تقييم الزوار</span>
        </div>
        <div id="stads">
            <?php if ($stadiums_high_rate): ?>
                <?php foreach ($stadiums_high_rate as $stadium_high_rate): ?>
                    <div class="one-stad">
                        <div class="best-stad">
                            <a href="<?= SITE_URL . "stadiums/details/" . $stadium_high_rate['id']; ?>"><img class="best-stad-img" src="<?= MID_IMG . $stadium_high_rate['image']; ?>" /></a>
                        </div>
                        <div class="stars">
                            <?php
                            $checked1 = $checked2 = $checked3 = $checked4 = $checked5 = "";
                            $disabled = "disabled";
                            switch (@round($stadium_high_rate['avg'])) {
                                case '1':
                                    $checked1 = "checked";
                                    break;
                                case '2':
                                    $checked2 = "checked";
                                    break;
                                case '3':
                                    $checked3 = "checked";
                                    break;
                                case '4':
                                    $checked4 = "checked";
                                    break;
                                case '5':
                                    $checked5 = "checked";
                                    break;
                            }
                            ?>
                            <form action="">
                                <input class="star star-5" id="star-5<?= $stadium_high_rate['id']; ?>" name="star" type="radio" <?= @$disabled . " " . @$checked5; ?>>
                                <label class="star star-5" for="star-5<?= $stadium_high_rate['id']; ?>" onclick="rate_event(<?= $stadium_high_rate['id']; ?>, 5)"></label>
                                <input class="star star-4" id="star-4<?= $stadium_high_rate['id']; ?>" name="star" type="radio" <?= @$disabled . " " . @$checked5; ?>>
                                <label class="star star-4" for="star-4<?= $stadium_high_rate['id']; ?>" onclick="rate_event(<?= $stadium_high_rate['id']; ?>, 4)"></label>
                                <input class="star star-3" id="star-3<?= $stadium_high_rate['id']; ?>" name="star" type="radio" <?= @$disabled . " " . @$checked5; ?>>
                                <label class="star star-3" for="star-3<?= $stadium_high_rate['id']; ?>" onclick="rate_event(<?= $stadium_high_rate['id']; ?>, 3)"></label>
                                <input class="star star-2" id="star-2<?= $stadium_high_rate['id']; ?>" name="star" type="radio" <?= @$disabled . " " . @$checked5; ?>>
                                <label class="star star-2" for="star-2<?= $stadium_high_rate['id']; ?>" onclick="rate_event(<?= $stadium_high_rate['id']; ?>, 2)"></label>
                                <input class="star star-1" id="star-1<?= $stadium_high_rate['id']; ?>" name="star" type="radio" <?= @$disabled . " " . @$checked5; ?>>
                                <label class="star star-1" for="star-1<?= $stadium_high_rate['id']; ?>" onclick="rate_event(<?= $stadium_high_rate['id']; ?>, 1)"></label>
                                <div class="clear"></div>
                            </form>
                        </div>
                        <div class="best-stad-info">
                            <p class="best-stad-title"><?= $stadium_high_rate['title']; ?></p>
                            <span class="best-stad-desc"><?= $stadium_high_rate['description']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- <div class="one-stad">
                <div class="best-stad">
                    <img class="best-stad-img" src="<?= IMG; ?>stad2.jpg" />
                </div>
                <div class="stars">
                    <form action="">
                        <input class="star star-5" id="star-5" name="star" type="radio">
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" name="star" type="radio">
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" name="star" type="radio">
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" name="star" type="radio">
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" name="star" type="radio" checked>
                        <label class="star star-1" for="star-1"></label>
                        <div class="clear"></div>
                    </form>
                </div>
                <div class="best-stad-info">
                    <p class="best-stad-title">مركز شباب الجيزة</p>
                    <span class="best-stad-desc">شملت أعمال التطوير رفع كفاءة اساحة لعدد 2 نادى اجتماعى وفرشها بالأثاث وشاشة عرض كما تم إنشاء عدد 2حديقة للطفل وصالة للأنشطة والاحتفالات ومسجد وملعب أكلريك</span>
                </div>
            </div>
            <div class="one-stad">
                <div class="best-stad">
                    <img class="best-stad-img" src="<?= IMG; ?>stad3.jpg" />
                </div>
                <div class="stars">
                    <form action="">
                        <input class="star star-5" id="star-5" name="star" type="radio">
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" name="star" type="radio">
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" name="star" type="radio">
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" name="star" type="radio">
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" name="star" type="radio" checked>
                        <label class="star star-1" for="star-1"></label>
                        <div class="clear"></div>
                    </form>
                </div>
                <div class="best-stad-info">
                    <p class="best-stad-title">مركز شباب الجيزة</p>
                    <span class="best-stad-desc">شملت أعمال بدنية ودعمها بأجهزة حديثشاء عدد 2حديقة للطفل وصالة للأنشطة والاحتفالات ومسجد وملعب أكلريك</span>
                </div>
            </div> -->
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</section>
<section class="ads">
    <div class="container">
        <div class="row">
            <div class="ads">
                <div class="ad_728">
                    <img src="<?= IMG; ?>ad_728x90.jpg"  />
                </div>
                <div class="ad_320" style="display:none;">
                    <img src="<?= IMG; ?>ad_320x50.jpg"  />
                </div>
            </div>
        </div>
    </div>
</section>
<section class="intro section-padding">
        <div id="circles-sup" style="margin-bottom: 50px;">
            <p class="circles-title">ألبومات الصور</p>
        </div>
        <div class="albums">
            <?php if ( ! empty($featured_albums)): ?>
                <?php foreach ($featured_albums as $featured_album): ?>
                    <div class="one-album">
                        <a href="<?= SITE_URL . "albums/details/" .$featured_album['id']; ?>" class="one-album-btn">
                            <span><?= $featured_album['title']; ?></span>
                            <span class="one-album-more">المزيد من الصور</span>
                        </a>
                        <img src="<?= LARGE_IMG . $featured_album['main_image']; ?>" style="width: 100%;">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <div class="clear"></div>
</section>
<?php $this->load->view('footer'); ?>
