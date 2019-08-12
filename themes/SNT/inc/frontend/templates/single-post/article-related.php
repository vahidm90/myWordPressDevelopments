<?php

global $snt_supported_lang, $snt_lang, $snt_mor, $snt_btn_so;

$html = '';
$tax = 'designation';
$str = _x( 'Related %1$s', 'Related posts heading; 1: Term name', 'snt-en' );
$sec_ttl = _x( 'Related stories', 'Related posts link title', 'snt-en' );
$rel_arr = explode( ',', get_post_meta( $id, 'related_meta_data', TRUE ) );

foreach ( array( 'n', 'a' ) as $init ) :
	$term_id = $snt_supported_lang[ $snt_lang ]['term-id'][ 'des-' . $init ];
    $term_obj = get_term( $term_id, $tax );
	$q_args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 4,
		'post__in'            => $rel_arr,
		'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $term_id ) )
	);
	$rel_q = new WP_Query( $q_args );

	if ( $rel_q->have_posts() ) :
		$html .= "<div id='related-{$term_obj->slug}'><div class='container'><div class='row'>";

		$html .= "<div class='col-sn-12'><a href='#related-{$term_obj->slug}'>";
	    $html .= '<h3>' . sprintf( $str, $term_obj->name ) . '</h3>';
	    $html .= '</a></div>';

		while ( $rel_q->have_posts() ) :

            $rel_q->the_post();

	        $exc = get_the_excerpt();
			$ttl = esc_html( get_the_title() );
			$lnk = get_the_permalink();
			$img = get_the_post_thumbnail_url( $id, 'full' );
			$atr_ttl = 'title="' . esc_attr( $ttl ) . '"';
			if ( 200 < strlen( $exc ) ):
				$exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 200, '<CUT>' ), '<CUT>' ) ) . '...';
			endif;

			$html .= "<div class='col-sn-12'>";
			$html .= "<div class='item-rel slide-open card'><div class='container'><div class='row'>";

			$html .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-post'>$ttl</p></a></div>";

			$html .= "<div class='col-sn-12'>$snt_btn_so</div>";

			$html .= "<div class='col-sn-12'><div class='rest-so'>";

			if ( $img ) :
				$class = ' col-s1-8';
				$html .= "<div class='col-sn-12 col-s1-4'><img src='$img' class='img-resp' /></div>";
			endif;

			$html .= "<div class='col-sn-12$class'><div class='txt'>";

			$html .= "<p class='exc-post'>$exc</p>";
            $html .= "<a href='$lnk' $atr_ttl class='no-prop'><div class='mor-post'>$snt_mor</div></a>";

            $html .= "</div></div>";

			$html .= "</div></div>";

			$html .= "</div></div></div>";
            $html .= "</div>";

		endwhile;

		wp_reset_postdata();

		$html .= "</div></div></div>";
	endif;

endforeach;

?><div id="related">
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <a href="#related" title="<?php echo $sec_ttl; ?>">
                    <h2><?php _ex( 'Read more', 'Related posts title', 'snt-en' ); ?></h2>
                </a>
            </div>
            <div class="col-sn-12"><?php echo $html; ?></div>
        </div>
    </div>
</div>
