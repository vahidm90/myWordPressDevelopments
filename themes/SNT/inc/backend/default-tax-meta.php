<?php


function snt_add_tax_meta_defs_screen() {

	$p_tit = _x( 'Default Taxonomy Terms and Meta-data Values', 'Taxonomy/Meta Defaults page title', 'snt-en' );
	$m_tit = _x( 'Taxonomy/Meta Defaults', 'Taxonomy/Meta Defaults menu title', 'snt-en' );
	add_menu_page($p_tit,$m_tit,'manage_snt_defs','options-snt-default-tax-meta','snt_defs_screen','dashicons-forms',6);

}
add_action( 'admin_menu', 'snt_add_tax_meta_defs_screen' );


/**
 * Displays default taxonomy forms
 *
 */
function snt_defs_screen() {

	$b_txt = _x( 'Save', 'Text on form submit button in Taxonomy/Meta Defaults screen', 'snt-en' );
	$args = array(
		'text' => _x( 'Clear All', 'Reset button text in Taxonomy/Meta Defaults screen', 'snt-en' ),
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


function snt_add_defs_options() {
	global $snt_nhct, $snt_hct;

	$uid = get_current_user_id();
	$ttl = _x( 'Options for default taxonomy terms and meta-data values', 'Settings section title', 'snt-en' );
	$st1 = _x( 'Default %1$s', 'Settings field title; 1: Taxonomy archive label/description', 'snt-en' ) . ' ';
	$st2 = _x(
		'%1$s assigned automatically to singularly created/edited posts',
		'Setting description; 1: Taxonomy archive label/description',
		'snt-en'
	);
	add_settings_section( 'snt-default-tax-meta', $ttl, 'snt_defs_settings_section',  'options-snt-default-tax-meta' );

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
add_action( 'admin_init', 'snt_add_defs_options' );


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


function snt_ajax_def_ct() {

	if ( ! check_ajax_referer( 'snt_default_tax_meta_nonce', 'security' ) ) :
		echo 'security failure';
		die;
	endif;

	global $wpdb;

	$name = '%' . $wpdb->esc_like( stripslashes( $_POST['term'] ) ) . '%';
	$sql = <<<QUERY
SELECT {$wpdb->terms}.name, {$wpdb->terms}.term_id FROM {$wpdb->terms} INNER JOIN {$wpdb->term_taxonomy} 
ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id
WHERE {$wpdb->terms}.name LIKE %s and {$wpdb->term_taxonomy}.taxonomy = %s 
QUERY;

	$terms = $wpdb->get_results( $wpdb->prepare( $sql, $name, $_POST['tax'] ) );
	$names = array();

	foreach ( $terms as $term ) :
		$names[] = addslashes( $term->name );
	endforeach;

	echo json_encode( $names );

	die;

}
add_action( 'wp_ajax_get-def-nh-taxes', 'snt_ajax_def_ct' );
