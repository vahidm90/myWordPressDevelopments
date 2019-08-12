<?php

function vmp_set_doc_title($title) {
    if (is_front_page()) :
        $title = get_bloginfo('name') . get_bloginfo('description');
    endif;
    return $title;
//    if (is_page_template()) : 
//        global $post; 
////        if ()
////        $title = 
//    endif;
}

add_filter('wp_title', 'vmp_set_doc_title');
