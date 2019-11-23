<?php


/**
 * Create an option and its field.
 *
 * @param array $args {
 *     (Required) Field and option parameters
 *
 * @type string $field_id (Required) Used as the ID attribute for the field
 * @type string $page_slug (Required) The slug name of the menu page where the field appears
 * @type string $option_name (Required) Used as both the "Option name" and the field name value
 * @type string $option_group (Required) The option group where this option belongs
 * @type string $field_title (Optional) Default: ''; Used as the introduction text next to the field
 * @type callable $field_markup (Optional) Default: 'vm_text_option_field_markup'; Function that prints field markup
 * @type string $section_id (Optional) Default: null; ID of the section where the field belongs
 * @type string $option_type (Optional) Default: 'string'; Identifies the type of field; Possible values are 'string','boolean','integer', and 'number'
 * @type string $option_description (Optional) Default: null; A description of the option
 * @type string $option_default (Optional) Default: null; Value for get_option()
 * @type array $extra_args (Optional) Default: null
 * }
 *
 */
function vm_theme_options_field_setting( array $args ) {

	if (
		empty( $args['option_type'] ) ||
		! in_array( $args['option_type'], array( 'string', 'boolean', 'integer', 'number' ), true )
	) :
		$args['option_type'] = 'string';
	endif;
	$defaults = array(
		'field_title'        => '',
		'field_markup'       => 'vm_text_option_field_markup',
		'section_id'         => null,
		'option_type'        => 'string',
		'option_description' => '',
		'option_default'     => null,
		'extra_args'         => null,
	);
	$args     = wp_parse_args( $args, $defaults );

	$field_args = array( 'label_for' => $args['field_id'], 'name' => $args['option_name'] );
	if ( ! empty ( $args['extra_args'] ) && is_array( $args['extra_args'] ) ) :
		$field_args = array_merge( $field_args, $args['extra_args'] );
	endif;
	add_settings_field(
		$args['field_id'],
		$args['field_title'],
		$args['field_markup'],
		$args['page_slug'],
		empty( $args['section_id'] ) ? 'default' : $args['section_id'],
		$field_args
	);

	$reg_args = array(
		'type'        => $args['option_type'],
		'description' => $args['option_description'],
	);
	if ( isset( $args['option_default'] ) ) :
		$reg_args['default'] = $args['option_default'];
	endif;

	register_setting( $args['option_group'], $args['option_name'], $reg_args );

}


/**
 * Retrieve post's category (or its parent categories) image URL, may also retrieve a default theme image.
 *
 * @param string $size (Optional)  Default: 'thumbnail';
 *                                 One of WordPress default image sizes;
 *                                 Possible values are 'post-thumbnail','thumbnail','medium','medium_large','large',
 *                                 and 'full'
 *
 * @return string                  URL of the post category image, or a default theme image
 *
 */
function vm_get_post_cat_img_url( $size = 'thumbnail' ) {

	if (
		empty( $size ) ||
		! in_array( $size, array( 'post-thumbnail', 'thumbnail', 'medium', 'medium_large', 'large', 'full' ), true )
	) :
		$size = 'thumbnail';
	endif;

	$post_cat_id = get_the_category()[0]->term_id;
	$img_id      = (int) get_term_meta( $post_cat_id, 'category_image', true );
	if ( ! empty( wp_get_attachment_url( $img_id ) ) ) :
		return wp_get_attachment_image_src( $img_id, $size )[0];
	endif;

	foreach ( get_ancestors( $post_cat_id, 'category', 'taxonomy' ) as $parent_cat ) :
		$img_id = (int) get_term_meta( $parent_cat->term_id, 'category_image', true );
		if ( ! empty ( wp_get_attachment_url( $img_id ) ) ) :
			return wp_get_attachment_image_src( $img_id, $size )[0];
			break;
		endif;
	endforeach;

	//TODO: set path for default image as constant.

	return VM_DEF_IMG;

}


/**
 * Retrieve post's thumbnail URL, may also retrieve post's category image or a default theme image.
 *
 * @param string $size (Optional) One of WordPress default image sizes
 * @param boolean $cat (Optional) If true, post category image will also be tried
 *
 * @return string                   URL of the post image, its category image, or a default theme image
 *
 */
function vm_get_post_img_url( $size = 'thumbnail', $cat = false ) {

	if (
		empty( $size ) ||
		! in_array( $size, array( 'post-thumbnail', 'thumbnail', 'medium', 'medium_large', 'large', 'full' ), true )
	) :
		$size = 'thumbnail';
	endif;

	$cat = empty( $cat ) ? false : true;

	if ( has_post_thumbnail() ) :
		return get_the_post_thumbnail_url( null, $size );
	else :
		return $cat ? vm_get_post_cat_img_url( $size ) : VM_DEF_IMG;
	endif;

}


/**
 * Retrieve post's relative publication time.
 *
 * @return string Post's relative publication time
 *
 */
function vm_get_post_pub_time() {

	$pub = get_the_time( 'U' );
	$now = time();
	$l_m = strtotime( 'last min' );
	$l_h = strtotime( 'last hour' );
	$l_t = strtotime( 'today' );
	$l_d = strtotime( 'yesterday' );
	$l_w = strtotime( 'last week' );

	switch ( true ) :
		default :
			$output = get_the_date( 'j M Y' );
			break;
		case ( strtotime( 'last year' ) < $pub && $l_w > $pub ) :
			$output = get_the_date( 'j F' );
			break;
		case ( $l_w < $pub && $l_d > $pub ) :
			$output = get_the_time( 'l, h:i A' );
			break;
		case ( $l_d < $pub && $l_t > $pub ) :
			$output = _x( 'Yesterday', 'Publish time', VM_TEXT_DOMAIN ) . get_the_time( ' h:i A' );
			break;
		case ( $l_t < $pub && $l_h > $pub ) :
			$hrs    = intval( ( $now - $pub ) / 3600 );
			$output = _nx( 'About an hour ago', 'About %1$s hours ago', $hrs, 'Time text; 1: Hours', VM_TEXT_DOMAIN );
			$output = sprintf( $output, number_format_i18n( $hrs ) );
			break;
		case ( $l_h < $pub && $l_m > $pub ) :
			$min    = intval( ( $now - $pub ) / 60 );
			$output = _nx( 'About a minute ago', 'About %1$s minutes ago', $min, 'Time text; 1: Minutes', VM_TEXT_DOMAIN );
			$output = sprintf( $output, number_format_i18n( $min ) );
			break;
		case ( $l_m < $pub ) :
			$output = _x( 'Less than a minute ago', 'Time text', VM_TEXT_DOMAIN );
			break;
	endswitch;

	return $output;

}
