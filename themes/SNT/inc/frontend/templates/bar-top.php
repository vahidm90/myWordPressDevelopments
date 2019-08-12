<?php

global $snt_lang, $snt_supported_lang, $snt_dir;

$txt = _x( 'Browse', 'Text for top bar navigation menu', 'snt-en' ) . ' ';
$h_url = home_url();
$b_img = get_template_directory_uri() . '/inc/frontend/templates/banner.png';
$s_name = get_bloginfo();
$s_desc = get_bloginfo( 'description' );
$hint = ( in_array( $snt_lang, array( 'english', 'default' ), TRUE ) ? '' : ' Language' );
$args = array(
	'menu'            => 'top-bar-navigation',
	'container'       => 'nav',
	'menu_class'      => 'top-ul parent-ul',
	'menu_id'         => '',
	'container_class' => '',
	'fallback_cb'     => FALSE,
	'walker'          => new SNT_Walker_Nav_Menu(),
	'echo'            => FALSE
);

$sections = wp_nav_menu( $args );


$lang = "<nav><ul class='top-ul parent-ul ul-d-0'><li class='li-d-0 parent-li'>";

$lang .= "<a class='no-wrap'><div>";
$lang .= "<span>" . _x( 'Language', 'Menu title', 'snt-en' ) . "$hint </span>";
$lang .= "<span class='snt-icon snt-filled-caret-down'></span>";
$lang .= "</div></a>";

$lang .= "<ul class='child-ul'>";
$lang_ln3 = "<div id='lang-nav-ribbon'>";
foreach ( $snt_supported_lang as $name => $args ) :

	$i = " dir='{$args['direction']}'";
	$i = ( $args['native'] === $args['translated'] ? '' : " <span$i>{$args['native']}</span>" );

	if ( $snt_lang === $name || 'default' === $name ) :
		$lang .= "<li class='li-d-1'><a class='already no-wrap'><div><span>{$args['translated']}</span>$i</div></a></li>";
		$lang_ln3 .= "<a class='already'><span>{$args['translated']}</span>$i</a>";
		continue;
	endif;

	$lang .= "<li class='li-d-1'><a href='{$args['url']}' class='no-wrap'>";
	$lang .= "<div><span>{$args['translated']}</span>$i</div>";
	$lang .= "</a></li>";
	$lang_ln3 .= "<a href='{$args['url']}'><span>{$args['translated']}</span>$i</a>";

endforeach;
$lang_ln3 .= "</div>";
$lang .= "</ul>";

$lang .= "</li></ul></nav>";

?><section id="bar-top">
    <div class="container">
        <div class="row">
            <div class="col-sn-12">
                <div id="name-wrap">
                    <div class="centered btop-gen" id="name">
                        <a <?php echo "href='$h_url' title='$s_name — $s_desc'"; ?> class="d-a-i-gt-s3">
                            <h1>
                                <span class="banner-site snt-icon snt-site-banner"></span>
                                <span class="name-site"><?php echo $s_name; ?></span>
                            </h1>
                        </a>
                        <a <?php echo "href='$h_url' title='$s_name — $s_desc'"; ?> class="d-a-i-st-s2">
                            <div class="banner-site snt-icon-before snt-site-banner"></div>
                            <h1><span class="name-site"><?php echo $s_name; ?></span></h1>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sn-12">
                <div class="d-a-b-gt-l2 centered" id="nav-ribbon">
                    <div class="opp-float"><?php echo $lang_ln3; ?></div>
                    <div class="opp-float"><button class="snt-icon-before snt-search btn-search"></button></div>
                    <div id="wrap-form-search"><?php get_search_form(); ?></div>
                </div>
            </div>
            <div class="col-sn-12">
                <div class="wrap-menu" id="wrap-menu-btop">
                    <div class="centered btop-gen" id="menu-bar-top">
                        <div class="d-a-b-st-l3 open-menu">
                            <span class="d-a-i-gt-s2"><?php echo $txt; ?></span>
                            <span class="snt-icon snt-menu3"></span>
                        </div>
                        <div class="menu-bt"><?php echo $sections; ?></div>
                        <div class="menu-bt d-a-b-st-l3"><?php echo $lang; ?></div>
                        <div class="menu-bt d-a-b-st-l3">
                            <nav id="search-mbt">
                                <ul class='top-ul ul-d-0'>
                                    <li class='li-d-0'><a><div><?php get_search_form(); ?></div></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
