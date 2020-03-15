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
<div id="wrap">


