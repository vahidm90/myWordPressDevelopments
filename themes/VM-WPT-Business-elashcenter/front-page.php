<?php

get_header( 'front-page' );

$menu = wp_nav_menu(
	array(
		'menu'            => 2,
		'menu_class'      => 'navbar-nav mr-auto w-100',
		'menu_id'         => '',
		'container_class' => 'collapse navbar-collapse',
		'container_id'    => 'fp-tb-menu',
		'fallback_cb'     => false,
		'echo'            => false,
		'walker'          => new Walker_Nav_Menu()
	)
);

//TODO: detect user login
//TODO: create user registration form.

?>
<header>
	<nav class='navbar-expand-lg navbar navbar-dark' id='fp-top-bar'>
		<a class="navbar-brand" href="#"><?php bloginfo(); ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fp-tb-menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php echo $menu; ?>
	</nav>
</header>
<section id="4-cards"><?php get_template_part( '/inc/template-parts/fp-four-cards' ); ?></section>
<?php get_footer( 'front-page' );