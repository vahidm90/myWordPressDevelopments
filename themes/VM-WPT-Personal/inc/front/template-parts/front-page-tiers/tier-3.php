<?php

//TODO: add the post type "portfolio" and add your websites in it.
//TODO: add the meta/posts for training videos.

$custom_query_args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
	'posts_per_page'      => 6,
	'tax_query'           => array( array( 'taxonomy' => 'category', 'terms' => 36 ) )
);


$custom_query = new WP_Query( $custom_query_args );
$posts_roll   = '';

if ( $custom_query->have_posts() ) :

	while ( $custom_query->have_posts() ) :

		$custom_query->the_post();
		$html    = vm_get_post_markup_array( $id, array( 'force_img' => true, 'img_size' => 'large' ) );
		$lnk_txt = _x( 'Visit', 'Lint text', VM_TD);

		$posts_roll .= <<<html
<div class="col my-3">
	<article class="{$html['classes']} card h-100">
		<header>
			<div class="card-header"><h3 class="post-title card-title">{$html['title']}</h3></div> 
			<img src='{$html['img_url']}' class='post-image card-img-top' alt='{$html['title_attr']}' />
		</header>
		<div class="card-body">
            <a href="{$html['link']}" class="post-link card-link">$lnk_txt</a>
		    <p class="post-excerpt">{$html['excerpt']}</p>
        </div>
        <footer class="card-footer">
            <p class="post-tags">{$html['tags']}</p>
        </footer>
	</article>
</div>
html;


	endwhile;

	wp_reset_postdata();

endif;

?>
<div class="tier-wrap d-flex flex-column h-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="tier-title display-4"><?php _e( 'Portfolio', VM_TD ); ?></h2>
            </div>
        </div>
    </div>
    <div class="content-roll flex-grow-1 ml-3 ml-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3"><?php echo $posts_roll; ?></div>
        </div>
    </div>
</div>

