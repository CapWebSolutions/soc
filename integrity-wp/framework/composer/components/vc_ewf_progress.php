<?php

	add_shortcode( 'ewf-progress', 'ewf_vc_progress' );
	
	
	function ewf_vc_progress( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'title' 		=> __('Sample progress bar', EWF_SETUP_THEME_DOMAIN),
		  'value' 		=> '90',
		  'direction' 	=> 'right',
		  'bar' 		=> '#4FB7FF',
		  'background'	=> '#E0E0E0',
		  'css' 		=> null
	   ), $atts ) );
	 
		$class_extra = ' '.$css;
		$class_direction = null; 
		$value = intval($value);
	 
		// if ($direction == 'left'){
			// $class_direction = ' alt';
		// }
	 
		ob_start();
		
		echo '<div class="fixed'.$class_extra.'" data-direction="'.$direction.'">';
			echo '<div class="progress-bar-description'.$class_direction.'">' . $title . '<span style="left:' . $value . '%">' . $value . '%</span>' . '</div>';

			echo '<div class="progress-bar'.$class_direction.'">'; 
				echo '<span class="progress-bar-outer" data-width="'.$value.'" style="background-color:'.$bar.'">';
					echo '<span class="progress-bar-inner"></span>';
				echo '</span>';
			echo '</div><!-- end .progress-bar -->';
		echo '</div>';
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Progress Bar", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-progress",
	   "icon" => "icon-wpb-ewf-progress",
	   // "description" => __("Add atitle and a percentage loaded", EWF_SETUP_THEME_DOMAIN), 
	   "class" => "",
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "description" => __("The title of the progress bar", EWF_SETUP_THEME_DOMAIN)
		  ),
		  // array(
			 // "type" => "dropdown",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Loading direction", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "direction",
			 // "value" => array( 
				// __('Left to right', EWF_SETUP_THEME_DOMAIN) => 'left',
				// __('Right to left', EWF_SETUP_THEME_DOMAIN) => 'right'
			// ),
			 // "description" => __("Specify the direction of the progress", EWF_SETUP_THEME_DOMAIN)
		  // ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "value",
			 "value" => 90,
			 "description" => __("Specify a value between 1 and 100, it represents the loaded percentage", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Color", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "bar",
			 "value" => '#4FB7FF',
			 "description" => __("Select the color of the bar", EWF_SETUP_THEME_DOMAIN)
		  )
	   )
	));


?>