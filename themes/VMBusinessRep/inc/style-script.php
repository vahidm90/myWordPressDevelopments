<?php

/**
 * Enqueues style sheets and javascript files.
 */
function vmbwpt_load_css_js() {
	global $vmbwpt_lang, $vmbwpt_dir, $vmbwpt_is_dev;

	$rtl = ( 'left' === $vmbwpt_dir ? '' : '-rtl' );
	$min = $vmbwpt_is_dev ? '' : '.min';
	$css_dep = array();
	$js_dep  = array();
	$path = get_template_directory_uri() . '/assets';

	wp_deregister_script( 'jquery' );
	if ( ! is_admin() ) :
		wp_deregister_style( 'wp-block-library' );
	endif;
//TODO: Use CDNs.

//  WordPress icons
	wp_enqueue_style( 'dashicons' );

//  Bootstrap CSS
	wp_enqueue_style( 'vmbwpt-bootstrap', "$path/bootstrap/bootstrap$rtl$min.css", array(), '4.2.1' );
	array_push( $css_dep, 'vmbwpt-bootstrap' );

//	jQuery Mobile CSS
	wp_enqueue_style( 'vmbwpt-jquery-mobile-theme', "$path/jQuery/pnj$min.css", $css_dep, '1.4.5' );
	array_push( $css_dep, 'vmbwpt-jquery-mobile-theme' );
	wp_enqueue_style( 'vmbwpt-jquery-mobile-structure', "$path/jQuery/jquery.mobile.structure-1.4.5$min.css", $css_dep, '1.4.5' );
	array_push( $css_dep, 'vmbwpt-jquery-mobile-structure' );

//	jQueryUI CSS
	wp_enqueue_style( 'vmbwpt-jqueryUI', "$path/jQuery/jquery-ui$min.css", $css_dep, '1.12.1' );
	array_push( $css_dep, 'vmbwpt-jqueryUI' );

//	Template CSS
	wp_enqueue_style( 'vmbwpt-basic', "$path/css/basic$rtl$min.css", $css_dep, '1.0' );
	array_push( $css_dep, 'vmbwpt-basic' );

//  jQuery JS
	wp_enqueue_script( 'vmbwpt-jquery-js', "$path/jQuery/jquery-1.12.4$min.js", array(), '1.12.4', true );
	array_push( $js_dep, 'vmbwpt-jquery-js' );
	wp_enqueue_script( 'vmbwpt-jqueryUI-js', "$path/jQuery/jquery-ui-1.12.1$min.js", array(), '1.12.1', true );
	array_push( $js_dep, 'vmbwpt-jqueryUI-js' );
	//TODO: Make jQuery Mobile Work on Remote Server.
	wp_enqueue_script( 'vmbwpt-basic-js', "$path/js/basic$min.js", array(), '1.0', true );
	array_push( $js_dep, 'vmbwpt-basic-js' );
	wp_enqueue_script( 'vmbwpt-jquery-mobile-js', "$path/jQuery/jquery.mobile-1.4.5$min.js", array(), '1.4.5', true );
	array_push( $js_dep, 'vmbwpt-jquery-mobile-js' );

//	Bootstrap JS
	wp_enqueue_script( 'vmbwpt-bootstrap-js', "$path/bootstrap/bootstrap$rtl$min.js", $js_dep, '4.3.1', true );
	array_push( $js_dep, 'vmbwpt-bootstrap-js' );

//  Template JS
	wp_enqueue_script( 'vmbwpt-nav-menu-js', "$path/js/nav-menu$min.js", array(), '1.0', true );
	array_push( $js_dep, 'vmbwpt-nav-menu-js' );

	if ( is_front_page() ) :

//      CSS
		wp_enqueue_style( 'vmbwpt-anim-slider', "$path/animSlider/animSlider$rtl$min.css", $css_dep, '1.0.6' );
		array_push( $css_dep, 'vmbwpt-anim-slider' );
		wp_enqueue_style( 'vmbwpt-normalize', "$path/animSlider/normalize-8.0.1$min.css", array(), '8.0.1' );
		array_push( $css_dep, 'vmbwpt-normalize' );
		wp_enqueue_style( 'vmbwpt-aos', "$path/aos/aos-2.3.4.min.css", $css_dep, '2.3.4' );
		array_push( $css_dep, 'vmbwpt-aos' );
		wp_enqueue_style( 'vmbwpt-front-page', "$path/css/front-page$rtl$min.css", $css_dep, '1.0' );

//		JS
		wp_enqueue_script( 'vmbwpt-modernize-js', "$path/animSlider/modernizer-2.8.1$min.js", $js_dep, '2.8.1', true );
		array_push( $js_dep, 'vmbwpt-modernize-js' );
		wp_enqueue_script( 'vmbwpt-anim-slider-js', "$path/animSlider/animateSlider$min.js", $js_dep, '1.0.6', true );
		array_push( $js_dep, 'vmbwpt-anim-slider-js' );
		wp_enqueue_script( 'vmbwpt-aos-js', "$path/aos/aos-2.3.4.min.js", $js_dep, '2.3.4', true );
		wp_add_inline_script( 'vmbwpt-aos-js', 'AOS.init({duration:1000});' );
		wp_enqueue_script( 'vmbwpt-front-page-js', "$path/js/front-page$rtl$min.js", $js_dep, '1.0', true );

    elseif ( is_singular( 'page' ) ) :

		wp_enqueue_style( 'vmbwpt-page', "$path/css/page$min.css", $css_dep, '1.0' );

	endif;

}

add_action( 'wp_enqueue_scripts', 'vmbwpt_load_css_js' );


function vmbwpt_front_page_footer_script() {
	if ( ! is_front_page() || wp_doing_ajax() ) :
		return;
	endif;
	?>
    <script>
    </script><?php
}

//add_action( 'wp_footer', 'vmbwpt_front_page_footer_script' );