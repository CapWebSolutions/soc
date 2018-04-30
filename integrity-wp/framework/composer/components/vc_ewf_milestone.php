<?php

	add_shortcode( 'ewf-milestone', 'ewf_vc_milestone' );
	
	
	function ewf_vc_milestone( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'title' 		=> __('Title', EWF_SETUP_THEME_DOMAIN),
		  'style' 		=> 'ewf-milestone-style-1',
		  'number' 		=> '1',
		  'icon' 		=> null,
		  'description' => null,
		  'symbol' 		=> null,
		  'speed' 		=> '2000',
		  'css' 		=> null
	   ), $atts ));
	 
		$number = intval($number);
		$class_extra = ' '.$css;
	 
		// if ($style == 'ewf-milestone-style-2'){
			// $class_extra = ' alt'; 
		// }
	 
		ob_start();
		
		echo '<div class="milestone'.$class_extra.'">';
			if ($icon){
				echo '<i class="'.$icon.'"></i>';
			}
		
			echo '<div class="milestone-content">';
				
				// if ($style == 'ewf-milestone-style-3' && $symbol){
					// echo '<span>'.$symbol.'</span>';				
				// }

				echo '<span class="milestone-value" data-speed="'.$speed.'" data-stop="'.$number.'"></span>';

				// if ($symbol){
					// echo '<span class="hidden-tablet">'.$symbol.'</span>';				
				// }
				
				echo '<div class="milestone-description">';
					// if ($style == 'ewf-milestone-style-1'){
						// echo '<h4 class="text-uppercase">'.$title.'</h4>';
					// }else{
						echo '<h4 class="text-uppercase"><strong>'.$title.'</strong></h4>';
					// }
					
					if ($description){
						echo '<p>'.$description.'</p>';
					}
				echo '</div><!-- end .milestone-description -->';
				
			echo '</div>';
		echo '</div>';
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Milestone", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-milestone",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-milestone",
	   "description" => __("Animated count from 0 to specified number", EWF_SETUP_THEME_DOMAIN),  
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		  // array(
			 // "type" => "ewf-image-select",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Milestone Style", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "style",
			 // "options" => array(
				// 'Style 1' => 'ewf-milestone-style-1', 
				// 'Style 2' => 'ewf-milestone-style-2', 
				// 'Style 3' => 'ewf-milestone-style-3', 
			 // ),
			 // "value" => 'ewf-milestone-style-1'
		  // ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "description" => __("The milestone title", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Details", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "description",
			 "value" => null,
			 "description" => __("The description of the milestone", EWF_SETUP_THEME_DOMAIN)
		  ),
		  // array(
			 // "type" => "ewf-icon",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "icon",
			 // "value" => null,
			 // "description" => __("Select the icon you want to have at the top of the section", EWF_SETUP_THEME_DOMAIN)
		  // ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Symbol (optional)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "symbol",
			 "value" => null,
			 "description" => __("Add an extra letter aside the milestone number, ex: %, #", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "number",
			 "value" => 1,
			 "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Speed", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "speed",
			 "value" => 2000,
			 "description" => __("Specify the animation speed", EWF_SETUP_THEME_DOMAIN)
		  )
	   )
	));


?>