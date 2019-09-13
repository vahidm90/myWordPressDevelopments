$('.cat-ball').click(function () {
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $target.css('marginTop',  '-100vh').removeClass('d-none');
        $('body').animate({marginTop:'100vh'}, 1000);
        $target.animate({marginTop:0}, 1000);
    }
});
$('.cat-content-back-btn').click(function (e) {
    e.preventDefault();
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $('body').animate({marginTop: 0}, 1000);
        $target.animate({marginTop:'-100vh'}, 1000, function () {
            $(this).addClass('d-none');
        });
    }
});
