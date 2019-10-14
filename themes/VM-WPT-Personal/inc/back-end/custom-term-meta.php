<?php
//TODO: add image column to table and quick edit.


function vm_add_category_custom_fields( $tax ) {

	if ( 'category' !== $tax ) :
		return;
	endif;

	$lnk = esc_url( get_upload_iframe_src( 'image' ) );

	?>
    <div class="form-field term-img-wrap">
        <label><?php _ex( 'Image', 'Category image text', VM_TEXT_DOMAIN ); ?></label>
        <div class="cat-img"></div>
        <p class="hide-if-no-js">
            <a href="<?php echo $lnk; ?>" class="add-cat-img">
				<?php _ex( 'Add', 'Add category image', VM_TEXT_DOMAIN ); ?>
            </a>
        </p>
        <input name="cat_img" type="hidden" value="" id="tag-img"/>
    </div>
	<?php

}

add_action( 'category_add_form_fields', 'vm_add_category_custom_fields' );


function vm_edit_category_custom_fields( $term ) {

	if ( 'category' !== $term->taxonomy ) :
		return;
	endif;

	$lnk     = esc_url( get_upload_iframe_src( 'image' ) );
	$img     = (int) get_term_meta( (int) $term->term_id, 'category_image', true );
	$img_url = wp_get_attachment_image_src( $img, 'medium' );

	?>
    <tr class="form-field term-img-wrap">
        <th scope="row"><?php _ex( 'Image', 'Category image text', VM_TEXT_DOMAIN ); ?></th>
        <td class="cat-img-lnk">
            <p class="description<?php echo $img_url ? ' hidden' : ''; ?>">
				<?php _ex( 'No image set', 'Category image text', VM_TEXT_DOMAIN ); ?>
            </p>
            <div class="cat-img">
				<?php echo $img_url ? "<img src={$img_url[0]} alt='' />" : '' ?>
            </div>
            <input name="cat_img" type="hidden" value="<?php echo $img; ?>" id="tag-img"/>
            <p class="hide-if-no-js">
                <a href="<?php echo $lnk; ?>" class="add-cat-img<?php echo $img_url ? ' hidden' : ''; ?>">
					<?php _ex( 'Add', 'Add category image', VM_TEXT_DOMAIN ); ?>
                </a>
                <a href="#" class="remove-cat-img<?php echo $img_url ? '' : ' hidden'; ?>">
					<?php _e( 'Remove image', VM_TEXT_DOMAIN ); ?>
                </a>
            </p>
        </td>
    </tr>
	<?php

}

add_action( 'category_edit_form_fields', 'vm_edit_category_custom_fields' );


function vm_add_category_custom_data( $term_id ) {

	if ( empty( $_POST['cat_img'] ) ) :
		return;
	endif;

	if ( empty( wp_get_attachment_url( (int) $_POST['cat_img'] ) ) ) :
		return;
	endif;

	add_term_meta( $term_id, 'category_image', $_POST['cat_img'], true );

}

add_action( 'created_category', 'vm_add_category_custom_data' );


function vm_edit_category_custom_data( $term_id ) {

	if ( empty( $_POST['cat_img'] ) || empty( wp_get_attachment_url( (int) $_POST['cat_img'] ) ) ) :
		delete_term_meta( $term_id, 'category_image' );

		return;
	endif;

	update_term_meta( $term_id, 'category_image', $_POST['cat_img'], true );

}

add_action( 'edited_category', 'vm_edit_category_custom_data' );


function vm_add_category_table_custom_column() {

	return array(
		'cb'          => '<input type="checkbox" />',
		'name'        => _x( 'Name', 'Category table column name', VM_TEXT_DOMAIN ),
		'description' => _x( 'Description', 'Category table column name', VM_TEXT_DOMAIN ),
		'slug'        => _x( 'Slug', 'Category table column name', VM_TEXT_DOMAIN ),
		'image'       => _x( 'Image', 'Category table column name', VM_TEXT_DOMAIN ),
		'posts'       => _x( 'Count', 'Category table column name', VM_TEXT_DOMAIN )
	);

}

add_filter( 'manage_edit-category_columns', 'vm_add_category_table_custom_column' );


function vm_category_table_custom_column_data ( $content, $col, $term_id ) {

    if ( 'image' !== $col ) :
        return $content;
    endif;

    $img_arr = wp_get_attachment_image_src ( (int) get_term_meta( $term_id, 'category_image', true ) );

    if ( empty( $img_arr ) ) :
        return $content;
    endif;

	return "<img src='{$img_arr[0]}' alt='' class='table-cat-img' />";



}

add_filter( 'manage_category_custom_column', 'vm_category_table_custom_column_data', 10, 3 );


function vm_add_category_image_quick_edit_fields ( $col, $page, $tax ) {

    if ( ( 'edit-tags' !== $page ) || ( 'category' !== $tax ) ) :
        return;
    endif;

    if ( 'image' !== $col ) :
        return;
    endif;

	static $printNonce = TRUE;
	if ( $printNonce ) {
		$printNonce = FALSE;
		wp_nonce_field( plugin_basename( __FILE__ ), 'book_edit_nonce' );
	}


	?>
    <label>
        <span class="title">Image</span>
    </label>
	<?php
    

}

add_action( 'quick_edit_custom_box', 'vm_add_category_image_quick_edit_fields', 10, 3 );