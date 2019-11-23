<?php

$tiers_menu = implode( '', vm_get_front_page_tier_menu_markup() );
$posts_html = '';

if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();
		$post_img   = vm_get_post_img_url( 'medium', true );
		$post_cat   = get_the_category()[0]->name;
		$post_title = get_the_title();
		$post_time  = vm_get_post_pub_time();
		$post_link  = get_the_permalink();
		$post_class = implode( ' ', get_post_class( 'text-white' ) );

		$posts_html .= <<<html
<div class="slide">
    <a href="$post_link" class="$post_class">
        <div class="element slide-container w-100 h-100" style="background-image: url($post_img)" data-enter="slideInLeft" data-exit="slideOutRight">
            <div class="slide-text w-100">
                <h3 class="element" data-enter="slideInDown" data-delay="0-5">$post_title</h3>
                <p class="cat element" data-enter="slideInLeft" data-delay="1">$post_cat</p>
                <p class="time element" data-delay="1-5">$post_time</p>
            </div>
        </div>
    </a>
</div>
html;

	endwhile;

	$posts_html = "<div id='tier1-slider'>$posts_html</div>";

endif;

echo $posts_html;

?>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav id="fp-nav-items"><?php echo $tiers_menu; ?></nav>
