<?php

global $snt_comma, $snt_mor, $snt_lang, $snt_supported_lang, $snt_def_img;

$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs( array( 'archive' => TRUE ) );
$brc .= '</div></div></div></div></div>';
switch ( $id ) :
    case $snt_supported_lang[ $snt_lang ]['page-id']['designation'] :
	    $name = 'designation';
	    break;
	case $snt_supported_lang[ $snt_lang ]['page-id']['region'] :
	    $name = 'region';
	    break;
    default :
	    $name = 'topic';
	    break;
endswitch;
$tax = get_taxonomy( $name );
$terms = get_terms( array( 'taxonomy' => $name, 'childless' => TRUE ) );
$desc = sprintf(
	_x( 'List of available %1$s with their most recent items', 'Description meta; 1: Taxonomy description', 'snt-en' ),
	$tax->description
);

$list = "<div class='container'><div class='row'>";
foreach ( $terms as $obj ) :

	$lnk = get_term_link( $obj->term_id, $name );
	$q_a = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_type'           => 'post',
		'posts_per_page'      => 8,
		'tax_query'           => array( array( 'taxonomy' => $name, 'terms' => $obj->term_id ) )
	);
	$t_q = new WP_Query( $q_a );

	if ( $t_q->have_posts() ) :
		$list .= "<div class='col-sn-12'><section class='card' id='$obj->slug'><div class='container'><div class='row'>";

		$list .= "<div class='col-sn-12'><a href='$lnk'><h2>$obj->name</h2></a></div>";

	    $list .= "<div class='col-sn-12'><div class='container'><div class='row'>";
		while ( $t_q->have_posts() ) :

			$t_q->the_post();

			$exc = get_the_excerpt();
			$lnk = get_the_permalink();
			$ttl = esc_html( get_the_title() );
			$img = ( has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) : $snt_def_img );

			$list .= "<div class='col-sn-12 col-s1-6 col-l3-3'>";
			$list .= "<div class='box-rot' data-pre='$obj->slug'><div class='rotor rot-y'>";

			$list .= "<div class='card front'><div class='container'><div class='row'>";

			$list .= "<div class='col-sn-12'><img src='$img' class='img-resp' /></div>";
			$list .= "<div class='col-sn-12'><p class='ttl-post'>$ttl</p></div>";

			$list .= "</div></div></div>";

			$list .= "<div style='background-image: url($img)' class='img-bg card back'>";
			$list .= "<p class='exc-post'>$exc</p><a href='$lnk' class='no-prop'><div class='mor-post'>$snt_mor</div></a>";
			$list .= "</div>";

			$list .= "</div></div>";
			$list .= "</div>";

		endwhile;
		$list .= "</div></div></div>";

		wp_reset_postdata();

		$list .= "</div></div></section></div>";
	endif;

endforeach;
$list .= "</div></div>";

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
                                        <h1><?php echo $tax->description; ?></h1>
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
<div class="ribbon-rolls pinned no-wrap" id="rib-roll-lat" data-delay="1"></div><?php

get_footer();