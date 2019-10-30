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
                this.slides.on( 'slideEnd.vmPS', '[data-vmPS-last="1"]', function () {
                    this.navigate(++this.current);
                });
                this.slides.filter('[data-vmPS-domino="1"]').children(':not(:last-child)').on('animationend', function () {
                    var $nextElement = $(this).next(),
                        animation = $nextElement.data('vmPS-animation')?$nextElement.data('vmPS-animation'):this.settings.elementEntranceAnimation,
                        delay = $nextElement.data('vmPS-entrance-delay')?parseInt($nextElement.data('vmPS-entrance-delay'), 10):this.settings.elementEntranceDelay;

                    $nextElement.addClass('animated')
                })
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
            	if (this.slides.eq(this.current).data('vmPS-domino')) {
            	    this.slideDomino();
                } else {
                    this.slideAnimations(this.current);
                }
            	this.navigate(next);
                this.updateIndicators();
            },
            slideDomino: function () {
                this.slides.eq(this.current).children().each(function () {
                    if ($(this).data('vmPS-animation')) {
                        addClass()
                    }
                })
            }
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
