<?php

get_header();

$path = get_template_directory_uri();
//TODO: make the categories dynamic
$categories = array(get_category( 3 ), get_category( 2 ), get_category( 4 ), get_category( 10 ) );

$content = $accordion = $balls = '';
foreach ( $categories as $i => $cat ) :

    $children = get_term_children( $cat->term_id, 'category' );
	$collapse = $inside = '';

	if ( is_array( $children ) ) :
//TODO: create nested cards for small-screen sub-categories.
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
				    $collapse .= vm_get_front_page_cat_collapsible();
					$inside .= vm_get_front_page_cat_card();
				endwhile;
				wp_reset_postdata();
				$inside .= '</div></div></div></div></div>'; // class="container"
			endif;
		endforeach;

	else :

		$cat_q = new WP_Query( array( 'category__in' => $cat->term_id, 'posts_per_page' => 6 ) );
		if ( $cat_q->have_posts() ) :
			$inside .= <<<html
<div class="container"><div class="row">
    <div class="col-12"><div class="card-columns w-100" id="$cat->slug">
html;
			while ( $cat_q->have_posts() ):
				$cat_q->the_post();
			    $collapse .= vm_get_front_page_cat_collapsible();
				$inside .= vm_get_front_page_cat_card();
			endwhile;
			wp_reset_postdata();
			$inside .= '</div></div></div></div>'; // class="container"
		endif;

	endif;
	// TODO: create options to set category icons.
	$icon    = strtolower( substr( $cat->name, 0, - 1 ) );
	$balls   .= <<<html
<div class="cat-ball-place my-5 my-sm-0">
    <div class="cat-ball w-100 h-100 position-relative overflow-hidden" data-cat="#$cat->slug">
        <span class="cat-icon w-100 h-100 position-absolute vmi-$icon"></span>
        <span class="cat-name position-absolute d-block text-center w-100">$cat->name</span>
    </div>
</div>
html;
	$content .= <<<html
<div class="cat-content position-fixed d-none overflow-auto vh-100 vw-100" id="$cat->slug">
    <a href="#" class="cat-content-back-btn dashicons dashicons-arrow-left-alt d-block text-decoration-none text-black-50" data-cat="#$cat->slug"></a>
    <div class="container"><div class="row">
        <div class="col-12"><h2>$cat->name</h2><p class="lead">$cat->description</p></div>
        <div class="col-12">$inside</div>
    </div>
</div></div>
html;

	$accordion .= <<<html
<div class="card">
    <div class="card-header">
        <h2 class="mb-0">
            <button type="button" class="btn btn-link collapsed vmi-$icon" id="toggler-$cat->slug" data-toggle="collapse" data-target="#collapse-{$cat->slug}" aria-expanded="false" aria-controls="$cat->slug">
                $cat->name
            </button>
        </h2>
    </div>
    <div class="collapse" id="collapse-$cat->slug" aria-labelledby="toggler-$cat->slug" data-parent="#cat-accordion">
        <div class="card-body">$collapse</div>
    </div>
</div>
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
    <a href="#categories" class="dashicons-before dashicons-arrow-down-alt2 position-absolute d-block text-decoration-none" id="scroll-down"></a>
</div>
<div id="categories">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="d-none d-sm-flex align-items-center flex-row justify-content-around w-100 mt-5">
					<?php echo $balls . $content; ?>
                </div>
                <div class="d-sm-none w-100 accordion" id="cat-accordion"><?php echo $accordion; ?></div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
