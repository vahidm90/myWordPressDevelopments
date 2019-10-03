<?php

$menu = '';
$tiers_menu = vm_get_front_page_tier_menu_markup();

foreach ( $tiers_menu as $i => $menu_item ) :
	$menu .= $menu_item;
endforeach;

?><div class="container">
    <div class="row">
        <div class="col-12">
            <div class="site-title p-1 px-5">
                <a href="<?php echo esc_url( home_url() ); ?>" class="text-decoration-none text-white">
                    <h1><?php bloginfo(); ?></h1>
                    <p class="lead"><?php bloginfo( 'description' ); ?></p>
                </a>
            </div>
        </div>
    </div>
</div>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav class="position-absolute" id="fp-nav-items"><?php echo $menu; ?></nav>
