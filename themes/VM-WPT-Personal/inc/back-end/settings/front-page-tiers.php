<?php


function vm_setting_menus() {

	add_menu_page(
		__( 'Personal Theme Settings', VM_TEXT_DOMAIN ),
		__( 'Customize Theme', VM_TEXT_DOMAIN),
		'edit_theme_options',
		'vm-options-theme-settings',
		'vm_theme_settings_markup',
		'dashicons-admin-generic',
		26
	);

	add_submenu_page(
		'vm-options-theme-settings',
		__( 'Setup Front-page Tiers', VM_TEXT_DOMAIN ),
		__( 'Front-page Tiers', VM_TEXT_DOMAIN),
		'manage_snt_defs',
		'vm-options-theme-settings-front-page-tiers',
		'vm_theme_settings_front_page_tiers_markup',
	);

}

add_action( 'admin_menu', 'vm_setting_menus' );


/**
 * Displays default taxonomy forms
 *
 */
function vm_theme_settings_markup() {

	$b_txt = _x( 'Save', 'Text on settings submit button', VM_TEXT_DOMAIN );
	$args = array(
		'text' => _x( 'Clear', 'Text on reset button', VM_TEXT_DOMAIN ),
		'wrap' => FALSE,
		'echo' => TRUE,
		'attr' => array( 'class' => 'button-secondary',  'name' => 'reset', 'type' => 'reset' )
	);

	?><form action="options.php" method="post"><?php
	settings_fields( 'snt_defs' );
	do_settings_sections( 'options-snt-default-tax-meta' );
	submit_button( $b_txt, 'primary', 'submit', FALSE );
	snt_submit_btn( $args );
	?></form><?php

}


function vm_front_page_tiers_settings() {
	
	add_settings_field(
		'vm-option-theme-settings-front-page-tiers-layout',
		__('Front-page tiers layout'),
		'vm_front_page_tiers_settings_markup',
		'vm-options-theme-settings-front-page-tiers',
	);
	
	foreach ( $snt_nhct as $obj ) :

		$ttl = sprintf( $st1, $obj->description );
		$desc = sprintf( $st2, $obj->description );
		add_settings_field(
			'option-def-' . $obj->name . '-user-' . $uid,
			$ttl,
			'snt_def_tax_forms',
			'options-snt-default-tax-meta',
			'snt-default-tax-meta',
			array( 'tax' => $obj)
		);
		$args = array(
			'type'              => 'string',
			'description'       => $desc,
			'sanitize_callback' => 'sanitize_text_field',
			'show_in_rest'      => TRUE,
			'default'           => ''
		);
		register_setting( 'snt_defs', "snt_def_{$obj->name}s_user_" . $uid, $args );

	endforeach;

	foreach ( $snt_hct as $obj ) :

		$ttl = sprintf( $st1, $obj->labels->archives );
		$desc = sprintf( $st2, $obj->labels->archives );
		add_settings_field(
			"option-def-$obj->name-user-$uid",
			$ttl,
			'snt_def_tax_forms',
			'options-snt-default-tax-meta',
			'snt-default-tax-meta',
			array( 'tax' => $obj)
		);
		$args = array(
			'type'              => 'int',
			'description'       => $desc,
			'sanitize_callback' => '',
			'show_in_rest'      => TRUE,
			'default'           => 0
		);
		register_setting( 'snt_defs', "snt_def_{$obj->name}_user_$uid", $args );

	endforeach;

	$desc = _x( 'Default Top meta', 'Setting description', 'snt-en' );
	add_settings_field(
		"snt-def-top-meta-user-$uid",
		'Default Top value',
		'snt_def_top_form',
		'options-snt-default-tax-meta',
		'snt-default-tax-meta'
	);
	$args = array(
		'type'              => 'string',
		'description'       => $desc,
		'sanitize_callback' => '',
		'show_in_rest'      => TRUE,
		'default'           => ''
	);
	register_setting( 'snt_defs', 'snt_def_top_meta_user_' . $uid, $args );

}
add_action( 'admin_init', 'vm_front_page_tiers_settings' );


/**
 * Displays default taxonomy settings' label text
 *
 */
function snt_defs_settings_section() {
	_ex( 'These will be assigned to posts singularly created/edited.', 'Settings section description', 'snt-en' );
}


/**
 * Displays each default taxonomy setting section's individual form
 *
 * @param array $args {
 *     Form's arguments
 *     @type WP_Taxonomy Current taxonomy's data object
 * }
 *
 */
function snt_def_tax_forms( $args ) {

	$uid = '_user_' . get_current_user_id();
	$name = $args['tax']->name;

	if ( ! $args['tax']->hierarchical ) :

		$str = _x( 'No Default %1$s Set!', 'Settings hint; 1: Taxonomy description', 'snt-en' );
		$curr = get_option( "snt_def_{$name}s$uid", '' );
		$attr = "name='add_$name' id='input-add-$name' placeholder='{$args['tax']->labels->archives}'";
		$class = '';

		$html = "<input title='add-$name' class='add-def-tax' data-tax='$name' $attr />";
		$html .= "<div class='current-def-terms' id='div-current-def-$name'>";

		if ( ! empty( $curr ) ) :
			$class = ' hide-txt';
			foreach ( array_filter( explode( ',', $curr ) ) as $term ) :
				if ( empty( $term ) ) :
					continue;
				endif;
				$attr = "value='$term' type='button' class='def-term-item' data-tax='$name'";
				$html .= "<button $attr><span>$term</span><span class='dashicons dashicons-no-alt'></span></button>";
			endforeach;
		endif;
		$attr = "id='snt_def_{$name}s$uid' name='snt_def_{$name}s$uid' value='$curr' data-tax='$name'";
		$html .= "<p class='howto$class'>" . sprintf( $str, $args['tax']->description ) . "</p>";
		$html .= "<input type='hidden' title='snt_def_{$name}s$uid' class='def-tax-nh def-tax-input' $attr/>";

		$html .= '</div>';

	else :

		$str = ' ' . _x( 'Select default %1$s...', 'Setting option; 1: Taxonomy archive label', 'snt-en' );
		$attr = array(
			'name' => "snt_def_{$name}$uid",
			'id' => "snt_def_{$name}$uid",
			'class' => 'def-tax-h def-tax-input'
		);
		$dd_args = array(
			'attr'              => $attr,
			'show_option_none'  => sprintf( $str, $args['tax']->labels->archives ),
			'option_none_value' => '',
			'orderby'           => 'name',
			'hide_empty'        => FALSE,
			'selected'          => get_option( "snt_def_{$name}$uid", FALSE ),
			'hierarchical'      => TRUE,
			'taxonomy'          => $name,
			'hide_if_empty'     => FALSE,
			'echo'              => FALSE
		);
		$html = snt_ct_drop_down( $dd_args );
	endif;

	echo $html;

}


/**
 * Displays default Top meta-data value setting section's form
 *
 */
function snt_def_top_form() {

	$options = array(
		''       => ' ' . _x( 'Select Default Top Value...', 'Setting option', 'snt-en' ),
		'region' => _x( 'Region', 'Top meta-data option in Taxonomy/Meta Defaults screen', 'snt-en' ),
		'topic'  => _x( 'Topic', 'Top meta-data option in Taxonomy/Meta Defaults screen', 'snt-en' ),
		'none'   => _x( 'Nowhere', 'Top meta-data option in Taxonomy/Meta Defaults screen', 'snt-en' )
	);
	$opt_name = 'snt_def_top_meta_user_' . get_current_user_id();
	$sel = get_option( $opt_name );
	$html = "<div><select title='$opt_name'  name='$opt_name' class='def-tax-input' id='$opt_name'>";
	foreach ( $options as $val => $txt ) :
		$html .= "<option value='$val' " . ( $val === $sel ? 'selected' : '' ) . ">$txt</option>";
	endforeach;
	$html .= "</select></div>";

	echo $html;

}

