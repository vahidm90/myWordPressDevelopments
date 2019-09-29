<?php

get_header( 'front-page' );

$s_name = get_bloginfo();

$tiers = vm_get_front_page_tier_markup( (int) get_option('vm_theme_options_front_page_tiers_count') );

?>

<nav class="navbar">
    <a href="<?php echo esc_url(home_url()); ?>" class="navbar-brand"><?php echo $s_name; ?></a>
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
