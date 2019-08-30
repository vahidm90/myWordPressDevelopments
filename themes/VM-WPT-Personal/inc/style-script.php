<?php

function vm_css_js () {

	wp_deregister_script( 'jquery' );

	$path = get_template_directory_uri();
	$min = VM_IS_DEV ? '' : '.vmcompiled.min';
	$dep_css = $dep_js = array();
	wp_enqueue_style( 'bootstrap', "$path/assets/bootstrap-4.3.1/bootstrap.min.css", array(), '4.3.1' );
	$dep_css []= 'bootstrap';
	wp_enqueue_script( 'jquery', "$path/assets/javascript/jquery-3.4.1.min.js", array(), '3.4.1', true);
	$dep_js []= 'jquery';



	wp_enqueue_style( 'front-page', "$path/assets/custom/css/front-page$min.css", $dep_css, '1.0' );
	wp_enqueue_script( 'front-page', "$path/assets/custom/js/front-page$min.js", $dep_js, '1.0', true );

}

add_action( 'wp_enqueue_scripts', 'vm_css_js' );