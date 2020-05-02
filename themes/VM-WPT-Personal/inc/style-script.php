<?php


/**
 * Load front-end CSS and JS files.
 *
 */
function vm_front_css_js() {

	wp_deregister_script( 'jquery' );

	if ( VM_IS_DEV ) :
		vm_front_dev_css_js();
	else :
		vm_front_pro_css_js();
	endif;

}

add_action( 'wp_enqueue_scripts', 'vm_front_css_js' );


/**
 * Load front-end development CSS and JS files.
 *
 */
function vm_front_dev_css_js() {

	$path    = get_template_directory_uri() . '/assets';
	$dep_css = $dep_js = array();

	add_action( 'wp_footer', 'vm_front_dev_inline_css_js' );

	wp_enqueue_script( 'jquery-js', "$path/js/jquery-3.4.1.js", $dep_js, '3.4.1', true );
	$dep_js [] = 'jquery-js';
	wp_enqueue_script( 'jquery-ui-js', "$path/jquery-ui-1.12.1/jquery-ui.js", $dep_js, '1.12.1', true );
	$dep_js [] = 'jquery-ui-js';
	wp_enqueue_style( 'jquery-ui', "$path/jquery-ui-1.12.1/jquery-ui.css", $dep_css, '1.12.1' );
	$dep_css [] = 'jquery-ui';

	wp_enqueue_style( 'bootstrap', "$path/bootstrap-4.4.1/bootstrap.css", $dep_css, '4.4.1' );
	$dep_css [] = 'bootstrap';
	wp_enqueue_script( 'bootstrap-js', "$path/bootstrap-4.4.1/bootstrap.js", $dep_js, '4.4.1', true );
	$dep_js [] = 'bootstrap-js';

	wp_enqueue_style( 'basic', "$path/css/vm-basic.css", $dep_css, '1.0' );
	$dep_css [] = 'basic';
	wp_enqueue_script( 'basic-js', "$path/js/vm-basic.js", $dep_js, '1.0', true );
	$dep_js [] = 'basic-js';
	wp_add_inline_script( 'basic-js', '$("#splash").hide(300);' );

	if ( is_front_page() ) :

		wp_enqueue_style( 'dashicons' );
		$dep_css [] = 'dashicons';

		wp_enqueue_style( 'icons', "$path/css/vm-icons.css", $dep_css, '1.0' );
		$dep_css [] = 'icons';

		wp_enqueue_style( 'scrollbars', "$path/overlay-scrollbars-1.11.0/overlayScrollbars.css", $dep_css, '1.11.0' );
		$dep_css [] = 'scrollbars';
		wp_enqueue_script( 'scrollbars-js', "$path/overlay-scrollbars-1.11.0/jquery.overlayScrollbars.js", $dep_js, '1.11.0', true );
		$dep_js [] = 'scrollbars-js';

		wp_enqueue_style( 'front-page', "$path/css/vm-front-page.css", $dep_css, '1.0' );
		wp_enqueue_script( 'front-page-js', "$path/js/vm-front-page.js", $dep_js, '1.0', true );

	elseif ( is_singular() ) :

		wp_enqueue_style( 'singular', "$path/css/vm-singular.css", $dep_css, '1.0' );
		wp_enqueue_script( 'singular-js', "$path/js/vm-singular.js", $dep_js, '1.0', true );

	endif;

}


/**
 * Print front-end development JS.
 *
 */
function vm_front_dev_inline_css_js() {
}


/**
 * Load front-end production CSS and JS files.
 *
 */
function vm_front_pro_css_js() {

	$path    = get_template_directory_uri() . '/assets';
	$dep_css = $dep_js = array();

	// These will use the 'vm_add_sri_attributes' function to add SRI attributes to files obtained from CDNs.
	add_filter( 'script_loader_tag', 'vm_add_sri_attributes', 10, 2 );
	add_filter( 'style_loader_tag', 'vm_add_sri_attributes', 10, 2 );

}


/**
 * Add SRI attributes to css/js files from CDNs.
 *
 * @param $html   string HTML markup for the css/js file
 * @param $handle string Unique file handle/ID
 *
 * @return        string HTML markup for the css/js file with SRI attributes
 *
 */
function vm_add_sri_attributes( $html, $handle ) {

	switch ( $handle ) :
		case 'bootstrap' :
			$replace = ' integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"';
			$tag     = '/>';
			break;
		case 'bootstrap-js' :
			$replace = ' integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"';
			$tag     = '></script>';
			break;
		default :
			return $html;
			break;
	endswitch;

	return str_replace( $tag, " $replace$tag", $html );

}


/**
 * Load dashboard CSS and JS files.
 *
 * @param string $hook Current screen identifier
 *
 */
function vm_admin_css_js( $hook ) {

	if ( wp_doing_ajax() ) :
		return;
	endif;

	if ( VM_IS_DEV ) :
		vm_admin_dev_css_js( $hook );
	else :
		vm_admin_pro_css_js( $hook );
	endif;
}

add_action( 'admin_enqueue_scripts', 'vm_admin_css_js' );


/**
 * Load dashboard CSS and JS files.
 *
 * @param string $hook Current screen identifier
 *
 */
function vm_admin_dev_css_js( $hook ) {
	$path = get_template_directory_uri() . '/assets';

	switch ( $hook ) :

		case 'edit-tags.php' :
		case 'term.php' :
			if ( empty( $_REQUEST['taxonomy'] ) || 'category' !== $_REQUEST['taxonomy'] ) :
				return;
			endif;
			wp_enqueue_media();
			wp_enqueue_style( 'admin-add-edit-category', "$path/css/vm-admin-add-edit-category.css", array(), '1.0' );
			wp_enqueue_script( 'admin-add-edit-category-js', "$path/js/vm-admin-add-edit-category.js", array(), '1.0', true );
			break;
		case 'appearance_page_vm-front-page-tiers-options' :
			wp_enqueue_media();
			break;
		default :
			break;

	endswitch;
}


/**
 * Load dashboard CSS and JS files.
 *
 * @param string $hook Current screen identifier
 *
 */
function vm_admin_pro_css_js( $hook ) {
	$path = get_template_directory_uri() . '/assets';

	switch ( $hook ) :

		case 'edit-tags.php' :
		case 'term.php' :
			if ( empty( $_REQUEST['taxonomy'] ) || 'category' !== $_REQUEST['taxonomy'] ) :
				return;
			endif;
			wp_enqueue_media();
			wp_enqueue_style( 'admin-add-edit-category', "$path/css/vm-admin-add-edit-category.min.css", array(), '1.0' );
			wp_enqueue_script( 'admin-add-edit-category-js', "$path/js/vm-admin-add-edit-category.min.js", array(), '1.0', true );
			break;
		case 'appearance_page_vm-front-page-tiers-options' :
			wp_enqueue_media();
			break;
		default :
			break;

	endswitch;
}
