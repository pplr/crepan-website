<?php 

class CrepanVolunteer{
  public static $volunteer_item_post_type = "volunteer_item";
  public static $volunteer_item_category = "volunteer_item_category";
  public static $featured_preview_image_size = 'featured_preview';
  public static $volunteer_image_size = 'volunteers-widget';
  public static $featured_image_column_name = 'featured_image';

  public static function init(){
    add_action('init', function() {
	$labels = array(
			'name' => 'Bénévoles',
			'singular_name' => 'Bénévole',
			'add_new' => 'Ajouter',
			'add_new_item' => 'Ajouter un bénévole',
			'edit_item' => 'Modifier un bénévole',
			'new_item' => 'Nouveau bénévole',
			'view_item' => 'Afficher bénévole',
			'search_items' => 'Recherche un bénévole',
			'not_found' => 'Aucun bénévole',
			'not_found_in_trash' => 'Aucun bénévole',
			'parent_item_colon' => '',
			'menu_name' => 'Bénévoles'
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
		      'menu_icon' => 'dashicons-businessman',
		      'supports' => array('title','editor', 'excerpt','thumbnail')
		      ); 
	register_post_type(self::$volunteer_item_post_type, $args);
      });

    // Create a taxonomy for the volunteer post type
    add_action('init', function() {
	$args = array('hierarchical' => false);
	register_taxonomy(self::$volunteer_item_category, self::$volunteer_item_post_type, $args );
      }, 0);

    // Add theme support for featured images if not already present
    // http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
    add_action( 'after_setup_theme',
		function() {
		  $supportedTypes = get_theme_support( 'post-thumbnails' );
		  if( $supportedTypes === false ) {
		    add_theme_support( 'post-thumbnails', array( CrepanVolunteer::$volunteer_item_post_type ) );
		  } elseif( is_array( $supportedTypes ) ) {
		    $supportedTypes[0][] = CrepanVolunteer::$volunteer_item_post_type;
		    add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		  }
		  add_image_size(CrepanVolunteer::$featured_preview_image_size, 100, 55, true);
		  add_image_size(CrepanVolunteer::$volunteer_image_size, 128, 128, true);
		}
		);
    add_filter('manage_'.self::$volunteer_item_post_type.'_posts_columns', function($defaults) {  
	$defaults[self::$featured_image_column_name] = __('Featured Image', 'crepan');
	return $defaults;  
      }  
      );  

    add_action('manage_'.self::$volunteer_item_post_type.'_posts_custom_column', function($column_name, $post_ID) {  
	if ($column_name == self::$featured_image_column_name) {  
	  $post_featured_image = self::get_featured_image($post_ID);  
	  if ($post_featured_image) {  
	    echo '<img src="' . $post_featured_image . '" />';
	  }  
	}  
      }, 10, 2);

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


  public static function render($volunteer_id, $css_class){
    $atts = array();
    $args = array( 'post_type' => self::$volunteer_item_post_type, 
		   'posts_per_page' => '-1', 
		   'orderby' => 'menu_order', 
		   'order' => 'DESC');
    if(array_key_exists('category', $atts)){
      $args['volunteer_category'] = $atts['category'];
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
	$image = get_the_post_thumbnail( get_the_ID(), CrepanVolunteer::$volunteer_image_size);
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
      <div id="<?php echo $volunteer_id; ?>" 
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
         href="#<?php echo $volunteer_id; ?>" 
         data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" 
         href="#<?php echo $volunteer_id; ?>" 
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

CrepanVolunteer::init();

class Crepan_VolunteersWidget extends WP_Widget {

	function Crepan_VolunteersWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'Bénévoles' );
	}

	function widget( $args, $instance ) {

	  $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Bénévoles' : $instance['title'], $instance, $this->id_base );

	  echo $args['before_widget'];
	  if ( $title ) {
	    echo $args['before_title'] . $title . $args['after_title'];
	  }

	  $query_args = array( 'post_type' => CrepanVolunteer::$volunteer_item_post_type, 
			 'pagination' => false,
			 'posts_per_page' => '5');
	  $my_query = new \WP_Query( $query_args );

	  if ( $my_query->have_posts() ) { 
	    while ( $my_query->have_posts() ) { 
	      $my_query->the_post();
	      echo '<div class="media">';

	      echo '<div class="media-body">';
	      the_title( '<h4 class="media-heading">', '</h4>' );
	      the_content();
	      echo '</div>';

	      echo '<div class="media-right">';
	      if ( has_post_thumbnail() ) {
		the_post_thumbnail(CrepanVolunteer::$volunteer_image_size, array('class' => "media-object volunteer-widget-media-object"));
	      }
	      echo '</div>';

	      echo '</div>';
	    }
	  }
	  wp_reset_postdata();

	  

	  
	  echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
		// Save widget options
	}

	function form( $instance ) {
	  $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
	  $title = strip_tags($instance['title']);
	  ?>
	    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
          <?php	  
        }
}

add_action( 'widgets_init', function(){
     register_widget( 'Crepan_VolunteersWidget' );
});

