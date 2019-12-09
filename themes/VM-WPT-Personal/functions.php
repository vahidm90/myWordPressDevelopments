<?php

define( 'VM_LIVE_ADDRESS', 'vahidsays.com' );
define( 'VM_DEV_ADDRESS', 'mywebsite.test' );
define( 'VM_IS_DEV', ( false === strpos( $_SERVER['SERVER_NAME'], VM_DEV_ADDRESS ) ? false : true ) );
define( 'VM_TD', 'VM-WPT-Personal' );
define( 'VM_DEF_IMG', get_template_directory_uri() . '/assets/bin/img/def_img.png');
define(
	'VM_LANGUAGES',
	array(
		'English' => array(
			'direction'  => 'ltr',
			'prefix'     => '',
			'native'     => 'English',
			'translated' => __( 'English', VM_TD ),
		),
		'Persian' => array(
			'direction'  => 'rtl',
			'prefix'     => 'fa',
			'native'     => 'فارسی',
			'translated' => __( 'Persian', VM_TD ),
		)
	)
);
$vm_1_2   = '%1$s %2$s';
$vm_2_1   = '%2$s %1$s';
$vm_12    = '%1$s%2$s';
$vm_21    = '%2$s%1$s';
if ( is_rtl() ) :
	$vm_1_2   = '%2$s %1$s';
	$vm_2_1   = '%1$s %2$s';
	$vm_12    = '%2$s%1$s';
	$vm_21    = '%1$s%2$s';
endif;
$vm_comma = _x( ',', 'Comma', VM_TD );
$vm_qo = _x( '"', 'Quotation mark opening', VM_TD );
$vm_qc = _x( '"', 'Quotation mark closing', VM_TD );
$vm_lang = '';

// Files
require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/style-script.php';
require_once get_template_directory() . '/inc/routines.php';
require_once get_template_directory() . '/inc/markup.php';

require_once get_template_directory() . '/inc/back-end/settings/theme-options.php';
require_once get_template_directory() . '/inc/back-end/custom-term-meta.php';
