<?php get_header(); ?>
<meta name="description" content="<?php bloginfo( 'description' ); ?>">
<meta name="robots" content="index, noimageindex">
<?php wp_head(); ?>
</head>
<body class="<?php body_class( 'position-relative' ); ?>">
<div class="w-100 vh-100 text-light position-fixed align-items-center justify-content-center flex-column text-center"
     id="splash">
    <h1 class="site-title mb-5"><?php bloginfo(); ?></h1>
    <p class="spinner-border"></p>
</div>
<nav class="nav navbar p-0" id="tier-nav" data-ctrl-toggle="#tier-nav-toggle" data-ctrl-fade="#wrap">
    <div class="d-lg-none"><a class="nav-link" href="#tier-0"><?php bloginfo(); ?></a></div>
    <div><a class="nav-link" href="#tier-1"><?php _ex( 'Recently Published', 'Posts roll title; front-page tier title', VM_TD ); ?></a></div>
    <div><a class="nav-link" href="#tier-2"><?php _e( 'Podcasts', VM_TD ); ?></a></div>
    <div><a class="nav-link" href="#tier-3"><?php _e( 'Portfolio', VM_TD ); ?></a></div>
</nav>
<div class="menu-toggle d-block d-lg-none position-fixed" id="tier-nav-toggle" data-ctrl-menu="#tier-nav">
    <button class="dashicons dashicons-arrow-left border-0 rounded-circle"></button>
</div>
<div id="wrap">


