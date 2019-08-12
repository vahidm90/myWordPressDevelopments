<?php

global $snt_comma, $snt_lang, $snt_supported_lang;

$i = 0;
$let = $list = '';
$num = _x( 'Count', 'Column name', 'snt-en' );
$t_head = _x( 'Tabular Display', 'Page heading', 'snt-en' );
$c_head = _x( 'Cloud Display', 'Page heading', 'snt-en' );
$let_ttl = _x(
    'List of tagged %1$s that start with `%2$s`',
    'Terms table description; 1: Taxonomy description, 2: Starting letter',
    'snt-en'
);
$brc = '<div class="container"><div class="row"><div class="col-sn-12"><div id="breadcrumbs"><div class="centered">';
$brc .= snt_get_bread_crumbs( array( 'archive' => TRUE ) );
$brc .= '</div></div></div></div></div>';
switch ( $id ) :
	case $snt_supported_lang[ $snt_lang ]['page-id']['subtopic'] :
        $name = 'subtopic';
        break;
	case $snt_supported_lang[ $snt_lang ]['page-id']['character'] :
	    $name = 'character';
	    break;
    default :
        $name = 'state';
        break;
endswitch;

$terms = get_terms( array( 'taxonomy' => $name ) );
$args = array( 'taxonomy' => $name, 'number' => 0, 'echo' => FALSE, 'order' => 'RAND' );
$tag_cl = snt_tag_cloud( $name, $args );
$tax = get_taxonomy( $name );
$desc = sprintf(
	_x(
		'List of %1$s tagged and the number of news stories and articles associated with each',
		'Description meta; 1: Taxonomy description',
		'snt-en'
	),
	$tax->description
);

foreach ( $terms as $obj ) :

	$lnk = get_term_link( $obj->term_id, $name );

	$cur1 = mb_substr( trim( $obj->name ), 0, 1 );

	if ( $let !== $cur1 && mb_strtolower( $let ) !== mb_strtolower( $cur1 ) ) :

        $ttl = sprintf( $let_ttl, $tax->description, $cur1 );

		$list .= empty( $let ) ? "" : "</table></section>";

		$list .= "<section>";
		$list .= "<a title='$ttl' href='#letter-$cur1'>";
		$list .= "<div class='letter' id='letter-$cur1'><span>$cur1</span></div>";
		$list .= "</a>";

		$list .= "<table>";

		$list .= "<thead><tr>";
		$list .= "<th class='title'>{$tax->labels->archives}</th><th class='count'>$num</th>";
		$list .= "</tr></thead>";

	endif;

	$list .= "<tr>";
	$list .= "<td class='title'><a href='$lnk'><span>$obj->name</span></a></td><td class='count'>$obj->count</td>";
	$list .= "</tr>";

	$let = $cur1;
	$i++;

	if ( count( $terms ) <= $i ) :
		$list .= "</table>";
	endif;

endforeach;

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
							<div class="col-sn-12 col-md-6">
                                <section id="tables">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sn-12">
                                                <a href="#tables">
                                                    <h2><?php echo $t_head; ?></h2>
                                                </a>
                                            </div>
                                            <div class="col-sn-12"><?php echo $list; ?></div>
                                        </div>
                                    </div>
                                </section>
							</div>
							<div class="col-sn-12 col-md-6">
                                <section id="tag-cloud">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sn-12">
                                                <a href="#tag-cloud">
                                                    <h2><?php echo $c_head; ?></h2>
                                                </a>
                                            </div>
                                            <div class="col-sn-12">
                                                <div class="card"><?php echo $tag_cl; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>
</div>
<div class="ribbon-rolls pinned no-wrap" id="rib-roll-lat" data-delay="1"></div><?php

get_footer();