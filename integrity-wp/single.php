<?php get_header(); ?>

<?php 
	
	global $ewf_theme_settings;
	
	$page_data = array();
	
	$page_data['blog'] 		= ewf_get_page_relatedID();
	$page_data['layout'] 	= ewf_get_sidebar_layout( $ewf_theme_settings['blog']['layout'], $page_data['blog'] );
	$page_data['sidebar'] 	= ewf_get_sidebar_id( $ewf_theme_settings['blog']['sidebar'] , $page_data['blog']);
	$page_data['spans'] 	= ewf_get_sidebarSizes();
	$page_data['source'] 	= 'single.php';
	
	
	switch ($page_data['layout']) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
				
					dynamic_sidebar($page_data['sidebar']);
					
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part('templates/blog-item-default');
					endwhile; 
					
				echo '</div>';
			echo '</div>';		
			echo '</div>';		
			break;
			
	
		case "layout-sidebar-single-right":
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['content'].'">';
					
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part('templates/blog-item-default');
					endwhile; 
						
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
				
					dynamic_sidebar($page_data['sidebar']);
					
				echo '</div>';
			echo '</div>';	
			echo '</div>';	
			break;
	
		case "layout-full": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span12">';
				
					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						get_template_part('templates/blog-item-default');
					endwhile; 
					
				echo '</div>';
			echo '</div>';	
			echo '</div>';	
			break;
			
	}
	
?>

<?php

	//	Debug info
	//
	if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
		echo '<pre>';
			print_r($page_data);
		echo '</pre>';
	}
	
?>
	
<?php get_footer(); ?>