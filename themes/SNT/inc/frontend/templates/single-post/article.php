<?php
//TODO: Add icon to image captions.
//TODO: Style the links inside article body.
global $snt_nhct, $snt_comma, $year, $monthnum, $day;

$ttl = get_the_title();
$exc = get_the_excerpt();
$lnk = get_the_permalink();
$cap = trim( esc_html( get_the_post_thumbnail_caption() ) );
$img = get_the_post_thumbnail_url( $id, 'full' );
$d_lnk = '<a href="' . get_day_link( $year, $monthnum, $day ) . '">' . get_the_date( "l$snt_comma j" ) . '</a>';
$m_lnk = '<a href="' . get_month_link( $year, $monthnum ) . '">' . get_the_date( 'F' ) . '</a>';
$y_lnk = '<a href="' . get_year_link( $year ) . '">' . get_the_date( 'Y' ) . '</a>';

$time = _x( '%1$s at %2$s', 'Time; 1: Date, 2: Time', 'snt-en' );
$time = sprintf( $time, "$d_lnk $m_lnk $y_lnk", get_the_time( 'g:iA' ) );

$tags = "<section id='tags'><div class='container'><div class='row'><div class='col-sn-12'>";
foreach ( $snt_nhct as $obj ) :

    $terms = get_the_terms( $id, $obj->name );

	if ( ! $terms || $terms instanceof WP_Error ) :
		continue;
	endif;

	$tags .= snt_get_tag_list( $obj->name, $terms, array( 'echo' => FALSE) ) . ' <br />';

endforeach;
$tags .= "</div></div></div></section>";

?><article>
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <header>
                    <a href="<?php echo $lnk; ?>"><h1 class="ttl-post" id="ttl-post"><?php echo $ttl; ?></h1></a>
                </header>
            </div>
            <div class="col-sn-12">
                <time datetime="<?php the_time( 'c' ); ?>" class="opp-float"><?php echo $time; ?></time>
            </div><?php

            if ( has_post_thumbnail() ) :

                ?><div class="col-sn-12">
                    <a href="<?php echo $img; ?>">
                        <figure id="img-post">
                            <img class="img-resp" src="<?php echo $img; ?>" /><?php

	                        if ( ! empty( $cap ) ) :
		                        ?><figcaption><p><?php echo $cap; ?></p></figcaption><?php
                            endif;

                        ?></figure>
                    </a>
                </div><?php

            endif;

            ?><div class="col-sn-12"><p class="exc-post" id="exc-post"><?php echo $exc; ?></p></div>
            <div class="col-sn-12"><div id="content-post"><?php the_content(); ?></div></div>
            <div class="col-sn-12"><div id="tags-post"><?php echo $tags; ?></div></div>
            <div class="col-sn-12"><?php

	            if ( ! empty( get_post_meta( $id, 'related_meta_data', TRUE ) ) ) :
		            ?><footer id="rel-post"><?php
                        get_template_part( 'inc/frontend/templates/single-post/article', 'related' );
                    ?></footer><?php
	            endif;

            ?></div>
        </div>
    </div>
</article>
