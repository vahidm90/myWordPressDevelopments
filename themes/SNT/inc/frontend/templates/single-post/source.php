<?php

$src = get_post_meta( $id, 'source_meta_data', TRUE );
$src_arr = array();
$hd = _x( 'External References', 'Source heading', 'snt-en' );
$desc = _x( 'For this story, we would like to thank', 'Source introduction', 'snt-en' ) . ':';
$html = '';

if ( is_string( $src ) ) :
	foreach ( explode( ',', $src ) as $entry ) :
		$src_arr []= array( 'name' => $entry );
	endforeach;
else :
	$src_arr = $src;
endif;

if ( empty( $src_arr ) ) :
	return;
endif;

$html = '<section class="card" id="src-post"><div class="container"><div class="row">';

$html .= "<div class='col-sn-12'><a href='#src-post'><h2>$hd</h2></a></div>";
$html .= "<div class='col-sn-12'><p>$desc</p></div>";

foreach ( $src_arr as $entry ) :
	$html .= "<div class='col-sn-12'>";

	$ttl = $icon = '';
	if ( ! empty( $entry['url'] ) ) :
		$ttl = empty( $entry['ttl'] ) ? '' : " — <span class='ttl-src'>{$entry['ttl']}</span>";
	endif;
	if ( empty( $ttl ) ) :
		$open = "<div class='item-src'>";
		$close = "</div>";
	else :
		$icon = ' <span class="snt-icon snt-share"></span>';
		$open = "<a href='{$entry['url']}' rel='external' target='_blank'><div class='item-src'>";
		$close = "</div></a>";
	endif;
	$html .= "$open<span class='name-src'>{$entry['name']}</span>$ttl$icon$close";

	$html .= "</div>";
endforeach;

$html .= '</div></div></section>';

echo $html;