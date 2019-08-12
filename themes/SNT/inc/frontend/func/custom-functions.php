<?php


function snt_doc_title( $ttl ) {
	global $id, $snt_lang, $snt_supported_lang, $term, $taxonomy, $day, $month, $monthnum, $year, $snt_comma;

	$suf = ' | ' . get_bloginfo();

	switch ( 1 ) :
		default :
			return ( FALSE !== strpos( $ttl, get_bloginfo() ) ? $ttl . $suf : $ttl );
		case ( is_front_page() ) :
			return get_bloginfo() . ' — ' . get_bloginfo( 'description' );
			break;
		case ( is_page( $snt_supported_lang[ $snt_lang ]['page-id'] ) ) :
			return _x( 'Glossary', 'Document title', 'snt-en' ) . ' — ' . get_the_title( $id ) . $suf;
			break;
		case ( is_single() ) :
			return esc_html( get_the_title( $id ) ) . $suf;
			break;
		case ( is_archive() ) :

			if ( is_date() ) :

				$str = "$year";

				if ( is_day() ) :
					$str = "$day " . $month[ 10 > $monthnum ? "0$monthnum" : "$monthnum" ] . "$snt_comma $str";
				elseif ( is_month() ) :
					$str = $month[ 10 > $monthnum ? "0$monthnum" : "$monthnum" ] . " $str";
				endif;

				return _x( 'Date Archives', 'Document title', 'snt-en' ) . ": $str$suf";

			endif;

			$term_obj = get_term_by( 'slug', $term, $taxonomy );
			$tax_obj = get_taxonomy( $taxonomy );
			$str = _x( '%1$s Archives', 'Document title; 1: Taxonomy singular name' , 'snt-en' );

			return sprintf( $str, $tax_obj->labels->singular_name ) . ": $term_obj->name$suf";

			break;
	endswitch;

}
add_filter( 'pre_get_document_title', 'snt_doc_title' );


function snt_custom_archive_query( WP_Query $query ) {
	if (
		! $query->is_main_query() ||
		! $query->is_search() ||
		( $query->is_archive() && ! $query->is_date && ! $query->is_tax )
	) :
		return;
	endif;

	$query->set( 'posts_per_page', 20 );
	$query->set( 'ignore_sticky_posts', TRUE );

}
add_action( 'pre_get_posts', 'snt_custom_archive_query' );


function snt_get_roll_posts () {

	if ( empty( $_POST['roll'] ) || ! in_array( $_POST['roll'], array( 'hot', 'lat' ), TRUE ) ) :
		echo 'fatal error';
		die;
	endif;

	global $snt_supported_lang, $snt_lang;

	$roll = array( 'count' => 20, 'time' => 24, 'roll' => 'rol-n' );
	if ( 'hot' === $_POST['roll'] ) :
		$roll['count'] = 5;
		$roll['time'] = 3;
		$roll['roll'] = 'rol-h';
	endif;
	$q_args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'post_status'         => 'publish',
		'post_type'           => 'post',
		'posts_per_page'      => $roll['count'],
		'date_query'          => array( 'after' => '@' . ( time() - ( $roll['time'] * 3600 ) ) ),
		'tax_query'           => array(
			array( 'taxonomy' => 'roll', 'terms' => $snt_supported_lang[ $snt_lang ]['term-id'][ $roll['roll'] ] ),
			array( 'taxonomy' => 'designation', 'terms' => $snt_supported_lang[ $snt_lang ]['term-id']['des-n'] ),
			'relation' => 'AND'
		)
	);
	$roll = new WP_Query( $q_args );
	$hot = array();

	if ( $roll->have_posts() ) :

		while ( $roll->have_posts() ) :

			$roll->the_post();

			$hot[ $roll->current_post ]['lnk'] = get_the_permalink();
			$hot[ $roll->current_post ]['ttl'] = esc_html( get_the_title() );

		endwhile;

		wp_reset_postdata();

	else :

		echo 'no posts found';
		die;

	endif;

	echo json_encode( $hot );

	die;

}
add_action( 'wp_ajax_nopriv_snt-get-roll', 'snt_get_roll_posts' );
add_action( 'wp_ajax_snt-get-roll', 'snt_get_roll_posts' );


/**
 * Retrieves (and displays) post's tag list markup
 *
 * @param  string $tax   Taxonomy
 *
 * @param  array  $terms Taxonomy terms
 *
 * @param  array  $args {
 *     Tag list parameters
 *     @type bool   $echo            Whether to echo HTML markup
 *     @type string $sep             Separator to use between each list item
 *     @type string $before_each_lnk String to use after opening '< a >' tag of each list item
 *     @type string $after_each_lnk  String to use before closing '< a >' tag of each list item
 *     @type array  $lnk_attr        Array of 'attribute' => 'value' pairs to use in '< a >' tag of each list item
 * }
 *
 * @return string        Tags HTML
 *
 */
function snt_get_tag_list( string $tax, array $terms, array $args = array() ) {

	switch ( $tax ) :
		case 'character' :
			$icon = 'user';
			break;
		case 'state' :
			$icon = 'flag';
			break;
		default :
			$icon = 'price-tag';
			break;
	endswitch;
	$def = array(
		'echo'            => FALSE,
		'sep'             => ' ',
		'before_each_lnk' => "<span class='snt-icon-before snt-$icon tag $tax no-wrap'>",
		'after_each_lnk'  => '</span>',
		'lnk_attr'        => array()
	);
	$args = wp_parse_args( $args, $def );
	$attr = '';
	if ( ! isset( $args['lnk_attr']['rel'] ) ) :
		$args['lnk_attr']['rel'] = 'tag';
	endif;
	foreach ( $args ['lnk_attr'] as $key => $val ) :
		$attr .= "$key='" . esc_attr( $val ) . "'";
	endforeach;
	$links = array();
	foreach ( $terms as $term ) :
		$lnk = esc_url( get_term_link( $term, $tax ) );
		if ( $lnk instanceof WP_Error ) :
			continue;
		endif;
		$links[] = "<a href='$lnk' $attr>{$args['before_each_lnk']}$term->name{$args['after_each_lnk']}</a>";
	endforeach;

	$html = join( $args['sep'], $links );

	if ( $args['echo'] ) :
		echo $html;
	endif;

	return $html;

}


/**
 * Retrieves (and displays) post's relative publication time.
 *
 * @param bool $echo    Whether to echo the output
 *
 * @return false|string Publication time
 *
 */
function snt_get_time ( bool $echo = FALSE ) {
	global $id;

	$pub = get_the_time( 'U', $id );
	if ( ! $pub ) :
		return FALSE;
	endif;

	$now = time();
	$l_m = strtotime( 'last min' );
	$l_h = strtotime( 'last hour' );
	$l_t = strtotime( 'today');
	$l_d = strtotime( 'yesterday' );
	$l_w = strtotime( 'last week' );

	switch ( TRUE ) :
		default :
			$output = get_the_date( 'j M Y', $id );
			break;
		case ( strtotime( 'last year' ) < $pub && $l_w > $pub ) :
			$output = get_the_date( 'j F', $id );
			break;
		case ( $l_w < $pub && $l_d > $pub ) :
			$output = get_the_time( 'l g:ia', $id );
			break;
		case ( $l_d < $pub && $l_t > $pub ) :
			$output = _x( 'Yesterday', 'Publish time', 'snt-en' ) . get_the_time( ' g:ia' );
			break;
		case ( $l_t < $pub && $l_h > $pub ) :
			$hrs    = intval( ( $now - $pub ) / 3600 );
			$output = _nx( 'An hour ago', '%1$s hours ago', $hrs, 'Publish time; 1: Hours passed', 'snt-en' );
			$output = sprintf( $output, number_format_i18n( $hrs ) );
			break;
		case ( $l_h < $pub && $l_m > $pub ) :
			$min    = intval( ( $now - $pub ) / 60 );
			$output = _nx( 'A minute ago', '%1$s minutes ago', $min, 'Publish time; 1: Minutes passed', 'snt-en' );
			$output = sprintf( $output, number_format_i18n( $min ) );
			break;
		case ( $l_m < $pub ) :
			$output = _x( 'Less than a minute ago', 'Publish time', 'snt-en' );
			break;
	endswitch;

	if ( $echo ) :
		echo $output;
	endif;

	return $output;

}


/**
 * Retrieves adjacent daily archives that have posts
 *
 * @param  array $date {
 *     Base Time
 *     int $day   Day of the month
 *     int $month Month of the year
 *     int $year  Year number
 * }
 *
 * @return array Links to archive pages
 *
 */
function snt_adjacent_days ( array $date ) {

	$lnk = array();
	$format = array( 'day' => 'j', 'month' => 'n', 'year' => 'Y' );

	foreach ( array( 'yesterday', 'tomorrow' ) as $dir ) :
		$i = 0;
		$d_q = array();
		$pcd = strtotime( "{$date['year']}-{$date['month']}-{$date['day']}" );
		$interval = 0;
		while ( 5 > $i ) :
			if ( 30 < $interval ) :
				break;
			endif;
			$c_d = strtotime( "$dir", $pcd );
			if ( date( 'F', $pcd ) !== date( 'F', $c_d ) ) :
				break;
			endif;
			foreach ( $date as $key => $value ) :
				$d_q[ $key ] = (int) date( $format[ $key ], $c_d );
			endforeach;
			$q_a = array( 'ignore_sticky_posts' => TRUE, 'no_found_rows' => TRUE, 'date_query' => $d_q );
			$f_p = new WP_Query( $q_a );
			$pcd = $c_d;
			$interval++;
			if ( 0 < $f_p->found_posts ) :
				$lnk[ $c_d ]['lnk'] = get_day_link( $d_q['year'], $d_q['month'], $d_q['day'] );
				$lnk[ $c_d ]['count'] = $f_p->found_posts;
				$i++;
			endif;
		endwhile;
	endforeach;

	return $lnk;

}


/**
 * Retrieves adjacent monthly archives that have posts
 *
 * @param  array $date {
 *     Base Time
 *     int $month Month of the year
 *     int $year  Year number
 * }
 *
 * @return array Links to archive pages
 *
 */
function snt_adjacent_months ( array $date ) {

	$lnk = array();
	$format = array( 'month' => 'n', 'year' => 'Y' );

	foreach ( array( 'last month', 'next month' ) as $dir ) :
		$i = 0;
		$d_q = array();
		$pcd = strtotime( "{$date['year']}-{$date['month']}-1" );
		$interval = 0;
		while ( 5 > $i ) :
			if ( 11 < $interval ) :
				break;
			endif;
			$c_d = strtotime( $dir, $pcd );
			if ( date( 'Y', $pcd ) !== date( 'Y', $c_d ) ) :
				break;
			endif;
			foreach ( $date as $key => $value ) :
				$d_q[ $key ] = (int) date( $format[ $key ], $c_d );
			endforeach;
			$q_a = array( 'ignore_sticky_posts' => TRUE, 'no_found_rows' => TRUE, 'date_query' => $d_q );
			$f_p = new WP_Query( $q_a );
			$pcd = $c_d;
			$interval++;
			if ( 0 < $f_p->found_posts ) :
				$lnk[ $c_d ]['lnk'] = get_month_link( $d_q['year'], $d_q['month'] );
				$lnk[ $c_d ]['count'] = $f_p->found_posts;
				$i++;
			endif;
		endwhile;
	endforeach;

	return $lnk;

}


/**
 * Retrieves adjacent yearly archives that have posts
 *
 * @param  array $date {
 *     Base Time
 *     int $year  Year number
 * }
 *
 * @param  bool $all  Whether to retrieve all yearly archives
 *
 * @return array      Links to archive pages
 *
 */
function snt_adjacent_years ( array $date, $all = FALSE ) {

	$lnk = array();
	$dir = ( $all ? array( 'last year' ) : array( 'last year', 'next year' ) );
	$limit = 5;
	$format = array( 'year' => 'Y' );

	foreach ( $dir as $inc ) :
		$i = 0;
		$d_q = array();
		$pcd = strtotime( "{$date['year']}-1-1" );
		$interval = 0;
		while ( $limit > $i ) :
			if ( $limit < $interval ) :
				break;
			endif;

			$c_d = strtotime( $inc, $pcd );
			foreach ( $date as $key => $value ) :
				$d_q[ $key ] = (int) date( $format[ $key ], $c_d );
			endforeach;
			$q_a = array( 'ignore_sticky_posts' => TRUE, 'no_found_rows' => TRUE, 'date_query' => $d_q );

			$f_p = new WP_Query( $q_a );
			$pcd = $c_d;
			$interval++;

			if ( $count = $f_p->found_posts ) :
				$lnk[ $c_d ]['lnk'] = get_year_link( $d_q['year'] );
				$lnk[ $c_d ]['count'] = $count;
				$i++;
			elseif ( $all ) :
				break;
			endif;

		endwhile;

	endforeach;

	return $lnk;

}


/**
 * Retrieves HTML for breadcrumbs navigation
 *
 * @param  array  $args   Levels to include in breadcrumbs
 *
 * @return string         Breadcrumbs HTML
 *
 */
function snt_get_bread_crumbs ( array $args = array() ) {
//TODO: Implement Breadcrumbs RDFa and MicroData
	global $snt_dir_r, $snt_lang, $snt_supported_lang;

	$url = get_home_url();
	$dir = "dir='{$snt_supported_lang[ $snt_lang ]['direction']}'";
	$home = _x( 'Home', 'Navigation text', 'snt-en' );
	$home = "<span class='snt-icon snt-home3'> </span><span class='d-a-i-gt-l2'>$home</span>";
	$home = "<a href='$url' $dir class='bc-item'>$home</a>";
	if ( empty ( $args ) || ! is_array( $args ) ) :
		return $home . "<span $dir class='bc-sep snt-icon snt-filled-caret-$snt_dir_r'></span>";
	endif;
	$output = array( $home );
	if ( ! empty( $args['archive'] ) && $args['archive'] ) :
		$url = get_the_permalink( $snt_supported_lang[ $snt_lang ]['page-id']['archives'] );
		$arch = _x( 'Archives', 'Breadcrumbs text', 'snt-en' );
		$arch = "<span class='snt-icon snt-books d-a-i-st-l3'> </span><span class='d-a-i-gt-l2'>$arch</span>";
		$output[] = "<a href='{$url}' $dir class='bc-item'>$arch</a>";
	endif;
	if ( empty( $args['levels'] ) || ! is_array( $args['levels'] ) ) :
		$icon = " snt-icon snt-filled-caret-$snt_dir_r";
		return join( "<span $dir class='bc-sep$icon'></span>", $output ) . "<span class='bc-sep$icon'></span>";
	endif;
	foreach ( $args['levels'] as $key => $val ) :
		$val['url'] = esc_url( (string) $val['url'] );
		$val['txt'] = esc_html( (string) $val['txt'] );
		switch ( $key ) :
			default :
				$icon = ' snt-books';
				break;
			case 'year' :
			case 'month' :
				$icon = ' snt-calendar';
				break;
			case 'designation' :
				$icon = ' snt-drawer';
				break;
			case 'region' :
				$icon = ' snt-location2';
				break;
			case 'topic' :
				$icon = ' snt-folder-open';
				break;
		endswitch;
		$html = "<span class='snt-icon$icon d-a-i-st-l3'> </span><span class='d-a-i-gt-l2'>{$val['txt']}</span>";
		$term = '';
		if ( ! empty( $val['term'] ) ) :
			$lnk = get_term_link( $val['term']['id'], $key );
			$term = '<span class="d-a-i-gt-l2">: </span>';
			$term .= "<a href='$lnk' $dir class='bc-item no-wrap'><span>{$val['term']['ttl']}</span></a>";
		endif;
		$output []= "<a href='{$val['url']}' $dir class='bc-item no-wrap'>$html</a>$term";
	endforeach;

	$icon = " snt-icon snt-filled-caret-$snt_dir_r";

	return join( "<span $dir class='bc-sep$icon'></span>", $output ) . "<span $dir class='bc-sep$icon'></span>";

}


/**
 * Retrieves (and displays) archive pagination links
 *
 * @param  bool   $echo Whether to echo pagination markup
 *
 * @return string       Pagination HTML markup
 */
function snt_archive_pagination ( $echo = FALSE ){
	global $wp_rewrite, $wp_query, $snt_dir, $snt_dir_r, $snt_1_2, $snt_2_1;

	$total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	if ( 2 > $total ) :
		return '';
	endif;
	$p_txt = _x( 'Page %1$d of %2$d', 'Pagination; 1: Current page, 2: Total pages', 'snt-en' );
	$i_txt = _x( 'Items %3$d-%4$d', 'Pagination; %3$d- 4: Interval', 'snt-en' );
	$txt_prv  = '<span>' . _x( 'Previous', 'Pagination', 'snt-en' ) . '</span>';
	$txt_nxt  = '<span>' . _x( 'Next', 'Pagination', 'snt-en' ) . '</span>';
	$icon_prv = "<span class='snt-icon snt-double-outlined-caret-$snt_dir'></span>";
	$icon_nxt = "<span class='snt-icon snt-double-outlined-caret-$snt_dir_r'></span>";
	$prv = sprintf( "<div class='btn'>$snt_2_1</div>", $txt_prv, $icon_prv );
	$nxt = sprintf( "<div class='btn'>$snt_1_2</div>", $txt_nxt, $icon_nxt );
	$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$ppp = $wp_query->query_vars['posts_per_page'];
	$tot_post = (int) $wp_query->found_posts;
	$first = ( ( $current - 1 ) * $ppp ) + 1;
	$last  = ( $total === $current ? $tot_post : min( $current * $ppp, $tot_post ) );
	$item  = ( 1 < $wp_query->post_count ? $i_txt : _x( 'Last item', 'Pagination', 'snt-en' ) );
	$str = $p_txt . ' — ' . $item . ' ' . _x( '(Total Items: %5$d)', 'Pagination; 5: Item count', 'snt-en' );
	$txt = sprintf( $str, $current, $total, $first, $last, $tot_post );
	$p_lnk = html_entity_decode( get_pagenum_link() );
	$url_parts = explode( '?', $p_lnk );
	$p_lnk = trailingslashit( $url_parts[0] ) . '%_%';
	$format = ( $wp_rewrite->using_index_permalinks() && ! strpos( $p_lnk, 'index.php' ) ? 'index.php/' : '' );
	$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
	$links = '';
	$dots = false;
	$add_args = array();
	if ( isset( $url_parts[1] ) ) :
		$format_arr = explode( '?', str_replace( '%_%', $format, $p_lnk ) );
		$format_query = isset( $format_arr[1] ) ? $format_arr[1] : '';
		wp_parse_str( $format_query, $format_args );
		wp_parse_str( $url_parts[1], $url_query_args );
		foreach ( $format_args as $format_arg => $format_arg_value ) :
			unset( $url_query_args[ $format_arg ] );
		endforeach;
		$add_args = urlencode_deep( $url_query_args );
	endif;
	if ( $current && 1 < $current ) :
		$link = str_replace( '%_%', 2 === $current ? '' : $format, $p_lnk );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args ) : 
			$link = add_query_arg( $add_args, $link );
		endif;
		$link = esc_url( $link );
		$links .= "<a href='$link' rel='prev' class='page-nav prev'>$prv</a>";
	endif;
	if ( 'left' === $snt_dir ) :
		for ( $n = 1; $total >= $n; $n++ ) :
			if ( $n === $current ) :
				$links .= "<span class='page-no current'>" . number_format_i18n( $n ) . "</span>";
				$dots = true;
			else :
				if ( ( $n <= 1 || ( $current && $n >= $current - 3 && $n <= $current + 3 ) || $n > $total - 1 ) ) :
					$link = str_replace( '%_%', 1 == $n ? '' : $format, $p_lnk );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args ) :
						$link = add_query_arg( $add_args, $link );
					endif;
					$link = esc_url( $link );
					$links .= "<a class='page-no' href='$link'><span>" . number_format_i18n( $n ) . "</span></a>";
					$dots = true;
				elseif ( $dots ) :
					$links .= '<span class="page-numbers dots">&hellip;</span>';
					$dots = false;
				endif;
			endif;
		endfor;
	else :
		for ( $n = $total; 0 < $n; $n-- ) :
			if ( $n === $current ) :
				$links .= "<span class='page-no current'>" . number_format_i18n( $n ) . "</span>";
				$dots = true;
			else :
				if ( ( $n <= 1 || ( $current && $n >= $current - 3 && $n <= $current + 3 ) || $n > $total - 1 ) ) :
					$link = str_replace( '%_%', 1 == $n ? '' : $format, $p_lnk );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args ) :
						$link = add_query_arg( $add_args, $link );
					endif;
					$link = esc_url( $link );
					$links .= "<a class='page-no' href='$link'><span>" . number_format_i18n( $n ) . "</span></a>";
					$dots = true;
				elseif ( $dots ) :
					$links .= '<span class="page-numbers dots">&hellip;</span>';
					$dots = false;
				endif;
			endif;
		endfor;
	endif;
	if ( $current && $current < $total ) :
		$link = str_replace( '%_%', $format, $p_lnk );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args ) :
			$link = add_query_arg( $add_args, $link );
		endif;
		$link = esc_url( $link );
		$links .= "<a href='$link' rel='next' class='page-nav next'>$nxt</a>";
	endif;
	
	$html = '<div class="pagination"><div class="container"><div class="row">';

	$html .= "<div class='col-sn-12'><div class='txt'>$txt</div></div>";
	$html .= "<div class='col-sn-12'><div class='links'>$links</div></div>";

	$html .= '</div></div></div>';

	if ( $echo ) :
		echo $html;
	endif;

	return $html;

}


/**
 * Formats and prepares tag cloud
 *
 * @param  array $tags { Array of taxonomy term objects }
 *
 * @param  array $args {
 *     Array of tag cloud arguments
 *     @type int     $smallest Minimum item size
 *     @type int     $largest  Maximum item size
 *     @type string  $unit     CSS size unit
 * }
 *
 * @param  bool  $echo
 *
 * @return string
 *
 */
function snt_generate_tag_cloud( $tags, $args, $echo = FALSE ) {
	if ( empty( $tags ) ) :
		return '';
	endif;

	$defaults = array(
		'smallest'   => 50,
		'largest'    => 100,
		'unit'       => '%',
	);
	$args = wp_parse_args( $args, $defaults );

	shuffle( $tags );
	$counts = array();
	foreach ( (array) $tags as $key => $tag ) :
		$counts[ $key ] = default_topic_count_scale( $tag->count );
	endforeach;
	$min_count = min( $counts );
	$spread = max( $counts ) - $min_count;
	if ( $spread <= 0 ) :
		$spread = 1;
	endif;
	$font_spread = $args['largest'] - $args['smallest'];
	if ( $font_spread < 0 ) :
		$font_spread = 1;
	endif;
	$font_step = $font_spread / $spread;
	$tags_data = array();
	foreach ( $tags as $key => $tag ) :
		$tag_id = isset( $tag->id ) ? $tag->id : $key;
		$count = $counts[ $key ];
		$tags_data[] = array(
			'id'              => $tag_id,
			'url'             => ( '#' !== $tag->link ? $tag->link : '#' ),
			'name'            => $tag->name,
			'slug'            => $tag->slug,
			'font_size'       => $args['smallest'] + ( $count - $min_count ) * $font_step,
		);
	endforeach;
	$a = array();
	foreach ( $tags_data as $key => $tag_data ) :
		$a[] = sprintf(
			'<a href="%1$s" style="font-size: %2$s;"><span class="no-wrap">%3$s</span></a>',
			esc_url( $tag_data['url'] ),
			esc_attr( str_replace( ',', '.', $tag_data['font_size'] ) . $args['unit'] ),
			esc_html( $tag_data['name'] )
		);
	endforeach;
	$output = join( ' ', $a );

	if ( $echo ) :
		echo $output;
	endif;

	return $output;

}


/**
 * Retrieves (and displays) tag cloud for a given taxonomy
 *
 * @param  string      $tax Taxonomy
 *
 * @param  array       $args {
 *     Array of tag cloud arguments
 *     @type int     $smallest Minimum item size
 *     @type int     $largest  Maximum item size
 *     @type string  $unit     CSS size unit
 *     @type boolean $echo     Whether to echo the output
 * }
 *
 * @return bool|string      False if any error occurs, tag cloud HTML markup otherwise
 *
 */
function snt_tag_cloud( $tax = '', $args = array() ) {
	if ( empty( $tax ) || ! is_string( $tax ) || ! get_taxonomy( $tax ) ) :
		return FALSE;
	endif;

	$defaults = array(
		'smallest'   => 50,
		'largest'    => 100,
		'unit'       => '%',
		'echo'       => TRUE,
	);
	$args = wp_parse_args( $args, $defaults );
	$tags = get_terms( $tax );

	if ( empty( $tags ) || $tags instanceof WP_Error ) :
		return FALSE;
	endif;

	foreach ( $tags as $key => $tag ) :
		$link = get_term_link( intval( $tag->term_id ), $tag->taxonomy );
		if ( $link instanceof WP_Error ) :
			return FALSE;
		endif;
		$tags[ $key ]->link = $link;
		$tags[ $key ]->id = $tag->term_id;
	endforeach;

	$return = snt_generate_tag_cloud( $tags, $args );

	if ( $args['echo'] )
		echo $return;

	return $return;

}