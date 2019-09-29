<?php

function vm_css_js () {

	wp_deregister_script( 'jquery' );

	$path = get_template_directory_uri();
	$min = VM_IS_DEV ? '' : '.vmcompiled.min';
	$dep_css = $dep_js = array();
	wp_enqueue_style( 'bootstrap', "$path/assets/bootstrap-4.3.1/bootstrap.min.css", array(), '4.3.1' );
	$dep_css []= 'bootstrap';
	wp_enqueue_style( 'basic', "$path/assets/custom/css/basic$min.css", array(), '1.0' );
	$dep_css []= 'basic';
	wp_enqueue_style( 'icons', "$path/assets/custom/css/icons$min.css", array(), '1.0' );
	$dep_css []= 'icons';
	wp_enqueue_style( 'animations', "$path/assets/custom/css/animations$min.css", array(), '1.0' );
	$dep_css []= 'animations';
	wp_enqueue_style('dashicons');
	$dep_css []= 'dashicons';

	wp_enqueue_script( 'jquery-js', "$path/assets/js/jquery-3.4.1.min.js", array(), '3.4.1');
	$dep_js []= 'jquery-js';
	wp_enqueue_script( 'bootstrap-js', "$path/assets/bootstrap-4.3.1/bootstrap.min.js", array(), '4.3.1', true);
	$dep_js []= 'bootstrap-js';
	wp_enqueue_script( 'generic-js', "$path/assets/custom/js/generic$min.js", array(), '1.0', true);
	$dep_js []= 'generic-js';

	if ( is_front_page() ) :
		wp_enqueue_style( 'front-page', "$path/assets/custom/css/front-page$min.css", $dep_css, '1.0' );
		wp_enqueue_script( 'front-page-js', "$path/assets/custom/js/front-page$min.js", $dep_js, '1.0', true );
	endif;

}

add_action( 'wp_enqueue_scripts', 'vm_css_js' );