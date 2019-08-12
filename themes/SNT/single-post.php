<?php

global $snt_hct;

$msg = _x( '%1$s missing! Can\'t display post!', 'Post taxonomy missing; 1: Taxonomy singular name', 'snt-en' );

if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();

        foreach ( $snt_hct as $tax_obj ) :
            if ( ! has_term( '', $tax_obj->name ) ) :
                echo '<h1>' . sprintf( $msg, $tax_obj->labels->singular_name ) . '</h1>';
                break 2;
            endif;
        endforeach;

		get_header( 'single-post' );

		?><main class="centered">
			<div class="container">
				<div class="row">
					<div class="col-sn-12 col-l3-9"><?php

                        get_template_part( 'inc/frontend/templates/single', 'post/article' );

						if ( ! empty( get_post_meta( $id, 'source_meta_data' ) ) ) :
							get_template_part( 'inc/frontend/templates/single', 'post/source' );
						endif;

                    ?></div>
					<div class="col-sn-12 col-l3-3">
                        <aside><?php get_template_part( 'inc/frontend/templates/single', 'post/side' ); ?></aside>
                    </div>
				</div>
			</div>
        </main>
        <footer class="centered">
            <div class="container">
                <div class="row">
                    <div class="col-sn-12 col-l3-9"><?php

						comments_template();

                    ?></div>
                </div>
            </div>
        </footer><?php

		get_footer( 'single-post' );

	endwhile;

endif;