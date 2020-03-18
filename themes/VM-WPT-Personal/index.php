<?php get_header('default'); ?>
<div class="container">
    <div class="row">
	    <?php

	    if ( have_posts() ) :

		    while ( have_posts() ) :
			    the_post();
			    the_title( '<div class="col-12"><h1>', '</h1></div>' );
			    ?>
                <div class="col-12"><?php the_content(); ?></div>
		    <?php
		    endwhile;

	    else :
		    ?>
            <div class="col-12"><p class="text-center"><?php _e('No posts to display!', VM_TD ); ?></p></div>
	    <?php

	    endif;

	    ?>
    </div>
</div>
<?php get_footer( 'default' );