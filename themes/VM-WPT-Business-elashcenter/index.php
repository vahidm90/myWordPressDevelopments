<?php

get_header( 'default' );

?>
		<div class="container">
			<div class="row">

<?php
if ( have_posts() ) :
	while ( have_posts() ) :

		the_post();

		?>
				<div class="col-12"><small><?php the_date(); ?></small></div>
				<div class="col-12"><h1><?php the_title(); ?></h1></div>
				<div class="col-12"><?php the_content(); ?></div>
		<?php

	endwhile;
else :

	printf(
		'<div class="col-12"><h1>%1$s</h1></div><div class="col-12"><a href="%2$s">%3$s</a></div>',
		__( 'No Posts to Display!', VM_TD ),
		get_home_url(),
		__( 'Return to home page.', VM_TD )
	);

endif;

?>
	</div>
	</div>
<?php

get_footer( 'default' );
