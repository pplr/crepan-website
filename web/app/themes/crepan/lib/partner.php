<?php 

class CrepanPartner{
  public static $partner_item_post_type = "partner_item";
  public static $partner_item_category = "partner_item_category";
  public static $featured_preview_image_size = 'featured_preview';
  public static $partner_image_size = 'homepage-partner';
  public static $featured_image_column_name = 'featured_image';
  public static $item_image_url_meta = "item_image_url";
  public static $item_image_url_openblank_meta = "item_image_url_openblank";

  public static function init(){
    add_action('init', function() {
	$labels = array(
			'name' => 'Partenaires',
			'singular_name' => 'Partenaires',
			'add_new' => 'Ajouter',
			'add_new_item' => 'Ajouter un partenaire',
			'edit_item' => 'Modifier un partenaire',
			'new_item' => 'Nouveau partenaire',
			'view_item' => 'Afficher partenaire',
			'search_items' => 'Recherche un partenaire',
			'not_found' => 'Aucun partenaire',
			'not_found_in_trash' => 'Aucun partenaire',
			'parent_item_colon' => '',
			'menu_name' => 'Partenaires'
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
		      'menu_icon' => 'dashicons-businessman',
		      'supports' => array('title','excerpt','thumbnail', 'page-attributes')
		      ); 
	register_post_type(self::$partner_item_post_type, $args);
      });

    // Create a taxonomy for the partner post type
    add_action('init', function() {
	$args = array('hierarchical' => false);
	register_taxonomy(self::$partner_item_category, self::$partner_item_post_type, $args );
      }, 0);

    // Add theme support for featured images if not already present
    // http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
    add_action( 'after_setup_theme',
		function() {
		  $supportedTypes = get_theme_support( 'post-thumbnails' );
		  if( $supportedTypes === false ) {
		    add_theme_support( 'post-thumbnails', array( CrepanPartner::$partner_item_post_type ) );
		  } elseif( is_array( $supportedTypes ) ) {
		    $supportedTypes[0][] = CrepanPartner::$partner_item_post_type;
		    add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		  }
		  add_image_size(CrepanPartner::$featured_preview_image_size, 100, 55, true);
		  add_image_size(CrepanPartner::$partner_image_size, 1250, 500, true);
		}
		);
    add_filter('manage_'.self::$partner_item_post_type.'_posts_columns', function($defaults) {  
	$defaults[self::$featured_image_column_name] = __('Featured Image', 'crepan');
	return $defaults;  
      }  
      );  

    add_action('manage_'.self::$partner_item_post_type.'_posts_custom_column', function($column_name, $post_ID) {  
	if ($column_name == self::$featured_image_column_name) {  
	  $post_featured_image = self::get_featured_image($post_ID);  
	  if ($post_featured_image) {  
	    echo '<img src="' . $post_featured_image . '" />';
	  }  
	}  
      }, 10, 2);
  add_action("add_meta_boxes", 
	     function(){
	       add_meta_box("item_image_url", "Image Link URL", function($post){
		   CrepanPartner::render_image_url_metabox($post);
		     }, 
		 CrepanPartner::$partner_item_post_type, "side", "low");
	     }
	     );
  add_action("save_post", function($post_ID){
      if (isset($_POST[CrepanPartner::$item_image_url_meta])) {
	$openblank = 0;
	if(isset($_POST[CrepanPartner::$item_image_url_openblank_meta]) && $_POST[CrepanPartner::$item_image_url_openblank_meta] == '1'){
	  $openblank = 1;
	}
	update_post_meta($post_ID, CrepanPartner::$item_image_url_meta, esc_url($_POST[CrepanPartner::$item_image_url_meta]));
	update_post_meta($post_ID, CrepanPartner::$item_image_url_openblank_meta, $openblank);
      }
    }
    );


  }

  // Add column in admin list view to show featured image
  // http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
  public static function get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
      $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, self::$featured_preview_image_size);  
      return $post_thumbnail_img[0];  
    }  
  }


  // Extra admin field for image URL
  public static function render_image_url_metabox($post){
    $custom = get_post_custom($post->ID);
    $item_image_url = isset($custom[CrepanPartner::$item_image_url_meta]) ?  $custom[CrepanPartner::$item_image_url_meta][0] : '';
    $item_image_url_openblank = isset($custom[CrepanPartner::$item_image_url_openblank_meta]) ?  
    $custom[CrepanPartner::$item_image_url_openblank_meta][0] : '0';
    ?>
    <label><?php _e('Image URL', 'crepan'); ?>:</label>
    <input name="<?php echo CrepanPartner::$item_image_url_meta; ?>" value="<?php echo $item_image_url; ?>" /> <br />
    <small><em><?php _e('(optional - leave blank for no link)', 'crepan'); ?></em></small><br /><br />
    <label>
    <input type="checkbox" name="<?php echo CrepanPartner::$item_image_url_openblank_meta; ?>" 
    <?php if($item_image_url_openblank == 1){ echo ' checked="checked"'; } ?> value="1" /> 
    <?php _e('Open link in new window?', 'crepan'); ?>
    </label>
    <?php
  }

  public static function render($partner_id, $css_class){
    $atts = array();
    $args = array( 'post_type' => self::$partner_item_post_type, 
		   'posts_per_page' => '-1', 
		   'orderby' => 'menu_order', 
		   'order' => 'DESC');
    if(array_key_exists('category', $atts)){
      $args['partner_category'] = $atts['category'];
    }
    if(array_key_exists('id', $atts)){
      $args['p'] = $atts['id'];
    }
    $loop = new \WP_Query( $args );
    $images = array();
    while ( $loop->have_posts() ) {
      $loop->the_post();
      if ( '' != get_the_post_thumbnail() ) {
	$post_id = get_the_ID();
	$title = get_the_title();
	$content = get_the_excerpt();
	$image = get_the_post_thumbnail( get_the_ID(), CrepanPartner::$partner_image_size);
	$url = get_post_meta(get_the_ID(), 'cptbc_image_url', true);
	$url_openblank = get_post_meta(get_the_ID(), 'cptbc_image_url_openblank', true);
	$images[] = array('post_id' => $post_id, 
			  'title' => $title, 
			  'content' => $content, 
			  'image' => $image, 
			  'url' => esc_url($url), 
			  'url_openblank' => $url_openblank == "1" ? true : false);
      }
    }
    if(count($images) > 0){
      ob_start();
    ?>
      <div id="<?php echo $partner_id; ?>" 
           class="carousel slide <?php echo $css_class; ?>"
           data-keyboard="false">
         <div class="carousel-inner">
           <?php foreach ($images as $key => $image) {
      $linkstart = '';
      $linkend = '';
      if($image['url']) {
	$linkstart = '<a href="'.$image['url'].'"';
	if($image['url_openblank']) {
	  $linkstart .= ' target="_blank"';
	}
	$linkstart .= '>';
	$linkend = '</a>';
      }
      ?>
      <div class="item <?php echo $key == 0 ? 'active' : ''; ?>" >
        <?php echo $linkstart.$image['image'].$linkend; ?>
      </div>
      <?php } ?>
	     </div>
      <a class="left carousel-control" 
         href="#<?php echo $partner_id; ?>" 
         data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" 
         href="#<?php echo $partner_id; ?>" 
         data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </div>
  <?php }
  $output = ob_get_contents();
  ob_end_clean();
	
  // Restore original Post Data
  wp_reset_postdata();
	
  return $output;
}

}

CrepanPartner::init();