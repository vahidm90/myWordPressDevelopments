<?php

class SNT_Walker_Comment extends Walker_Comment {


	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference to append additional content
     *
	 * @param int    $depth  Optional. Depth of the current comment defaults to 0
     *
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list defaults to empty array
     *
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

	    $GLOBALS['comment_depth'] = $depth + 1;
		$parent = ( $args['has_children'] ? ' parent-cm ' : '' );

        $output .= "<ul class='child-cm$parent d-$depth'>\n";

	}


	/**
	 * Ends the list of items after the elements are added.
	 *
	 *
	 * @param string $output Passed by reference to append additional content
	 *
	 * @param int    $depth  Optional. Depth of the current comment defaults to 0
	 *
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list defaults to empty array
     *
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

	    $GLOBALS['comment_depth'] = $depth + 1;
        $output .= "</ul>\n";

	}


	/**
	 * Starts the element output.
	 *
	 * @param string     $output  Passed by reference to append additional content
	 *
	 * @param WP_Comment $comment Comment data object
     *
	 * @param int        $depth   Optional. Depth of the current comment defaults to 0
	 *
	 * @param array      $args    Optional. Uses 'style' argument for type of HTML list defaults to empty array
	 *
	 * @param int        $id      Optional. ID of the current comment, defaults to 0 (unused)
     *
	 */
	public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {

		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		if ( in_array( $comment->comment_type, array( 'pingback', 'trackback' ) ) && $args['short_ping'] ) :
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		else :
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		endif;

	}


	/**
	 * Ends the element output, if needed.
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 *
	 * @param WP_Comment $comment The current comment object. Default current comment.
	 *
	 * @param int $depth Optional. Depth of the current comment. Default 0.
	 *
	 * @param array $args Optional. An array of arguments. Default empty array.
     *
	 */
	public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
	}

    //TODO: Create markup for ping-backs
	/**
	 * Outputs a pingback comment.
	 *
	 *
	 * @param WP_Comment $comment The comment object.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<?php
	}

//TODO: Add comment RDFa and MicroData
	/**
	 * Outputs a comment in the HTML5 format
	 *
	 * @param WP_Comment $comment Comment to display
	 *
	 * @param int        $depth   Depth of the current comment
	 *
	 * @param array      $args    An array of arguments
	 *
	 */
	protected function html5_comment( $comment, $depth, $args ) {
	    global $post;

	    $str = _x( 'User comment for article `%1$s`', 'Comment link title; 1: Post title', 'snt-en' );
		$ttl = esc_attr( sprintf( $str, $post->post_title ) );
        $msg = _x( 'Your comment will be published upon approval.', 'Comment message', 'snt-en' );
        $e_txt = '<span class="ed-cm">' . _x( 'Edit', 'Comment Edit', 'snt-en' ) . '</span>';
        $e_lnk = '';
		$cm_r_args = array( 'max_depth' => $args['max_depth'], 'depth' => $depth );

	    if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) :
            $e_lnk = "<a href='" . esc_url( get_edit_comment_link( $comment ) ) . "'>$e_txt</a>";
	    endif;

		$lnk = get_comment_link( $comment, $args );
		$a_m = ( '0' == $comment->comment_approved ? ( empty( $e_lnk ) ? '' : ' — ' ) . $msg : '' );
		$attr = snt_comment_class( $this->has_children ? 'parent' : '', $comment, FALSE );
		$time = _x( '%1$s at %2$s', 'Time; 1: Date, 2: Time', 'snt-en' );
		$time = sprintf( $time, get_comment_date( 'j M Y', $comment ), get_comment_time( 'H:i' ) );

		?><li id=<?php echo "'comment-$comment->comment_ID'$attr"; ?>>
            <article id='cm-<?php echo $comment->comment_ID; ?>'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sn-12'>
                            <header>
                                <div class='col-sn-12'><span class="aut-cm"><?php comment_author(); ?></span></div>
                                <div class='col-sn-12'>
                                    <a href='<?php echo $lnk; ?>' title="<?php echo $ttl; ?>" class='lnk-cm'>
                                        <time datetime="<?php comment_time( 'c' ); ?>"><?php echo $time; ?></time>
                                    </a>
                                </div>
                                <div class='col-sn-12'>
                                    <div class="txt-header-cm"><?php echo "$a_m$e_lnk"; ?></div>
                                </div>
                            </header>
                        </div>
                        <div class='col-sn-12'><div class="txt-cm"><?php comment_text(); ?></div></div>
                        <div class='col-sn-12'><?php snt_comment_reply_lnk( $cm_r_args ); ?></div>
                    </div>
                </div>
            </article><?php

	}

}
