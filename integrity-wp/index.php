<?php  get_header(); ?>
	
<?php


	//	Get page settings - layout, sidebar, blog page
	//	Add all info to an array for debugging purpose
	//
	$page_data 		= array();
	
	$page_data['page'] 			= ewf_get_page_relatedID();
	$page_data['page-posts'] 	= get_option('page_for_posts');
	$page_data['page-front'] 	= get_option('page_on_front');
	
	$page_data['sidebar'] 		= ewf_get_sidebar_id('sidebar-page', $page_data['page']);
	$page_data['layout'] 		= ewf_get_sidebar_layout("layout-sidebar-single-right", $page_data['page']);
	$page_data['spans'] 		= ewf_get_sidebarSizes();
	$page_data['source'] 		= basename(__FILE__);
	
	$page_meta = get_post($page_data['page']);
	
	$ewf_extra_attr = null;
		
	
	
	//	Identify the blog page template
	//
	/*
	$page_custom = get_post_meta($page_data['page']);
	if (array_key_exists('_wp_page_template', $page_custom)){
			$page_custom_template = $page_custom['_wp_page_template'][0];
		switch($page_custom_template){
			case 'page-blog-default.php':
				$ewf_extra_attr .= ' template="default" ';
				break;
				
			case 'page-blog-columns.php':
				$ewf_extra_attr .= ' template="columns" ';
				break;			
		}
	}else{
		$ewf_extra_attr .= ' template="default" ';
	}
	*/
	//
	
	
	//	Load page layout
	//
	switch ($page_data['layout']) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					if ($page_data['page-posts'] == $page_data['page'] && !empty($page_meta)){ 
						echo apply_filters('the_content',$page_meta->post_content);
					}
					
					echo do_shortcode('[blog '.$ewf_extra_attr.'sidebar="true" ]');
					echo '&nbsp;';
						
				echo '</div>';
			echo '</div>';
			echo '</div>';
			break;
	
		case "layout-sidebar-single-right":
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['content'].'">';

					if ($page_data['page-posts'] == $page_data['page'] && !empty($page_meta)){ 
						echo apply_filters('the_content',$page_meta->post_content);
					}
					
					echo do_shortcode('[blog '.$ewf_extra_attr.'sidebar="true" ]');
					echo '&nbsp;';
					
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
			
					if ($page_data['page-posts'] == $page_data['page'] && !empty($page_meta)){ 
						echo apply_filters('the_content',$page_meta->post_content);
					}
					
					echo do_shortcode('[blog '.$ewf_extra_attr.']');
					echo '&nbsp;';

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