<?php

	//	Register actions
	//
	add_action ( "wp_ajax_ewf_portfolio_isogrid_loadmore"							, "ewf_portfolio_isogrid_loadMore" );
	add_action ( "wp_ajax_nopriv_ewf_portfolio_isogrid_loadmore"					, "ewf_portfolio_isogrid_loadMore" );
	
	
	//	Register shortcode
	//
	add_shortcode ( "portfolio-isogrid" 											, "ewf_projects_isogrid" );
	
	
	//	Register image size
	//
	add_image_size( 'ewf-portfolio-isogrid'											, 370, 370, true);
	
	
	
	add_action('wp_enqueue_scripts'													, 'ewf_load_isogrid_includes');
	function ewf_load_isogrid_includes(){
		
		//  Plugin - Isotope
		wp_enqueue_script('ewf-vc-isogrid'											, get_template_directory_uri().'/framework/composer/components/vc_ewf_portfolio_isogrid/vc.ewf.isogrid.pkgd.min.js', array('plugins-js'), null , true );    		
		
	}
	
	//	.portfolio-strip.columns-3 li { width: 33.3333333333%; }
	//	.portfolio-strip.columns-4 li { width: 25%; }
	
	
	
	function ewf_portfolio_isogrid_loadMore(){
		$filter = stripslashes($_POST['filter']);
		 
		$options = array( 
			'title' 	=> __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			'items' 	=> -1,
			'service' 	=> null,
			'style' 	=> 'ewf-portfolio-style-1',
			'start' 	=> 0,
			'unlimited' => true,
			'loaditems' => intval($_POST['items']),
			'exclude' 	=> $_POST['exclude']
			
		);
		
		if ($filter != 'all'){
			$options['service'] = array($filter);
		}

		$result = ewf_projects_isogrid( $options, null, false, false, true );
		
		wp_send_json_success(array('filter' => $filter, 'source' => $result['source'], 'builder'=>$options, 'query'=>$result['query'] ));
		exit;
	}
	
	
	function ewf_projects_isogrid($atts, $content, $filters = true, $wrapper = true, $return_array = false){
		global $post;
		
		$options = shortcode_atts(array( 
			"unlimited" 	=> true, 
			'title' 		=> __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			'button_title' 	=> __('Load more', EWF_SETUP_THEME_DOMAIN),
			"items" 		=> 6, 
			"start" 		=> 0, 
			"display" 		=> 'all', 
			"all_label" 	=> __('All', EWF_SETUP_THEME_DOMAIN),
			"load_more" 	=> 'true',
			"style" 		=> 'ewf-portfolio-style-1', 
			"service" 		=> null, 
			"exclude" 		=> null, 
			"loaditems" 	=> 3,
			"columns"		=> 3,
			'css' 			=> null
		), $atts ); 
		extract($options); 
		
		$class_extra = ' '.$css;
		
		$src = null;
	
	
	//	Build WP Query
	//		
		$query_projects = ewf_hlp_queryBuilder($options);
		$wp_query_project = new WP_Query($query_projects);
		$_ewf_span = 3;

		
		switch($columns){
			case '3': $_ewf_span = '4';break;
			case '4': $_ewf_span = '3';break;
		}
		
		if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
			echo '<pre>';
				print_r($atts);
				print_r($options);
				// print_r($query);
				echo '<br/>Items:'.$items;
			echo '</pre>';
		}

	//	Load items using WP Query
	//			
		$count_items = 0; 
		
		while ($wp_query_project->have_posts()) : $wp_query_project->the_post();
		
			$image_large_preview = null;
			$image_extra_large_preview = null;

			$count_items++;
			
			
			//	Get project terms
			//				
			$project_terms = wp_get_post_terms ($post->ID, EWF_PROJECTS_TAX_SERVICES);
			$project_terms_src = null;
			$project_services = null;
			
			foreach($project_terms as $key => $service){
				$project_terms_src .= $service->slug.' ';
					
				if ($project_services == null){
					$project_services.= $service->name;
				// }else{
					// $project_services.= ', '.$service->name;
				}
			}

			
			//	Get the featured image
			//
			$project_image_id = get_post_thumbnail_id();  
			$project_image_src = null;
			if ($project_image_id) {
				$image_large_preview = wp_get_attachment_image_src($project_image_id,'ewf-portfolio-isogrid');  
				$image_extra_large_preview = wp_get_attachment_image_src($project_image_id,'large');   
				$project_image_src = '<img src="'.$image_large_preview[0].'" alt="" />';  
			}
			
			
			
			
			
			ob_start();
			
			
			switch ($style){
			
				
				//	Style Isotope Grid
				//
					case 'ewf-portfolio-style-1';
					echo 
					'<div data-id="'.$post->ID.'" class="item '.$project_terms_src.'" data-terms="'.$project_services.'">
						
						<div class="portfolio-item">
							
							<div class="portfolio-item-preview">
								 '.$project_image_src.'
									
								<div class="portfolio-item-overlay"></div><!-- end .portfolio-item-overlay -->
								
								<div class="portfolio-item-overlay-actions">
									<a class="portfolio-item-zoom magnificPopup-gallery" href="'.$image_extra_large_preview[0].'"><span>+</span></a>
									<a class="portfolio-item-link" href="'.get_permalink().'"><span>&gt;</span></a>
								</div><!-- end .portfolio-item-overlay-actions -->
								
							</div> <!-- end .portfolio-item-preview -->
							
							<div class="portfolio-item-description">
								<h4>'.get_the_title().'</h4>
								<h6>'.$project_services.'</h6>
							</div><!-- end .portfolio-item-description -->

							
						</div> <!-- end .portfolio-item -->
												
					</div>';
					break;
				

			
			
			}
			
			$src .= ob_get_clean();
			
			
			if ($return_array){
				if ($count_items == $loaditems){
					break;
				}
			}else{
				if ($count_items == $items){ 
					break;
				}	
			}

			
		endwhile;	
		wp_reset_postdata();
	
		
		
		
		
	//	Display portfolio
	//
		if ($wrapper){
			$src = '<div class="wpb_row vc_row"><div class="span12"><div class="portfolio-items portfolio-columns tree-cols portfolio-isotope columns-'.$columns.' fixed'.$class_extra.'" data-display="'.$display.'" data-style="'.$style.'">'.$src.'</div></div></div>';
			
			if ($load_more == 'true'){
				$src .= '<div class="vc_row wpb_row">
							<div class="span12 text-center">
								<a href="#" class="btn btn-large portfolio-load-more" data-display="'.$display.'" data-style="'.$style.'"  data-load-items="'.$loaditems.'"><span>'.$button_title.'</span></a>
							</div><!-- end .span12 -->
						</div>';
			}
		 
		
	
		//	Attach filters & title
		//
		
			$src_header = null;
			$filter_src = null;
			
			
			$filter_terms 	= get_terms (EWF_PROJECTS_TAX_SERVICES);
			$filter_items 	= array('all'=>0);
			$filter_css_class = null;
			
			if (is_array($filter_terms)){
				$filter_src.= '<ul>';			
					$filter_src.= '<li><a class="active" href="#" data-items="'.$wp_query_project->found_posts.'" data-filter="*" data-term="all" >'.$all_label.'</a></li>';	
					
					foreach($filter_terms as $key => $service){
						$filter_src.= '<li><a data-term="'.$service->slug.'" data-items="'.intval($service->count).'" data-filter=".'.$service->slug.'" href="#">'.$service->name.'</a></li>';
					}
				$filter_src.= '</ul>';		
			}
				
			
			
			$display_title = null;
			$display_filter = null;
			
			$show_title = false;
			$show_filter = false;
				
			if ($display != 'none'){
				switch($display) {
					
					case 'all':
						$display_title = '<h2>'.$title.'</h2>';
						$display_filter = '<div class="portfolio-filter">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = true;$show_filter = true;
						break;
					
					case 'title':
						$display_title = '<h2>'.$title.'</h2>';
						$display_filter = '<div class="portfolio-filter portfolio-filter-hidden">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = true;$show_filter = false;
						break;
					
					case 'title-center':
						$display_title = '<h2 class="text-center">'.$title.'</h2>';
						$display_filter = '<div class="portfolio-filter portfolio-filter-hidden">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = true;$show_filter = false;
						break;

					
					case 'filters':
						$display_title = null;
						$display_filter = '<div class="portfolio-filter">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = false;$show_filter = true;
						break;

					case 'filters-center':
						$display_title = null;
						$display_filter = '<div class="portfolio-filter text-center">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = false;$show_filter = true;
						break;			
					
					case 'none':
						$display_title = null;
						$display_filter = '<div class="portfolio-filter portfolio-filter-hidden">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						$show_title = false;$show_filter = false;
						break;
				}
			}
				
			
			if ($show_title || $show_filter){
				$src_header = '<div class="vc_row wpb_row title-filter" data-display="'.$display.'">';
				
					if ($show_title && !$show_filter || !$show_title && $show_filter){
						$src_header .= '<div class="span12">';
							$src_header .= $display_title;
							$src_header .= $display_filter;
						$src_header .= '</div>';
					}else{
						$src_header .=  '<div class="span3">';
							$src_header .= $display_title;
						$src_header .= '</div>';
						$src_header .= '<div class="span9 text-right">';
						
							$src_header .= $display_filter;
						 $src_header .= '</div>';
					}
					
				$src_header .= '</div>';
			}else{
				$src_header = '<div class="vc_row wpb_row title-filter no-all" data-display="'.$display.'">'.$display_filter.'</div>';
			}
		
		}
		
		if ($return_array){
			return array(
				'source' => $src, 
			);
		}
	
		return '<div class="ewf-portfolio-isogrid-wrapper">'.$src_header.$src.'</div>';
	}

	
	vc_map( array(
	   "name" => __("Portfolio Grid Filtrable", EWF_SETUP_THEME_DOMAIN),
	   "base" => "portfolio-isogrid",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-portfolio-isogrid",
	   "description" => __("Portfolio Isotope", EWF_SETUP_THEME_DOMAIN), 
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "title",
			"value" => __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			"description" => __("The title of the section.", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("Load items", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "items",
			"value" => 6,
			"description" => __("The number of items to show initially", EWF_SETUP_THEME_DOMAIN)
		),
		// array(
			// "type" => "dropdown",
			// "holder" => "div",
			// "class" => "",
			// "heading" => __("Prortfolio grid layout", EWF_SETUP_THEME_DOMAIN),
			// "param_name" => "columns",
			// "value" => array(
			// __('3 Columns', EWF_SETUP_THEME_DOMAIN) => 3, 
			// __('4 Columns', EWF_SETUP_THEME_DOMAIN) => 4, 
			// ),
		// ),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("All Label", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "all_label",
			"value" => __('All', EWF_SETUP_THEME_DOMAIN),
			"description" => __("The text of the label that should show all items", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("'Load more' text", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "button_title",
			"value" => __('Load more', EWF_SETUP_THEME_DOMAIN),
			"description" => __("Load more button text.", EWF_SETUP_THEME_DOMAIN)
		),
		// array(
			// "type" => "ewf-image-select",
			// "holder" => "div",
			// "class" => "",
			// "heading" => __("Portfolio Style", EWF_SETUP_THEME_DOMAIN),
			// "param_name" => "style",
			// "options" => array(
			// 'Grid' 		=> 'ewf-portfolio-style-1', 
			// ),
			// "value" => 'ewf-portfolio-style-1',
		// ),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Display options", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "display",
			"value" => array(
				__("Title & Filters"				, EWF_SETUP_THEME_DOMAIN) 	=> 'all', 
				__("Title only, no filters"			, EWF_SETUP_THEME_DOMAIN) 	=> 'title', 
				__("Title only center, no filters"	, EWF_SETUP_THEME_DOMAIN) 	=> 'title-center', 
				__("Only filters on left"			, EWF_SETUP_THEME_DOMAIN) 	=> 'filters', 
				__("Only filters on center"			, EWF_SETUP_THEME_DOMAIN)	=> 'filters-center', 
				// __("Don't show title and filters"	, EWF_SETUP_THEME_DOMAIN)	=> 'none' 
			),
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Show 'Load More' button below the grid", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "load_more",
			"value" => array(
				__("Show it"				, EWF_SETUP_THEME_DOMAIN) => 'true', 
				__("Don't show"				, EWF_SETUP_THEME_DOMAIN) => 'false', 

			),
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Load More Items", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "loaditems",
			"value" => 3,
			"description" => __("Number of items to add when you press the 'Load More' button.", EWF_SETUP_THEME_DOMAIN)
		),
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


?>