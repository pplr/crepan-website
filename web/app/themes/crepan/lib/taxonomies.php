<?php

add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
  register_taxonomy('network',
		    array('post', 'page'),
		    array('hierarchical' => false,
			  'labels' => array(
					    'name'                       => _x( 'Networks', 
										'taxonomy general name', 'roots' ),
					    'singular_name'              => _x( 'Network', 
										'taxonomy singular name', 'roots' ),
					    'search_items'               => __( 'Search Networks', 'roots' ),
					    'popular_items'              => __( 'Popular Networks', 'roots' ),
					    'all_items'                  => __( 'All Networks', 'roots' ),
					    'parent_item'                => null,
					    'parent_item_colon'          => null,
					    'edit_item'                  => __( 'Edit Network', 'roots' ),
					    'update_item'                => __( 'Update Network', 'roots' ),
					    'add_new_item'               => __( 'Add New Network', 'roots' ),
					    'new_item_name'              => __( 'New Network Name', 'roots' ),
					    'separate_items_with_commas' => __( 'Separate networks with commas', 
										'roots' ),
					    'add_or_remove_items'        => __( 'Add or remove networks', 'roots' ),
					    'choose_from_most_used'      => __( 'Choose from the most used networks',
										'roots' ),
					    'not_found'                  => __( 'No network found.', 'roots' ),
					    'menu_name'                  => __( 'Networks', 'roots' ),
					    ),
			  'rewrite' => array( 'slug' => 'reseau' )
			  )
		    );
}
