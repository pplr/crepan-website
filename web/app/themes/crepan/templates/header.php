<header class="top-header navbar navbar-compact">
  <div class="container">
    <!-- <nav class="top-header-nav"> -->
    <!--   <ul class="nav navbar-nav navbar-right"> -->
    <!--     <li class="social-link"><a href="#"><i class="fa fa-facebook-square"></i></a></li> -->
    <!--     <li class="social-link"><a href="#"><i class="fa fa-google-plus-square"></i></a></li> -->
    <!--     <li class="social-link"><a href="#"><i class="fa fa-rss"></i></a></li> -->
    <!-- 	<li><a href="#">Espace membre</a></li> -->
    <!-- 	<li><a href="#">S’inscrire</a></li> -->

    <!--   </ul> -->
    <!-- </nav> -->
   <p class="top-header-text">Comité Régional d’Étude pour la Protection et l’Aménagement de la Nature en Basse-Normandie</p>

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
      <a class="navbar-brand crepan-brand" 
         href="<?php echo esc_url(home_url('/')); ?>">
	<img alt="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-crepan.svg"/></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <!-- <ul class="nav navbar-nav navbar-left"> -->
        <!-- <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i></a></li> -->
      <!-- </ul> -->
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    <div class="navbar-right-logo navbar-right-logo-fne">
        <a href="http://www.fne.asso.fr/" target="_blank"><img alt="Logo France Nature Environnement" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-fne.png"></img></a>
    </div>
    </nav>
  </div>
</header>
