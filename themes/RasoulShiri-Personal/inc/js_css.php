<?php

function vmp_load_css_js() {

    $path = get_template_directory_uri() . '/assets';
    wp_deregister_script('wp-embed');

    if (is_page('test')) :
        wp_enqueue_script('vmp-jquery-js', "$path/js/jquery-3.3.1.min.js", array(), '3.3.1', true);
        wp_enqueue_script('vmp-popper-js', "$path/js/popper.min.js", array(), false, true);
        wp_enqueue_script('vmp-tooltip-js', "$path/js/tooltip.min.js", array(), false, true);
        wp_enqueue_script('vmp-custom-template-js', "$path/js/custom-template.js", array(), '1.0.0', true);
        return;
    endif;

    wp_enqueue_style('vmp-bootstrap', "$path/css/bootstrap.min.css");
    wp_enqueue_style('vmp-aos', "$path/css/aos.min.css");
    wp_enqueue_style('vmp-basic', "$path/css/basic.css");
    wp_enqueue_style('vmp-icons', "$path/css/icons.css");
    wp_enqueue_style('vmp-fonts', "$path/css/fonts.css");
    wp_enqueue_style('vmp-popper', "$path/css/popper.css");
    wp_enqueue_style('vmp-landing', "$path/css/landing.css", array('vmp-basic'));

    wp_enqueue_script('vmp-jquery-js', "$path/js/jquery-3.3.1.min.js", array(), '3.3.1', true);
    wp_enqueue_script('vmp-popper-js', "$path/js/popper.min.js", array(), false, true);
    wp_enqueue_script('vmp-tooltip-js', "$path/js/tooltip.min.js", array(), false, true);
    wp_enqueue_script('vmp-aos-js', "$path/js/aos.min.js", array(), false, true);
    wp_enqueue_script('vmp-bootstrap-js', "$path/js/bootstrap.min.js", array('vmp-jquery-js', 'vmp-popper-js'), '4.1.3', true);
    wp_enqueue_script('vmp-landing-js', "$path/js/landing.js", array('vmp-jquery-js', 'vmp-popper-js', 'vmp-tooltip-js'), '1.0.0', true);

    if (is_front_page()) :
        wp_enqueue_style('vmp-front-page', "$path/css/home.css", array('vmp-basic'));
        wp_enqueue_script('vmp-home-js', "$path/js/home.js", array(), '1.0.0', true);
    elseif (is_page()) :
        wp_enqueue_style('vmp-custom-template', "$path/css/custom-template.css", array('vmp-basic'));
        wp_enqueue_script('vmp-custom-template-js', "$path/js/custom-template.js", array(), '1.0.0', true);
    endif;
}

add_action('wp_enqueue_scripts', 'vmp_load_css_js');

function front_page_inline_js() {
    if (!is_front_page()) :
        return;
    endif;
    ?>

    <script>
        $(window).on('activate.bs.scrollspy', function (e)
        {
            var $topBar = $('#static-top-bar');
            $('.nav-link', $topBar).removeClass('active');
            $('.nav-link[href="' + $('#dynamic-nav .nav-link.active').attr('href') + '"]', $topBar).addClass('active');

        });
        AOS.init({duration: 1000, mirror: true});
    </script>

    <?php

}

add_action('wp_footer', 'front_page_inline_js', 21);
