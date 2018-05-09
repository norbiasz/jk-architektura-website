//=include modernizr.min.js
//=include slick-carousel/slick/slick.js
//=include autosize/dist/autosize.js
//=include map_script.js
//=include lightbox2.js
//=include sliders.js


var ThemeScript = ThemeScript || {};

(function($, window, document) {
    "use strict";

     var ThemeSliders = {};
     ThemeSliders.homeSlider = new THEME_Sliders.Slider( $(".home-slider"), {
        dots: false,
        //arrows: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: $('.home-slider__prev-slide'),
        nextArrow: $('.home-slider__next-slide'),
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    dots: false,
                }
            }
        ]
    });

    ThemeScript.toggleNav = function () {
        $('body').toggleClass('nav-visible');
        $('#header__toggle-menu').toggleClass('is-open');
    },

    ThemeScript.onScroll = function() {
        var scroll = $(document).scrollTop();
        ThemeScript.compactMenuToggle(scroll);
    },

    ThemeScript.compactMenuToggle = function(scroll) {
        if (scroll > 150) {
            $('.header').addClass('visible')
        } else {
            $('.header').removeClass('visible')
        }
    },

    ThemeScript.featureDetection = function () {
        ThemeScript.fixObjectFit();
    },

    ThemeScript.fixObjectFit = function () {
        if (!Modernizr.objectfit || $.browser.mozilla) {
            $(".flex-fill").each(function () {
                var $container = $(this),
                        imgUrl = $container.find('img').prop('src');
                if (imgUrl) {
                    $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
                }
            });
        }
    },

    ThemeScript.onReady = function() {
        THEME_Sliders.initialize(ThemeSliders);     // uruchomienie sliderow

        autosize($('textarea'));

        $('#header__toggle-menu').click(ThemeScript.toggleNav);
    },

    ThemeScript.onLoad = function() {
        GMapLogic.initialize( theme_vars.google_map_api_key );
        ThemeScript.featureDetection();
    },

    $(ThemeScript.onReady);
    $(window).on("load", ThemeScript.onLoad);
    $(window).scroll(ThemeScript.onScroll);
    GMapLogic.MapClass = '.acf-map';
})(jQuery, window, document);