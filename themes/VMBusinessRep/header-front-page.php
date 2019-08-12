<?php get_header(); ?>
<meta name="description"
      content="<?php esc_attr_e( get_bloginfo( 'description' ) ); ?>"/>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
global $vmbwpt_lang, $vmbwpt_comma, $vmbwpt_12;

$path = get_template_directory_uri() . '/assets';

//TODO: Add page links

?>
<nav class="navbar fixed-top w-100 p-0" id="top-bar">
    <a class='navbar-brand p-0' href='<?php echo home_url(); ?>' title='Home'>
        <img src='<?php echo $path; ?>/images/welcome_img.png'
             alt='<?php _ex( 'Logo', 'Image alt text', VMBWPT_TEXT_DOMAIN ); ?>' id='top-bar-logo'/>
		<?php bloginfo(); ?>
    </a>
    <button class='navbar-toggler m-0' type='button' id="toggle-top-bar">
        <span class='navbar-toggler-icon'></span>
    </button>
	<?php

	wp_nav_menu(
		array(
			'menu'        => VMBWPT_LANGUAGES[ $vmbwpt_lang ]['menus']['main'],
			'container'   => '',
			'fallback_cb' => false,
			'walker'      => new Walker_Nav_Menu(),
			'items_wrap'  => '<ul class="%2$s list-group list-group-flush" id="top-bar-items">%3$s</ul>'
		)
	);

	?>
</nav>

