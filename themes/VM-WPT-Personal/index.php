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

$html = '';
foreach ( $categories as $cat_id => $cat ) :
	$children = get_term_children( $cat_id, 'category' );
	$inside   = '';

	if ( is_array( $children ) ) :

		$col = '';
		switch ( count( $children ) ) :
			default:
				$col = 'col-sm-6 col-xl-4';
				break;
			case 2 :
				$col = 'col-sm-6';
				break;
			case 1 :
				$col = 'col-12';
				break;
		endswitch;

		$inside .= '<div class="sub-cat"><div class="container"><div class="row">';
		foreach ( $children as $child_id ) :
			$inside .= "<div class='$col'>";
			$child  = get_category( $child_id );
			$cat_q  = new WP_Query( array( 'category__in' => $child_id, 'posts_per_page' => 3 ) );
			if ( $cat_q->have_posts() ) :
				$inside .= "<h3 class='cat'>$child->name</h3>";
				while ( $cat_q->have_posts() ):
					$cat_q->the_post();
				    $inside .= vm_get_front_page_cat_card();
				endwhile;
				wp_reset_postdata();
			endif;
			$inside .= '</div>'; // class="$col"
		endforeach;
		$inside .= '</div></div></div>'; // class="sub-cat"

	else :

		$cat_q = new WP_Query( array( 'category__in' => $cat_id, 'posts_per_page' => 6 ) );
		if ( $cat_q->have_posts() ) :
			$inside .= "<div class='container'><div class='row'>";
		    $col = '';
		    switch (1) :
                default :
                    $col = 'col-12';
                    break;
                case ( 3 < $cat_q->post_count) :
                    $col = 'col-sm-6 col-xl-3';
                    break;
                case ( 2 < $cat_q->post_count) :
                    $col = 'col-sm-6 col-xl-4';
                    break;
                case ( 1 < $cat_q->post_count) :
                    $col = 'col-sm-6';
                    break;
		    endswitch;
		    while ( $cat_q->have_posts() ):
                $inside .= "<div class='$col'>";
				$cat_q->the_post();
				$inside .= vm_get_front_page_cat_card();
				$inside .= '</div>'; // class="$col"
			endwhile;
			wp_reset_postdata();
			$inside .= '</div></div>'; // class="container"
		endif;

	endif;
	// TODO: create options to set category icons.
    $icon = strtolower(substr($cat->name, 0, -1));
	$html .= <<<html
<div class="h-100 position-absolute category clearfix">
    <div class="tab position-absolute"><a href="#" class="vmi-$icon text-decoration-none">
        <p class="position-absolute">$cat->name</p>
    </a></div>
    <div class="content w-100"><h2>$cat->name</h2>$inside</div>
</div>
html;
endforeach;

?>
<div class="vh-100 vw-100 position-relative" id="welcome">
    <img src="<?php echo $path; ?>/assets/bin/img/welcome-img.jpg" class="d-block position-absolute w-100 h-100">
    <?php echo $html; ?>
</div>
<?php get_footer(); ?>
