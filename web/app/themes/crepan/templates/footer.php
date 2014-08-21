<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>

<?php wp_footer(); ?>

<footer class="bottom-footer">
  <div class="container">
    <nav class="bottom-footer-nav">
      <?php
        if (has_nav_menu('footer_navigation')) :
          wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'bottom-footer-nav'));
        endif;
      ?>
    </nav>
  </div>
</footer>
