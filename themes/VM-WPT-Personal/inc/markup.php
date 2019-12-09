<?php

//TODO: Make HTML tags, classes, etc. dynamic.


function vm_get_front_page_cat_card_markup() {

	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class( 'text-dark' ) ) . '"><div class="card">';

	return $html . '<div class="card-body"><p class="post-title card-title">' . get_the_title() . '</p></div></div></a>';

}


function vm_get_front_page_cat_collapsible_markup() {

	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '">';

	return $html . '<p class="post-title">' . get_the_title() . '</p></a>';

}


/**
 * Print theme options page.
 *
 */
function vm_theme_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		return;
	endif;

	?>
    <h1><?php _e( 'Theme options', VM_TD ); ?></h1>
    <form action="options.php" method="POST">
		<?php

		settings_fields( 'vm_theme_options' );
		do_settings_sections( 'vm-theme-options' );
		submit_button( _x( 'Save', 'Button text', VM_TD ) );

		?>
    </form>
	<?php

}


/**
 * Print front-page tiers options page.
 *
 */
function vm_front_page_tiers_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		return;
	endif;

	?>
    <h1><?php _e( 'Front-page tiers options', VM_TD ); ?></h1>
    <form action="options.php" method="POST">
		<?php

		settings_fields( 'vm_front_page_tiers_options' );
		do_settings_sections( 'vm-front-page-tiers-options' );
		submit_button( _x( 'Save', 'Button text', VM_TD ) );

		?>
    </form>
	<?php

}


/**
 * Print front-page options section on theme options page.
 *
 */
function vm_theme_options_front_page_section_markup() {
	_e( 'Customize the front-page', VM_TD );
}


/**
 * Print front-page tiers options section.
 *
 * @param $args {
 *     Additional markup parameters
 *
 * @type string $id (Required) Settings section ID attribute
 * }
 *
 */
function vm_front_page_tiers_options_section_markup( $args ) {

	preg_match( '/\d+/', $args['id'], $tier_id );

	if ( empty( $tier_id ) ) :
		return;
	endif;

	printf(
		_x( 'Customize tier %d', 'Setting section text; %d: Tier number', VM_TD ),
		(int) $tier_id[0]
	);
}


/**
 * Print number option field.
 *
 * @param array $args {
 *     Form field values
 *
 * @type string $label_for (Required) Used as attribute for input field label to refer to field ID
 * @type string $name (Required) Used as input field name
 *
 * }
 *
 */
function vm_number_option_field_markup( $args ) {

	?>
    <input
            type="number" value="<?php echo get_option( $args['name'] ); ?>" name="<?php echo $args['name']; ?>"
            id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"
            min="<?php echo $args['min']; ?>" max="<?php echo $args['max']; ?>"
    />
	<?php

}


/**
 * Print checkbox option field.
 *
 * @param array $args {
 *     Form field values
 *
 * @type string $label_for (Required) Used as attribute for input field label to refer to field ID
 * @type string $name (Required) Used as input field name
 *
 * }
 *
 */
function vm_checkbox_option_field_markup( $args ) {

	$current = get_option( $args['name'] );

	?>
    <input
            type="checkbox" name="<?php echo $args['name']; ?>" id="<?php echo $args['label_for']; ?>"
            title="<?php echo $args['label_for']; ?>" value="1" <?php checked( 1, $current ); ?>
    />
	<?php

}


/**
 * Print text option field.
 *
 * @param array $args {
 *     Form field values
 *
 * @type string $label_for (Required) Used as attribute for input field label to refer to field ID
 * @type string $name (Required) Used as input field name
 *
 * }
 *
 */
function vm_text_option_field_markup( $args ) {

	$current = empty( get_option( $args['name'] ) ) ? '' : get_option( $args['name'] );

	?>
    <input
            type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
            id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"
    />
	<?php

}


/**
 * Print text option field.
 *
 * @param array $args {
 *     Form field values
 *
 * @type string $label_for (Required) Used as attribute for input field label to refer to field ID
 * @type string $name (Required) Used as input field name
 *
 * }
 *
 */
function vm_front_page_tier_background_image_option_field_markup( $args ) {

	$current = empty( get_option( $args['name'] ) ) ? 0 : get_option( $args['name'] );
    $with_bg = ' hidden';
    $sans_bg = '';

	if ( $current ) :
		$img = wp_get_attachment_image_src( $current, 'medium' );
	$bg_0 = '';
	$bg_1 = ' hidden';
	endif;

	preg_match( '/\d+/', $args['label_for'], $tier_id );

	$lnk        = esc_url( get_upload_iframe_src( 'image' ) );
	$html       = empty( $img ) ? '' : "<img src='{$img[0]}' class='bg-img' />";
	$change = _x( 'Change', 'Background image option', VM_TD );
	$remove    = _x( 'Remove', 'Background image option', VM_TD );
	$add    = _x( 'Add', 'Background image option', VM_TD );

	echo <<< html
<div class="tier-bg-img-option" data-tier-number="{$tier_id[0]}">
    <div class="bg-img-div">$html</div>
    <a href="$lnk" class="change" data-tier-number="{$tier_id[0]}">$change</a>
    <a href="$lnk" class="remove" data-tier-number="{$tier_id[0]}">$remove</a>
    <a href="$lnk" class="add" data-tier-number="{$tier_id[0]}">$add</a>
    <input 
        type="hidden" value="$current" name="{$args['name']}" id="{$args['label_for']}" title="{$args['label_for']}" 
    />
</div>
html;


	?>
	<?php

}


/**
 * Print front-page tier title option text field.
 *
 * @param array $args {
 *     Form field values
 *
 * @type string $label_for (Required) Used as attribute for input field label to refer to field ID
 * @type string $name (Required) Used as input field name
 * @type boolean $enabled (Required) checks if option is enabled
 * }
 *
 */
function vm_front_page_tier_title_option_field_markup( $args ) {

	$current = empty( get_option( $args['name'] ) ) ? '' : get_option( $args['name'] );

	?>
    <input
            type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
            id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"
		<?php disabled( 1, ! $args['enabled'] ); ?>
    />
	<?php

}


/**
 * Retrieve front-page tiers markup.
 *
 * @return array|bool False if no tiers ( 0 >= $count ), otherwise the markup array
 *
 */
function vm_get_front_page_tier_markup() {

	$count = get_option( 'vm_theme_options_front_page_tiers_count' );

	if ( empty( $count ) ) :
		return false;
	endif;

	$tiers     = array();
	$path_rest = '/inc/front-end/template-parts/front-page-tiers/';
	$path      = get_template_directory() . $path_rest;
	$com_cls   = get_option( 'vm_theme_options_front_page_tiers_common_classes' );
	$com_arr   = empty( $com_cls ) ? array() : explode( ' ', esc_attr__( $com_cls ) );

	for ( $i = 1; $count >= $i; $i ++ ) ://TODO: fix markup for classes (excluded).

		$cls = get_option( "vm_theme_options_front_page_tier_{$i}_classes" );

		if ( empty( $com_arr ) && empty ( $cls ) ) :
			$cls = '';
        elseif ( empty( $com_arr ) ) :
			$cls = ' ' . esc_attr( $cls );
		else :
			$cls_arr = empty( $cls ) ? $com_arr : array_merge( $com_arr, explode( ' ', esc_attr( $cls ) ) );
			$ex_cls  = get_option( "vm_theme_options_front_page_tier_{$i}_stripped_classes" );
			if ( empty( $ex_cls ) ) :
				$cls = ' ' . implode( ' ', $cls_arr );
			else :
				$ex_arr = explode( ' ', esc_attr( $ex_cls ) );
				$cls    = ' ' . implode( ' ', array_diff( $cls_arr, $ex_arr ) );
			endif;
		endif;

		$temp_file = get_option( "vm_theme_options_front_page_tier_{$i}_template" );
		$temp_file = ( empty( $temp_file ) || ! file_exists( "$path$temp_file.php" ) ) ? 'default' : $temp_file;

		$tiers[ $i ]['open']     = "<div class='fp-tier$cls' id='fp-tier-$i' data-no='$i'>";
		$tiers[ $i ]['close']    = '</div>';
		$tiers[ $i ]['template'] = $path_rest . $temp_file;

	endfor;

	return $tiers;

}


/**
 * Retrieve front-page tiers navigation menu markup.
 *
 * @return array|bool False if no tiers ( 0 >= $count ), otherwise the markup array
 *
 */
function vm_get_front_page_tier_menu_markup() {

	$count = (int) get_option( 'vm_theme_options_front_page_tiers_count' );

	if ( empty( $count ) ) :
		return false;
	endif;

	$menu = array();
	for ( $i = 1; $count >= $i; $i ++ ) :
		if ( empty( get_option( "vm_theme_options_front_page_tier_{$i}_enable_title" ) ) ) :
			continue;
		endif;
		$title      = get_option( "vm_theme_options_front_page_tier_{$i}_title" );
		$title      = empty( $title ) ? '' : $title;
		$menu[ $i ] = "<a href='#fp-tier-$i' class='nav-item nav-link'>$title</a>";
	endfor;

	return $menu;

}
