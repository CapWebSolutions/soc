<?php

    add_filter( 'vc_load_default_templates'			, 'ewf_composer_removeDefaultTemplates');
	// add_action( 'vc_load_default_templates_action'	, 'ewf_composer_loadTemplates');
	
	
	function ewf_composer_loadTemplates() {
		$data               	= array();
		$data['name']       	= __( 'EWF Template', EWF_SETUP_THEME_DOMAIN );
		$data['image_path'] 	= preg_replace( '/\s/', '%20',  get_template_directory_uri().'/framework/composer/includes/thumbnails/product_page.png');
		$data['custom_class'] 	= 'ewf_custom_template';
		$data['content']    	= '[vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_message color="alert-info" style="rounded"]I am message box. Click edit button to change this text.[/vc_message][/vc_column][/vc_row]CONTENT; ';
		
		vc_add_default_templates( $data );
	}
	
	
	function ewf_composer_removeDefaultTemplates($data) {
		return array(); 
	}

?>