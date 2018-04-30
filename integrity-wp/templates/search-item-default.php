<?php

	
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
		}else{
			$ewf_post_categories.= ', <a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
		}
	}
	
	
	#	Get default time / date format
	#
	$ewf_post_date_format = date(get_option( 'date_format' ));
	$ewf_post_time_format = get_option( 'time_format' );
		
	
	# Get post featured image
	#
	$ewf_image_id = get_post_thumbnail_id($post->ID);  
	
	$ewf_image_url = wp_get_attachment_image_src($ewf_image_id,'blog-featured-large'); 
	$ewf_image_url = $ewf_image_url[0];
	
	
	
	# Conditional preloading
	#	
	
	echo  '<div class="search-post '.$ewf_post_class.'">';	
	
		# Post title
		#
		echo  '<h3><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h3>' ;

		echo '<a class="btn" href="' . get_permalink() . '">'.__('Read more', EWF_SETUP_THEME_DOMAIN).'</a>';
				
		echo '<div class="hr" ></div>';
	
	echo  '</div> <!-- .blog-post -->'; 
	
?>