<?php


function snt_admin_load_css_js( $hook ) {
	global $snt_hct, $snt_dir, $post_type;
	
	$ss_path = get_template_directory_uri() . '/css/backend/';
	$js_path = get_template_directory_uri() . '/js/backend/';
	$dep_css = array();
	$dep_js  = array( 'jquery' );
	$loc_vars = array( 'url' => home_url( 'wp-admin/admin-ajax.php' ) );

	if ( isset( $post_type ) && 'post' === $post_type ) :
        if ( 'edit.php' === $hook ) :
            $dep_js []= 'inline-edit-post';
	        $loc_vars['nonce'] = wp_create_nonce( 'snt_bulk_edit_nonce' );
	        $loc_vars['snt_hct'] = array();
	        foreach ( $snt_hct as $tax_obj ) :
		        $loc_vars['snt_hct'] []= $tax_obj->name;
	        endforeach;
	        wp_register_script( 'all-posts-js', "{$js_path}all-posts.js", $dep_js, '1.0.14', TRUE );
            wp_localize_script( 'all-posts-js', 'SNTBulkEdit', $loc_vars );
            wp_enqueue_script( 'all-posts-js' );

        elseif ( 'post-new.php' === $hook || 'post.php' === $hook ) :
            wp_enqueue_style( 'add-edit-post', "{$ss_path}add-edit-post.css", array(), '1.0.14' );
            if ( 'right' === $snt_dir ) :
                $dep_css []= 'add-edit-post';
                wp_enqueue_style( 'add-edit-post-rtl', "{$ss_path}add-edit-post-rtl.css", $dep_css, '1.0.14' );
            endif;
            wp_enqueue_script( 'sprintf-js', "{$js_path}sprintf.js", $dep_js, FALSE, FALSE );
            $dep_js []= 'sprintf-js';
	        $loc_vars['relMsg'] = _x( 'No ID match for %1$d', 'Related Post meta-box text; 1: Entered ID', 'snt-en' );
	        $loc_vars['srcUrlCheck'] = _x( 'No title found in "%1$s"','Source meta-box message; 1:Page URL','snt-en' );
	        $loc_vars['relSame']            = _x( 'Current post\'s ID!', 'Related Post meta-box text', 'snt-en' );
	        $loc_vars['srcNameRadio']       = _x( 'Name only', 'Source meta-box text', 'snt-en' );
	        $loc_vars['srcUrlRadio']        = _x( 'Name & URL', 'Source meta-box text', 'snt-en' );
	        $loc_vars['srcNamePlaceholder'] = _x( 'Site Name', 'Source meta-box placeholder', 'snt-en' );
	        $loc_vars['srcUrlPlaceholder']  = _x( 'Page URL', 'Source meta-box placeholder', 'snt-en' );
	        $loc_vars['srcUrlSuccess']      = _x( 'Source URL check successful!', 'Source meta-box message', 'snt-en' );
	        $loc_vars['srcUrlTitle']        = _x( 'Page title:', 'Source meta-box message', 'snt-en' );
	        $loc_vars['srcUrlFail']         = _x( 'Source URL check failed!', 'Source meta-box message', 'snt-en' );
	        wp_register_script( 'add-edit-post-js', "{$js_path}add-edit-post.js", $dep_js, '1.0.14', TRUE );
            wp_localize_script( 'add-edit-post-js', 'SNTAddEditPost', $loc_vars );
            wp_enqueue_script( 'add-edit-post-js' );
        endif;
	endif;
	if ( 'toplevel_page_options-snt-default-tax-meta' === $hook ) :
		$loc_vars['nonce'] = wp_create_nonce( 'snt_default_tax_meta_nonce' );
		wp_register_script( 'def-tax-meta-js', "{$js_path}def-tax-meta.js", $dep_js, '1.0.14', TRUE );
		wp_localize_script( 'def-tax-meta-js', 'SNTDefs', $loc_vars );
		wp_enqueue_script( 'def-tax-meta-js' );
		wp_enqueue_style( 'def-tax-meta', "{$ss_path}def-tax-meta.css", array(), '1.0.14' );
		if ( 'right' === $snt_dir ) :
			wp_enqueue_script( 'def-tax-ac-rtl-js', "{$js_path}def-tax-ac-rtl.js", $dep_js, FALSE, TRUE );
			wp_enqueue_style( 'def-tax-meta-rtl', "{$ss_path}def-tax-meta-rtl.css", array(), '1.0.14' );
		else :
			wp_enqueue_script( 'def-tax-ac-js', "{$js_path}def-tax-ac.js", $dep_js, FALSE, TRUE );
		endif;
	endif;

}
add_action( 'admin_enqueue_scripts', 'snt_admin_load_css_js' );


function snt_all_posts_styles() {
    global $snt_dir;

	?><style>
        @media ( min-width: 768px ) {
            #posts-filter th#taxonomy-designation { width: 110px; }
            #posts-filter th#taxonomy-placement { width: 102px; }
            #posts-filter th#taxonomy-region { width: 100px; }
            #posts-filter th#taxonomy-topic { width: 83px; }
            #posts-filter th#taxonomy-roll { width: 66px; }
            #posts-filter th#date { width: 90px; }
            #posts-filter th#top { width: 72px; }
            #posts-filter th#img { width: 54px; }
            #posts-filter th#id { width: 54px; }
        }
        .fieldset-tax-quick-edit select, .fieldset-meta-quick-edit select { width: 200px; }
        .fieldset-tax-quick-edit, .fieldset-meta-quick-edit { alignment: left; }
        .label-st-qe span, .label-sm-qe span { width:70px; }
        .label-st-be, .label-sm-be { line-height: 30px; }
        .widefat .label-st-be * { word-wrap: normal; }
        .label-st-be select, .label-sm-be select {
            position: absolute;
            left: 100px;
            width: 170px;
        }
    </style><?php

	if ( 'right' === $snt_dir ) :
		?><style>
            .fieldset-tax-quick-edit, .fieldset-meta-quick-edit { alignment: right; }
            .label-st-be select, .label-sm-be select {
                left: initial;
                right: 100px;
            }
        </style><?php
	endif;

}
add_action( 'admin_print_styles-edit.php', 'snt_all_posts_styles' );
