<?php

function vm_add_category_custom_fields( $tax ) {

	if ( 'category' !== $tax ) :
		return;
	endif;

	$lnk = esc_url( get_upload_iframe_src( 'image' ) );
	
	?>
    <div class="cat-img"></div>
    <p class="hide-if-no-js">
        <a href="<?php echo $lnk; ?>" class="add-cat-img"><?php _e( 'Category image', VM_TEXT_DOMAIN ); ?></a>
    </p>
    <input name="cat_img" type="hidden" value="" class="cat-img-id"/>
	<?php

}

add_action( 'category_add_form_fields', 'vm_add_category_custom_fields' );

function vm_edit_category_custom_fields( $term ) {

	if ( 'category' !== $term->taxonomy ) :
		return;
	endif;

	echo 'hi';
}

add_action( 'category_edit_form_fields', 'vm_edit_category_custom_fields' );