<footer>
<div id="footer_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="primary-nav footer-nav">
                    <li><a href="<?= SITE_URL; ?>">الرئيسية</a></li>
                    <li><a href="<?= SITE_URL; ?>about_us/">من نحن</a></li>
                    <li><a href="<?= SITE_URL; ?>stadiums/">ملاعب</a></li>
                    <li><a href="<?= SITE_URL; ?>albums/">ألبومات صور</a></li>
                    <li><a href="<?= SITE_URL; ?>contact_us/">اتصل بنا</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="footer_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <p class="copyrights">جميع حقوق النشر محفوظة &copy; <span style="font-family:arial">2016</span></p>
            </div>
        </div>
    </div>
</div>
</footer>
<script>
    $(document).ready(function() {
        $('.nav-toggle').click(function() {
            $(this).toggleClass('active');
            $('.header-nav').toggleClass('open');
            event.preventDefault();
        });

        /* When user clicks a link */
        $('.header-nav li a').click(function() {
            $('.nav-toggle').toggleClass('active');
            $('.header-nav').toggleClass('open');
        });

        /*nav color*/
       var scroll_start = 0;
       var startchange = $('#startchange');
       var offset = startchange.offset();
       $(document).scroll(function() {
          scroll_start = $(this).scrollTop();
          if(scroll_start > offset.top) {
              $('#navbar').css('background-color', 'rgb(35, 35, 35)');
           } else {
              $('#navbar').css('background-color', 'rgba(0, 0, 0, 0.7)');
           }
       });
       /*/nav color*/

        /*search*/
        $('a[href="#search"]').on('click', function(event) {
            event.preventDefault();
            $('#search').addClass('open');
            $('#search > form > input[type="search"]').focus();
        });

        $('#search, #search button.close').on('click keyup', function(event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });
        /*/search*/

        /*albums*/
        $( ".one-album-btn" ).mouseover(function() {
            $( this ).find(".one-album-more").css("display", "block");
        }).mouseout(function() {
            $( this ).find(".one-album-more").css("display", "none");
        });
        /*albums*/

        /*test*/
        $(".primary-nav li").find("a[href='"+window.location.href+"']").each(function(){
            $(this).addClass("nav-a-active");
        });
        /*test*/
    });
</script>
</body>
</html>
