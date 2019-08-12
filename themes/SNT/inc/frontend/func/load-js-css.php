<?php


function snt_load_css_js() {
	global $snt_lang, $snt_supported_lang, $snt_dir;

	$font = "fonts-{$snt_supported_lang[ $snt_lang ]['prefix']}";
	$dep_js = array( 'snt-jquery-js' );
	$ss_path = get_template_directory_uri() . '/css/frontend/';
	$js_path = get_template_directory_uri() . '/js/frontend/';
	$dep_css = array( 'snt-icons' );
	$dep_css_rtl = array( 'snt-basic-rtl' );
	$loc_vars = array(
		'url' => site_url( 'js-repo/ajax-od.php' ),
		'lat' => _x( 'Latest', 'Roll Title', 'snt-en' ),
		'dir' => $snt_dir,
		'siteLogo' => '<span class="snt-icon snt-logo"></span>',
		'hot' => _x( 'Breaking', 'Roll Title', 'snt-en' )
	);

	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed' );
	wp_enqueue_style( 'snt-icons', "{$ss_path}icons.css", array(), '1.0.14' );
	wp_enqueue_style( 'snt-basic', "{$ss_path}basic.css", $dep_css, '1.0.14' );
	$dep_css []= 'snt-basic';
	if ( 'right' === $snt_dir ) :
		wp_enqueue_style( 'snt-basic-rtl', "{$ss_path}basic-rtl.css", $dep_css, '1.0.14' );
	endif;
	wp_enqueue_style( "snt-$font", "{$ss_path}$font.css", $dep_css, '1.0.14' );
	wp_enqueue_script( 'snt-jquery-js', "{$js_path}jquery.js", array(), FALSE, TRUE );
	wp_register_script( 'snt-generic-js', "{$js_path}generic.js", $dep_js, '1.0.14', TRUE );
	wp_localize_script( 'snt-generic-js', 'SNTGeneric', $loc_vars );
	wp_enqueue_script( 'snt-generic-js' );

	switch ( 1 ) :
		case is_front_page() || is_home() :
			wp_enqueue_style( 'snt-front-page', "{$ss_path}front-page.css", $dep_css, '1.0.14' );
			if ( 'right' === $snt_dir ) :
				$dep_css_rtl []= 'snt-front-page';
				wp_enqueue_style( 'snt-front-page-rtl', "{$ss_path}front-page-rtl.css", $dep_css_rtl, '1.0.14' );
			endif;
			wp_enqueue_script( 'snt-front-page-js', "{$js_path}front-page.js", $dep_js, '1.0.14', TRUE );
			break;
		case is_single() :
			wp_enqueue_style( 'snt-single-post', "{$ss_path}single-post.css", $dep_css, '1.0.14' );
			if ( 'right' === $snt_dir ) :
				$dep_css_rtl []= 'snt-single-post';
				wp_enqueue_style( 'snt-single-post-rtl', "{$ss_path}single-post-rtl.css", $dep_css_rtl, '1.0.14' );
			endif;
			wp_enqueue_script( 'snt-single-post-js', "{$js_path}single-post.js", $dep_js, '1.0.14', TRUE );
			break;
		case is_archive() :
			wp_enqueue_style( 'snt-archive', "{$ss_path}archive.css", $dep_css, '1.0.14' );
			if ( 'right' === $snt_dir ) :
				$dep_css_rtl []= 'snt-archive';
				wp_enqueue_style( 'snt-archive-rtl', "{$ss_path}archive-rtl.css", $dep_css_rtl, '1.0.14' );
			endif;
			wp_enqueue_script( 'snt-archive-js', "{$js_path}archive.js", $dep_js, '1.0.14', TRUE );
			break;
		case is_search() :
			wp_enqueue_style( 'snt-search', "{$ss_path}search.css", $dep_css, '1.0.14' );
			if ( 'right' === $snt_dir ) :
				$dep_css_rtl []= 'snt-search';
				wp_enqueue_style( 'snt-search-rtl', "{$ss_path}search-rtl.css", '1.0.14' );
			endif;
			//wp_enqueue_script( 'snt-search-js', "{$js_path}search.js", $dep_js, '1.0.14', TRUE );
			break; 
		default :
			wp_enqueue_style( 'snt-page', "{$ss_path}page.css", $dep_css, '1.0.14' );
			if ( 'right' === $snt_dir ) :
				$dep_css_rtl []= 'snt-page';
				wp_enqueue_style( 'snt-page-rtl', "{$ss_path}page-rtl.css", $dep_css_rtl, '1.0.14' );
			endif;
			wp_enqueue_script( 'snt-page-js', "{$js_path}page.js", $dep_js, '1.0.14', TRUE );
			break;
	endswitch;
	
}
add_action( 'wp_enqueue_scripts', 'snt_load_css_js' );
