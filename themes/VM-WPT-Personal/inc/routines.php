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
 *
 * }
 *
 */
function vm_theme_options_field_setting( array $args ) {

	if ( ! in_array( @$args['option_type'], array( 'string', 'boolean', 'integer', 'number' ), true ) ) :
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
 * @param int $id (Required) $post id
 * @param string $size (Optional) Image size; default: 'thumbnail'
 *
 * @return string      URL of the post category image, or a default theme image
 *
 */
function vm_get_post_cat_img_url( int $id, $size = 'thumbnail' ) {

	$post_cat_id = get_the_category( $id )[0]->term_id;
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

	return VM_DEF_IMG;

}


/**
 * Retrieve post's thumbnail URL, may also retrieve post's category image or a default theme image.
 *
 * @param int $id (Required) $post id
 * @param string $size (Optional) Image size; default: 'thumbnail'
 * @param bool $cat (Optional) If true, post category image will also be tried
 *
 * @return false|string       URL of the post image, its category image, or a default theme image
 *
 */
function vm_get_post_img_url( int $id, $size = 'thumbnail', $cat = false ) {

	if ( has_post_thumbnail() ) :
		return get_the_post_thumbnail_url( null, $size );
	else :
		return $cat ? vm_get_post_cat_img_url( $id, $size ) : VM_DEF_IMG;
	endif;

}


/**
 * Retrieve post's relative publication time.
 *
 * @param int $id (Required) $post id
 *
 * @return false|string      Relative publication time of the post; false on failure
 *
 */
function vm_get_post_relative_time( int $id ) {

	$pub = get_the_time( 'U', $id );
	$now = time();
	$l_m = strtotime( 'last min' );
	$l_h = strtotime( 'last hour' );
	$l_t = strtotime( 'today' );
	$l_d = strtotime( 'yesterday' );
	$l_w = strtotime( 'last week' );

	switch ( true ) :
		default :
			$output = get_the_date( 'j M Y', $id );
			break;
		case ( strtotime( 'last year' ) < $pub && $l_w > $pub ) :
			$output = get_the_date( 'j F', $id );
			break;
		case ( $l_w < $pub && $l_d > $pub ) :
			$output = get_the_time( 'l, h:i A', $id );
			break;
		case ( $l_d < $pub && $l_t > $pub ) :
			$output = __( 'Yesterday', VM_TD ) . get_the_time( ' h:i A', $id );
			break;
		case ( $l_t < $pub && $l_h > $pub ) :
			$hrs    = intval( ( $now - $pub ) / 3600 );
			$output = _nx( 'About an hour ago', 'About %1$s hours ago', $hrs, 'Time text; 1: Hours', VM_TD );
			$output = sprintf( $output, number_format_i18n( $hrs ) );
			break;
		case ( $l_h < $pub && $l_m > $pub ) :
			$min    = intval( ( $now - $pub ) / 60 );
			$output = _nx( 'About a minute ago', 'About %1$s minutes ago', $min, 'Time text; 1: Minutes', VM_TD );
			$output = sprintf( $output, number_format_i18n( $min ) );
			break;
		case ( $l_m < $pub ) :
			$output = _x( 'Less than a minute ago', 'Time text', VM_TD );
			break;
	endswitch;

	return $output;

}


/**
 * Retrieve HTML markup material for the post.
 *
 * @param $id
 * @param array $args {
 *      (Optional) Output settings
 *
 * @type bool $force_img If true, will resort to post category image, and then theme's default image; default: false
 * @type string $img_size Image size; default: 'thumbnail'
 *
 * }
 *
 * @return array {
 *    Array of HTML markup material for the post
 *
 * @type string $link Post permalink
 * @type string $title Post title
 * @type string $rel_time Post publish time (relative format)
 * @type string $iso_time Post publish time (standard format)
 * @type string $excerpt Post excerpt
 * @type string $classes Post CSS classes
 * @type string $category Post category
 * @type string $tags Post tags
 * @type string $title_attr Post title (escaped for attribute)
 * @type string $img_url Post image URL
 *
 * }
 *
 */
function vm_get_post_markup_array( int $id, $args = array() ) {

	$defaults = array(
		'force_img' => false,
		'img_size'  => 'thumbnail',
	);

	$args = wp_parse_args( $args, $defaults );

	$html_arr = array();

	$html_arr['link']       = get_the_permalink();
	$html_arr['title']      = get_the_title();
	$html_arr['rel_time']   = vm_get_post_relative_time( $id );
	$html_arr['iso_time']   = get_the_date( 'c' );
	$html_arr['excerpt']    = get_the_excerpt();
	$html_arr['classes']    = implode( ' ', get_post_class() );
	$html_arr['category']   = wp_get_post_terms( $id, 'category', array( 'childless' => true ) )[0]->name;
	$html_arr['tags']       = implode( ' ', wp_get_post_terms( $id, 'post_tag', array( 'fields' => 'names' ) ) );
	$html_arr['title_attr'] = esc_attr( $html_arr['title'] );
	$html_arr['img_url']    =
		$args['force_img'] ?
			vm_get_post_img_url( $id, $args['img_size'], true ) : get_the_post_thumbnail_url( $id, $args['img_size'] );

	return $html_arr;

}


/**
 * Fetch a random text from Web APIs.
 *
 * @param int $resource (Required) API resource to send the request to
 *
 * @return string       Generated random text
 *
 */
function vm_get_lorem( int $resource ) {
//TODO: add options array for each resource
	$response = '';

	switch ( $resource ) :
		case 1 :
			$curl = curl_init();

			curl_setopt_array( $curl, array(
				CURLOPT_URL            => "https://montanaflynn-lorem-text-generator.p.rapidapi.com/word?count=20",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => "GET",
				CURLOPT_HTTPHEADER     => array(
					"x-rapidapi-host: montanaflynn-lorem-text-generator.p.rapidapi.com",
					"x-rapidapi-key: 927a33289fmsh1afcf28496c1de5p175bcbjsn9ccf85fcdbdc"
				),
			) );

			$err = curl_error( $curl );

			$response = $err ? ( 'cURL Error #:' . $err ) : curl_exec( $curl );

			curl_close( $curl );

			break;
		case 2 :
			$response = file_get_contents( 'http://loripsum.net/api/1/medium/plaintext' );
			break;
		case 3 :
			$response = json_decode( file_get_contents( 'http://asdfast.beobit.net/api/?type=paragraph&length=3' ) )->text;
			break;
	endswitch;

	return $response;
}


function vm_shc_site_url() {
	return home_url();
}

add_shortcode( 'site_url', 'vm_shc_site_url' );