<?php


function vm_set_document_title( $title ) {

	$site_name = get_bloginfo();

	if ( is_front_page() ) :
		return "$site_name | " . get_bloginfo( 'description' );
	else :
		return $title;
	endif;

}

add_filter( 'pre_get_document_title', 'vm_set_document_title' );


function vm_menu_anchor_attributes( $attrib, $item, $args ) {

	if ( 2 !== $args->menu ) :
		return $attrib;
	endif;

	if ( empty($attrib['class'] ) ) :
		$attrib['class'] = 'nav-link';
	else :
		$attrib['class'] .= ' nav-link';
	endif;

	return $attrib;

}

add_filter( 'nav_menu_link_attributes', 'vm_menu_anchor_attributes', 10, 3 );


function vm_menu_list_item_class( $class, $item, $args ) {

	if ( 2 !== $args->menu ) :
		return $class;
	endif;

	$class []= 'nav-item';

	return $class;

}

add_filter( 'nav_menu_css_class', 'vm_menu_list_item_class', 10 , 3 );


function vm_menu_items( $items, $args ) {

	if ( 2 !== $args->menu ) :
		return $items;
	endif;

	$append = wp_login_url( get_home_url( $_SERVER['REQUEST_URI'] ) );
	$append = "<a href='$append' class='nav-link'>" . __( 'Sign in', VM_TD ) . '</a>';
	$append = "<li class='menu-item nav-item ml-lg-auto d-none' id='menu-item-sign-in'>$append</li>";

	return $items . $append;

}

add_filter( 'wp_nav_menu_items', 'vm_menu_items', 10, 2 );