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
    <div class="col-md-2">
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
    </div>

    <div class="col-md-7">
      <div id="home-actu-carousel" class="slide row carousel carousel-hot-news "
	   data-ride="carousel" data-interval="10000">
	  <!-- Carousel items -->
	  <div class="carousel-inner">
	    <div class="active item" data-slide-number="0">
	      <img class="img-rounded" src="http://lorempixel.com/800/600"></div>
	    <div class="item" data-slide-number="1">
	      <img class="img-rounded" src="http://lorempixel.com/800/600/business/3"></div>
	    <div class="item" data-slide-number="2">
	      <img class="img-rounded" src="http://lorempixel.com/800/600/business/1"></div>
	  </div>
	  <ul class="carousel-indicators">
	    <li class="active" data-slide-to="0" data-target="#home-actu-carousel">
	      <div class="indicator-content">
		<div class="indicator-date">15-08-2014</div>
		<div class="indicator-excerpt">Fermeture définitive du site GDE à Nonant-Le-Pin :
		  victoire pour les associations ...</div>
		<a href="#">En savoir plus</a>
	      </div>
	    </li>
	    <li data-slide-to="1" data-target="#home-actu-carousel">
	      <div class="indicator-content">
		<div class="indicator-date">14-09-2014</div>
		<div class="indicator-excerpt">Inscription à la journée de formation pour les
		  élus sur le gaspillage alimentaire ...</div>
		<a href="#">En savoir plus</a>
	      </div>
	    </li>
	    <li data-slide-to="2" data-target="#home-actu-carousel">
	      <div class="indicator-content">
		<div class="indicator-date">13-08-2014</div>
		<div class="indicator-excerpt">Communiqué de presse - Mardi 10 juin 2014 - La
		  biodiversité vaut bien une loi ...</div>
		<a href="#">En savoir plus</a>
	      </div>
	    </li>
	  </ul>
      </div>

    </div>

    <div class="col-md-3">
      <div class="input-group">
	<input type="text" class="form-control"
	       placeholder="Rechercher dans le site">
	<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
      </div>

    </div>
  </div>

</div>


