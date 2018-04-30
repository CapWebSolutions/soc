<?php

	add_shortcode( 'ewf-service', 'ewf_vc_service' );
	
	
	function ewf_vc_service( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'title' 		=> __('Sample title', EWF_SETUP_THEME_DOMAIN),
		  'image_id' 		=> 0,
		  'image_url' 		=> '#',
		  'link' 			=> '#',
		  'css' 			=> null
	   ), $atts ) );
	   
	   $link = vc_build_link($link); 
	   $class_extra = ' '.$css;
	   
		if ($image_id){
			$image_url = wp_get_attachment_image_src($image_id, 'large'); 
			$image_url = $image_url[0]; 
		}
	   
		ob_start();
		
		echo '<div class="service-box'.$class_extra.'">';				
				
				echo '<div class="service-box-thumb">';

					if ($image_id){
						echo '<img src="'.$image_url.'" alt="'.$image_id.'" />';
					}
				
				echo '</div><!-- end .service-box-thumb -->';
				
				
				if ($title){
					echo '<h2><strong><a href="#">'.$title.'</a></strong></h2>';
				}
							
				if ($content){
					echo '<p>'.$content.'</p>';
				}
				
				if ($link['title'] != ''){
					echo '<a class="btn btn-white" href="'.$link['url'].'">'.$link['title'].'</a>';
				}
            
        echo '</div><!-- end .service-box -->';
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Service", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-service",
	   "class" => "",
	   "category" => EWF_SETUP_VC_GROUP,
	   "icon" => "icon-wpb-ewf-service",
	   "description" => __("Name, image and description", EWF_SETUP_THEME_DOMAIN),  
	   "params" => array(
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "image_id",
			 "description" => __("Add the image of the service", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => __('Sample Title', EWF_SETUP_THEME_DOMAIN),
			 "description" => __("Specify the name of the service", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Details", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "content",
			 "value" => null,
			 "description" => __("The content of the service", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "vc_link",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Read more link", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "link",
			 "value" => '#',
			 "description" => __("Specify an optional link to another page", EWF_SETUP_THEME_DOMAIN) 
		  ),
	   )
	));


?>