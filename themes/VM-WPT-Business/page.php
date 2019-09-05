<?php

get_header( 'front-page' );

if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();
		$all_parents = get_post_ancestors( $id );
		$img         = '';
		if ( has_post_thumbnail() ) :
			$img = get_the_post_thumbnail_url( $id, 'full' );
		else :
			foreach ( $all_parents as $parent ) :
				if ( has_post_thumbnail( $parent ) ) :
					$img = get_the_post_thumbnail_url( $parent, 'full' );
					break;
				endif;
			endforeach;
		endif;
		$img = empty( $img ) ? '' : "<div class='bg-img position-absolute vh-100 w-100' style='background-image: url($img)'></div>";

		$all_subs_query = new WP_Query();

		$all_subs = get_page_children(
			$id,
			$all_subs_query->query(
				array(
					'post_type'      => 'page',
					'posts_per_page' => '-1',
					'orderby'        => 'menu_order',
					'order'          => 'ASC'
				)
			)
		);

		if ( empty( $all_subs ) ) :

			?>
            <div id="wrap">
                <?php echo $img; ?>
                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <header>
                                    <h1 class="mb-0 mt-5 px-1 px-sm-3">
                                        <?php the_title(); ?>
                                    </h1>
                                </header>
                            </div>
                            <div class="col-12">
                                <main class="pt-5">
									<?php the_content(); ?>
                                </main>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
		<?php

		else :

			$all_children_count = count( $all_subs );
			$tree = array();

			$i = 0;
			foreach ( $all_subs as $lvl_1 ) :
				if ( $id !== $lvl_1->post_parent ) :
					continue;
				endif;
				$tree[ $i ]['parent']['link']  = get_the_permalink( $lvl_1->ID );
				$tree[ $i ]['parent']['title'] = get_the_title( $lvl_1->ID );
				$j                             = 0;
				foreach ( $all_subs as $lvl_2 ) :
					if ( $id === $lvl_2->post_parent || $lvl_1->ID !== $lvl_2->post_parent ) :
						continue;
					endif;
					$tree[ $i ]['children'][ $j ]['parent']['link']  = get_the_permalink( $lvl_2->ID );
					$tree[ $i ]['children'][ $j ]['parent']['title'] = get_the_title( $lvl_2->ID );
					$k                                               = 0;
					foreach ( $all_subs as $lvl_3 ) :
						if ( $id === $lvl_3->post_parent || $lvl_1->ID === $lvl_3->post_parent || $lvl_2->ID !== $lvl_3->post_parent ) :
							continue;
						endif;
						$tree[ $i ]['children'][ $j ]['children'][ $k ]['link']  = get_the_permalink( $lvl_3->ID );
						$tree[ $i ]['children'][ $j ]['children'][ $k ]['title'] = get_the_title( $lvl_3->ID );
						$k ++;
					endforeach;
					$j ++;
				endforeach;
				$i ++;
			endforeach;

			$col_count = 12;
			$tree_count = count( $tree );

			switch ( 1 ) :
                default :
                    $col_count = 12;
                    break;
                case ( 3 < $tree_count ) :
                    $col_count = 3;
                    break;
                case ( 2 < $tree_count ) :
                    $col_count = 4;
                    break;
                case ( 1 < $tree_count ) :
                    $col_count = 6;
                    break;
            endswitch;

			?>
            <div id="wrap">
                <?php echo $img; ?>
                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <header>
                                    <h1 class="mb-0 mt-5 px-1 px-sm-3">
                                        <?php the_title(); ?>
                                    </h1>
                                </header>
                            </div>
                            <div class="col-12">
                                <main class="pt-5">
                                    <div class="container">
                                        <div class="row">
											<?php

											if ( ! empty( get_post()->post_content ) ) :

                                                ?>
                                                <div class="col-12"><?php the_content(); ?></div>
                                            <?php

                                            endif;

                                            if ( ! empty ( $tree ) ) :

	                                            ?>
                                                <div class="col-12">
                                                    <h2 class="mt-5">
			                                            <?php _e( 'Browse subcategories', VMBWPT_TEXT_DOMAIN ); ?>
                                                    </h2>
                                                </div>
	                                            <?php

	                                            foreach ( $tree as $sub ) :

		                                            ?>
                                                    <div class="col-lg-<?php echo $col_count; ?> col-md-6">
                                                        <section>
                                                            <p class="h2">
                                                                <a href="<?php echo $sub['parent']['link']; ?>"><?php echo $sub['parent']['title']; ?></a>
                                                            </p>
				                                            <?php
				                                            if ( empty( $sub['children'] ) ) :
					                                            echo '</section></div>';
					                                            continue;
				                                            endif;
				                                            foreach ( $sub['children'] as $sub_sub ) :
					                                            ?>
                                                                <p class="h6 ml-3">
                                                                    <a href="<?php echo $sub_sub['parent']['link']; ?>"><?php echo $sub_sub['parent']['title']; ?></a>
                                                                </p>
					                                            <?php
					                                            if ( empty( $sub_sub['children'] ) ) :
						                                            continue;
					                                            endif;
					                                            foreach ( $sub_sub['children'] as $sub_sub_sub ) :
						                                            ?>
                                                                    <p class="ml-6">
                                                                        <a href="<?php echo $sub_sub_sub['link']; ?>"><?php echo $sub_sub_sub['title']; ?></a>
                                                                    </p>
					                                            <?php
					                                            endforeach;
				                                            endforeach;
				                                            ?>
                                                        </section>
                                                    </div>
	                                            <?php

	                                            endforeach;

                                                endif;

                                            ?>
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
		<?php

		endif;

	endwhile;

endif;


get_footer( 'front-page' );