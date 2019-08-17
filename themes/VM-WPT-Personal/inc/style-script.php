<?php

function vm_css_js () {
	$path = get_template_directory_uri();
	$min = VM_IS_DEV ? '' : '.vmcompiled.min';
	$dep_css = array();
	wp_enqueue_style( 'bootstrap', "$path/assets/bootstrap-4.3.1/bootstrap$min.css", array(), '4.3.1' );
	$dep_css []= 'bootstrap';

		wp_enqueue_style( 'front-page', "$path/assets/bootstrap-4.3.1/bootstrap$min.css", $dep_css, '1.0' );

}

add_action( 'wp_enqueue_scripts', 'vm_css_js' );