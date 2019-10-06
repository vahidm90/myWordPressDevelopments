<?php

$menu = '';
$tiers_menu = vm_get_front_page_tier_menu_markup();
$cats = array( get_category( 4 ), get_category( 2 ) );
$markup = array();

foreach ( $cats as $i => $cat ) :
    $markup[ $i ] = ''; //TODO: create markup.
endforeach;

foreach ( $tiers_menu as $i => $menu_item ) :
	$menu .= $menu_item;
endforeach;

?>
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-lg-6 col-12"></div>
        <div class="col-lg-6 col-12"></div>
    </div>
</div>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav id="fp-nav-items"><?php echo $menu; ?></nav>
