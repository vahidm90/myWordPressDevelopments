<?php

function vm_add_category_custom_fields( $tax ) {
	if ( 'category' !== $tax ) :
		return;
	endif;
	echo 'hi';
}

add_action( 'category_add_form_fields', 'vm_add_category_custom_fields' );