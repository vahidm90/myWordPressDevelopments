<?php


function snt_sanitize_commenter_tel( $data ) {
	$data[] = preg_replace('/[^0-9]/', '', $_POST['tel']);
	return $data;
}
add_filter( 'preprocess_comment', 'snt_sanitize_commenter_tel' );


function snt_add_commenter_tel( $c_id ) {
	if ( ! isset( $_POST['tel'] ) ) :
		return;
	endif;

	$in = esc_attr( wp_unslash( $_POST['tel'] ) );
	add_comment_meta( $c_id, 'phone_comment_meta_data', $in );
	setcookie( 'comment_author_tel_' . COOKIEHASH, $in, strtotime( '+1 year' ), COOKIEPATH, COOKIE_DOMAIN );

}
add_action( 'comment_post', 'snt_add_commenter_tel' );


function snt_get_commenter_tel( $data ) {
	if ( empty( $_COOKIE[ 'comment_author_tel_' . COOKIEHASH ] ) ) :
		return $data;
	endif;

	$data['comment_author_tel'] = $_COOKIE[ 'comment_author_tel_' . COOKIEHASH ];

	return $data;

}
add_filter( 'wp_get_current_commenter', 'snt_get_commenter_tel' );


/**
 * Generates semantic classes for each comment element
 *
 * @param string|array   $class      One or more classes to add to the class list, defaults to empty
 *
 * @param int|WP_Comment $comment_id Comment ID or WP_Comment object, defaults to current comment
 *
 * @param bool           $echo       Whether to cho or return the output
 *
 * @return string                    `class` attribute and the classes
 *
 */
function snt_comment_class( $class = '', $comment_id = NULL, $echo = TRUE ) {
	global $comment_alt, $comment_depth, $comment_thread_alt;

	$comment = get_comment( $comment_id );
	if ( ! $comment ) :
		return '';
	endif;
	$classes = array();
	$classes[] = ( empty( $comment->comment_type ) ) ? 'comment' : $comment->comment_type;
	if ( empty( $comment_alt ) ) :
		$comment_alt = 0;
	endif;
	if ( empty( $comment_depth ) ) :
		$comment_depth = 1;
	endif;
	if ( empty( $comment_thread_alt ) ) :
		$comment_thread_alt = 0;
	endif;
	if ( $comment_alt % 2 ) :
		$classes[] = 'odd';
		$classes[] = 'alt';
	else :
		$classes[] = 'even';
	endif;
	$comment_alt++;
	if ( 1 == $comment_depth ) :
		if ( $comment_thread_alt % 2 ) :
			$classes[] = 'thread-odd';
			$classes[] = 'thread-alt';
		else :
			$classes[] = 'thread-even';
		endif;
		$comment_thread_alt++;
	endif;
	$classes[] = "d-$comment_depth";
	if ( ! empty( $class ) ) :
		$class = ( is_array( $class ) ? $class : preg_split('#\s+#', $class) );
		$classes = array_merge($classes, $class);
	endif;
	$class = ' class="' . join( ' ', $classes ) . '"';
	if ( $echo ) :
		echo $class;
	endif;

	return $class;

}


/**
 * Retrieve HTML content for reply to comment link.
 *
 * @param  array          $args {
 *     Reply link arguments
 *     @type string $add_below  Used as '$add_below-$comment->comment_ID' to identify the comment being responded
 *     @type string $respond_id Selector identifying the responding comment, is appended to response URL as hash value
 *     @type string $reply_text Reply link text, defaults to 'Reply'
 *     @type int    $max_depth  Max depth of comment tree, defaults to 0
 *     @type int    $depth      Response depth, defaults to 0
 *     @type string $before     Content to add before reply link, defaults to empty
 *     @type string $after      Content to add after reply link, defaults to empty
 *     @type bool   $echo       Whether to echo link
 * }
 *
 * @param  int|WP_Comment $comment Comment being replied to, defaults to current comment
 *
 * @param  int|WP_Post    $post    Post ID or WP_Post object ,defaults to current post
 *
 * @return false|string            Link to show comment form, if successful; false otherwise
 *
 */
function snt_comment_reply_lnk( $args = array(), $comment = null, $post = null ) {

	$defaults = array(
		'add_below'     => 'cm',
		'respond_id'    => 'new-cm',
		'reply_text'    => '<span class="snt-icon snt-reply"></span>',
		'max_depth'     => 0,
		'depth'         => 0,
		'before'        => '<div class="col-sn-12"><div class="rep-cm opp-float">',
		'after'         => '</div></div>',
		'echo'          => TRUE
	);
	$args = wp_parse_args( $args, $defaults );
	if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] ) :
		return FALSE;
	endif;
	$comment = get_comment( $comment );
	if ( empty( $post ) ) :
		$post = $comment->comment_post_ID;
	endif;
	$post = get_post( $post );
	if ( ! comments_open( $post->ID ) ) :
		return FALSE;
	endif;

	$lnk = esc_url( add_query_arg( 'replytocom', $comment->comment_ID, get_permalink( $post->ID ) ) );
	$lnk .= "#{$args['respond_id']}";
	$str = 'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )';
	$o_c = sprintf( $str, $args['add_below'], $comment->comment_ID, $args['respond_id'], $post->ID );
	$str = '<a rel="nofollow" href="%1$s" onclick="%2$s">%3$s</a>';
	$lnk = $args['before'] . sprintf( $str, $lnk, $o_c, $args['reply_text'] ) . $args['after'];

	if ( $args['echo'] ) :
		echo $lnk;
	endif;

	return $lnk;

}


function snt_comment_form( $post_id = null ) {
	if ( null === $post_id ) :
		$post_id = get_the_ID();
	endif;
	if ( ! comments_open( $post_id ) ) :
		return;
	endif;

	global $comment;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$req_fields = get_option( 'require_name_email' );
	$cm_id = isset($_GET['replytocom']) ? (int) $_GET['replytocom'] : 0;
	if ( ! $cm_id ) : 
		$ttl = _x( 'Your Remark', 'Comment form title', 'snt-en' );
	else :
		$comment = get_comment( $cm_id );
		$ttl = "<a href='#comment-$cm_id'>" . get_comment_author( $cm_id ) . '</a>'; 
		$ttl = sprintf( _x( 'Reply to %1$s', 'Comment form title; 1: Replied comment\'s author', 'snt-en' ), $ttl );
	endif;
	$l_i_a = _x( 'Leave a comment as %1$s', 'Comment form message; 1: User identity, 2: Log-out link', 'snt-en' );
	$al_tag = allowed_tags();
	$al_tag_msg = _x( 'Following %1$s tags are allowed', 'Comment form message; 1: HTML', 'snt-en' );
	$al_tag_msg = sprintf( $al_tag_msg, '<abbrev title="HyperText Markup Language">HTML</abbrev>' );
	$log_out_lnk = wp_logout_url( get_the_permalink() );
	$req = $req_fields ? 'required' : '';
	$req_span = $req_fields ? '<span class="req-cm">*</span>' : '';
	$lev_span = '<span style="visibility: hidden;">*</span>';
	$req_note = _x( 'Fields marked by %1$s are mandatory', 'Comment form message; 1: * (Required mark)', 'snt-en' );
	$req_note = sprintf( $req_note, $req_span );
	$auth = empty( $commenter['comment_author'] ) ? '' : esc_attr( $commenter['comment_author'] );
	$email = empty( $commenter['comment_author_email'] ) ? '' : esc_attr( $commenter['comment_author_email'] );
	$tel_no = empty( $commenter['comment_author_tel'] ) ? '' : esc_attr( $commenter['comment_author_tel'] );
	$url = empty( $commenter['comment_author_url'] ) ? '' : esc_attr( $commenter['comment_author_url'] );
	$comm_p = _x( 'Comment', 'Comment form placeholder', 'snt-en' );
	$auth_p = _x( 'Name', 'Comment form placeholder', 'snt-en' );
	$email_p = _x( 'Email', 'Comment form placeholder', 'snt-en' );
	$tel_no_p = _x( 'Phone Number', 'Comment form placeholder', 'snt-en' );
	$url_p = _x( 'Website', 'Comment form placeholder', 'snt-en' );
	$auth_attr = "name='author' value='$auth' maxlength='245' $req placeholder='$auth_p'";
	$email_attr = "name='email' type='email' value='$email' maxlength='100' $req placeholder='$email_p'";
	$tel_no_attr = "name='tel' value='$tel_no' placeholder='$tel_no_p'";
	$url_attr = "name='url' type='url' value='$url' maxlength='200' placeholder='$url_p'";
	$comm_attr = "name='comment' rows='10' placeholder='$comm_p' class='input-cm' id='comment'";
	$form_attr = esc_url( site_url( '/js-repo/comment-handler.php' ) );
	$form_attr = "action='$form_attr' method='post' class='comment-form' id='commentform' novalidate"; 
	$cancel_attr = esc_html( remove_query_arg('replytocom') );
	$cancel_attr = "href='$cancel_attr#new-cm' id='cancel-comment-reply-link' rel='nofollow'"; 
	$cancel_attr .= ( isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"' );
	$btn_attr = _x( 'Publish', 'Comment button text', 'snt-en' );
	$btn_attr = "type='submit' name='submit' value='$btn_attr' class='submit' id='submit'";

	$form = "<div class='container'><div class='row'>";

	if ( is_user_logged_in() ) :
		$form .= "<div class='col-sn-12'><p class='msg-cm'>";
		
		$form .= sprintf( $l_i_a, $user_identity ) . ' '; 
		$form .= "<a href='$log_out_lnk' rel='nofollow' title='Log out'><span class='snt-icon snt-exit'></span></a>";
		
		$form .= "</p></div>"; 
	else :
		$form .= "<div class='col-sn-12'><p>"; 
		$form .=_x( 
			'Your information (email address, phone number, and URL) will not be accessible by public.',
			'Comment form message',
			'snt-en'
		);
		$form .= "</p></div>"; 
		
		$form .= "<div class='col-sn-12'><p>$req_note</p></div>";

		$form .= "<div class='col-sn-12'>";
		$form .= "$req_span <input title='Name' class='input-cm' id='author' $auth_attr/>";
		$form .= "</div>";

		$form .= "<div class='col-sn-12'>";
		$form .= "$req_span <input title='Email' class='input-cm' id='email' $email_attr/>";
		$form .= "</div>";

		$form .= "<div class='col-sn-12'>";
		$form .= "$lev_span <input title='Phone' class='input-cm' id='tel' $tel_no_attr/>";
		$form .= "</div>";

		$form .= "<div class='col-sn-12'>";
		$form .= "$lev_span <input title='Website' class='input-cm' id='url' $url_attr/>";
		$form .= "</div>";

	endif;

	$form .= "<div class='col-sn-12'><textarea title='Comment' $comm_attr></textarea></div>";

	$form .= "<div class='col-sn-12'><div class='container'><div class='row'>";

	$form .= "<div class='col-sn-12'><p class='msg-cm'>$al_tag_msg</p></div>";
	$form .= "<div class='col-sn-12'><code>$al_tag</code></div>";

	$form .= "</div></div></div>";

	$form .= "<div class='col-sn-12'>";
	$form .= "<input title='Submit Comment Form' $btn_attr/>" . get_comment_id_fields();
	$form .= "</div>";

	$form .= "</div></div>";

	?><div id="new-cm" class="card">
        <div class="container">
            <div class="row">
                <div class="col-sn-12">
                    <a href="#new-cm"><h3><?php echo $ttl; ?></h3></a>
                    <a <?php echo $cancel_attr; ?>><span class="snt-icon snt-cross"></span></a>
                </div>
                <div class="col-sn-12">
                    <form <?php echo $form_attr; ?>><?php echo $form; ?></form>
                </div>
            </div>
        </div>
	</div><?php

}