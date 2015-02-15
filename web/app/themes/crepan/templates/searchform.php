<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'roots'); ?></label>
  <div class="input-group">
    <input type="search" 
	   value="<?php echo get_search_query(); ?>" 
	   name="s" 
	   class="search-field form-control" 
	   placeholder="Rechercher dans le site">
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default">
	<span class="glyphicon glyphicon-search"></span>
      </button>
    </span>
  </div>
</form>

