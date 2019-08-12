<?php

global $day, $month, $monthnum, $year, $snt_comma, $snt_mor, $snt_btn_so;

$m_ttl = $list_l = $list_md_s = '';
$paginate = snt_archive_pagination();
switch ( 1 ) :
	case is_day() :
		$m_ttl = _x( 'Daily Archive:', 'Date archive title', 'snt-en' );
		$m_ttl .= date_i18n( " l$snt_comma j F$snt_comma Y", strtotime( "$year-$monthnum-$day" ) );
		$page_lnk = get_day_link( $year, $monthnum, $day );
		break;
	case is_month() :
		$m_ttl = _x( 'Monthly Archive:', 'Date archive title', 'snt-en' );
		$m_ttl .= date_i18n( ' F Y', strtotime( "$year-$monthnum-1" ) );
		$page_lnk = get_month_link( $year, $monthnum );
		break;
	default :
		$m_ttl = _x( 'Yearly Archive:', 'Date archive title', 'snt-en' ) . date_i18n( ' Y', strtotime( "$year-1-1" ) );
		$page_lnk = get_year_link( $year );
		break;
endswitch;

if ( have_posts() ) :
	$list_md_s = '<div class="list"><div class="container"><div class="row">';
	$list_l = '<div class="list"><div class="container"><div class="row">';

	while ( have_posts() ) :

		the_post();

		$tim = snt_get_time();
		$ttl = get_the_title();
		$lnk = get_the_permalink();
		$m_t = get_the_time( 'c' );
		$img = get_the_post_thumbnail_url( $id, 'full' );
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
		$exc_md_s = $exc = get_the_excerpt();
		$len = mb_strwidth( $exc );
		if ( 200 < $len ) :
			$exc_md_s = mb_substr( $exc, 0, strpos( wordwrap( $exc, 200, '<CUT>' ), '<CUT>' ) ) . '...';
			if ( 300 < $len ):
				$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 300, '<CUT>' ), '<CUT>' ) ) . '...';
			endif;
		endif;

		$list_md_s .= "<div class='col-sn-12'>";
		$list_md_s .= "<div class='slide-open entry card'><div class='container'><div class='row'>";
		$list_l .= "<div class='col-sn-12'><a href='$lnk' $atr_ttl>";
		$list_l .= "<div class='entry card'><div class='container'><div class='row'>";

		$list_md_s .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-post'>$ttl</p></a></div>";
		$list_l .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";
		$list_md_s .= "<div class='col-sn-12'><time datetime='$m_t'>$tim</time></div>";
		$list_l .= "<div class='col-sn-12'><time datetime='$m_t'>$tim</time></div>";
		$list_md_s .= "<div class='col-sn-12'>$snt_btn_so</div>";

		$list_md_s .= '<div class="col-sn-12"><div class="rest-so"><div class="container"><div class="row">';
		$list_l .= "<div class='col-sn-12'><div class='img-txt'><div class='container'><div class='row'>";

		$class = '';

		if ( $img ) :
			$class = ' col-s1-8';
			$list_md_s .= "<div class='col-sn-12 col-s1-4'><img src='$img' class='img-resp' /></div>";
            $list_l .= "<div class='col-sn-12 col-s1-4'><img src='$img' class='img-resp' /></div>";
		endif;
        
        $list_md_s .= "<div class='col-sn-12$class'><div class='txt'><div class='container'><div class='row'>";

        $list_md_s .= "<div class='col-sn-12'><p class='exc-post'>$exc_md_s</p></div>";
		$list_l .= "<div class='col-sn-12$class'><p class='exc-post'>$exc</p></div>";

        $list_md_s .= "<div class='col-sn-12'>";
		$list_md_s .= "<a class='no-prop' href='$lnk' $atr_ttl><div class='mor-post'>$snt_mor</div></a>";
		$list_md_s .= "</div>";

		$list_md_s .= '</div></div></div></div>'; // txt

		$list_md_s .= '<div class="clear-fix d-a-b-gt-s2"></div>';
		$list_l .= '<div class="clear-fix d-a-b-gt-s2"></div>';

		$list_md_s .= '</div></div></div></div>'; // rest-so
		$list_l .= '</div></div></div></div>'; // img-txt

		$list_md_s .= '</div></div></div>'; // slide-open entry
		$list_md_s .= '</div>';
		$list_l .= '</div></div></div>'; // entry
		$list_l .= '</a></div>';

	endwhile;

	$list_md_s .= '</div></div></div>'; // list
	$list_l .= '</div></div></div>'; // list
endif;

get_header( 'date' );

?><main>
    <div class="centered">
        <div class="container">
            <div class="row">
                <div class="col-sn-12 col-l3-9">
                    <header class="centered">
                        <div class="container">
                            <div class="row">
                                <div class="col-sn-12">
                                    <a href="<?php echo $page_lnk; ?>"><h1 id="head-main"><?php echo $m_ttl; ?></h1></a>
                                </div>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="col-sn-12 col-l3-3"></div>
                <div class="col-sn-12 col-l3-9">
                    <div class="container">
                        <div class="row"><?php

							if ( ! empty( $paginate ) ) :
								?><div class="col-sn-12"><footer><?php echo $paginate; ?></footer></div><?php
							endif;

							?><div class="col-sn-12">
                                <div id="list">
                                    <div class="d-a-b-gt-md" id="list-l"><?php echo $list_l; ?></div>
                                    <div class="d-a-b-st-l1" id="list-md-s"><?php echo $list_md_s; ?></div>
                                </div>
                            </div><?php

							if ( ! empty( $paginate ) ) :
								?><div class="col-sn-12 col-l3-9"><footer><?php echo $paginate; ?></footer></div><?php
							endif;

							?></div>
                    </div>
                </div>
                <div class="col-sn-12 col-l3-3"><!--
// TODO: Complete date sidebar
                --></div>
            </div>
        </div>
    </div>
</main><?php

get_footer( 'archive' );