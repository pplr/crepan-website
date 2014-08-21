<?php
namespace crepan\carousel;

$carousel_item_post_type = "carousel_item";
$carousel_item_category = "carousel_item_category";

add_action('init', function() {
    global $carousel_item_post_type;
    $labels = array(
		    'name' => __('Carousel Images', 'crepan-theme'),
		    'singular_name' => __('Carousel Image', 'crepan-theme'),
		    'add_new' => __('Add New', 'crepan-theme'),
		    'add_new_item' => __('Add New Carousel Item', 'crepan-theme'),
		    'edit_item' => __('Edit Carousel Item', 'crepan-theme'),
		    'new_item' => __('New Carousel Item', 'crepan-theme'),
		    'view_item' => __('View Carousel Item', 'crepan-theme'),
		    'search_items' => __('Search Carousel Items', 'crepan-theme'),
		    'not_found' => __('No Carousel Item', 'crepan-theme'),
		    'not_found_in_trash' => __('No Carousel Items found in Trash', 'crepan-theme'),
		    'parent_item_colon' => '',
		    'menu_name' => __('Carousel Items', 'crepan-theme')
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
		  'supports' => array('title','excerpt','thumbnail', 'page-attributes')
		  ); 
    register_post_type($carousel_item_post_type, $args);
  });

// Create a taxonomy for the carousel post type
add_action('init', function() {
    global $carousel_item_post_type;
    global $carousel_item_category;

    $args = array('hierarchical' => false);
    register_taxonomy($carousel_item_category, $carousel_item_post_type, $args );
  }, 0);



$featured_preview_image_size = 'featured_preview';

// Add theme support for featured images if not already present
// http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
add_action( 'after_setup_theme',
	    function() {
	      global $featured_preview_image_size;
	      global $carousel_item_post_type;
	      $supportedTypes = get_theme_support( 'post-thumbnails' );
	      if( $supportedTypes === false ) {
		add_theme_support( 'post-thumbnails', array( $carousel_item_post_type ) );
	      } elseif( is_array( $supportedTypes ) ) {
		$supportedTypes[0][] = $carousel_item_post_type;
		add_theme_support( 'post-thumbnails', $supportedTypes[0] );
	      }
	      add_image_size($featured_preview_image_size, 100, 55, true);
	    }
	    );

// Add column in admin list view to show featured image
// http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
function get_featured_image($post_ID) {  
  global $featured_preview_image_size;
  $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
  if ($post_thumbnail_id) {  
    $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, $featured_preview_image_size);  
    return $post_thumbnail_img[0];  
  }  
}

$featured_image_column_name = 'featured_image';

add_filter('manage_'.$carousel_item_post_type.'_posts_columns', function($defaults) {  
    global $featured_image_column_name;
    $defaults[$featured_image_column_name] = __('Featured Image', 'crepan');
    return $defaults;  
  }  
  );  

add_action('manage_'.$carousel_item_post_type.'posts_custom_column', function($column_name, $post_ID) {  
    global $featured_image_column_name;
    if ($column_name == $featured_image_column_name) {  
      $post_featured_image = get_featured_image($post_ID);  
      if ($post_featured_image) {  
	echo '<a href="'.get_edit_post_link($post_ID).'"><img src="' . $post_featured_image . '" /></a>';  
      }  
    }  
  }, 10, 2);

$item_image_url_meta = "item_image_url";
$item_image_url_openblank_meta = "item_image_url_openblank";

// Extra admin field for image URL
$render_image_url_metabox = function(){
  global $post;
  global $item_image_url_meta;
  global $item_image_url_openblank_meta;

  $custom = get_post_custom($post->ID);
  $item_image_url = isset($custom[$item_image_url_meta]) ?  $custom[$item_image_url_meta][0] : '';
  $item_image_url_openblank = isset($custom[$item_image_url_openblank_meta]) ?  
  $custom[$item_image_url_openblank_meta][0] : '0';
  ?>
    <label><?php _e('Image URL', 'crepan'); ?>:</label>
    <input name="<?php echo $item_image_url_meta; ?>" value="<?php echo $item_image_url; ?>" /> <br />
    <small><em><?php _e('(optional - leave blank for no link)', 'crepan'); ?></em></small><br /><br />
    <label>
      <input type="checkbox" 
             name="<?php echo $item_image_url_openblank_meta; ?>" 
             <?php if($item_image_url_openblank == 1){ echo ' checked="checked"'; } ?> 
             value="1" /> 
      <?php _e('Open link in new window?', 'crepan'); ?>
    </label>
 <?php
};


add_action("add_meta_boxes", 
	   function(){
	     global $carousel_item_post_type;
	     global $render_image_url_metabox;
	     add_meta_box("item_image_url", "Image Link URL", $render_image_url_metabox, 
			  $carousel_item_post_type, "side", "low");
	   }
	   );

add_action('save_post', function(){
    global $post;
    global $item_image_url_meta;
    global $item_image_url_openblank_meta;

    if (isset($_POST[$item_image_url_meta])) {
      $openblank = 0;
      if(isset($_POST[$item_image_url_openblank_meta]) && $_POST[$item_image_url_openblank_meta] == '1'){
	$openblank = 1;
      }
      update_post_meta($post->ID, $item_image_url_meta, esc_url($_POST[$item_image_url_meta]));
      update_post_meta($post->ID, $item_image_url_openblank_meta, $openblank);
    }
  }
  );



function render_carousel($carousel_id, $css_class){
  global $carousel_item_post_type;
  $atts = array();
  $args = array( 'post_type' => $carousel_item_post_type, 
		 'posts_per_page' => '-1', 
		 'orderby' => 'menu_order', 
		 'order' => 'DESC');
  if(array_key_exists('category', $atts)){
    $args['carousel_category'] = $atts['category'];
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
      $image = get_the_post_thumbnail( get_the_ID(), 'full');
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
      <div id="<?php echo $carousel_id; ?>" 
           class="carousel slide <?php echo $css_class; ?>" 
           data-ride="carousel"
           data-interval="10000">
	 <ol class="carousel-indicators">
	 <?php foreach ($images as $key => $image): ?>
           <li data-target="#<?php echo $carousel_id; ?>" 
               data-slide-to="<?php echo $key; ?>" 
               class="<?php echo $key == 0 ? 'active' : ''; ?>"></li>
         <?php endforeach ?>
	 </ol>
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
	<div class="carousel-caption">
	    <h3><?php echo $linkstart.$image['title'].$linkend; ?></h3>
            <p><?php echo $linkstart.$image['content'].$linkend; ?></p>
        </div>
      </div>
      <?php } ?>
	     </div>
      <a class="left carousel-control" 
         href="#<?php echo $carousel_id; ?>" 
         data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" 
         href="#<?php echo $carousel_id; ?>" 
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
