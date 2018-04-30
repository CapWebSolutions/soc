<?php

	add_shortcode( 'ewf-iconbox', 'ewf_vc_iconbox' );
	
	
	function ewf_vc_iconbox( $atts, $content ) {
		extract( shortcode_atts( array(
			'title' 		=> __('Title', EWF_SETUP_THEME_DOMAIN),
			'style' 		=> 'ewf-iconbox-style-1',
			'link_style' 	=> 'button', 
			'link' 			=> null, 
			'align' 		=> 'center', 
			'icon' 			=> null,
			'css' 			=> null 
		), $atts ) );
	
			
		ob_start();
		

		$link = vc_build_link($link); 
		$link_src = null;
		$link_title = '#';
		
		
		// echo '<pre>';
			// print_r($link);
		// echo '</pre>';
		
		
		$class_extra = ' '.$css;
	
		if ($link['title'] != null){
			$class_link = null;	
			
			if ($style == 'ewf-iconbox-style-1' || $style == 'ewf-iconbox-style-2' || $style == 'ewf-iconbox-style-3' || $style == 'ewf-iconbox-style-4' ){
				$class_link .= 'class="btn btn-white alt" ';
			}else{
				$class_link .= null;
			}
			
			if ($style == 'ewf-iconbox-style-5'){
				$link['title'] = $link['title'].' <i class="ifc-right"></i>';
			}
			
			if ($link['target'] != null){
				$class_link .= 'target="_black" ';		
			}
			
			// $link_src .= '<p class="last text-'.$align.'"><a '.$class_link.'href="'.$link['url'].'">'.$link['title'].'</a></p>';
			$content .= '<br><br><p class="last text-'.$align.'"><a '.$class_link.'href="'.$link['url'].'">'.$link['title'].'</a></p>';
			$link_title = $link['url'];
		}
	
	
		if ($icon){
			$icon = '<i class="'.$icon.'"></i>';
		}
	
	
		switch($style){
		
			case 'ewf-iconbox-style-1':
				echo '
				<div class="icon-box-1'.$class_extra.'">
					<span>'.$icon.'</span>
					<div class="icon-box-content">
						<h4><a href="'.$link_title.'">'.$title.'</a></h4>
						
						'.$content.'
						'.$link_src.'
					</div><!-- end .icon-box-content -->
				</div><!-- end .icon-box-1 -->';
				break;
				
		
			case 'ewf-iconbox-style-2':
				echo '
				<div class="icon-box-2'.$class_extra.'">
					<span>'.$icon.'</span>

					<div class="icon-box-content">
						<h4><a href="'.$link_title.'">'.$title.'</a></h4>
						
						'.$content.'
						'.$link_src.'
					</div><!-- end .icon-box-content -->
				</div><!-- end .icon-box-2 -->';
				break;
				
		
			case 'ewf-iconbox-style-3':
				echo '
				<div class="icon-box-3'.$class_extra.'">
					<span>'.$icon.'</span>
					
					<div class="icon-box-content">
						<h4><a href="'.$link_title.'">'.$title.'</a></h4>
						
						'.$content.'
						'.$link_src.'
					</div><!-- end .icon-box-content -->
				</div><!-- end .icon-box-3 -->';
				break;
			
			
			case 'ewf-iconbox-style-4':
				echo '
				<div class="icon-box-4'.$class_extra.'">
					'.$icon.'
					
					<div class="icon-box-content">
						<h4><a href="'.$link_title.'">'.$title.'</a></h4>
						'.$content.'
						'.$link_src.'
					</div><!-- end .icon-box-content -->
				</div><!-- end .icon-box-4 -->';
				break;
				
				
			case 'ewf-iconbox-style-5':
				echo '
				<div class="icon-box-5'.$class_extra.'">
					'.$icon.'
					
					<div class="icon-box-content">
						<h5><strong><a href="'.$link_title.'">'.$title.'</a></strong></h5>
					
						'.$content.'
						'.$link_src.'
					</div>
				</div><!-- end .icon-box-5 -->';
				break;
					
					
			case 'ewf-iconbox-style-6':
				echo '
				<div class="icon-box-6'.$class_extra.'">
					'.$icon.'
					
					<div class="icon-box-content">
						<h3><strong><a href="'.$link_title.'">'.$title.'</a></strong></h3>
					
						'.$content.'
						'.$link_src.'
					</div>
				</div><!-- end .icon-box-6 -->';
				break;
					
					
			case 'ewf-iconbox-style-7':
				echo '
				<div class="icon-box-7'.$class_extra.'">
					'.$icon.'
					
					<h3 class="text-uppercase"><a href="'.$link_title.'">'.$title.'</a></h3>
				
					<br class="clear">
				
					'.$content.'
					'.$link_src.'
				</div><!-- end .icon-box-7 -->';
				break;
			
			default:
			break;

		}
			
			
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Icon Box", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-iconbox",
	   "class" => "",
	   "category" => EWF_SETUP_VC_GROUP,
	   "icon" => "icon-wpb-ewf-iconbox",
	   "description" => __("Add an icon box, with icon and description", EWF_SETUP_THEME_DOMAIN ),  
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "description" => __("The service title", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "ewf-icon",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "icon",
			 "value" => null,
			 "description" => __("Select the icon you want to have at the top of the section", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "ewf-image-select",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Iconbox Style", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "style",
			 "options" => array(
				'Style 1' => 'ewf-iconbox-style-1', 
				'Style 2' => 'ewf-iconbox-style-2', 
				'Style 3' => 'ewf-iconbox-style-3', 
				'Style 4' => 'ewf-iconbox-style-4', 
				// 'Style 5' => 'ewf-iconbox-style-5', 
			 ),
			 "value" => 'ewf-iconbox-style-1',
		  ),
		  array(
			 "type" => "textarea_html",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Content", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "content",
			 "value" => __("I am test text block. Click edit button to change this text.", EWF_SETUP_THEME_DOMAIN),
			 "description" => __("Add description text for the service", EWF_SETUP_THEME_DOMAIN) 
			),
		  array(
			 "type" => "vc_link",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Read more link", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "link",
			 "value" => '#',
			 "description" => __("Specify an optional link to another page", EWF_SETUP_THEME_DOMAIN) 
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Read more link placement", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "align",
			 "value" => array(__('Default', EWF_SETUP_THEME_DOMAIN) => 'default', __('Left', EWF_SETUP_THEME_DOMAIN) => 'left', __('Center', EWF_SETUP_THEME_DOMAIN) => 'center', __('Right', EWF_SETUP_THEME_DOMAIN) => 'right'),
			 "description" => __("How the read more link should be aligned inside of iconbox", EWF_SETUP_THEME_DOMAIN),
			 // "dependency" => Array("element" => "link","value" => array("url"))
		  )
		  
		  ))
		);

		
		
		
	// add_shortcode( 'ewf_iconbox_slider', 'ewf_vc_iconbox_slider' );

	
	// function ewf_vc_iconbox_slider( $atts, $content ) {
		// extract( shortcode_atts( array(), $atts ) ); 
		
		// return '<div class="services-slider"><div class="slides">'.do_shortcode($content).'</div></div>';
	// }
	
	
	// vc_map( array(
		// "name" => __("Iconbox Slider", EWF_SETUP_THEME_DOMAIN),
		// "base" => "ewf_iconbox_slider",
		// "as_parent" => array('only' => 'ewf-iconbox'),
		// "content_element" => true,
		// "icon" => "icon-wpb-ewf-iconbox-slider",
		// "description" => __("Create a slider with iconbox components", EWF_SETUP_THEME_DOMAIN),  
		// "show_settings_on_create" => false,
		// "params" => array(
			
			// array(
				// "type" => "textfield",
				// "heading" => __("Extra class name", EWF_SETUP_THEME_DOMAIN),
				// "param_name" => "el_class",
				// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", EWF_SETUP_THEME_DOMAIN)
			// ),
		// ),
		// "js_view" => 'VcColumnView'
	// ) );
	
	
	
	// if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		// class WPBakeryShortCode_ewf_iconbox_slider extends WPBakeryShortCodesContainer {
		// }
	// }

?>