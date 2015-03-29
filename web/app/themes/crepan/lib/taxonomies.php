<?php

class CrepanNetworks{
  public static $taxonomy = 'network';

  public static function buildTaxonomy(){
    register_taxonomy(self::$taxonomy,
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
			    'rewrite' => array( 'slug' => 'reseau' ),
			    'show_ui' => false,
			    'show_in_nav_menus' => true,
			    /* 'capabilities' => array( */
			    /* 			    'manage_terms' => 'manage_categories', */
			    /* 			    'edit_terms' => 'manage_categories', */
			    /* 			    'delete_terms' => 'manage_categories', */
			    /* 			    'assign_terms' => 'edit_posts' */
			    /* 			    ), */
			    )
		      );
  }

  public static function addMetaBox() {
    add_meta_box('networks-meta-box', 
		 'Réseaux', 
		 function($post){CrepanNetworks::renderMetaBox($post);}, 
		 'post', 
		 'side', 
                 'default', 
		 null);
  }



  public static function renderMetaBox($post){
    $terms = get_terms(self::$taxonomy, array('orderby'    => 'name',
					      'hide_empty' => 0 ));
    $set_terms = wp_get_object_terms($post->ID, self::$taxonomy, array('fields' => 'ids') );

    wp_nonce_field('networks_meta_box', 'networks_meta_box_nonce' );
    echo '<input type="hidden" name="post_networks[]" value="0">';
    echo '<ul class="categorychecklist form-no-clear">';
    foreach ( $terms as $term ) {
      echo '<li><label class="selectit"><input value="' . $term->term_id . 
	'" type="checkbox" name="post_networks[]" ' . 
	(in_array($term->term_id, $set_terms) ? 'checked' : '') . 
	'>'. $term->name .'</label></li>';
    }
    echo '</ul>';
  }

  public static function saveMetaBox($post_id){
    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['networks_meta_box_nonce'] ) ) {
      return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['networks_meta_box_nonce'], 'networks_meta_box' ) ) {
      return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) ) {
	return;
      }

    } else {

      if ( ! current_user_can( 'edit_post', $post_id ) ) {
	return;
      }
    }

    /* OK, it's safe for us to save the data now. */
	
    // Make sure that it is set.
    if ( ! isset( $_POST['post_networks'] ) ) {
      return;
    }

    $network_ids = array_unique(array_map( 'intval', $_POST['post_networks'] ));
    wp_set_object_terms($post_id, $network_ids , self::$taxonomy );

  }

  public static function init(){
    add_action('init', function(){CrepanNetworks::buildTaxonomy();}, 0 );
    add_action('add_meta_boxes', function(){CrepanNetworks::addMetaBox();});
    add_action('save_post', function($post_id){CrepanNetworks::saveMetaBox($post_id);});
  }

  }

CrepanNetworks::init();