<?php


function vm_set_document_title( $title ) {

	$site_name = get_bloginfo();

	if( is_front_page() ) :
		return "$site_name | " . get_bloginfo( 'description' );
	else :
		return $title;
	endif;

}
add_filter( 'pre_get_document_title', 'vm_set_document_title', 10, 3);