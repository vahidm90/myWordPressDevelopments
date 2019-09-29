document.onreadystatechange = function(e)
{
    if(document.readyState=="interactive")
    {
        var all = document.getElementsByTagName("*");
        for (var i=0, max=all.length; i < max; i++)
        {
            set_ele(all[i]);
        }
    }
};

function check_element(ele)
{
    var all = document.getElementsByTagName("*");
    var per_inc=100/all.length;

    if($(ele).on())
    {
        var prog_width=per_inc+Number(document.getElementById("progress_width").value);
        document.getElementById("progress_width").value=prog_width;
        $('.percentage').html(Math.floor(prog_width));
        if(100 <= parseInt(document.getElementById("progress_width").value) )
        {
            $("#splash").fadeOut("slow");
        }
    }

    else
    {
        set_ele(ele);
    }
}

function set_ele(set_element)
{
    check_element(set_element);
}


var bodyScrYpos = 0;
$('.cat-ball').click(function () {
    bodyScrYpos = window.pageYOffset || document.documentElement.scrollTop;
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $target.css('marginTop',  '-100vh').removeClass('d-none');
        $('body').animate({marginTop:'100vh'}, 1000);
        $target.animate({marginTop:0}, 1000);
    }
});
$('.cat-content-back-btn').click(function (e) {
    e.preventDefault();
    document.documentElement.scrollTop = document.body.scrollTop = bodyScrYpos;
    var $target = $($(this).data('cat'));
    if ($target.length) {
        $('body').animate({marginTop: 0}, 1000);
        $target.animate({marginTop:'-100vh'}, 1000, function () {
            $(this).addClass('d-none');
        });
    }
});



$(function () {

});
