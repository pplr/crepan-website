
<div class="home-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
	  </ol>
	  <div class="carousel-inner">
            <div class="item">
              <img src="holder.js/1200x500/auto/#85d393:#6aa875/text:First
			slide" alt="First slide">
	      <div class="carousel-caption">
		<h3>Titre action phare I</h3>
		<p>Texte de présentation rapide</p>
	      </div>

            </div>
            <div class="item">
              <img src="holder.js/1200x500/auto/#79c8b0:#60a08c/text:Second
			slide" 
		   alt="Second slide">
	      <div class="carousel-caption">
		<h3>Titre action phare II</h3>
		<p>Texte de présentation rapide</p>
	      </div>

            </div>
            <div class="item active">
              <img src="holder.js/1200x500/auto/#555:#333/text:Third slide" 
		   alt="Third slide" >
	      <div class="carousel-caption">
		<h3>Titre action phare III</h3>
		<p>Texte de présentation rapide</p>
	      </div>

            </div>
	  </div>
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>

      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <div class="panel panel-default">
	<div class="panel-heading">Nos réseaux</div>
	<div class="list-group">
          <?php foreach (get_terms('network', array('hide_empty' => false)) as $term): ?>
	  <a class="list-group-item" href="#"><?php echo $term->name ?></a>
          <?php endforeach; ?>
	</div>
      </div>
    </div>

    <div class="col-md-7">

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

<script src="//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.js"></script>
