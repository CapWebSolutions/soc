<?php


	class ewf_widget_contact_forms extends WP_Widget {

		function ewf_widget_contact_forms() {
			$widget_ops = array( 'classname' => 'ewf_widget_contact_forms', 'description' => __('A widget that displays a contact form created with Contact Form 7', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_contact_forms' );
			$this->WP_Widget( 'ewf_widget_contact_forms', __('EWF - Contact Form 7', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		

		function widget( $args, $instance ) {
			extract( $args );
			global $post;





			$str_title 	= null;
			echo wp_kses_post($before_widget);

			
			$title =  apply_filters('widget_title', $instance['title'] );
			if ( $title ) {
				echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
			}
			
			
							
				
			$form_id = intval($instance['form_id']);
			if ($form_id){
				// $shortcode = '[contact-form-7 id="'.$form_id.'" title="Contact form 1"]';
				
				$shortcode = '[contact-form-7 id="'.$form_id.'"]';
				echo do_shortcode($shortcode);
			} 
		


			echo wp_kses_post($after_widget);
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
		#	Data Validation
		#
			$instance['title'] 		= sanitize_text_field( $new_instance['title'] );
			$instance['form_id'] 	= intval($new_instance['form_id']);

			return $instance;
		}
		 

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'form_id' => 0);
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			

			?>
			
				<div class="ewf-meta">
					<p>
						<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
						<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id( 'form_id' ); ?>"><?php _e('Contact Form:', EWF_SETUP_THEME_DOMAIN); ?></label>
						

						<select id="<?php echo $this->get_field_id( 'form_id' ); ?>" name="<?php echo $this->get_field_name( 'form_id' ); ?>" style="width:100%;">




						
						<?php



						
							$ewf_contact_forms = ewf_get_contactForms();
							
							foreach($ewf_contact_forms as $form_id => $form_title ){
								$form_title = esc_html( $form_title );
								$form_id 	= intval( $form_id );
							
								if ($instance['form_id'] == $form_id){
									echo '<option value="'.$form_id.'" selected="selected" >'.$form_title.'</option>';
								}else{
									echo '<option value="'.$form_id.'" >'.$form_title.'</option>';
								}
							}
							
						?>
						</select>

						
					</p>





				</div>
			
			<?php
		}
	}


	
	function ewf_get_contactForms(){
		include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below

		global $wpdb;
		$contact_forms = array();
		
		if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
		
			$post_type = 'wpcf7_contact_form';
			$query = $wpdb->prepare("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = %s", $post_type);
			$cf7 = $wpdb->get_results( $query );
			
			if ($cf7) {
				foreach ( $cf7 as $cform ) {
					$contact_forms[intval($cform->ID)] = esc_html($cform->post_title);
				}
			} else {
				$contact_forms[__("No contact forms found", EWF_SETUP_THEME_DOMAIN)] = 0;
			}
	
		}
		
		return $contact_forms;
	}

	
	register_widget( 'ewf_widget_contact_forms' );
	
	
?>