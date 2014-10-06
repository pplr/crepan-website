<div class="home-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
	<?php echo namespace\crepan\carousel\render_carousel("carousel-home-header", "carousel-home-header") ?>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-crepan">
	<div class="panel-heading">Nos réseaux</div>
	<div class="list-group">
          <?php foreach (get_terms('network', array('hide_empty' => false)) as $term): ?>
	  <a class="list-group-item list-group-network-<?php echo $term->slug?>" href="#">
	    <?php echo $term->name ?>
	  </a>
          <?php endforeach; ?>
	</div>
      </div>

      <form role="search" 
	    method="get" 
	    action="<?php echo esc_url(home_url('/')); ?>">

	<div class="input-group">
	  <input type="text" class="form-control"
		 name="s"
		 placeholder="Rechercher dans le site">
	  <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
	</div>
      </form>

    </div>

    <div class="col-md-9">

   <?php 
   $args = array(
		 'post_type'  => 'post',
		 'posts_per_page' => 6,
		 'meta_query' => array(
				       array(
					     'key' => '_thumbnail_id',
					     'compare' => 'EXISTS'
					     )
				       )
		 );
    $the_query = new WP_Query( $args );?>

<?php if ( $the_query->have_posts() ) : ?>
<div id="home-actu-carousel" class="slide carousel carousel-hot-news "
     data-ride="carousel" data-interval="10000">
  <!-- Carousel items -->
  <div class="carousel-inner">
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="item <?php if($the_query->current_post == 0){echo "active";}?>" data-slide-number="<?php echo $the_query->current_post; ?>">
      <img class="img-rounded" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), array(800, 600))[0]; ?>"></div>
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

      <?php $args = array(
    'numberposts' => 10,
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
</section>
    </div>

  </div>

</div>

