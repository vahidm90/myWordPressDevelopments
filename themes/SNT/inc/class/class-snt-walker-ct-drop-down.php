<?php

Class SNT_Walker_CT_Drop_Down extends Walker_CategoryDropdown {


	public function start_el( &$output, $tax, $depth = 0, $args = array(), $id = 0 ) {

		if ( '0' !== $tax->name[0] ) :
			parent::start_el( $output, $tax, $depth, $args, $id );
			return;
		endif;

		$num_clean = mb_substr( $tax->name, strpos( $tax->name, ' ' ) + 1 );
		$output .= "<optgroup label='$num_clean'>";

	}


	public function end_el( &$output, $tax, $depth = 0, $args = array() ) {

		if ( '0' !== $tax->name[0] ) :
			parent::end_el( $output, $tax, $depth = 0, $args = array() );
			return;
		endif;

		$output .= "</optgroup>";

	}

}
