<?php $this->load->view("head.php"); ?>
<?php require_once(UPLOADS_PATH . 'recaptchalib.php') ?>
<body  class="login-block">
    <div class="page-form">
        <div class="panel panel-blue">
            <div class="panel-body pan">
                <form action="" method="post" class="form-horizontal">
                    <div class="form-body login-padding">
                        <div class="col-md-12 text-center">
                            <h1 style="margin-top: 0px; font-size:42px; text-transform:uppercase; letter-spacing:-1px; color:#000; font-weight:bold">
                                <a style="color:#000;"><img src="" alt="LOGO" class=""/></a></h1>
                            <br />
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" style="text-align: center;margin: 10px 0;">
                                <h2>تسجيل الدخول</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="float: right;" for="inputName" class="col-md-3 control-label">
                                إسم المستخدم:</label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa fa-user"></i>
                                    <input name="username" value="<?php if (isset($_POST["username"])) echo htmlspecialchars(trim($_POST["username"])); ?>" type="text" placeholder="" class="form-control" required/></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="float: right;" for="inputPassword" class="col-md-3 control-label">
                                كلمة السر:</label>
                            <div class="col-md-9">
                                <div class="input-icon right">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" placeholder="" class="form-control" required/></div>
                            </div>
                        </div>
                        <div class="form-group mbn">
                            <div class="col-lg-12">
                                <div class="form-group mbn">
                                    <div class="col-lg-4">
                                        <button style="float: left;" type="submit" name="submit" class="btn btn-default sign-btn">
                                            دخول</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($_COOKIE["invalid_login_attempts"]) && $_COOKIE["invalid_login_attempts"] > 5): ?>
                            <div style="margin-bottom: 15px; margin-top: 130px; margin-right: 23px;">
                                <?php
                                $publickey = "6LcDaQsTAAAAAHWL57zZExDmyJpQwuIvBLMciDYU";
                                echo recaptcha_get_html($publickey);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-lg-12 text-center">
            <?php if (isset($error)): ?>
                <p class="error-msg" style="margin-top: 10px;"><?= $error; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
