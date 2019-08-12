<?php

/**
 * Modifies inner HTML of walker menu <a>.
 *
 * @param $title string Inner HTML of <a>
 * @param $item  object Menu item
 * @param $args  object Item's arguments
 * @param $depth int    Item's level
 *
 * @return       string Modified markup
 */
function vmbwpt_menu_a_title( $title, $item, $args, $depth ) {
	global $vmbwpt_lang;

	if ( VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] !== $args->menu ) :
		return $title;
	endif;

	if ( $args->walker->has_children ) :
		$title .= '<button class="expand dashicons dashicons-plus bg-transparent text-light border-0 float-right h-100 rounded-0 p-0 m-0"></button>';
	endif;

	return $title;
}

add_filter( 'nav_menu_item_title', 'vmbwpt_menu_a_title', 10, 4 );

/**
 * Modifies walker menu <li> markup.
 *
 * @param $html  string Markup
 * @param $item  object Menu item
 * @param $args  object Item's arguments
 * @param $depth int    Item's level
 *
 * @return       string Modified markup
 */
function vmbwpt_menu_li_tag( $html, $item, $depth, $args ) {
	global $vmbwpt_lang;

	if ( VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] !== $args->menu ) :
		return $html;
	endif;

	return $html;
}

//add_filter( 'walker_nav_menu_start_el', 'vmbwpt_menu_li_tag', 10, 4 );

/**
 * Modifies walker menu <a> attributes.
 *
 * @param $attribs array  Attributes and their values
 * @param $item    object Menu item
 * @param $args    object Item's arguments
 * @param $depth   int    Item's level
 *
 * @return         array  Modified attributes
 */
function vmbwpt_menu_a_attrib( $attribs, $item, $args, $depth ) {
	global $vmbwpt_lang;

	if ( VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] !== $args->menu ) :
		return $attribs;
	endif;

	if ( empty( $attribs['class'] ) ) :
		$attribs['class'] = 'text-light';
	else :
		$attribs['class'] .= ' text-light';
	endif;

	return $attribs;
}

add_filter( 'nav_menu_link_attributes', 'vmbwpt_menu_a_attrib', 10, 4 );

/**
 * Modifies walker menu <li> classes.
 *
 * @param $classes array  Classes
 * @param $item    object Menu item
 * @param $args    object Item's arguments
 * @param $depth   int    Item's level
 *
 * @return         array  Modified classes
 */
function vmbwpt_menu_li_class( $classes, $item, $args, $depth ) {
	global $vmbwpt_lang;

	if ( VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] !== $args->menu ) :
		return $classes;
	endif;

	array_push( $classes, 'list-group-item', 'position-relative' );

	return $classes;
}

add_filter( 'nav_menu_css_class', 'vmbwpt_menu_li_class', 10, 4 );

/**
 * Modifies walker menu <ul> classes.
 *
 * @param $classes array  Classes
 * @param $args    object Item's arguments
 * @param $depth   int    Items's level in the menu
 *
 * @return         array  Modified classes
 */
function vmbwpt_menu_ul_class( $classes, $args, $depth ) {
	global $vmbwpt_lang;

	if ( VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] !== $args->menu ) :
		return $classes;
	endif;

	array_push( $classes, 'list-group', 'list-group-flush', "d-$depth" );

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'vmbwpt_menu_ul_class', 10, 3 );

function vmbwpt_mod_menu_items( $items, $args ) {
	global $vmbwpt_lang, $vmbwpt_is_dev;

	if ( ! in_array( $args->menu, VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus'], true ) ) :
		return $items;
	endif;
	$other_lang = array();
	foreach ( VMBWPT_LANGUAGES as $key => $values ) :
		if ( $vmbwpt_lang === $key ) :
			continue;
		endif;
		$other_lang [ $key ]            = $values;
		$other_lang [ $key ]['address'] = 'http://' . ( empty( $values['prefix'] ) ? '' : "{$values['prefix']}." ) . ( $vmbwpt_is_dev ? VM_DEV_ADDRESS : VM_LIVE_ADDRESS );
	endforeach;

	if ( empty( $other_lang ) ) :
		return $items;
	endif;

	$html = '';

	switch ( $args->menu ) :
		case VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'] :

			$lang_items = '';
			$languages  = sprintf(
				'<span dir="%1$s">%2$s</span>%3$s',
				VMBWPT_LANGUAGES[ $vmbwpt_lang ]['direction'],
				__( 'Language', VMBWPT_TEXT_DOMAIN ),
				'English' === $vmbwpt_lang ? '' : ' <span dir="ltr">Language</span>'
			);
			$html       = <<<html
<li class="menu-item-has-children list-group-item position-relative">
	<a href="#" class="text-light">
		$languages
		<button class="expand dashicons dashicons-plus bg-transparent text-light border-0 float-right h-100 rounded-0 p-0 m-0"></button>
	</a>
	<ul class="sub-menu list-group list-group-flush d-0">%s</ul>
</li>
html;

			foreach ( $other_lang as $lang => $values ) :
				$trans      = $lang === $values['translated'] ? '' : "<span>{$values['translated']}</span> ";
				$lang_items .= <<<html
<li class="list-group-item position-relative">
	<a href="{$values['address']}" class="text-light">
		$trans<span dir="{$values['direction']}">{$values['native']}</span>
	</a>
</li>
html;
			endforeach;

			$html = sprintf( $html, $lang_items );

			break;

		case VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['footer'] :

			foreach ( $other_lang as $lang => $values ) :
				$trans = $lang === $values['translated'] ? '' : "<span>{$values['translated']}</span> ";
				$html  .= <<<html
<li class="menu-item">
	<a href="{$values['address']}" class="text-light">
		$trans<span dir="{$values['direction']}">{$values['native']}</span>
	</a>
</li>
html;

			endforeach;

			break;

	endswitch;

	return $items . $html;
}

add_filter( 'wp_nav_menu_items', 'vmbwpt_mod_menu_items', 10, 2 );

//TODO: Create titles for all page templates.

/**
 * Sets document titles.
 *
 * @param $title
 *
 * @return string
 */
function vmbwpt_set_doc_title( $title ) {

	if ( is_front_page() ) :

		return get_bloginfo() . ' - ' . get_bloginfo( 'description' );

	elseif ( is_singular( 'page' ) ) :
		global $id;

		$parents = get_post_ancestors( $id );
		if ( empty( $parents ) ) :
			return esc_html( get_the_title() ) . ' | ' . get_bloginfo();
		else:
			$title = esc_html( get_the_title() );
			foreach ( $parents as $parent ) :
				$title .= ' < ' . esc_html( get_the_title( $parent ) );
			endforeach;

			return $title . ' | ' . get_bloginfo();
		endif;

	else :

		return $title;

	endif;

}

add_filter( 'pre_get_document_title', 'vmbwpt_set_doc_title' );
