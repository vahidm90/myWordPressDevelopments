<?php

get_header( 'front-page' );

$site_name = get_bloginfo();
$split = str_split( $site_name );
$count = count( $split ) - 1;
for( $i = 0 ; $count >= $i ; $i++ ) :
    $class = ( $count === $i ) ? ' last' : '';
//    $class .= ( 9 < $i ) ? ' delay-' : ' delay-0-';
    $split[ $i ] = "<span class='letter$class'>{$split[ $i ]}</span>";
endfor;

$tiers = vm_get_front_page_tier_markup( (int) get_option( 'vm_theme_options_front_page_tiers_count' ) );

?>
<div class="w-100 vh-100 align-items-center justify-content-around bg-dark text-light position-fixed" id="splash">
    <h1 class="m-0"><?php echo implode( '', $split ); ?></h1>
    <p class="spinner-grow"></p>
</div>
<nav class="navbar">
    <a href="<?php echo esc_url( home_url() ); ?>" class="navbar-brand"><?php echo $site_name; ?></a>
    <button class="d-xl-none" id="toggle-nav" aria-controls="nav-items" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav-items">
		<?php
		//TODO: get front-page tiers menu.
		//TODO: make front-page tiers dynamic.
		?>
    </div>
</nav>
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
get_footer(); ?>
