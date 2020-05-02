<?php
//TODO: Breadcrumbs, schema.org markup

if ( have_posts() ) :
	while ( have_posts() ) :

		the_post();

		get_header( 'singular' );

		$markup = vm_get_post_markup_array( $id, array( 'img_size' => 'full' ) );

		$bg_img = $markup['img_url'] ? " style='background:url({$markup['img_url']})'" : '';

		?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <main class="<?php echo $markup['classes']; ?>">
                        <article>
                            <header class="position-relative" <?php echo $bg_img; ?>>
                                <div class="header-txt position-absolute w-100">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12"><?php the_category( ' ' ); ?></div>
                                            <div class="col-12"><h1><?php echo $markup['title']; ?></h1></div>
                                            <div class="col-12 text-right">
                                                <time datetime="<?php echo $markup['iso_time']; ?>">
					                                <?php echo $markup['rel_time']; ?>
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12"><?php the_content(); ?></div>
                                    <div class="col-12">
                                        <footer><?php the_tags(); ?></footer>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </main>
                </div>
            </div>
        </div>
		<?php

		get_footer( 'singular' );

	endwhile;
endif;

