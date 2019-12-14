<?php

$custom_args  = array( 'posts_per_page' => 4 );
$cards = '';

$custom_query = new WP_Query( $custom_args );

if ( $custom_query->have_posts() ) :

	while ( $custom_query->have_posts() ) :

		$custom_query->the_post();

		$html = <<<'html'
<div class="col-12 col-md-2 col-lg-3">
	<div class="card">
		<span class="card-img-top vm-icon vmi-random"></span>
		<div class="card-body">
			<h2 class="card-title">%1$s</h2>
			<p class="card-text">%2$s</p>
		</div>
	</div>
</div>
html;

		$cards .= sprintf( $html, get_the_title(), get_the_excerpt() );

	endwhile;

	wp_reset_postdata();

endif;

?>
<div class="container">
    <div class="row"><?php echo $cards; ?></div>
</div>