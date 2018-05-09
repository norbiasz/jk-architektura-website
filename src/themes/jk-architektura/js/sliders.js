var THEME_Sliders = THEME_Sliders || {};

(function($) {
    "use strict";

    THEME_Sliders.Slider = function( element, options ) {
        this.element = element;
        this.options = options;
        this.initialize = function() {};
    }

    THEME_Sliders.initSlider = function( slider ) {
        if( slider.element.length !== 0 ) {
            slider.initialize();
            slider.element.slick(slider.options);     
        }
    }

    THEME_Sliders.initialize = function( collection ) {
        $.each(collection, function( key, slider ){
            THEME_Sliders.initSlider( slider );
        });
    }
})(jQuery)