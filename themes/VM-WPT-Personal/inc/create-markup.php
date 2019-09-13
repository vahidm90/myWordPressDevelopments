<?php

function vm_get_front_page_cat_card() {
	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '"><div class="card">';
	if ( has_post_thumbnail() ) :
		$img    = get_the_post_thumbnail_url();
		$alt    = get_the_post_thumbnail_caption();
		$html .= "<img src='$img' alt='$alt' class='card-img-top' />";
	endif;

	return $html . '<div class="card-body"><p class="post-ttl card-title">' . get_the_title() . '</p></div></div></a>';

}

function vm_get_front_page_cat_collapsible() {
	$html = '<a href="' . get_the_permalink() . '" class="' . implode( ' ', get_post_class() ) . '">';

	return $html . '<p class="post-ttl">' . get_the_title() . '</p></a>';

}
