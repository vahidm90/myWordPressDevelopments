<?php

$st1 = _x( 'You can freely redistribute, copy, etc. the content.', 'Footer text', 'snt-en' );
$st2 = _x( 'We would appreciate mentioning %1$s as the source.', 'Footer text; 1: Site name', 'snt-en' );
$msg = sprintf( $st2, get_bloginfo() );

?><footer id="foot-gen">
    <div id="scroll-up"><span class="snt-icon snt-arrow-up2"></span></div>
    <div class="txt">
        <div class="container">
            <div class="row"><div class="col-sn-12"><p><?php echo $st1; ?></p><p><?php echo $msg; ?></p></div></div>
        </div>
    </div>
</footer><?php

echo '</div>'; // wrap

wp_footer();

echo '</body></html>';