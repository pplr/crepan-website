<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <header class="page-header">
	<h1>
	  <?php if ( is_day() ) : ?>
	  Articles du  <?php echo get_the_date() ?>
	  <?php elseif ( is_month() ) : ?>
	  Articles du mois de <?php echo get_the_date("F Y") ?>
	  <?php  elseif ( is_year() ) : ?>
	  Articles de l’année  <?php echo get_the_date("Y") ?>
	  <?php  else : ?>
	  Archives
	  <?php endif; ?>
	</h1>
      </header><!-- .archive-header -->
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9 col-md-9">
      <?php if ( have_posts() ) : ?>

      <?php
	 /* Start the Loop */
	 while ( have_posts() ) : the_post();

	 /* Include the post format-specific template for the content. If you want to
	 * this in a child theme then include a file called called content-___.php
	 * (where ___ is the post format) and that will be used instead.
	 */
	 get_template_part('templates/content', get_post_format());

	 endwhile;


	 ?>

      <?php else : ?>
      <?php get_template_part( 'templates/content', 'none' ); ?>
      <?php endif; ?>

    </div><!-- #content -->

    <div class="col-lg-3 col-md-3">
      <?php dynamic_sidebar('sidebar-secondary'); ?>
      <h2>Archives par mois</h2>
      <ul>
	<?php wp_get_archives('type=monthly'); ?>
      </ul>
    </div>

  </div>
</div>

