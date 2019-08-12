<?php

// Make theme ready for translation
load_theme_textdomain( 'snt-en', get_template_directory() . '/languages' );

// Global variables
$snt_def_img = get_template_directory_uri() . '/default-img.jpg';
$snt_1_2   = '%1$s %2$s';
$snt_2_1   = '%2$s %1$s';
$snt_12    = '%1$s%2$s';
$snt_21    = '%2$s%1$s';
$snt_dir_r = 'right';
$snt_dir   = 'left';
$snt_mor   = '<span>' . _x( 'Continue Reading', 'Excerpt Text', 'snt-en' ) . '</span>';
if ( is_rtl() ) :
	$snt_1_2   = '%2$s %1$s';
	$snt_2_1   = '%1$s %2$s';
	$snt_12    = '%2$s%1$s';
	$snt_21    = '%1$s%2$s';
	$snt_dir_r = 'left';
	$snt_dir   = 'right';
endif;
$snt_mor = sprintf( $snt_1_2, $snt_mor, "<span class='snt-icon snt-filled-caret-{$snt_dir_r}'></span>" );
$snt_btn_so = '<div class="btn-so"><span class="snt-icon snt-filled-caret-down"></span></div>';
$snt_btn_rot = "<div class='btn-rot'><span class='snt-icon snt-ellipsis'></span></div>";
$snt_supported_lang = array(
	'urdu' => array(
		'direction'  => 'rtl',
		'prefix'     => 'ur',
		'url'        => 'http://urdu.islamnewsagency.com',
		'native'     => 'اردو',
		'translated' => _x( 'Urdu', 'Language', 'snt-en' ),
		'term-id'    => array(
			'des-a'    => 2,
			'des-n'    => 3,
			'pla-lp'   => 5,
			'pla-ls'   => 6,
			'pla-re'   => 8,
			'reg-af'   => 11,
			'reg-pak'  => 12,
			'reg-bang' => 14,
			'reg-ch'   => 15,
			'reg-ind'  => 16,
			'reg-ka'   => 17,
			'reg-sea'  => 19,
			'reg-int'  => 21,
			'reg-me'   => 22,
			'rol-h'    => 23,
			'rol-n'    => 24,
			'top-pol'  => 26,
			'top-sec'  => 27,
			'top-eco'  => 29,
			'top-soc'  => 30,
			'top-misc' => 32
		),
		'page-id' => array(
			'archives'    => 503,
			'designation' => 496,
			'region'      => 498,
			'topic'       => 500,
			'state'       => 271,
			'character'   => 269,
			'subtopic'    => 273
		)
	),
	'english' => array(
		'direction'  => 'ltr',
		'prefix'     => 'en',
		'url'        => 'http://www.islamnewsagency.com',
		'native'     => 'English',
		'translated' => _x( 'English', 'Language', 'snt-en' ),
		'font-url'   => array(
			'Lalezar',
			'Roboto+Slab:100,300,400,700',
            'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i'
        ),
		'term-id'    => array(
            'des-a'    => 1,
            'des-n'    => 2,
            'pla-lp'   => 4,
            'pla-ls'   => 5,
            'pla-re'   => 7,
            'reg-af'   => 10,
            'reg-pak'  => 11,
            'reg-bang' => 13,
            'reg-ch'   => 14,
            'reg-ind'  => 16,
            'reg-ka'   => 15,
            'reg-sea'  => 70,
            'reg-int'  => 28,
            'reg-me'   => 27,
            'rol-h'    => 29,
            'rol-n'    => 30,
            'top-pol'  => 32,
            'top-sec'  => 33,
            'top-eco'  => 35,
            'top-soc'  => 36,
            'top-misc' => 38
        ),
		'page-id' => array(
			'archives'    => 1043,
			'designation' => 1045,
			'region'      => 1057,
			'topic'       => 1050,
			'state'       => 989,
			'character'   => 987,
			'subtopic'    => 991
		)
	),
	'default' => array(
		'direction'  => 'ltr',
		'prefix'     => 'en',
		'url'        => 'http://www.islamnewsagency.com',
		'native'     => 'English',
		'translated' => _x( 'English', 'Language', 'snt-en' ),
		'font-url'   => array(
			'Lalezar',
			'Roboto+Slab:100,300,400,700',
			'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i'
		),
        'term-id' => array(
            'des-a'    => 94,
            'des-n'    => 88,
            'pla-lp'   => 198,
            'pla-ls'   => 200,
            'pla-re'   => 103,
            'reg-af'   => 185,
            'reg-pak'  => 186,
            'reg-bang' => 193,
            'reg-ch'   => 194,
            'reg-ind'  => 189,
            'reg-ka'   => 188,
            'reg-sea'  => 190,
            'reg-int'  => 55,
            'reg-me'   => 82,
            'rol-h'    => 182,
            'rol-n'    => 181,
            'top-pol'  => 97,
            'top-sec'  => 110,
            'top-eco'  => 34,
            'top-soc'  => 115,
            'top-misc' => 183
        ),
        'page-id' => array(
            'archives'    => 974,
            'designation' => 965,
            'region'      => 963,
            'topic'       => 969,
            'state'       => 958,
            'character'   => 928,
            'subtopic'    => 961
        )
	),
);
$snt_comma = _x( ',', 'Comma', 'snt-en' );
$snt_quote = _x( '"', 'Quotation mark', 'snt-en' );
$snt_hct = $snt_nhct = $snt_lead_id = array();
$snt_lang = '';


function snt_remove_unwanted_wp() {

	remove_action( 'wp_head', 'wp_resource_hints', 2 );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter( 'the_generator', '__return_false' );
	add_filter( 'emoji_svg_url', '__return_false' );
	add_filter( 'update_footer', '__return_false', 9999 );
	add_filter( 'admin_footer_text', '__return_false', 9999 );

}
add_action( 'init', 'snt_remove_unwanted_wp' );


function snt_disable_emoji_tinymce( $pl ) {
	if ( is_array( $pl ) ) :
		return array_diff( $pl, array( 'wpemoji' ) );
	else :
		return array();
	endif;
}
add_filter( 'tiny_mce_plugins', 'snt_disable_emoji_tinymce' );


function snt_redirect () {

	$req = untrailingslashit( $_SERVER['REQUEST_URI'] );

	if (
		site_url( 'login','relative' ) === $req ||
		site_url( 'dashboard', 'relative' ) === $req ||
		site_url( 'admin', 'relative' ) === $req ||
		site_url( 'wp-login', 'relative' ) === $req
	) :
		remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );
	endif;

}
add_action( 'template_redirect', 'snt_redirect' );


function remove_remember_me()
{

	?><style type="text/css"> .forgetmenot { display:none; } </style><?php

}
add_action('login_head', 'remove_remember_me');


function snt_after_logout_redirect() {

    wp_clear_auth_cookie();
    $re = ( empty( $_REQUEST['redirect_to'] ) ? home_url() : esc_url( $_REQUEST['redirect_to'] ) );
	wp_redirect( $re );

	exit();

}
add_action( 'wp_logout', 'snt_after_logout_redirect' );


function snt_admin_url ( $url ) {
	return preg_replace( '/wp-admin/', WP_ADMIN_DIR, $url, 1 );
}
add_filter( 'admin_url', 'snt_admin_url' );


function snt_block_default_admin_url () {

	if ( isset( $_SERVER['REQUEST_URI'] ) && FALSE !== strpos( $_SERVER['REQUEST_URI'], WP_ADMIN_DIR ) ) :
		return;
	endif;

	if ( isset( $_SERVER['REQUEST_URI'] ) && FALSE !== strpos( $_SERVER['REQUEST_URI'], 'wp-admin' ) ) :
		wp_safe_redirect( '404.php' );
	endif;
	if ( isset( $_SERVER['REQUEST_URI'] ) && FALSE !== strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) ) :
		if ( ! isset( $_GET['action'] ) && ! isset( $_GET['loggedout'] ) ) :
			wp_safe_redirect( '404.php' );
		endif;
		if ( isset( $_GET['loggedout'] ) && 'true' === $_GET['loggedout'] ) :
			return;
		endif;
		if (
			isset( $_GET['action'] ) &&
			in_array( $_GET['action'], array( 'register', 'logout', 'lostpassword', 'rp', 'resetpass' ), TRUE )
		) :
			return;
		endif;
		wp_safe_redirect( '404.php' );
	endif;

	return;

}
add_action( 'login_form', 'snt_block_default_admin_url' );


function snt_set_lang ( $loc ) {
	global $snt_lang, $snt_supported_lang;

	if ( isset( $snt_supported_lang[ $snt_lang ] ) ) :
		return $loc;
	endif;

	if ( FALSE === strpos( $_SERVER['SERVER_NAME'], 'islamnewsagency' ) ) :
        $snt_lang = 'default';
		return 'default';
	endif;

	if ( 'ur' === $loc ) :
        $snt_lang = 'urdu';
	else :
		$snt_lang = 'english';
	endif;

    return $snt_lang;

}
add_filter( 'locale', 'snt_set_lang' );


function snt_setup() {

	add_theme_support( 'title-tag' );

	$args = array( 'post' );
	add_theme_support( 'post-thumbnails', $args );

	$args = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' );
	add_theme_support( 'html5', $args );

	$args = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => TRUE,
		'flex-width'  => TRUE,
		'header-text' => array( 'site-title', 'site-description' )
	);
	add_theme_support( 'custom-logo', $args );

	$args = array( 'snt-top-bar-nav' => _x( 'Top Bar Navigation', 'Menu description', 'snt-en' ) );

	register_nav_menus( $args );

}
add_action( 'after_setup_theme', 'snt_setup' );


function snt_remove_version_from_style_script( $src ) {

	global $wp_version;

	parse_str( parse_url( $src, PHP_URL_QUERY ), $query );

	if ( ! empty( $query['ver'] ) && $wp_version === $query['ver'] ) :
		$src = remove_query_arg( 'ver', $src );
	endif;

	return $src;

}
add_filter( 'script_loader_src', 'snt_remove_version_from_style_script' );
add_filter( 'style_loader_src', 'snt_remove_version_from_style_script' );


function snt_add_taxonomy_caps() {

	$roles = array( get_role( 'administrator' ), get_role( 'editor' ), get_role( 'author' ) );

	foreach ( $roles as $role ) :

		if ( $role && ! $role->has_cap( 'manage_snt_defs' ) ) :
			$role->add_cap( 'manage_snt_defs' );
		endif;

		if ( 'author' === $role->name || ( $role && $role->has_cap( 'manage_snt_ct_terms' ) ) ) :
			continue;
		endif;

		$role->add_cap( 'manage_snt_ct_terms' );

	endforeach;

}
add_action( 'admin_init', 'snt_add_taxonomy_caps' );


function snt_manage_defs_cap() {
	return 'manage_snt_defs';
}
add_filter( 'option_page_capability_snt_defs', 'snt_manage_defs_cap' );


function snt_remove_meta_boxes() {

	global $current_user;

	if (
        ! isset( $current_user->roles ) ||
        ! is_array( $current_user->roles ) ||
        (
            ! in_array( 'author', $current_user->roles, TRUE ) &&
            ! in_array( 'contributor',  $current_user->roles, TRUE )
        )
    ) :
		return;
	endif;

	remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
	remove_meta_box( 'postcustom', 'post', 'normal' );
	remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	remove_meta_box( 'slugdiv', 'post', 'normal' );
	remove_meta_box( 'authordiv', 'post', 'normal' );
	remove_meta_box( 'commentsdiv', 'post', 'normal' );
	remove_meta_box( 'revisionsdiv', 'post', 'normal' );
	remove_meta_box( 'postexcerpt', 'post', 'normal' );

}
add_action( 'admin_menu', 'snt_remove_meta_boxes' );
