<?php

global $snt_hct, $snt_supported_lang, $snt_lang;

$args = array();
foreach ( $snt_hct as $tax ) :
    if ( in_array( $tax->name, array( 'placement', 'roll' ), TRUE ) ) :
        continue;
    endif;
    $term = wp_get_post_terms( $id, $tax->name )[0];
    $args['levels'][ $tax->name ] = array(
            'txt' => $tax->labels->singular_name,
            'url' => get_the_permalink( $snt_supported_lang[ $snt_lang ]['page-id'][ $tax->name ] ),
            'term' => array( 'id' => $term->term_id, 'ttl' => $term->name )
    );
endforeach;

$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs( $args );
$brc .= '</div></div></div></div></div>';

get_header();

get_template_part( 'inc/frontend/templates/single', 'post/head' );

wp_head();

echo '</head><body class="' . join( ' ', get_body_class() ) . '">';

if ( FALSE !== strpos( $_SERVER['SERVER_NAME'], 'islamnewsagency' ) ) :
	include_once( get_template_directory() . '/g-tag-manager.php' );
endif;

echo '<div id="wrap">';

?><div class="container">
    <div class="row">
        <div class="col-sn-12">
            <header id="header-page"><?php

                get_template_part( 'inc/frontend/templates/bar', 'top' );
                echo $brc;

            ?></header>
        </div>
    </div>
</div>
<div class="ribbon-rolls no-wrap" id="rib-roll-hot" data-delay="2" data-pin="1"></div><?php

echo '<div class="container"><div class="row"><div class="col-sn-12">';