<?php

// Make theme ready for translation
load_theme_textdomain( VM_TEXT_DOMAIN, get_template_directory() . '/languages' );

/**
 * Prepare theme's language-based constants.
 *
 * @param $locale string WP locale
 *
 * @return        string WP locale
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
			$vm_lang = 'English';
			break;
		case 'fa_IR' :
			$vm_lang = 'Persian';
			break;
	endswitch;

	return $locale;

}

add_filter( 'locale', 'vm_set_lang' );

/**
 * Activate theme features.
 */
function vm_theme_features() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_theme_support( 'html5', array( 'caption', 'gallery', 'comment-list', 'comment-form', 'search-form' ) );
	add_theme_support(
		'post-formats',
		array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);
}

add_action( 'after_setup_theme', 'vm_theme_features' );

