<?php 



	class ewf_widget_calltoaction extends WP_Widget {

		function ewf_widget_calltoaction() {
			$widget_ops = array( 'classname' => 'ewf_widget_calltoaction', 'description' => __('Call to action', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_calltoaction' );
			$this->WP_Widget( 'ewf_widget_calltoaction', __('EWF - Call to action', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		


		function widget( $args, $instance ) {
			extract( $args );
			global $post;

		#	Data Validation
		#		
			$heading 		=  esc_html( $instance['heading'] );
			$description 	=  esc_html( $instance['description'] );
			$button_title 	=  esc_html( $instance['button-title'] );
			$button_link 	=  esc_url( $instance['button-link'] );

			echo $before_widget;

			echo '
			<div class="ewf-row">
				<div class="ewf-span9">';
			
				if ($heading){
					echo '<h3 class="text-uppercase">'.$heading.'</h3>';
				}
				
				if ($description){
					echo '<p class="last">'.$description.'</h3>';
				}

			echo '</div>
				<div class="ewf-span3 text-right">
					<a href="'.$button_link.'" class="btn btn-large text-uppercase">'.$button_title.'</a>
				</div>
			</div>';
			
			echo $after_widget;
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
		#	Data Validation
		#
			$instance['heading'] 		= sanitize_text_field($new_instance['heading']);
			$instance['description'] 	= sanitize_text_field($new_instance['description']);
			$instance['button-link'] 	= esc_url( $new_instance['button-link'] );
			$instance['button-title'] 	= sanitize_text_field($new_instance['button-title']);

			return $instance;
		}
		

		function form( $instance ) {
			$defaults = array( 'title' => null, 'button-title' => __('Sample title' , EWF_SETUP_THEME_DOMAIN), 'button-link' => '#', 'description' => null, 'heading' => null);
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			
		#	Data Validation
		#		
			$instance['heading'] 		= esc_html($instance['heading']);
			$instance['description'] 	= esc_html($instance['description']);
			$instance['button-link'] 	= esc_url( $instance['button-link'] );
			$instance['button-title'] 	= esc_html($instance['button-title']);
			
			?>
			
			<div class="ewf-meta">
			
				<p>
					<label for="<?php echo $this->get_field_id( 'heading' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" value="<?php echo $instance['heading']; ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'button-title' ); ?>"><?php _e('Button title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'button-title' ); ?>" name="<?php echo $this->get_field_name( 'button-title' ); ?>" value="<?php echo $instance['button-title']; ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'button-link' ); ?>"><?php _e('Button link:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'button-link' ); ?>" name="<?php echo $this->get_field_name( 'button-link' ); ?>" value="<?php echo $instance['button-link']; ?>" style="width:100%;" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Description:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo $instance['description']; ?>" style="width:100%;" />
				</p>
			
			</div>
			
		<?php
		}
	}

	
	register_widget( 'ewf_widget_calltoaction' 	);

?>