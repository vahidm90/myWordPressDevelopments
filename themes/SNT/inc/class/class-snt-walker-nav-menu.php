<?php


Class SNT_Walker_Nav_Menu extends Walker_Nav_Menu {


	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$parent = $args->walker->has_children ? ' parent-ul' : '';
		$output .= "<ul class='child-ul$parent ul-d-$depth'>";
	}


	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "</ul>";
	}


	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$icon = '';
		$url = ( empty( $item->url ) || '#' === $item->url ? '' : 'href="' . esc_url( $item->url ). '"' );
		$ttl = ( empty( $url ) ? 'title="" rel="nofollow"' : 'title="' . esc_attr( $item->title ) . '"' );
		$class = ( $depth ? 'child-li ' : '' );

		if ( $args->walker->has_children ) :
			$class = 'parent-li ';
			$icon   = " <span class='snt-icon snt-filled-caret-down'></span>";
		endif;

		$class .= "li-d-$depth";

		$output .= "<li class='$class'><a $url$ttl class='no-wrap'><div><span>$item->title</span>$icon</div></a>";

	}


	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}

}
