<?php $term = get_term_by( 'slug', get_query_var( 'term' ),
	get_query_var( 'taxonomy' ) ); ?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-header page-header-network page-header-network-<?php echo $term->slug?>">
	<img class="network-logo"
	   src="<?php echo get_template_directory_uri(); ?>/assets/img/network-<?php echo $term->slug ?>.svg"> 
	<h1>
	  Réseau <?php echo $term->name; ?>
	</h1>

      </div>

      <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
	<?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
      <?php endif; ?>

      <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', get_post_format()); ?>
      <?php endwhile; ?>

      <?php if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav">
	<ul class="pager">
	  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
	  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
	</ul>
      </nav>
      <?php endif; ?>

    </div>
  </div>
</div>
