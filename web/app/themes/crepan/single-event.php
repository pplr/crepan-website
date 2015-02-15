<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
	  <h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<div class="entry-content">
	  <div class="row">
	    <div class="col-md-8">
	      <?php the_content(); ?>
	    </div>
	    <div class="col-md-4">
	      <?php eo_get_template_part('event-meta','event-single'); ?>
	    </div>
	  </div>
	</div>
	<?php comments_template('/templates/comments.php'); ?>
      </article>

      <?php endwhile; ?>

    </div>
  </div>
</div>


