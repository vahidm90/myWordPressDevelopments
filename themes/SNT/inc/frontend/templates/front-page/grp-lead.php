<?php

global $snt_lead_id, $snt_lang, $snt_supported_lang, $snt_mor, $snt_btn_rot;

$lp = $ls = $ol = $lt = '';
$tax = 'placement';
$term_id = array();
$lt_ttl = _x( 'Recent stories', 'Front-page group title', 'snt-en' );
foreach ( array( 'pla-lp' ) as $term ) :
    $term_id []= $snt_supported_lang[ $snt_lang ]['term-id'][ $term ];
endforeach;

$args = array(
	'ignore_sticky_posts' => TRUE,
	'no_found_rows'       => TRUE,
	'post_type'           => 'post',
	'posts_per_page'      => 1,
	'post__not_in'        => $snt_lead_id,
	'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $term_id ) ),
    'meta_query'          => array( array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ) )
);

$lead = new WP_Query( $args );

if ( $lead->have_posts() ) :

	while ( $lead->have_posts() ) :

		$lead->the_post();

		$lnk = get_the_permalink();
		$ttl = esc_html( get_the_title() );
		$img = get_the_post_thumbnail_url( $id, 'full' );
		$exc_s3n = $exc_ln3s2 = $exc_mds1 = $exc_l21 = $exc = get_the_excerpt();
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
		$bg = "background-image: url($img)";
		$len = mb_strwidth( $exc );
		if ( 60 < $len ) :
		    $exc_s3n = mb_substr( $exc, 0, strpos( wordwrap( $exc, 60, '<CUT>' ), '<CUT>' ) ) . '...';
            if ( 75 < $len ) :
                $exc_ln3s2 = mb_substr( $exc, 0, strpos( wordwrap( $exc, 75, '<CUT>' ), '<CUT>' ) ) . '...';
                if ( 100 < $len ) :
                    $exc_mds1 = mb_substr( $exc, 0, strpos( wordwrap( $exc, 100, '<CUT>' ), '<CUT>' ) ) . '...';
                    if ( 130 < $len ) :
                        $exc_l21 = mb_substr( $exc, 0, strpos( wordwrap( $exc, 130, '<CUT>' ), '<CUT>' ) ) . '...';
                    endif;
                endif;
            endif;
		endif;

		$lp .= "<div class='card' id='lead-prime'><a href='$lnk' $atr_ttl>";

		$lp .= "<div class='d-n-l2 d-n-l1'><div class='container'><div class='row'>";

		$lp .= "<div class='col-sn-12 col-l3-8'><img src='$img' class='img-resp' id='img-lp' /></div>";

		$lp .= "<div class='col-sn-12 col-l3-4'><div class='txt txt-lp'>";

		$lp .= "<p class='ttl-post ttl-lp'>$ttl</p>";
		$lp .= "<p class='d-a-b-s2 d-a-b-l3 d-a-b-ln exc-post exc-lp'>$exc_ln3s2</p>";
		$lp .= "<p class='d-a-b-md d-a-b-s1 exc-post exc-lp'>$exc_mds1</p>";
		$lp .= "<p class='d-a-b-s3 d-a-b-sn exc-post exc-lp'>$exc_s3n</p>";

		$lp .= "</div></div>";
        
		$lp .= "</div></div></div>"; // d-n-l2 d-n-l1

		$lp .= "<div style='$bg' class='img-bg d-a-b-l1 d-a-b-l2' id='img-bg-lp'><div class='txt txt-lp'>";
		$lp .= "<p class='ttl-post ttl-lp'>$ttl</p><p class='exc-post exc-lp'>$exc_l21</p>";
		$lp .= "</div></div>";

		$lp .= "</a></div>";

		$snt_lead_id []= $id;

	endwhile;

	wp_reset_postdata();

endif;

$term_id = array();

foreach ( array( 'pla-ls' ) as $term ) :
	$term_id []= $snt_supported_lang[ $snt_lang ]['term-id'][ $term ];
endforeach;

$args = array(
	'ignore-sticky-posts' => TRUE,
	'no_found_rows'       => TRUE,
	'post_type'           => 'post',
	'posts_per_page'      => 2,
	'post__not_in'        => $snt_lead_id,
	'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $term_id ) ),
	'meta_query'          => array( array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ) )
);

$lead = new WP_Query( $args );

if ( $lead->have_posts() ) :

	$ls .= "<div id='lead-sec'><div class='container'><div class='row'>";
	while ( $lead->have_posts() ) :

		$lead->the_post();

		$exc = get_the_excerpt();
		$lnk = get_the_permalink();
		$ttl = esc_html( get_the_title() );
		$img = get_the_post_thumbnail_url( $id, 'full' );
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
		if ( 120 < mb_strwidth( $exc ) ):
            $exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 120, '<CUT>' ), '<CUT>' ) ) . '...';
		endif;

		$ls .= "<div class='col-sn-12 col-l1-6'><a href='$lnk' $atr_ttl>";
		$ls .= "<div class='lead-sec card' id='ls-{$lead->current_post}'><div class='container'><div class='row'>";

		$ls .= "<div class='col-sn-12'><img src='$img' class='img-resp img-ls' /></div>";
		$ls .= "<div class='col-sn-12'><p class='ttl-post ttl-ls'>$ttl</p></div>";
		$ls .= "<div class='col-sn-12'><p class='exc-post'>$exc</p></div>";

        $ls .= "</div></div></div>"; // lead-sec
        $ls .= "</a></div>";

		$snt_lead_id []= $id;

	endwhile;
	$ls .= "</div></div></div>";

	wp_reset_postdata();

endif;

$term_id = array();

foreach ( array( 'pla-lp', 'pla-ls' ) as $term ) :
	$term_id []= $snt_supported_lang[ $snt_lang ]['term-id'][ $term ];
endforeach;

$args = array(
	'ignore-sticky-posts' => TRUE,
	'no_found_rows'       => TRUE,
	'post_type'           => 'post',
	'posts_per_page'      => 6,
	'post__not_in'        => $snt_lead_id,
	'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $term_id ) ),
	'meta_query'          => array( array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ) )
);

$lead = new WP_Query( $args );

if ( $lead->have_posts() ) :

	$ol .= "<div id='oth-lead'><div class='container'><div class='row'>";
	while ( $lead->have_posts() ) :

		$lead->the_post();

		$exc = get_the_excerpt();
		$lnk = get_the_permalink();
		$ttl = esc_html( get_the_title() );
		$img = get_the_post_thumbnail_url( $id, 'full' );
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
		if ( 150 < mb_strwidth( $exc ) ):
            $exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
		endif;

        $ol .= "<div class='col-sn-12 col-s1-6'>";
        $ol .= "<div class='box-rot' id='ol-{$lead->current_post}' data-pre='oth-lead'><div class='rotor rot-y'>";

		$ol .= "<div class='card front'><div class='container'><div class='row'>";

		$ol .= "<div class='col-sn-12'>$snt_btn_rot<a href='$lnk' $atr_ttl><div class='container'><div class='row'>";

		$ol .= "<div class='col-sn-12'><img src='$img' class='img-ol img-resp' /></div>";
		$ol .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";

		$ol .= "</div></div></a></div>";

		$ol .= "</div></div></div>"; //front

		$ol .= "<div style='background-image: url($img)' class='card back img-bg'>";

		$ol .= "<p class='exc-post'>$exc</p>";
		$ol .= "<a href='$lnk' $atr_ttl class='no-prop'><div class='mor-post'>$snt_mor</div></a>";

		$ol .= "</div>"; //back

        $ol .= "</div></div>"; //box-rot
		$ol .= "</div>";

        if ( in_array( $lead->current_post, array( 1, 3 ), TRUE ) ) :
            $ol .= "<div class='clear-fix d-a-b-gt-s2'></div>";
		endif;

		$snt_lead_id []= $id;

	endwhile;
	$ol .= "</div></div></div>";

	wp_reset_postdata();

endif;

$args = array(
	'ignore-sticky-posts' => TRUE,
	'no_found_rows'       => TRUE,
	'post_type'           => 'post',
	'posts_per_page'      => 9,
	'post__not_in'        => $snt_lead_id,
);

$lead = new WP_Query( $args );

if ( $lead->have_posts() ) :

	$lt .= "<div class='container'><div class='row'>";
	while ( $lead->have_posts() ) :

		$lead->the_post();

		$lnk = get_the_permalink();
		$ttl = esc_html( get_the_title() );
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';

		$lt .= "<div class='col-sn-12'><a href='$lnk' $atr_ttl>";
		$lt .= "<div class='card'><p class='ttl-post'>$ttl</p></div>";
		$lt .= "</a></div>";

	endwhile;
	$lt .= "</div></div>"; // container row

	wp_reset_postdata();

endif;

?><div class="centered grp-fp" id="lead">
    <div class="container">
        <div class="row">
            <div class="col-sn-12"><?php echo $lp; ?></div>
            <div class="col-sn-12"><?php echo $ls; ?></div>
            <div class="col-sn-12 col-l2-7"><?php echo $ol; ?></div>
            <div class="col-sn-12 col-l2-5">
                <div class="card" id="latest">
                    <div class="container">
                        <div class="row">
                            <div class="col-sn-12">
                                <a href="#latest">
                                    <h2><?php echo $lt_ttl; ?></h2>
                                </a>
                            </div>
                            <div class="col-sn-12"><?php echo $lt; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
