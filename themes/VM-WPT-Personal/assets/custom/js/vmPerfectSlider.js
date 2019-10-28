(function ($, window, document, undefined) {
    var vmPerfectSlider = function (element, options) {
        this.$slider = $(element);
        this.options = options;
    };
    vmPerfectSlider.prototype =
        {
            init: function () {

                this.settings = $.extend({}, this.defaults, this.options);
                this.slides = this.$slider.children(this.settings.elementSelector);
                this.slidesCount = this.slides.length;
                this.interval = [];//Ovveride config.interval
                //TODO: if you can proceed as does this plugin, add the interval option.
                this.current = 0; //first slide
//TODO: add the options to customize indicator markup/css.
                var $dots = $('<div class="anim-dots"></div>');
                var temp = this.slidesCount;
                while (temp--) {
                    $dots.append("<span></span>");
                }
                $dots.appendTo(this.$slider);
                this.slides.eq(this.current).addClass('current-slide');

                this.$nav = this.$slider.find('.slide-nav');

                this.$dots = this.$slider.find('.anim-dots>span');
                //TODO: add the options to customize navigation arrows markup/css.
                this.$navNext = this.$slider.find(".anim-arrows-next");
                this.$navPrev = this.$slider.find(".anim-arrows-prev");

                this.loadEvents();
                this.navigate(this.current);
                this.updateDots();
                this.autoplay();
            },
            loadEvents: function () {
                var that = this;
                //TODO: don't forget relevant data on arrows/dots.
                this.$nav.on('click.vmPS', function (e) {
                    if (!$(this).data('go-to')) {
                        return;
                    }
                    e.preventDefault();
                    switch ($(this).data('go-to')) {
                        default:
                            that.navigate(parseInt($(this).data('where'), 10));
                            break;
                        case 'N' :
                            that.navigate(that.current + 1);
                            break;
                        case 'P' :
                            that.navigate(that.current - 1);
                            break;
                    }
                });
            },
            navigate: function (slide) {
            	var next;
            	if ( -1 === slide ) {
            		next = this.slidesCount - 1;
				} else if ( this.slidesCount === slide ) {
            		next = 0;
				} else if ( (-1 < slide)&&( this.slidesCount > slide) ) {
            		next = slide;
				} else {
            		return;
				}
                //Classes created from animate.css, you can add your own here.
                var classes = 'bounce flash pulse rubberBand shake swing tada wobble bounceIn bounceInDown bounceInRight bounceInUp bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipInX flipInY flipOutX flipOutY lightSpeedIn lightSpeedOut rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight slideInDown slideInLeft slideInRight slideOutLeft slideOutRight slideOutUp slideInUp slideOutDown hinge rollIn rollOut fadeInUpLarge fadeInDownLarge fadeInLeftLarge fadeInRightLarge fadeInUpLeft fadeInUpLeftBig fadeInUpLeftLarge fadeInUpRight fadeInUpRightBig fadeInUpRightLarge fadeInDownLeft fadeInDownLeftBig fadeInDownLeftLarge fadeInDownRight fadeInDownRightBig fadeInDownRightLarge fadeOutUpLarge fadeOutDownLarge fadeOutLeftLarge fadeOutRightLarge fadeOutUpLeft fadeOutUpLeftBig fadeOutUpLeftLarge fadeOutUpRight fadeOutUpRightBig fadeOutUpRightLarge fadeOutDownLeft fadeOutDownLeftBig fadeOutDownLeftLarge fadeOutDownRight fadeOutDownRightBig fadeOutDownRightLarge bounceInBig bounceInLarge bounceInUpBig bounceInUpLarge bounceInDownBig bounceInDownLarge bounceInLeft bounceInLeftBig bounceInLeftLarge bounceInRightBig bounceInRightLarge bounceInUpLeft bounceInUpLeftBig bounceInUpLeftLarge bounceInUpRight bounceInUpRightBig bounceInUpRightLarge bounceInDownLeft bounceInDownLeftBig bounceInDownLeftLarge bounceInDownRight bounceInDownRightBig bounceInDownRightLarge bounceOutBig bounceOutLarge bounceOutUpBig bounceOutUpLarge bounceOutDownBig bounceOutDownLarge bounceOutLeftBig bounceOutLeftLarge bounceOutRightBig bounceOutRightLarge bounceOutUpLeft bounceOutUpLeftBig bounceOutUpLeftLarge bounceOutUpRight bounceOutUpRightBig bounceOutUpRightLarge bounceOutDownLeft bounceOutDownLeftBig bounceOutDownLeftLarge bounceOutDownRight bounceOutDownRightBig bounceOutDownRightLarge zoomIn zoomInUp zoomInUpBig zoomInUpLarge zoomInDown zoomInDownBig zoomInDownLarge zoomInLeft zoomInLeftBig zoomInLeftLarge zoomInRight zoomInRightBig zoomInRightLarge zoomInUpLeft zoomInUpLeftBig zoomInUpLeftLarge zoomInUpRight zoomInUpRightBig zoomInUpRightLarge zoomInDownLeft zoomInDownLeftBig zoomInDownLeftLarge zoomInDownRight zoomInDownRightBig zoomInDownRightLarge zoomOut zoomOutUp zoomOutUpBig zoomOutUpLarge zoomOutDown zoomOutDownBig zoomOutDownLarge zoomOutLeft zoomOutLeftBig zoomOutLeftLarge zoomOutRight zoomOutRightBig zoomOutRightLarge zoomOutUpLeft zoomOutUpLeftBig zoomOutUpLeftLarge zoomOutUpRight zoomOutUpRightBig zoomOutUpRightLarge zoomOutDownLeft zoomOutDownLeftBig zoomOutDownLeftLarge zoomOutDownRight zoomOutDownRightBig zoomOutDownRightLarge flipInTopFront flipInTopBack flipInBottomFront flipInBottomBack flipInLeftFront flipInLeftBack flipInRightFront flipInRightBack flipOutTopFront flipOutTopBack flipOutBottomFront flipOutBottomback flipOutLeftFront flipOutLeftBack flipOutRightFront flipOutRightBack strobe shakeX shakeY spin spinReverse slingshot slingshotReverse pulsate heartbeat panic jackInTheBox jello';
                var classShow, classHide, delayShow, $next, $current, currentAnimate, nextAnimate;

                $current = this.slides.eq(this.current);
                currentAnimate = this.elemAnimate(this.current, this.config);
                this.current = page;
                $next = this.slides.eq(this.current);
                nextAnimate = this.elemAnimate(this.current, this.config);

                /*=========================================*/
                $current.removeClass(" anim-slide-this " + classes);
                $current.find("*").removeClass(classes);

                //Iterate through a javascript plain object of current and next Slide
                $.each(currentAnimate, function (index) {
                    if (index == $current.prop("tagName").toLowerCase()) {
                        classHide = $current.data("classHide");
                        delayShow = $current.data("delayShow");
                        $current.removeClass(delayShow);
                        $current.addClass(classHide + " animated");
                    } else {
                        classHide = $current.find(index).data("classHide");
                        delayShow = $current.find(index).data("delayShow");
                        $current.find(index).removeClass(delayShow);
                        $current.find(index).addClass(classHide + " animated");
                    }
                });
                $.each(nextAnimate, function (index) {
                    if (index == $current.prop("tagName").toLowerCase()) {
                        classShow = $next.data("classShow");
                        delayShow = $next.data("delayShow");
                        $next.removeClass(classes);
                        $next.addClass(classShow + " " + delayShow + " animated");
                    } else {
                        classShow = $next.find(index).data("classShow");
                        delayShow = $next.find(index).data("delayShow");
                        $next.find(index).removeClass(classes);
                        $next.find(index).addClass(classShow + " " + delayShow + " animated ");
                    }
                });

                $next.addClass(" anim-slide-this");
                /*=========================================*/
                this.updateDots();
            },

        };
    $.fn.vmPerfectSlider = function (options) {

        var settings = $.extend({}, $.fn.vmPerfectSlider.defaults, options);

        return this.each(function () {
            var $slider = $(this),
                $slides = $slider.children(settings.slideSelector);
            $slides.each(function () {
                var $sliders = $(this).children(settings.elementSelector);
                if ($(this).data('vmPS-domino')) {
                    $(this).children(':not(:last-child)').on('animationend', function () {
                        var $nextElement = $(this).next();
                        $nextElement.addClass($nextElement.data('vmPS-animation') + ' animated')
                    })
                }
                $(this).children(settings.elementSelector).each(function () {
                    if ($(this).data('vmPS-animation')) {
                        $(this).addClass()
                    }
                })
            });
        });

    };

    $.fn.vmPerfectSlider.defaults = {
        slideSelector: '.slide',
        elementSelector: '*',
        elementAnimationDuration: .1,
        elementEntranceAnimation: 'fadeIn',
        elementEntranceDelay: 0,
        elementExitAnimation: 'fadeOut',
        elementStay: 2,
        lastElementData: 'vmPS-last',
    }

}(jQuery));
