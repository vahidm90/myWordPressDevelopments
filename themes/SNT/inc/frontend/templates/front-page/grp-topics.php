<?php

global $snt_lead_id, $snt_lang, $snt_supported_lang, $snt_comma, $snt_mor, $snt_def_img, $snt_btn_rot;

$topics = array();
$tax = 'topic';
$topic_load = array(
    'topic01' => array(
        'name' => get_term( $snt_supported_lang[ $snt_lang ]['term-id']['top-pol'], $tax )->name,
        'items' => array( 'top-pol' ),
    ),
    'topic02' => array(
	    'name' => get_term( $snt_supported_lang[ $snt_lang ]['term-id']['top-sec'], $tax )->name,
	    'items' => array( 'top-sec' ),
    ),
    'topic03' => array(
        'name' => _x( 'Other Topics', 'Front-page topic title', 'snt-en' ),
        'items' => array( 'top-eco', 'top-soc', 'top-misc' ),
    )
);

foreach ( $topic_load as $topic=> $args ) :

    foreach ( $args['items'] as $top_item ) :
        $topics[ $topic]['id'] []= $snt_supported_lang[ $snt_lang ]['term-id'][ $top_item ];
    endforeach;

    $topics[ $topic]['name'] = $args['name'];

endforeach;

$i = 0;

foreach ( $topics as $topic => $args ) :
	$$topic = "<section class='topic' id='topic-$i'>";
    $$topic .= "<div class='inside centered'><div class='container'><div class='row'>";

	$$topic .= "<div class='col-sn-12'><a href='#topic-$i'><h3>{$args['name']}</h3></a></div>";
	$items = $top_id = array();
	$name = esc_attr( sanitize_title( $args['name'] ) );
	$top = $top_s23n = '';
	$q_args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 1,
		'post__not_in'        => $snt_lead_id,
		'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $args['id'] ) ),
		'meta_query'          => array(
			array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
			array( 'key' => 'top_meta_data', 'value' => $tax ),
			'relation' => 'AND'
		)
	);
	$topic_q = new WP_Query( $q_args );

	if ( $topic_q->have_posts() ) :

		while ( $topic_q->have_posts() ) :

			$topic_q->the_post();

			$ttl = get_the_title();
			$lnk = get_the_permalink();
			$img = get_the_post_thumbnail_url( $id, 'full' );
			$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
			$exc_l21_md_s1 = $exc_s23n = $exc = get_the_excerpt();
			$bg = "background-image: url($img)";
			$len = mb_strwidth( $exc );
			if ( 90 < $len ) :
                $exc_s23n = mb_substr( $exc, 0, strpos( wordwrap( $exc, 90, '<CUT>' ), '<CUT>' ) ) . '...';
                if ( 150 < $len ) :
                    $exc_l21_md_s1 = mb_substr( $exc, 0, strpos( wordwrap( $exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
	                if ( 200 < $len ):
		                $exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 200, '<CUT>' ), '<CUT>' ) ) . '...';
	                endif;
                endif;
			endif;

			$top .= "<a href='$lnk' $atr_ttl><div class='card'><div class='container'><div class='row'>";

			$top .= "<div class='col-sn-12 col-l1-9'>";

			$top .= "<div style='$bg' class='img-bg img-bg-top d-a-b-gt-md'><p class='ttl-post'>$ttl</p></div>";
			$top .= "<img src='$img' class='img-top img-resp d-a-b-st-l1' />";

			$top .= "</div>";

			$top .= "<div class='col-sn-12 col-l1-3'>";

			$top .= "<p class='exc-post d-a-b-gt-l2'>$exc</p>";
			$top .= "<p class='exc-post d-a-b-l1 d-a-b-l2'>$exc_l21_md_s1</p>";

			$top .= "</div>";

			$top .= "<div class='col-sn-12'><p class='ttl-post d-a-b-st-l1'>$ttl</p></div>";
			$top .= "<div class='col-sn-12 col-l1-3'><p class='exc-post d-a-b-s1 d-a-b-md'>$exc_l21_md_s1</p></div>";

			$top .= "</div></div></div></a>";

			$top_s23n .= "<a href='$lnk' $atr_ttl><div class='container'><div class='row'>";

			$top_s23n .= "<div class='col-sn-12'><img src='$img' class='img-top img-resp' /></div>";
			$top_s23n .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";
			$top_s23n .= "<div class='col-sn-12'><p class='exc-post'>$exc_s23n</p></div>";

			$top_s23n .= "</div></div></a>";

			$top_id []= $id;

		endwhile;

		wp_reset_postdata();

	endif;

	$q_args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 4,
		'post__not_in'        => $top_id,
		'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $args['id'] ) )
	);

	$topic_q = new WP_Query( $q_args );
	$oth = $oth_s23n = '';

	if ( $topic_q->have_posts() ) :
		$oth .= "<div class='container'><div class='row'>";
		$oth_s23n .= "<div class='container'><div class='row'>";
//TODO: Add image for posts without featured photo

        while ( $topic_q->have_posts() ) :

			$topic_q->the_post();

			$exc = get_the_excerpt();
			$lnk = get_the_permalink();
			$ttl = esc_html( get_the_title() );
			$img = ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) : $snt_def_img );
	        $atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
			if ( 150 < mb_strwidth( $exc ) ) :
				$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
			endif;

			$oth .= "<div class='col-sn-12 col-l3-3 col-s1-6'>";
			$oth .= "<div class='box-rot topic-oth-{$topic_q->current_post}' data-pre='topic-' data-grp='$i'>";
			$oth .= "<div class='rotor rot-y'>";

			$oth .= "<div class='card front'><div class='container'><div class='row'>";

			$oth .= "<div class='col-sn-12'>$snt_btn_rot<a href='$lnk' $atr_ttl><div class='container'><div class='row'>";

			$oth .= "<div class='col-sn-12'><img src='$img' class='img-oth img-resp' /></div>";
			$oth .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";

			$oth .= "</div></div></a></div>";

            $oth .= "</div></div></div>"; // front

			$oth .= "<div style='background-image: url($img)' class='card back img-bg-oth img-bg'>";

			$oth .= "<p class='exc-post'>$exc</p>";
			$oth .= "<a href='$lnk' class='no-prop'><div class='mor-post'>$snt_mor</div></a>";

			$oth .= "</div>"; // back

			$oth .= "</div>";
			$oth .= "</div>";
			$oth .= "</div>";

			$oth_s23n .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-post'>$ttl</p></a></div>";

			if ( 1 === $topic_q->current_post ) :
                $oth .= "<div class='clear-fix d-a-b-st-l3'></div>";
			endif;

		endwhile;

		wp_reset_postdata();

		$oth .= "</div></div>";
		$oth_s23n .= "</div></div>";
	endif;

	$$topic .= "<div class='col-sn-12'><div class='top d-a-b-gt-s2'>$top</div></div>";
	$$topic .= "<div class='col-sn-12'><div class='oth d-a-b-gt-s2'>$oth</div></div>";

	$$topic .= "<div class='col-sn-12'><div class='card d-a-b-st-s1'><div class='container'><div class='row'>";

	$$topic .= "<div class='col-sn-12'><div class='top'>$top_s23n</div></div>";
	$$topic .= "<div class='col-sn-12'><div class='oth'>$oth_s23n</div></div>";

	$$topic .= "</div></div></div></div>"; // card

	$i++;

	$$topic .= "</div></div></div>"; // topic
	$$topic .= "</section>"; // topic
endforeach;

?><div class="grp-fp" id="topics">
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <a href="#topics"><h2 class="centered"><?php echo get_taxonomy( $tax )->label; ?></h2></a>
            </div>
            <div class="col-sn-12"><?php

				foreach ( $topics as $topic => $args ) :
					echo $$topic;
				endforeach;

            ?></div>
        </div>
    </div>
</div>