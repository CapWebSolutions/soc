<?php get_header(); ?>

<?php

	global $wp_query, $more, $ewf_theme_settings;
	
	
	
	#	Display page results info box
	#
	$ewf_search_result_message = null;
	if ($wp_query->found_posts == 0){
		$ewf_search_result_message = '<div class="alert info">'.__('The search for', EWF_SETUP_THEME_DOMAIN).' "<strong>'.$wp_query->query_vars['s'].'</strong>" '.__('returned no posts.', EWF_SETUP_THEME_DOMAIN).'</div>';
	}else{
		$ewf_search_result_message = '<div class="alert info">'.__('Search results for', EWF_SETUP_THEME_DOMAIN).': <strong>'.$wp_query->query_vars['s'].'</strong></div>';
	} 
	
	
	
	#	 Get page layout & sidebar
	#
	$page_data = array();
	
	$page_data['page'] 		= ewf_get_page_relatedID();
	$page_data['sidebar'] 	= ewf_get_sidebar_id( $ewf_theme_settings['blog']['sidebar'] , $page_data['page'] );
	$page_data['layout'] 	= ewf_get_sidebar_layout( $ewf_theme_settings['blog']['layout']	, $page_data['page'] );
	$page_data['spans'] 	= ewf_get_sidebarSizes();
	$page_data['template'] 	= 'templates/blog-item-default';
	$page_data['source'] 	= 'search.php';

		
	# Scenario where search is made on full site or just on the blog
	# 
	if (!array_key_exists('post_type', $_GET)){
		$page_data['search-type'] 	= 'site';
		$page_data['layout'] 		= "layout-full-site"; 
		$page_data['template'] 		= 'templates/search-item-default';
		$page_data['sidebar'] 		= ewf_get_sidebar_id( $ewf_theme_settings['page']['sidebar']);
	}else{
		$page_data['search-type'] 	= 'blog';
	}
	
	
	switch ($page_data['layout']) {
	
		#	Seach on blog using right sidebar
		#			
		case "layout-sidebar-single-left": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
				
					dynamic_sidebar($page_data['sidebar']);
					
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					echo wp_kses_post($ewf_search_result_message);
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part($page_data['template']);
					endwhile; 
					
					echo ewf_sc_blog_navigation_pages(4, $wp_query);
						
				echo '</div>';
			echo '</div>';
			echo '</div>';
			break;
		
		
		# 	Seach on blog using right sidebar
		#			
		case "layout-sidebar-single-right": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					echo wp_kses_post($ewf_search_result_message);
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part($page_data['template']);
					endwhile; 
					
					echo ewf_sc_blog_navigation_pages(4, $wp_query);
						
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
				
					dynamic_sidebar($page_data['sidebar']);
					
				echo '</div>';
			echo '</div>';
			echo '</div>';
			break;
	
	
		#	Seach on blog using full content
		#
		case "layout-full": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span12">';
				
					echo wp_kses_post($ewf_search_result_message);
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part($page_data['template']);
					endwhile; 
					
					echo ewf_sc_blog_navigation_pages(4, $wp_query);
				
				echo '</div>';
			echo '</div>';
			echo '</div>';
			break;
			
			
		# 	Seach on site using full content
		#
		case "layout-full-site": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span12">';
				
					echo wp_kses_post($ewf_search_result_message);
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part($page_data['template']);
					endwhile; 
					
					echo ewf_sc_blog_navigation_pages(4, $wp_query);
					
				echo '</div>';
			echo '</div>';
			echo '</div>';
			break;

	}

?>

<?php

	//	Debug info
	//
	ewf_debug($page_data);
	
?>
	
<?php get_footer(); ?>