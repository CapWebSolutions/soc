<?php

	add_action('admin_menu', 'ewf_project_metaRegister');
	add_action('save_post', 'ewf_project_metaUpdate');
	
	
	function ewf_project_metaRegister() {
		if (array_key_exists('post', $_GET) || array_key_exists('post', $_GET)){
			$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ; 
		  
			add_meta_box( 'ewf-project-meta', __('Project details', EWF_SETUP_THEME_DOMAIN), 'ewf_project_metaSource', EWF_PROJECTS_SLUG, 'normal', 'high' );

		}
	}
		
		
	function ewf_project_metaSource() {
		global $post;
		
		$project_meta = get_post_custom($post->ID);
		$project_client = null;
		$project_website = null;
		
		
		if (array_key_exists('_ewf-project-website', $project_meta)){
			$project_website = $project_meta["_ewf-project-website"][0];
			}
		
		if (array_key_exists('_ewf-project-client', $project_meta)){			
			$project_client = $project_meta["_ewf-project-client"][0];
			}
			
		
		echo '
		<div class="ewf-meta"> 
			<p>
				<label>'.__('Client:', EWF_SETUP_THEME_DOMAIN).'</label><input name="_ewf-project-client" value="'.$project_client.'" />
			</p>
			<p>
				<label>'.__('Website:', EWF_SETUP_THEME_DOMAIN).'</label><input name="_ewf-project-website" value="'.$project_website.'" />
			</p>
		</div>';
	}

	
	function ewf_project_metaUpdate() {
		global $post;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post->ID;
		}
		
		if (is_object($post)){
			$project_meta = get_post_custom($post->ID);
			
			if (array_key_exists('_ewf-project-website', $_POST)){
				update_post_meta($post->ID, "_ewf-project-website"	, $_POST["_ewf-project-website"]);
				update_post_meta($post->ID, "_ewf-project-client"	, $_POST["_ewf-project-client"]);
			}
		}
	}


?>