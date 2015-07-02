<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <?php while (have_posts()) : the_post(); ?>
      <article>
        <?php if(has_tag( 'communique-fne' )) : ?>
	<header class="page-header">
	  <img class="img-responsive" alt="Illustration communique
	       France Nature Environnement"
	       src="<?php echo get_template_directory_uri(); ?>/assets/img/cp_bandeau_OK.jpg"> 	  
	  <h3 class="text-center">Communiqué de presse</h3>
	  <p class="text-center"><time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time></p>
	  <h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<?php else : ?>
	<header class="page-header">
	  <h1 class="entry-title"><?php the_title(); ?></h1>
	  <?php get_template_part('templates/entry-meta'); ?>
	</header>
        <?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
	    <div class="entry-featured-image">
	       <?php the_post_thumbnail(CrepanHomepage::$article_image_size, array('class' => " img-responsive")); ?>
	</div>
	<?php endif; ?>

	
	<div class="entry-content">
	  <?php the_content(); ?>
	</div>
	<footer>
	  <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
	</footer>

      <section class="post-share-menu">
      <h4>Partager cet article</h4>
      <ul class="rrssb-buttons">
        <li class="rrssb-facebook">
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"
             class="popup">
            <span class="rrssb-icon">
              <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="29" height="29" viewBox="0 0 29 29">
                <path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"
                class="cls-2" fill-rule="evenodd" />
              </svg>
            </span>
            <span class="rrssb-text">facebook</span>
          </a>
        </li>
        <li class="rrssb-linkedin">
          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" class="popup">
            <span class="rrssb-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                <path d="M25.424 15.887v8.447h-4.896v-7.882c0-1.98-.71-3.33-2.48-3.33-1.354 0-2.158.91-2.514 1.802-.13.315-.162.753-.162 1.194v8.216h-4.9s.067-13.35 0-14.73h4.9v2.087c-.01.017-.023.033-.033.05h.032v-.05c.65-1.002 1.812-2.435 4.414-2.435 3.222 0 5.638 2.106 5.638 6.632zM5.348 2.5c-1.676 0-2.772 1.093-2.772 2.54 0 1.42 1.066 2.538 2.717 2.546h.032c1.71 0 2.77-1.132 2.77-2.546C8.056 3.593 7.02 2.5 5.344 2.5h.005zm-2.48 21.834h4.896V9.604H2.867v14.73z"
                />
              </svg>
            </span>
            <span class="rrssb-text">linkedin</span>
          </a>
        </li>
        <li class="rrssb-twitter">
          <a href="https://twitter.com/intent/tweet?url=<?php the_permalink() ?>"
          class="popup">
            <span class="rrssb-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                <path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62c-3.122.162-6.22-.646-8.86-2.32 2.702.18 5.375-.648 7.507-2.32-2.072-.248-3.818-1.662-4.49-3.64.802.13 1.62.077 2.4-.154-2.482-.466-4.312-2.586-4.412-5.11.688.276 1.426.408 2.168.387-2.135-1.65-2.73-4.62-1.394-6.965C5.574 7.816 9.54 9.84 13.802 10.07c-.842-2.738.694-5.64 3.434-6.48 2.018-.624 4.212.043 5.546 1.682 1.186-.213 2.318-.662 3.33-1.317-.386 1.256-1.248 2.312-2.4 2.942 1.048-.106 2.07-.394 3.02-.85-.458 1.182-1.343 2.15-2.48 2.71z"
                />
              </svg>
            </span>
            <span class="rrssb-text">twitter</span>
          </a>
        </li>
        <li class="rrssb-googleplus">
          <a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="popup">
            <span class="rrssb-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                <path d="M14.703 15.854l-1.22-.948c-.37-.308-.88-.715-.88-1.46 0-.747.51-1.222.95-1.662 1.42-1.12 2.84-2.31 2.84-4.817 0-2.58-1.62-3.937-2.4-4.58h2.098l2.203-1.384h-6.67c-1.83 0-4.467.433-6.398 2.027C3.768 4.287 3.06 6.018 3.06 7.576c0 2.634 2.02 5.328 5.603 5.328.34 0 .71-.033 1.083-.068-.167.408-.336.748-.336 1.324 0 1.04.55 1.685 1.01 2.297-1.523.104-4.37.273-6.466 1.562-1.998 1.187-2.605 2.915-2.605 4.136 0 2.512 2.357 4.84 7.288 4.84 5.822 0 8.904-3.223 8.904-6.41.008-2.327-1.36-3.49-2.83-4.73h-.01zM10.27 11.95c-2.913 0-4.232-3.764-4.232-6.036 0-.884.168-1.797.744-2.51.543-.68 1.49-1.12 2.372-1.12 2.807 0 4.256 3.797 4.256 6.24 0 .613-.067 1.695-.845 2.48-.537.55-1.438.947-2.295.95v-.003zm.032 13.66c-3.62 0-5.957-1.733-5.957-4.143 0-2.408 2.165-3.223 2.91-3.492 1.422-.48 3.25-.545 3.556-.545.34 0 .52 0 .767.034 2.574 1.838 3.706 2.757 3.706 4.48-.002 2.072-1.736 3.664-4.982 3.648l.002.017zM23.254 11.89V8.52H21.57v3.37H18.2v1.714h3.367v3.4h1.684v-3.4h3.4V11.89"
                />
              </svg>
            </span>
            <span class="rrssb-text">google+</span>
          </a>
        </li>
        <li class="rrssb-pinterest">
          <!-- Replace href with your meta and URL information.  -->
          <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&amp;description=<?php the_title() ?>">
            <span class="rrssb-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                <path d="M14.02 1.57c-7.06 0-12.784 5.723-12.784 12.785S6.96 27.14 14.02 27.14c7.062 0 12.786-5.725 12.786-12.785 0-7.06-5.724-12.785-12.785-12.785zm1.24 17.085c-1.16-.09-1.648-.666-2.558-1.22-.5 2.627-1.113 5.146-2.925 6.46-.56-3.972.822-6.952 1.462-10.117-1.094-1.84.13-5.545 2.437-4.632 2.837 1.123-2.458 6.842 1.1 7.557 3.71.744 5.226-6.44 2.924-8.775-3.324-3.374-9.677-.077-8.896 4.754.19 1.178 1.408 1.538.49 3.168-2.13-.472-2.764-2.15-2.683-4.388.132-3.662 3.292-6.227 6.46-6.582 4.008-.448 7.772 1.474 8.29 5.24.58 4.254-1.815 8.864-6.1 8.532v.003z"
                />
              </svg>
            </span>
            <span class="rrssb-text">pinterest</span>
          </a>
        </li>
      </ul>
      </section>
      <?php comments_template('/templates/comments.php'); ?>
      </article>
      <?php endwhile; ?>
    </div>
  </div>
</div>
