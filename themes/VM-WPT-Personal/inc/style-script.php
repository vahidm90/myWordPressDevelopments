<?php

/**
 * Load front-end CSS and JS files
 *
 */
function vm_css_js_front_end () {

	wp_deregister_script( 'jquery' );

	$path = get_template_directory_uri() . '/assets/';
	$min = VM_IS_DEV ? '' : '.vmcompiled.min';
	$dep_css = $dep_js = array();

	wp_enqueue_style( 'bootstrap', "$path/bootstrap-4.3.1/bootstrap.min.css", array(), '4.3.1' );
	$dep_css []= 'bootstrap';
	wp_enqueue_style( 'basic', "$path/custom/css/basic$min.css", array(), '1.0' );
	$dep_css []= 'basic';
	wp_enqueue_style( 'icons', "$path/custom/css/icons$min.css", array(), '1.0' );
	$dep_css []= 'icons';
	wp_enqueue_style( 'animations', "$path/custom/css/animations$min.css", array(), '1.0' );
	$dep_css []= 'animations';
	wp_enqueue_style('dashicons');
	$dep_css []= 'dashicons';

	wp_enqueue_script( 'jquery-js', "$path/js/jquery-3.4.1.min.js", array(), '3.4.1');
	$dep_js []= 'jquery-js';
	wp_enqueue_script( 'bootstrap-js', "$path/bootstrap-4.3.1/bootstrap.min.js", array(), '4.3.1', true);
	$dep_js []= 'bootstrap-js';
	wp_enqueue_script( 'generic-js', "$path/custom/js/generic$min.js", array(), '1.0', true);
	$dep_js []= 'generic-js';

	if ( is_front_page() ) :

		wp_enqueue_style( 'front-page', "$path/custom/css/front-page$min.css", $dep_css, '1.0' );

		wp_enqueue_script( 'front-page-js', "$path/custom/js/front-page$min.js", $dep_js, '1.0', true );

	endif;

}

add_action( 'wp_enqueue_scripts', 'vm_css_js_front_end' );


function vm_css_js_back_end( $hook ) {

	if ( wp_doing_ajax() ) :
		return;
	endif;

	$path = get_template_directory_uri() . '/assets';
	$min = VM_IS_DEV ? '' : '.vmcompiled.min';
	$dep_css = $dep_js = array();

	switch ($hook) :

		default :
			break;

		case 'appearance_page_vm-front-page-tiers-options' :

			wp_enqueue_style( 'autocomplete', "$path/awesomplete/awesomplete$min.css", array(), '1.1.5' );
			$dep_css []= 'autocomplete';
			wp_enqueue_style( 'autocomplete-theme', "$path/awesomplete/awesomplete.theme$min.css", $dep_css, '1.1.5' );

			wp_enqueue_script( 'autocomplete-js', "$path/awesomplete/awesomplete.min.js", array(), '1.1.5', true );
			wp_enqueue_script( 'jquery' );
			$dep_js = 'autocomplete-js';
			wp_enqueue_script( 'fp-tiers-js', "$path/custom/js/options-fp-tiers$min.js", $dep_js, '1.0', true );

			break;

	endswitch;
}

add_action( 'admin_enqueue_scripts', 'vm_css_js_back_end' );