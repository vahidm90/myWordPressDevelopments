<?php

//TODO: Make HTML tags, classes, etc. dynamic.


function vm_get_front_page_cat_card_markup() {
	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '"><div class="card">';
	if ( has_post_thumbnail() ) :
		$img  = get_the_post_thumbnail_url();
		$alt  = get_the_post_thumbnail_caption();
		$html .= "<img src='$img' alt='$alt' class='card-img-top' />";
	endif;

	return $html . '<div class="card-body"><p class="post-ttl card-title">' . get_the_title() . '</p></div></div></a>';

}


function vm_get_front_page_cat_collapsible_markup() {
	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '">';

	return $html . '<p class="post-ttl">' . get_the_title() . '</p></a>';

}


/**
 * Print theme options page
 *
 */
function vm_theme_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		return;
	endif;

	echo '<form action="options.php" method="POST">';
	settings_fields( 'vm_theme_options' );
	do_settings_sections( 'vm-theme-options' );
	submit_button( _x( 'Save', 'Button text', VM_TEXT_DOMAIN ) );
	echo '</form>';

}


/**
 * Print front-page tiers options page
 *
 */
function vm_front_page_tiers_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		return;
	endif;

	echo '<form action="options.php" method="POST">';
	settings_fields( 'vm_front_page_tiers_options' );
	do_settings_sections( 'vm-front-page-tiers-options' );
	submit_button( _x( 'Save', 'Button text', VM_TEXT_DOMAIN ) );
	echo '</form>';

}


/**
 * Print front-page options section on theme options page
 *
 */
function vm_theme_options_front_page_section_markup() {
	echo __( 'Customize the front-page', VM_TEXT_DOMAIN );
}


/**
 * Print front-page tiers options section
 *
 * @param $args {
 *      Additional markup parameters.
 *      @type string   $id       Settings section ID attribute
 *      @type string   $title    Settings section title
 *      @type callable $callback Function to print fields
 * }
 *
 */
function vm_front_page_tiers_options_section_markup( $args ) {
	preg_match( '/\d+/', $args['id'], $i );
	printf(
		_x( 'Customize tier %d', 'Setting section text; %d: Tier number', VM_TEXT_DOMAIN ),
		(int) $i[0]
	);
}

/**
 * Print front-page tiers count field.
 *
 * @param $args {
 *      Form field values
 *      @type string $label_for Used as attribute for input field label to refer to field ID
 *      @type string $name      Used as input field name
 * }
 *
 */
function vm_theme_options_front_page_tiers_count_markup( $args ) {

	?>
    <input type="number" value="<?php echo get_option( $args['name'] ); ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>" min="1" max="99" />
	<?php

}


/**
 * Print front-page tier enable on tier navigation menu option field.
 *
 * @param array $args {
 *      Form field values
 *      @type string $label_for Used as attribute for input field label to refer to field ID
 *      @type string $name      Used as input field name
 * }
 *
 */
function vm_options_checkbox_markup( $args ) {

    $current = get_option( $args['name'] );

	?>
    <input type="checkbox" name="<?php echo $args['name']; ?>" id="<?php echo $args['label_for']; ?>"
           title="<?php echo $args['label_for']; ?>" value="1" <?php checked( 1, $current ); ?> />
	<?php

}


/**
 * Print front-page tiers options text field.
 *
 * @param array $args {
 *      Form field values
 *      @type string $label_for Used as attribute for input field label to refer to field ID
 *      @type string $name      Used as input field name
 * }
 *
 */
function vm_options_text_field_markup( $args ) {

	$current = empty( get_option( $args['name'] ) ) ? '' : get_option( $args['name'] );

	?>
    <input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"/>
	<?php

}


/**
 * Print front-page tier title option text field.
 *
 * @param array $args {
 *      Form field values
 *      @type string  $label_for Used as attribute for input field label to refer to field ID
 *      @type string  $name      Used as input field name
 *      @type boolean $enabled   checks if option is enabled
 * }
 *
 */
function vm_options_tier_title_markup( $args ) {

	$current = empty( get_option( $args['name'] ) ) ? '' : get_option( $args['name'] );

	?>
    <input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"
           <?php disabled( 1, ! $args['enabled']);  ?> />
	<?php

}


/**
 * Retrieve front-page tiers markup.
 *
 * @return array|bool {
 *      False if no tiers ( 0 >= $count ), otherwise the markup array
 *      @type string $open Opening HTML tag
 *      @type string $close Closing HTML tag
 *      @type string $template Path parameter for WordPress 'get_template_part' function
 * }
 *
 */
function vm_get_front_page_tier_markup() {

	$count = get_option( 'vm_theme_options_front_page_tiers_count' );

	if ( empty( $count ) ) :
		return false;
	endif;

	$tiers = array();
	$path_rest = '/inc/front-end/template-parts/front-page-tiers/';
	$path  = get_template_directory() . $path_rest;
	for ( $i = 1; $count >= $i; $i ++ ) ://TODO: fix markup for classes (excluded).
		$classes              = get_option( "vm_theme_options_front_page_tier_{$i}_classes" );
		$classes              = empty( $classes ) ? '' : ( ' ' . esc_attr( $classes ) );
		$tiers[ $i ]['open']  = "<div class='fp-tier$classes' id='fp-tier-$i' data-fp-tier-no='$i'>";
		$tiers[ $i ]['close'] = '</div>';
		$template_file        = get_option( "vm_theme_options_front_page_tier_{$i}_template" );
		$template_file = empty( $template_file ) ? 'default' : $template_file;
		$tiers[ $i ]['template'] = ( empty( $template_file ) || ! file_exists( "$path$template_file.php" ) ) ?
            "{$path_rest}default" : "$path_rest$template_file";
	endfor;

	return $tiers;

}


/**
 * Retrieve front-page tiers navigation menu markup.
 *
 * @return array|bool {
 *      False if no tiers ( 0 >= $count ), otherwise the markup array
 *      @type string HTML markup for menu entry
 * }
 *
 */
function vm_get_front_page_tier_menu_markup() {

	$count = get_option( 'vm_theme_options_front_page_tiers_count' );

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
