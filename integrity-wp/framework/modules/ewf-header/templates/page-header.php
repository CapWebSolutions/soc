<?php 	
	
	global $ewf_modHeader, $post;
	
	
	if (!function_exists('ewf_get_sidebar_id')){
		return false;
	}
	
	if (!is_object($ewf_modHeader)){
		return false;
	}
	
	$ewf_page_id 				= ewf_get_page_relatedID();
	
	if (is_404()){
		$ewf_page_id 			= get_option(EWF_SETUP_THNAME."_page_404", 0);
	}
	
	$ewf_modHeader_meta 		= $ewf_modHeader->get_postSettings($ewf_page_id);
	$ewf_modHeader_meta_page	= $ewf_modHeader_meta;
	$ewf_modHeader_debug 		= array();
	
	
	#	Get global settings
	#
	$ewf_modHeader_debug[] = '# Init';
	$ewf_modHeader_debug[] = '# Related ID:'.$ewf_page_id; //.' ['.$post->ID.']';
	
	
	if (!is_array($ewf_modHeader_meta)){
		
		//	In case of exit
		$ewf_modHeader_meta['debug'] = $ewf_modHeader_debug;
		ewf_debug($ewf_modHeader_meta);
		
		return false;
	}
	
	
	#	If page header is disabled
	#	
	if (empty($ewf_modHeader_meta['active']) ){
		$ewf_modHeader_debug[] = '# Header disabled!';
	
	
		//	In case of exit
		$ewf_modHeader_meta['debug'] = $ewf_modHeader_debug;
		ewf_debug($ewf_modHeader_meta);
		
		return false;
	}
	
	
	//$ewf_modHeader_meta['active'] === 0
	//$ewf_modHeader_debug[] = '# Header active:'.$ewf_modHeader_meta['active'];
	
	
	if (array_key_exists('master_use', $ewf_modHeader_meta) && $ewf_modHeader_meta['master_use']== 1 && $ewf_modHeader_meta['master_id'] > 0 ){
		$ewf_modHeader_meta 	= $ewf_modHeader->get_postSettings( $ewf_modHeader_meta['master_id'] );
		$ewf_modHeader_debug[] 	= '# Use Master';
	}

	
	
	#	In case we have an image added as page header
	#
	if ($ewf_modHeader_meta['image_id'] || $ewf_modHeader_meta['background_color']){
		
		$ewf_modHeader_class = null;
		$ewf_modHeader_BackgroundImage = null;
		$ewf_modHeader_BackgroundColor = null;
		$ewf_modHeader_BorderColor = null;
		$ewf_modHeader_FontColor = null;
		
		$ewf_modHeader_size = 'ewf-modHeader-img-large';
		
		$ewf_modHeader_debug[] = '# has image || background';
		
		if (current_theme_supports('ewf-modHeader-background-color')){
			if (array_key_exists('background_color', $ewf_modHeader_meta) && $ewf_modHeader_meta['background_color']){
				$ewf_modHeader_BackgroundColor = 'background-color:'.$ewf_modHeader_meta['background_color'].';';
			}
		}
		
		if ($ewf_modHeader_meta['image_id']){
			$ewf_modHeader_image = wp_get_attachment_image_src($ewf_modHeader_meta['image_id'], $ewf_modHeader_size);  
			$ewf_modHeader_BackgroundImage = 'background-image:url('.$ewf_modHeader_image[0].');background-repeat:no-repeat;background-position:top center;';
		}	
		
		
		if (current_theme_supports('ewf-modHeader-border-color')){
			if (array_key_exists('border_color', $ewf_modHeader_meta) && $ewf_modHeader_meta['border_color']){
				$ewf_modHeader_BorderColor = 'border-color:'.$ewf_modHeader_meta['border_color'].';';
			}
		}
		
		
		if (current_theme_supports('ewf-modHeader-font-color')){
			if (array_key_exists('font_color', $ewf_modHeader_meta) && $ewf_modHeader_meta['font_color']){
				$ewf_modHeader_FontColor = 'color:'.$ewf_modHeader_meta['font_color'].';';
			}
		}
		
		
		#	If parallax setting was activated on current page
		#
		if (current_theme_supports('ewf-modHeader-parallax')){
			if (array_key_exists('parallax', $ewf_modHeader_meta_page) && $ewf_modHeader_meta_page['parallax'] == 1){
				$ewf_modHeader_class = 'class="parallax" ';
				$ewf_modHeader_size = 'ewf-modHeader-img-parallax';
			}
		}
		
		
		if (array_key_exists('title', $ewf_modHeader_meta) && $ewf_modHeader_meta['title'] != null ){
			echo '<div id="page-header" '.$ewf_modHeader_class.'style="'.$ewf_modHeader_BackgroundImage.$ewf_modHeader_BackgroundColor.$ewf_modHeader_BorderColor.'">';
			
				// ewf_get_rgb
				$background_rgb_values = ewf_get_rgb($ewf_modHeader_meta['background_color']);
				echo '<div id="page-header-overlay" style="background-color:rgba('.$background_rgb_values[0].','.$background_rgb_values[1].','.$background_rgb_values[2].', .75);"></div>';
			
				echo '<div class="container">';
						echo '<div class="row">';
							echo '<div class="span12">';
								
								if(array_key_exists('icon', $ewf_modHeader_meta) && $ewf_modHeader_meta['icon']) {
									echo '<i class="'.$ewf_modHeader_meta['icon'].'"></i>';
								}
								if ( 'Posts' == $ewf_modHeader_meta['title'] ) $ewf_modHeader_meta['title'] = 'Events'; // Hack
								echo '<h3 style="'.$ewf_modHeader_FontColor.'">'.$ewf_modHeader_meta['title'].'</h3>'; 
								// echo '<p>'.$ewf_modHeader_meta['description'].'</p>'; 
								
							echo '</div>';
						echo '</div>';
				echo '</div><!-- end .container -->';
			
			echo '</div><!-- end #page-header -->';
		}
	}else{
		$ewf_modHeader_debug[] = '# No Image, background or border color';
		
		echo '<div id="no-page-header"></div>';
	}
	
	
	$ewf_modHeader_meta['debug'] = $ewf_modHeader_debug;
	ewf_debug($ewf_modHeader_meta);
		
?>