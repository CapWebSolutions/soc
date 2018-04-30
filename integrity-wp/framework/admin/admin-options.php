<?php

	
	$ewf_admin_defaults = array(
		
		
	#	General typography
	#
		'body_font_size' 			=> '14px',
		'body_font_lineheight' 		=> '24px',
		'body_font_margin' 			=> '0px',
	
		
	#	Custom typography
	#
        'h1_font_size' 				=> '48px',
		'h1_font_lineheight' 		=> '64px',
		'h1_font_margin' 			=> '25px',
		
		'h2_font_size' 				=> '36px',
		'h2_font_lineheight' 		=> '48px',
		'h2_font_margin' 			=> '20px',
		
		'h3_font_size' 				=> '24px',
		'h3_font_lineheight' 		=> '36px',
		'h3_font_margin' 			=> '15px',
		
		'h4_font_size' 				=> '18px',
		'h4_font_lineheight' 		=> '27px',
		'h4_font_margin' 			=> '10px',
		
		'h5_font_size' 				=> '16px',
		'h5_font_lineheight' 		=> '24px',
		'h5_font_margin' 			=> '7px',
		
		'h6_font_size' 				=> '13px',
		'h6_font_lineheight' 		=> '24px',
		'h6_font_margin' 			=> '5px',
		
		
	#	Colors
	#
		
		'color_accent'				=> '#4fb7ff',
		'color_accent_02'			=> '#3a4e6a',
		
		'color_content'				=> '#6d6d6d',
		'color_heading_font'		=> '#313947',
		
		'color_menu_background' 	=> '#313947',
		'color_menu_font'			=> '#888888',
		'color_menu_font_hover'		=> '#F7F7F7',
		
		'color_header_top'			=> '#313947',
		'color_header_top_font'		=> '#ffffff',
		
		'color_footer'				=> '#313947',
		'color_footer_font'			=> '#ffffff',
		
		// 'color_footer_top'			=> '#4FB7FF',
		// 'color_footer_top_font'		=> '#ffffff',
		
		'color_footer_bottom'		=> '#0D131B',
		'color_footer_bottom_font'	=> '#ffffff',
		
		// 'color_accent_hover'		=> '#289ccb',
		// 'color_gray_accent_1'	=> '#cdcdcd',
		// 'color_gray_accent_2'	=> '#e9e9e9',
				
		
		
	#	Sidebar sizes
	#
		'page_sidebar_size'			=> '8,4',
		'blog_sidebar_size'			=> '8,4',
		
		
	#	Sections Columns
	#
		'footer_top_columns'		=> '12',
		'footer_columns'			=> '3,3,3,3',
		'footer_bottom_columns'		=> '6,6',
		
		
	#	Header settings
	
		'header_height'				=> '121px',
		'header_menu_height'		=> '121px',
		'header_menu_height_sticky'	=> '86px',
		
		
	#	Shop settings
		'shop_items'				=> '12',
		'shop_sidebar_size'			=> '9,3',
	
	);

	
	
	
	
	$ewf_admin_options = array (
		
		#	General Settings
		#
		array("type" => "panel", "name" => "Home page", "mode"=>"open", "id" => "ewf-panel-general"),					   
			  

				array(    "type" => "ewf-ui-image", 
					"image-size" => "full",
					"image-height" => "32",
							"id" => EWF_SETUP_THNAME."_favicon",
				 "section-title" => __("Favicon", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload your favicon", EWF_SETUP_THEME_DOMAIN),
						"import" => '/layout/images/default/favicon.png',
						   "std" => null),
				
				array(    "type" => "ewf-ui-image", 
					"image-size" => "full",
					"image-height" => "64",
							"id" => EWF_SETUP_THNAME."_favicon_retina",
				 "section-title" => __("Favicon Retina", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload your favicon", EWF_SETUP_THEME_DOMAIN),
						"import" => '/layout/images/default/apple-touch-icon-144-precomposed.png',
						   "std" => null),
		

				
			   array(     "type" => "ewf-ui-columns-size", 
							"id" => EWF_SETUP_THNAME."_page_sidebar_size",
					   "min" => '2',
					   "max" => '5',
				 "section-title" => __("Page sidebar size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns on sidebar", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['page_sidebar_size'] ),
						   
						   
			   array(     "type" => "ewf-ui-columns-size", 
							"id" => EWF_SETUP_THNAME."_blog_sidebar_size",
					   "min" => '2',
					   "max" => '5',
				 "section-title" => __("Blog sidebar size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns on sidebar", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['blog_sidebar_size'] ),

						   
				array(    "type" => "ewf-ui-options", 
							"id" => EWF_SETUP_THNAME."_page_layout",
					   "options" => array(
							'boxed-in'=>array(
									'label' => __('Boxed in', EWF_SETUP_THEME_DOMAIN),
									'value' => 'boxed-in',
									'class' => 'ewf-layout-boxedin'
								), 
							'full-width' => array(
									'label' => __('Full Width', EWF_SETUP_THEME_DOMAIN),
									'value' => 'full-width',
									'class' => 'ewf-layout-fullwidth'
								)
							),
				 "section-title" => __("Layout style", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the layout", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'full-width'),	
						   
						   
						   
				array(    "type" => "ewf-ui-select", 
							"id" => EWF_SETUP_THNAME."_page_404",
				 "section-title" => __("Page not found", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the 404 page from your existing pages", EWF_SETUP_THEME_DOMAIN),
					   "options" => ewf_load_site_pages(),		
						   "std" => 0),		
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_content_width",
						   "min" => '1170px',
						   "max" => '1500px',
						  "step" => '5',
				 "section-title" => __("Content width", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the content width", EWF_SETUP_THEME_DOMAIN),
						   "std" => '1370px'),	


				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_backtotop_button",
				 "section-title" => __("Show back to top button", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can show or hide the button", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'true'),
						   
					
				array(    "type" => "ewf-ui-background", 
					"image-size" => "thumbnail",
					"image-height" => "50",
							"id" => EWF_SETUP_THNAME."_background",
				 "section-title" => __("Background", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Adjust background settings", EWF_SETUP_THEME_DOMAIN),
						   "std" => json_encode(array(  
										array('name' => 'background-color'			, 'value' => '#343536'		),
										array('name' => 'background-pattern'		, 'value' => ''				),
										array('name' => 'background-repeat'			, 'value' => 'repeat-all'	),
										array('name' => 'background-position'		, 'value' => 'center center'),
										array('name' => 'background-image'			, 'value' => ''				),
										array('name' => 'background-image-preview'	, 'value' => ''				),
										array('name' => 'background-attachment'		, 'value' => 'scroll'		),
										array('name' => 'background-stretch'		, 'value' => 'false'		),
									))
								),
							
						  
				// array(    "type" => "textarea", 
							// "id" => EWF_SETUP_THNAME."_include_analytics",
				 // "section-title" => __('Google Analytics', EWF_SETUP_THEME_DOMAIN),
		   // "section-description" => __('Paste the analytics code', EWF_SETUP_THEME_DOMAIN),
						   // "std" => null ),
						  
				array(    "type" => "textarea", 
							"id" => EWF_SETUP_THNAME."_include_css",
				 "section-title" => __('Extra CSS Code', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Paste extra css code here', EWF_SETUP_THEME_DOMAIN),
						   "std" => null ),
						  
		array("type" => "panel", "mode"=>"close"),	
	
	
		#	Typography settings
		#
		array("type" => "panel", "name" => "Typography settings", "mode"=>"open", "id" => "ewf-panel-typography"),

				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_fonts_custom",
				 "section-title" => __("Use custom typography", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can overwrite custom fonts", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-fonts-custom',
						   "std" => 'false'),	

						   
				array(    "type" => "ewf-ui-section", "name" => '<strong>'.__("Global Font", EWF_SETUP_THEME_DOMAIN).'</strong>', "group" => 'fonts-custom') ,
			

				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_body_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'PT Sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_margin']),
													
				
				//
				//	H1
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 1", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
				
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h1_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h1_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						    "std" => $ewf_admin_defaults['h1_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h1_font_margin']),
				
				
				
				//
				//	H2
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 2", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h2_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						    "std" => $ewf_admin_defaults['h2_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h2_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h2_font_margin']),
						 
				//
				//	H3
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 3", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h3_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_margin']),
						   
				//
				//	H4
				// 
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 4", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h4_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_margin']),
						   
				//
				//	H5
				// 
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 5", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h5_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_margin']),
						   
				//
				//	H6
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 6", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),

				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h6_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_margin']),
				
		
		array("type" => "panel", "mode"=>"close"),
				
				
	
		#	Shop settings
		#
		array("type" => "panel", "name" => "Shop settings", "mode"=>"open", "id" => "ewf-panel-shop"),
				
				
			   array(     "type" => "ewf-ui-columns-size", 
							"id" => EWF_SETUP_THNAME."_shop_sidebar_size",
					   "min" => '2',
					   "max" => '5',
				 "section-title" => __("Shop sidebar size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns on sidebar", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['shop_sidebar_size'] ),
				
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_shop_items",
						   "min" => '6',
						   "max" => '36',
						  "step" => '1',
						  "unit" => '',
				 "section-title" => __('Items per page', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Number of items to show', EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['shop_items']),
			
				
		array("type" => "panel", "mode"=>"close"),				
	
	
	
		#	Import/Export settings
		#
		array("type" => "panel", "name" => "Import/Export settings", "mode"=>"open", "id" => "ewf-panel-import-export"),
				
				array( "type" => "ewf-mod-import-export" ),
				
		array("type" => "panel", "mode"=>"close"),
	
	
	
		#	Header settings
		#
		array("type" => "panel", "name" => "Header settings", "mode"=>"open", "id" => "ewf-panel-header"),
		
				array(    "type" => "ewf-ui-image",
					"image-size" => "ewf-header-logo",
							"id" => EWF_SETUP_THNAME."_logo_url",
				 "section-title" => __("Header logo", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload logo in the header", EWF_SETUP_THEME_DOMAIN),
						"import" => '/layout/images/default/logo.png',
						   "std" => null),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_header_height",
						   "min" => '80px',
						   "max" => '500px',
						  "step" => '1',
				 "section-title" => __("Header height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Allows you to adjust header height in case the logo doesn't fit properly.", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['header_height']),
						   
/*

				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_header_menu_height",
						   "min" => '80px',
						   "max" => '500px',
						  "step" => '1',
				 "section-title" => __("Menu height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Allows you to specify the menu height.", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['header_menu_height']),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_contact",
				 "section-title" => __("Show contact info", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => null,
 				    "dependency" => '.group-header-contact',
						   "std" => 'false'),	
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_header_menuoffset",
						   "min" => '0px',
						   "max" => '250px',
						  "step" => '1',
				 "section-title" => __("Menu offset", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Allows you to center the menu vertically in relation with the logo. Usefull when you have a very large logo.", EWF_SETUP_THEME_DOMAIN),
						   "std" => '0px'),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_contact_mail",
				 "section-title" => __("Show e-mail", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => null,
					"dependency" => '.group-header-contact-mail',
						   "std" => 'off'),
						   
						   
				array(    "type" => "text", 
							"id" => EWF_SETUP_THNAME."_header_mail",
				 "section-title" => __('Email from the header', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify your e-mail address', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'header-contact-mail',
						   "std" => 'email@website.com' ),

						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_contact_phone",
				 "section-title" => __("Show phone number", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => null,
					"dependency" => '.group-header-contact-phone',
						   "std" => 'off'),
						   
						   
				array(    "type" => "text", 
							"id" => EWF_SETUP_THNAME."_header_phone",
				 "section-title" => __('Phone from the header', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify your bussines phone number', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'header-contact-phone',
						   "std" => '(123) 456 7890' ),
*/
			
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_sticky",
					"dependency" => '.group-header-sticky',
				 "section-title" => __("Sticky header", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Keep the header visible after scrolling", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'true'),	
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_header_menu_height_sticky",
						   "min" => '80px',
						   "max" => '500px',
						  "step" => '1',
						 "group" => 'header-sticky',
				 "section-title" => __("Sticky header height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Allows you to specify the height of the sticky header.", EWF_SETUP_THEME_DOMAIN),
						   "std" => $ewf_admin_defaults['header_menu_height_sticky']),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_search",
				 "section-title" => __("Search", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Adds a search box on the right side of the menu", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'false'),

		array("type" => "panel", "mode"=>"close"),
		
		
		
		#	Footer settings
		#
		array("type" => "panel", "name" => "Footer settings", "mode"=>"open", "id" => "ewf-panel-footer"),
		
				// array(    "type" => "ewf-ui-toggle", 
							// "id" => EWF_SETUP_THNAME."_footer_top",
				 // "section-title" => __("Footer top", EWF_SETUP_THEME_DOMAIN),
		   // "section-description" => __("Show top footer section ", EWF_SETUP_THEME_DOMAIN),
					// "dependency" => '.group-footer-top',
						   // "std" => 'false'),
						   
						   
			   // array(     "type" => "ewf-ui-columns", 
							// "id" => EWF_SETUP_THNAME."_footer_top_columns",
				 // "section-title" => __("Footer top columns", EWF_SETUP_THEME_DOMAIN),
		   // "section-description" => __("Select the number of columns", EWF_SETUP_THEME_DOMAIN),
						 // "group" => 'footer-top',
						   // "std" => $ewf_admin_defaults['footer_top_columns']),
						   
		
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_footer_section",
				 "section-title" => __("Footer section", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Show footer section at the bottom", EWF_SETUP_THEME_DOMAIN),
				    "dependency" => '.group-footer-custom',
						   "std" => 'true'),
						   
						   
			   array(     "type" => "ewf-ui-columns", 
							"id" => EWF_SETUP_THNAME."_footer_columns",
				 "section-title" => __("Footer columns", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'footer-custom',
						   "std" => $ewf_admin_defaults['footer_columns'] ),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_footer_bottom",
				 "section-title" => __("Footer sub", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Show sub footer section at the bottom", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-footer-sub',
						   "std" => 'true'),	
						   
						   
			   array(     "type" => "ewf-ui-columns", 
							"id" => EWF_SETUP_THNAME."_footer_bottom_columns",
				 "section-title" => __("Footer sub columns", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'footer-sub',
						   "std" => $ewf_admin_defaults['footer_bottom_columns']),
					
		array("type" => "panel", "mode"=>"close"),
		
		
	 
		#	Color schemes
		#
		array("type" => "panel", "name" => "Colors schemes", "mode"=>"open", "id" => "ewf-panel-colors"),
			
			
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_colors_custom",
				 "section-title" => __("Use custom colors", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can overwrite the default color scheme", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-colors-custom',
						   "std" => 'false'),	
		
		
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_accent",
				 "section-title" => __('Accent color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_accent']),
		
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_accent_02",
				 "section-title" => __('Accent color 2', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_accent_02']),

				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_menu_background",
				 "section-title" => __('Menu background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_menu_background']),	
						   
						   
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_menu_font",
				 "section-title" => __('Menu font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_menu_font']),
						   
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_menu_font_hover",
				 "section-title" => __('Menu font hover color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_menu_font_hover']),
				

						   
		
		
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_header_top",
				 "section-title" => __('Header top background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_header_top']),
						  
						  						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_header_top_font",
				 "section-title" => __('Header top font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_header_top_font']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_content",
				 "section-title" => __('Content font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_content']),
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_heading_font",
				 "section-title" => __('Heading(s) color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_heading_font']),	

				
				// array(    "type" => "ewf-ui-color", 
							// "id" => EWF_SETUP_THNAME."_color_footer_top",
				 // "section-title" => __('Footer top color', EWF_SETUP_THEME_DOMAIN),
		   // "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 // "group" => 'colors-custom',
						   // "std" => $ewf_admin_defaults['color_footer_top']),
						  
						  
				// array(    "type" => "ewf-ui-color", 
							// "id" => EWF_SETUP_THNAME."_color_footer_top_font",
				 // "section-title" => __('Footer top font color', EWF_SETUP_THEME_DOMAIN),
		   // "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 // "group" => 'colors-custom',
						   // "std" => $ewf_admin_defaults['color_footer_top_font']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer",
				 "section-title" => __('Footer background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_font",
				 "section-title" => __('Footer font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_font']),

						   
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_bottom",
				 "section-title" => __('Footer bottom background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_bottom']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_bottom_font",
				 "section-title" => __('Footer bottom font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_bottom_font']),
		
		
		array("type" => "panel", "mode"=>"close"),


	);



	function ewf_admin_load_dynamicStyles(){
		global $ewf_admin_defaults;
		
		ob_start();
		
			
			//	Theme Options - Content Width
			//	
			
			$_eto_content_width = get_option(EWF_SETUP_THNAME."_content_width", '1370px');
			echo ".ewf-boxed-layout #wrap { max-width:".$_eto_content_width.";} \n";
			
			
			echo '.ewf-debug-message  { background-color: #FCFCFC;border-left: 4px solid #7ad03a;box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);padding:12px;margin:20px;color:#555; }';

			
			// 	Theme Options - Header Height
			//
			$header_height = get_option(EWF_SETUP_THNAME."_header_height", $ewf_admin_defaults['header_height']);
			
			if ($header_height != $ewf_admin_defaults['header_height']){
				echo '@media (min-width: 1025px) {'."\n";
					echo '#header-wrap { height:'.$header_height.'; }'."\n";
				echo "} \n";
				
				$header_menu_height_val = round(($header_height - 20) / 2, 1);
				
				echo '.sf-menu > li > a,'."\n";
				echo '.sf-menu > li.dropdown > a { padding: '.$header_menu_height_val.'px 22px '.$header_menu_height_val.'px 22px; }'."\n";
				
				
				$header_height_button = round(($header_height / 2) - 17, 1);
				$header_height_form = round( $header_height_button + 54, 1);
				
				echo '@media (min-width: 980px) {';
					echo '#custom-search-button { top:'.$header_height_button.'px; }';
					echo '#custom-search-form { top:'.$header_height_form.'px; }';
				echo '}';

			}
			
			
			$header_sticky = get_option(EWF_SETUP_THNAME."_header_sticky", "true");
			if ($header_sticky === 'true'){
				$header_menu_height_sticky = get_option(EWF_SETUP_THNAME."_header_menu_height_sticky", $ewf_admin_defaults['header_menu_height_sticky']);
				$header_menu_height_sticky_val = round(($header_menu_height_sticky - 20) / 2, 1);
				
				$header_height_button = round(($header_menu_height_sticky /2) - 32, 1);
				$header_height_form = round( $header_height_button + 50, 1);
				
				echo '@media (min-width: 1025px) {';
					echo '#header.stuck  .sf-menu > li > a,';
					echo '#header.stuck  .sf-menu > li.dropdown > a {padding: '.$header_menu_height_sticky_val.'px 20px; }';
					
					echo '#header.stuck  #custom-search-button { top: '.$header_height_button.'px; }';
					echo '#header.stuck  #custom-search-form { top: '.$header_height_form.'px; }';
				echo '}';
				
				echo '@media (min-width: 1400px) {';
					echo '#header.stuck  .sf-menu > li > a,';
					echo '#header.stuck  .sf-menu > li.dropdown > a {padding: '.$header_menu_height_sticky_val.'px 22px; }';
				echo '}';				
				
			}
			


			// 	Theme Options - Header Menu Offset
			//
			$header_menuoffset = get_option(EWF_SETUP_THNAME."_header_menuoffset", '0px');
			if ($header_menuoffset != '0px'){
				echo '.sf-menu { margin-top:'.$header_menuoffset.'; }';
			}
			
		
		?>
		
		<?php	if (get_option(EWF_SETUP_THNAME."_colors_custom", "false") == 'true'){  ?>	
				
				<?php
				
				get_option('color_accent_02', '#fff');

				$color_accent = get_option(EWF_SETUP_THNAME."_color_accent"								, $ewf_admin_defaults['color_accent']);				
				$color_accent_02 = get_option(EWF_SETUP_THNAME."_color_accent_02"						, $ewf_admin_defaults['color_accent_02']);
				
				$color_content = get_option(EWF_SETUP_THNAME."_color_content"							, $ewf_admin_defaults['color_content']);
				$color_heading_font = get_option(EWF_SETUP_THNAME."_color_heading_font"					, $ewf_admin_defaults['color_heading_font']);
				
				$color_menu_font = get_option(EWF_SETUP_THNAME."_color_menu_font"						, $ewf_admin_defaults['color_menu_font']);
				$color_menu_font_hover = get_option(EWF_SETUP_THNAME."_color_menu_font_hover"			, $ewf_admin_defaults['color_menu_font_hover']);
				$color_menu_background = get_option(EWF_SETUP_THNAME."_color_menu_background"			, $ewf_admin_defaults['color_menu_background']);
				
				$color_header_top = get_option(EWF_SETUP_THNAME."_color_header_top"						, $ewf_admin_defaults['color_header_top']);
				$color_header_top_font = get_option(EWF_SETUP_THNAME."_color_header_top_font"			, $ewf_admin_defaults['color_header_top_font']);
				
				$color_footer = get_option(EWF_SETUP_THNAME."_color_footer"								, $ewf_admin_defaults['color_footer']);
				$color_footer_font = get_option(EWF_SETUP_THNAME."_color_footer_font"					, $ewf_admin_defaults['color_footer_font']);
				
				// $color_footer_top = get_option(EWF_SETUP_THNAME."_color_footer_top"						, $ewf_admin_defaults['color_footer_top']);
				// $color_footer_top_font = get_option(EWF_SETUP_THNAME."_color_footer_top_font"			, $ewf_admin_defaults['color_footer_top_font']);
				
				$color_footer_bottom = get_option(EWF_SETUP_THNAME."_color_footer_bottom"				, $ewf_admin_defaults['color_footer_bottom']);
				$color_footer_bottom_font = get_option(EWF_SETUP_THNAME."_color_footer_bottom_font"		, $ewf_admin_defaults['color_footer_bottom_font']);

				
				?>
		
				/*	###	EWF Custom Colors 	*/
				
				 
	body {
		background-color: #343536;
		color: <?php echo $color_content; ?>;
	}

	h1, 
	h2, 
	h3, 
	h4, 
	h5, 
	h6 {
		color: <?php echo $color_heading_font; ?>;
	}
		
	h1 a, 
	h2 a, 
	h3 a, 
	h4 a, 
	h5 a, 
	h6 a { 
		color: <?php echo $color_heading_font; ?>;
	}
	
	
	abbr[title] {  
		border-bottom: 1px dotted #999; 
		cursor: help;
	}
	

	hr { 
		border: solid #e0e0e0; 
	}

	code { 
		border: 1px solid #e0e0e0;
		background-color: #f3f3f3;  
		color: #d50f25;  
	}
	
	pre { 
		border: 1px solid #e0e0e0;   
		background-color: #f3f3f3; 
	}
	
	.mute{ color: #999; }

	a, 
	a:visited { 
		color: <?php echo $color_accent; ?>; 
	}
	
	table th, 
	table td {
		border-top: 1px solid <?php echo $color_content; ?>;
	}
	
	table th { 
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	table th a { color: #fff; } 
	
	::-moz-placeholder,
	::-webkit-input-placeholder,
	:-ms-input-placeholder {
		color: #999;
	}
	
	input[type="text"],
	input[type="password"],
	input[type="date"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="month"],
	input[type="week"],
	input[type="email"],
	input[type="number"],
	input[type="search"],
	input[type="tel"],
	input[type="time"],
	input[type="url"],
	input[type="color"],
	textarea {
		border: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
		background-color: #fff;
	}

	input[type="text"]:focus,
	input[type="password"]:focus,
	input[type="date"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="month"]:focus,
	input[type="week"]:focus,
	input[type="email"]:focus,
	input[type="number"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="time"]:focus,
	input[type="url"]:focus,
	input[type="color"]:focus,
	textarea:focus {
		border-color: #e0e0e0;
	}

	input[type="text"]:disabled,
	input[type="password"]:disabled,
	input[type="date"]:disabled,
	input[type="datetime"]:disabled,
	input[type="datetime-local"]:disabled,
	input[type="month"]:disabled,
	input[type="week"]:disabled,
	input[type="email"]:disabled,
	input[type="number"]:disabled,
	input[type="search"]:disabled,
	input[type="tel"]:disabled,
	input[type="time"]:disabled,
	input[type="url"]:disabled,
	input[type="color"]:disabled,
	textarea:disabled {
		background-color: #f3f3f3;
	}

	input[type="text"][disabled],
	input[type="text"][readonly],
	fieldset[disabled] input[type="text"],
	input[type="password"][disabled],
	input[type="password"][readonly],
	fieldset[disabled] input[type="password"],
	input[type="date"][disabled],
	input[type="date"][readonly],
	fieldset[disabled] input[type="date"],
	input[type="datetime"][disabled],
	input[type="datetime"][readonly],
	fieldset[disabled] input[type="datetime"],
	input[type="datetime-local"][disabled],
	input[type="datetime-local"][readonly],
	fieldset[disabled] input[type="datetime-local"],
	input[type="month"][disabled],
	input[type="month"][readonly],
	fieldset[disabled] input[type="month"],
	input[type="week"][disabled],
	input[type="week"][readonly],
	fieldset[disabled] input[type="week"],
	input[type="email"][disabled],
	input[type="email"][readonly],
	fieldset[disabled] input[type="email"],
	input[type="number"][disabled],
	input[type="number"][readonly],
	fieldset[disabled] input[type="number"],
	input[type="search"][disabled],
	input[type="search"][readonly],
	fieldset[disabled] input[type="search"],
	input[type="tel"][disabled],
	input[type="tel"][readonly],
	fieldset[disabled] input[type="tel"],
	input[type="time"][disabled],
	input[type="time"][readonly],
	fieldset[disabled] input[type="time"],
	input[type="url"][disabled],
	input[type="url"][readonly],
	fieldset[disabled] input[type="url"],
	input[type="color"][disabled],
	input[type="color"][readonly],
	fieldset[disabled] input[type="color"],
	textarea[disabled],
	textarea[readonly],
	fieldset[disabled] textarea {
		background-color: #f3f3f3;
	}

	select {
		border: 1px solid #e0e0e0;
		background-color: #fff;
		color: <?php echo $color_content; ?>;
	}

	select:disabled {
		background-color: #f3f3f3;
	}
	
	select:focus { border-color: #bbb; }

	button,
	input[type="reset"],
	input[type="submit"],
	input[type="button"]{
		border: 1px solid <?php echo $color_accent; ?>;
		border-bottom: 1px solid <?php echo $color_accent; ?>;
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}

	button:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	input[type="button"]:hover {
		border: 1px solid <?php echo $color_accent_02; ?>;
		background: none repeat scroll 0 0 <?php echo $color_accent_02; ?>;
		color: #fff;
	}

	.wpb_accordion_header {
		border: 1px solid #e0e0e0 !important;
		background-color: #fff !important;
		color: <?php echo $color_content; ?> !important;
	}
	
	.wpb_accordion_header a{ color: <?php echo $color_content; ?> !important; }
	
	.wpb_accordion_header.ui-state-hover,
	.wpb_accordion_header.ui-state-active {
		background-color: #fff !important;
		border-color: #e0e0e0 !important;
	}
	
	.wpb_accordion_header.ui-state-hover a,
	.wpb_accordion_header.ui-state-active a{ color: <?php echo $color_content; ?> !important;}
	
	.wpb_accordion_header.ui-state-active:after, .wpb_accordion_header.ui-state-hover:after {
		color: <?php echo $color_content; ?> ;
	}
	
	.btn { 
		border-bottom: 1px solid <?php echo $color_accent; ?>;
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	a.btn { color: #fff; }
	
	.btn:hover { 
		border-bottom-color: <?php echo $color_accent_02; ?>;
		background-color: <?php echo $color_accent_02; ?>;
	}
	
	.btn-white.alt { border-color: <?php echo $color_content; ?>; background-color: transparent; }
	a.btn-white.alt { color: <?php echo $color_content; ?>; }
	
	.btn-white.alt:hover { 
		border-color: <?php echo $color_accent_02; ?>;
		background-color: <?php echo $color_accent_02; ?>;
	}
	
	ul.check li:before,
	ul.square-check li:before { 
		color: <?php echo $color_accent; ?>;
	}
	
	ul.fill-circle li:before {
		background-color: <?php echo $color_accent; ?>;
	}
	
	ul.square li:before {
		background-color: <?php echo $color_accent; ?>;
	}
	
	ul.diamond li:before {
		background-color: <?php echo $color_accent; ?>;
	}
	
	.divider { margin: 30px 0; }
	
	.divider.single-line { border-top: 1px solid #e0e0e0; }
	
	.divider.double-line { border-top: 4px double #e0e0e0; }
	
	
	.headline h2:after,
	.headline h3:after {
		border-top: 2px solid <?php echo $color_accent; ?>;
	}
	
	.headline-2 h1:after {
		border-top: 2px solid <?php echo $color_accent; ?>;
	}
	
	.headline-2 h2:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.headline-2 h3:after,
	.headline-2 h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.icon-box-1 > span {
		background-color: <?php echo $color_accent_02; ?>;
	} 
	
	.icon-box-1:hover > span {
		background-color: <?php echo $color_accent; ?>;
	}
	
	.icon-box-2 > span { 
		border: 1px solid #e0e0e0;
	}
	
	.icon-box-2:hover > span {
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.icon-box-3 > span {
		border: 1px solid #e0e0e0;		
		background-color: #fff;	
		text-align: center; 
	}
	
	.icon-box-3 > span i {
		color: <?php echo $color_content; ?>;		
	}
	
	.icon-box-3 .icon-box-content { 
		border: 1px solid #e0e0e0; 
	}
	
	.icon-box-3:hover > span {
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.milestone .milestone-content {
		color: <?php echo $color_accent_02; ?>;
	}
	
	.milestone .milestone-description p:before {
		border-top: 2px solid <?php echo $color_accent; ?>;
	}
	
	.horizontal-process-builder:before {
		border-top: 1px solid #e0e0e0;
	}
	
	.horizontal-process-builder li i,
	.horizontal-process-builder li h1,
	.horizontal-process-builder li img {
		border: 1px solid #e0e0e0;
		background-color: #fff;
		color: #111;
	}
	
	.horizontal-process-builder li:hover i,
	.horizontal-process-builder li:hover h1 {
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}

	.pie-chart {
		background-color: <?php echo $color_accent; ?>;
	}
	
	.pie-chart i, 
	.pie-chart .pie-chart-custom-text, 
	.pie-chart .pie-chart-percent {
		color: #fff;
	}
	
	.pie-chart:hover { background-color: <?php echo $color_accent_02; ?>; }
	
	.pricing-table {
		background-color: #f1f1f1;
		color: <?php echo $color_content; ?>;		
	}

	.pricing-table-header h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.pricing-table h1 {
		background-color: #f9f9f9;
	}
	
	.pricing-table-offer ul li { 
		border-top: 1px solid #fff; 
	}
	
	.pricing-table:hover { 
		background-color: <?php echo $color_heading_font; ?>;
		color: #fff;
	}
	
	.pricing-table:hover h1 { 
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.pricing-table:hover .pricing-table-header h4, 
	.pricing-table:hover .pricing-table-header h6 { color: #fff; }
	
	.pricing-table.alt { 
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.pricing-table.alt h1 { 
		background-color: <?php echo $color_heading_font; ?>;
		color: #fff;
	}
	
	.pricing-table.alt .btn-white {
		border-color: #fff;
		color: #fff;
	}
	
	.pricing-table.alt .pricing-table-header h4, 
	.pricing-table.alt .pricing-table-header h6 { color: #fff; }
	
	.pricing-table.alt .pricing-table-header h4:after { border-top-color: <?php echo $color_heading_font; ?>; }
	
	.pricing-table.alt:hover { background-color: <?php echo $color_heading_font; ?>; }
	.pricing-table.alt:hover h1 { background-color: <?php echo $color_accent; ?>; }
	.pricing-table.alt .pricing-table-header h4:after { border-top-color: <?php echo $color_heading_font; ?>; }
	.pricing-table.alt:hover .pricing-table-header h4:after { border-top-color: <?php echo $color_accent; ?>; }

	.progress-bar-description span {
		color: #fff;
	}
	
	.progress-bar {
		background-color: #e0e0e0;
	}
	
	.progress-bar .progress-bar-outer {
		background-color: <?php echo $color_accent; ?>;
	}
	
	a.social-icon {
		border: 1px solid <?php echo $color_accent; ?>;
	}

	.table-bordered { 
		border: 1px solid #e0e0e0; 	
	}
	
	.table-bordered th, 
	.table-bordered td { border-left: 1px solid #e0e0e0; }
	
	.table-striped tbody tr:nth-child(odd) td,
	.table-striped tbody tr:nth-child(odd) th { background-color: #f3f3f3; }	

	@media (max-width: 480px) {

		tr { border-top: 1px solid #bbb; }
	  
	}

   .wpb_tabs_nav  {
		border-bottom: 1px solid #e0e0e0 !important;
	}
	
	.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a {
		border: 1px solid #e0e0e0;
	}
	
	.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav:first-child a {
		border-left: 1px solid #e0e0e0 !important;
	}
	
	
	.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a {
		border: 1px solid #e0e0e0;
		border-bottom-color: #fff;
		background-color: #fff !important;
		color: <?php echo $color_content; ?> !important;
	}
	
	.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab{
		border: 1px solid #e0e0e0 !important; 
		background-color: transparent !important;
	}
	
	.wpb_content_element .wpb_tabs_nav li.ui-tabs-active, 
	.wpb_content_element .wpb_tabs_nav li:hover {
		background-color: #f7f7f7;
	}
	
	.testimonial > h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.testimonial-2 blockquote {
		border: 1px solid <?php echo $color_accent; ?>;
	}
	
	.testimonial-2 blockquote:before {
		border-top: 10px solid <?php echo $color_accent; ?>;
	}
	
	.testimonial-2 blockquote:after {
		border-top: 8px solid #fff;
	}
	
	.testimonial-2 > h5:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.testimonial-3 > h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.team-member {
		border: 1px solid #e0e0e0;
	}
	
	.team-member-overlay {
		background-color: rgba(79, 183, 255, 0.5);
	}
	
	.team-member h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.team-member:hover { background-color: <?php echo $color_accent_02; ?>; }
	
	.team-member:hover h4,
	.team-member:hover h6 { color: #fff; }
	
	.team-member .social-media a {
		border-color: #fff;
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	
	.left-side,
	.right-side {
		color: <?php echo $color_content; ?>;	
		background-color: #f1f1f1;
	}
	
	.left-side:before {
		border-left: 10px solid #f1f1f1;
	}
	
	.right-side:before {
		border-right: 10px solid #f1f1f1;
	}
	
	.vertical-timeline li:nth-child(odd) .right-side,
	.vertical-timeline li:nth-child(even) .left-side,
	.vertical-timeline li:hover:nth-child(odd) .right-side,
	.vertical-timeline li:hover:nth-child(even) .left-side { background-color: transparent; }
	
	.vertical-timeline li:hover .left-side,
	.vertical-timeline li:hover .right-side { 
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.vertical-timeline li:hover .left-side h4,
	.vertical-timeline li:hover .right-side h4 { color: #fff; }
	
	.vertical-timeline li:hover .left-side:before { border-left-color: <?php echo $color_accent; ?>; }
	.vertical-timeline li:hover .right-side:before { border-right-color: <?php echo $color_accent; ?>; }
	
	.separator:before {
		border-left: 1px solid #e0e0e0;
	}
	
	.separator span {
		background-color: <?php echo $color_accent; ?>; 
	}
	
	.separator span i {
		color: #fff;
	}
	
	.vertical-timeline li:hover .separator span { background-color: <?php echo $color_accent_02; ?>; }
	
	.personal-info { list-style: none; }
	
	.personal-info li {
		border-bottom: 1px solid #e0e0e0;
	}
	
	.portfolio-item { 
		border: 1px solid #e0e0e0;
	}
	
	.portfolio-item-overlay {
		background-color: rgba(79, 183, 255, 0.5);
	}
	
	.portfolio-item-overlay-actions .portfolio-item-zoom,
	.portfolio-item-overlay-actions .portfolio-item-link {
		border: 1px solid #fff;
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.portfolio-item-overlay-actions .portfolio-item-zoom i,
	.portfolio-item-overlay-actions .portfolio-item-link i {
		color: #fff;  
	}
	
	.portfolio-item-overlay-actions .portfolio-item-zoom:hover,
	.portfolio-item-overlay-actions .portfolio-item-link:hover { background-color: <?php echo $color_accent_02; ?>; }
	
	.portfolio-item-description {
		background-color: #fff;
		color: <?php echo $color_content; ?>;
	}
	
	.portfolio-item-description h6:before {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.portfolio-item:hover .portfolio-item-description { background-color: <?php echo $color_accent_02; ?>; }
	
	.portfolio-item:hover .portfolio-item-description h4,
	.portfolio-item:hover .portfolio-item-description h5,
	.portfolio-item:hover .portfolio-item-description h6 { color: #fff; } 

	.portfolio-filter ul li a {
		border: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>; 
	}
	
	.portfolio-filter ul li a:hover,
	.portfolio-filter ul li a.active {
		background-color: <?php echo $color_accent; ?>;
		color: #fff; 
	}	
	
	.pagination a { 
		border: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.pagination li a:hover,
	.pagination li.current a { 
		color: #fff; 
		background-color: <?php echo $color_accent; ?>; 
	}	

	.blog-post {
		border: 1px solid #e0e0e0;
	}
	
	.blog-post-title:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.blog-post-title a { color: <?php echo $color_content; ?>; }
	
	.blog-post-info {
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.blog-post-slider .blog-post:hover {
		background-color: transparent;
		color: <?php echo $color_content; ?>;
	}
	
	.blog-post-slider .blog-post:hover a { color: <?php echo $color_content; ?>; }
	.blog-post-slider .blog-post:hover .btn { color: #fff; }
	
	.blog-post.alt:hover {
		background-color: transparent;
		color: <?php echo $color_content; ?>;
	}
	
	.blog-post.alt .blog-post-title h4:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.blog-post blockquote {
		background-color: #f7f7f7;
	}
	
	.blog-post blockquote:before {
		color: <?php echo $color_accent; ?>;
	}

	.sticky {
		background-color: #f7f7f7;
	}
	
	.caption-text,
	.wp-caption-text {
		color: <?php echo $color_content; ?>;
	}

	.gallery-caption {
		color: <?php echo $color_content; ?>;
	}

	.widget-title:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.widget_recent_entries ul li > a {
		color: <?php echo $color_accent_02; ?>;
	}
	
	.widget_recent_entries ul li .post-date a { color: <?php echo $color_content; ?>; }
	
	.widget_pages li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_pages li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}	

	.widget_archive li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_archive li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}	

	.widget_categories li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_categories li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}
	
	.widget_meta li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_meta li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}	

	.widget_tag_cloud a {
		border: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_tag_cloud a:hover {
		border-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent; ?>;
	}
	
	.widget_nav_menu li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.widget_nav_menu li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}	
	
	.ewf_widget_contact_info ul li span {
		border: 1px solid <?php echo $color_accent; ?>;
	}
	
	.ewf_widget_contact_info ul li a { color: <?php echo $color_content; ?>; }
	
	.ewf_widget_latest_posts ul li .title {
		color: <?php echo $color_accent_02; ?>;
	}	
	
	.ewf_widget_latest_posts ul li .title:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.ewf_widget_navigation li a {
		border-bottom: 1px solid #e0e0e0;
		color: <?php echo $color_content; ?>;
	}
	
	.ewf_widget_navigation li a:hover {
		border-bottom-color: <?php echo $color_accent; ?>;
		color: <?php echo $color_accent_02; ?>;
	}	
	
	.comments-title:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
	
	.commentlist .reply a {
		border-bottom: 1px solid <?php echo $color_accent; ?>;
		background-color: <?php echo $color_accent; ?>;
		color: #fff;
	}
	
	.commentlist .reply a:hover {
		border-bottom-color: <?php echo $color_accent_02; ?>;
		background-color: <?php echo $color_accent_02; ?>;
	}
	
	.commentlist .vcard cite.fn a.url {
		color: <?php echo $color_accent_02; ?>;
	}
	
	.commentlist .vcard cite.fn a.url:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}

	.commentlist .comment-meta a {
		color: <?php echo $color_content; ?>;
	}
	
	.commentlist > ul > li {
		border-top: 1px solid #e0e0e0; 
	}
	
	.section-heading:after {
		border-top: 1px solid <?php echo $color_accent; ?>;
	}
   

	.tp-bullets.simplebullets.round .bullet {
		background: <?php echo $color_accent; ?>;
	}

	.tp-bullets.simplebullets.round .bullet.selected { background: <?php echo $color_accent_02; ?>;  }

	.tp-leftarrow.default { background-color: <?php echo $color_accent_02; ?>; }
	.tp-rightarrow.default { background-color: <?php echo $color_accent_02; ?>; }

	.caption.title {
		color: #fff;
	}
	
	.caption.title-bg {
		background-color: <?php echo $color_accent_02; ?>;
		color: #fff;
	}
	
	.caption.title-2 {
		color: #fff;
	}
	
	.caption.title-2:after {
		border-top: 2px solid <?php echo $color_accent; ?>;
	}
	
	.caption.subtitle {
		border-left: 3px solid #fff;
		color: #fff;
	}
	
	.caption.text {
		color: #fff;
	}
	
	.caption .btn,
	.caption .btn:hover { color: #fff; }

	#wrap {
		background-color: #fff;
	}
	
	@media (max-width: 767px) {

		#wrap { border-top: 10px solid <?php echo $color_header_top; ?>; }

	}
	
	#header-top {
		background-color: <?php echo $color_header_top; ?>;
		color: <?php echo $color_header_top_font; ?>;
	}
   
   	#header-top a, 
	#header-top h1,
	#header-top h2,
	#header-top h3,
	#header-top h4,
	#header-top h5,
	#header-top h6 { color: <?php echo $color_header_top_font; ?>; }

   .ewf-shop-cart span { 
		background:<?php echo $color_accent; ?>;
	}
   
	.sf-menu a {
		color: <?php echo $color_menu_font; ?>; 
	}
	
	.sf-menu > li > a,
	.sf-menu > li.dropdown > a {
		color: <?php echo $color_menu_font; ?>;
	}

	.sf-menu li:hover > a,
	.sf-menu li.sfHover > a {
		color: <?php echo $color_accent; ?>;
	}
	
	.sf-menu > li.current-page-ancestor > a,
	.sf-menu > li.current-menu-ancestor > a,
	.sf-menu > li.current-menu-parent > a,
	.sf-menu > li.current-page-parent > a,
	.sf-menu > li.current > a,
	.sf-menu > li.current.dropdown > a {
		border-top-color: <?php echo $color_accent; ?>;
		background-color: <?php echo $color_menu_font_hover; ?>;
	}
	
	.sf-menu li.dropdown ul {
		border: 1px solid rgba(0, 0, 0, 0.1);	
		background-color: rgba(49, 57, 71, 0.9);			
	}
	
	.sf-menu li.dropdown ul li a {
		color: #fff; 
	}
	
	.sf-menu li.dropdown ul li a:hover { color: <?php echo $color_accent; ?>; } 

	.sf-menu > li.dropdown > ul { border-top: 3px solid <?php echo $color_accent; ?>; }	

	.sf-mega {
		border: 1px solid rgba(0, 0, 0, 0.1);
		border-top: 3px solid <?php echo $color_accent; ?>;	
		background-color: rgba(49, 57, 71, 0.9);
	}
	
	.sf-mega a { color: #fff; }

	.sf-mega-section {
		color: #fff;
	}
	
	.sf-mega-section ul li a:hover { color: <?php echo $color_accent; ?>; }
	
	.sf-arrows .sf-with-ul:after {
		border-top-color: #fff;
	}
	
	.sf-arrows > li > .sf-with-ul:focus:after,
	.sf-arrows > li:hover > .sf-with-ul:after,
	.sf-arrows > .sfHover > .sf-with-ul:after { border-top-color: <?php echo $color_accent; ?>; }
		
	.sf-arrows ul .sf-with-ul:after {
		border-color: transparent;
		border-left-color: #999;
	}
	
	.sf-arrows ul li > .sf-with-ul:focus:after,
	.sf-arrows ul li:hover > .sf-with-ul:after,
	.sf-arrows ul .sfHover > .sf-with-ul:after { border-left-color: <?php echo $color_accent; ?>; }
			
	#mobile-menu {
		border-bottom: 1px solid #e0e0e0;
		background-color: rgba(49, 57, 71, 0.7);
	}
	
	#mobile-menu .sf-mega {
		background-color: transparent;
	}
	
	#mobile-menu li a {
		border-top: 1px solid #e0e0e0;
		color: #fff;
	}
	
	#mobile-menu .mobile-menu-submenu-arrow {
		border-left: 1px solid #e0e0e0;
		color: #fff;
	}
	
	#mobile-menu .mobile-menu-submenu-arrow:hover { background-color: <?php echo $color_accent_02; ?>; }
	
	#custom-search-button { 
		border: 1px solid #bebebe;
	}
	
	
	#custom-search-form:before {
		border-left: 7px solid transparent; 
		border-right: 7px solid transparent; 
		border-bottom: 10px solid #e0e0e0; 
	}
	
	#custom-search-form:after {
		border-left: 7px solid transparent; 
		border-right: 7px solid transparent; 
		border-bottom: 10px solid #fff; 
	}
	
	#custom-search-form #s {
		background-color: #fff; 
	}
	
	#custom-search-form #s:focus { border-color: #e0e0e0; }
	
	
	@media (min-width: 1025px) {
		
	
		#header.stuck {
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
		}
		
	}
	
	#page-header {
		color: #fff;
	}
	
	#page-header h3 {
		color: #fff;
	}

	#footer { 
		background-color: <?php echo $color_footer; ?>;
		color: <?php echo $color_footer_font; ?>;
	}
	
	#footer a, 
	#footer h1,
	#footer h2,
	#footer h3,
	#footer h4,
	#footer h5,
	#footer h6 { color: <?php echo $color_footer_font; ?>; }

	#footer-bottom { 
		background-color: <?php echo $color_footer_bottom; ?>;
		color: <?php echo $color_footer_bottom_font; ?>;	
	}
	
	#footer-bottom a, 
	#footer-bottom h1,
	#footer-bottom h2,
	#footer-bottom h3,
	#footer-bottom h4,
	#footer-bottom h5,
	#footer-bottom h6 { color: <?php echo $color_footer_bottom_font; ?>; }

	.bx-wrapper .bx-pager {
		color: #111;
	}
	
	.bx-wrapper .bx-pager.bx-default-pager a {
		background: <?php echo $color_accent; ?>;	
	}
	
	.bx-wrapper .bx-pager.bx-default-pager a:hover,
	.bx-wrapper .bx-pager.bx-default-pager a.active { background: <?php echo $color_accent_02; ?>; }
	
	.bx-wrapper .bx-controls-direction a {
		background-color: <?php echo $color_accent; ?>;
	}
	
	.bx-wrapper .bx-controls-direction a:hover { background-color: <?php echo $color_accent_02; ?>; }
	
	.bx-wrapper .bx-caption {
		background: rgba(80, 80, 80, 0.75);
	}
	
	.bx-wrapper .bx-caption span {
		color: #fff;
	}

			
		<?php	}	?>		
		
		
		
		
		<?php	
			
			

			//	Theme Options - Background
			//	
			$_body_background = ewf_admin_ui_font_decode(EWF_SETUP_THNAME."_background");
			echo "body { ".$_body_background."}\n" ;
			
		
			//	Theme Options - Header height
			//	
			if (get_option(EWF_SETUP_THNAME."_header_menu_height", '123px') == 'true'){
				
			}
			

			//	Theme Options - Typography
			//				
			if (get_option(EWF_SETUP_THNAME."_fonts_custom", 'false') == 'true'){
				echo "\n/*	###	EWF Custom Typography  */ \n";
				 

				//	Global Font
				//
				$_body_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_body_font", true);
				$_body_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_body_font_size", $ewf_admin_defaults['body_font_size'])."; \n";
				$_body_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_body_font_lineheight", $ewf_admin_defaults['body_font_lineheight'])."; \n";
				echo "body { ".$_body_font['css'].$_body_font_size.$_body_font_lineheight."\n }" ;
				
				
				
				$_h1_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h1_font", true);
				$_h1_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h1_font_size", $ewf_admin_defaults['h1_font_size'])."; \n";
				$_h1_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h1_font_lineheight", $ewf_admin_defaults['h1_font_lineheight'])."; \n";
				$_h1_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h1_font_margin", $ewf_admin_defaults['h1_font_margin'])."; \n";
				echo "h1 { ".$_h1_font['css'].$_h1_font_size.$_h1_font_lineheight.$_h1_font_margin."}\n\n" ;
				
				
				$_h2_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h2_font", true);
				$_h2_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h2_font_size", $ewf_admin_defaults['h2_font_size'])."; \n";
				$_h2_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h2_font_lineheight", $ewf_admin_defaults['h2_font_lineheight'])."; \n";
				$_h2_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h2_font_margin", $ewf_admin_defaults['h2_font_margin'])."; \n";
				echo "h2 { ".$_h2_font['css'].$_h2_font_size.$_h2_font_lineheight.$_h2_font_margin."}\n\n" ;
				
				
				$_h3_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h3_font", true);
				$_h3_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h3_font_size", $ewf_admin_defaults['h3_font_size'])."; \n";
				$_h3_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h3_font_lineheight", $ewf_admin_defaults['h3_font_lineheight'])."; \n";
				$_h3_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h3_font_margin", $ewf_admin_defaults['h3_font_margin'])."; \n";
				echo "h3 { ".$_h3_font['css'].$_h3_font_size.$_h3_font_lineheight.$_h3_font_margin."}\n\n" ;
				
				
				$_h4_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h4_font", true);
				$_h4_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h4_font_size", $ewf_admin_defaults['h4_font_size'])."; \n";
				$_h4_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h4_font_lineheight", $ewf_admin_defaults['h4_font_lineheight'])."; \n";
				$_h4_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h4_font_margin", $ewf_admin_defaults['h4_font_margin'])."; \n";
				echo "h4 { ".$_h4_font['css'].$_h4_font_size.$_h4_font_lineheight.$_h4_font_margin."}\n\n" ;
				

				$_h5_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h5_font", true);
				$_h5_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h5_font_size", $ewf_admin_defaults['h5_font_size'])."; \n";
				$_h5_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h5_font_lineheight",$ewf_admin_defaults['h5_font_lineheight'])."; \n";
				$_h5_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h5_font_margin", $ewf_admin_defaults['h5_font_margin'])."; \n";
				echo "h5 { ".$_h5_font['css'].$_h5_font_size.$_h5_font_lineheight.$_h5_font_margin."}\n\n" ;
				

				$_h6_font = ewf_admin_ui_font_decode( EWF_SETUP_THNAME."_h6_font", true);
				$_h6_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h6_font_size", $ewf_admin_defaults['h6_font_size'])."; \n";
				$_h6_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h6_font_lineheight", $ewf_admin_defaults['h6_font_lineheight'])."; \n";
				$_h6_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h6_font_margin", $ewf_admin_defaults['h6_font_margin'])."; \n";
				echo "h6 { ".$_h6_font['css'].$_h6_font_size.$_h6_font_lineheight.$_h6_font_margin."}\n\n" ;


			}	
		
		
		return ob_get_clean();
	
	}
	
?>