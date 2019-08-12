<?php


/**
 * Registers taxonomies and their global
 *
 */
function snt_taxonomies(){

	register_taxonomy( 'category', array() );
	register_taxonomy( 'post_tag', array() );
	unregister_taxonomy( 'category' );
	unregister_taxonomy( 'post_tag' );

	global $snt_hct, $snt_nhct;

	$obj_type = 'post';
	$rewrite  = array( 'slug' => 'characters', 'hierarchical' => FALSE, 'ep_mask' => 1024 );
	$cap = array(
		'manage_terms' => 'manage_snt_ct_terms',
		'edit_terms'   => 'manage_snt_ct_terms',
		'delete_terms' => 'manage_snt_ct_terms',
		'assign_terms' => 'edit_posts'
	);
	$labels = array(
		'name'                       => _x( 'Characters', 'General taxonomy name', 'snt-en' ),
		'singular_name'              => _x( 'Character', 'Singular taxonomy name', 'snt-en' ),
		'all_items'                  => _x( 'All terms', 'Full list of taxonomy items', 'snt-en' ),
		'edit_item'                  => _x( 'Edit item', 'Edit taxonomy item', 'snt-en' ),
		'view_item'                  => _x( 'View item', 'View taxonomy item', 'snt-en' ),
		'update_item'                => _x( 'Update', 'Apply changes to a taxonomy item', 'snt-en' ),
		'add_new_item'               => _x( 'Add','Add new taxonomy item' , 'snt-en' ),
		'new_item_name'              => _x( 'Name', 'Name for new taxonomy item', 'snt-en' ),
		'parent_item'                => _x( 'Parent', 'Taxonomy term\'s parent', 'snt-en'),
		'parent_item_colon'          => _x( 'Parent:', 'Taxonomy term\'s parent', 'snt-en'),
		'search_items'               => _x( 'Search Characters', 'Search taxonomy items', 'snt-en' ),
		'popular_items'              => _x( 'Most used', 'Most frequent taxonomy items', 'snt-en' ),
		'separate_items_with_commas' => _x( 'Separate items with commas', 'Taxonomy meta-box hint', 'snt-en' ),
		'add_or_remove_items'        => _x( 'Add/Remove items',  'Taxonomy meta-box hint', 'snt-en' ),
		'choose_from_most_used'      => _x( 'Choose from the most used',  'Taxonomy meta-box hint', 'snt-en' ),
		'not_found'                  => _x( 'Nothing found!', 'No taxonomy terms found', 'snt-en' ),
		'no_terms'                   => _x( 'Not assigned yet!', 'No taxonomy terms assigned', 'snt-en' ),
		'items_list_navigation'      => _x( 'Terms list navigation', 'Taxonomy terms\' list navigation', 'snt-en' ),
		'items_list'                 => _x( 'Terms list', 'Taxonomy terms\' list', 'snt-en' ),
		'archives'                   => _x( 'Person', 'Taxonomy archive name', 'snt-en' )
	);

	$args = array(
		'labels'            => $labels,
		'show_in_nav_menus' => FALSE,
		'show_in_rest'      => TRUE,
		'description'       => _x( 'People', 'Taxonomy description', 'snt-en' ),
		'rewrite'           => $rewrite,
		'capabilities'      => $cap,
		'sort'              => FALSE,
	);
	register_taxonomy( 'character', $obj_type, $args );

	$rewrite['slug']         = 'states';
	$labels['name']          = _x( 'States', 'General taxonomy name', 'snt-en' );
	$labels['singular_name'] = _x( 'State', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search States', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Country/State', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Countries/States', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'state', $obj_type, $args );

	$rewrite['slug']         = 'subtopics';
	$labels['name']          = _x( 'Subtopics', 'General taxonomy name ', 'snt-en' );
	$labels['singular_name'] = _x( 'Subtopic', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Subtopics', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Miscellaneous Tag', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Miscellaneous Tags', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'subtopic', $obj_type, $args );

	$rewrite['slug'] = 'designations';
	$rewrite['ep_mask'] = 512;
	$rewrite['hierarchical'] = TRUE;

	$labels['name']          = _x( 'Designations', 'General taxonomy name', 'snt-en' );
	$labels['singular_name'] = _x( 'Designation', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Designations', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Content Type', 'Taxonomy archive name', 'snt-en' );

	$args['labels']             = $labels;
	$args['show_in_nav_menus']  = TRUE;
	$args['show_in_quick_edit'] = FALSE;
	$args['meta_box_cb']        = FALSE;
	$args['show_admin_column']  = TRUE;
	$args['description']        = _x( 'Content Types', 'Taxonomy description', 'snt-en' );
	$args['hierarchical']       = TRUE;
	$args['rewrite']            = $rewrite;

	register_taxonomy( 'designation', $obj_type, $args );

	$rewrite['slug']         = 'placements';
	$labels['name']          = _x( 'Placements', 'General taxonomy name', 'snt-en' );
	$labels['singular_name'] = _x( 'Placement', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Placements', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Front-page Position', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Front-page Positions', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'placement', $obj_type, $args );

	$rewrite['slug']         = 'regions';
	$labels['name']          = _x( 'Regions', 'General taxonomy name' , 'snt-en' );
	$labels['singular_name'] = _x( 'Region', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Regions', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Region', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Regions', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'region', $obj_type, $args );

	$rewrite['slug']         = 'rolls';
	$labels['name']          = _x( 'Rolls', 'General taxonomy name', 'snt-en' );
	$labels['singular_name'] = _x( 'Roll', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Rolls', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Marquee Roll', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Marquee Rolls', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'roll', $obj_type, $args );

	$rewrite['slug']         = 'topics';
	$labels['name']          = _x( 'Topics', 'General taxonomy name', 'snt-en' );
	$labels['singular_name'] = _x( 'Topic', 'Singular taxonomy name', 'snt-en' );
	$labels['search_items']  = _x( 'Search Topics', 'Search taxonomy items', 'snt-en' );
	$labels['archives']      = _x( 'Main Topic', 'Taxonomy archive name', 'snt-en' );

	$args['labels']      = $labels;
	$args['description'] = _x( 'Main Topics', 'Taxonomy description', 'snt-en' );
	$args['rewrite']     = $rewrite;

	register_taxonomy( 'topic', $obj_type, $args );

	$snt_hct = array();
	$snt_nhct = array();

	foreach ( get_taxonomies( array( 'hierarchical' => TRUE, '_builtin' => FALSE ), 'objects' ) as $obj ) :
		$snt_hct[] = $obj;
	endforeach;

	foreach ( get_taxonomies( array( 'hierarchical' => FALSE, '_builtin' => FALSE ), 'objects' ) as $obj ) :
		$snt_nhct[] = $obj;
	endforeach;

}
add_action( 'init', 'snt_taxonomies' );


/**
 * Flushes rewrite rules upon theme (de)activation
 *
 */
function snt_rewrite_flush() {
	snt_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'snt_rewrite_flush');


/**
 * Flushes rewrite rules upon creation of taxonomy item
 *
 */
function snt_ct_rewrite_flush() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
add_action( 'create_character', 'snt_ct_rewrite_flush' );
add_action( 'create_state', 'snt_ct_rewrite_flush' );
add_action( 'create_subtopic', 'snt_ct_rewrite_flush' );
add_action( 'create_designation', 'snt_ct_rewrite_flush' );
add_action( 'create_region', 'snt_ct_rewrite_flush' );
add_action( 'create_topic', 'snt_ct_rewrite_flush' );
add_action( 'create_placement', 'snt_ct_rewrite_flush' );
add_action( 'create_roll', 'snt_ct_rewrite_flush' );
