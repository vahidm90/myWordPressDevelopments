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

	$lnk = esc_url( get_upload_iframe_src( 'image' ) );

	$cur_img = esc_url( get_term_meta( (int) $term->term_id, 'cat_img', true ) );

	$has_img = empty( $cur_img ) ? false : true;

	$class = $img = '';
	$hid = ' hidden';

	if ( ! empty( $cur_img ) && is_string( $cur_img ) ) :
        $class = ' hidden';
	    $img = "<img src='$cur_img' alt='' />";
    endif;
	?>
	<div class="cat-img"><?php echo $img; ?></div>
    <p class="hide-if-no-js">
        <a href="<?php echo $lnk; ?>" class="add-cat-img<?php echo $class; ?>">
            <?php _e( 'Category image', VM_TEXT_DOMAIN ); ?>
        </a>
        <a href="#" class="remove-cat-img<?php echo $hid; ?>">
            <?php _e( 'Remove image', VM_TEXT_DOMAIN ); ?>
        </a>
    </p>
    <input name="cat_img" type="hidden" value="<?php echo esc_attr( $cur_img ); ?>" class="cat-img-id"/>

<?php

	echo 'hi';
}

add_action( 'category_edit_form_fields', 'vm_edit_category_custom_fields' );