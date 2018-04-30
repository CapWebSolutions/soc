<?php

	add_shortcode( 'ewf_timeline'		, 'ewf_vc_timeline' );
	add_shortcode( 'ewf_timeline_item'	, 'ewf_vc_timeline_item' );


	function ewf_vc_timeline( $atts, $content ) {
		
		ob_start();
		$tm_content = str_replace('[ewf_timeline_item', '[ewf_timeline_item style="ewf-timeline-style"', $content);
		
		
		$tm_array = explode( 'ewf-timeline-style', $tm_content);
		$tm_count = count($tm_array) - 1;
		$tm_count_even = false;
		
		
		for ($tm_index = 0; $tm_index < $tm_count; $tm_index++) {
			if ($tm_count_even){
				$tm_array[$tm_index] .= 'ewf-timeline-style-2';
				$tm_count_even = false;
			}else{
				$tm_array[$tm_index] .= 'ewf-timeline-style-1';
				$tm_count_even = true;
			}
		}
		
		$tm_content = implode($tm_array);
		
		
		echo '<ul class="vertical-timeline">';
			echo do_shortcode($tm_content);
		echo '</ul>';
		
		return ob_get_clean();
		
	}

	function ewf_vc_timeline_item( $atts, $content ) {
		$shortcode_options = shortcode_atts( array(
			'title' => __('Sample title', EWF_SETUP_THEME_DOMAIN),
			'style' => 'ewf-timeline-style-1',
			'number' => null,
			'title' => '',
			'details' => '',
			'icon' => null,
		), $atts );
		
		extract($shortcode_options);
	 
		ob_start();
		
		
		echo '<li>';
		
			switch($style){
				
				case 'ewf-timeline-style-1':
					echo '<div class="left-side">';
						if ($title){
							echo '<h4><strong>'.$title.'</strong></h4>';
						}
						
						if ($details){
							echo '<p>'.$details.'</p>';
						}
					echo '</div><!-- end .left-side -->';
						
					echo '<div class="separator">';
						if ($icon){
							echo '<span><i class="'.$icon.'"></i></span>';
						}
					echo '</div>';
		
					echo '<div class="right-side">&nbsp;</div><!-- end .right-side -->';
					break;
				
				case 'ewf-timeline-style-2':
					echo '<div class="left-side">&nbsp;</div><!-- end .left-side -->';
		
					echo '<div class="separator">';
						if ($icon){
							echo '<span><i class="'.$icon.'"></i></span>';
						}
					echo '</div>';
		
					echo '<div class="right-side">';
						if ($title){
							echo '<h4><strong>'.$title.'</strong></h4>';
						}
						
						if ($details){
							echo '<p>'.$details.'</p>';
						}
					echo '</div><!-- end .right-side -->';
					break;
				
			}
		
		echo '</li>';
		
		return ob_get_clean();
	}
	
	
	vc_map( array(
		"name" => __("Timeline", EWF_SETUP_THEME_DOMAIN),
		"base" => "ewf_timeline",
		"as_parent" => array('only' => 'ewf_timeline_item'),
		"content_element" => true,
		"icon" => "icon-wpb-ewf-timeline",
		"description" => __("Create a vertical timeline with items", EWF_SETUP_THEME_DOMAIN),  
		"show_settings_on_create" => false,
		"category" => EWF_SETUP_VC_GROUP,
		"params" => array(
			
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", EWF_SETUP_THEME_DOMAIN)
			)
		),
		"js_view" => 'VcColumnView'
	) );
	
	
	
	vc_map( array(
		"name" => __("Timeline Item", EWF_SETUP_THEME_DOMAIN),
		"base" => "ewf_timeline_item",
		"icon" => "icon-wpb-ewf-timeline-item",
		"content_element" => true,
		"as_child" => array('only' => 'ewf_timeline'),
		"show_settings_on_create" => true,
		"category" => EWF_SETUP_VC_GROUP,
		"params" => array(
		  // array(
			 // "type" => "ewf-image-select",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Item date alignment", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "style",
			 // "options" => array(
				// 'Date left' => 'ewf-timeline-style-2', 
				// 'Date right' => 'ewf-timeline-style-1', 
			 // ),
			 // "value" => 'ewf-timeline-style-1'
		  // ),
		  array(
			 "type" => "ewf-icon",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "icon",
			 "value" => null,
			 "description" => __("Select the icon you want", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => '',
			 "description" => __("Title of the timeline item", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Details", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "details",
			 "value" => null,
			 "description" => __("The details of the timeline item", EWF_SETUP_THEME_DOMAIN)
		  ),
		)
	) );

	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_ewf_timeline extends WPBakeryShortCodesContainer {
		}
	}
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCodeewf_timeline_item extends WPBakeryShortCode {
		}
	}

?>