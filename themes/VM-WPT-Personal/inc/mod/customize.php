<?php


/**
 * Modify WordPress query object.
 *
 * @param WP_Query $query Query object
 *
 */
function vm_modify_query_object( WP_Query $query ) {
	if ( ! $query->is_front_page() || ! $query->is_main_query() ) :
		return;
	endif;

	$query->set( 'posts_per_page', 10 );
	$query->set( 'ignore_sticky_posts', true );

}

add_action( 'pre_get_posts', 'vm_modify_query_object' );