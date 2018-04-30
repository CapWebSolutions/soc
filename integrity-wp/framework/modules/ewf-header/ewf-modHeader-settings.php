<?php
/*	
 *	EWF - Mod Header
 *	Package: Eazyee Wordpress Framework
 *	ver: 1.4
 *	upd: 24 Feb 2015
 *
 */
 
#	Header settings
#	
	$modHeader_settings = array(
			'support' 	=> array( 'page', EWF_PROJECTS_SLUG ),
			'defaults'	=> array(
				'active' => '*', 
				'image_id' => null, 
				'image_url' => null, 
				'title' => null, 
				'icon' => null, 
				'title_src' => 'mh-type-page-header-title', 
				'description' => null, 
				'description_src' => null, 
				'background_color' => '#002138', 
				'border_color' => '#ffffff', 
				'font_color' => '#ffffff', 
				'parallax' => 0, 
				'master_id' => 0, 
				'master_use' => 0
			)
		);
		
	 
	
#	Theme support
#	
	add_theme_support('ewf-modHeader-image');					#	Add image support
	
	add_theme_support('ewf-modHeader-background-color');		#	Add background color support
	add_theme_support('ewf-modHeader-font-color');				#	Add font color support
	
	add_theme_support('ewf-modHeader-master');					#	Add background color support
	
	// add_theme_support('ewf-modHeader-border-color');			#	Add background color support
	// add_theme_support('ewf-modHeader-description');			#	Add a header description
	// add_theme_support('ewf-modHeader-templates');			#	Add templates support
	// add_theme_support('ewf-modHeader-parallax');				#	Add a parallax effect to header image, it requires an image having 685px height
	// add_theme_support('ewf-modHeader-icon');					#	Add icon support
	



?>