<?php
	
	global $current_user;
	

	
	
	#	Get post classes
	#
	$post_class_array = get_post_class();
	$ewf_post_class = null;
	
	foreach($post_class_array as $key=> $class_item){
		$ewf_post_class.= ' '.$class_item;
	}
	
	
	
	# 	Get post categories
	#
	$ewf_post_tags = get_the_tags();
	
	
	
	# 	Get post categories
	#
	$ewf_post_categories = null;
	
	foreach((get_the_category( $post->ID )) as $category) { 
		if ($ewf_post_categories == null){
			$ewf_post_categories.= '<a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
			// break;
		}else{
			$ewf_post_categories.= ', <a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
		}
	}
	
	
	#	Get default time / date format
	#
	$ewf_post_date_format = get_the_date();
	$ewf_post_time_format = get_the_time();
		
	
	# Get post featured image
	#
	$ewf_image_id = get_post_thumbnail_id($post->ID);  
	
	$ewf_image_url = wp_get_attachment_image_src($ewf_image_id,'blog-featured'); 
	$ewf_image_url = $ewf_image_url[0];
	
	
	
	
	# Conditional preloading
	#
	
	$single_post = is_single();
	
	
	$ewf_user_name = get_the_author_meta('display_name', $post->post_author);
	
	if ($single_post){
		$ewf_post_class .= ' alt';
	}
	
	
	echo  '<div class="blog-post '.$ewf_post_class.'">';
	
		# Post fetured image
		#
		if ($ewf_image_id){
			if (!$single_post){
			
				// echo  '<div class="blog-post-thumb">';
					//if ($ewf_image_id){
					//	echo  '<img src="'.$ewf_image_url.'" alt="" />';
					//}
				//echo  '</div><!-- end .blog-post-thumb -->';
			
				echo '<div class="blog-post-info">';
					echo get_the_date('d') . '<small>'.get_the_date('M').'</small>';
				echo '</div><!-- end .blog-post-info -->';
			}
		}
		
		
		if ($single_post){
		
			echo '<div class="blog-post-info">';
				echo get_the_date('d') . '<small>'.get_the_date('M').'</small>';
			echo '</div><!-- end .blog-post-info -->';
			
			echo '<div class="blog-post-title">';
				echo  '<h4><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h4>' ;
						 
				echo '<p><em>' .
						__('by', EWF_SETUP_THEME_DOMAIN) . ' ' . $ewf_user_name . ' ' .
						__('in', EWF_SETUP_THEME_DOMAIN) . ' ' . $ewf_post_categories .
					'</em></p>';
			echo '</div><!-- end .blog-post-title -->';
			
		}
			
		if (!$single_post){
			echo '<div class="blog-post-title" style="margin: 30px 0 25px 70px;">';
			echo  '<h4><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h4>' ;
					 
			echo '<p><em>' .
					__('by', EWF_SETUP_THEME_DOMAIN) . ' ' . $ewf_user_name . ' ' .
					__('in', EWF_SETUP_THEME_DOMAIN) . ' ' . $ewf_post_categories .
				'</em></p>';
			
			// <span>'.get_comments_number().'</span>
			// <a href="'.get_permalink().'#comments">'.__('comments', EWF_SETUP_THEME_DOMAIN).'</a>
				
			echo '</div><!-- end .blog-post-title -->';

			

			global $more;
			$more = false; 
			// echo  '<p>'.do_shortcode(get_the_content('&nbsp;')).'</p>';   
			echo  '<p>'.do_shortcode(the_excerpt()).'</p>';   
			$more = true;
		}

		

		if ($single_post){
			
			the_content();

			if ($ewf_post_tags){
				echo '<div class="tags">'.the_tags( '<strong>'.__('Tags', EWF_SETUP_THEME_DOMAIN).'</strong>: ', ', ').'</div>';
			}
			
		}
		
		if (!$single_post){
			echo '<a class="btn" href="' . get_permalink() . '">'.__('Read more', EWF_SETUP_THEME_DOMAIN).'</a>';
		}
	
		
	echo  '</div> <!-- .blog-post -->'; 
	
	
	if ($single_post){
		comments_template( '', true );
	}
	
?>