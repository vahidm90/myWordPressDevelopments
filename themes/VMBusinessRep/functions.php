<?php

// Constants
//TODO: Set font urls.
define( 'VM_LIVE_ADDRESS', 'petroneginj.com' );
define( 'VM_DEV_ADDRESS', 'mywebsite.test' );

$vmbwpt_is_dev = ( false === strpos( $_SERVER['SERVER_NAME'], VM_LIVE_ADDRESS ) ? true : false );
define( 'VMBWPT_TEXT_DOMAIN', 'VMBusinessRep' );
define(
	'VMBWPT_LANGUAGES',
	array(
		'English' => array(
			'direction'  => 'ltr',
			'prefix'     => '',
			'native'     => 'English',
			'translated' => __( 'English', VMBWPT_TEXT_DOMAIN ),
			'font-url'   => array(),
			'pages'      => array( 'contact' => 5, 'home' => 15, 'product' => 17, 'about' => 13 ),
			'menus'      => array( 'main' => 3, 'footer' => 4 )
		),
		'Persian' => array(
			'direction'  => 'rtl',
			'prefix'     => 'fa',
			'native'     => 'فارسی',
			'translated' => __( 'Persian', VMBWPT_TEXT_DOMAIN ),
			'font-url'   => array(),
			'pages'      => array( 'contact' => 5, 'home' => 15, 'product' => 17, 'about' => 13 ),
			'menus'      => array( 'main' => 2, 'footer' => 3 )
		)
	)
);


require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/markup.php';
require_once get_template_directory() . '/inc/style-script.php';
