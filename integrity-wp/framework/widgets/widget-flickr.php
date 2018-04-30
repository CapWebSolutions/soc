<?php 



	class ewf_widget_flickr extends WP_Widget {

		function ewf_widget_flickr() {
			$widget_ops = array( 'classname' => 'ewf_widget_flickr', 'description' => __('A widget that displays brochure item', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_flickr' );
			$this->WP_Widget( 'ewf_widget_flickr', __('EWF - Flickr', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		


		function widget( $args, $instance ) {
			extract( $args );
			global $post;
			
			echo wp_kses_post($before_widget);
			
			$title =  apply_filters('widget_title', $instance['title'] );
			if ( $title ) {
				echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
			}
			
			
			$gallery_items 	= intval( $instance['gallery_items'] );
			if ($gallery_items <= 0 ){ $gallery_items = 9; }
			
			
			if (esc_html( $instance['gallery_id'] )){
				echo '<div class="flickr-feed fixed">';
					echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$gallery_items.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.esc_html( $instance['gallery_id'] ).'"></script>';
				echo '</div>';
			}
			
			echo wp_kses_post($after_widget);
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
		#	Data Validation
		#
			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
			$instance['gallery_id'] 	= sanitize_text_field( $new_instance['gallery_id'] );
			$instance['gallery_items'] 	= intval( $new_instance['gallery_items'] );

			return $instance;
		}
		

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'gallery_items' => 9, 'gallery_id' => null );
			$instance = wp_parse_args( (array) $instance, $defaults ); 
						
			?>
			
			<div class="ewf-meta">
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html($instance['title']); ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'gallery_id' ); ?>"><?php _e('Gallery or User ID:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'gallery_id' ); ?>" name="<?php echo $this->get_field_name( 'gallery_id' ); ?>" value="<?php echo esc_html($instance['gallery_id']); ?>" style="width:100%;" />
				</p>
				<p><?php echo __("You can find the <strong>Flickr ID</strong> on", EWF_SETUP_THEME_DOMAIN);  ?> <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a></p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'gallery_items' ); ?>"><?php _e('Number of items:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'gallery_items' ); ?>" name="<?php echo $this->get_field_name( 'gallery_items' ); ?>" value="<?php echo intval($instance['gallery_items']); ?>" style="width:100%;" />
				</p>
				
			</div>
 
		<?php
		}
	}

	register_widget( 'ewf_widget_flickr' );
?>