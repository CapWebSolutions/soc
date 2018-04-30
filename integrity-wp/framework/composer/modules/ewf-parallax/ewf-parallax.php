<?php
	/*

	
	add_action('wp_enqueue_scripts'													, 'ewf_load_parallax_includes');
	function ewf_load_parallax_includes(){
		
		wp_enqueue_script('ewf-parallax'											, get_template_directory_uri().'/framework/composer/modules/ewf-parallax/ewf-parallax.js', array('jquery'), null , true );
		wp_enqueue_script('ewf-scroll'												, get_template_directory_uri().'/framework/composer/modules/ewf-parallax/gambit-smoothscroll.js', array('plugins-js'), null , true );    		
		
	}


	
	
	
	$attr_parallax = array(
		"type" 			=> "checkbox",
		"holder" 		=> "div",
		"class" 		=> "",
		"heading" 		=> __("Add parallax efect to this section", EWF_SETUP_THEME_DOMAIN),
		"param_name" 	=> "parallax",
		"value" 		=> array("Parallax" => 1), 
		"group" 		=> __("Parallax", EWF_SETUP_THEME_DOMAIN),
		"description" 	=> __('Add parallax effect using the image added to the post', EWF_SETUP_THEME_DOMAIN)
	);
	
	

	
	
	
	$attr_parallax_image = array(
		"type" 			=> "attach_image",
		"class" 		=> "",
		"heading" 		=> __( "Background Image", EWF_SETUP_THEME_DOMAIN ),
		"param_name" 	=> "parallax_background",
		"description" 	=> __( "Select your background image. <strong>Make sure that your image is of high resolution, we will resize the image to make it fit and to optimize it to achieve the best performance</strong>. You can use this field to input your image or use the image uploader provided in the <strong>Design Options</strong> tab.", EWF_SETUP_THEME_DOMAIN ),
		// "dependency" => array(
			// "element" => "gmbt_prlx_bg_type",
			// "value" => array( "parallax" ),
		// ),
		"group" => __( "Parallax", EWF_SETUP_THEME_DOMAIN ),
	);




	vc_add_param( 'vc_row', $attr_parallax );
	vc_add_param( 'vc_row', $attr_parallax_image );
	
	
	*/
?>