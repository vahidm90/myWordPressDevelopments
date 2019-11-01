(function ($, window, document, undefined) {

    var vmPerfectSlider = function (element, options) {
        this.$slider = $(element);
        this.options = options;
    };

    vmPerfectSlider.prototype =
        {

            init: function () {

                this.settings = $.extend({}, this.defaults, this.options);
                this.allEntranceAnimations = 'bounceIn bounceInDown  bounceInLeft  bounceInRight  bounceInUp  slideInDown slideInLeft slideInRight slideInUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight flipInX flipInY lightSpeedIn zoomIn  zoomInDown  zoomInLeft  zoomInRight  zoomInUp  jackInTheBox  rollIn';
                this.allExitanimations = 'bounceOut bounceOutDown  bounceOutLeft  bounceOutRight  bounceOutUp  fadeOut fadeOutDown  fadeOutDownBig  fadeOutLeft  fadeOutLeftBig  fadeOutRight  fadeOutRightBig  fadeOutUp  fadeOutUpBig  flipOutX flipOutY  lightSpeedOut rotateOut rotateOutDownLeft  rotateOutDownRight  rotateOutUpLeft  rotateOutUpRight  hingeOut rollOut  zoomOut  zoomOutDown  zoomOutLeft  zoomOutRight  zoomOutUp  slideOutDown slideOutLeft  slideOutRight  slideOutUp';
                this.$slides = this.$slider.children('.' + this.settings.slideClass);
                this.currentSlide = 0;
                var $dots = $('<div class="' + this.settings.indicatorWrapClass + '"></div>');

                for ( var i = 0 ; this.$slides.length > i; i++ ) {

                    var $theSlide = this.$slides.eq(i);
                    if (0 >= $theSlide.find('.' + this.settings.lastElementClass).length) {
                        $theSlide.find('.' + this.settings.elementClass).last().addClass(this.settings.lastElementClass);
                    } else if (1 < $theSlide.find('.' + this.settings.lastElementClass).length) {
                        $theSlide.find('.' + this.settings.elementClass).removeClass(this.settings.lastElementClass);
                        $theSlide.find('.' + this.settings.elementClass).last().addClass(this.settings.lastElementClass);
                    }
                    $dots.prepend('<span class="' + this.settings.navigationClass + '" data-go-to-slide="' + i + '"></span>');

                }

                $dots.appendTo(this.$slider);
                this.$nav = this.$slider.find('.' + this.settings.navigationClass);
                //TODO: make next/previous buttons dynamic too.
                this.loadEvents();
                this.navigate(this.currentSlide);
                this.autoplay();

            },

            loadEvents: function () {
                var that = this;
                //TODO: don't forget relevant data on arrows/dots.
                this.$nav.on('click', function (e) {
                    if (!$(this).data('go-to-slide')) {
                        return;
                    }
                    e.preventDefault();
                    switch ($(this).data('go-to-slide')) {
                        default:
                            that.navigate(parseInt($(this).data('go-to-slide'), 10));
                            break;
                        case 'N' :
                            that.navigate(that.currentSlide - 1);
                            break;
                        case 'P' :
                            that.navigate(that.currentSlide + 1);
                            break;
                    }
                });
            },

            navigate: function (slide) {

                this.$slides.eq(this.currentSlide).addClass('rolling');
                var next;
                if (-1 === slide) {
                    next = this.$slides.length - 1;
                } else if (this.$slides.length === slide) {
                    next = 0;
                } else if ((-1 < slide) && (this.slidesCount > slide)) {
                    next = slide;
                } else {
                    return;
                }
                if (this.slides.eq(this.currentSlide).data('vmPS-domino')) {
                    this.slideDomino();
                } else {
                    this.slideAnimate(this.currentSlide);
                }
                this.navigate(next);
                this.updateIndicators();

            },

            slideDomino: function () {

                var that = this, $elements = this.$slides.eq(this.currentSlide).find('.' + this.settings.elementClass);
                $elements.each( function () {
                })
                $elements.first().hasClass()
                this.$slides.on('slideEnd.vmPS', '[data-vmPS-last="1"]', function () {
                    this.navigate(++this.currentSlide);
                });

                this.$slides.filter('[data-vmPS-domino="1"]').find('.' + this.settings.elementClass + ':not(.'+this.settings.lastElementClass+')').on('animationend', function () {
                    var $nextElement = $(this).next(),
                        animation = $nextElement.data('vmPS-animation') ? $nextElement.data('vmPS-animation') : that.settings.elementEntranceAnimation;
                    if ($nextElement.is('[class~="delay-"]')) {
                        $nextElement.addClass('animated ' + animation);
                    } else {
                        var delay = ($nextElement.data('vmPS-entrance-delay')) ? parseInt($nextElement.data('vmPS-entrance-delay'), 10) : that.settings.elementEntranceDelay;
                        $nextElement.css('animation-delay', delay).addClass('animated ' + animation);
                    }
                });
                this.$slides.find('.'+this.settings.lastElementClass).on('animationend', function () {

                });
                this.slides.eq(this.currentSlide).children().each(function () {
                    if ($(this).data('vmPS-animation')) {
                        addClass()
                    }
                })

            },

            defaults :
                {
                    slideClass: 'slide',
                    indicatorWrapClass: 'indicator',
                    navigationClass: 'slide-nav',
                    elementClass: 'slide-element',
                    elementAnimationDuration: .1,
                    elementEntranceAnimation: 'fadeIn',
                    elementEntranceDelay: 0,
                    elementExitAnimation: 'fadeOut',
                    lastElementStayTime: 2,
                    lastElementClass: 'last-element',
                }

        };

    $.fn.vmPerfectSlider = function (options) {

        return this.each(function()
        {
            var instance	=	$.data(this,"vmPerfectSlider");
            if (!instance)
            {
                $.data(this,"vmPerfectSlider",new vmPerfectSlider(this,options).init());
            }
        });

    };

}(jQuery));
