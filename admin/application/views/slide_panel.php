<div class="slide-panel" id="panel-scroll">
    <ul role="tablist" class="nav nav-tabs panel-tab-btn">
        <li class="active"><a data-toggle="tab" role="tab" href="#tab1"><i class="fa fa-inbox"></i><span>Your Emails</span></a></li>
        <li><a data-toggle="tab" role="tab" href="#tab2"><i class="fa fa-wrench"></i><span>Your Setting</span></a></li>
    </ul>
    <div class="tab-content panel-tab">
        <div id="tab1" class="tab-pane fade in active">
            <div class="recent-mails-widget">
                <div id="searchMail"></div>
                <h3>Recent Emails</h3>
                <ul id="mail-list" class="mail-list">
                    <li>
                        <div class="title">
                            <span><img src="<?= ASSETS; ?>images/resource/sender1.jpg" alt="" /><i class="online"></i></span>
                            <h3><a href="#" title="">Kim Hostwood</a><span>5 min ago</span></h3>
                            <a href="#"  data-toggle="tooltip" data-placement="left" title="Attachment"><i class="fa fa-paperclip"></i></a>
                        </div>
                        <h4>Themeforest Admin Template</h4>
                        <p>This product is so good that i manage to buy it 1 for me and 3 for my families.</p>
                    </li>
                    <li>
                        <div class="title">
                            <span><img src="<?= ASSETS; ?>images/resource/sender2.jpg" alt="" /><i class="online"></i></span>
                            <h3><a href="#" title="">John Doe</a><span>2 hours ago</span></h3>
                            <a href="#"  data-toggle="tooltip" data-placement="left" title="Attachment"><i class="fa fa-paperclip"></i></a>
                        </div>
                        <h4>Themeforest Admin Template</h4>
                        <p>This product is so good that i manage to buy it 1 for me and 3 for my families.</p>
                    </li>
                    <li>
                        <div class="title">
                            <span><img src="<?= ASSETS; ?>images/resource/sender3.jpg" alt="" /><i class="offline"></i></span>
                            <h3><a href="#" title="">Jonathan Doe</a><span>8 min ago</span></h3>
                            <a href="#"  data-toggle="tooltip" data-placement="left" title="Attachment"><i class="fa fa-paperclip"></i></a>
                        </div>
                        <h4>Themeforest Admin Template</h4>
                        <p>This product is so good that i manage to buy it 1 for me and 3 for my families.</p>
                    </li>
                </ul>
                <a href="inbox.html" title="" class="red">View All Messages</a>
            </div><!-- Recent Email Widget -->

            <div class="file-transfer-widget">
                <h3>FILE TRANSFER <i class="fa fa-angle-down"></i></h3>
                <div class="toggle">
                    <ul>
                        <li>
                            <i class="fa fa-file-excel-o"></i><h4>my-excel.xls<i>20 min ago</i></h4>
                            <div class="progress">
                                <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar red">
                                    90%
                                </div>
                            </div>
                            <div class="file-action-btn">
                                <a href="#" title="Approve" class="green" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-check"></i></a>
                                <a href="#" title="Cancel" class="red" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-close"></i></a>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-file-pdf-o"></i><h4>my-cv.pdf<i>8 min ago</i></h4>
                            <div class="progress">
                                <div style="width: 40%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar blue">
                                    40%
                                </div>
                            </div>
                            <div class="file-action-btn">
                                <a href="#" title="Approve" class="green" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-check"></i></a>
                                <a href="#" title="Cancel" class="red" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-close"></i></a>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-file-video-o"></i><h4>portfolio-shoot.mp4<i>12 min ago</i></h4>
                            <div class="progress">
                                <div style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar green">
                                    70%
                                </div>
                            </div>
                            <div class="file-action-btn">
                                <a href="#" title="Approve" class="green" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-check"></i></a>
                                <a href="#" title="Cancel" class="red" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-close"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- File Transfer -->
        </div><!-- Tab 1 -->
        <div id="tab2" class="tab-pane fade">
            <div class="setting-widget">
                <h3>Accounts</h3>
                <div class="toggle-setting">
                    <span>Office Account</span>
                    <label class="toggle-switch">							
                        <input type="checkbox">
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>Personal Account</span>
                    <label class="toggle-switch">							
                        <input type="checkbox" checked>
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>Business Account</span>
                    <label class="toggle-switch">							
                        <input type="checkbox">
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <h3>General Setting</h3>
                <div class="toggle-setting">
                    <span>Notifications</span>
                    <label class="toggle-switch">							
                        <input type="checkbox" checked>
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>Notification Sound</span>
                    <label class="toggle-switch">							
                        <input type="checkbox" checked>
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>My Profile</span>
                    <label class="toggle-switch">							
                        <input type="checkbox">
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>Show Online</span>
                    <label class="toggle-switch">							
                        <input type="checkbox">
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
                <div class="toggle-setting">
                    <span>Public Profile</span>
                    <label class="toggle-switch">							
                        <input type="checkbox" checked>
                        <span data-unchecked="Off" data-checked="On"></span>
                    </label>
                </div>
            </div><!-- Setting Widget -->
        </div><!-- Tab 2 -->
    </div><!-- tab-content panel-tab -->
</div><!-- Slide Panel -->