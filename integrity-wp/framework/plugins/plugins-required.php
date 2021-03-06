<?php


	add_action( 'tgmpa_register', 'ewf_register_required_plugins' );

	function ewf_register_required_plugins() {
		
		$plugins = array(
			
			array(
				'name' 					=> 'Contact Form 7',
				'slug' 					=> 'contact-form-7', 
				'required' 				=> false,
			),
			array(
				'name' 					=> 'WooCommerce',
				'slug' 					=> 'woocommerce', 
				'required' 				=> false,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
			),
			array(
				'name'					=> 'WPBakery Visual Composer',
				'slug'					=> 'js_composer',
				'source'				=>  get_template_directory().'/framework/plugins/js_composer.zip',
				'required'				=> false,
				'version'				=> '4.5.3',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),			
			array(
				'name'					=> 'Parallax Backgrounds for VC',
				'slug'					=> 'parallax-backgrounds-for-vc',
				'source'				=>  get_template_directory().'/framework/plugins/parallax-backgrounds-for-vc.zip',
				'required'				=> false,
				'version'				=> '3.6.1',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),
			array(
				'name'					=> 'Revolution Slider',
				'slug'					=> 'revslider',
				'source'				=> get_template_directory().'/framework/plugins/revslider.zip',
				'required'				=> false,
				'version'				=> '4.6.93',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),
			array(
				'name'					=> 'EWF Portfolio',
				'slug'					=> 'ewf-portfolio',
				'source'				=> get_template_directory().'/framework/plugins/ewf-portfolio.zip',
				'required'				=> false,
				'version'				=> '1.0.0',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			)
		);

		$config = array(
			'domain'       		=> EWF_SETUP_THEME_DOMAIN,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                       	  	// Default absolute path to pre-packaged plugins
			'menu'         		=> 'install-required-plugins', 		// Menu slug
			'parent_menu_slug' 	=> 'themes.php', 					// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 					// Default parent URL slug
			'has_notices'      	=> true,                       		// Show admin notices or not
			'is_automatic'    	=> true,					   		// Automatically activate plugins after installation or not
			'message' 			=> '',								// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', EWF_SETUP_THEME_DOMAIN ),
				'menu_title'                       			=> __( 'Install Plugins', EWF_SETUP_THEME_DOMAIN ),
				'installing'                       			=> __( 'Installing Plugin: %s', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', EWF_SETUP_THEME_DOMAIN ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', EWF_SETUP_THEME_DOMAIN ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', EWF_SETUP_THEME_DOMAIN ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', EWF_SETUP_THEME_DOMAIN ),
				'return'                           			=> __( 'Return to Required Plugins Installer', EWF_SETUP_THEME_DOMAIN ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', EWF_SETUP_THEME_DOMAIN ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', EWF_SETUP_THEME_DOMAIN ),
				'nag_type'									=> 'updated' 
			)
		);

		tgmpa( $plugins, $config );		
	
	}
 
?>