<?php

$custom_args  = array( 'posts_per_page' => 4 );
$cards = '';

$custom_query = new WP_Query( $custom_args );

if ( $custom_query->have_posts() ) :

	while ( $custom_query->have_posts() ) :

		$custom_query->the_post();

		$html = <<<'html'
<div class="col-12 col-md-6 col-lg-3 mt-5 mt-lg-0 %4$s">
	<a href="%3$s" class="text-decoration-none">
		<div class="card pt-3">
		<span class="card-img-top vm-icon vmi-random"></span>
		<div class="card-body">
			<h2 class="card-title text-center">%1$s</h2>
			<p class="card-text text-justify">%2$s</p>
		</div>
		</div>
	</a>
</div>
html;

		$cards .= sprintf(
			$html,
			get_the_title(),
			get_the_excerpt(),
			get_the_permalink(),
			implode( ' ', get_post_class() ),
		);

	endwhile;

	wp_reset_postdata();

endif;

?>
<div class="container">
    <div class="row"><?php echo $cards; ?></div>
</div>