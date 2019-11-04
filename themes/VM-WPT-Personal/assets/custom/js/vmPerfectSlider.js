(function ($, window, document, undefined) {

    var vmPerfectSlider = function (element, options) {
        this.$slider = $(element);
        this.options = options;
    };

    vmPerfectSlider.prototype =
        {

            init: function () {

                this.settings = $.extend({}, this.defaults, this.options);
                this.allEnterAnims = 'bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig flipInX flipInY lightSpeedIn rollIn rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight slideInDown slideInLeft slideInRight slideInUp zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp jackInTheBox';
                this.allExitAnims = 'bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipOutX flipOutY lightSpeedOut rollOut rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight slideOutDown slideOutLeft slideOutRight slideOutUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp hingeOut';
                this.allEnterAnimsArr = this.allEnterAnims.split(' ');
                this.allExitAnimsArr = this.allExitAnims.split(' ');
                this.$slides = this.$slider.children('.' + this.settings.slideClass);
                if (0 >= this.$slides.length) {
                    throw new Error('No elements with the CSS class "' + this.settings.slideClass + '" found!' );
                }
                this.curSlide = 0;
                var $indicator = $('<div class="' + this.settings.indicatorWrapClass + '"></div>');

                for ( var i = 0 ; this.$slides.length > i; i++ ) {

                    var that = this,
                        $slide = this.$slides.eq(i),
                        $elements = $slide.find('.' + this.settings.elemClass),
                        $lastElem = $elements.filter('.' + this.settings.lastElemClass);
                    if (0 >= $elements.length) {
                        $slide.data('animateSelf', 1);
                        var slideHasEnterAnim = that.allEnterAnimsArr.some(function (anim) {
                            return anim===$slide.data('enter');
                        }),
                        slideHasExitAnim = that.allExitAnimsArr.some(function (anim) {
                            return anim===$slide.data('exit');
                        });
                        if(!slideHasEnterAnim) {
                            $slide.data('enter', that.settings.elemEnterAnim);
                        }
                        if(!slideHasExitAnim) {
                            $slide.data('exit', that.settings.elemExitAnim);
                        }
                    } else {
                        $slide.data('animateSelf', 0);
                        $elements.each(function () {
                            var elemHasEnterAnim = that.allEnterAnimsArr.some(function (anim) {
                                return anim===$(this).data('enter');
                            }),
                            elemHasExitAnim = that.allExitAnimsArr.some(function (anim) {
                                return anim===$(this).data('exit');
                            });
                            if(!elemHasEnterAnim) {
                                $(this).data('enter',that.settings.elemEnterAnim);
                            }
                            if(!elemHasExitAnim) {
                                $(this).data('exit', that.settings.elemExitAnim);
                            }
                        });
                        if (0 >= $lastElem.length) {
                            $elements.last().addClass(this.settings.lastElemClass);
                        } else if (1 < $lastElem.length) {
                            $lastElem.removeClass(this.settings.lastElemClass);
                            $elements.last().addClass(this.settings.lastElemClass);
                        }
                    }
                    $indicator.prepend('<span class="' + this.settings.navClass + '" data-go-to-slide="' + i + '"></span>');

                }

                $indicator.appendTo(this.$slider);
                this.$nav = this.$slider.find('.' + this.settings.navClass);
                //TODO: make next/previous buttons dynamic too.
                this.loadEvents();
                this.navigate(this.curSlide);
                this.autoplay();

            },

            loadEvents: function () {
                var that = this;
                //TODO: don't forget relevant data on arrows/indicators.
                this.$nav.on('click', function (e) {
                    if (!$(this).data('goToSlide')) {
                        return;
                    }
                    e.preventDefault();
                    switch ($(this).data('goToSlide')) {
                        default:
                            that.navigate($(this).data('goToSlide'));
                            break;
                        case 'N' :
                            that.navigate(that.curSlide - 1);
                            break;
                        case 'P' :
                            that.navigate(that.curSlide + 1);
                            break;
                    }
                });
            },

            navigate: function (curSlide) {
                //TODO:update indicators.
                this.$slides.eq(this.curSlide).addClass('rolling');
                var nextSlide;
                if (-1 === curSlide) {
                    nextSlide = this.$slides.length - 1;
                } else if (this.$slides.length === curSlide) {
                    nextSlide = 0;
                } else if ((-1 < curSlide) && (this.slidesCount > curSlide)) {
                    nextSlide = curSlide;
                } else {
                    return;
                }
                if (this.slides.eq(this.curSlide).data('domino')) {
                    this.slideDomino();
                } else {
                    //TODO:the function to play elements' animations
                }
                this.navigate(nextSlide);
            },

            slideDomino: function () {

                var that = this, $elements = this.$slides.eq(this.curSlide).find('.' + this.settings.elemClass);
                $elements.each( function () {
                })
                $elements.first().hasClass()
                this.$slides.on('slideEnd.vmPS', '[data-vmPS-last="1"]', function () {
                    this.navigate(++this.curSlide);
                });

                this.$slides.filter('[data-vmPS-domino="1"]').find('.' + this.settings.elemClass + ':not(.'+this.settings.lastElemClass+')').on('animationend', function () {
                    var $nextElement = $(this).next(),
                        animation = $nextElement.data('vmPS-animation') ? $nextElement.data('vmPS-animation') : that.settings.elemEnterAnim;
                    if ($nextElement.is('[class~="delay-"]')) {
                        $nextElement.addClass('animated ' + animation);
                    } else {
                        var delay = ($nextElement.data('vmPS-entrance-delay')) ? parseInt($nextElement.data('vmPS-entrance-delay'), 10) : that.settings.elementEntranceDelay;
                        $nextElement.css('animation-delay', delay).addClass('animated ' + animation);
                    }
                });
                this.$slides.find('.'+this.settings.lastElemClass).on('animationend', function () {

                });
                this.slides.eq(this.curSlide).children().each(function () {
                    if ($(this).data('vmPS-animation')) {
                        addClass()
                    }
                })

            },

            defaults :
                {
                    slideClass: 'slide',
                    indicatorWrapClass: 'indicator',
                    navClass: 'nav',
                    elemClass: 'element',
                    elementAnimationDuration: .05,
                    elemEnterAnim: 'fadeIn',
                    elementEntranceDelay: 0,
                    elemExitAnim: 'fadeOut',
                    lastElementStayTime: 2,
                    lastElemClass: 'last',
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
