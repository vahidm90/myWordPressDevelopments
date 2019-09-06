$('.cat-ball').click(function () {
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $('html,body').animate({scrollTop: $target.offset().top}, 300, 'swing');
    }
});
