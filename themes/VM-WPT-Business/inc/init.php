<?php

load_theme_textdomain( VMBWPT_TEXT_DOMAIN, get_template_directory() . '/languages' );

$vmbwpt_lang  = '';
$vmbwpt_1_2   = '%1$s %2$s';
$vmbwpt_2_1   = '%2$s %1$s';
$vmbwpt_12    = '%1$s%2$s';
$vmbwpt_21    = '%2$s%1$s';
$vmbwpt_dir_r = 'right';
$vmbwpt_dir   = 'left';
if ( is_rtl() ) :
	$vmbwpt_1_2   = '%2$s %1$s';
	$vmbwpt_2_1   = '%1$s %2$s';
	$vmbwpt_12    = '%2$s%1$s';
	$vmbwpt_21    = '%1$s%2$s';
	$vmbwpt_dir_r = 'left';
	$vmbwpt_dir   = 'right';
endif;

/**
 * Creates basic theme features
 */
function vmbwpt_setup_theme() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support( 'html5', array( 'caption' ) );

	register_nav_menus(
		array(
			'main-nav'    => _x( 'Main Navigation', 'Menu location description', VMBWPT_TEXT_DOMAIN ),
			'footer-menu' => _x( 'Footer Menu', 'Menu location description', VMBWPT_TEXT_DOMAIN )
		)
	);
}

add_action( 'after_setup_theme', 'vmbwpt_setup_theme' );

/**
 * Sets site locale based on current sub-domain/user-set locale.
 *
 * @param $locale string Locale ID
 *
 * @return        string Modified locale
 */
function vmbwpt_set_lang( $locale ) {
	global $vmbwpt_lang;

	if ( isset( VMBWPT_LANGUAGES[ $vmbwpt_lang ]) ) :
		return $locale;
	endif;

	if ( 'fa_IR' === $locale ) :
		$vmbwpt_lang = 'Persian';
	else :
		$vmbwpt_lang = 'English';
	endif;


	return $locale;
}

add_filter( 'locale', 'vmbwpt_set_lang' );
