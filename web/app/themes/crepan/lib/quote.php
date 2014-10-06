<?php
namespace crepan\quote;

$quote_post_type = "crepan_quote";

add_action('init', function() {
    global $quote_post_type;
    $labels = array(
		    'name' => __('Quotes', 'crepan-theme'),
		    'singular_name' => __('Quote', 'crepan-theme'),
		    'add_new' => __('Add New', 'crepan-theme'),
		    'add_new_item' => __('Add New Quote', 'crepan-theme'),
		    'edit_item' => __('Edit Quote', 'crepan-theme'),
		    'new_item' => __('New Quote', 'crepan-theme'),
		    'view_item' => __('View Quote', 'crepan-theme'),
		    'search_items' => __('Search Quotes', 'crepan-theme'),
		    'not_found' => __('No Quote', 'crepan-theme'),
		    'not_found_in_trash' => __('No Quote found in Trash', 'crepan-theme'),
		    'parent_item_colon' => '',
		    'menu_name' => __('Quotes', 'crepan-theme')
		    );
    $args = array(
		  'labels' => $labels,
		  'public' => true,
		  'exclude_from_search' => true,
		  'publicly_queryable' => false,
		  'show_ui' => true, 
		  'show_in_menu' => true, 
		  'query_var' => true,
		  'rewrite' => true,
		  'capability_type' => 'page',
		  'has_archive' => true, 
		  'hierarchical' => false,
		  'menu_position' => 21,
		  'supports' => array('title')
		  ); 
    register_post_type($quote_post_type, $args);
  });

