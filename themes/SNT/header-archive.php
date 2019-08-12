<?php

global $term, $taxonomy, $snt_supported_lang, $snt_lang;

$term_obj = get_term_by( 'slug', $term, $taxonomy );
$tax_obj = get_taxonomy( $taxonomy );

$all_lnk = get_the_permalink( $snt_supported_lang[ $snt_lang ]['page-id'][ $taxonomy ] );

if ( '0' === $term_obj->name[0] && $all_lnk ) :
	wp_safe_redirect( $all_lnk );
endif;

$str = _x( '%1$s Archives', 'Description meta; 1: Site name' , 'snt-en' ) . ' — ';
$str .= _x( '%2$s Archive', 'Description meta; 2: Taxonomy label', 'snt-en' );
$args = array( 'archive' => TRUE );
$args['levels'][ $taxonomy ] = array( 'txt' => $tax_obj->label, 'url' => $all_lnk );

$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs( $args );
$brc .= '</div></div></div></div></div>';
$desc = sprintf( $str, get_bloginfo(), $tax_obj->label ) . " — {$tax_obj->labels->archives}: $term_obj->name";

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