<?php $site_name = get_bloginfo(); ?>
<div class="menu-toggle d-block d-lg-none position-fixed">
	<button class="dashicons dashicons-arrow-left border-0 m-0 rounded-circle"></button>
</div>
<div class="txt-on-img position-absolute h-100 w-100">
	<h1 class="site-title"><?php echo $site_name ?></h1>
    <p class="lead"><?php bloginfo('description' ); ?></p>
</div>
<nav class="d-flex align-items-center justify-content-center position-absolute" id="scroll-down">
	<a href="#fp-tier-1" class="dashicons-arrow-down-alt2 dashicons-before text-decoration-none"></a>
</nav>
<nav class="nav navbar p-0" id="fp-nav-items">
	<div class="d-lg-none"><a class="nav-link" href="#fp-tier-0"><?php echo $site_name; ?></a></div>
	<div><a class="nav-link" href="#fp-tier-1"><?php _ex( 'Recently Published', 'Posts roll title; front-page tier title', VM_TD ); ?></a></div>
	<div><a class="nav-link" href="#fp-tier-2"><?php _e( 'Podcasts', VM_TD ); ?></a></div>
	<div><a class="nav-link" href="#fp-tier-3"><?php _e( 'Portfolio', VM_TD ); ?></a></div>
</nav>
