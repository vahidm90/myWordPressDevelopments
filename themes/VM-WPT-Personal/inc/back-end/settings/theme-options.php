<?php


function vm_options_pages() {

	add_theme_page(
		__( 'Customize', VM_TEXT_DOMAIN ),
		__( 'General theme options', VM_TEXT_DOMAIN ),
		'edit_theme_options',
		'vm-theme-options',
		'vm_theme_options_markup'
	);

	add_theme_page(
		__( 'Front-page Tiers', VM_TEXT_DOMAIN ),
		__( 'Customize front-page tiers', VM_TEXT_DOMAIN ),
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

	$args = array(
		'field_id'           => 'vm-personal-customize-front-page-tiers-count',
		'field_title'        => _x( 'Tiers (allowed: 1-99)', 'Tiers count field text', VM_TEXT_DOMAIN ),
		'field_markup'       => 'vm_theme_options_front_page_tiers_count_markup',
		'page_slug'          => 'vm-theme-options',
		'section_id'         => 'vm-theme-options-front-page-section',
		'option_name'        => 'vm_theme_options_front_page_tiers_count',
		'option_type'        => 'number',
		'option_description' => __( 'Number of front-page tiers', VM_TEXT_DOMAIN ),
		'option_default'     => 1,
		'option_group'       => 'vm_theme_options'
	);

	vm_theme_options_field_setting( $args );

	$args['field_id'] = 'vm-personal-customize-front-page-tiers-common-classes';
	$args['field_title'] = __( 'Class(es) shared among all tiers (separated by space)', VM_TEXT_DOMAIN );
	$args['option_name'] = 'vm_theme_options_front_page_tiers_common_classes';
	$args['option_description'] = __( 'Class(es) to use for all front-page tiers', VM_TEXT_DOMAIN );
	unset( $args['field_markup'], $args['option_type'], $args['option_default'] );

	vm_theme_options_field_setting( $args );

	for ( $i = 1; get_option( 'vm_theme_options_front_page_tiers_count' ) >= $i; $i ++ ) :

		add_settings_section(
			"vm-front-page-tiers-options-tier-$i-section",
			sprintf( _x( 'Tier %d', 'Setting section title; %d: Tier number', VM_TEXT_DOMAIN ), $i ),
			'vm_front_page_tiers_options_section_markup',
			'vm-front-page-tiers-options'
		);
//TODO: Create separate fields for each piece of data.

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-enable-title";
		$args['field_title'] = _x( 'Appear on tiers navigation menu', 'Tier option field text', VM_TEXT_DOMAIN );
		$args['field_markup'] = 'vm_options_checkbox_markup';
		$args['page_slug'] = 'vm-front-page-tiers-options';
		$args['section_id'] = "vm-front-page-tiers-options-tier-$i-section";
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_enable_title";
		$args['option_type'] = 'boolean';
		$args['option_group'] = 'vm_front_page_tiers_options';
		$args['option_description'] = sprintf(
			_x(
				'Enable/disable front-page tier %d on tiers navigation menu',
				'Tier option description; %d: Tier number',
				VM_TEXT_DOMAIN
			),
			$i
		);

		vm_theme_options_field_setting($args);

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-title";
		$args['field_title'] = _x( 'Title on tiers navigation menu', 'Tier option field text', VM_TEXT_DOMAIN );
		$args['field_markup'] = 'vm_options_tier_title_markup';
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_title";
		$args['option_description'] = sprintf(
			_x(
				'Front-page tier %d title on tiers navigation menu',
				'Tier option description; %d: Tier number',
				VM_TEXT_DOMAIN
			),
			$i
		);
		$args['extra_args'] = array( 'enabled' => get_option("vm_theme_options_front_page_tier_{$i}_enable_title") );
		unset( $args['option_type'] );

		vm_theme_options_field_setting($args);

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-classes";
		$args['field_title'] = _x( 'Class(es)', 'Tier option field text', VM_TEXT_DOMAIN );
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_classes";
		$args['option_description'] = sprintf(
			_x( 'Front-page tier %d class(es)', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);
		unset( $args['field_markup'] );

		vm_theme_options_field_setting( $args );

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-stripped-classes";
		$args['field_title'] = _x( 'Excluded common class(es)', 'Tier option field text', VM_TEXT_DOMAIN );
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_stripped-classes";
		$args['option_description'] = sprintf(
			_x(
				'Front-page tier %d class(es) excluded from common class(es)',
				'Tier option description; %d: Tier number',
				VM_TEXT_DOMAIN
			),
			$i
		);

		vm_theme_options_field_setting( $args );

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-template";
		$args['field_title'] = _x( 'Template', 'Tier option field text', VM_TEXT_DOMAIN );
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_template";
		$args['option_description'] = sprintf(
			_x( 'Front-page tier %d template file', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);

		vm_theme_options_field_setting( $args );

	endfor;

}

add_action( 'admin_init', 'vm_theme_options' );

