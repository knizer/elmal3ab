<!doctype html>
<html>
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="<?= CSS; ?>style.css">
    <link rel="stylesheet" href="<?= CSS; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS; ?>media_queries.css">
    <link rel="stylesheet" href="<?= CSS; ?>font-awesome.min.css">
    <script src="<?= JS; ?>jquery.min.js"></script>
    <script src="<?= JS; ?>bootstrap.min.js"></script>
</head>
<body>
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
                            <li><a href="<?= SITE_URL; ?>">الرئيسية</a></li>
                            <li><a href="<?= SITE_URL; ?>about_us/">من نحن</a></li>
                            <li><a href="<?= SITE_URL; ?>stadiums/">ملاعب</a></li>
                            <li><a href="<?= SITE_URL; ?>albums/">ألبومات صور</a></li>
                            <li><a href="<?= SITE_URL; ?>contact_us/">اتصل بنا</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="logo">
                    <a href="<?= SITE_URL; ?>">
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
