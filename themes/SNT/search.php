<?php

global $snt_quote, $snt_def_img;

$pag = snt_archive_pagination();
$s_q = esc_html( get_search_query( FALSE ) );
$head = _x( 'Search results for %1$s%2$s%1$s', 'Search result message; 1: Quotation mark, 2: Query', 'snt-en' );
$head = sprintf( $head, $snt_quote, $s_q );
$empty = _x( 'No match found for %1$s%2$s%1$s', 'Search result message; 1: Quotation mark, 2: Query', 'snt-en' );
$empty = sprintf( $empty, $snt_quote, $s_q );

if ( have_posts() ) :
	$list = '<div id="list"><div class="container"><div class="row">';
	while( have_posts() ) :

		the_post();

		$tim = snt_get_time();
		$ttl = get_the_title();
		$m_t = get_the_time( 'c' );
		$lnk = get_the_permalink();
		$img = ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) : $snt_def_img );
		$class = '';
		$lnk_att = 'class="entry" title="' . esc_attr( $ttl ) . '"';
		$exc_l_md_s1 = $exc = get_the_excerpt();
		$len = mb_strwidth( $exc );
		if ( 100 < $len ) :
			$exc_l_md_s1 = mb_substr( $exc, 0, strpos( wordwrap( $exc, 100, '<CUT>' ), '<CUT>' ) ) . '...';
		    if ( 300 < $len ) :
			    $exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 300, '<CUT>' ), '<CUT>' ) ) . '...';
		    endif;
		endif;

        $list .= "<div class='col-sn-12'><a href='$lnk' $lnk_att><div class='container'><div class='row'>";

		$list .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></a></div>";

		$list .= "<div class='col-sn-12'><div class='img-txt'><div class='container'><div class='row'>";

        $list .= "<div class='col-s1-3'><img src='$img' class='img-resp d-a-b-gt-s2' /></div>";

		$list .= "<div class='col-sn-12 col-s1-9'><div class='txt'><div class='container'><div class='row'>";

		$list .= "<div class='col-sn-12'><time datetime='$m_t'>$tim</time></div>";
		$list .= "<div class='col-sn-12'>";
		$list .= "<p class='exc-post d-a-b-gt-s2'>$exc_l_md_s1</p><p class='exc-post d-a-b-st-s1'>$exc</p>";
		$list .= "</div>";

		$list .= '</div></div></div></div>'; // txt

		$list .= '</div></div></div></div>'; // img-txt

		$list .= '</div></div></a></div>';

	endwhile;
	$list .= '</div></div></div>'; // list
	else :
	$list = "<p class='search-empty'>$empty</p>";
endif;

get_header( 'search' );

?><main>
	<div class="centered" id="list">
		<div class="container">
			<div class="row">
                <div class="col-l3-9 col-sn-12">
                    <header><a href="#list"><h1><?php echo $head; ?></h1></a></header>
                </div>
				<div class="col-l3-9 col-sn-12"><?php echo $list; ?></div>
				<div class="col-l3-9 col-sn-12"><footer><?php echo $pag; ?></footer></div>
			</div>
		</div>
	</div>
</main><?php

get_footer( 'search' );