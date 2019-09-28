<?php

get_header( 'front-page' );

$s_name = get_bloginfo();


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
<div class="w-100 vh-100 position-relative overflow-hidden" id="welcome" data-fp-tier-no="1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-title p-1 px-5">
                    <a href="<?php echo esc_url(home_url()); ?>" class="text-decoration-none text-white">
                        <h1><?php bloginfo(); ?></h1>
                        <p class="lead"><?php bloginfo( 'description' ); ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <a href="#categories" <?php //TODO: get address to tier 2 dynamically. ?>
       class="dashicons-before dashicons-arrow-down-alt2 position-absolute d-block text-decoration-none"
       id="scroll-down"></a>
</div>
<div id="categories" data-fp-tier-no="2">
    <?php get_template_part( '/inc/front-end/template-parts/front-page-tiers/categories'); //TODO: get front-page tier templates dynamically. ?>
</div>
<?php get_footer(); ?>
