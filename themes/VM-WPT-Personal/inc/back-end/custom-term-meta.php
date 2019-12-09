<?php
//TODO: add image column to table and quick edit.


function vm_add_category_form_custom_fields( $tax ) {

	if ( 'category' !== $tax ) :
		return;
	endif;

	$lnk = esc_url( get_upload_iframe_src( 'image' ) );
	static $printNonce = true;

	?>
    <div class="form-field term-img-wrap">
        <label><?php _ex( 'Image', 'Category image text', VM_TD ); ?></label>
        <div class="cat-img-box"></div>
        <p class="hide-if-no-js">
            <a href="<?php echo $lnk; ?>" class="add-cat-img">
				<?php _ex( 'Add', 'Add category image', VM_TD ); ?>
            </a>
        </p>
		<?php
		if ( $printNonce ) :
			$printNonce = false;
			wp_nonce_field( 'vm_custom_category_fields', 'vm_category_add_nonce' );
		endif;
		?>
        <input name="cat_img" type="hidden" value="" class="cat-img-input"/>
    </div>
	<?php

}

add_action( 'category_add_form_fields', 'vm_add_category_form_custom_fields' );


function vm_edit_category_form_custom_fields( $term ) {

	if ( 'category' !== $term->taxonomy ) :
		return;
	endif;

	static $printNonce = true;
	$lnk     = esc_url( get_upload_iframe_src( 'image' ) );
	$img     = (int) get_term_meta( (int) $term->term_id, 'category_image', true );
	$img_url = wp_get_attachment_image_src( $img, 'medium' );
	$has_img = $wo_img = $img_ele = '';
	$w_img   = ' hidden';

	if ( $img_url ) :
		$wo_img  = ' hidden';
		$has_img = ' has-img';
		$img_ele = "<img src='{$img_url[0]}' alt='' class='cat-img' />";
		$w_img   = '';
	endif;

	?>
    <tr class="form-field term-img-wrap hide-if-no-js">
        <th scope="row"><?php _e( 'Image', VM_TD ); ?></th>
        <td>
            <p class="description<?php echo $wo_img; ?>">
				<?php _e( 'No image set', VM_TD ); ?>
            </p>
            <div class="cat-img-container<?php echo $has_img; ?>">
                <div class="cat-img-box">
					<?php echo $img_ele; ?>
                </div>
                <div class="cat-img-lnk">
                    <a href="<?php echo $lnk; ?>" class="add-cat-img<?php echo $wo_img; ?>">
						<?php _ex( 'Add', 'Category image text', VM_TD ); ?>
                    </a>
                    <a href="<?php echo $lnk; ?>" class="change-cat-img<?php echo $w_img; ?>">
						<?php _ex( 'Change', 'Category image text', VM_TD ); ?>
                    </a>
                </div>
            </div>
			<?php
			if ( $printNonce ) :
				$printNonce = false;
				wp_nonce_field( 'vm_custom_category_fields', 'vm_category_edit_nonce' );
			endif;
			?>
            <input name="cat_img" type="hidden" value="<?php echo $img; ?>" class="cat-img-input"/>
            <a href="#" class="remove-cat-img<?php echo $w_img; ?>">
				<?php _e( 'Remove image', VM_TD ); ?>
            </a>
        </td>
    </tr>
	<?php

}

add_action( 'category_edit_form_fields', 'vm_edit_category_form_custom_fields' );


function vm_category_quick_edit_custom_fields( $col, $page, $tax ) {

	if ( ( 'edit-tags' !== $page ) || ( 'category' !== $tax ) ) :
		return;
	endif;

	if ( 'image' !== $col ) :
		return;
	endif;

	static $printNonce = true;
	$lnk = esc_url( get_upload_iframe_src( 'image' ) );

	?>
    <fieldset>
        <div class="inline-edit-col cat-qe-img">
            <label>
                <span class="title"><?php _ex( 'Image', 'Category image text', VM_TD ); ?></span>
                <p class="description"><?php _ex( 'None', 'Category image text', VM_TD ); ?></p>
                <div class="cat-img-container">
                    <div class="cat-img-box"></div>
                    <div class="cat-img-lnk">
                        <a href="<?php echo $lnk; ?>" class="add-cat-img">
							<?php _ex( 'Add', 'Category image text', VM_TD ); ?></a>
                        <a href="<?php echo $lnk; ?>" class="change-cat-img">
							<?php _ex( 'Change', 'Category image text', VM_TD ); ?>
                        </a>
                    </div>
                </div>
				<?php
				if ( $printNonce ) :
					$printNonce = false;
					wp_nonce_field( 'vm_custom_category_fields', 'vm_category_quick_edit_nonce' );
				endif;
				?>
                <input name="cat_img" type="hidden" class="cat-img-input"/>
                <a href="#" class="remove-cat-img">
					<?php _e( 'Remove image', VM_TD ); ?>
                </a>
            </label>
        </div>
    </fieldset>
	<?php


}

add_action( 'quick_edit_custom_box', 'vm_category_quick_edit_custom_fields', 10, 3 );


function vm_category_table_custom_columns() {

	return array(
		'cb'          => '<input type="checkbox" />',
		'name'        => _x( 'Name', 'Category table column name', VM_TD ),
		'description' => _x( 'Description', 'Category table column name', VM_TD ),
		'slug'        => _x( 'Slug', 'Category table column name', VM_TD ),
		'image'       => _x( 'Image', 'Category table column name', VM_TD ),
		'posts'       => _x( 'Count', 'Category table column name', VM_TD )
	);

}

add_filter( 'manage_edit-category_columns', 'vm_category_table_custom_columns' );


function vm_category_table_custom_columns_data( $content, $col, $term_id ) {

	if ( 'image' !== $col ) :
		return $content;
	endif;

	$img_val = (int) get_term_meta( $term_id, 'category_image', true );
	$img_arr = wp_get_attachment_image_src( $img_val );

	if ( empty( $img_arr ) ) :
		return $content;
	endif;

	return "<span class='hidden cat-img-id'>$img_val</span><img src='{$img_arr[0]}' alt='' class='cat-img' />";


}

add_filter( 'manage_category_custom_column', 'vm_category_table_custom_columns_data', 10, 3 );


function vm_add_category_save_custom_data( $term_id ) {

	if (
		! current_user_can( 'manage_categories' ) ||
		empty( $_POST['cat_img'] ) ||
		empty( wp_get_attachment_url( (int) $_POST['cat_img'] ) )
	) :
		return;
	endif;

	check_admin_referer( 'vm_custom_category_fields', 'vm_category_add_nonce' );

	add_term_meta( $term_id, 'category_image', $_POST['cat_img'], true );

}

add_action( 'created_category', 'vm_add_category_save_custom_data' );


function vm_edit_category_save_custom_data( $term_id ) {

	if ( ! current_user_can( 'manage_categories' ) || empty( $_POST['action'] ) ) :
        return;
	endif;

	switch ( $_POST['action'] ) :
        default :
            return;
            break;
        case 'inline-save-tax' :
	        check_admin_referer( 'vm_custom_category_fields', 'vm_category_quick_edit_nonce' );
	        break;
        case 'editedtag' :
	        check_admin_referer( 'vm_custom_category_fields', 'vm_category_edit_nonce' );
	        break;
    endswitch;

	if ( empty( $_POST['cat_img'] ) || empty( wp_get_attachment_url( (int) $_POST['cat_img'] ) ) ) :
		delete_term_meta( $term_id, 'category_image' );
		return;
	endif;

	update_term_meta( $term_id, 'category_image', $_POST['cat_img'] );

}

add_action( 'edited_category', 'vm_edit_category_save_custom_data' );


