<?php
	
	#	Register shortcodes
	#


	#	Register image size for project
	#
	// add_image_size( 'project-preview-medium'	, 440, 450, true						);
	// add_image_size( 'project-preview-large'	, 770, 520, true						);


	function ewf_hlp_queryBuilder($options, $defaults = null){
		global $tax_query_projects, $post;
		
		if (!$defaults){
			$defaults = array(
				"items"					=> 0,
				"id" 					=> null,
				"exclude" 				=> null,
				"exclude" 				=> null,
				"order" 				=> "DESC",
				"unlimited" 			=> false,
				"service" 				=> null
			);
		} 
		

		// echo '<pre> Query Helper Settings Input <br/>';
			// print_r($options);
		// echo '</pre>';

		$options = shortcode_atts($defaults, $options);
		extract($options);
		
		// if (!$page){
			// $paged = get_query_var('paged') ? get_query_var('paged') : 1;
		// }
		
		
		if ($unlimited){
			$items = '-1'; 
		}
		

		
		$include_posts = array();
		$exclude_items = array();

		$order = strtoupper($order);
		$query = array( 'post_type' => EWF_PROJECTS_SLUG,
						'order'=> $order, 
						'orderby' => 'date',  
						'posts_per_page'=>$items, 
						// 'paged' => $paged
						); 
		
		
		
		if ($exclude != null){
			if (is_numeric($exclude)){
				$exclude_items[] = $exclude ;
			}else{
				
				$tmp_id = explode(',', trim($exclude));
				foreach($tmp_id as $key => $item_id){
					if (is_numeric($item_id)){
						$exclude_items[] = $item_id ;
					}
				}
			}
			
			$query['post__not_in'] = $exclude_items;
		}
		
	
		if ($id != null){
			if (is_numeric($id)){
				$include_posts[] = $id ;
			}else{
				$tmp_id = explode(',', trim($id));
				foreach($tmp_id as $key => $item_id){
					if (is_numeric($item_id)){
						$include_posts[] = $item_id ;
					} 
				}
			}
			
			unset($query['post__not_in']);
			unset($query['tax_query']);
			
			$query['post__in'] = $include_posts;
			$query['posts_per_page'] = count($include_posts);
		}
		
		if ($service != null){
			$query['tax_query'] = array(
				array(
					'taxonomy' => EWF_PROJECTS_TAX_SERVICES,
					'field' => 'slug',
					'terms' => $service
				));
		}
		
		
		
		return $query;
	
	}

?>