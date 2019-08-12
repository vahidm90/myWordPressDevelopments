<?php


function snt_add_desc_mb() {
	global $snt_hct;

	foreach ( $snt_hct as $obj ) :
		$cb = (in_array($obj->name, array('region', 'topic'), TRUE) ? 'snt_ct_drop_down_mb' : 'snt_ct_radio_btn_mb');
		add_meta_box('catdiv-'.$obj->name,$obj->labels->singular_name,$cb,'post','normal','high',array('tax'=>$obj));
	endforeach;

	$ttl = _x( 'Default Terms', 'Title for default terms meta-box ', 'snt-en' );
	add_meta_box( 'def-terms-meta-box', $ttl, 'snt_def_terms_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Description', 'Title for description meta-box ', 'snt-en' );
	add_meta_box( 'desc-meta-box', $ttl, 'snt_desc_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Excerpt', 'Title for excerpt meta-box ', 'snt-en' );
	add_meta_box( 'postexcerpt', $ttl, 'snt_excerpt_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Recent Posts', 'Title for recent posts meta-box ', 'snt-en' );
	add_meta_box( 'recent-posts-meta-box', $ttl, 'snt_recent_posts_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Related Posts', 'Title for related meta-box ', 'snt-en' );
	add_meta_box( 'related-meta-box', $ttl, 'snt_related_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Source', 'Title for source meta-box ', 'snt-en' );
	add_meta_box( 'source-meta-box', $ttl, 'snt_source_mb', 'post', 'normal', 'low' );

	$ttl = _x( 'Display as Top', 'Title for Top meta-box ', 'snt-en' );
	add_meta_box( 'top-meta-box', $ttl,  'snt_top_mb', 'post', 'normal', 'low' );

}
add_action( 'add_meta_boxes_post', 'snt_add_desc_mb');


/**
 * Displays taxonomy meta-boxes with drop-downs
 *
 * @param WP_Post $post Current post
 *
 * @param array   $box {
 *     Meta-box arguments
 *     @type WP_Taxonomy Current taxonomy's data object
 * }
 *
 */
function snt_ct_drop_down_mb( WP_Post $post, array $box ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'taxonomy_' . $box['args']['tax']->name . '_mb_nonce' );

	$post_terms = wp_get_post_terms( $post->ID, $box['args']['tax']->name, array( 'fields' => 'ids' ) );
	$term_id = FALSE;

	if ( 'auto-draft' === $post->post_status ) :
		$term_id = get_option( "snt_def_{$box['args']['tax']->name}_user_" . get_current_user_id(), 0 );
    elseif ( ! ( $post_terms instanceof WP_Error ) && $post_terms && is_array( $post_terms ) ) :
		$term_id = join( $post_terms );
	endif;

	$str = ' '. _x( 'Select %1$s...', 'Taxonomy drop-down option; 1: Taxonomy archive label', 'snt-en' );
	$opt = sprintf( $str, $box['args']['tax']->labels->archives );
	$html = snt_ct_drop_down(
		array(
			'show_option_none'  => $opt,
			'option_none_value' => '',
			'orderby'           => 'name',
			'echo'              => FALSE,
			'hide_empty'        => FALSE,
			'selected'          => $term_id,
			'hierarchical'      => TRUE,
			'taxonomy'          => $box['args']['tax']->name,
			'hide_if_empty'     => FALSE,
			'attr'              => array( 'name' => 'sel_tax_' . $box['args']['tax']->name, 'required' => 'required' )
		)
    );

	echo '<label><span>', $box['args']['tax']->description, ': </span>', $html, '</label>';

}


/**
 * Displays taxonomy meta-boxes with radio buttons
 *
 * @param WP_Post $post Current post
 *
 * @param array   $box {
 *     Meta-box arguments
 *     @type WP_Taxonomy Current taxonomy's data object
 * }
 *
 */
function snt_ct_radio_btn_mb( $post, array $box ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'taxonomy_' . $box['args']['tax']->name . '_mb_nonce' );

	$post_terms = wp_get_post_terms( $post->ID, $box['args']['tax']->name, array( 'fields' => 'ids' ) );
	$term_id = FALSE;

	if ( 'auto-draft' === $post->post_status ) :
		$term_id = (int) get_option( "snt_def_{$box['args']['tax']->name}_user_" . get_current_user_id(), 0 );
    elseif ( ! ( $post_terms instanceof WP_Error ) && $post_terms && is_array( $post_terms ) ) :
		$term_id = (int) join( $post_terms );
	endif;

	$terms_args = array(
		'taxonomy'   => $box['args']['tax']->name,
		'orderby'    => 'term_group',
		'hide_empty' => FALSE,
		'childless'  => TRUE
	);
	$terms = get_terms( $terms_args );

	foreach ( $terms as $term ) :
		$attr = ( $term_id === $term->term_id ? 'checked ' : '' ) . "value='$term->term_id' type='radio' required";
        echo "<label><input name='sel_tax_{$box['args']['tax']->name}' $attr />$term->name</label><br />";
	endforeach;

}


/**
 * Displays Default Terms meta-box
 *
 */
function snt_def_terms_mb () {
	global $snt_nhct;
	$all = '';
	$ttl = '<i>' . _x( 'Taxonomy/Meta Defaults', 'Title for Taxonomy/Meta Defaults menu item', 'snt-en' ) . '</i>';
	$str = _x( 'You can change these settings in "%1$s".', 'Default Terms meta-box hint; 1: Menu title', 'snt-en' );
	$msg = _x( 'No default terms set!', 'Default Terms meta-box text', 'snt-en' );

	foreach ( $snt_nhct as $obj ) :
		$names = get_option( "snt_def_{$obj->name}s_user_" . get_current_user_id(), '' );
		if ( empty($names) ) :
			continue;
		endif;
		$out = '<b>' . (FALSE !== strpos($names, ',') ? $obj->labels->name : $obj->labels->singular_name) . '</b>: ';
		$out .= "<span class='def-nh-tax'>$names</span>";
		$all .= "<div class='div-def-nh-tax'>$out</div>";
	endforeach;

	$msg = empty( $all ) ? "<p class='howto'>$msg</p>" : "<p>$all</p>";
	
	echo $msg, '<p class="howto">', sprintf( $str, $ttl ), '</p>';

}


/**
 * Displays description meta-box
 *
 * @param WP_Post $post Current post object
 *
 */
function snt_desc_mb ( $post ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'desc_mb_nonce' );

	$msg = _x( 'Enter description (Used by search engines):', 'Description meta-box text', 'snt-en' ) . ' ';
	$txt = _x( 'Description... (155 characters max)', 'Description meta-box placeholder', 'snt-en' );
	$attr = "name='desc' required='required' rows='2' cols='40' placeholder='$txt' maxlength='155' id='desc'";

	echo "<p>$msg</p><textarea title='desc' $attr>",get_post_meta($post->ID,'desc_meta_data',TRUE),'</textarea>';

}


/**
 * Display post excerpt form fields.
 *
 * @param $post WP_Post Current post
 *
 */
function snt_excerpt_mb( $post ) {

	$msg = _x( 'Enter post excerpt (Summary of the post):', 'Excerpt meta-box text', 'snt-en' ) . ' ';
	$txt = _x( "Summary...", "Excerpt meta-box placeholder", 'snt-en' );
	$attr = "required='required' rows='2' cols='40' placeholder='$txt' id='excerpt' name='excerpt'";

	echo "<p>$msg</p><textarea title='excerpt' $attr>", esc_html( $post->post_excerpt), '</textarea>';

}


/**
 * Displays Recent Posts meta-box
 *
 * @param WP_Post $post Current post object
 *
 */
function snt_recent_posts_mb ( $post ) {

	$args = array(
		'ignore_sticky_posts' => TRUE,
		'no_found_rows'       => TRUE,
		'posts_per_page'      => 10,
		'post__not_in'        => array( $post->ID ),
		'author__in'          => array( get_current_user_id() ),
	);
	$recent = new WP_Query( $args );

	if ( $recent->have_posts() ) :
		?><table id="table-recent-posts">
		<thead>
        <tr>
            <th class="column-id"><?php _ex( 'ID', 'Recent Posts table column', 'snt-en' ); ?></th>
            <th class="column-title"><?php _ex( 'Title', 'Recent Posts table column', 'snt-en' ); ?></th>
            <th class="column-date"><?php _ex( 'Date', 'Recent Posts table column', 'snt-en' ); ?></th>
            <th class="column-img"><span class="dashicons dashicons-camera"></span></th>
            <th class="column-view"><span class="dashicons dashicons-visibility"></span></th>
            <th class="column-edit"><span class="dashicons dashicons-edit"></span></th>
            <th class="column-remove"><span  class="dashicons dashicons-trash"></span></th>
        </tr>
		</thead>
		<tbody><?php
		while ( $recent->have_posts() ) :

			$recent->the_post();

			?><tr>
                <td class="column-id"><?php the_ID(); ?></td>
                <td class="column-title"><?php the_title(); ?></td>
                <td class="column-date"><?php echo get_the_date( 'y/m/d' ); ?></td>
                <td class="column-img"><?php

                    if ( has_post_thumbnail() ) :
                        echo "<span class='dashicons dashicons-yes'></span>";
                    else :
                        echo "<span class='dashicons dashicons-no'></span>";
                    endif;

                ?></td>
                <td class="column-view">
                    <a href="<?php echo get_edit_post_link(); ?>" target="_blank" class="lnk-recent-posts-mb">
                        <span class="dashicons dashicons-visibility"></span>
                    </a>
                </td>
                <td class="column-edit">
                    <a href="<?php echo get_edit_post_link(); ?>" target="_blank" class="lnk-recent-posts-mb">
                        <span class="dashicons dashicons-edit"></span>
                    </a>
                </td>
                <td class="column-remove">
                    <a href="<?php echo get_delete_post_link(); ?>" class="lnk-recent-posts-mb">
                        <span  class="dashicons dashicons-trash"></span>
                    </a>
                </td>
			</tr><?php

		endwhile;
		wp_reset_postdata();
		?></tbody>
		</table><?php
	else :
		_ex( 'You have no posts yet!', 'No Recent Posts', 'snt-en' );
	endif;

}


/**
 * Displays Related Posts meta-box
 *
 * @param WP_Post $post Current post object
 *
 */
function snt_related_mb ( $post ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'related_mb_nonce' );

	$msg = _x( 'Enter related post\'s ID:', 'Related Posts meta-box text', 'snt-en' ) . ' ';
	$txt = _x( 'Post ID', 'Related meta-box placeholder', 'snt-en' );
	$attr = " type='number' id='add-related' autocomplete='off' min='1' placeholder='$txt' data-id='$post->ID'";
	$rel_now = get_post_meta( $post->ID, 'related_meta_data', TRUE );
	$class = ( empty( $rel_now ) ? '' : ' hide-txt' );
	$buttons = '';

	if ( ! empty( $rel_now ) ) :
		foreach ( explode( ',', $rel_now ) as $item ) :
            $item = (int) $item;
            $ttl = esc_attr( get_the_title( $item ) );
	        $buttons .= "<button class='cur-rel' value='$item' title='$ttl'>";
            $buttons .= "<span class='dashicons-before dashicons-no-alt'>$item</span>";
            $buttons .= '</button>';
		endforeach;
	endif;
	
	?><p><?php echo $msg; ?></p>
    <div id='div-add-related'><input title='add-related' <?php echo $attr; ?>/></div>
    <div id='cur-rel'>
        <input type='hidden' value='<?php echo $rel_now; ?>' name='related' id='related' /><?php
    	echo $buttons;
    	?><p class='howto<?php echo $class; ?>'><?php 
            _ex( 'No related posts assigned!', 'Related Posts meta-box text', 'snt-en' ); 
        ?></p>
    </div><?php

}


/**
 * Displays source meta-box
 *
 * @param WP_Post $post Current post object
 *
 */
function snt_source_mb ( $post ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'source_mb_nonce' );

	$n_l = _x( 'Name only', 'Source meta-box text', 'snt-en' );
	$u_l = _x( 'Name & URL', 'Source meta-box text', 'snt-en' );
	$n_p = _x( 'Site Name', 'Source meta-box placeholder', 'snt-en' );
	$u_p = _x( 'Page URL', 'Source meta-box placeholder', 'snt-en' );
	$n_a = " placeholder='$n_p' class='in-txt-src' required";
	$u_a = " data-row='0' placeholder='$u_p' class='url-src in-txt-src' disabled";
	$a_t = _x( 'Add more', 'Source meta-box button', 'snt-en' );
	$val = get_post_meta( $post->ID, 'source_meta_data', TRUE );
	$del_btn = '<span class="dashicons dashicons-dismiss"></span>';

    echo '<p>' . _ex( 'Enter source name (and optionally its address):', 'Source meta-box text', 'snt-en' ) . '</p>';

    if ( empty( $val ) ) :

        ?><input name="count-source" type="hidden" value="1" id="count-source">
        <div class='item-src' id="item-src-0" data-row="0">
            <label>
                <input type='radio' name="switch-src-0" value="1" class="switch-src enable-name" data-row="0" checked/>
                <span><?php echo $n_l; ?></span>
            </label>
            <br />
            <label>
                <input type='radio' name="switch-src-0" value="2" class="switch-src enable-url" data-row="0" />
                <span><?php echo $u_l; ?></span>
            </label>
            <br />
            <input name='source[0][name]' title="name-source-0" id="name-source-0" <?php echo $n_a; ?>/>
            <br />
            <input name='source[0][url]' title="url-source-0" id="url-source-0" <?php echo $u_a; ?>/>
            <br />
            <button type="button" class="del-src" data-row="0"><?php echo $del_btn; ?></button>
        </div><?php

    else :

        $html = '';
        $val_arr = array();
        if ( is_string( $val ) ) :
            $val_arr[0]['name'] = $val;
        else :
            $val_arr = $val;
        endif;
        foreach ( $val_arr as $key => $item ) :
            $html .= "<div class='item-src' id='item-src-$key' data-row='$key'>";

            $ttl = '';
            $n_r_attr = $u_r_attr = "data-row='$key' type='radio' name='switch-src-$key'";
	        $n_f_attr = "class='in-txt-src' value='" . esc_attr( $item['name'] ) . "' title='name-src-$key' required";
	        $n_r_attr .= ' value="1"';
	        $u_r_attr .= ' value="2"';
	        $chk = '';
	        $req = "data-row='$key' class='url-src in-txt-src' title='url-source-$key'";
	        $chk_n = 'checked';
	        if ( ! empty( $item['url'] ) ) :
                $chk = 'checked';
		        $req .= ' value="' . esc_attr( esc_url( $item['url'] ) ) . '" required';
		        $chk_n = '';
		        if ( ! empty( $item['ttl'] ) ) :
	                $ttl_attr = " class='ttl-src' title='ttl-source-$key' value='" . esc_attr( $item['ttl'] ) . "'";
                    $ttl = "<input type='hidden' name='source[$key][ttl]' id='ttl-source-$key' $ttl_attr/>";
                endif;
            else : 
                $req .= ' disabled'; 
            endif;

            $html .= "<label><input class='switch-src enable-name' $n_r_attr $chk_n/><span>$n_l</span></label><br />";
            $html .= "<label><input class='switch-src enable-url' $u_r_attr $chk/><span>$u_l</span></label><br />";
            $html .= "<input placeholder='$n_p' name='source[$key][name]' id='name-source-$key' $n_f_attr/><br />";
            $html .= "<input placeholder='$u_p' name='source[$key][url]' id='url-source-$key' $req/>$ttl<br />";
            $html .= "<button type='button' class='del-src' data-row='$key'>$del_btn</button>";

            $html .= "</div>";
        endforeach;
	    echo '<input type="hidden" value="' . count( $val_arr ) . '" id="count-source" name="count-source"/>';
	    echo $html;

    endif;

    ?><button type="button" id="add-src">
        <span class="dashicons-before dashicons-plus-alt"><?php echo $a_t; ?></span>
    </button><?php

}


/**
 * Displays Top meta-box
 *
 * @param WP_Post $post Current post object
 *
 */
function snt_top_mb ( $post ) {

	wp_nonce_field( 'snt_save_custom_post_data', 'top_mb_nonce' );
	
	$top = get_post_meta( $post->ID, 'top_meta_data', TRUE );
	$sel = FALSE;

	if ( 'auto-draft' === $post->post_status ) :
		$sel = get_option( 'snt_def_top_meta_user_' . get_current_user_id() );
	elseif ( $top && is_string( $top ) ) :
		$sel = $top;
	endif;

	$options = array(
		'region' => _x( 'Regions Top', 'Option in Top meta-box', 'snt-en' ),
		'topic'  => _x( 'Topics Top', 'Option in Top meta-box', 'snt-en' ),
		'none'   => _x( 'Non-top', 'Option in Top meta-box', 'snt-en' )
	);

	echo '<p>', _x( '(On front page) Display as:', 'Top meta-box text', 'snt-en' ), '</p>';

	foreach ( $options as $val => $txt ) :
		$attr = ( $sel === $val ? 'checked ' : '' ) . 'required';
	    echo "<label><input name='top' type='radio' value='$val' $attr /><span>$txt</span></label><br />";
	endforeach;

}


function snt_get_related_title () {
	global $wpdb;

	$rel_id = stripslashes( $_POST['rel_id'] );
	$sql = <<<QUERY
SELECT {$wpdb->posts}.post_title FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID = %s and {$wpdb->posts}.post_status = %s
QUERY;
	$f_p = $wpdb->get_results( $wpdb->prepare( $sql, $rel_id, 'publish' ) );

	if ( empty( $f_p ) ) :
		echo 'no posts found';
		die;
	endif;

	$f_p = $f_p[0];
	$f_p->post_title = esc_attr( $f_p->post_title );

	echo json_encode( $f_p );

	die;

}
add_action( 'wp_ajax_snt-show-related-title', 'snt_get_related_title' );


function snt_check_url(){

	if ( empty( $_POST['url'] ) || ! is_string( $_POST['url'] ) ) :
		echo 'no data received!';
		die;
	endif;

	$output = snt_get_page_info( esc_url( $_POST['url'] ) );

	if ( empty( $output['ttl'] ) || ! is_string( $output['ttl'] ) ) :
		echo 'url error!';
		die;
	endif;

	$output['esc_ttl'] = esc_attr( $output['ttl'] );

	echo json_encode( $output );
	die;

}
add_action( 'wp_ajax_snt-check-url', 'snt_check_url' );
