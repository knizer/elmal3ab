(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = $(this), settings = $.extend({
            format: "dropdown",
            sticky: false
        }, options);
        return this.each(function () {
            $(this).find(".button").on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                }
                else {
                    mainmenu.slideToggle().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
//                    cssmenu.find('.submenu-button').on('click', function () {
//                        $(this).toggleClass('submenu-opened');
//                        if ($(this).siblings('ul').hasClass('open')) {
//                            $(this).siblings('ul').removeClass('open').slideToggle();
//                        }
//                        else {
//                            $(this).siblings('ul').show()
//                        }
//                    });
            };
            if (settings.format === 'multitoggle')
                multiTg();
            else
                cssmenu.addClass('dropdown');
            if (settings.sticky === true)
                cssmenu.css('position', 'fixed');
            resizeFix = function () {
                var mediasize = 700;
                if ($(window).width() > mediasize) {
                    cssmenu.find('ulx').show();
                }
                if ($(window).width() <= mediasize) {
                    cssmenu.find('ulx').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

(function ($) {
    $(document).ready(function () {
        $("#cssmenu").menumaker({
            format: "multitoggle"
        });
        $(".submenu-button").click(function () {
            $(this).toggleClass('submenu-opened');
//                $(this).parent().children('ul').css('display', 'block');
//                $(this).parent().children('ul').toggleClass("sadsadsadsadas");
            $(this).parent().children('ul').toggleClass("sadsadsadsadas");
        });
        $("#li01-inplus").click(function () {
            $(".has-sub").children('ul').not('#li01-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li01-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li1-inplus").click(function () {
            $(".has-sub").children('ul').not('#li1-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li1-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li2-inplus").click(function () {
            $(".has-sub").children('ul').not('#li2-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li2-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li3-inplus").click(function () {
            $(".has-sub").children('ul').not('#li3-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li3-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li4-inplus").click(function () {
            $(".has-sub").children('ul').not('#li4-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li4-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li5-inplus").click(function () {
            $(".has-sub").children('ul').not('#li5-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li5-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li6-inplus").click(function () {
            $(".has-sub").children('ul').not('#li6-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li6-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li7-inplus").click(function () {
            $(".has-sub").children('ul').not('#li7-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li7-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li8-inplus").click(function () {
            $(".has-sub").children('ul').not('#li8-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li8-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li9-inplus").click(function () {
            $(".has-sub").children('ul').not('#li9-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li9-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li10-inplus").click(function () {
            $(".has-sub").children('ul').not('#li10-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li10-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li11-inplus").click(function () {
            $(".has-sub").children('ul').not('#li11-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li11-inplus .submenu-button").removeClass('submenu-opened');
        });
        $("#li12-inplus").click(function () {
            $(".has-sub").children('ul').not('#li12-inplus ul').removeClass("sadsadsadsadas");
            $(".has-sub").children(".submenu-button").not("#li12-inplus .submenu-button").removeClass('submenu-opened');
        });



//            $(".submenu-button").toggle(function () {
//                $(this).parent().children('ul').css({display: "block"});
//                $(this).parent().children('ul').addClass("hide-this");
//                $(".submenu-button").parent().children('ul').not(this).addClass("sdadsa");
////                .not
//            }, function () {
//                $(this).parent().children('ul').css({display: "none"});
//                $(this).parent().children('ul').removeClass("hide-this");
//                $(this).parent().children('ul').removeClass("sdadsa");
////                if ($(this).siblings('ul').hasClass('hide-this')) {
////                    alert("re class");
////                }
//            });

    });
})(jQuery);
