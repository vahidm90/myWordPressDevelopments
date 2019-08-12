<?php

global $snt_quote;

$desc = _x( 'Search results for %2$s%1$s%2$s', 'Description meta; 1: Query, 2: Quotation mark' , 'snt-en' );
$desc = sprintf( $desc, esc_attr( get_search_query( FALSE ) ), $snt_quote ) . ' — ' . get_bloginfo();

$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs();
$brc .= '</div></div></div></div></div>';

get_header();

printf( '<meta name="description" content="%1$s" />', $desc );

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
<div class="ribbon-rolls no-wrap" id="rib-roll-hot" data-delay="0" data-pin="1"></div><?php

echo '<div class="container"><div class="row"><div class="col-sn-12">';