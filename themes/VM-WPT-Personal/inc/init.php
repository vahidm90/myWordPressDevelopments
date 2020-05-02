<?php

load_theme_textdomain( VM_TD, get_template_directory() . '/languages' );


/**
 * Prepare theme's language variable.
 *
 * @param  $locale string Wordpress locale ID
 *
 * @return         string Wordpress locale ID
 *
 */
function vm_set_lang( $locale ) {

	global $vm_lang;

	if ( ! empty( VM_LANGUAGES[ $vm_lang ] ) ) :
		return $locale;
	endif;

	switch ( $locale ) :
		default :
		case 'en_AU' :
		case 'en_CA' :
		case 'en_NZ' :
		case 'en_ZA' :
		case 'en_GB' :
		case 'en_US' :
			$vm_lang = 'en';
			break;
		case 'fa_IR' :
			$vm_lang = 'fa';
			break;
	endswitch;

	return $locale;

}

add_filter( 'locale', 'vm_set_lang' );


/**
 * Activate theme features.
 *
 */
function vm_theme_features() {

	//TODO: make these settings dynamic
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support( 'html5', array( 'caption', 'gallery', 'comment-list', 'comment-form', 'search-form' ) );
	add_theme_support(
		'post-formats',
		array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' )
	);

	//TODO: dynamically fetch items available to add to menus.
	register_nav_menus(
		array(
			'home_footer'    => __( 'front-page footer navigation menu', VM_TD ),
			'home_tier'      => __( 'front-page tiers navigation menu', VM_TD ),
			'global_footer'  => __( 'global footer navigation menu', VM_TD ),
			'global_nav_bar' => __( 'global navigation bar', VM_TD )
		)
	);

}

add_action( 'after_setup_theme', 'vm_theme_features' );

