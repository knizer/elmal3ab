<?php $this->load->view('header'); ?>
<section class="stadium">
    <section class="navigation" id="navbar">
        <div class="social-top">
            <header style="padding: 0;">
            <div class="social-icons">
                <ul class="social-ul">
                    <li class="social-ul-li"><a href="#search"><i class="fa fa-search search-custom"></i></a></li>
                    <li class="social-ul-li"><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                    <li class="social-ul-li"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li class="social-ul-li"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-ul-li"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <div class="clear"></div>
                </ul>
                <div id="search">
                    <form>
                        <input type="search" value="" placeholder="اكتب كلمة البحث" />
                        <button type="submit" class="btn btn-primary">ابحث</button>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </header>
            <div class="clear"></div>
        </div>
        <header>
            <div class="header-content">
                <div class="header-nav">
                    <nav>
                        <ul class="primary-nav">
                            <li><a href="#">الرئيسية</a></li>
                            <li><a href="#">من نحن</a></li>
                            <li><a href="#">ملاعب</a></li>
                            <li><a href="#">ألبومات صور</a></li>
                            <li><a href="#">اتصل بنا</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="logo">
                    <a href="#">
                        <img src="<?= IMG; ?>logo.png" alt="elmal3ab logo">
                    </a>
                </div>
                <div class="navicon">
                    <a class="nav-toggle" href="#"><span></span></a>
                </div>
            </div>
            <div class="clear"></div>
        </header>
    </section>
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
            <span class="circles-desc">لقد قمنا بتحديد هذه الملاعب عن طريق تقييم الزوار</span>
        </div>
        <div class="row rowcircles">
            <div class="col-md-3 ad_banner">
                <div class="ad_300">
                    <img src="<?= IMG; ?>ad_300x250.jpg" />
                </div>
            </div>
            <div class="col-md-8 circle_news">
                <div class="circle_new" style="background: transparent url('<?= IMG; ?>test.jpg') no-repeat center center;">
                    <a href="#" class="circle_news_btn">روض الفرج</a>
                </div>
                <div class="circle_new" style="background: transparent url('<?= IMG; ?>test.jpg') no-repeat center center;">
                    <a href="#" class="circle_news_btn">روض الفرج</a>
                </div>
                <div class="circle_new" style="background: transparent url('<?= IMG; ?>test.jpg') no-repeat center center;">
                    <a href="#" class="circle_news_btn">روض الفرج</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</section>
<section class="intro section-padding best-stad-bg">
    <div class="container">
        <div id="circles-sup">
            <p class="circles-title" style="color:#fff;margin-bottom: 60px;">أحدث الملاعب التي تمت اضافتها</p>
        </div>
        <div id="stads">
            <div class="one-stad">
                <div class="best-stad">
                    <img class="best-stad-img" src="<?= IMG; ?>stad1.jpg" />
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
                    <span class="best-stad-desc">شملت أعمال التطوير رفع كفاءة المبنى الإدارى ودعم المركز بالأثاث المكتبى وتطوير ورفع كفاءة صالة اللياقة البدنية ودعمها بأجهزة حديثة وتخصيص ساحة لعدد 2 نادى اجتماعى وفرشها بالأثاث وشاشة عرض كما تم إنشاء عدد 2حديقة للطفل وصالة للأنشطة والاحتفالات ومسجد وملعب أكلريك</span>
                </div>
            </div>
            <div class="one-stad">
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
            </div>
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
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album1.jpg" style="width: 100%;">
            </div>
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album2.jpg" style="width: 100%;">
            </div>
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album3.jpg" style="width: 100%;">
            </div>
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album4.jpg" style="width: 100%;">
            </div>
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album5.jpg" style="width: 100%;">
            </div>
            <div class="one-album">
                <a href="#" class="one-album-btn">
                    <span>ملعب شباب الجيزة</span>
                    <span class="one-album-more">المزيد من الصور</span>
                </a>
                <img src="<?= IMG; ?>album6.jpg" style="width: 100%;">
            </div>
        </div>
    <div class="clear"></div>
</section>
<?php $this->load->view('footer'); ?>
