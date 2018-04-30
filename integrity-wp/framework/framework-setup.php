<?php

	
#	Load text domain and translation files
#	
	load_theme_textdomain( EWF_SETUP_THEME_DOMAIN, get_template_directory() .'/language/' );
	
	
#
#	Current theme settings
#	
	
	$ewf_theme_settings = array(
	
		'blog' => array(
			'layout' 	=> 'layout-sidebar-single-right',
			'sidebar' 	=> 'sidebar-page'
		),
		'page' => array(
			'layout' 	=> 'layout-full',
			'sidebar' 	=> 'sidebar-page'
		),		
		'shop' => array(
			'layout' 	=> 'layout-full',
			'sidebar' 	=> 'sidebar-shop'
		),	
	
	);


	add_action( 'init', 'ewf_load_includes', 1);
	function ewf_load_includes(){
		
		#	Composer Components
		#	
		if (function_exists('vc_add_param')){
			include_once ('composer/composer-setup.php'				);
		}
		
		
	}
	
	
	#	Check for the plugin init
	#
	if (!defined('EWF_PROJECTS_SLUG')){
		
		#	Change default slugs
		#
		define ('EWF_PROJECTS_SLUG'					, 'project'	);
		define ('EWF_PROJECTS_TAX_SERVICES'			, 'service'	);
		
		// echo '<br>Projects not defined!';
	}
		
	# 	Modules
	#
	include_once ('modules/ewf-header/ewf-modHeader.php'		); 
	include_once ('modules/ewf-layout/ewf-modLayout.php'		);
		
	
	#	Manage includes from framework
	#
	include_once ('functions-general.php'						);  
	
	
	#	Custom MCE Styles
	#
	include_once ('functions-mce-styles.php'					);	
	
	
	#	Custom post types
	#
	include_once ('functions-type-project.php'					);
	// include_once ('functions-meta-project.php'				); 
	
	

	#	Admin Options
	#
	include_once ('admin/admin-framework.php'					);
	include_once ('admin/admin-fonts.php'						);
	include_once ('admin/admin-options.php'						);
	include_once ('admin/admin-customizer.php'					);
	
	
	#	Menus & Sidebars
	#
	include_once ('functions-menus.php'							);
	include_once ('functions-sidebars.php'						);
	
	
	
	#	Post & Template handles
	#
	include_once ('functions-blog.php'							);
	include_once ('functions-meta-contact.php'					);
	
	
	#	Plugins
	#
	include_once ('plugins/plugins-activation.php'				);
	include_once ('plugins/plugins-required.php'				);
	
	
	#	Woocommerce setup
	#
	include_once ('functions-woocommerce.php'					);  
	
#
#	Add theme support
#


	
	#	Add thumbnails to post types
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'slide', 'project') );
	
	
	#	Add automatically feed links
	add_theme_support( 'automatic-feed-links' );
	
	
	#	Add Woocommerce support
	add_action( 'after_setup_theme', 'ewf_woocommerce_support' );
	function ewf_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	
	#	Slider support 
	add_theme_support( 'ewf-slider-description' );
	
	
	#	Add page excerpt support
	add_post_type_support( 'page', 'excerpt' );
	
	#	Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	
	
	#	Add thumbnail default size
	set_post_thumbnail_size( 50, 50, true ); 


	

#
#	Include all required scripts & css files in the theme
#
	add_action('wp_enqueue_scripts'								, 'ewf_load_frontend_includes');
	add_action('admin_enqueue_scripts'							, 'ewf_load_admin_includes');

	


	
	function ewf_load_admin_includes(){
	
		#  Font Awesome
		wp_enqueue_style('plugin-fontawesome'					, get_template_directory_uri().'/layout/css/fontawesome/font-awesome.min.css');
	
		#  	Font Iconfontcustom
		wp_enqueue_style('plugin-iconfontcustom'				, get_template_directory_uri().'/layout/css/iconfontcustom/icon-font-custom.css');
		
		#	Composer CSS
		wp_enqueue_style('ewf-composer'							, get_template_directory_uri().'/framework/composer/includes/ewf-composer.css');
		

		
		#	Alert Plugin
		wp_enqueue_style('sweet-alert'							, get_template_directory_uri().'/framework/admin/includes/sweet-alert/sweet-alert.css');
		wp_enqueue_script('sweet-alert'							, get_template_directory_uri().'/framework/admin/includes/sweet-alert/sweet-alert.min.js', array('jquery')); 		
		
		#	Admin Custom
		wp_enqueue_script('setup-js'							, get_template_directory_uri().'/framework/admin/includes/options-panel.js', array('jquery')); 		
		wp_enqueue_style('setup-css'							, get_template_directory_uri().'/framework/admin/includes/options-panel.css');
		
	}
	
	function ewf_load_frontend_includes(){
		$protocol = is_ssl() ? 'https' : 'http';

		
		wp_enqueue_style('grid'									, get_template_directory_uri().'/layout/css/grid.css' 			);
		wp_enqueue_style('base'									, get_template_directory_uri().'/layout/css/base.css' 			);
		wp_enqueue_style('layout'								, get_template_directory_uri().'/layout/css/layout.css' 		);
		wp_enqueue_style('elements'								, get_template_directory_uri().'/layout/css/elements.css' 		);
		wp_enqueue_style('shop'									, get_template_directory_uri().'/woocommerce/woocommerce.css'	);
		
		
		
		#  Style  - Font Awesome
		wp_enqueue_style('plugin-fontawesome-css'				, get_template_directory_uri().'/layout/css/fontawesome/font-awesome.min.css' );
			

		#  Style  - Font Iconfontcustom
		wp_enqueue_style('plugin-iconfontcustom-css'			, get_template_directory_uri().'/layout/css/iconfontcustom/icon-font-custom.css' );
		wp_enqueue_style('plugin-font'							, 'http://fonts.googleapis.com/css?family=Oswald:400,300,700' );
	
		
		#  Style  - Font includes
		ewf_admin_ui_font_includes();


		#  Plugin - Animations
		wp_enqueue_script('plugin-animations'					, get_template_directory_uri().'/layout/js/animations/animate.js'							, array('jquery'),'1.0', true );    		
		wp_enqueue_style('plugin-animations'					, get_template_directory_uri().'/layout/js/animations/animate.min.css' );
		

		#  Plugin - Viewport
		wp_enqueue_script('plugin-viewport'						, get_template_directory_uri().'/layout/js/viewport/jquery.viewport.js'						, array('jquery'),'1.0', true );    		
		
		
		#  Plugin - Easing
		wp_enqueue_script('plugin-easing'						, get_template_directory_uri().'/layout/js/easing/jquery.easing.1.3.js'						, array('jquery'),'1.0', true );    		
			
		
		#  Plugin - Simpleplaceholder
		wp_enqueue_script('plugin-simpleplaceholder'			, get_template_directory_uri().'/layout/js/simpleplaceholder/jquery.simpleplaceholder.js'	, array('jquery'),'1.0', true );    		
		
		
		#  Plugin - Superfish
		wp_enqueue_script('plugin-superfish'					, get_template_directory_uri().'/layout/js/superfish/superfish.js'							, array('jquery'),'1.0', true );    		
		wp_enqueue_script('plugin-superfish-intent'				, get_template_directory_uri().'/layout/js/superfish/hoverIntent.js'						, array('jquery'),'1.0', true );    		
		
		
		#  Plugin - BX Slider
		wp_enqueue_script('plugin-bxslider'						, get_template_directory_uri().'/layout/js/bxslider/jquery.bxslider.min.js'					, array('jquery'),'1.0', true );    		
		wp_enqueue_style('plugin-bxslider-css'					, get_template_directory_uri().'/layout/js/bxslider/jquery.bxslider.css' );

		
		#  Plugin - Countdown
		wp_enqueue_script('plugin-countdown'					, get_template_directory_uri().'/layout/js/countdown/jquery.countdown.min.js'				, array('jquery'),'1.0', true );    		
		wp_enqueue_style('plugin-countdown-css'					, get_template_directory_uri().'/layout/js/countdown/jquery.countdown.css' );
		
		#  Plugin - Magnific Popup
		wp_enqueue_script('plugin-magnificpopup'				, get_template_directory_uri().'/layout/js/magnificpopup/jquery.magnific-popup.min.js'		, array('jquery'),'1.0', true );    		
		wp_enqueue_style('plugin-magnificpopup-css'				, get_template_directory_uri().'/layout/js/magnificpopup/magnific-popup.css' );
			
						
		#  Plugin - Easy Piechart
		wp_enqueue_script('plugin-piechart'						, get_template_directory_uri().'/layout/js/easypiechart/jquery.easypiechart.min.js'			, array('jquery'),'1.0', true );    		
		
		
		#  Plugin - Twitter
		wp_enqueue_script('plugin-twitter'						, get_template_directory_uri().'/layout/js/twitter/twitterfetcher.js'						, array('jquery'),'1.0', true );    		
		
		
		#  Plugin - Google Maps & GMap
		wp_enqueue_script('plugin-gapi'							, 'http://maps.google.com/maps/api/js?sensor=false'  										, array('jquery'),'1.0', true );    		
		wp_enqueue_script('plugin-gmap'							, get_template_directory_uri().'/layout/js/gmap/jquery.gmap.min.js'							, array('jquery'),'1.0', true );    		
		
		

		#  General style
		wp_enqueue_style('theme-style'							, get_stylesheet_directory_uri().'/style.css' );
		wp_add_inline_style('theme-style'						, ewf_admin_load_dynamicStyles() );
		
		
		#  Load Scripts & Plugins
		wp_enqueue_script('plugins-js'							, get_template_directory_uri().'/layout/js/plugins.js'										, array('jquery'),'1.0', true );    		
		wp_enqueue_script('scripts-js'							, get_template_directory_uri().'/layout/js/scripts.js'										, array('jquery'),'1.0', true );    		
	
	}

	

	

#	Load Dynamic Javascript Variables in the header
#
	add_action('admin_head'										, 'ewf_load_JSVariables', 1);
	add_action('wp_head'										, 'ewf_load_JSVariables', 1); 

	function ewf_load_JSVariables(){
		echo '
		<script type="text/javascript">
			var ajaxURL = "'.site_url().'/wp-admin/admin-ajax.php";
			var siteURL = "'.site_url().'";
			var themePath = "'.get_template_directory_uri().'";
		</script>';
	}
	


	
#	Manage Widgets
#	

	include_once ('widgets/widget-navigation.php'				);
	include_once ('widgets/widget-contact-info.php'				);
	include_once ('widgets/widget-latest-posts.php'				);
	include_once ('widgets/widget-latest-tweets.php'			);
	include_once ('widgets/widget-contact-form.php'				);
	include_once ('widgets/widget-social-media.php'				);
	include_once ('widgets/widget-flickr.php'					);
	
	
	add_action( 'widgets_init'									, 'ewf_widgets_undergister' );
	add_action( 'widgets_init'									, 'ewf_widgets_register' );


	function ewf_widgets_undergister(){

	}
	
	
	function ewf_widgets_register(){ 
		
	}
	
		
	#	Affect archive widget structure
	add_filter('get_archives_link', 'ewf_archive_filter');
	
	function ewf_archive_filter($links) {
		$links = str_replace('</a>&nbsp;(', ' (', $links);
		$links = str_replace(')', ')</a>', $links);
		
		return $links;
	}
	
	

	add_filter('wp_list_categories','ewf_categories_filter');
		
	function ewf_categories_filter ($variable) {
		$variable = str_replace('</a> (', ' (', $variable);
		$variable = str_replace(')', ')</a>', $variable);
	   return $variable;
	}
	
	
	
	

?>