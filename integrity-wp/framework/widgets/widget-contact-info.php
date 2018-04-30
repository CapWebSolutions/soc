<?php


	class ewf_widget_contact_info extends WP_Widget {

		function ewf_widget_contact_info() {
			$widget_ops = array( 'classname' => 'ewf_widget_contact_info', 'description' => __('A widget that displays brochure item', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_contact_info' );
			$this->WP_Widget( 'ewf_widget_contact_info', __('EWF - Contact Info', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		


		function widget( $args, $instance ) {
			extract( $args );
			global $post;

			echo wp_kses_post($before_widget);

			$title = esc_html( apply_filters('widget_title', $instance['title']) );
			if ( $title ){
				echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
			}
			
			
			echo '<ul>';
				
				$address = esc_html($instance['address']);
				if ($address){
					echo '<li><span><i class="ifc-home"></i></span>'.$address.'</li>';
				}	
				
				$phone = esc_html( $instance['phone'] );
				if ($phone){
					echo '<li><span><i class="ifc-phone2"></i></span>'.$phone.'</li>';
				}
				
				$email = esc_html( $instance['email'] );
				if ($email){
					echo '<li><span><i class="ifc-message"></i></span><a href="mailto:'.$email.'">'.$email.'</a></li>';
				}
				
			echo '</ul>';
			
			echo wp_kses_post($after_widget);
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;


		#	Data Validation
		#
			$instance['title'] 		= sanitize_text_field($new_instance['title']);
			$instance['address'] 	= sanitize_text_field($new_instance['address']);
			$instance['email'] 		= sanitize_email($new_instance['email']);
			$instance['phone'] 		= sanitize_text_field($new_instance['phone']);

			return $instance;
		}
		 

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'address' => null, 'email' => null, 'phone' => null);
			$instance = wp_parse_args( (array) $instance, $defaults ); 

			?>
			
				<div class="ewf-meta">
					<p>
						<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
						<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html($instance['title']); ?>" style="width:100%;" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Address:', EWF_SETUP_THEME_DOMAIN); ?></label>
						<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo esc_html($instance['address']); ?>" style="width:100%;" />
					</p>
					
					<p>
						<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Phone:', EWF_SETUP_THEME_DOMAIN); ?></label>
						<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo esc_html($instance['phone']); ?>" style="width:100%;" />
					</p>
					
					<p>
						<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('E-mail:', EWF_SETUP_THEME_DOMAIN); ?></label>
						<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_html($instance['email']); ?>" style="width:100%;" />
					</p>
				</div>
			
			<?php
		}
	}


	register_widget( 'ewf_widget_contact_info' 	);


?>