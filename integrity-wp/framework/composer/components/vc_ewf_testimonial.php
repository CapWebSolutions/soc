<?php

	add_shortcode( 'ewf-testimonial', 'ewf_vc_testimonial' );
	
	
	function ewf_vc_testimonial( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'image_id' => 0,
		  'image_url' => null,
		  'name' => __("Sample Name", EWF_SETUP_THEME_DOMAIN),
		  'description' => __("Client", EWF_SETUP_THEME_DOMAIN),
		  'style' => 'ewf-testimonial-style-1',
		  'css' => null
	   ), $atts ) );
	   
	   $class_extra = null;
	   
		if ($image_id){
			$image_url = wp_get_attachment_image_src($image_id, 'thumbnail'); 
			$image_url = $image_url[0]; 
		}else{
			$class_extra = 'class="no-image"';
		}
	   
	   
		ob_start();
		

		
		switch($style) {
			
			case "ewf-testimonial-style-1":
				echo '<div class="testimonial fixed '.$css.'">';
				
					if ($image_id){
						echo '<span>';
							echo '<img width="140" height="140" src="'.$image_url.'" />';
						echo '</span>';
					}
										  
					echo '<blockquote '.$class_extra.'>'; 		
						echo '<h4>' . $content . '</h4>';
					echo '</blockquote>';				
					
					
					echo '<h4>'.$name.'</h4>';
					if ($description){
						echo '<h6>'.$description.'</h6>';
					}
					
				echo '</div><!-- end .testimonial -->';
				break;
			
			
			case "ewf-testimonial-style-2":
				echo '<div class="testimonial alt fixed '.$css.'">';
				
					if ($image_id){
						echo '<span>';
							echo '<img width="140" height="140" src="'.$image_url.'" />';
						echo '</span>';
					}
				
					echo '<h4>'.$name.'</h4>';
					if ($description){
						echo '<h6>'.$description.'</h6>';
					}
						  
					echo '<blockquote '.$class_extra.'>'; 		
						echo '<h4>' . $content . '</h4>';
					echo '</blockquote>';				
				echo '</div><!-- end .testimonial -->';
				break;
				
			
			case "ewf-testimonial-style-3":
				echo '<div class="testimonial-2 '.$css.'">';
				
					echo '<blockquote '.$class_extra.'>'; 		
						echo '<p>' . $content . '</p>';
					echo '</blockquote>';	
					
					if ($image_id){
						echo '<span>';
							echo '<img width="70" height="70" src="'.$image_url.'" />';
						echo '</span>';
					}
				
					echo '<h5>'.$name.'</h5>';
					if ($description){
						echo '<h6>'.$description.'</h6>';
					}
						  
			
				echo '</div><!-- end .testimonial -->';
				break;
				
				
			case "ewf-testimonial-style-4":
				echo '<div class="testimonial-3 '.$css.'">';
					
					if ($image_id){
						echo '<span>';
							echo '<img width="70" height="70" src="'.$image_url.'" />';
						echo '</span>';
					}
					
					echo '<h4>'.$name.'</h4>';
					if ($description){
						echo '<h6>'.$description.'</h6>';
					}
					
					echo '<blockquote '.$class_extra.'>'; 		
						echo '<p>' . $content . '</p>';
					echo '</blockquote>';	
							
				echo '</div><!-- end .testimonial -->';
				break;
			
		}
		
		
		
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Testimonial", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-testimonial",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-testimonial",
	   "description" => __("Add a quote, image and description", EWF_SETUP_THEME_DOMAIN),  
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
			array(
				"type" => "ewf-image-select",
				"holder" => "div",
				"class" => "",
				"heading" => __("Testimonial Style", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "style",
				"options" => array(
					'Style 1' => 'ewf-testimonial-style-1', 
					'Style 2' => 'ewf-testimonial-style-2', 
					'Style 3' => 'ewf-testimonial-style-3', 
					'Style 4' => 'ewf-testimonial-style-4', 
				),
				"value" => 'ewf-testimonial-style-1',
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => __("Image", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "image_id",
				"description" => __("Add an image to the right side of the testimonial", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Name", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "name",
				"value" => __("Sample Name", EWF_SETUP_THEME_DOMAIN),
				"description" => __("Specify the the name of the testimonial author", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Description", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "description",
				"value" => __("Description", EWF_SETUP_THEME_DOMAIN),
				"description" => __("Specify a description of the author", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Testimonial", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "content",
				"value" => null,
				"description" => __("Specify the text of the testimonial", EWF_SETUP_THEME_DOMAIN)
			)
	   )
	));


?>