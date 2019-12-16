<?php

//TODO: use CDNs. 


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

	$dep_css = $dep_js = array();

//	wp_enqueue_style( 'bootstrap', "/bootstrap-4.2.1-rtl/bootstrap.min.css", array(), '4.3.1' );
//	$dep_css [] = 'bootstrap';
//
//	wp_enqueue_script( 'jquery-js', "$path//js/generic.js", array(), '1.0', true );
//	$dep_js [] = 'jquery-js';

//	if ( is_front_page() ) :
//
//	endif;


}


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
 * Load dashboard CSS and JS files.
 *
 * @param string $hook Current screen identifier
 *
 */
function vm_css_js_back_end( $hook ) {

	if ( wp_doing_ajax() ) :
		return;
	endif;

	$path = get_template_directory_uri() . '/assets';
	$min  = VM_IS_DEV ? '' : '.vmcompiled.min';

	switch ( $hook ) :

		case 'edit-tags.php' :
		case 'term.php' :
			if ( empty( $_REQUEST['taxonomy'] ) || 'category' !== $_REQUEST['taxonomy'] ) :
				return;
			endif;
			wp_enqueue_media();
			wp_enqueue_style( 'admin-add-edit-category', "$path/custom/css/admin-add-edit-category$min.css", array(), '1.0' );
			wp_enqueue_script( 'admin-add-edit-category-js', "$path/custom/js/admin-add-edit-category$min.js", array(), '1.0', true );
			break;
		case 'appearance_page_vm-front-page-tiers-options' :
			wp_enqueue_media();
			break;
		default :
			break;

	endswitch;
}

add_action( 'admin_enqueue_scripts', 'vm_css_js_back_end' );