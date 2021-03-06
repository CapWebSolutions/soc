<?php
/**
 * Template Name: Blank page
 **/

	get_header(); 
?>

<?php 
	
	
	//	 Get page layout & sidebar
	//
	$page_data = array();
	
	$page_data['page'] 		= ewf_get_page_relatedID();
	$page_data['sidebar'] 	= ewf_get_sidebar_id('sidebar-page', $page_data['page']);
	$page_data['layout'] 	= ewf_get_sidebar_layout("layout-full", $page_data['page']);
	$page_data['spans'] 	= ewf_get_sidebarSizes();
	$page_data['file'] 		= basename(__FILE__);
	
	
	
	
	switch ($page_data['layout']) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					if ( have_posts() ) while ( have_posts() ) : the_post(); 										
						echo the_content();
						wp_link_pages();
					endwhile; 
					echo '&nbsp;';
					
				echo '</div>';
				echo '</div>';
			echo '</div>';
			break;
	
		case "layout-sidebar-single-right": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['content'].'">';

					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						echo the_content();
						wp_link_pages();
					endwhile; 
					echo '&nbsp;';

				echo '</div>';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
				
			echo '</div>';
			echo '</div>';
			break; 
	
		case "layout-full": 
				if ( have_posts() ) while ( have_posts() ) : the_post(); 
				
					if (ewf_isComposerActive(get_the_content())){
					
						echo the_content();
						wp_link_pages();
						
						$page_data['isComposer'] = 'true';
					}else{
					
						echo '<div class="container">';
						echo '<div class="row ewf-no-composer">';
							echo '<div class="span12">';
							
								echo the_content();
								wp_link_pages();
								
							echo '</div>';
						echo '</div>';
						echo '</div>';
					
						$page_data['isComposer'] = 'false';
					}

				endwhile;  
	}

?>

<?php ewf_debug($page_data, 'content');	?>

<?php get_footer(); ?>