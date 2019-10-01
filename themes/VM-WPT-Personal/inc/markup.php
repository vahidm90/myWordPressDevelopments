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

function vm_theme_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		?>
        <h1><?php _ex( 'Forbidden!', 'User privilege error', VM_TEXT_DOMAIN ); ?></h1>
        <p><?php _ex( 'You are not allowed to visit this page!', 'User privilege error', VM_TEXT_DOMAIN ); ?></p>
		<?php
		return;
	endif;

	?>
    <form action="options.php" method="POST">
		<?php
		settings_fields( 'vm_theme_options' );
		do_settings_sections( 'vm-theme-options' );
		submit_button( _x( 'Save', 'Button text', VM_TEXT_DOMAIN ) );
		?>
    </form>
	<?php

}

function vm_front_page_tiers_options_markup() {

	if ( ! current_user_can( 'edit_theme_options' ) ) :
		?>
        <h1><?php _ex( 'Forbidden!', 'User privilege error', VM_TEXT_DOMAIN ); ?></h1>
        <p><?php _ex( 'You are not allowed to visit this page!', 'User privilege error', VM_TEXT_DOMAIN ); ?></p>
		<?php
		return;
	endif;

	?>
    <form action="options.php" method="POST">
		<?php
		settings_fields( 'vm_front_page_tiers_options' );
		do_settings_sections( 'vm-front-page-tiers-options' );
		submit_button( _x( 'Save', 'Button text', VM_TEXT_DOMAIN ) );
		?>
    </form>
	<?php

}

function vm_theme_options_front_page_section_markup() {
	echo '<p>' . __( 'Front-page options', VM_TEXT_DOMAIN ) . '</p>';
}

function vm_front_page_tiers_options_section_markup( $args ) {
	preg_match( '/\d+/', $args['id'], $i );
	$txt = _x( 'Customize tier %d on front-page', 'Setting section text; %d: Tier number', VM_TEXT_DOMAIN );
	printf( "<p>$txt</p>", (int) $i[0] );
}

function vm_theme_options_front_page_tiers_count_markup( $args ) {

	?>
    <input type="number" value="<?php echo (int) get_option( 'vm_theme_options_front_page_tiers_count' ); ?>" min="1"
           max="99" name="vm_theme_options_front_page_tiers_count" id="<?php echo $args['label_for']; ?>"
           title="<?php echo $args['label_for']; ?>"
    />
	<?php
}

function vm_front_page_tiers_options_template_file_markup( $args ) {

	$current = get_option( $args['name'] ) ? get_option( $args['name'] ) : '';
	?>
    <input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"/>
	<?php
}

function vm_front_page_tiers_options_classes_markup( $args ) {

	$current = get_option( $args['name'] ) ? get_option( $args['name'] ) : '';
	?>
    <input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"/>
	<?php
}

function vm_front_page_tiers_options_title_markup( $args ) {

	$current = get_option( $args['name'] ) ? get_option( $args['name'] ) : '';
	?>
    <input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
           id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>"/>
	<?php
}

/**
 * Retrieve front-page tiers markup based on dashboard configurations.
 *
 * @return array|bool {
 *      False if no tiers ( 0 >= $count ), otherwise the markup array.
 *      @type string     $open       Opening HTML tag.
 *      @type string     $close      Closing HTML tag.
 *      @type string     $template   Path parameter for WordPress 'get_template_part' function.
 * }
 *
 */
function vm_get_front_page_tier_markup() {

    $count = get_option( 'vm_theme_options_front_page_tiers_count' );

	if ( empty($count) ) :
		return false;
	endif;

	$tiers = array();
	$path  = get_template_directory() . '/inc/front-end/template-parts/front-page-tiers/';
	for ( $i = 1; $count >= $i; $i ++ ) :
		$classes              = get_option( "vm_theme_options_front_page_tier_{$i}_classes" );
		$classes              = empty( $classes ) ? '' : ( ' ' . esc_attr( $classes ) );
		$tiers[ $i ]['open']  = "<div class='fp-tier$classes' id='fp-tier-$i' data-fp-tier-no='$i'>";
		$tiers[ $i ]['close'] = '</div>';
		$template_file        = get_option( "vm_theme_options_front_page_tier_{$i}_template_file" );
		if ( empty( $template_file ) ) :
			continue;
		endif;
		$tiers[ $i ]['template'] = file_exists( "$path$template_file.php" ) ?
			"/inc/front-end/template-parts/front-page-tiers/$template_file" : '';
	endfor;

	return $tiers;

}


/**
 * Retrieve front-page tiers menu markup based on dashboard configurations.
 *
 * @return array|bool {
 *      False if no tiers ( 0 >= $count ), otherwise the markup array.
 *      @type string    HTML markup for menu entry
 * }
 *
 */
function vm_get_front_page_tier_menu_markup() {

    $count = get_option( 'vm_theme_options_front_page_tiers_count' );

	if ( empty($count) ) :
		return false;
	endif;

	$menu = array();
	for ( $i = 1; $count >= $i; $i ++ ) :
		$title              = get_option( "vm_theme_options_front_page_tier_{$i}_title" );
		$title              = empty( $title ) ? '' : $title;
		$menu[ $i ]  = "<a href='#fp-tier-$i' class='nav-item nav-link'>$title</a>";
	endfor;

	return $menu;

}
