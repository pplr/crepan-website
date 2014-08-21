<header class="top-header">
  <div class="container">
    <nav class="top-header-nav">
      <a href="#">Espace membre</a> | <a href="#">S’inscrire</a>
    </nav>
  </div>
</header>

<header class="navbar navbar-default" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i></a></li>
      </ul>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
      <ul class="nav navbar-nav navbar-social-networks navbar-right">
        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
        <li><a href="#"><i class="fa fa-rss"></i></a></li>
      </ul>
    </nav>
  </div>
</header>
