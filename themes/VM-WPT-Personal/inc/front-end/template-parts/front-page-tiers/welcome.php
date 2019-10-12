<?php

$tiers_menu = implode( '', vm_get_front_page_tier_menu_markup() );
$posts_html = '';

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
//        $img = has_post_thumbnail() ? get_the_post_thumbnail_url( $id, 'full' ) :
	endwhile;
endif;

?>
<div class="container">
    <div class="row"></div>
</div>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav id="fp-nav-items"><?php echo $tiers_menu; ?></nav>
