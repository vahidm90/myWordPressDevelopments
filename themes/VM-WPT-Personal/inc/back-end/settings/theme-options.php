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
//	add_settings_field(
//		'vm-personal-customize-front-page-tiers-count',
//		__( 'Number of front-page tiers (allowed: 1-99)', VM_TEXT_DOMAIN ),
//		'vm_theme_options_front_page_tiers_count_markup',
//		'vm-theme-options',
//		'vm-theme-options-front-page-section',
//		array(
//			'label_for' => 'vm-personal-customize-front-page-tiers-count',
//			'name'      => 'vm_theme_options_front_page_tiers_count'
//		)
//	);
//
//	$args = array( 'type' => 'number', 'description' => 'Number of front-page tiers', 'default' => 1 );
//
//	register_setting( 'vm_theme_options', 'vm_theme_options_front_page_tiers_count', $args );
	$args['field_id'] = 'vm-personal-customize-front-page-tiers-common-classes';
	$args['field_title'] = __( 'Class(es) shared among all tiers (separated by space)', VM_TEXT_DOMAIN );
	$args['option_name'] = 'vm_theme_options_front_page_tiers_common_classes';
	$args['option_description'] = __( 'Class(es) to use for all front-page tiers', VM_TEXT_DOMAIN );
	unset( $args['field_markup'], $args['option_type'], $args['option_default'] );

	vm_theme_options_field_setting( $args );
//	add_settings_field(
//		'vm-personal-customize-front-page-tiers-common-classes',
//		__( 'Class(es) to use for all tiers', VM_TEXT_DOMAIN ),
//		'vm_options_text_field_markup',
//		'vm-theme-options',
//		'vm-theme-options-front-page-section',
//		array(
//			'label_for' => 'vm-personal-customize-front-page-tiers-common-classes',
//			'name'      => 'vm_theme_options_front_page_tiers_common_classes'
//		)
//	);
//
//	$args = array( 'type' => 'string', 'description' => 'Common classes for all front-page tiers', 'default' => '' );
//
//	register_setting( 'vm_theme_options', 'vm_theme_options_front_page_tiers_common_classes', $args );
	for ( $i = 1; get_option( 'vm_theme_options_front_page_tiers_count' ) >= $i; $i ++ ) :

		add_settings_section(
			"vm-front-page-tiers-options-tier-$i-section",
			sprintf( _x( 'Tier %d', 'Setting section title; %d: Tier number', VM_TEXT_DOMAIN ), $i ),
			'vm_front_page_tiers_options_section_markup',
			'vm-front-page-tiers-options'
		);
//TODO: Create separate fields for each piece of data.

		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-title";
		$args['field_title'] = _x( 'Title on tiers navigation menu', 'Tier title option field text', VM_TEXT_DOMAIN );
		$args['page_slug'] = 'vm-front-page-tiers-options';
		$args['section_id'] = "vm-front-page-tiers-options-tier-$i-section";
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_title";
		$args['option_group'] = 'vm_front_page_tiers_options';
		$args['option_description'] = sprintf(
			_x(
				'Front-page tier %d title on tiers navigation menu',
				'Tier option description; %d: Tier number',
				VM_TEXT_DOMAIN
			),
			$i
		);

		vm_theme_options_field_setting($args);
//		add_settings_field(
//			"vm-front-page-tiers-options-tier-$i-title",
//			__( 'Title', VM_TEXT_DOMAIN ),
//			'vm_options_text_field_markup',
//			'vm-front-page-tiers-options',
//			"vm-front-page-tiers-options-tier-$i-section",
//			array(
//				'label_for' => "vm-front-page-tiers-options-tier-$i-title",
//				'name'      => "vm_theme_options_front_page_tier_{$i}_title"
//			)
//		);
//
//		$args = array( 'type' => 'string', 'description' => "Tier $i title" );
//
//		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_title", $args );
//
		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-classes";
		$args['field_title'] = _x( 'Class(es)', 'Tier classes option field text', VM_TEXT_DOMAIN );
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_classes";
		$args['option_description'] = sprintf(
			_x( 'Front-page tier %d class(es)', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);

		vm_theme_options_field_setting( $args );
//		add_settings_field(
//			"vm-front-page-tiers-options-tier-$i-classes",
//			__( 'Class(es)', VM_TEXT_DOMAIN ),
//			'vm_options_text_field_markup',
//			'vm-front-page-tiers-options',
//			"vm-front-page-tiers-options-tier-$i-section",
//			array(
//				'label_for' => "vm-front-page-tiers-options-tier-$i-classes",
//				'name'      => "vm_theme_options_front_page_tier_{$i}_classes"
//			)
//		);
//
//		$args = array( 'type' => 'string', 'description' => "Tier $i classes" );
//
//		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_classes", $args );
//
		$args['field_id'] = "vm-front-page-tiers-options-tier-$i-template";
		$args['field_title'] = _x( 'Template', 'Tier template option field text', VM_TEXT_DOMAIN );
		$args['option_name'] = "vm_theme_options_front_page_tier_{$i}_template";
		$args['option_description'] = sprintf(
			_x( 'Front-page tier %d template file', 'Tier option description; %d: Tier number', VM_TEXT_DOMAIN ),
			$i
		);

		vm_theme_options_field_setting( $args );
//		add_settings_field(
//			"vm-front-page-tiers-options-tier-$i-template-file",
//			__( 'Template file', VM_TEXT_DOMAIN ),
//			'vm_options_text_field_markup',
//			'vm-front-page-tiers-options',
//			"vm-front-page-tiers-options-tier-$i-section",
//			array(
//				'label_for' => "vm-front-page-tiers-options-tier-$i-template-file",
//				'name'      => "vm_theme_options_front_page_tier_{$i}_template_file"
//			)
//		);
//
//
//		$args = array( 'type' => 'string', 'description' => "Tier $i template file" );
//
//		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_template_file", $args );
//
	endfor;

}

add_action( 'admin_init', 'vm_theme_options' );

