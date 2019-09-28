<?php

// Consonants and Globals
define( 'VM_LIVE_ADDRESS', 'vahidsays.com' );
define( 'VM_DEV_ADDRESS', 'mywebsite.test' );
define( 'VM_IS_DEV', ( false === strpos( $_SERVER['SERVER_NAME'], VM_LIVE_ADDRESS ) ? true : false ) );
define( 'VM_TEXT_DOMAIN', 'VM-WPT-Personal' );
define(
	'VM_LANGUAGES',
	array(
		'English' => array(
			'direction'  => 'ltr',
			'prefix'     => '',
			'native'     => 'English',
			'translated' => __( 'English', VM_TEXT_DOMAIN ),
		),
		'Persian' => array(
			'direction'  => 'rtl',
			'prefix'     => 'fa',
			'native'     => 'فارسی',
			'translated' => __( 'Persian', VM_TEXT_DOMAIN ),
		)
	)
);
$vm_def_img = ''; //TODO: Set default image url.
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
$vm_comma = _x( ',', 'Comma', 'snt-en' );
$vm_qo = _x( '"', 'Quotation mark opening', VM_TEXT_DOMAIN );
$vm_qc = _x( '"', 'Quotation mark closing', VM_TEXT_DOMAIN );
$vm_lang = '';

// Files
require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/style-script.php';
require_once get_template_directory() . '/inc/markup.php';

require_once get_template_directory() . '/inc/back-end/settings/front-page-tiers.php';
