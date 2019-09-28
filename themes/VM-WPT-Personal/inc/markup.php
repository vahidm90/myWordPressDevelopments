<?php

function vm_get_front_page_cat_card_markup() {
	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '"><div class="card">';
	if ( has_post_thumbnail() ) :
		$img    = get_the_post_thumbnail_url();
		$alt    = get_the_post_thumbnail_caption();
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
		settings_fields( 'vm_theme_options' );
		do_settings_sections( 'vm-front-page-tiers-options' );
		submit_button( _x( 'Save', 'Button text', VM_TEXT_DOMAIN ) );
		?>
	</form>
	<?php

}

function vm_theme_options_front_page_section_markup() {
	echo '<p>' . __( 'Front-page options', VM_TEXT_DOMAIN ) . '</p>';
}

function vm_front_page_tiers_options_section_markup($args) {
	preg_match('/\d+/', $args['id'], $i );
	printf( '<p>' . _x( 'Customize tier %d on front-page', 'Setting section text; %d: Tier number', VM_TEXT_DOMAIN ) . '</p>', (int)$i[0] ) ;
}

function vm_theme_options_front_page_tiers_count_markup($args) {

	?>
	<input type="number" value="<?php echo (int)get_option( 'vm_theme_options_front_page_tiers_count' ); ?>" min="1"
	       max="99" name="vm_theme_options_front_page_tiers_count" id="<?php echo $args['label_for']; ?>"
	       title="<?php echo $args['label_for']; ?>"
	/>
	<?php
}

function vm_front_page_tiers_options_template_file_markup($args) {

	$current = get_option($args['name']) ? get_option( $args['name'] ) : '';
	?>
	<input type="text" value="<?php echo $current; ?>" name="<?php echo $args['name']; ?>"
	       id="<?php echo $args['label_for']; ?>" title="<?php echo $args['label_for']; ?>" />
	<?php
}

