<?php

get_header( 'front-page' );

$site_name = get_bloginfo();
$split = str_split( $site_name );
$count = count( $split ) - 1;
for( $i = 0 ; $count >= $i ; $i++ ) :
    $class = ( $count === $i ) ? ' last' : '';
//    $class .= ( 9 < $i ) ? ' delay-' : ' delay-0-';
    $split[ $i ] = "<span class='letter d-inline-block fastest$class'>{$split[ $i ]}</span>";
endfor;

$tiers = vm_get_front_page_tier_markup();
$tiers_menu = vm_get_front_page_tier_menu_markup();
$menu = '';

foreach ( $tiers_menu as $i => $menu_item ) :
    $menu .= $menu_item;
endforeach;

?>
<div class="w-100 vh-100 bg-dark text-light position-fixed" id="splash">
    <h1><?php echo implode( '', $split ); ?></h1>
    <p class="spinner-grow"></p>
</div>
<header class="navbar navbar-dark position-fixed bg-dark w-100" id="fp-nav">
    <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand"><?php echo $site_name; ?></a>
    <button class="d-xl-none" id="toggle-fp-nav" aria-controls="nav-items" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
<div data-spy="scroll" data-target="#fp-nav-items" data-offset="0">
	<?php
	if ( ! empty( $tiers ) ) :
		foreach ( $tiers as $i => $content ) :
			echo $content['open'];
			get_template_part(
				empty( $content['template'] ) ?
					'/inc/front-end/template-parts/front-page-tiers/default' : $content['template']
			);
			echo $content['close'];
		endforeach;
	endif;
	?>
</div>
<?php get_footer(); ?>
