<?php

load_theme_textdomain( VM_TD, get_template_directory() . '/languages' );


/**
 * Activate theme features.
 *
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
		array( 'aside', 'gallery', 'link', 'video', 'audio', 'chat')
	);
	register_nav_menu( 'vm-fp-top-menu', __( 'Front-page top menu', VM_TD ) );
}

add_action( 'after_setup_theme', 'vm_theme_features' );

