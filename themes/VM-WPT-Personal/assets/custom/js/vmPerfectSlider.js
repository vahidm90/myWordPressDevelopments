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
                this.allDelays = 'delay-0 delay-0-1 delay-0-2 delay-0-3 delay-0-4 delay-0-5 delay-0-6 delay-0-7 delay-0-8 delay-0-9 delay-1 delay-1-1 delay-1-2 delay-1-3 delay-1-4 delay-1-5 delay-1-6 delay-1-7 delay-1-8 delay-1-9 delay-2 delay-2-1 delay-2-2 delay-2-3 delay-2-4 delay-2-5 delay-2-6 delay-2-7 delay-2-8 delay-2-9 delay-3 delay-3-1 delay-3-2 delay-3-3 delay-3-4 delay-3-5 delay-3-6 delay-3-7 delay-3-8 delay-3-9 delay-4 delay-4-1 delay-4-2 delay-4-3 delay-4-4 delay-4-5 delay-4-6 delay-4-7 delay-4-8 delay-4-9 delay-5 delay-5-1 delay-5-2 delay-5-3 delay-5-4 delay-5-5 delay-5-6 delay-5-7 delay-5-8 delay-5-9 delay-6 delay-6-1 delay-6-2 delay-6-3 delay-6-4 delay-6-5 delay-6-6 delay-6-7 delay-6-8 delay-6-9 delay-7 delay-7-1 delay-7-2 delay-7-3 delay-7-4 delay-7-5 delay-7-6 delay-7-7 delay-7-8 delay-7-9 delay-8 delay-8-1 delay-8-2 delay-8-3 delay-8-4 delay-8-5 delay-8-6 delay-8-7 delay-8-8 delay-8-9 delay-9 delay-9-1 delay-9-2 delay-9-3 delay-9-4 delay-9-5 delay-9-6 delay-9-7 delay-9-8 delay-9-9 delay-10';
                this.allEnterAnimsArr = this.allEnterAnims.split(' ');
                this.allExitAnimsArr = this.allExitAnims.split(' ');
                this.slideStayTime = this.settings.lastElemTime * 1000;
                this.$slides = this.$slider.children('.' + this.settings.slideClass);
                if (0 >= this.$slides.length) {
                    throw new Error('No elements with the CSS class "' + this.settings.slideClass + '" found!');
                }
                this.curSlide = 0;
                var $indicator = $('<div class="' + this.settings.indicatorWrapClass + '"></div>');

                for (var i = 0; this.$slides.length > i; i++) {
//TODO: check selfAnimate for each slide before playing the animations.
                    //TODO: check for delay values.
                    //TODO: convert delay values to classes.
                    var that = this,
                        $slide = this.$slides.eq(i),
                        $elements = $slide.find('.' + this.settings.elemClass),
                        $firstElem = $elements.filter('.' + this.settings.firstElemClass),
                        $lastElem = $elements.filter('.' + this.settings.lastElemClass);
                    if (0 >= $elements.length) {
                        $slide.data('animateSelf', 1);
                        var slideHasEnterAnim = this.allEnterAnimsArr.some(function (anim) {
                                return anim === $slide.data('enter');
                            }),
                            slideHasExitAnim = this.allExitAnimsArr.some(function (anim) {
                                return anim === $slide.data('exit');
                            });
                        if (!slideHasEnterAnim) {
                            $slide.data('enter', this.settings.elemEnterAnim);
                        }
                        if (!slideHasExitAnim) {
                            $slide.data('exit', this.settings.elemExitAnim);
                        }
                    } else {
                        $slide.data('animateSelf', 0);
                        $elements.each(function () {
                            var elemHasEnterAnim = that.allEnterAnimsArr.some(function (anim) {
                                    return anim === $(this).data('enter');
                                }),
                                elemHasExitAnim = that.allExitAnimsArr.some(function (anim) {
                                    return anim === $(this).data('exit');
                                });
                            if (!elemHasEnterAnim) {
                                $(this).data('enter', that.settings.elemEnterAnim);
                            }
                            if (!elemHasExitAnim) {
                                $(this).data('exit', that.settings.elemExitAnim);
                            }
                        });
                        if ($slide.data('domino')) {
                            if (0 >= $firstElem.length) {
                                $elements.first().addClass(this.settings.firstElemClass);
                            } else if (1 < $firstElem.length) {
                                $firstElem.removeClass(this.settings.firstElemClass);
                                $elements.first().addClass(this.settings.firstElemClass);
                            }
                            if (0 >= $lastElem.length) {
                                $elements.last().addClass(this.settings.lastElemClass);
                            } else if (1 < $lastElem.length) {
                                $lastElem.removeClass(this.settings.lastElemClass);
                                $elements.last().addClass(this.settings.lastElemClass);
                            }
                        } else {
                            $elements.each(function () {
                                var delay = $(this).data('delay');
                                $(this).addClass(delay ? 'delay-' + delay : 'delay-0');
                            });
                        }
                    }
                    $indicator.prepend('<span class="' + this.settings.navClass + '" data-go-to-slide="' + i + '"></span>');
                }
                $indicator.appendTo(this.$slider);
                this.$nav = this.$slider.find('.' + this.settings.navClass);
                //TODO: make next/previous buttons dynamic too.
                this.loadEvents(this);
                this.playSlide(this.curSlide);

            },

            loadEvents: function (that) {
                //TODO: don't forget relevant data on arrows/indicators.
                this.$nav.on('click', function (e) {
                    if (!$(this).data('goToSlide')) {
                        return;
                    }
                    e.preventDefault();
                    clearTimeout(that.slideTime);
                    switch ($(this).data('goToSlide')) {
                        default:
                            that.playSlide($(this).data('goToSlide'));
                            break;
                        case 'N' :
                            that.playSlide(that.curSlide - 1);
                            break;
                        case 'P' :
                            that.playSlide(that.curSlide + 1);
                            break;
                    }
                });
            },

            playSlide: function (index) {
                //TODO:update indicators.
                var next;
                if (-1 === index && 0 === this.curSlide) {
                    next = this.$slides.length - 1;
                } else if (this.$slides.length === index && (this.$slides.length - 1) === this.curSlide) {
                    next = 0;
                } else if ((-1 < index) && (this.$slides.length > index)) {
                    next = index;
                } else {
                    return;
                }
                this.$slides.eq(this.curSlide).removeClass('rolling');
                this.curSlide = next;
                var $nextSlide = this.$slides.eq(this.curSlide).addClass('rolling');
                if ($nextSlide.data('animateSelf')) {
                    this.slideSelfAnimate(this, $nextSlide );
                }
                if ($nextSlide.data('domino')) {
                    this.slideDomino(this, $nextSlide);
                } else {
                    //TODO:the function to play elements' animations
                    this.slideAnimate(this, $nextSlide);
                }
            },

            slideSelfAnimate: function (that, $theSlide) {
                var enter = $theSlide.data('enter');
                $theSlide.addClass('animated ' + enter);
                this.slideTime = setTimeout(function () {
                    $theSlide.removeClass(enter).addClass($theSlide.data('exit'));
                    this.playSlide(that.curSlide + 1);
                }, this.slideStayTime * 1000);
            },

            slideDomino: function (that, $theSlide) {
                var $elements = $theSlide.find('.' + this.settings.elemClass),
                    $first = $elements.filter('.' + this.settings.firstElemClass),
                    $last = $elements.filter('.' + this.settings.lastElemClass);
                $elements.not('.' + this.settings.lastElemClass).on('animationend', function () {
                    var $nextElem = $(this).next();
                    $nextElem.addClass('animated ' + $nextElem.data('enter'));
                });
                $last.on('animationend', function () {
                    that.slideDominoEnd($elements);
                });
                $first.addClass('animated ' + $first.data('enter'));
            },

            slideAnimate: function (that, $theSlide) {

            },

            slideDominoEnd: function ($elements) {
                $elements.off('animationend');
                $elements.removeClass(this.allDelays);
                this.slideTime = setTimeout(function () {
                    $elements.each(function () {
                        $(this).removeClass($(this).data('enter')).addClass($(this).data('exit'));
                    });
                    this.playSlide(this.curSlide + 1);
                }, this.slideStayTime);
            },

            defaults:
                {
                    slideClass: 'slide',
                    slideEnterAnim: 'slideInLeft',
                    slideExitAnim: 'slideOutRight',
                    indicatorWrapClass: 'indicator',
                    navClass: 'nav',
                    elemClass: 'element',
                    elementAnimationDuration: .05,
                    elemEnterAnim: 'fadeIn',
                    elementEntranceDelay: 0,
                    elemExitAnim: 'fadeOut',
                    firstElemClass: 'first',
                    lastElemClass: 'last',
                    lastElemTime: 2,
                }

        };

    $.fn.vmPerfectSlider = function (options) {

        return this.each(function () {
            var instance = $.data(this, "vmPerfectSlider");
            if (!instance) {
                $.data(this, "vmPerfectSlider", new vmPerfectSlider(this, options).init());
            }
        });

    };

}(jQuery));
