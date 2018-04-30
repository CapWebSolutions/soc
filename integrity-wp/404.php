<?php  get_header(); ?>

<?php

	#	Get page layout & sidebar
	#
	
	$page_data = array();
	$page_data['page-404'] 	= get_option(EWF_SETUP_THNAME."_page_404", 0);
	$page_data['spans'] 	= ewf_get_sidebarSizes();
	$page_data['source'] 	= '404.php';
	
	
	if ($page_data['page-404']){
	
		$page_data['sidebar'] = ewf_get_sidebar_id('sidebar-page', $page_data['page-404']);		
		$page_data['layout'] = ewf_get_sidebar_layout('layout-full', $page_data['page-404']);
		
		$page_content = get_post($page_data['page-404']);
		$page_data['content'] = $page_content->post_content;
		
		switch ($page_data['layout']){
		
			case "layout-sidebar-single-left": 
				echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="span'.$page_data['spans']['sidebar'].'">';
						dynamic_sidebar($page_data['sidebar']);
					echo '</div>';
					echo '<div class="span'.$page_data['spans']['content'].'">';
						
						echo do_shortcode($page_data['content']);
						
					echo '</div>';
				echo '</div>';
				echo '</div>';
				break;
		
			case "layout-sidebar-single-right": 
				echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="span'.$page_data['spans']['content'].'">';

						echo do_shortcode($page_data['content']);

					echo '</div>';
					echo '<div class="span'.$page_data['spans']['sidebar'].'">';
						dynamic_sidebar($page_data['sidebar']);
					echo '</div>';
				echo '</div>';
				echo '</div>';
				break; 
		
		case "layout-full": 
				
			if (ewf_isComposerActive($page_data['content'])){
				echo do_shortcode($page_data['content']);
				
				$page_data['isComposer'] = 'true';
			}else{
			
				echo '<div class="container">';
				echo '<div class="row ewf-no-composer">';
					echo '<div class="span12">';
					
						echo do_shortcode($page_data['content']);
						
					echo '</div>';
				echo '</div>';
				echo '</div>';
			
				$page_data['isComposer'] = 'false';
			}
		}
		
	}else{
	
		echo '<div id="content" style=" padding-top:160px; min-height: 300px;">';
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span12">';
					echo '<div class="alert alert-info"><p class="archive-title">'.__('Error 404 - Page not found!', EWF_SETUP_THEME_DOMAIN).'</p></div>';
				echo '</div>'; 
			echo '</div>'; 	
		echo '</div>'; 
		echo '</div>'; 
		
	}

?>

<?php

	//	Debug info
	//
	ewf_debug($page_data);
	
?>

<?php	get_footer();  ?>