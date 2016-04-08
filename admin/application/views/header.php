<?php $this->load->view("head.php"); ?>
<style>
    .sadsadsadsadas{display: block !important;}
</style>
<body class="pace-done">
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a id="logo" href="<?= ROOT; ?>" class="navbar-brand">
                    <span class="fa fa-rocket"></span>
                    <span class="logo-text" style="display: none">LOGO</span>
                    <span class="logo-text-icon"><img src="" alt="LOGO" class="img-responsive num-img-glogo"></span>
                </a>
            </div>
            <div class="topbar-main">
                <a href="#" class="hidden-xs"></a>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">
                            <?php $user_pic = $this->session->userdata("picture"); ?>
                            <?php if (!empty($user_pic)): ?>
                                <img src="<?= USER_PHOTOS; ?><?= $this->session->userdata("picture"); ?>" alt="<?= $this->session->userdata("name"); ?>" class="img-responsive img-circle">
                            <?php endif; ?>
                            &nbsp;<span class="hidden-xs"><?= $this->session->userdata("name"); ?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="<?= ROOT; ?>change_password"><i class="fa fa-user"></i>تغيير كلمة السر</a></li>
                            <li><a href="<?= ROOT; ?>change_picture"><i class="fa fa-calendar"></i>تغيير الصورة</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= ROOT; ?>logout"><i class="fa fa-key"></i>تسجيل خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main">
        <div class="page-container">
            <nav id='cssmenu'>
                <div id="head-mobile"></div>
                <div class="button"></div>
                <ul>
                    <li class='active'><a href='<?= ROOT; ?>'>الرئيسية</a></li>
                    <?php if ($this->session->userdata("stadiums") == 1): ?>
                        <li id="li9-inplus"><a href='#'>الملاعب</a>
                            <ul>
                                <li><a href="<?= ROOT; ?>stadiums/add">إضافة ملعب</a></li>
                                <li><a href="<?= ROOT; ?>stadiums">إدارة الملاعب</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata("images_albums") == 1): ?>
                        <li id="li2-inplus"><a href='#'>الصور</a>
                            <ul>
                                <li><a href='<?= ROOT; ?>images/add'>إضافة صور/ألبوم</a></li>
                                <li><a href='<?= ROOT; ?>images'>إدارة الصور</a></li>
                                <li><a href='<?= ROOT; ?>albums'>إدارة الألبومات</a></li>
                                <li><a href='<?= ROOT; ?>albums_featured'>رئيسية الألبومات</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata("videos") == 1): ?>
                        <li id="li9-inplus"><a href='#'>الفيديوهات</a>
                            <ul>
                                <li><a href="<?= ROOT; ?>videos/add">فيديو جديد</a></li>
                                <li><a href="<?= ROOT; ?>videos">إدارة الفيديوهات </a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata("users_groups") == 1): ?>
                        <li id="li11-inplus"><a href='#'>المستخدمين</a>
                            <ul>
                                <li><a href="<?= ROOT; ?>users/add">مستخدم جديد</a></li>
                                <li><a href="<?= ROOT; ?>users">إدارة المستخدمين</a></li>
                                <li><a href="<?= ROOT; ?>groups/add">مجموعة جديدة</a></li>
                                <li><a href="<?= ROOT; ?>groups">إدارة المجموعات</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="content-sec">
