<?php


/**
 * Create option and its field.
 *
 * @param array $args {
 *      Field and option parameters
 *      @type string   $field_id           (Required) Used as the ID attribute for the field.
 *      @type string   $field_title        (Optional) Used as the introduction text next to the field.
 *      @type callable $field_markup       (Required) Function that prints field markup.
 *      @type string   $page_slug          (Required) The slug name of the menu page where the field appears.
 *      @type string   $section_id         (Optional) ID of the section where the field belongs.
 *      @type string   $option_name        (Required) Used as both the "Option name" and the field name value.
 *      @type string   $option_type        (Optional) Default: 'string' Identifies the type of field.
 *          Possible values are 'string','boolean','integer', and 'number'.
 *      @type string   $option_description (Optional) A description of the option.
 *      @type string   $option_default     (Optional) Default value for get_option().
 *      @type string   $option_group       (Required) The option group where this option belongs.
 *      @type array    $extra_args         (Optional) Additional arguments to pass to markup function.
 * }
 *
 */
function vm_theme_options_field_setting( array $args ) {

	$defaults = array(
		'field_title'        => '',
		'field_markup'       => 'vm_options_text_field_markup',
		'option_type'        => 'string',
		'option_description' => '',
		'option_default'     => null,
		'extra_args'         => null,
	);
	$args     = wp_parse_args( $args, $defaults );

	$field_args = array( 'label_for' => $args['field_id'], 'name' => $args['option_name'] );
	if ( ! empty ( $args['extra_args']) && is_array( $args['extra_args'] ) ) :
		$field_args = array_merge( $field_args, $args['extra_args'] );
	endif;
	add_settings_field(
		$args['field_id'],
		$args['field_title'],
		$args['field_markup'],
		$args['page_slug'],
		empty( $args['section_id'] ) ? 'default' : $args['section_id'],
		$field_args,
	);

	$reg_args = 		array(
		'type' => $args['option_type'],
		'description' => $args['option_description'],
	);
	if ( isset($args['option_default'] ) ) :
		$reg_args['default'] = $args['option_default'];
	endif;

	register_setting( $args['option_group'], $args['option_name'], $reg_args);

}