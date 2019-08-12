<?php

global $snt_comma, $snt_mor, $snt_nhct, $snt_hct, $snt_supported_lang, $snt_lang;

$yrs = snt_adjacent_years( array( 'year' => date( 'Y' ) ) );
$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs();
$brc .= '</div></div></div></div></div>';
$desc = _x( 'Archives', 'Description meta, Archives page header', 'snt-en' );

$list = "<section id='categories'><div class='container'><div class='row'>";

$list .= "<div class='col-sn-12'><a href='#categories'>";
$list .= "<h2 class='snt-icon-before snt-tree'>" . _x( 'Categories', 'Archives page header', 'snt-en' ) . "</h2>";
$list .= "</a></div>";

foreach ( $snt_hct as $tax_obj ) :
    if ( empty( $snt_supported_lang[ $snt_lang ]['page-id'][ $tax_obj->name] ) ) :
        continue;
    endif;
    $lnk = get_the_permalink( $snt_supported_lang[ $snt_lang ]['page-id'][ $tax_obj->name] );
    $list .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-archive'>{$tax_obj->description}</p></a></div>";
endforeach;

$list .= '</div></div></section>';

$list .= "<section id='tags'><div class='container'><div class='row'>";

$list .= '<div class="col-sn-12"><a href="#tags">';
$list .= "<h2 class='snt-icon-before snt-price-tags'>" . _x( 'Tags', 'Archives page header', 'snt-en' ) . "</h2>";
$list .= "</a></div>";

foreach ( $snt_nhct as $tax_obj ) :
	$lnk = get_the_permalink( $snt_supported_lang[ $snt_lang ]['page-id'][ $tax_obj->name] );
    $list .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-archive'>{$tax_obj->description}</p></a></div>";
endforeach;

$list .= '</div></div></section>';

$list .= "<section id='years'><div class='container'><div class='row'>";

$list .= '<div class="col-sn-12"><a href="#years">';
$list .= "<h2 class='snt-icon-before snt-calendar'>" . _x( 'Dates', 'Archives page header', 'snt-en' ) . "</h2>";
$list .= "</a></div>";

$lnk = get_year_link( '' );
$txt = date( 'Y' );

$list .= "<div class='col-sn-12'><a href='$lnk'><p class='ttl-archive'>$txt</p></a></div>";

if ( ! empty( $yrs ) && is_array( $yrs ) ) :
	foreach ( $yrs as $year => $val ) :
		$txt = date( 'Y', $year );
		$list .= "<div class='col-sn-12'><a href='{$val['lnk']}'><p class='ttl-archive'>$txt</p></a></div>";
	endforeach;
endif;

$list .= "</div></div></section>";

get_header();

printf( '<meta name="description" content="%1$s" />', _x( 'Glossary', 'Description meta', 'snt-en' ) . " — $desc" );

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
<div class="ribbon-rolls no-wrap" id="rib-roll-hot" data-delay="1" data-pin="1"></div>
<div class="centered">
	<div class="container">
		<div class="row">
			<div class="col-sn-12 col-l3-9">
				<main>
					<div class="container">
						<div class="row">
							<div class="col-sn-12">
                                <header>
                                    <a href="<?php home_url( "$post->post_name" ) ?>">
                                        <h1><?php echo $desc; ?></h1>
                                    </a>
                                </header>
                            </div>
							<div class="col-sn-12"><?php echo $list; ?></div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>
</div>
<div class="ribbon-rolls no-wrap" id="rib-roll-lat" data-delay="1"></div><?php

get_footer();