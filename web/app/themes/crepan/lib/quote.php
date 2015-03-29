<?php

class CrepanQuote{
  public static $quote_post_type = "crepan_quote";
  public static $quote_author_taxonomy = "crepan_quote_author";
  public static $author_column_name = "quote_author";

  public static function init(){
    add_action('init', function() {
	$labels = array(
			'name' => __('Citations', 'crepan-theme'),
			'singular_name' => __('Citation', 'crepan-theme'),
			'add_new' => __('Ajouter', 'crepan-theme'),
			'add_new_item' => __('Ajouter une citation', 'crepan-theme'),
			'edit_item' => __('Modifier citations', 'crepan-theme'),
			'new_item' => __('Nouvelle citation', 'crepan-theme'),
			'view_item' => __('Afficher citation', 'crepan-theme'),
			'search_items' => __('Rechercher une citation', 'crepan-theme'),
			'not_found' => __('Aucune citation', 'crepan-theme'),
			'not_found_in_trash' => __('Aucune citation dans la corbeille', 'crepan-theme'),
			'parent_item_colon' => '',
			'menu_name' => __('Citations', 'crepan-theme')
			);
	$args = array(
		      'labels' => $labels,
		      'public' => false,
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
		      'menu_icon' => 'dashicons-format-quote',
		      'supports' => array('excerpt')
		      ); 
	register_post_type(self::$quote_post_type, $args);
      });


    register_taxonomy(self::$quote_author_taxonomy,
		      array(self::$quote_post_type),
		    array('hierarchical' => false,
			  'labels' => array(
					    'name'                       => _x( 'Auteurs', 
										'taxonomy general name', 'roots' ),
					    'singular_name'              => _x( 'Auteur', 
										'taxonomy singular name', 'roots' ),
					    'search_items'               => __( 'Rechercher auteur', 'roots' ),
					    'popular_items'              => __( 'Popular Authors', 'roots' ),
					    'all_items'                  => __( 'Tous les auteurs', 'roots' ),
					    'parent_item'                => null,
					    'parent_item_colon'          => null,
					    'edit_item'                  => __( 'Modifier l’auteur', 'roots' ),
					    'update_item'                => __( 'Mettre a jour auteur', 'roots' ),
					    'add_new_item'               => __( 'Ajouter un nouvel auteur', 'roots' ),
					    'new_item_name'              => __( 'Nouvel auteur', 'roots' ),
					    'separate_items_with_commas' => __( 'Séparez les auteurs par une virgule', 
										'roots' ),
					    'add_or_remove_items'        => __( 'Ajouter ou supprimer un auteur', 'roots' ),
					    'choose_from_most_used'      => __( 'Choisir parmis les auteurs les plus populaires',
										'roots' ),
					    'not_found'                  => __( 'Aucun auteur trouvé.', 'roots' ),
					    'menu_name'                  => __( 'Auteurs', 'roots' ),
					    ),
			  'rewrite' => array( 'slug' => 'auteur' )
			  )
		    );

    add_filter('manage_'.self::$quote_post_type.'_posts_columns', function($columns) {  
        unset($columns['date']);
	$columns[self::$author_column_name] = "Auteur";
	return $columns;  
      }  
    );  

    add_action('manage_'.self::$quote_post_type.'_posts_custom_column', function($column_name, $post_ID) {  
	if ($column_name == self::$author_column_name) {
          $authors = wp_get_post_terms($post_ID, self::$quote_author_taxonomy);
	  echo implode(", ", array_map(function($tax){return $tax->name;}, $authors));
	}
      }, 10, 2);


  }

}

CrepanQuote::init();

