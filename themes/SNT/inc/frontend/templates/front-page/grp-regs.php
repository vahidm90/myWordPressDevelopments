<?php

global $snt_lead_id, $snt_lang, $snt_supported_lang, $snt_comma, $snt_def_img;

$regs = array();
$tax = 'region';
$reg_load = array(
    'reg01' => array(
        'name' => _x( 'South Asia', 'Front-page region title', 'snt-en' ),
        'items' => array( 'reg-af', 'reg-pak', 'reg-ka' ),
    ),
    'reg02' => array(
        'name' => _x( 'Asia-Pacific', 'Front-page region title', 'snt-en' ),
        'items' => array( 'reg-ind', 'reg-ch', 'reg-bang', 'reg-sea' ),
    ),
    'reg03' => array(
        'name' => _x( 'Middle-east', 'Front-page region title', 'snt-en' ),
        'items' => array( 'reg-me' ),
    ),
    'reg04' => array(
        'name' => _x( 'World', 'Front-page region title', 'snt-en' ),
        'items' => array( 'reg-int' )
    ),
); 

foreach ( $reg_load as $reg => $args ) :

    foreach ( $args['items'] as $reg_item ) :
        $regs[ $reg ]['id'] []= $snt_supported_lang[ $snt_lang ]['term-id'][ $reg_item ];
    endforeach;

    $regs[ $reg ]['name'] = $args['name'];

endforeach;

$i = 0;

foreach ( $regs as $reg => $args ) :
	$$reg = "<section class='card reg' id='reg-$i'><div class='inside'><div class='container'><div class='row'>";


	$$reg .= "<div class='col-sn-12'><a href='#reg-$i'><h3>{$args['name']}</h3></a></div>";
	$oth = $top_id = array();
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

	$reg_q = new WP_Query( $q_args );
	$t_attr_ttl = $t_exc_l21_md_s = $t_lnk = $t_ttl = $t_img = $t_exc = '';

	if ( $reg_q->have_posts() ) :

		while ( $reg_q->have_posts() ) :

			$reg_q->the_post();

			$t_lnk = get_the_permalink();
			$t_ttl = esc_html( get_the_title() );
			$t_img = get_the_post_thumbnail_url( $id, 'full' );
			$t_attr_ttl = esc_attr( $t_ttl );
            $t_exc_l21_md_s = $t_exc = esc_attr( get_the_excerpt() );
			$len = mb_strwidth( $t_exc );
			if ( 120 < $len ):
				$t_exc_l21_md_s = mb_substr( $t_exc, 0, strpos( wordwrap( $t_exc, 120, '<CUT>' ) , '<CUT>' ) ) . '...';
				if ( 150 < $len ):
					$t_exc = mb_substr( $t_exc, 0, strpos( wordwrap( $t_exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
				endif;
			endif;

			$top_id []= $id;

		endwhile;

		wp_reset_postdata();

	endif;

	$data = "data-lnk='$t_lnk' data-img='$t_img' data-exc='$t_exc' data-reg='$i'";

	$q_args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post__not_in'        => array_merge( $snt_lead_id, $top_id ),
		'tax_query'           => array( array( 'taxonomy' => $tax, 'terms' => $args['id'] ) )
	);

	$reg_q = new WP_Query( $q_args );
	if ( $reg_q->have_posts() ) :

		while ( $reg_q->have_posts() ) :

			$reg_q->the_post();
			$exc = esc_attr( get_the_excerpt() );
			$img = ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) : $snt_def_img );
			$oth[ $reg_q->current_post ]['lnk'] = get_the_permalink();
			$oth[ $reg_q->current_post ]['ttl'] = esc_html( get_the_title() );
			$oth[ $reg_q->current_post ]['img'] = $img;
			$oth[ $reg_q->current_post ]['attr_ttl'] = esc_attr( $oth[ $reg_q->current_post ]['ttl'] );
			if ( 150 < mb_strwidth( $exc ) ):
                $exc = mb_substr( $exc, 0, strpos( wordwrap( $exc, 150, '<CUT>' ), '<CUT>' ) ) . '...';
			endif;
			$oth[ $reg_q->current_post ]['exc'] = $exc;

		endwhile;

		wp_reset_postdata();

	endif;

	$$reg .= "<div class='col-sn-12'><div class='content-grp d-a-b-st-l3'><div class='container'><div class='row'>";

	$$reg .= "<div class='col-sn-12'><div class='top'><div class='container'><div class='row'>";
    $$reg .= "<div class='col-sn-12'><a href='$t_lnk' $t_attr_ttl><div class='container'><div class='row'>";

	$$reg .= "<div class='col-sn-12 col-s2-4'><img src='$t_img' class='img-resp' /></div>";
	$$reg .= "<div class='col-sn-12 col-s2-8'>";
	$$reg .= "<p class='ttl-post'>$t_ttl</p><p class='exc-post'>$t_exc_l21_md_s</p>";
	$$reg .= "</div>";

	$$reg .= "</div></div></a></div>";
	$$reg .= "</div></div></div></div>"; // top

	$$reg .= "<div class='col-sn-12'><div class='oth'><div class='container'><div class='row'>";
	foreach ( $oth as $item ) :
        $$reg .= "<div class='col-sn-12'><a href='{$item['lnk']}'><p class='ttl-post'>{$item['ttl']}</p></a></div>";
	endforeach;
	$$reg .= "</div></div></div></div>";

    $$reg .= "</div></div></div></div>"; // content-grp

    $$reg .= "<div class='col-sn-12'><div class='content-grp d-a-b-gt-l2'><div class='container'><div class='row'>";

    $$reg .= "<div class='col-sn-12 col-l3-5'><div class='btn'><div class='container'><div class='row'>";

	$$reg .= "<div class='col-sn-12'><div class='top'><div class='holder active' $data>";
    $$reg .= "<a href='$t_lnk' class='lnk-post'><p class='ttl-post'>$t_ttl</p></a>";
    $$reg .= "<div class='chk-btn active' data-reg='$i'><span class='snt-icon snt-checkbox-checked'></span></div>";
    $$reg .= "</div></div></div>";

    $$reg .= "<div class='col-sn-12'><div class='oth'><div class='container'><div class='row'>";
	foreach ( $oth as $item ) :

        $data = "data-lnk='{$item['lnk']}' data-img='{$item['img']}' data-exc='{$item['exc']}' data-reg='$i'";

	    $$reg .= "<div class='col-sn-12'><div class='holder' $data>";
	    $$reg .= "<a href='{$item['lnk']}' class='lnk-post'><p class='ttl-post'>{$item['ttl']}</p></a>";
	    $$reg .= "<div class='chk-btn' data-reg='$i'><span class='snt-icon snt-checkbox-unchecked'></span></div>";
	    $$reg .= "</div></div>";

	endforeach;
	$$reg .= "</div></div></div></div>"; // oth

	$$reg .= "</div></div></div></div>"; // btn

	$$reg .= "<div class='col-sn-7'><a href='$t_lnk' class='lnk-img-bg'>";
	$$reg .= "<div style='background-image: url($t_img)' class='img-bg'><p class='exc-post'>$t_exc</p></div>";
	$$reg .= "</a></div>";

	$$reg .= "</div></div></div></div>"; // content-grp

    $i++;

	$$reg .= "</div></div></div></section>"; // card reg
endforeach;

?><div class="centered grp-fp" id="regs">
    <div class="container">
        <div class="row">
            <div class="col-sn-12"><a href="#regs"><h2><?php echo get_taxonomy( $tax )->label; ?></h2></a></div>
            <div class="col-sn-12"><?php

				foreach ( $regs as $reg => $reg_id ) :
					echo $$reg;
				endforeach;

            ?></div>
        </div>
    </div>
</div>