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
		__( 'Front-page', VM_TEXT_DOMAIN ),
		'vm_theme_options_front_page_section_markup',
		'vm-theme-options'
	);

	add_settings_field(
		'vm-personal-customize-front-page-tiers-count',
		__( 'Number of front-page tiers (allowed: 1-99)', VM_TEXT_DOMAIN ),
		'vm_theme_options_front_page_tiers_count_markup',
		'vm-theme-options',
		'vm-theme-options-front-page-section',
		array( 'label_for' => 'vm-personal-customize-front-page-tiers-count' )
	);

	$args = array( 'type' => 'number', 'description' => 'Number of front-page tiers', 'default' => 1 );

	register_setting( 'vm_theme_options', 'vm_theme_options_front_page_tiers_count', $args );

	for ( $i = 1; get_option( 'vm_theme_options_front_page_tiers_count' ) >= $i; $i ++ ) :

		add_settings_section(
			"vm-front-page-tiers-options-tier-$i-section",
			sprintf( _x( 'Tier %d', 'Setting section title; %d: Tier number', VM_TEXT_DOMAIN ), $i ),
			'vm_front_page_tiers_options_section_markup',
			'vm-front-page-tiers-options'
		);
//TODO: Create separate fields for each piece of data.

		add_settings_field(
			"vm-front-page-tiers-options-tier-$i-title",
			__( 'Title', VM_TEXT_DOMAIN ),
			'vm_front_page_tiers_options_title_markup',
			'vm-front-page-tiers-options',
			"vm-front-page-tiers-options-tier-$i-section",
			array (
				'label_for' => "vm-front-page-tiers-options-tier-$i-title",
				'name' => "vm_theme_options_front_page_tier_{$i}_title"
			)
		);

		$args = array( 'type' => 'string', 'description' => "Tier $i title" );

		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_title", $args );

		add_settings_field(
			"vm-front-page-tiers-options-tier-$i-classes",
			__( 'Class(es)', VM_TEXT_DOMAIN ),
			'vm_front_page_tiers_options_classes_markup',
			'vm-front-page-tiers-options',
			"vm-front-page-tiers-options-tier-$i-section",
			array (
				'label_for' => "vm-front-page-tiers-options-tier-$i-classes",
				'name' => "vm_theme_options_front_page_tier_{$i}_classes"
			)
		);

		$args = array( 'type' => 'string', 'description' => "Tier $i classes" );

		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_classes", $args );

		add_settings_field(
			"vm-front-page-tiers-options-tier-$i-template-file",
			__( 'Template file', VM_TEXT_DOMAIN ),
			'vm_front_page_tiers_options_template_file_markup',
			'vm-front-page-tiers-options',
			"vm-front-page-tiers-options-tier-$i-section",
			array (
                'label_for' => "vm-front-page-tiers-options-tier-$i-template-file",
                'name' => "vm_theme_options_front_page_tier_{$i}_template_file"
            )
		);


		$args = array( 'type' => 'string', 'description' => "Tier $i template file" );

		register_setting( 'vm_front_page_tiers_options', "vm_theme_options_front_page_tier_{$i}_template_file", $args );

	endfor;

}

add_action( 'admin_init', 'vm_theme_options' );

