<?php


	$attr_fontcolor = array(
		"type" => "colorpicker",
		"holder" => "div",
		"class" => "vc_col-xs-5 vc_settings",
		"group" => __("Design Options", EWF_SETUP_THEME_DOMAIN),
		"heading" => __("Font color", EWF_SETUP_THEME_DOMAIN),
		"param_name" => "font_color",
		"value" => '',
		// "description" => __('Expand section full width (used for sliders in general)', EWF_SETUP_THEME_DOMAIN)
	);

	// $attr_fullwidth = array(
		// "type" => "checkbox",
		// "holder" => "div",
		// "class" => "",
		// "heading" => __("Spread full width", EWF_SETUP_THEME_DOMAIN),
		// "param_name" => "fullwidth",
		// "value" =>array("Full Width" => 1),
		// "description" => __('Expand section full width (used for sliders in general)', EWF_SETUP_THEME_DOMAIN)
	// );
	

	// $attr_parallax = array(
		// "type" => "checkbox",
		// "holder" => "div",
		// "class" => "",
		// "heading" => __("Add parallax efect to this section", EWF_SETUP_THEME_DOMAIN),
		// "param_name" => "parallax",
		// "value" =>array("Parallax" => 1), 
		// "description" => __('Add parallax effect using the image added to the post', EWF_SETUP_THEME_DOMAIN)
	// );
	
	// $attr_nospacing = array(
		// "type" => "checkbox",
		// "holder" => "div",
		// "class" => "",
		// "heading" => __("Section spacing", EWF_SETUP_THEME_DOMAIN),
		// "param_name" => "nospacing",
		// "value" =>array("No spacing" => 1), 
		// "description" => __('Remove the space between this section and the one from below(it applies only to full width sections)', EWF_SETUP_THEME_DOMAIN)
	// );
	
	// $attr_title = array(
		// "type" => "textfield",
		// "holder" => "div",
		// "class" => "",
		// "param_name" => "ewf_row_title",
		// "value" =>"Full width", 
	// );
	
	// $attr_overlay = array(
			 // "type" => "ewf-image-select",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Overlay Style", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "overlay",
			 // "options" => array(
				// 'Transparent' => 'ewf-row-overlay-transparent', 
				// 'Pattern' => 'ewf-row-overlay-pattern', 
			 // ),
			 // "value" => 'ewf-row-overlay-transparent',
		  // );
	
	
	
	
	// vc_add_param( "vc_row",  $attr_overlay);
	// vc_add_param( "vc_row",  $attr_fullwidth);
	// vc_add_param( "vc_row",  $attr_parallax);
	// vc_add_param( "vc_row",  $attr_nospacing);
	// vc_add_param( "vc_row",  $attr_title);
	
	
	// $attr_id = array(
		// "type" 			=> "textfield",
		// "holder" 		=> "div",
		// "class" 		=> "",
		// "heading" 		=> __("Section ID", EWF_SETUP_THEME_DOMAIN),
		// "param_name" 	=> "row_id",
		// "value" 		=>'', 
		// "description" => __('Add an ID to this section, you can use it for internal navigation.', EWF_SETUP_THEME_DOMAIN)
	// );
	
	

	// Remove default composer full width option
	//
	vc_remove_param( "vc_row", "parallax" ); 
	vc_remove_param( "vc_row", "parallax_image" ); 
	
	
	//	Add a row stretch option
	//
	// $row_stretch = 	array(
		// "type" => "dropdown",
		// "holder" => "div",
		// "class" => "",
		// "heading" => __("Row stretch", EWF_SETUP_THEME_DOMAIN),
		// "param_name" => "stretch",
		// "value" => array(
			// __('Default', EWF_SETUP_THEME_DOMAIN) => 'default', 
			// __('Stretch row', EWF_SETUP_THEME_DOMAIN) => 'row', 
			// __('Stretch row and content', EWF_SETUP_THEME_DOMAIN) => 'all', 
			// __('Stretch rown and content without spaces', EWF_SETUP_THEME_DOMAIN) => 'stretch_all_nospace'
		// ),
	// );
	
	vc_add_param( "vc_row",  $attr_fontcolor);
	// vc_add_param( "vc_row",  $attr_id);

?>