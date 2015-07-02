<?php 
class CrepanMeta{

  public static function init(){
    add_action('wp_head', function(){CrepanMeta::wpHeadAction();}, 10, 0);
  }

  public static function wpHeadAction(){
    if(is_single()){
      $_post = get_queried_object();
      $m = new CrepanPostMeta($_post);
      $m->render();
    }
  }
  
}


class CrepanPostMeta{

  private $post;

  function __construct($post) {
    $this->post = $post;
  }

  private function url() {
    return get_permalink( $this->post->ID );
  }

  private function excerpt(){
    return $this->post->post_excerpt;
  }

  public function render(){
    ?>
<meta property="og:title" content="<?php echo esc_attr($this->post->post_title); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo $this->url(); ?>" />
      <?php
      if(has_post_thumbnail($this->post->ID)){
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'full' );
?>
<meta property="og:image" content="<?php echo $image_url[0]; ?>" />
      <?php
      }
      if(!empty($this->post->post_excerpt)){
?>
<meta property="og:description" content="<?php echo esc_attr($this->post->post_excerpt); ?>"/>
<?php
      }
      ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@crepan">
	<?php
/* <meta name="twitter:creator" content="@crepan"> */
  }
}

CrepanMeta::init();