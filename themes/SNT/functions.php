<?php

// Preparation
require_once get_template_directory() . '/inc/init/init.php';
require_once get_template_directory() . '/inc/init/custom-tax.php';
require_once get_template_directory() . '/inc/class/class-snt-walker-ct-drop-down.php';
require_once get_template_directory() . '/inc/class/class-snt-walker-comment.php';
require_once get_template_directory() . '/inc/class/class-snt-walker-nav-menu.php';
require_once get_template_directory() . '/inc/init/snt-func.php';
require_once get_template_directory() . '/inc/frontend/func/custom-functions.php';
require_once get_template_directory() . '/inc/frontend/func/comment-func.php';
require_once get_template_directory() . '/inc/frontend/func/load-js-css.php';

if ( is_admin() ) :

	require_once get_template_directory() . '/inc/backend/custom-meta.php';
	require_once get_template_directory() . '/inc/backend/default-tax-meta.php';
	require_once get_template_directory() . '/inc/backend/style-script.php';
	require_once get_template_directory() . '/inc/backend/pages-table.php';
	require_once get_template_directory() . '/inc/backend/posts-table.php';
	require_once get_template_directory() . '/inc/backend/save-post.php';

endif;