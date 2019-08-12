<?php


function snt_rearrange_posts_table_cols() {

	$cols = array(
		'cb'    => '<input type="checkbox">',
		'id'    => _x( 'ID', 'Posts table column header', 'ent-en' ),
		'title' => _x( 'Title', 'Posts table column header', 'ent-en' )
	);

	global $snt_hct;

	foreach ( $snt_hct as $obj ) :
		$cols[ 'taxonomy-' . $obj->name ] = $obj->labels->singular_name;
	endforeach;

	$cols['top'] = _x( 'Top in', 'Posts table column header', 'snt-en' );
	$cols['img'] = '<span class="dashicons dashicons-camera"></span>';
	$cols['date'] = _x( 'Date', 'Posts table column header', 'snt-en' );

	return $cols;

}
add_filter( 'manage_post_posts_columns', 'snt_rearrange_posts_table_cols' );


function snt_print_posts_table_values ( $col, $id ) {

	if ( ! $col || ! $id ) :
		return;
	endif;

	if ( ! in_array( $col, array( 'top', 'id', 'img' ), TRUE ) ) :
		return;
	endif;

	switch ( $col ) :
        case 'top' :

            $top = get_post_meta( $id, 'top_meta_data', TRUE );

	        if ( $top ) :
		        echo "<a href='edit.php?top=$top' data-top='$top'><span>", ucfirst( $top ), "</span></a>";
	            break;
            endif;

            echo '<span>&mdash;</span>';

	        break;
        default  :

	        echo "<span>$id</span>";

	        break;
        case 'img' :

            echo '<span class="dashicons dashicons-', ( has_post_thumbnail( $id ) ? 'yes' : 'no' ), '"></span>';

	        break;
    endswitch;

}
add_action( 'manage_post_posts_custom_column', 'snt_print_posts_table_values', 10, 2 );


function snt_make_posts_table_custom_cols_sortable( $cols ) {

	global $snt_hct;

	foreach ( $snt_hct as $obj ) :
		$cols[ 'taxonomy-' . $obj->name ] = $obj->name;
	endforeach;

	$cols['top'] = 'top';
	$cols['img'] = 'img';

	return $cols;

}
add_filter( 'manage_edit-post_sortable_columns', 'snt_make_posts_table_custom_cols_sortable' );


function snt_sort_posts_table_by_ct( $clauses, WP_Query $query ) {

	global $pagenow, $post_type;

	if (
		! is_admin() ||
		'edit.php' !== $pagenow ||
		'post' !== $post_type ||
		! $query->is_main_query() ||
		empty( $query->get( 'orderby' ) )
	) :
		return $clauses;
	endif;

	$by = $query->get( 'orderby' );

	global $wpdb, $snt_hct;

	foreach ( $snt_hct as $obj ) :

		if ( $by !== $obj->name ) :
			continue;
		endif;

		$clauses['join'] .= <<<SQL
LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;

		$clauses['where'] .= " AND (taxonomy = '" . $obj->name . "')";
		$clauses['groupby'] = "object_id";
		$clauses['orderby']  = "GROUP_CONCAT(" . $wpdb->terms . ".name ORDER BY name ASC) ";
		$clauses['orderby'] .= ( "ASC" === strtoupper( $query->get('order') ) ? "ASC" : "DESC" );

	endforeach;

	return $clauses;

}
add_filter( 'posts_clauses', 'snt_sort_posts_table_by_ct', 10, 2 );


function snt_sort_posts_table_by_custom_col( WP_Query $query ) {

	global $pagenow;

	if ( is_singular() || 'edit.php' !== $pagenow || ! $query->is_main_query() ) :
		return;
	endif;

	$by = $query->get( 'orderby' );

	if ( ! in_array( $by, array( 'top', 'img' ), TRUE ) ) :
        return;
	endif;

	switch ( $by ) :
        case 'top' :
	        $query->set( 'orderby', 'top_meta_data' );
	        break;
        default :
	        $query->set( 'orderby', '_thumbnail_id' );
	        break;
    endswitch;

}
add_action( 'pre_get_posts', 'snt_sort_posts_table_by_custom_col' );


function snt_posts_table_filters( $post_type ){

	global $pagenow;

	if ( ! is_admin() || 'edit.php' !== $pagenow || 'post' !== $post_type ) :
		return;
	endif;

	global $snt_hct;

	foreach ( $snt_hct as $obj ) :

		$sel_tax = NULL;
		$none = sprintf( ' ' . _x( 'All %1$s', 'Filter option; 1: Taxonomy label', 'snt-en' ), $obj->label );

		if ( ! empty( $_GET[ $obj->name ] ) && term_exists( $_GET[ $obj->name ], $obj->name ) ) :
			$sel_tax = $_GET[ $obj->name ];
		endif;

		$args = array(
			'attr'              => array( 'name' => $obj->name, 'id' => 'filter-by-' . $obj->name ),
			'show_option_none'  => $none,
			'option_none_value' => '',
			'orderby'           => 'name',
			'hide_empty'        => FALSE,
			'selected'          => ( $sel_tax ? $sel_tax : FALSE ),
			'hierarchical'      => TRUE,
			'taxonomy'          => $obj->name,
			'hide_if_empty'     => false,
			'value_field'       => 'slug'
		);

		snt_ct_drop_down( $args );

	endforeach;

	$sel_meta = ( isset( $_GET['top'] ) && is_string( $_GET['top'] ) ? $_GET['top'] : NULL );

	$opt_arr = array(
		''       => ' ' . _x( 'All Top Values', 'Option for Top meta-data filter in posts table', 'snt-en' ),
		'region' => ' ' . _x( 'Region Tops', 'Option for Top meta-data filter in posts table', 'snt-en' ),
		'topic'  => ' ' . _x( 'Topic Tops', 'Option for Top meta-data filter in posts table', 'snt-en' ),
		'none'   => ' ' . _x( 'Non-tops', 'Option for Top meta-data filter in posts table', 'snt-en' )
	);

	?><label>
    <select name="top" id="filter-by-top"><?php

		foreach ( $opt_arr as $opt => $txt ) :

			$attr = ( $sel_meta === $opt ? ' selected="selected"' : '' );

			?><option value="<?php echo $opt; ?>"<?php echo $attr; ?>><?php echo $txt; ?></option><?php

		endforeach;

		?></select>
    </label><?php

	$sel_meta = ( isset( $_GET['img'] ) ? $_GET['img'] : NULL );

	$opt_arr = array(
		''   => _x( 'All Posts', 'Post thumbnail filter option', 'snt-en' ),
		'1'  => _x( 'With Thumbnails', 'Post thumbnail filter option', 'snt-en'),
		'-1' => _x( 'Without Thumbnails', 'Post thumbnail filter option', 'snt-en')
	);

	?><label>
    <select name="img" id="filter-by-img"><?php

		foreach ( $opt_arr as $opt => $txt ) :

			$attr = ( $sel_meta == $opt ? ' selected="selected"' : '' );

			?><option value="<?php echo $opt; ?>"<?php echo $attr; ?>><?php echo $txt; ?></option><?php

		endforeach;

		?></select>
    </label><?php

}
add_action( 'restrict_manage_posts', 'snt_posts_table_filters' );


function snt_filter_posts_table_by_custom_filter( WP_Query $query ) {

	global $pagenow, $post_type;

	if ( ! is_admin() || 'post' !== $post_type || 'edit.php' !== $pagenow ) :
		return;
	endif;

	foreach ( array( 'img' => '_thumbnail_id', 'top' => 'top_meta_data' ) as $key => $val ) :

        if ( ! isset( $_GET[ $key ] ) || empty( $_GET[ $key ] ) ) :
			continue;
		endif;

		$get = NULL;

		if ( 'top' === $key ) :
			$query->set( 'meta_key', $val );
			$query->set( 'meta_value', $_GET[ $key ] );
        else :
	        if ( '-1' === $_GET[ $key ] ) :
		        $query->query_vars['meta_query'] = array(
			        'relation' => 'OR',
			        array( 'key' => '_thumbnail_id', 'compare' => 'NOT EXISTS' ),
			        array( 'key' => '_thumbnail_id', 'value' => 0, 'compare' => '<=', 'type' => 'NUMERIC' )
		        );
	        else :
		        $query->query_vars['meta_query'] = array(
			        array( 'key' => '_thumbnail_id', 'value' => 0, 'compare' => '>', 'type' => 'NUMERIC' )
		        );
	        endif;
        endif;

	endforeach;

}
add_action( 'parse_query', 'snt_filter_posts_table_by_custom_filter' );


function snt_top_meta_quick_edit_form( $col, $type ) {

	if ( 'post' !== $type ) :
		return;
	endif;

	if ( $col !== 'top' ) :
		return;
	endif;

	wp_nonce_field( 'snt_save_post_quick_edit_custom_data', 'quick_edit_top_nonce', TRUE );

	$options = array(
		''       => ' ' . _x( 'Not specified', 'Option for Top meta-data quick edit form', 'snt-en' ),
		'region' => _x( 'Regions', 'Option for Top meta-data quick edit form', 'snt-en' ),
		'topic'  => _x( 'Topics', 'Option for Top meta-data quick edit form', 'snt-en' ),
		'none'   => _x( 'Nowhere', 'Option for Top meta-data quick edit form', 'snt-en' )
	);

	?><fieldset class="fieldset-meta-quick-edit inline-edit-col-right">
    <label class="label-sm-qe">
        <span class="title"><?php _ex( 'Top in', 'Text in Top meta-data quick edit form', 'snt-en' ); ?></span>
        <select name="top" id="top"><?php

			foreach ( $options as $val => $txt ) :
				?><option value="<?php echo $val; ?>"><?php echo $txt; ?></option><?php
			endforeach;

			?></select>
    </label>
    </fieldset><?php

}
add_action( 'quick_edit_custom_box', 'snt_top_meta_quick_edit_form', 10, 2 );


function snt_top_meta_bulk_edit_form( $col, $type ) {

	if ( 'post' !== $type ) :
		return;
	endif;

	if ( $col !== 'top' ) :
		return;
	endif;

	$options = array(
		''       => ' ' . _x( 'No Changes', 'Option for Top meta-data bulk edit form', 'snt-en' ),
		'region' => _x( 'Regions', 'Option for Top meta-data bulk edit form', 'snt-en' ),
		'topic'  => _x( 'Topics', 'Option for Top meta-data bulk edit form', 'snt-en' ),
		'none'   => _x( 'Nowhere', 'Option for Top meta-data bulk edit form', 'snt-en' )
	);

	?><label class="label-sm-be">
    <span class="title"><?php _ex( 'Top in', 'Text in Top meta-data quick edit form', 'snt-en' ); ?></span>
    <select name="top" id="top"><?php

		foreach ( $options as $val => $txt ) :
			?><option value="<?php echo $val; ?>"><?php echo $txt; ?></option><?php
		endforeach;

		?></select>
    </label>
    <br /><?php

}
add_action( 'bulk_edit_custom_box', 'snt_top_meta_bulk_edit_form', 10, 2 );


function snt_ct_quick_edit_form( $col, $type ) {

	if ( 'post' !== $type ) :
		return;
	endif;

	global $snt_hct;

	wp_nonce_field( 'snt_save_post_quick_edit_custom_data', 'quick_edit_ct_nonce', TRUE );

	foreach ( $snt_hct as $obj ) :

		if ( $col !== 'taxonomy-' . $obj->name ) :
			continue;
		endif;

		$args = array(
			'show_option_none' => ' ' . _x( 'Not Specified', 'No taxonomy terms assigned', 'snt-en' ),
			'orderby'          => 'name',
			'hide_empty'       => FALSE,
			'hierarchical'     => TRUE,
			'echo'             => FALSE,
			'taxonomy'         => $obj->name,
			'hide_if_empty'    => FALSE,
			'value_field'	   => 'term_id',
			'attr'             => array( 'name' => 'sel_tax_' . $obj->name, 'id' => 'sel-tax-' . $obj->name ),
		);

		$html = snt_ct_drop_down( $args );

		?><fieldset class="fieldset-tax-quick-edit inline-edit-col-right">
        <label class="label-st-qe">
            <span class="title"><?php echo $obj->labels->singular_name; ?></span><?php
			echo $html;
			?></label>
        </fieldset><?php

	endforeach;

}
add_action( 'quick_edit_custom_box', 'snt_ct_quick_edit_form', 10, 2 );


function snt_ct_bulk_edit_form( $col, $type ) {

	if ( 'post' !== $type ) :
		return;
	endif;

	global $snt_hct;

	foreach ( $snt_hct as $obj ) :

		if ( $col !== 'taxonomy-' . $obj->name ) :
			continue;
		endif;

		$unset_str = _x( 'Remove All Terms', 'Unset taxonomy terms', 'snt-en' );
		$args = array(
			'show_option_none'  => ' ' . _x( 'No Changes', 'No changes in taxonomy terms', 'snt-en' ),
			'option_none_value' => 0,
			'orderby'           => 'name',
			'hide_empty'        => FALSE,
			'echo'              => FALSE,
			'hierarchical'      => TRUE,
			'taxonomy'          => $obj->name,
			'hide_if_empty'     => FALSE,
			'value_field'	    => 'term_id',
			'attr'              => array( 'name' => 'sel_tax_' . $obj->name, 'id' => 'sel-tax-' . $obj->name )
		);

		$unset = "<option class='dashicons-before dashicons-trash' value='-1'>$unset_str</option>";

		$html = substr_replace( snt_ct_drop_down( $args ), $unset, -10, 0 );

		?><label class="label-st-be">
            <span class="title"><?php echo $obj->labels->singular_name; ?></span><?php
            echo $html;
		?></label>
        <br /><?php

	endforeach;

}
add_action( 'bulk_edit_custom_box', 'snt_ct_bulk_edit_form', 10, 2 );
