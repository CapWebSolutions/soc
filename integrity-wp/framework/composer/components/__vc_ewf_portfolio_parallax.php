<?php
	
	
	#	Register image size for project
	#
	add_image_size( 'ewf-portfolio-parallax', 1920, 1400, true);
	
	
	#	Register shortcode for Visual Composer component
	#
	add_shortcode( 'ewf-portfolio-parallax', 'ewf_vc_portfolio_parallax' );
	
	add_action('init', 'ewf_register_vc_portfolio_parallax');
	
	
	function ewf_vc_portfolio_parallax( $atts, $content ) {
		global $post;
		
		$options = shortcode_atts( array(
			"items" 				=> 3,
			"exclude" 				=> null,
			"order" 				=> "DESC",
			"list" 					=> null,
			"service" 				=> null,
			"nav"					=> 1,
			"css" 					=> null
		), $atts);
		
	   extract($options);
				
		if ($service == 'All Services'){
			$service = null;
		}
		
		$class_extra = ' '.$css;
		$ewf_paged 	= get_query_var('paged') ? get_query_var('paged') : 1;
	 
		$query = array( 'post_type' => EWF_PROJECTS_SLUG,
						'order'=> $order, 
						'orderby' => 'date',
						'paged' => $ewf_paged,
						'posts_per_page'=>$items); 
						
	
		if ($list == 'latest'){
			$query['orderby'] = 'date';
			$query['order'] = 'DESC';
			$id = null;
		}						
	
		if ($list == 'random'){
			$query['orderby'] = 'rand';
		}
	
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
		
	
		// if ($id != null){
			// if (is_numeric($id)){
				// $include_posts[] = $id ;
			// }else{
				// $tmp_id = explode(',', trim($id));
				// foreach($tmp_id as $key => $item_id){
					// if (is_numeric($item_id)){
						// $include_posts[] = $item_id ;
					// } 
				// }
			// }
			
			// unset($query['post__not_in']);
			// unset($query['tax_query']);
			
			// $query['post__in'] = $include_posts;
			// $query['posts_per_page'] = count($include_posts);
		// }
		
		
		if ($service != null && $list == 'service'){
			$query['tax_query'] = array(
				array(
					'taxonomy' => EWF_PROJECTS_TAX_SERVICES,
					'field' => 'slug',
					'terms' => array( $service )
				));
		}

		
		ob_start();
		
		
		if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
			echo '<pre>';
				print_r($options);
				print_r($query);
				echo '<br/>Items:'.$items;
			echo '</pre>';
		}
		
		
		$position = 'right';
		
		$wp_query_portfolio_grid = new WP_Query($query);
		while ($wp_query_portfolio_grid->have_posts()) : $wp_query_portfolio_grid->the_post();
			global $post;
		
			$image_id = get_post_thumbnail_id();  
			$image_preview_small = wp_get_attachment_image_src( $image_id, 'ewf-portfolio-parallax');						
			$image_preview_large = wp_get_attachment_image_src( $image_id, 'large');	
 
 
			if ($position == 'left'){
				$position = 'right';
			}else{
				$position = 'left';
			}
 
 
			$ewf_project_services = null;
			$ewf_project_terms = get_the_terms ($post->ID, EWF_PROJECTS_TAX_SERVICES);
			
			// $ewf_project_meta = get_post_custom($post->ID);
			
			// $ewf_project_client = null;
			// if (!empty($ewf_project_meta['_ewf-project-client'])){
				// $ewf_project_client = $ewf_project_meta['_ewf-project-client'][0];
			// }
						
			// $ewf_project_url = null;
			// if (!empty($ewf_project_meta['_ewf-project-website'])){
				// $ewf_project_url = $ewf_project_meta['_ewf-project-website'][0];
			// }
			
			if (is_array($ewf_project_terms)){
				foreach($ewf_project_terms as $key => $service){
				
					if ($ewf_project_services == null){
						// $ewf_project_services.= '<a href="'.get_term_link($service->slug, EWF_PROJECTS_TAX_SERVICES).'">'.$service->name.'</a>';
						$ewf_project_services.= '<span>'.$service->name.'</span>';
						
						break; // Stop at the first category
					}else{
						// $ewf_project_services.= ', <a href="'.get_term_link($service->slug, EWF_PROJECTS_TAX_SERVICES).'">'.$service->name.'</a>';
						$ewf_project_services.= ', <span>'.$service->name.'</span>';
					}
				}
				 
				
			}
			
			
			
			echo 
			'<div class="fullwidth-section parallax portfolio-parallax" style="background-image:url('.$image_preview_small[0].');">
				
				<div class="fullwidth-section-overlay"></div>
				
				<div class="fullwidth-section-content">
				
					<div class="ewf-row">
						<div class="ewf-span12">
							
							<div class="portfolio-item-description '.$position.'">
								<h1>
									<strong>'.get_the_title().'</strong>
								</h1>
								
								<p class="text-uppercase"><strong>'.$ewf_project_services.'</strong></p>
								
								<p>'.get_the_excerpt().'</p>
								
								<a class="btn btn-white" href="'.get_permalink().'">'.__('view project', EWF_SETUP_THEME_DOMAIN).'</a>
							</div><!-- end .portfolio-item-description -->
							
						</div><!-- end .span12 -->
					</div><!-- end .row -->
				
				</div><!-- end .fullwidth-section-content -->
				
            </div><!-- end .fullwidth-section-content -->';
		
		endwhile;
	
	
		// <p class="text-right">
			// <a href="'.get_permalink().'"><i class="ifc-fast_forward"></i> '.__('Read more', EWF_SETUP_THEME_DOMAIN).'</a>
		// </p>
		
		// <a href="'.get_permalink().'">'.get_the_title().'</a>
		
		if ($nav){
			echo '<div class="ewf-row">';
				echo ewf_sc_grid_navigation_pages(5, $wp_query_portfolio_grid);
			echo '</div>';
		}
		
		
		return '<div class="portfolio-parallax '.$class_extra.'">'.ob_get_clean().'</div>';
		
		
	 
	}
	
		
	function ewf_sc_parallax_navigation_pages( $range = 5, $query){
		$src_nav = null;
		$max_page = 0;
		
		$data_pages = array();
		
		$class_current = 'current';
		$current_page = $query->query_vars['paged'];
		
		
		
		if ($current_page == 0) { 
			$current_page = 1; 
			}
	
	
	# 	How much pages do we have?
	
		if ( !$max_page ) {
			$max_page = $query->max_num_pages;
			}
			
			
			

	  // We need the pagination only if there are more than 1 page
	  if($max_page > 1){
	  
		if ( !$current_page ) 		{ $current_page = 1; }
		
		if($max_page > $range){
		  // When closer to the beginning
		  if($current_page < $range){
			for($i = 1; $i <= ($range + 1); $i++){		  
			  $data_pages['curent'] = $current_page;
			  $data_pages['pages'][$i] =  get_pagenum_link($i);
			}
		  } 
		  // When closer to the end
		  elseif($current_page >= ($max_page - ceil(($range/2)))){
			$extra = 0;
		  
			if (($max_page - ($max_page - $range)) < 2 ) $extra = 1;
		  
			for($i = $max_page - $range - $extra; $i <= $max_page; $i++){
			  $data_pages['curent'] = $current_page;
			  $data_pages['pages'][$i] =  get_pagenum_link($i); 
			}
		  }
		  // Somewhere in the middle
		  elseif($current_page >= $range && $current_page < ($max_page - ceil(($range/2)))){
			$extra = 0;
			if ($current_page - ceil($range/2) == 0 ) $extra = 1;
			
			for($i = ( $current_page - ceil($range/2) + $extra); $i <= ($current_page + ceil(($range/2))+$extra); $i++){
			  $data_pages['curent'] = $current_page;
			  $data_pages['pages'][$i] =  get_pagenum_link($i);  
			}
		  }
		} 
		// Less pages than the range, no sliding effect needed
		else{
		  for($i = 1; $i <= $max_page; $i++){
			$data_pages['curent'] = $current_page;
			$data_pages['pages'][$i] =  get_pagenum_link($i);
		  }
		}

		if($current_page != $max_page){}
	  }
	   
		$src_nav = null;
		
		if (array_key_exists('pages', $data_pages)){
			$pos_curent = $data_pages['curent'];
			
			$src_nav.= '<ul class="pagination">';
				$count = 0;
				
				foreach($data_pages['pages'] as $key => $url){
					$count++;

					if($pos_curent == $key){
						$src_nav.= '<li class="current"><a href="#">'.$key.'</a></li>';
					}else{
						$src_nav.= '<li><a href="'.$url.'">'.$key.'</a></li>';
					}
				}
				
			$src_nav.= '</ul>';
		}
	  
		return $src_nav;
	
	}	
	
	function ewf_vc_portfolio_parallax_services(){
		global $ewf_portfolioStrip_services;
		
		$services = array();	// array('All Services');
		$terms = get_terms (EWF_PROJECTS_TAX_SERVICES); 
	
		if (is_array($terms)){
			foreach($terms as $key => $service){

				$services[] = $service->slug;
			}
		}
  		
		return $services;
	}

	function ewf_vc_portfolio_parallax_items(){
		$result = array();
	
		$query = array( 'post_type' => EWF_PROJECTS_SLUG,
						'order'=> 'DESC', 
						'orderby' => 'date',  
						'posts_per_page' => -1); 
						
		$wp_query_portfolio_strip = new WP_Query($query);
		while ($wp_query_portfolio_strip->have_posts()) : $wp_query_portfolio_strip->the_post();
			global $post;
			
			$result[get_the_title()] = $post->ID;
		endwhile;
		
		return $result;
	}
	
	function ewf_register_vc_portfolio_parallax(){
	
		vc_map( array(
		   "name" => __("Portfolio Parallax", EWF_SETUP_THEME_DOMAIN),
		   "base" => "ewf-portfolio-parallax",
		   "class" => "",
		   "icon" => "icon-wpb-ewf-portfolio-parallax",
		   "description" => __("Add a list with porftolio items with parallax background", EWF_SETUP_THEME_DOMAIN), 
		   "category" => __('Portfolio', EWF_SETUP_THEME_DOMAIN),
		   "params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("How should the portfolio items to load, be chosen", EWF_SETUP_THEME_DOMAIN),
					"param_name" => "list",
					"value" => array(
						__('Latest projects',EWF_SETUP_THEME_DOMAIN)=>'latest',
						__('From a service', EWF_SETUP_THEME_DOMAIN)=>'service',
						// __('Load a single project',EWF_SETUP_THEME_DOMAIN)=>'single',
						__('Random order', EWF_SETUP_THEME_DOMAIN) => 'random'
					)
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __("Number of portfolio items", EWF_SETUP_THEME_DOMAIN),
					"param_name" => "items",
					"value" => 3,
					"dependency" => Array("element" => "list","value" => array("service", "random", "latest")),
					"description" => __("Select the number of items you want to load", EWF_SETUP_THEME_DOMAIN)
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("Service", EWF_SETUP_THEME_DOMAIN),
					"param_name" => "service",
					"value" => ewf_vc_portfolio_parallax_services(),
					"description" => __("Specify projects from a defined category", EWF_SETUP_THEME_DOMAIN),
					"dependency" => Array("element" => "list","value" => array("service"))
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("Projects order", EWF_SETUP_THEME_DOMAIN),
					"param_name" => "order",
					"value" => array('DESC', 'ASC'),
					"dependency" => Array("element" => "list","value" => array("service")),
					"description" => __("Load projects in a Ascendent(1,2,3) or Descendent (3,2,1) order", EWF_SETUP_THEME_DOMAIN)
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("Show navigation", EWF_SETUP_THEME_DOMAIN),
					"param_name" => "nav",
					"value" => array(
					__('Yes', EWF_SETUP_THEME_DOMAIN) => 1, 
					__('No', EWF_SETUP_THEME_DOMAIN) => 0, 
					),
				),
				// array(
					// "type" => "dropdown",
					// "holder" => "div",
					// "class" => "",
					// "heading" => __("Choose a portfolio item from the list below", EWF_SETUP_THEME_DOMAIN),
					// "param_name" => "id",
					// "value" => ewf_vc_portfolio_parallax_items(),
					// "dependency" => Array("element" => "list","value" => array("single"))
				// ),
				array( 
					"type" => "textfield", 
					"holder" => "div", 
					"class" => "", 
					"heading" => __("Extra CSS Class", EWF_SETUP_THEME_DOMAIN), 
					"param_name" => "css", 
					"value" => '', 
					"description" => __("Add and extra CSS class to the component", EWF_SETUP_THEME_DOMAIN) 
				)
			)
		));
	
	}


?>