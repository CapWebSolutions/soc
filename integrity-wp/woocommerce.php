<?php get_header(); ?>

<?php 
	
	
	//	 Get page layout & sidebar
	//
	global $ewf_admin_defaults;
	$page_data = array();
	
	$page_data['page'] 		= ewf_get_page_relatedID();
	$page_data['sidebar'] 	= ewf_get_sidebar_id('sidebar-page', $page_data['page']);
	$page_data['layout'] 	= ewf_get_sidebar_layout("layout-sidebar-single-right", $page_data['page']);
	$page_data['spans'] 	= ewf_get_sidebarSizes(null, get_option(EWF_SETUP_THNAME."_shop_sidebar_size", $ewf_admin_defaults["shop_sidebar_size"]));
	$page_data['source'] 	= basename(__FILE__);
	
	
	if ($page_data['layout'] == 'layout-full'){
		add_filter('loop_shop_columns', 'ewf_wooshop_columns_full');
	}else{
		add_filter('loop_shop_columns', 'ewf_wooshop_columns_sidebar');
	}
	
	
	switch ($page_data['layout']) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['sidebar'].'">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
				echo '<div class="span'.$page_data['spans']['content'].'">';
				
					woocommerce_content();
					echo '&nbsp;';
					
				echo '</div>';
				echo '</div>';
			echo '</div>';
			break;
	
		case "layout-sidebar-single-right": 
			echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="span'.$page_data['spans']['content'].'">';

					woocommerce_content();
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
			echo '<div class="row ewf-no-composer">';
				echo '<div class="span12">';
				
					woocommerce_content();
					
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