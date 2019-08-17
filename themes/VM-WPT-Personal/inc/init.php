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
