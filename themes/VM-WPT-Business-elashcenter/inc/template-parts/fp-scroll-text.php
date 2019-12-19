<div class="bg-img position-absolute w-100 h-100"></div>
<?php

$custom_args  = array( 'posts_per_page' => 1 );
$custom_query = new WP_Query( $custom_args );

if ( $custom_query->have_posts() ) :

	while ( $custom_query->have_posts() ) :

		$custom_query->the_post();

		?>
        <div class="text-light text-justify h-100 w-100 position-absolute">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="overflow-auto h-100 py-5 roll">
							<?php

							the_title( '<h2>', '</h2>' );
							the_content();

							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php

	endwhile;

endif;
