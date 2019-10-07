<?php

$menu       = '';
$tiers_menu = vm_get_front_page_tier_menu_markup();
$cats       = array( get_category( 4 ), get_category( 2 ) );
$markup     = '';
foreach ( $cats as $i => $cat ) :
	$icon   = strtolower( substr( $cat->name, 0, - 1 ) );
    $lnk = get_category_link( $cat );
	$markup .= <<<HTML
<div class="col-lg-6 col-12">
    <div class="w-100 d-flex justify-content-center">
        <a href="$lnk">
            <div class="cat-ball-place">
                <div class="cat-ball w-100 h-100 position-relative overflow-hidden" data-i="$i">
                    <span class="cat-icon w-100 h-100 position-absolute vmi-$icon"></span>
                    <span class="cat-name position-absolute d-block text-center w-100">$cat->name</span>
                </div>
            </div>
        </a>
    </div>
</div>
HTML;

//TODO: create markup.
endforeach;

foreach ( $tiers_menu as $i => $menu_item ) :
	$menu .= $menu_item;
endforeach;


?>
<div class="container-fluid">
    <div class="row no-gutters"><?php echo $markup; ?></div>
</div>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav id="fp-nav-items"><?php echo $menu; ?></nav>
