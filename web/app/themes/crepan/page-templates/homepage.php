<?php
/**
 * Template Name: Accueil
 * 
 * Description: Page d’accueil du site
 */?>

<div class="home-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
	<?php echo CrepanCarousel::render("carousel-home-header", "carousel-home-header") ?>
      </div>
    </div>

    <?php
       $args = array(
       'post_type'  => CrepanQuote::$quote_post_type,
    'posts_per_page' => 1
    );

    $quotes = get_posts( $args );
    foreach ( $quotes as $quote ) :?>
    <blockquote class="homepage-quote">
      <p><?php echo $quote->post_excerpt ?></p>
      <?php $authors = wp_get_post_terms($quote->ID,
      CrepanQuote::$quote_author_taxonomy); ?>
      <footer><cite class="homepage-quote-author"><?php echo implode(", ", array_map(function($tax){return
							$tax->name;}, $authors)); ?>
      </cite></footer>
    </blockquote>
    <?php endforeach; ?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-lg-push-2 col-md-9 col-md-push-3">

	<?php 

	   $sticky = get_option( 'sticky_posts' );
	   $args = array(
	   'post_type'  => 'post',
	'posts_per_page' => 3,
        'post__in'  => $sticky,
        'ignore_sticky_posts' => 1,
	'meta_query' => array(
	array(
	'key' => '_thumbnail_id',
	'compare' => 'EXISTS'
	)
	)
	);
	$the_query = new WP_Query( $args );
	$home_actu_carousel_post_ids = array_map(function($p){return $p->ID;}, $the_query->get_posts());
	?>

	<?php if ( $the_query->have_posts() ) : ?>

	<div id="home-actu-carousel" class="slide carousel carousel-hot-news "
	     data-ride="carousel" data-interval="10000">
	  <div class="carousel-inner">
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	    <div class="item <?php if($the_query->current_post == 0){echo "active";}?>" data-slide-number="<?php echo $the_query->current_post; ?>">
	      <img class="img-rounded" src="<?php echo
					    wp_get_attachment_image_src(get_post_thumbnail_id(), CrepanHomepage::$hot_news_image_size)[0]; ?>"></div>
	    <?php endwhile; ?>
	    <?php $the_query->rewind_posts(); ?>
	  </div>
	  <ul class="carousel-indicators">

	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	    <li class="<?php if($the_query->current_post == 0){echo "active";}?>">
	      <div class="indicator-content">
		<div class="indicator-date"
		     data-slide-to="<?php echo $the_query->current_post; ?>" 
		     data-target="#home-actu-carousel"><?php the_time("d-m-Y"); ?></div>
		<div class="indicator-excerpt"
		     data-slide-to="<?php echo $the_query->current_post; ?>" 
		     data-target="#home-actu-carousel"><?php the_title(); ?></div>
		<a href="<?php the_permalink(); ?>">En savoir plus</a>
	      </div>
	    </li>
	    <?php endwhile; ?>
	  </ul>
	</div>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<section>
	  <h2>Actualité</h2>
	  <?php $args = array('post__not_in' => $home_actu_carousel_post_ids,
	  'posts_per_page' => 5,
	  'orderby' => 'post_date',
	  'order' => 'DESC',
	  'post_type' => 'post',
	  'post_status' => 'publish' );
	  $the_query = new WP_Query( $args );
	  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	  <article class="home-article">
	    <a href="<?php the_permalink() ?>">
	      <header>
		<time datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date(''); ?></time>
		<h3><?php the_title() ?></h3>
	      </header>
	      <?php the_excerpt() ?>
	    </a>
	  </article>
	  <?php endwhile; ?>
		<?php if(get_option("show_on_front") == "page") : ?>
		    <p><a href="<?php echo get_permalink(get_option("page_for_posts"))?>">Voir tous les articles</a></p>
		    <?php endif; ?>

	</section>
      </div>
      <div class="col-lg-2 col-lg-pull-7 col-md-3 col-md-pull-9 col-xs-6">
	<?php dynamic_sidebar('sidebar-primary'); ?>
      </div>
      <div class="col-lg-3 col-lg-pull-0 col-md-3 col-md-pull-9 col-xs-6">
	<?php dynamic_sidebar('sidebar-secondary'); ?>
      </div>
    </div>
  </div>
