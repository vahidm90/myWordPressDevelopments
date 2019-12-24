<?php

//TODO: use CDNs. 


/**
 * Load front-end CSS and JS files.
 *
 */
function vm_css_js_front_end() {

	wp_deregister_script( 'jquery' );

	switch (VM_IS_DEV) :
		case true :
			vm_load_dev_css_js();
			break;
		default :
			vm_load_production_css_js();
			break;
	endswitch;

}

add_action( 'wp_enqueue_scripts', 'vm_css_js_front_end' );


/**
 * Load CSS and JS files for development environment. 
 * 
 */
function vm_load_dev_css_js() {

	$path    = get_template_directory_uri() . '/assets';
	$dep_css = $dep_js = array();

	wp_enqueue_script( 'jquery-js', "$path/js/jquery-3.4.1.min.js", array(), '3.4.1', true );
	$dep_js [] = 'jquery-js';

	wp_enqueue_style( 'bootstrap', "$path/bootstrap-4.2.1-rtl/bootstrap.min.css", array(), '4.2.1' );
	$dep_css [] = 'bootstrap';
	wp_enqueue_script( 'bootstrap-js', "$path/bootstrap-4.2.1-rtl/bootstrap.min.js", $dep_js, '4.2.1', true );
	$dep_js [] = 'bootstrap-js';

	wp_enqueue_style( 'basic', "$path/css/basic.css", $dep_css, '1.0' );
	$dep_css [] = 'basic';

	if ( is_front_page() ) :
		wp_enqueue_style( 'front-page', "$path/css/front-page.css", $dep_css, '1.0' );
		wp_enqueue_script( 'front-page-js', "$path/js/front-page.js", $dep_js, '1.0' );
	endif;

}




/**
 * Load CSS and JS files for production environment.
 *
 */
function vm_load_production_css_js() {

	$path    = get_template_directory_uri() . '/assets';
	$dep_css = $dep_js = array();
	add_filter( 'script_loader_tag', 'vm_add_sri_attributes', 10, 2 );
	add_filter( 'style_loader_tag', 'vm_add_sri_attributes', 10, 2 );

	wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), null, true );
	$dep_js []= 'jquery-js';

	wp_enqueue_style( 'bootstrap', 'https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css', array(), null );
	$dep_css []= 'bootstrap';

	wp_enqueue_script( 'bootstrap-js', 'https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js', $dep_js, null, true );
	$dep_js []= 'bootstrap-js';

	wp_enqueue_style( 'basic', "$path/css/basic.vmcompiled.min.css", $dep_css, '1.0' );
	$dep_css [] = 'basic';

	if ( is_front_page() ) :
		wp_enqueue_style( 'front-page', "$path/css/front-page.vmcompiled.min.css", $dep_css, '1.0' );
		wp_enqueue_script( 'front-page-js', "$path/js/front-page.vmcompiled.min.js", $dep_js, '1.0' );
	endif;


}


function vm_add_sri_attributes ( $html, $handle ) {

	switch ( $handle ) :
		default :
			return $html;
			break;
		case 'jquery-js' :
			$replace = 'integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"';
			$tag = '></script>';
			break;
		case 'bootstrap' :
			$replace = 'integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous"';
			$tag = '/>';
			break;
		case 'bootstrap-js' :
			$replace = 'integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"';
			$tag = '></script>';
			break;
	endswitch;

	return str_replace( $tag, " $replace$tag", $html );

}