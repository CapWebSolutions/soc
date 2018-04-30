<?php

#	Functions:
#	
#	ewf_message ($message)
#	ewf_debug_log ($debug, $message)
#


	if ( ! isset( $content_width ) ) $content_width = 940;


#
#	Add and ID column to pages & taxonomy
#	
#	add_theme_support('ewf-editor-columnID');
#

	if (current_theme_supports('ewf-editor-columnID')){
				
			add_action('admin_init'		, 'ewf_add_id_column');

			function ewf_add_id_column() {
				add_action('admin_head', 'ewf_add_id_column_css');

				add_filter('manage_posts_columns', 'ewf_add_id_column_source');
				add_action('manage_posts_custom_column', 'ewf_add_id_column_value', 10, 2);

				add_filter('manage_pages_columns', 'ewf_add_id_column_source');
				add_action('manage_pages_custom_column', 'ewf_add_id_column_value', 10, 2);

				foreach ( get_taxonomies() as $taxonomy ) {
					add_action("manage_edit-${taxonomy}_columns", 'ewf_add_id_column_source');			
					add_filter("manage_${taxonomy}_custom_column", 'ewf_add_id_column_value_return', 10, 3);
				}
			}
			
			function ewf_add_id_column_source($cols) {
				$cols['item-id'] = '<span>ID</span>'; 
				return $cols;
			} 

			function ewf_add_id_column_value($column_name, $id) { 
				if ($column_name == 'item-id') echo intval($id);
			}

			function ewf_add_id_column_value_return($value, $column_name, $id) {
				if ($column_name == 'item-id') $value = $id;
				return $value;
			}

			function ewf_add_id_column_css() {
				echo ' <style type="text/css"> #item-id { width: 50px; }</style>';
			}

	}

	

	
	#	Output messages in the theme
	#
	function ewf_message($msg, $reference = null){
		return '<div class="alert error">'.$msg.'</div>';
	}
		
	
	
	#	Detect if this is a blank page template
	#	
	function ewf_is_page_blank(){
		global $post;
		
		$page_blank = false;
		
		# Debug
		# echo '<br/>Empty:'.!empty($post).' - Single:'.is_singular();
		
		if (!empty($post) && is_singular()){
			$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
			
			if ($page_template == 'page-blank.php') {
				return true;
			}
		}

		return $page_blank;
	}
	


	#	Get Attachment details
	#
	function ewf_get_attachment( $attachment_id ) {

		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}
	

	
	
#	
#	Used for debugging purpose	
#
	function ewf_debug_log($debug, $message){ 
		#
		# ewf_message($message);
		#
		apply_filters($debug, $message);
	}
	
	
	

	
	function ewf_load_socialProfiles(){
		$profiles = array();
		
		$profiles[] = array( 'class' => 'facebook'		, 'url' => get_option(EWF_SETUP_THNAME."_social_facebook"	, null ));
		$profiles[] = array( 'class' => 'twitter'		, 'url' => get_option(EWF_SETUP_THNAME."_social_twitter"	, null ));
		$profiles[] = array( 'class' => 'google-plus'	, 'url' => get_option(EWF_SETUP_THNAME."_social_plus"		, null ));
		$profiles[] = array( 'class' => 'pinterest'		, 'url' => get_option(EWF_SETUP_THNAME."_social_pinterest"	, null ));
		$profiles[] = array( 'class' => 'instagram'		, 'url' => get_option(EWF_SETUP_THNAME."_social_instagram"	, null ));	
		$profiles[] = array( 'class' => 'tumblr'		, 'url' => get_option(EWF_SETUP_THNAME."_social_tumblr"		, null ));	
		$profiles[] = array( 'class' => 'youtube'		, 'url' => get_option(EWF_SETUP_THNAME."_social_youtube"	, null ));	
		$profiles[] = array( 'class' => 'flickr'		, 'url' => get_option(EWF_SETUP_THNAME."_social_flickr"		, null ));	
		$profiles[] = array( 'class' => 'linkedin'		, 'url' => get_option(EWF_SETUP_THNAME."_social_linkedin"	, null ));	
		
		
		foreach($profiles as $key=>$value){
			if ($value['url'] == null){
				unset($profiles[$key]);
			}
		}
		
		
		#	if (count($profiles) > 1){
		#		$profiles[count($profiles)-1]['class'] = $profiles[count($profiles)-1]['class'].' last';
		#	}elseif(count($profiles) == 1){
		#		$profiles[count($profiles)-1]['class'] = $profiles[count($profiles)-1]['class'].' last';
		#	}
		
		
		return $profiles;
	}
		
		
	function ewf_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo wp_kses_post(mb_substr( $subex, 0, $excut ));
			} else {
				echo wp_kses_post($subex);
			}
			echo '...';
		} else {
			echo wp_kses_post($excerpt);
		}
	}
	
	
	
#	Add debug on/off to admin toolbar
#
	add_action( 'wp_before_admin_bar_render', 'ewf_admin_bar_debug');

	function ewf_admin_bar_debug() {
		global $wp_admin_bar;
		
		if(is_admin() && get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
		
			$parent = 'EWF_DEBUG';
			$debug_url = null;
			$debug_state = null;
			
			if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
				$debug_url = '?ewf-debug-off';
				// $debug_state = 'OFF';
			}else{
				$debug_url = '?ewf-debug';
				// $debug_state = 'ON';
			}
			
			$wp_admin_bar->add_menu( array(
				'parent' => false,
				'id' => $parent,
				'title' =>  'Debug'.$debug_state,
				'href'  => admin_url($debug_url),
				'meta'  => array(
				'title' => 'debug',
					)
			));

		}

	}
	
	
	function ewf_debug($page_data){
	
		//	Debug info
		//
		if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true' && is_user_logged_in()){
			echo '<pre class="ewf-debug-message">';
				print_r($page_data);
			echo '</pre>';
		}
		
	}
	
	
	function ewf_debugging_mode_notices() {
		//
		// For resolving customer support on site without actually making changes to the theme enable ewf-debug and show some basic information about the setup itself
		//
		
		if (array_key_exists('ewf-debug', $_REQUEST)){
			update_option(EWF_SETUP_THNAME."_debug_mode", 'true');
		}
		
		if (array_key_exists('ewf-debug-off', $_REQUEST)){
			update_option(EWF_SETUP_THNAME."_debug_mode", 'false');
		}


		if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
			echo '<div class="updated">';
				echo "<p><strong>EWF Debug mode is active</strong> - you can see debug information on the frontend while you're navigating the website</p>";
			echo '</div>';
		}
		
	}
	
	add_action( 'admin_notices', 'ewf_debugging_mode_notices' );
	
	
	

	
	
		
#		
#	Manage the wp title in a better manner
#
#
#	function ewf_wp_title( $title, $sep ) {
#		global $paged, $page;
#
#		if ( is_feed() ){
#			return $title;
#		}				
#
#
#		$title .= get_bloginfo( 'name' );
#		$site_description = get_bloginfo( 'description', 'display' );
#	 
#		if ( $site_description && ( is_home() || is_front_page() ) ) {
#			$title = "$title $sep $site_description";
#		}
#	 
#		if ( $paged >= 2 || $page >= 2 ) {
#			$title = sprintf( __( 'Page %s', EWF_SETUP_THEME_DOMAIN ), max( $paged, $page ) ) . " $sep $title";
#		}
#			
#		return $title;
#	}
#	
#	add_filter( 'wp_title', 'ewf_wp_title', 10, 2 );



#
#	Add backward compatiblity for wordpress title
#
#
#	if ( ! function_exists( '_wp_render_title_tag' ) ) {
#    	function theme_slug_render_title() {
#			echo '<title>';
#				wp_title( '|', true, 'right' );
#			echo '<title>';
#   	}
#  		add_action( 'wp_head', 'theme_slug_render_title' );
#	}
	

	
	
#	Remove Revolution slider update notice
#
#
#	if(function_exists( 'set_revslider_as_theme' )){
#		add_action( 'init', 'ewf_revslider_remove_notices' );
#
#		function ewf_revslider_remove_notices() {
#			set_revslider_as_theme(); 
#		}
#	}
	
	
	
	

#	Check if composer is active on a page content
#
	function ewf_isComposerActive($content){
		return (count(explode('[/vc_row]', $content))-1);
	}
	

#	Check if composer is active on a page content
#
	function ewf_get_rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	
	   return $rgb; // returns an array with the rgb values
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/*
	if (!function_exists('is_post_type')){
	
		function is_post_type($type = null){
			global $post;
			
			if (get_post_type($post) == strtolower($type)){
				return true;
			}else{
				return false;
			}
		}
	}
	*/
	
	
	/*
	function efw_get_content_formatted ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	
		$content = get_the_content($more_link_text, $stripteaser, $more_file);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content); 
		
		return $content;
	}
	*/

?>