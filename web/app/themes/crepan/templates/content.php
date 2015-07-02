<article <?php post_class(); ?>>
  <?php if(has_tag( 'communique-fne' )) : ?>
  <header class="page-header">
    <!-- <img class="img-responsive" alt="Illustration communiqué -->
    <!-- 				     France Nature Environnement" -->
    <!-- 	 src="<?php echo get_template_directory_uri(); ?>/assets/img/cp_bandeau_OK.jpg"> 	   -->
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><b>Communiqué de presse</b> du <time class="published" datetime="<?php echo
							 get_the_time('c'); ?>"><?php echo
										      get_the_date('l j F Y'); ?></time></p>

</header>
<?php else : ?>
<header class="page-header">
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php get_template_part('templates/entry-meta'); ?>
</header>
<?php endif; ?>
<header>
</header>
<div class="entry-summary">
  <?php the_excerpt(); ?>
</div>
</article>
