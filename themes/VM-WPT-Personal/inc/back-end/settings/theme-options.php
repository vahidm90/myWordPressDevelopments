<?php
//TODO: add option for tier background image.


function vm_options_pages() {

	add_theme_page(
		__( 'Customize Theme', VM_TEXT_DOMAIN ),
		__( 'Theme options', VM_TEXT_DOMAIN ),
		'edit_theme_options',
		'vm-theme-options',
		'vm_theme_options_markup'
	);

	add_theme_page(
		__( 'Customize front-page tiers', VM_TEXT_DOMAIN ),
		__( 'Front-page Tiers', VM_TEXT_DOMAIN ),
		'edit_theme_options',
		'vm-front-page-tiers-options',
		'vm_front_page_tiers_options_markup'
	);

}

add_action( 'admin_menu', 'vm_options_pages' );


function vm_theme_options() {

	add_settings_section(
		'vm-theme-options-front-page-section',
		__( 'Front-page options', VM_TEXT_DOMAIN ),
		'vm_theme_options_front_page_section_markup',
		'vm-theme-options'
	);

	$num_args = array(
		'field_id'           => 'vm-front-page-tiers-count',
		'page_slug'          => 'vm-theme-options',
		'option_name'        => 'vm_theme_options_front_page_tiers_count',
		'option_group'       => 'vm_theme_options',
		'field_title'        => _x( 'Tiers (allowed: 1-99)', 'Tiers count field text', VM_TEXT_DOMAIN ),
		'field_markup'       => 'vm_number_option_field_markup',
		'section_id'         => 'vm-theme-options-front-page-section',
		'option_type'        => 'number',
		'option_description' => __( 'Number of front-page tiers', VM_TEXT_DOMAIN ),
		'option_default'     => 1,
		'extra_args'         => array( 'max' => 99, 'min' => 1 ),
	);

	vm_theme_options_field_setting( $num_args );

	$text_args = array(
		'field_id'           => 'vm-front-page-tiers-common-classes',
		'page_slug'          => 'vm-theme-options',
		'option_name'        => 'vm_theme_options_front_page_tiers_common_classes',
		'option_group'       => 'vm_theme_options',
		'field_title'        => __( 'Class(es) shared among all tiers (separated by space)', VM_TEXT_DOMAIN ),
		'section_id'         => 'vm-theme-options-front-page-section',
		'option_description' => __( 'Class(es) to use for all front-page tiers', VM_TEXT_DOMAIN ),
	);

	vm_theme_options_field_setting( $text_args );

	for ( $i = 1; (int) get_option( 'vm_theme_options_front_page_tiers_count' ) >= $i; $i ++ ) :

		add_settings_section(
			"vm-front-page-tiers-options-tier-$i-section",
			sprintf( _x( 'Tier %d', 'Setting section title; %d: Tier number', VM_TEXT_DOMAIN ), $i ),
			'vm_front_page_tiers_options_section_markup',
			'vm-front-page-tiers-options'
		);
//TODO: Create separate fields for each piece of data.

		$text_args = array(
			'field_id'           => "vm-front-page-tier-$i-template",
			'page_slug'          => 'vm-front-page-tiers-options',
			'option_name'        => "vm_theme_options_front_page_tier_{$i}_template",
			'option_group'       => 'vm_front_page_tiers_options',
			'field_title'        => _x( 'Template', 'Tier option field text', VM_TEXT_DOMAIN ),
			'section_id'         => "vm-front-page-tiers-options-tier-$i-section",
			'option_description' => sprintf(
				_x( 'Front-page tier %d template file', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
				$i
			),
		);

		vm_theme_options_field_setting( $text_args );

		$text_args['field_id']           = "vm-front-page-tier-$i-classes";
		$text_args['field_title']        = _x( 'Exclusive class(es)', 'Tier option field text', VM_TEXT_DOMAIN );
		$text_args['option_name']        = "vm_theme_options_front_page_tier_{$i}_classes";
		$text_args['option_description'] = sprintf(
			_x( 'Front-page tier %d exclusive class(es)', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);

		vm_theme_options_field_setting( $text_args );

		$text_args['field_id']           = "vm-front-page-tier-$i-stripped-classes";
		$text_args['field_title']        = _x( 'Excluded common class(es)', 'Tier option field text', VM_TEXT_DOMAIN );
		$text_args['option_name']        = "vm_theme_options_front_page_tier_{$i}_stripped_classes";
		$text_args['option_description'] = sprintf(
			_x( 'Front-page tier %d excluded class(es)', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);

		vm_theme_options_field_setting( $text_args );

		$bool_args = array(
			'field_id'           => "vm-front-page-tier-$i-enable-title",
			'page_slug'          => 'vm-front-page-tiers-options',
			'option_name'        => "vm_theme_options_front_page_tier_{$i}_enable_title",
			'option_group'       => 'vm_front_page_tiers_options',
			'field_title'        => _x( 'Include in tiers navigation menu', 'Tier option field text', VM_TEXT_DOMAIN ),
			'field_markup'       => 'vm_checkbox_option_field_markup',
			'section_id'         => "vm-front-page-tiers-options-tier-$i-section",
			'option_type'        => 'boolean',
			'option_description' => sprintf(
				_x( 'Front-page tier %d menu inclusion', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
				$i
			),
			'option_default'     => false
		);

		vm_theme_options_field_setting( $bool_args );

		$text_args['field_id']           = "vm-front-page-tier-$i-title";
		$text_args['field_title']        = _x( 'Menu title', 'Tier option field text', VM_TEXT_DOMAIN );
		$text_args['field_markup']       = 'vm_front_page_tier_title_option_field_markup';
		$text_args['option_name']        = "vm_theme_options_front_page_tier_{$i}_title";
		$text_args['option_description'] = sprintf(
			_x( 'Front-page tier %d menu title', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);
		$text_args['extra_args']         = array(
			'enabled' => get_option( "vm_theme_options_front_page_tier_{$i}_enable_title" )
		);

		vm_theme_options_field_setting( $text_args );

		$hide_args = array(
			'field_id'           => "vm-front-page-tier-$i-title",
			'page_slug'          => 'vm-front-page-tiers-options',
			'option_name'        => "vm_theme_options_front_page_tier_{$i}_background",
			'option_group'       => 'vm_front_page_tiers_options',
			'field_title'        => _x( 'Background', 'Tier option field text', VM_TEXT_DOMAIN ),
			'field_markup'       => 'vm_front_page_tier_background_image_option_field_markup',
			'section_id'         => "vm-front-page-tiers-options-tier-$i-section",
			'option_type'        => 'number',
			'option_description' => sprintf(
				_x( 'Front-page iter %d background', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
				$i
			),
			'option_default'     => 0,
		);

		vm_theme_options_field_setting( $hide_args );

	endfor;

}

add_action( 'admin_init', 'vm_theme_options' );

