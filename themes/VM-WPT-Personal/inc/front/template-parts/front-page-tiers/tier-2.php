<?php

$custom_query_args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
	'posts_per_page'      => 6,
	'tax_query'           => array( array('taxonomy' => 'post_format', 'terms' => 25) )
);


$custom_query = new WP_Query( $custom_query_args );
$posts_roll   = '';
$dummy_text   = vm_get_lorem( 2 );  // TODO: Replace with episode details, Season/episode info, etc.
if ( 150 < mb_strwidth( $dummy_text ) ):       // TODO: make trim threshold dynamic
	$dummy_text = mb_substr(
		              $dummy_text,
		              0,
		              strpos( wordwrap( $dummy_text, 150, '<CUT>' ), '<CUT>' ) ) . ' ...'; // TODO: make 'read more' text dynamic.
endif;

if ( $custom_query->have_posts() ) :

	while ( $custom_query->have_posts() ) :

		$custom_query->the_post();
		$html    = vm_get_post_markup_array( $id, array( 'force_img' => true, 'img_size' => 'large' ) );
		$lnk_txt = _x( 'Listen', 'Podcast link text', VM_TD ); //TODO: replace with an overlay 'play' icon over the image of the podcast.

		$posts_roll .= <<<html
<div class="col my-3">
	<article class="{$html['classes']} card h-100">
		<header>
			<div class="card-header"><h3 class="post-title card-title">{$html['title']}</h3></div> 
			<img src='{$html['img_url']}' class='post-image card-img-top' alt='{$html['title_attr']}' />
		</header>
		<div class="card-body">
            <a href="{$html['link']}" class="post-link card-link">$lnk_txt</a>
		    <p class="post-excerpt">$dummy_text</p>
        </div>
        <footer class="card-footer">
            <time datetime="{$html['iso_time']}" class="small">{$html['rel_time']}</time>
        </footer>
	</article>
</div>
html;

	endwhile;

	wp_reset_postdata();

endif;

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="tier-title display-4"><?php _e( 'Podcasts', VM_TD ); ?></h2>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3"><?php echo $posts_roll; ?></div>
</div>
