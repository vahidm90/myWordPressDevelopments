<?php

if ( post_password_required() ) :
	return;
endif;

$list = $msg = '';
$head = _x( 'Discussion', 'Comment heading', 'snt-en' );

if ( have_comments() ) :
    if ( ! comments_open() && get_comments_number() ) :
        $msg = _x( 'Sorry! No more comments here!', 'Comment message', 'snt-en' );
    endif;
    $list = wp_list_comments( array( 'walker' => new SNT_Walker_Comment(), 'type' => 'comment', 'echo' => FALSE ) );
endif;
if ( comments_open() && ! get_comments_number() ) :
	$msg = _x( 'Be the first one to comment!', 'Comment message', 'snt-en' );
endif;

?><section id="comments">
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <a href="#comments"><h2 class="snt-icon-before snt-bubbles"><?php echo $head; ?></h2></a>
            </div>
            <div class="col-sn-12"><p id="first-cm"><?php echo $msg; ?></p></div>
            <div class="col-sn-12"><ul class="top-ul parent-ul"><?php echo $list; ?></ul></div>
            <div class="col-sn-12"><?php snt_comment_form(); ?></div>
        </div>
    </div>
</section>