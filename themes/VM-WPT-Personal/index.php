<?php

get_header();

$path = get_template_directory_uri();
//TODO: make the categories dynamic
$categories = array(
	3  => get_category( 3 ),
	2  => get_category( 2 ),
	4  => get_category( 4 ),
	10 => get_category( 10 )
);

$content = $tabs = $balls = '';
foreach ( $categories as $cat_id => $cat ) :

    $children = get_term_children( $cat_id, 'category' );
	$inside   = '';

	if ( is_array( $children ) ) :

		foreach ( $children as $child_id ) :
//          TODO: check if card columns do the trick, otherwise, use masonry, etc.
			$child  = get_category( $child_id );
			$cat_q  = new WP_Query( array( 'category__in' => $child_id, 'posts_per_page' => 3 ) );
			if ( $cat_q->have_posts() ) :
				$inside .= <<<html
<div class="container"><div class="row"><div class="sub-cat">
    <div class="col-12"><h3 class="cat" id="$child->slug">$child->name</h3></div>
html;
 				$inside .= '<div class="col-12"><div class="card-columns">';
				while ( $cat_q->have_posts() ):
					$cat_q->the_post();
					$inside .= vm_get_front_page_cat_card();
				endwhile;
				wp_reset_postdata();
				$inside .= '</div></div></div></div></div>'; // class="container"
			endif;
		endforeach;

	else :

		$cat_q = new WP_Query( array( 'category__in' => $cat_id, 'posts_per_page' => 6 ) );
		if ( $cat_q->have_posts() ) :
			$inside .= <<<html
<div class="container"><div class="row">
    <div class="col-12"><div class="card-columns w-100" id="$cat->slug">
html;
			while ( $cat_q->have_posts() ):
				$cat_q->the_post();
				$inside .= vm_get_front_page_cat_card();
			endwhile;
			wp_reset_postdata();
			$inside .= '</div></div></div></div>'; // class="container"
		endif;

	endif;
	// TODO: create options to set category icons.
	$icon    = strtolower( substr( $cat->name, 0, - 1 ) );
	$balls   .= <<<html
<div class="holder my-5 my-sm-0">
    <div class="cat-ball w-100 h-100 position-relative overflow-hidden" data-cat="#$cat->slug">
        <span class="cat-icon w-100 h-100 position-absolute vmi-$icon"></span>
        <span class="cat-name position-absolute d-block text-center w-100">$cat->name</span>
    </div>
</div>
html;
	$content .= empty($inside) ? '' : <<<html
<div class="content w-100" id="$cat->slug"><div class="container"><div class="row">
    <div class="col-12"><h2>$cat->name</h2><p class="lead">$cat->description</p></div>
    <div class="col-12">$inside</div>
</div></div></div>
html;

endforeach;

?>
<div class="w-100 vh-100 position-relative overflow-hidden" id="welcome">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-title p-1 px-5">
                    <h1><?php bloginfo(); ?></h1>
                    <p class="lead"><?php bloginfo('description'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <a href="#cat-balls" class="dashicons-before dashicons-arrow-down-alt2 position-absolute d-block text-decoration-none" id="scroll-down"></a>
</div>
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-12">
            <div class="d-flex flex-column align-items-center flex-sm-row justify-content-sm-around w-100" id="cat-balls">
                <?php echo $balls; ?>
            </div>
        </div>
    </div>
</div>
<div class="w-100" id="cat-contents"><?php echo $content; ?></div>
<?php get_footer(); ?>
