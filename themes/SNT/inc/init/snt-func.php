<?php


/**
 * Displays or retrieves HTML for custom taxonomies' drop-down list
 *
 * @param string|array $args {
 *     Array or string of arguments to generate a terms drop-down element
 *     @type string       $show_option_all   Text to display for showing all terms
 *     @type string       $show_option_none  Text to display for showing no terms
 *     @type string       $option_none_value Value to use when no term is selected
 *     @type string       $orderby           Column to use for ordering terms
 *     @type string       $order             Whether to order terms in ascending or descending order
 *     @type bool         $pad_counts        Whether to Calculate counts by including items from child terms
 *     @type bool|int     $show_count        Whether to include post counts
 *     @type bool|int     $hide_empty        Whether to hide terms that don't have any posts
 *     @type int          $child_of          Term ID to retrieve child terms of
 *     @type array|string $exclude           Array or comma/space-separated string of term ids to exclude
 *     @type bool|int     $echo              Whether to echo or return the generated markup
 *     @type bool|int     $hierarchical      Whether to traverse the taxonomy hierarchy
 *     @type int          $depth             Maximum depth to traverse in taxonomy hierarchy
 *     @type array        $attr              Array of 'attribute' => 'value' pairs for the <select> element
 *     @type string       $name              Value for <select> element's 'name' attribute
 *     @type string       $id                Value for <select> element's 'id' attribute
 *     @type string       $class             Value for <select> element's 'class' attribute
 *     @type int|string   $selected          Value of selected <option> element
 *     @type string       $value_field       Field used to populate 'value' attribute(s)
 *     @type string|array $taxonomy          Taxonomy to retrieve terms for
 *     @type bool         $hide_if_empty     True to skip generating markup if no terms are found
 *     @type bool         $required          Whether to include HTML5 'required' attribute in `<select>` element
 * }
 *
 * @return string          HTML content only if 'echo' argument is 0.
 *
 */
function snt_ct_drop_down( $args = '' ) {

	global $snt_hct;

	$def = array(
		'show_option_all'   => '',
		'show_option_none'  => '',
		'orderby'           => 'id',
		'order'             => 'ASC',
		'show_count'        => 0,
		'hide_empty'        => 1,
		'child_of'          => 0,
		'exclude'           => '',
		'echo'              => 1,
		'selected'          => 0,
		'hierarchical'      => 0,
		'depth'             => 0,
		'attr'              => array(),
		'taxonomy'          => $snt_hct[0]->name,
		'hide_if_empty'     => FALSE,
		'option_none_value' => -1,
		'value_field'       => 'term_id',
	);

	$def['selected'] = ( is_category() ? get_query_var( 'cat' ) : 0 );

	$args = wp_parse_args( $args, $def );

	$none_val = $args['option_none_value'];

	if ( ! isset( $args['pad_counts'] ) && $args['show_count'] && $args['hierarchical'] ) :
		$args['pad_counts'] = true;
	endif;

	$term_args = $args;
	unset( $term_args['name'] );
	$terms = get_terms( $args['taxonomy'], $term_args );

	$attrs = '';
	$attr_array = $args['attr'];
	if ( is_array( $attr_array ) ) :
		foreach ( $attr_array as $attr => $val ) :
			$attrs .= ' ' . $attr . '="' . esc_attr( $val ) . '"';
		endforeach;
	endif;

	if ( ! $args['hide_if_empty'] || ! empty( $terms ) ) :
		$output = "<select$attrs>\n";
	else :
		$output = '';
	endif;

	if ( empty( $terms ) && ! $args['hide_if_empty'] && ! empty( $args['show_option_none'] ) ) :
		$none = $args['show_option_none'];
		$output .= "<option value='" . esc_attr( $none_val ) . "' selected>$none</option>";
	endif;

	if ( ! empty( $terms ) ) :

		if ( $args['show_option_all'] ) :
			$all = $args['show_option_all'];
			$sel = ( '0' === strval( $args['selected'] ) ? "selected='selected'" : '' );
			$output .= "\t<option value='0' $sel>$all</option>\n";
		endif;

		if ( $args['show_option_none'] ) :
			$none = $args['show_option_none'];
			$sel = selected( $none_val, $args['selected'], false );
			$output .= "\t<option value='" . esc_attr( $none_val ) . "' $sel>$none</option>\n";
		endif;

		$depth = ( $args['hierarchical'] ? $args['depth'] : -1 );
		$output .= snt_walk_ct_drop_down_tree( $terms, $depth, $args );

	endif;


	if ( ! $args['hide_if_empty'] || ! empty( $terms ) ) :
		$output .= "</select>\n";
	endif;

	if ( $args['echo'] ) :
		echo $output;
	endif;

	return $output;

}


/**
 * Displays button for forms
 *
 * @param  array $args
 * {
 *     Button arguments
 *     @type string  $text Text to insert inside <button> tag
 *     @type boolean $wrap Whether to wrap HTML in <p> tag
 *     @type boolean $echo Whether to echo or return markup
 *     @type array   $attr
 *     {
 *         Set of 'attribute' => 'value' pairs for <button> tag
 *         @type mixed
 *     }
 * }
 *
 * @return string       HTML markup for button
 *
 */
function snt_submit_btn( array $args = array() ) {

	$defs = array(
		'text' => '',
		'wrap' => FALSE,
		'echo' => FALSE,
		'attr' => array(
			'class' => 'button-primary button-large',
			'name'  => 'submit',
			'type'  => 'submit'
		)
	);

	if ( isset( $args['attr'] ) ) :
		$args['attr'] = wp_parse_args( $args['attr'], $defs['attr'] );
	endif;
	$args = wp_parse_args( $args, $defs );

	$class_array = array( 'button' );
	$attr_array = $args['attr'];

	foreach ( explode( ' ', $attr_array['class'] ) as $class ) :
		$class_array[] = $class;
	endforeach;

	$attr_array['class'] = esc_attr( join( ' ', array_unique( $class_array ) ) );
	$txt = ( empty( $args['text'] ) ? _x( 'Save', 'Default submit button text', 'snt-en' ) : $args['text'] );
	$attrs = '';

	if ( ! isset( $attr_array['id'] )  ) :
		$attr_array['id'] = $attr_array['name'];
	endif;

	if ( ! isset( $attr_array['value'] ) ) :
		$attr_array['value'] = $txt;
	endif;

	foreach ( $attr_array as $attr => $value ) :
		$attrs .= $attr . '="' . esc_attr( $value ) . '" ';
	endforeach;

	$out = "<input $attrs/>";

	if ( $args['wrap'] ) :
		$out = '<p class="submit">' . $out . '</p>';
	endif;

	if ( $args['echo'] ) :
		echo $out;
	endif;

	return $out;

}


/**
 * Retrieves HTML drop-down (select) content for list of taxonomy terms
 *
 * @return string HTML markup for element
 *
 */
function snt_walk_ct_drop_down_tree() {

	$args = func_get_args();

	if ( empty( $args[2]['walker'] ) || ! ( $args[2]['walker'] instanceof Walker ) ) :
		$walker = new SNT_Walker_CT_Drop_Down();
	else :
		$walker = $args[2]['walker'];
	endif;

	return call_user_func_array( array( $walker, 'walk' ), $args );

}


/**
 * Retrieves information from external links used as source
 *
 * @param  string $url Page URL to retrieve information from
 *
 * @return array       Information retrieved from the link
 *
 */
function snt_get_page_info( $url ){
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, esc_url( $url ) );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $curl, CURLOPT_FAILONERROR, TRUE );
	curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 5 );
	curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );
	$page = curl_exec( $curl );

	if ( ! empty( curl_error( $curl ) ) ) :
		return array();
	endif;

	curl_close( $curl );
	preg_match( '/\<title[^\>]*>(.*)\<\/title\>/', $page, $ttl );
	$output['ttl'] = ( ! empty( $ttl[1] ) && is_string( $ttl[1] ) ? $ttl[1] : FALSE );

	return $output;

}
