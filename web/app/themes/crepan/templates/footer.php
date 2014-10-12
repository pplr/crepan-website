<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>

<footer class="bottom-footer">
  <div class="navbar navbar-compact">
    <div class="container">
      <nav class="bottom-footer-nav">
	<?php
           if (has_nav_menu('footer_navigation')) :
           wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'nav navbar-nav navbar-right'));
        endif;
	?>
      </nav>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

