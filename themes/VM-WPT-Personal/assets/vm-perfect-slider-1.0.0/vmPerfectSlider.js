
//TODO: make CSS dynamic
//TODO: add slider container class dynamically.
//TODO: add next slide preparation to avoid the white space between slides.

(function ($, window, document, undefined) {


    var vmPerfectSlider = function (element, options) {
        this.$slider = $(element);
        this.options = options;
    };


    vmPerfectSlider.prototype =
        {

            /**
             * Initiate the slider, looks for errors, mis-marks, etc., and sets the required variables, DOM data, etc.
             *
             */
            init: function () {

                this.settings = $.extend({}, this.defaults, this.options);
                this.$slides = this.$slider.children('.' + this.settings.slideClass);
                if (0 >= this.$slides.length) {
                    throw new Error('No elements with the class "' + this.settings.slideClass + '" found!');
                }

                this.$slider.addClass(this.settings.sliderClass);
                this.allEnterAnims = 'bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig flipInX flipInY lightSpeedIn rollIn rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight slideInDown slideInLeft slideInRight slideInUp zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp jackInTheBox';
                this.allExitAnims = 'bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipOutX flipOutY lightSpeedOut rollOut rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight slideOutDown slideOutLeft slideOutRight slideOutUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp hingeOut';
                this.allDelays = 'delay-0 delay-0-1 delay-0-2 delay-0-3 delay-0-4 delay-0-5 delay-0-6 delay-0-7 delay-0-8 delay-0-9 delay-1 delay-1-1 delay-1-2 delay-1-3 delay-1-4 delay-1-5 delay-1-6 delay-1-7 delay-1-8 delay-1-9 delay-2 delay-2-1 delay-2-2 delay-2-3 delay-2-4 delay-2-5 delay-2-6 delay-2-7 delay-2-8 delay-2-9 delay-3 delay-3-1 delay-3-2 delay-3-3 delay-3-4 delay-3-5 delay-3-6 delay-3-7 delay-3-8 delay-3-9 delay-4 delay-4-1 delay-4-2 delay-4-3 delay-4-4 delay-4-5 delay-4-6 delay-4-7 delay-4-8 delay-4-9 delay-5 delay-5-1 delay-5-2 delay-5-3 delay-5-4 delay-5-5 delay-5-6 delay-5-7 delay-5-8 delay-5-9 delay-6 delay-6-1 delay-6-2 delay-6-3 delay-6-4 delay-6-5 delay-6-6 delay-6-7 delay-6-8 delay-6-9 delay-7 delay-7-1 delay-7-2 delay-7-3 delay-7-4 delay-7-5 delay-7-6 delay-7-7 delay-7-8 delay-7-9 delay-8 delay-8-1 delay-8-2 delay-8-3 delay-8-4 delay-8-5 delay-8-6 delay-8-7 delay-8-8 delay-8-9 delay-9 delay-9-1 delay-9-2 delay-9-3 delay-9-4 delay-9-5 delay-9-6 delay-9-7 delay-9-8 delay-9-9 delay-10';
                this.allEnterAnimsArr = this.allEnterAnims.split(' ');
                this.allExitAnimsArr = this.allExitAnims.split(' ');
                this.slideDuration = this.settings.slideDuration * (('s' === this.settings.timeUnit) ? 1000 : 1);
                this.animDuration = this.settings.animationDuration * (('s' === this.settings.timeUnit) ? 1000 : 1);
                var $indicator = $('<nav class="' + this.settings.indicatorWrapClass + '"></nav>'),
                    nav = '<nav class="' + this.settings.arrowsWrapClass + '"><span class="' + this.settings.previousArrowClass + ' ' + this.settings.previousArrowIcon + '" data-go-to-slide="prev"></span><span class="' + this.settings.nextArrowClass + ' ' + this.settings.nextArrowIcon + '" data-go-to-slide="next"></span></nav>';

                for (var i = 0; this.$slides.length > i; i++) {
                    var that = this,
                        $slide = this.$slides.eq(i),
                        $elements = $slide.find('.' + this.settings.elementClass);
                    if (0 >= $elements.length) {
                        $slide.data('animateSelf', 1);
                        $slide.css('animationDuration', this.settings.animationDuration + this.settings.timeUnit);
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
                            var $elem = $(this),
                                elemHasEnterAnim = that.allEnterAnimsArr.some(function (anim) {
                                    return anim === $elem.data('enter');
                                }),
                                elemHasExitAnim = that.allExitAnimsArr.some(function (anim) {
                                    return anim === $elem.data('exit');
                                });
                            $(this).css('animationDuration', that.settings.animationDuration + that.settings.timeUnit);
                            if (!elemHasEnterAnim) {
                                $(this).data('enter', that.settings.elementEntranceAnimation);
                            }
                            if (!elemHasExitAnim) {
                                $(this).data('exit', that.settings.elementExitAnimation);
                            }
                        });
                        if ($slide.data('domino')) {
                            var $firstElem = $elements.filter('.' + this.settings.firstElementClass),
                                $lastElem = $elements.filter('.' + this.settings.lastElementClass);
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
                this.$slider.append(nav);
                this.$nav = this.$slider.find('.' + this.settings.arrowsWrapClass + ' .' + this.settings.nextArrowClass + ',.' + this.settings.arrowsWrapClass + ' .' + this.settings.previousArrowClass);
                this.$dot = this.$slider.find('.' + this.settings.indicatorWrapClass + ' span');
                this.loadEvents();
                this.initSlide(0, 0);
            },

            /**
             * Bind events slide controller elements.
             *
             */
            loadEvents: function () {
                var that = this;
                this.$nav.on('click', function () {
                    $(this).hide();
                    that.killTransition();
                    if ('next' === $(this).data('goToSlide')) {
                        that.switchSlide(that.curSlide + 1, 1);
                    } else {
                        that.switchSlide(that.curSlide - 1, 1);
                    }
                    $(this).show(that.animDuration);
                });
                this.$dot.on('click', function () {
                    var $dots = $(this).parent();
                    $dots.hide();
                    var next = $(this).data('goToSlide');
                    if (that.curSlide === next) {
                        return;
                    }
                    that.killTransition();
                    that.switchSlide(next, 1);
                    $dots.show(that.animDuration);
                });
            },

            /**
             * Select the appropriate method to play the slide, sets the indicator and the 'curSlide' pointer.
             *
             * @param index  Slide no.
             * @param manual User interaction flag; 1 if navigated by user, 0 otherwise
             *
             */
            initSlide: function (index, manual) {
                this.curSlide = index;
                var $slide = this.$slides.eq(index);
                $slide.addClass('rolling');
                this.$dot.eq(index).addClass('rolling');
                if ($slide.data('animateSelf')) {
                    $slide.addClass($slide.data('enter') + ' animated');
                    this.setSlideTimeout($slide, manual);
                } else {
                    this.animateElements($slide, manual);
                }
            },

            /**
             * Kills slide transition timeouts.
             *
             */
            killTransition: function () {
                clearTimeout(this.slideTimeout);
                clearTimeout(this.nextSlideTimeout);
            },

            /**
             * Determine the next slide to show, and switches between current slide and next slide.
             *
             * @param index  Slide no. (ranging from 0 to {this.$slides.length - 1})
             * @param manual User interaction flag; 1 if navigated by user, 0 otherwise
             *
             */
            switchSlide: function (index, manual) {
                var next;
                if (-1 === index && 0 === this.curSlide) {
                    next = this.$slides.length - 1;
                } else if (this.$slides.length === index && (this.$slides.length - 1) === this.curSlide) {
                    next = 0;
                } else if ((-1 < index) && (this.$slides.length > index)) {
                    next = index;
                }
                this.resetSlide(this.curSlide);
                this.initSlide(next, manual ? 1 : 0);
            },

            /**
             * Animate slide elements.
             *
             * @param $slide    The slide
             * @param manual    User interaction flag; 1 if navigated by user, 0 otherwise
             *
             */
            animateElements: function ($slide, manual) {
                var that = this,
                    $elements = $slide.find('.' + this.settings.elementClass);
                $elements.each(function () {
                    $(this).addClass();
                });
                if ($slide.data('domino')) {
                    var $first = $elements.filter('.' + this.settings.firstElementClass),
                        $last = $elements.filter('.' + this.settings.lastElementClass);
                    $elements.not($last).on('animationend', function () {
                        var $nextElem = $(this).next('.' + that.settings.elementClass).not('.animated');
                        if (0 < $nextElem.length) {
                            $nextElem.addClass('animated ' + $(this).data('enter'));
                        }
                    });
                    $last.on('animationend', function () {
                        $elements.off('animationend');
                        that.setSlideTimeout($slide, manual);
                    });
                    $first.addClass('animated ' + $(this).data('enter'));

                } else {
                    var count = 0;
                    $slide.on('animationend', function () {
                        count++;
                        if ($elements.length === count) {
                            $slide.off('animationend');
                            $elements.removeClass(that.allDelays);
                            that.setSlideTimeout($slide, manual);
                        }
                    });
                    $elements.each(function () {
                        var delay = $(this).data('delay');
                        $(this).addClass($(this).data('enter') + ' animated ' + (delay ? 'delay-' + delay : 'delay-0'));
                    });
                }

            },

            /**
             * Reset contents of the last slide.
             *
             * @param index Slide no.
             *
             */
            resetSlide: function (index) {
                var $slide = this.$slides.eq(index);
                $slide.removeClass('rolling');
                this.$dot.eq(index).removeClass('rolling');
                if ($slide.data('animateSelf')) {
                    $slide.removeClass($slide.data('enter') + ' animated ' + $slide.data('exit'));
                } else {
                    $slide.find('.' + this.settings.elementClass).removeClass(this.allEnterAnims + ' animated ' + this.allDelays + ' ' + this.allExitAnims);
                }
            },

            /**
             * Set the time to wait for the current slide elements to disappear before switching to a new slide.
             *
             * @param $slide The disappearing slide.
             * @param manual User interaction flag; 1 if navigated by user, 0 otherwise
             *
             */
            setSlideTimeout: function ($slide, manual) {
                var that = this;
                if (manual) {
                    this.nextSlideTimeout = setTimeout(function () {
                        that.endSlide($slide);
                    }, this.settings.userPauseDuration * (('s' === this.settings.timeUnit) ? 1000: 0) * 100);
                } else {
                    this.nextSlideTimeout = setTimeout(function () {
                        that.endSlide($slide);
                    }, this.slideDuration);
                }
            },

            /**
             * Set the time to keep elements on the slide after its last element has appeared.
             *
             * @param $slide The disappearing slide
             *
             */
            endSlide: function ($slide) {
                var that = this;
                if ($slide.data('animateSelf')) {
                    $slide.removeClass($slide.data('enter')).addClass($slide.data('exit'));
                    this.slideTimeout = setTimeout(function () {
                        that.switchSlide(that.curSlide + 1, 0);
                    }, this.animDuration);
                } else {
                    $slide.find('.' + this.settings.elementClass).each(function () {
                        $(this).removeClass($(this).data('enter')).addClass($(this).data('exit'));
                    });
                    this.slideTimeout = setTimeout(function () {
                        that.switchSlide(that.curSlide + 1, 0);
                    }, this.animDuration);
                }
            },

            defaults:
                {
                    timeUnit: 's',
                    animationDuration: 0.5,
                    userPauseDuration: 10,
                    sliderClass: 'vmPS',
                    slideDuration: 5,
                    slideClass: 'slide',
                    slideEntranceAnimation: 'slideInLeft',
                    slideExitAnimation: 'slideOutRight',
                    indicatorWrapClass: 'indicator',
                    arrowsWrapClass: 'arrow',
                    nextArrowClass: 'next',
                    previousArrowClass: 'prev',
                    nextArrowIcon: 'vm-icon vmi-random',
                    previousArrowIcon: 'vm-icon vmi-random', //TODO: add icon: left/right arrows
                    elementClass: 'element',
                    elementEntranceDelay: 0,
                    elementEntranceAnimation: 'fadeIn',
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
