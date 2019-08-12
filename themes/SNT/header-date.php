<?php

get_header();

global $day, $month, $monthnum, $year;

$args = array();
$str = _x( '%1$s Archives %2$s Date archive', 'Description meta; 1: Site name, 2: em dash', 'snt-en' );
$desc = sprintf( $str, get_bloginfo(), '—' ) . ' — ';
$t_prep = 'during';
if ( is_day() ) :
    $t_prep = 'on';
    $m_name = $month[ 10 > $monthnum ? "0$monthnum" : "$monthnum" ];
    $str = "$day $m_name,";
	$args['levels'] = array(
		'year' => array( 'txt' => $year, 'url' => get_year_link( $year ) ),
        'month' => array( 'txt' => $m_name, 'url' => get_month_link( $year, $monthnum ) )
	);
elseif ( is_month() ) :
    $str = $month[ 10 > $monthnum ? "0$monthnum" : "$monthnum" ];
    $args['levels']['year'] = array( 'txt' => $year, 'url' => get_year_link( $year ) );
endif;
$str .= " $year";
$format = _x( 'Articles/News published %1$s %2$s', 'Description meta; 1: Time preposition, 2: Time period', 'snt-en' );
$desc .= sprintf( $format, $t_prep, $str );
$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs( $args );
$brc .= '</div></div></div></div></div>';

?><meta name="description" content="<?php echo $desc; ?>" /><?php

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
<div class="ribbon-rolls no-wrap" id="rib-roll-hot" data-delay="1" data-pin="0"></div><?php

echo '<div class="container"><div class="row"><div class="col-sn-12">';