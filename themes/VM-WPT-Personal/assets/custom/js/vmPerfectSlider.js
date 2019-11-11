(function ($, window, document, undefined) {

    var vmPerfectSlider = function (element, options) {
        this.$slider = $(element);
        this.options = options;
    };
//TODO: make CSS dynamic
    //TODO: add slider container class dynamically. 
    vmPerfectSlider.prototype =
        {

            init: function () {

                this.settings = $.extend({}, this.defaults, this.options);
                this.allEnterAnims = 'bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig flipInX flipInY lightSpeedIn rollIn rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight slideInDown slideInLeft slideInRight slideInUp zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp jackInTheBox';
                this.allExitAnims = 'bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipOutX flipOutY lightSpeedOut rollOut rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight slideOutDown slideOutLeft slideOutRight slideOutUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp hingeOut';
                this.allDelays = 'delay-0 delay-0-1 delay-0-2 delay-0-3 delay-0-4 delay-0-5 delay-0-6 delay-0-7 delay-0-8 delay-0-9 delay-1 delay-1-1 delay-1-2 delay-1-3 delay-1-4 delay-1-5 delay-1-6 delay-1-7 delay-1-8 delay-1-9 delay-2 delay-2-1 delay-2-2 delay-2-3 delay-2-4 delay-2-5 delay-2-6 delay-2-7 delay-2-8 delay-2-9 delay-3 delay-3-1 delay-3-2 delay-3-3 delay-3-4 delay-3-5 delay-3-6 delay-3-7 delay-3-8 delay-3-9 delay-4 delay-4-1 delay-4-2 delay-4-3 delay-4-4 delay-4-5 delay-4-6 delay-4-7 delay-4-8 delay-4-9 delay-5 delay-5-1 delay-5-2 delay-5-3 delay-5-4 delay-5-5 delay-5-6 delay-5-7 delay-5-8 delay-5-9 delay-6 delay-6-1 delay-6-2 delay-6-3 delay-6-4 delay-6-5 delay-6-6 delay-6-7 delay-6-8 delay-6-9 delay-7 delay-7-1 delay-7-2 delay-7-3 delay-7-4 delay-7-5 delay-7-6 delay-7-7 delay-7-8 delay-7-9 delay-8 delay-8-1 delay-8-2 delay-8-3 delay-8-4 delay-8-5 delay-8-6 delay-8-7 delay-8-8 delay-8-9 delay-9 delay-9-1 delay-9-2 delay-9-3 delay-9-4 delay-9-5 delay-9-6 delay-9-7 delay-9-8 delay-9-9 delay-10';
                this.allEnterAnimsArr = this.allEnterAnims.split(' ');
                this.allExitAnimsArr = this.allExitAnims.split(' ');
                this.lastElemDelay = this.settings.slideDuration * (('s' === this.settings.timeUnit)?1000:1);
                this.nextSlideDelay = (this.settings.animationDuration + 0.5) * (('s' === this.settings.timeUnit)?1000:1);
                this.$slides = this.$slider.children('.' + this.settings.slideClass);
                if (0 >= this.$slides.length) {
                    throw new Error('No elements with the class "' + this.settings.slideClass + '" found!');
                }
                this.curSlide = 0;
                var $indicator = $('<div class="' + this.settings.indicatorWrapClass + '"></div>');

                for (var i = 0; this.$slides.length > i; i++) {
                    var that = this,
                        $slide = this.$slides.eq(i),
                        $elements = $slide.find('.' + this.settings.elementClass),
                        $firstElem = $elements.filter('.' + this.settings.firstElementClass),
                        $lastElem = $elements.filter('.' + this.settings.lastElementClass);
                    if (0 >= $elements.length) {
                        var animDur = $slide.data('duration'); 
                        $slide.data('animateSelf', 1);
                        $slide.css('animationDuration', (animDur ? animDur : this.settings.animationDuration) + this.settings.timeUnit); 
                        var slideHasEnterAnim = this.allEnterAnimsArr.some(function (anim) {
                                return anim === $slide.data('enter');
                            }),
                            slideHasExitAnim = this.allExitAnimsArr.some(function (anim) {
                                return anim === $slide.data('exit');
                            });
                        if (!slideHasEnterAnim) {
                            $slide.data('enter', this.settings.slideEntranceAnimation);
                        }
                        if (!slideHasExitAnim) {
                            $slide.data('exit', this.settings.slideExitAnimation);
                        }
                    } else {
                        $slide.data('animateSelf', 0);
                        $elements.each(function () {
                            var elemHasEnterAnim = that.allEnterAnimsArr.some(function (anim) {
                                    return anim === $(this).data('enter');
                                }),
                                elemHasExitAnim = that.allExitAnimsArr.some(function (anim) {
                                    return anim === $(this).data('exit');
                                }),
                                animDur = $(this).data('duration');
                            $(this).css('animationDuration', (animDur ? animDur : that.settings.animationDuration) + that.settings.timeUnit);
                            if (!elemHasEnterAnim) {
                                $(this).data('enter', that.settings.elementEntranceAnimation);
                            }
                            if (!elemHasExitAnim) {
                                $(this).data('exit', that.settings.elementExitAnimation);
                            }
                        });
                        if ($slide.data('domino')) {
                            if (0 >= $firstElem.length) {
                                $elements.first().addClass(this.settings.firstElementClass);
                            } else if (1 < $firstElem.length) {
                                $firstElem.removeClass(this.settings.firstElementClass);
                                $elements.first().addClass(this.settings.firstElementClass);
                            }
                            if (0 >= $lastElem.length) {
                                $elements.last().addClass(this.settings.lastElementClass);
                            } else if (1 < $lastElem.length) {
                                $lastElem.removeClass(this.settings.lastElementClass);
                                $elements.last().addClass(this.settings.lastElementClass);
                            }
                        }
                    }
                    $indicator.append('<span data-go-to-slide="' + i + '"></span>');
                }
                $indicator.appendTo(this.$slider);
                //TODO: add navigation arrows.
                this.$nav = this.$slider.find('.' + this.settings.navClass);
                this.$dot = this.$slider.find('.' + this.settings.indicatorWrapClass + ' span'); 
                //TODO: make next/previous buttons dynamic too.
                this.loadEvents();
                this.playSlide(0);

            },

            loadEvents: function () {
                var that = this;
                //TODO: don't forget relevant data on arrows/indicators.
                this.$nav.on('click', function (e) {
                    e.preventDefault();
                    clearTimeout(that.slideTimeout);
                    if ('next' === $(this).data('goToSlide')) {
                        that.playSlide(that.curSlide + 1);
                    } else {
                        that.playSlide(that.curSlide - 1);
                    }
                });
                this.$dot.on('click', function (e) {
                    e.preventDefault();
                    clearTimeout(that.slideTimeout);
                    clearTimeout(that.nextSlideTimeout);
                    var next = $(this).data('goToSlide'),
                        $curSlide = that.$slides.eq(that.curSlide);
                    that.killSlide($curSlide,next);
                    that.nextSlide(next);
                    //TODO: add a function that immediately does what the timeouts were supposed to do.
                    that.playSlide(next);
                });
            },

            playSlide: function (index) {
                //TODO:update indicators.
                var that = this, next;
                if (-1 === index && 0 === this.curSlide) {
                    next = this.$slides.length - 1;
                } else if (this.$slides.length === index && (this.$slides.length - 1) === this.curSlide) {
                    next = 0;
                } else if ((-1 < index) && (this.$slides.length > index)) {
                    next = index;
                } else {
                    return;
                }
                this.$dot.eq(this.curSlide).removeClass('rolling');
                this.nextSlideTimeout = setTimeout(function () {
                    that.nextSlide(next);
                }, this.nextSlideDelay)
            },

            nextSlide: function(index) {
                var $nextSlide = this.$slides.eq(index),
                    $curSlide = this.$slides.eq(this.curSlide);
                if ($curSlide.data('animateSelf')) {
                    $curSlide.removeClass('animated ' + $curSlide.data('exit'));
                }
                $curSlide.removeClass('rolling');
                $nextSlide.addClass('rolling');
                if ($nextSlide.data('animateSelf')) {
                    this.slideSelfAnimate($nextSlide );
                }
                else if ($nextSlide.data('domino')) {
                    this.slideDomino($nextSlide);
                } else {
                    this.slideAnimate($nextSlide);
                }
                this.curSlide = index;
                this.$dot.eq(index).addClass('rolling');
            },

            killSlide: function($theSlide, index) {
                var that = this;
                if($theSlide.data('animateSelf')) {
                    $theSlide.removeClass($theSlide.data('enter')).addClass($theSlide.data('exit'));
                } else {
                    var $elements = $theSlide.find('.' + this.settings.elementClass);
                    $elements.each(function () {
                        $(this).removeClass($(this).data('enter')).addClass($(this).data('exit'));
                    });
                }
                this.nextSlideTimeout = setTimeout(function () {
                    that.nextSlide(index);
                }, this.nextSlideDelay)
            },

            slideSelfAnimate: function ($theSlide) {
                var that = this,
                    enter = $theSlide.data('enter');
                $theSlide.addClass('animated ' + enter);
                this.slideTimeout = setTimeout(function () {
                    that.killSlide($theSlide, that.curSlide + 1)
                }, this.lastElemDelay);
            },

            slideDomino: function ($theSlide) {
                var that = this,
                    $elements = $theSlide.find('.' + this.settings.elementClass),
                    $first = $elements.filter('.' + this.settings.firstElementClass),
                    $last = $elements.filter('.' + this.settings.lastElementClass);
                $elements.not('.' + this.settings.lastElementClass).on('animationend', function () {
                    var $nextElem = $(this).next();
                    $nextElem.addClass('animated ' + $nextElem.data('enter'));
                });
                $last.on('animationend', function () {
                    $elements.off('animationend');
                    that.setSlideTimeout($theSlide);
                });
                $first.addClass('animated ' + $first.data('enter'));
            },

            slideAnimate: function ($theSlide) {
                var that = this,
                    $elements = $theSlide.find('.' + this.settings.elementClass),
                count = 0;
                $theSlide.on('animationend', function () {
                    count++;
                    if($elements.length === count) {
                        $theSlide.off('animationend');
                        $elements.removeClass(that.allDelays);
                        that.setSlideTimeout($theSlide);
                    }
                });
                $elements.each(function () {
                    var delay = $(this).data('delay');
                    $(this).addClass($(this).data('enter') + ' animated ' + (delay ? 'delay-' + delay : 'delay-0'));
                });
            },

            setSlideTimeout: function($theSlide) {
                var that = this;
                this.slideTimeout = setTimeout(function () {
                    that.killSlide($theSlide, that.curSlide+1);
                }, this.lastElemDelay);
            },

            defaults:
                {
                    timeUnit: 's',
                    slideClass: 'slide',
                    slideEntranceAnimation: 'slideInLeft',
                    slideExitAnimation: 'slideOutRight',
                    slideDuration: 5,
                    indicatorWrapClass: 'indicator',
                    navClass: 'nav',
                    userPauseDuration: 10,
                    animationDuration: .5,
                    elementClass: 'element',
                    elementEntranceAnimation: 'fadeIn',
                    elementEntranceDelay: 0,
                    elementExitAnimation: 'fadeOut',
                    firstElementClass: 'first',
                    lastElementClass: 'last',
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
