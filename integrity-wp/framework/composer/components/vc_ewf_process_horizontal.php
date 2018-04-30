<?php

	add_shortcode( 'ewf_processh_group', 'ewf_vc_process_horizontal_group' );
	add_shortcode( 'ewf_processh_item', 'ewf_vc_process_horizontal_item' );


	// function ewf_vc_process_horizontal_group( $atts, $content ) {
		// extract( shortcode_atts( array(
			// 'el_class' => null
		// ), $atts ) );
		
		// $class_extra = ' '.$el_class;
		
		// return '<ul class="horizontal-process-builder four-items fixed'.$class_extra.'">'.do_shortcode($content).'</ul>';
	// }

	
	function ewf_vc_process_horizontal_group( $atts, $content ) {
		extract( shortcode_atts( array(
			'el_class' => null
		), $atts ) );
		
		$class_extra = ' '.$el_class;
		$class_asocc = array('3' => 'three-items', '4'=> 'four-items', '5'=> 'five-items');
		
		$process_items = do_shortcode($content);
		$items_number = count(explode('[ewf_processh_item', $content)) - 1;
		
		return '<ul class="horizontal-process-builder '.$class_asocc[$items_number].' fixed'.$class_extra.'">'.$process_items.'</ul>';
	}
	
	
	function ewf_vc_process_horizontal_item( $atts, $content ) {
		$shortcode_options = shortcode_atts( array(
			'title' => __('Sample title', EWF_SETUP_THEME_DOMAIN),
			'style' => null,
			'number' => null,
			'icon' => null,
		), $atts );
		
		extract($shortcode_options);
	 
		ob_start();
		
		echo '<li>';
			
			if ($style == 'icon' && $icon){
				echo '<i class="'.$icon.'"></i>';
			}elseif($style == 'number' && $number){
				echo '<h1>'.$number.'</h1>';
			}
			
			echo '<div class="process-description">';
				// echo '<h3>'.$title.'</h3>';
				echo '<p>'.$content.'</p>';
			echo '</div>';
		echo '</li>';
		
		return ob_get_clean();
	}

	
	
	vc_map( array(
		"name" => __("Process Horizontal", EWF_SETUP_THEME_DOMAIN),
		"base" => "ewf_processh_group",
		"as_parent" => array('only' => 'ewf_processh_item'),
		"content_element" => true,
		"category" => EWF_SETUP_VC_GROUP,
		"icon" => "icon-wpb-ewf-process-horizontal",
		"description" => __("Create a horizontal list with items", EWF_SETUP_THEME_DOMAIN),  
		"show_settings_on_create" => true,
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
		"name" => __("Process Horizontal Item", EWF_SETUP_THEME_DOMAIN),
		"base" => "ewf_processh_item",
		"icon" => "icon-wpb-ewf-processh-item",
		"content_element" => true,
		"as_child" => array('only' => 'ewf_processh_group'),
		"show_settings_on_create" => true, 
		"params" => array(
		  array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Circle content", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "style",
			"value" => array(
				__('Icon', EWF_SETUP_THEME_DOMAIN) => 'icon', 
				__('Number', EWF_SETUP_THEME_DOMAIN) => 'number'
			),
			"description" => __("Select if you want a number or an icon in the circle", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "ewf-icon",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "icon",
			 "value" => null,
			 "dependency" => array( "element" => "style","value" => array("icon")),
			 "description" => __("Select the icon you want to have on the left side of the section", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "number",
			 "value" => '1',
			 "dependency" => array( "element" => "style","value" => array("number")),
			 // "description" => __("The title of the progress bar", EWF_SETUP_THEME_DOMAIN)
		  ),
		  // array(
			 // "type" => "textfield",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "title",
			 // "value" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 // "description" => __("The title of the progress bar", EWF_SETUP_THEME_DOMAIN)
		  // ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Details", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "content",
			 "value" => null,
			 "description" => __("The content of progress", EWF_SETUP_THEME_DOMAIN)
		  ),
		)
	) );
	
	
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_ewf_processh_group extends WPBakeryShortCodesContainer {
		}
	}
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCodeewf_processh_item extends WPBakeryShortCode {
		}
	}

?>