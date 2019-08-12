<?php


function snt_rearrange_pages_table_cols() {

	$cols = array(
		'cb'       => '<input type="checkbox">',
		'title'    => _x( 'Title', 'Pages table column header', 'ent-en' ),
        'slug'     => _x( 'Slug', 'Pages table column header', 'snt-en' ),
        'template' => _x( 'Template', 'Pages table column header', 'snt-en' ),
	);

	return $cols;

}
add_filter( 'manage_page_posts_columns', 'snt_rearrange_pages_table_cols' );


function snt_print_pages_table_values ( $col, $id ) {

	if ( ! $col || ! $id || ! in_array( $col, array( 'slug', 'template' ), TRUE ) ) :
		return;
	endif;

	if ( 'template' === $col ) :
		$temp = get_post_meta( $id, '_wp_page_template', TRUE );
		echo ( $temp ? '<span>' . str_replace( '.php', '', $temp ) . '</span>' : '<span>&mdash;</span>' );
	else :
		echo '<span>', get_post( $id )->post_name, '</span>';
	endif;

}
add_action( 'manage_page_posts_custom_column', 'snt_print_pages_table_values', 10, 2 );


function snt_make_pages_table_custom_cols_sortable( $cols ) {

	unset( $cols['comments'] );
	unset( $cols['date'] );

	$cols['template'] = 'page_template';

	return $cols;

}
add_filter( 'manage_edit-page_sortable_columns', 'snt_make_pages_table_custom_cols_sortable' );


function snt_sort_pages_table_by_custom_col( WP_Query $query ) {
	global $pagenow;

	if (
		is_singular() ||
		'edit.php' !== $pagenow ||
		! $query->is_main_query() ||
		'page_template' !== $query->get('orderby')
	) :
		return;
	endif;

	$query->set( 'orderby', '_wp_page_template' );

}
add_action( 'pre_get_posts', 'snt_sort_pages_table_by_custom_col' );


function snt_pages_table_filters( $post_type ){
	global $pagenow;

	if ( ! is_admin() || 'edit.php' !== $pagenow || 'page' !== $post_type ) :
		return;
	endif;

	$sel = ( empty( $_GET['page_parent'] ) ? 0 : $_GET['page_parent'] );

	$pg_drp = wp_dropdown_pages(
		array(
			'show_option_none'  => _x( 'All Parents', 'Page parent filter option', 'snt-en' ),
			'option_none_value' => '0',
			'selected'          => $sel,
			'name'              => 'page_parent',
			'id'                => 'filter-by-parent',
			'echo'              => FALSE
		)
	);

	$templates = get_page_templates();

	if ( empty( $templates ) ) :
		echo $pg_drp;
		return;
	endif;

	$sel = ( empty( $_GET['page_template'] ) ? 0 : $_GET['page_template'] );
	$str = _x( 'All Templates', 'Page template filter option', 'snt-en' );

	$tmp_drp = "<select name='page_template' id='filter-by-template'>";

	$tmp_drp .= "<option value='0'>$str</option>";
	foreach ( $templates as $name => $f_name ) :
		$f_name = esc_attr( basename( $f_name, '.php' ) );
		$name = esc_html( $name );
		$sel = ( $sel === $f_name ? ' selected' : '' );
		$tmp_drp .= "<option value='$f_name' $sel>$name</option>";
	endforeach;

	$tmp_drp .= '</select>';

	echo $pg_drp, $tmp_drp;

}
add_action( 'restrict_manage_posts', 'snt_pages_table_filters' );


function snt_filter_pages_table_by_custom_filter( WP_Query $query ) {
	global $pagenow, $post_type;

	if ( ! is_admin() || 'page' !== $post_type || 'edit.php' !== $pagenow ) :
		return;
	endif;

	if ( isset( $_GET['page_parent'] ) && ! empty( $_GET['page_parent'] ) ) :
		$query->query_vars['post_parent__in'] = array( (int) $_GET['page_parent'] );
	endif;

	if ( isset( $_GET['page_template'] ) && ! empty( $_GET['page_template'] ) ) :
		$query->set( 'meta_key', '_wp_page_template' );
		$query->set( 'meta_value', $_GET[ 'page_template' ] . '.php' );
	endif;

}
add_action( 'parse_query', 'snt_filter_pages_table_by_custom_filter' );
