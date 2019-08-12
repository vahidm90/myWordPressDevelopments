<?php

global $day, $month, $monthnum, $year, $snt_comma;

$html = "<div class='container'><div class='row'>";
switch ( 1 ) :
	case is_day() :

		$t_s = strtotime( "$year-$monthnum-$day" );

        //TODO: Stylish week calendar
		$c1 = snt_adjacent_days( array( 'day' => $day, 'month' => $monthnum, 'year' => $year ) );
		$h1 = sprintf( _x( 'More %1$s Archives:', 'Date archive side item; 1: Month', 'snt-en' ), $m_name );


		if ( $c1 ) :

            $html .= "<div class='col-sn-12'><span>$h1</span></div>";

		    $html .= "<div class='col-sn-12'><div class='container'><div class='row'>";
			foreach ( $c1 as $key => $val ) :
				$html .= "<div class='col-sn-12'><a href='{$val['lnk']}'>";
				$html .= "<span>" . date_i18n( "l j", $key ) . " ({$val['count']})</span>";
				$html .= "</a></div>";
			endforeach;
			$html .= "</div></div></div>";

		endif;

		break;
	case is_month() :

	    $t_s = strtotime( "$year-$monthnum-1" );

	    $y_num = date_i18n( 'Y', $t_s );
	    $m_name = date_i18n( 'F', $t_s );
        //TODO: Stylish month calendar
		$c1 = snt_adjacent_months( array( 'month' => $monthnum, 'year' => $year ) );
		$c2 = snt_adjacent_days( array( 'day' => 1, 'month' => $monthnum, 'year' => $year ) );
		$h1 = sprintf( _x( 'More %1$s archives:', 'Date archive side item; 1: Year', 'snt-en' ), $y_num );
		$h2 = sprintf( _x( '%1$s archives:', 'Date archive side item; 1: Month', 'snt-en' ), $m_name );

		$html = "<div class='container'><div class='row'>";

		if ( $c1 ) :

            $html .= "<div class='col-sn-12'><span>$h1</span></div>";

			$html .= "<div class='col-sn-12'><div class='container'><div class='row'>";
			foreach ( $c1 as $key => $val ) :
				$html .= "<div class='col-sn-12'><a href='{$val['lnk']}'>";
				$html .= "<span>" . date_i18n( 'F Y', $key ) . " ({$val['count']})</span>";
				$html .= "</a></div>";
			endforeach;
			$html .= "</div></div></div>";

		endif;

		if ( $c2 ) :

            $html .= "<div class='col-sn-12'><span>$h2</span></div>";

			$html .= "<div class='col-sn-12'><div class='container'><div class='row'>";
			foreach ( $c2 as $key => $val ) :
				$html .= "<div class='col-sn-12'><a href='{$val['lnk']}'>";
				$html .= "<span>" . date_i18n( "l$snt_comma j M Y", $key ) . " ({$val['count']})</span>";
				$html .= "</a></div>";
			endforeach;
			$html .= "</div></div></div>";

		endif;

		break;
	default :

		$y_num = date_i18n( 'Y', strtotime( "$year-1-1" ) );
        //TODO: Stylish year calendar
		$c1 = snt_adjacent_years( array( 'year' => $year ) );
		$c2 = snt_adjacent_months( array( 'month' => 1, 'year' => $year ) );
		$h1 = _x( 'Other yearly archives:', 'Date archive side item', 'snt-en' );
		$h2 = sprintf( _x( '%1$s archives:', 'Date archive side item; 1: Year', 'snt-en' ), $y_num );

		$html = "<div class='container'><div class='row'>";

		if ( $c1 ) :

            $html .= "<div class='col-sn-12'><span>$h1</span></div>";

			$html .= "<div class='col-sn-12'><div class='container'><div class='row'>";
			foreach ( $c1 as $key => $val ) :
				$html .= "<div class='col-sn-12'><a href='{$val['lnk']}'>";
				$html .= "<span>" . date_i18n( 'Y', $key ) . " ({$val['count']})</span>";
				$html .= "</a></div>";
			endforeach;
			$html .= "</div></div></div>";

		endif;

		if ( $c2 ) :

            $html .= "<div class='col-sn-12'><span>$h2</span></div>";

			$html .= "<div class='col-sn-12'><div class='container'><div class='row'>";
			foreach ( $c2 as $key => $val ) :
				$html .= "<div class='col-sn-12'><a href='{$val['lnk']}'>";
				$html .= "<span>" . date_i18n( 'F Y', $key ) . " ({$val['count']})</span>";
				$html .= "</a></div>";
			endforeach;
			$html .= "</div></div></div>";

		endif;

		break;
endswitch;
$html .= "</div></div>";

?><div class="container">
	<div class="row">
		<div class="col-sn-12"><h2><?php _ex( 'See Also', 'Date archive side header', 'snt-en' ); ?></h2></div>
		<div class="col-sn-12"><?php echo $html; ?></div>
	</div>
</div>