<?php get_header(); ?>
<meta name="description" content="<?php the_excerpt(); ?>">
<?php wp_head(); ?>
</head>
<body class="<?php body_class( 'position-relative' ); ?>">
<header>
    <div class="w-100 vh-100 text-light position-fixed align-items-center justify-content-center flex-column text-center"
         id="splash">
        <h1 class="site-title mb-5"><?php bloginfo(); ?></h1>
        <p class="spinner-border"></p>
    </div>
	<?php wp_nav_menu(
		array(
			'theme_location'  => 'global_nav_bar',
			'container'       => 'nav',
			'container_class' => 'navbar navbar-dark bg-dark justify-content-lg-start w-100',
			'container_id'    => 'top-bar',
			'menu_class'      => 'navbar-nav nav flex-lg-row flex-lg-grow-1 justify-content-lg-around',
			'menu_id'         => 'tb-parent',
			'items_wrap'      =>
                '<ul class="%2$s" id="%1$s" data-ctrl-toggle="#global-top-nav-toggle" data-ctrl-fade="#wrap">%3$s</ul>',

		)
	); ?>
</header>
<div id="wrap">

