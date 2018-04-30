<form method="get" class="searchform" action="<?php echo esc_url( home_url() ); ?>/">
	<div>
		<label class="screen-reader-text" for="s"><?php _e('Search for:', EWF_SETUP_THEME_DOMAIN); ?></label> 
		<input type="text" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search', EWF_SETUP_THEME_DOMAIN); ?>" name="s" id="s" />
		<input id="type" name="post_type" value="post" type="hidden">
		<input id="searchsubmit" type="submit" value="">
	</div>
</form>