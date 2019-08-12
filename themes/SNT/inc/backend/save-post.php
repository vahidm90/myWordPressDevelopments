<?php


function snt_save_post_bulk_edit_custom_data() {

	if ( ! check_ajax_referer( 'snt_bulk_edit_nonce', 'security' ) ) :
		echo 'security failure';
		die;
	endif;

	$ids = ( ! empty( $_POST['ids'] ) ? $_POST['ids'] : array() );
	if ( empty( $ids ) || ! is_array( $ids ) ) :
		echo 'invalid data';
		die;
	endif;

	if ( empty( $_POST['tax'] ) ) :
		$top = ( empty( $_POST['top'] ) ? NULL : $_POST['top'] );
		foreach ( $ids as $id ) :
			update_post_meta( $id, 'top_meta_data', $top );
		endforeach;
	else :
		$term = ( empty( $_POST['term'] ) ? NULL : $_POST['term'] );
		foreach ( $ids as $id ) :
			if ( -1 === $term && $_POST['tax'] ) :
				wp_delete_object_term_relationships( $id, $_POST['tax'] );
			elseif ( $term && $_POST['tax'] ) :
				wp_set_post_terms( $id, $term, $_POST['tax'] ) ;
			endif;
		endforeach;
	endif;

	die;

}
add_action( 'wp_ajax_snt-save-top-bulk-edit-data', 'snt_save_post_bulk_edit_custom_data' );
add_action( 'wp_ajax_snt-save-ct-bulk-edit-data', 'snt_save_post_bulk_edit_custom_data' );


function snt_save_post_quick_edit_custom_data( $id ) {
	global $pagenow, $snt_hct;

	if (
		'add' === get_current_screen()->action ||
		'admin-ajax.php' !== $pagenow ||
		! ( 'post' == $_POST['post_type'] ) ||
		! current_user_can( 'edit_post', $id )
	) :
		return;
	endif;

	if (
		wp_verify_nonce( $_POST['quick_edit_top_nonce'], 'snt_save_post_quick_edit_custom_data' ) &&
		isset( $_POST['top'] )
	) :
		update_post_meta( $id, 'top_meta_data', $_POST['top'] );
	endif;

	if ( ! wp_verify_nonce( $_POST['quick_edit_ct_nonce'], 'snt_save_post_quick_edit_custom_data' ) ) :
		return;
	endif;

	foreach ( $snt_hct as $obj ) :
		if ( ! isset( $_POST[ 'sel_tax_' . $obj->name ] ) ) :
			continue;
		endif;
		if ( '-1' === $_POST[ 'sel_tax_' . $obj->name ] ) :
			wp_delete_object_term_relationships( $id, $obj->name );
		elseif ( $_POST[ 'sel_tax_' . $obj->name ] ) :
			wp_set_post_terms( $id, (int) $_POST[ 'sel_tax_' . $obj->name ], $obj->name );
		endif;
	endforeach;

}
add_action( 'save_post_post', 'snt_save_post_quick_edit_custom_data' );


function snt_save_custom_post_data ( $id ) {
	global $pagenow;

	if (
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) ||
		'post.php' !== $pagenow ||
		! current_user_can( 'edit_post', $id ) 
	) :
		return;
	endif;

	global $snt_hct, $snt_nhct;

	foreach ( $snt_nhct as $obj ) :
		if ( empty( get_option( "snt_def_{$obj->name}s_user_" . get_current_user_id(), '' ) ) ) :
			continue;
		endif;
		wp_set_post_terms($id, get_option("snt_def_{$obj->name}s_user_" . get_current_user_id(), ''), $obj->name, TRUE);
	endforeach;

	foreach ( $snt_hct as $obj ) :
		
		if (
			! isset( $_POST[ 'sel_tax_' . $obj->name ] ) ||
			! isset( $_POST[ 'taxonomy_' . $obj->name . '_mb_nonce' ] ) ||
			! wp_verify_nonce( $_POST[ 'taxonomy_' . $obj->name . '_mb_nonce' ], 'snt_save_custom_post_data' )
		) :
			continue;
		endif;

		wp_set_post_terms( $id, (int) $_POST[ 'sel_tax_' . $obj->name ], $obj->name );

	endforeach;
	
	foreach ( array( 'desc', 'related', 'source', 'top' ) as $meta ) :
		if (
			! isset( $_POST[ "{$meta}_mb_nonce" ] ) ||
			! wp_verify_nonce( $_POST[ "{$meta}_mb_nonce" ], 'snt_save_custom_post_data' )
		):
			continue;
		endif;

		$value = ( empty( $_POST[ $meta ] ) ? '' : $_POST[ $meta ] );

		switch ( $meta ) :
			case 'related' :
				snt_save_post_related_meta( $id );
				continue 2;
				break;
			case 'source' :
				snt_save_post_source_meta( $id );
				continue 2;
				break;
			default :
				$value = trim( sanitize_textarea_field( $value ) );
				break;
		endswitch;

		update_post_meta( $id, "{$meta}_meta_data", $value );

	endforeach;

}
add_action( 'save_post_post', 'snt_save_custom_post_data' );


function snt_save_post_related_meta( $id ) {

	$cur = get_post_meta( $id, 'related_meta_data', TRUE );
	$add = ( isset( $_POST['related'] ) ? $_POST['related'] : '' );
	$cur_arr = explode( ',', $cur );
	$add_arr = explode( ',', $add );

	if (
		( empty( $cur ) && empty( $add ) ) ||
		( empty( array_diff( $add_arr, $cur_arr ) ) && empty( array_diff( $cur_arr, $add_arr ) ) )
	) :

		return;

	elseif ( empty( $cur ) ) :
		foreach ( $add_arr as $add_id ) :
			snt_mutual_relation( (int) $add_id, (string) $id );
		endforeach;
		update_post_meta( $id, 'related_meta_data', $add );

		return;

	elseif ( empty( $add ) ) :
		foreach ( $cur_arr as $cur_id ) :
			snt_remove_mutual_relation( (int) $cur_id, (string) $id );
		endforeach;
		delete_post_meta( $id, 'related_meta_data' );

		return;

	endif;
	$add_arr = array_diff( $add_arr, $eq = array_intersect( $add_arr, $cur_arr ) );

	if ( ! empty( $add_arr ) ) :
		foreach ( $add_arr as $add_id ) :
			snt_mutual_relation( (int) $add_id, (string) $id );
		endforeach;
	endif;

	if ( ( $num_cur = count( $cur_arr ) ) > ( $num_eq = count( $eq ) ) ) :
		foreach ( $cur_arr = array_diff( $cur_arr, $eq ) as $cur_id ) :
			snt_remove_mutual_relation( (int) $cur_id, (string) $id );
		endforeach;
	endif;

	$add = ( empty( $add_arr ) ? '' : join( ',', $add_arr ) );
	$cur = ( empty( $eq ) ? '' : join( ',', $eq ) );

	if ( empty( $cur = $cur . ( empty( $cur ) || empty( $add ) ? '' : ',' ) . $add ) ) :
		delete_post_meta( $id, 'related_meta_data' );
		return;
	endif;

	update_post_meta( $id, 'related_meta_data', $cur );

}


function snt_save_post_source_meta( $id ){

	if ( empty( $_POST['source'] ) || ! (int) $_POST['count-source'] ) :
		delete_post_meta( $id, 'source_meta_data' );
		return;
	endif;

	$i = 0;
	$safe_val = array();
	foreach ( $_POST['source'] as $key => $item ) :
		if ( empty( $item['name'] ) ) :
			continue;
		endif;
		$safe_val[ $i ]['name'] = sanitize_text_field( $item['name'] );
		if ( empty( $item['url'] ) || 2 !== (int) $_POST[ 'switch-src-' . $key ] ) :
			$i++;
			continue;
		endif;
		$safe_val[ $i ]['url'] = sanitize_text_field( $item['url'] );
		$i++;
	endforeach;

	if ( empty( $safe_val ) ) :
		return;
	endif;

	update_post_meta( $id, 'source_meta_data', $safe_val );

}


/**
 * Enables mutual relation between related posts
 *
 * @param int    $id  ID of related post
 *
 * @param string $add post ID
 *
 */
function snt_mutual_relation( $id, $add ) {

	if ( 1 > $id || empty( $add ) || ! is_string( $add ) ) :
		return;
	endif;

	if ( empty ( $cur = get_post_meta( $id, 'related_meta_data', TRUE ) ) ) :
		update_post_meta( $id, 'related_meta_data', $add );
	elseif ( FALSE === array_search( $add, explode( ',', $cur ), TRUE ) ) :
		update_post_meta( $id, 'related_meta_data', "$cur,$add" );
	endif;

}


/**
 * Destroys mutual relation between related posts
 *
 * @param int    $id ID of related post
 * @param string $rm post ID
 */
function snt_remove_mutual_relation( $id, $rm ) {

	if ( 1 > $id || empty( $rm ) || ! is_string( $rm ) ) :
		return;
	endif;

	if ( empty ( $cur = get_post_meta( $id, 'related_meta_data', TRUE ) ) ) :
		return;
	elseif ( FALSE !== $key = array_search( $rm, $cur_arr = explode( ',', $cur ), TRUE ) ) :
		unset( $cur_arr [ $key ] );
		$cur = join( ',', $cur_arr );
	endif;

	if ( empty( $cur ) ) :
		delete_post_meta( $id, 'related_meta_data' );
		return;
	endif;

	update_post_meta( $id, 'related_meta_data', $cur );

}


function snt_modify_post_upon_save( $data ) {
	global $pagenow;

	if ( 'post.php' !== $pagenow || 'post' !== $data['post_type'] ) :
		return $data;
	endif;

	if ( 'open' !== $data['comment_status'] ) :
		$data['comment_status'] = 'open';
	endif;

	if ( ! preg_match_all( '/\<a([^\>]+)>/', $data['post_content'], $lnk_arr, PREG_OFFSET_CAPTURE ) ) :
		return $data;
	endif;

	if ( ! $lnk_arr || ! is_array( $lnk_arr ) || ! is_array( $lnk_arr[0] ) || ! is_array( $lnk_arr[1] ) ) :
		return $data;
	endif;

	$tar_pat = '/target\=\\?("|\')([^("|\')]*)\\?("|\')/';
	$rel_pat = '/rel\=\\?("|\')([^("|\')]*)\\?("|\')/';
	$tag_arr = $lnk_arr[0];
	$attr_arr = $lnk_arr[1];

	foreach ( $attr_arr as $key => $value ) :
		if ( isset( $mod_key, $mod_index ) ) :
			if ( ! empty( $tag_arr[ $key - 1 ]['fixed'] ) ) :
				$tag_arr[ $key ][1] += strlen( $tag_arr[ $key - 1 ]['fixed'] ) - strlen( $tag_arr [ $key - 1 ][0] );
			endif;
		endif;
		unset( $mod_key, $mod_index );
		if ( FALSE === strpos( $value[0], ' target=' ) ) :
			$attr_arr[ $key ][0] .= ' target=\"_blank\"';
			$mod_key = $key;
			$mod_index = $tag_arr[ $key ][1];
		else :
			preg_match( $tar_pat, $value[0], $tar_arr );
			if ( ! empty( $tar_arr[2] ) && '_blank' !== $tar_arr[2] ) :
				$attr_arr[ $key ][0] = preg_replace( $tar_pat, 'target=\"_blank\"', $attr_arr[ $key ][0] );
				$mod_key = $key;
				$mod_index = $tag_arr[ $key ][1];
			endif;
		endif;
		if ( FALSE === strpos( $value[0], ' rel=' ) ) :
			if ( FALSE === strpos( $value[0], 'islamnewsagency.com') ) :
				$attr_arr[ $key ][0] .= ' rel=\"external\"';
				$mod_key = $key;
				$mod_index = $tag_arr[ $key ][1];
			endif;
		else :
			if ( FALSE !== strpos( $value[0], 'islamnewsagency.com') ) :
				$attr_arr[ $key ][0] = preg_replace( $rel_pat, '', $attr_arr[ $key ][0] );
				$mod_key = $key;
				$mod_index = $tag_arr[ $key ][1];
			else :
				preg_match( $rel_pat, $value[0], $rel_arr );
				if ( ! empty( $rel_arr[2] ) && 'external' !== $rel_arr[2] ) :
					$attr_arr[ $key ][0] = preg_replace( $rel_pat, 'rel=\"external\"', $attr_arr[ $key ][0] );
					$mod_key = $key;
					$mod_index = $tag_arr[ $key ][1];
				endif;
			endif;
		endif;
		if ( isset( $mod_key, $mod_index ) ) :
			$tag_arr[ $key ]['fixed'] = "<a {$attr_arr[ $key ][0]}>";
			$data ['post_content'] = substr_replace(
				$data['post_content'], $tag_arr[ $key ]['fixed'], $mod_index, strlen( $tag_arr[ $key ][0] )
			);
		endif;
	endforeach;

 	return $data;

}
add_filter( 'wp_insert_post_data', 'snt_modify_post_upon_save', 99 );


//TODO:Alert user about adding default terms
//add_filter( 'wp_insert_post_data' , 'snt_confirm_add_default_terms' , '99', 2 );
//
//function snt_confirm_add_default_terms ( $new_data, $cur_data ) {
//
//	global $snt_nhct;
//
//	foreach ( $snt_nhct as $tax ) :
//
//	if ( empty( get_option( "snt_def_{$tax->name}s_user_" . get_current_user_id(), '' ) ) ) :
//		continue;
//	endif;
//
//	endforeach;
//
//	$p_i = $cur_data['ID'];
//
//}