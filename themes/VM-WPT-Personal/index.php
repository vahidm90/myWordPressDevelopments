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
	$inside = '';
	if ( is_array( $children ) ) :
    foreach ($children as $child_id ) :
        $child = get_category( $child_id );
    endforeach;
    endif;
    $html .= <<<html
<div class="h-100 position-absolute category">
    <div class="tab position-absolute"><a href="#"><h2>$cat->name</h2></a></div>
    <div class="content"></div>
</div>
html;
endforeach;

?>
<div class="vh-100 vw-100 position-relative" id="welcome">
    <img src="<?php echo $path; ?>/assets/bin/img/welcome-img.jpg" class="d-block position-absolute w-100 h-100">
    <?php echo $html; ?>
</div>
<?php get_footer(); ?>
