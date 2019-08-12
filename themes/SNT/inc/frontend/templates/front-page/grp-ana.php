<?php

global $snt_lang, $snt_supported_lang, $snt_mor, $snt_btn_rot, $snt_def_img;

$term_id = $snt_supported_lang[ $snt_lang ]['term-id']['des-a'];
$cards = '';
$tax = 'designation';

$q_args = array(
	'ignore_sticky_posts' => TRUE,
	'no_found_rows'       => TRUE,
	'post_type'           => 'post',
	'posts_per_page'      => 8,
	'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $term_id ) ),
);

$ana = new WP_Query( $q_args );

if ( $ana->have_posts() ) :

	$cards .= "<div class='container'><div class='row'>";
	while ( $ana->have_posts() ) :

		$ana->the_post();

		$lnk = get_permalink();
		$exc = get_the_excerpt();
		$ttl = esc_html( get_the_title() );
		$img = ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) : $snt_def_img );
		$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
		if ( 150 < mb_strwidth( $exc ) ):
			$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
		endif;

		$cards .= "<div class='col-sn-12 col-l3-3 col-s1-6'>";
		$cards .= "<div class='box-rot' id='ana-{$ana->current_post}' data-pre='ana'><div class='rotor rot-y'>";

		$cards .= "<div class='card front'><div class='container'><div class='row'>";

		$cards .= "<div class='col-sn-12'>$snt_btn_rot<a href='$lnk' $atr_ttl><div class='container'><div class='row'>";

		$cards .= "<div class='col-sn-12'><img src='$img' class='img-resp' /></div>";
        $cards .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";

        $cards .= "</div></div></a></div>";

        $cards .= "</div></div></div>"; // card front

        $cards .= "<div style='background-image: url($img)' class='card back img-bg'>";

        $cards .= "<p class='exc-post'>$exc</p>";
        $cards .= "<a href='$lnk' $atr_ttl class='no-prop'><div class='mor-post'>$snt_mor</div></a>";

        $cards .= "</div>";

        $cards .= "</div></div>";
        $cards .= "</div>";

        if ( in_array( $ana->current_post, array( 1, 3, 5), TRUE ) ) :
            $cards .= "<div class='clear-fix d-a-b-st-l3'></div>";
            $cards .= ( 3 === $ana->current_post ? "<div class='clear-fix d-a-b-gt-l2'></div>" : "" );
        endif;

	endwhile;
	$cards .= "</div></div>";

	wp_reset_postdata();

endif;

$bg = get_template_directory_uri() . "/inc/frontend/templates/front-page/grp-ana-bg.jpg";

?><div style="background-image: url(<?php echo $bg; ?>)" class="grp-fp" id="ana">
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <div class="centered">
                    <div class="container">
                        <div class="row">
                            <div class="col-sn-12">
                                <a href="#ana">
                                    <h2><?php echo get_term( $term_id, $tax )->name; ?></h2>
                                </a>
                            </div>
                            <div class="col-sn-12"><?php echo $cards; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>