<?php

define( 'VM_LIVE_ADDRESS', 'elashcenter.ir' );
define( 'VM_DEV_ADDRESS', 'mywebsite.test' );
define( 'VM_IS_DEV', ( false === strpos( $_SERVER['SERVER_NAME'], VM_DEV_ADDRESS ) ? false : true ) );
define( 'VM_TD', 'VM-WPT-Business-elashcenter' );
//TODO: set theme default image.
//define( 'VM_DEF_IMG', get_template_directory_uri() . '/assets/bin/img/def_img.png');

// Files
require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/markup.php';
require_once get_template_directory() . '/inc/style-script.php';
