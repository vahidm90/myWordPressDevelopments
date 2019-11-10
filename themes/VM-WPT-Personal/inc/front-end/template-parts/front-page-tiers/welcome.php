<?php

//TODO: create a fancy layered slider for the top tier.
$tiers_menu = implode( '', vm_get_front_page_tier_menu_markup() );
$posts_html = '';

if ( have_posts() ) :

    while ( have_posts() ) :

        the_post();
		$post_img   = vm_get_post_img_url( 'medium' );
		$post_cat   = get_the_category()[0]->name;
		$post_title = get_the_title();
		$post_time  = vm_get_post_pub_time();
		$post_link  = get_the_permalink();
		$posts_html .= <<<html
<div class='slide'>
    <a href="$post_link">
        <div>
            <h3>$post_title</h3>
            <p>$post_cat</p>
        </div>
    </a>
</div>
html;

	endwhile;

	$posts_html = "<div class='vmPS'>$posts_html</div>";

endif;

echo $posts_html;

?>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
    <a href="#fp-tier-2" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav id="fp-nav-items"><?php echo $tiers_menu; ?></nav>
