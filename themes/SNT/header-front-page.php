<?php

global $snt_hct;

$str = _x(
    'Accurate News, In-Depth Analysis from Muslim World%1$s',
    'Description meta; 1: Other regions',
    'snt-en'
);
$desc = get_bloginfo() . ' — ';
$args = array( 'taxonomy' => 'region', 'hide_empty' => FALSE, 'fields' => 'names', 'childless' => TRUE );

$desc .= sprintf( $str, ', ' . join( ', ', get_terms( $args ) ) );

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
            <header id="header-page"><?php get_template_part( 'inc/frontend/templates/bar', 'top' ); ?></header>
        </div>
    </div>
</div>
<div class="ribbon-rolls no-wrap" id="rib-roll-hot" data-delay="0" data-pin="1"></div><?php

echo '<div class="container"><div class="row"><div class="col-sn-12">';