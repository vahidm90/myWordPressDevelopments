<?php
//TODO: Add icon to image captions.
//TODO: Style the links inside article body.

global $snt_mor, $snt_btn_so;

$reg = $top = array();
$id_arr = array( $id );
$root_arr = array( 'region' => 'reg', 'topic' => 'top' );

foreach ( $root_arr as $tax => $pre ) :
    $$pre['obj'] = wp_get_post_terms( $id, $tax )[0];
	$str_rec = _x( 'Recommended %1$s Stories', 'Side heading; 1: Region', 'snt-en' );
	$$pre['head_rec'] = sprintf( $str_rec, $$pre['obj']->name );
	if ( 'reg' === $pre ) :
        $str = _x( 'Latest %1$s Stories', 'Side heading; 1: Region', 'snt-en' );
		$$pre['head'] = sprintf( $str, $reg['obj']->name );
    else :
	    $str = _x( 'Latest on %1$s', 'Side heading; 1: Topic', 'snt-en' );
	    $$pre['head'] = sprintf( $str, $top['obj']->name );
	endif;
	$args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 2,
		'post__not_in'        => $id_arr,
		'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $$pre['obj']->term_id ) ),
        'meta_query'          => array(
            array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
	        array( 'key' => 'top_meta_data', 'value' => $tax, ),
            'relation' => 'AND'
        )
	);
	$tax_query = new WP_Query( $args );

	if ( $tax_query->have_posts() ) :
		$$pre['html'] = "<section id='side-rec-$pre'><div class='container'><div class='row'>";

		$$pre['html'] .= "<div class='col-sn-12'><a href='#side-rec-$pre'>";
		$$pre['html'] .= "<h2>{$$pre['head_rec']}</h2>";
		$$pre['html'] .= "</a></div>";

		$$pre['html'] .= "<div class='col-sn-12'><div class='container'><div class='row'>";
		while ( $tax_query->have_posts() ) :

			$tax_query->the_post();

			$exc = get_the_excerpt();
			$lnk = get_the_permalink();
			$ttl = esc_html( get_the_title() );
			$img = get_the_post_thumbnail_url( $id, 'full' );
			$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
			$id_arr []= $id;

			if ( 120 < strlen( $exc ) ):
				$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 120, '<CUT>' ), '<CUT>' ) ) . '...';
			endif;

			$$pre['html'] .= "<div class='col-sn-12'>";
			$$pre['html'] .= "<div class='card slide-open'><div class='container'><div class='row'>";

            $$pre['html'] .= "<a href='$lnk' $atr_ttl>";
			$$pre['html'] .= "<div class='col-sn-12'><img src='$img' class='img-resp d-a-b-gt-l2' /></div>";
			$$pre['html'] .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></a></div>";
			$$pre['html'] .= "</a>";

			$$pre['html'] .= "<div class='col-sn-12'>$snt_btn_so</div>";

			$$pre['html'] .= "<div class='col-sn-12'><div class='rest-so'><div class='container'><div class='row'>";
			$$pre['html'] .= "<div class='col-sn-12'><p class='exc-post'>$exc</p></div>";

			$$pre['html'] .= "<div class='col-sn-12'>";
			$$pre['html'] .= "<a href='$lnk' $atr_ttl class='no-prop'><div class='mor-post'>$snt_mor</div></a>";
			$$pre['html'] .= "</div>";

			$$pre['html'] .= "</div></div></div></div>"; // rest-so

			$$pre['html'] .= "</div></div></div>"; // slide-open
			$$pre['html'] .= "</div>";

			if ( $tax_query->current_post % 2 ) :
			    $$pre['html'] .= "<div class='clear-fix d-a-b-gt-s2 d-n-l3 d-n-ln'></div>";
			endif;

		endwhile;
		$$pre['html'] .= "</div></div></div>";

		wp_reset_postdata();

		$$pre['html'] .= "</div></div></section>";
	endif;

	//$args = array(
	//	'ignore_sticky_posts' => TRUE,
	//	'no_found_rows'       => TRUE,
	//	'post_type'           => 'post',
	//	'posts_per_page'      => 4,
	//	'post__not_in'        => $id_arr,
	//	'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $$pre['obj']->term_id ) )
	//);
	//
	//$tax_query = new WP_Query( $args );
	//
	//if ( $tax_query->have_posts() ) :
	//	$$pre['html'] .= "<section id='side-$pre'><div class='container'><div class='row'>";
	//
	//	$$pre['html'] .= "<div class='col-sn-12'><a href='#side-$pre'>";
	//	$$pre['html'] .= "<h2>{$$pre['head']}</h2>";
	//	$$pre['html'] .= "</a></div>";
	//
	//	$$pre['html'] .= "<div class='col-sn-12'><div class='container'><div class='row'>";
	//	while ( $tax_query->have_posts() ) :
	//
	//		$tax_query->the_post();
	//
	//		$exc = get_the_excerpt();
	//		$lnk = get_the_permalink();
	//		$ttl = esc_html( get_the_title() );
	//		$img = get_the_post_thumbnail_url( $id, 'full' );
	//		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
	//		$id_arr []= $id;
	//		if ( 120 < strlen( $exc ) ):
	//			$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 120, '<CUT>' ), '<CUT>' ) ) . '...';
	//		endif;
	//
	//		$$pre['html'] .= "<div class='col-sn-12 col-s1-6 col-l3-12'>";
	//		$$pre['html'] .= "<div class='slide-open'><div class='container'><div class='row'>";
	//
	//		$$pre['html'] .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-post'>$ttl</p></a></div>";
	//
	//		$$pre['html'] .= "<div class='col-sn-12'>$snt_btn_so</div>";
	//
	//		$$pre['html'] .= "<div class='col-sn-12'><div class='rest-so'><div class='container'><div class='row'>";
	//
	//		$$pre['html'] .= empty( $img ) ? '' : "<div class='col-sn-12'><img src='$img' class='img-resp' /></div>";
	//		$$pre['html'] .= "<div class='col-sn-12'><p class='exc-post'>$exc</p></div>";
	//
	//		$$pre['html'] .= "<div class='col-sn-12'>";
	//		$$pre['html'] .= "<a href='$lnk' $atr_ttl class='no-prop'><div class='mor-post'>$snt_mor</div></a>";
	//		$$pre['html'] .= "</div>";
	//
	//		$$pre['html'] .= "</div></div></div></div>"; // rest-so
	//
	//		$$pre['html'] .= "</div></div></div>"; // slide-open
	//		$$pre['html'] .= "</div>";
	//
	//		if ( $tax_query->current_post % 2 ) :
	//		    $$pre['html'] .= "<div class='clear-fix d-a-b-gt-s2 d-n-l3 d-n-ln'></div>";
	//		endif;
	//
	//	endwhile;
	//	$$pre['html'] .= "</div></div></div>";
	//
	//	wp_reset_postdata();
	//
	//	$$pre['html'] .= "</div></div></section>";
	//endif;

endforeach;

?><div class="container">
    <div class="row"><?php

        foreach ( $root_arr as $pre ) :
            echo ( empty( $$pre['html'] ) ? '' : "<div class='col-sn-12'>{$$pre['html']}</div>" );
        endforeach;

    ?></div>
</div>
