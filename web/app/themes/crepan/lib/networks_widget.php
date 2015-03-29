<?php

class Crepan_NetworksWidget extends WP_Widget {

	function Crepan_NetworksWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'Nos réseaux' );
	}

	function widget( $args, $instance ) {
	  echo '<div class="panel panel-crepan">';
	  echo '<div class="panel-heading">Nos réseaux</div>';
	  echo '<div class="list-group">';
          foreach (get_terms('network', array('hide_empty' => false)) as $term){
	    echo '<a class="list-group-item list-group-network list-group-network-' . $term->slug . '"';
	    echo 'href="' . esc_url(get_term_link($term)) . '">';
	    echo $term->name;
	    echo '</a>';
	  }
	  echo '</div>';
	  echo '<div class="panel-body">';
	  echo '<div class="text-center">Partenaire</div>';
	  echo CrepanPartner::render("carousel-partner", "carousel-partner");
	  echo '</div>';
          echo '</div>';

	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'Crepan_NetworksWidget' );
});

