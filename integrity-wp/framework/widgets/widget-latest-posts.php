<?php 



	class ewf_widget_latest_posts extends WP_Widget {

		function ewf_widget_latest_posts() {
			$widget_ops = array( 'classname' => 'ewf_widget_latest_posts', 'description' => __('A widget that displays popular posts from blog', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_latest_posts' );
			$this->WP_Widget( 'ewf_widget_latest_posts', __('EWF - Latest Posts', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		


		function widget( $args, $instance ) {
			extract( $args );
			global $post;

		#	Data Validation
		#
			$items 	= 3 ; 
			if (intval( $instance['items'] ) > 0){
				$items = intval( $instance['items'] );
			}
			
			echo wp_kses_post($before_widget);

			$title 	= esc_html( apply_filters('widget_title', $instance['title'] ));
			if ( $title ) 
				echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
			
			$sticky_posts = get_option('sticky_posts');
			
			$args = array( 'showposts' => $items, 'post__not_in' => get_option('sticky_posts'), 'ignore_sticky_posts'=>1);
			$popular_posts = new WP_Query($args);
			
			$posts_count = 0;
			$extra_class = null;
			
			echo '<ul>';
				 while ($popular_posts->have_posts()) : $popular_posts->the_post();
					global $post;
					$posts_count++;
					
					# 	Get post categories
					#
					$ewf_post_categories = null;
					
					foreach((get_the_category( $post->ID )) as $category) { 
						if ($ewf_post_categories == null){
							$ewf_post_categories.= '<a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
							break;
						}
					}
					
					
					# Get post featured image
					#
					$ewf_image_id = get_post_thumbnail_id($post->ID);  
					$ewf_image_url = wp_get_attachment_image_src($ewf_image_id,'thumbnail'); 
					
					
					// if ($posts_count == 1){
						// $extra_class = 'first'; 
					// }elseif($posts_count == $items){
						// $extra_class = 'last'; 
					// }else{ 
						// $extra_class = null;
					// }
					
					// echo'<li class="'.$extra_class.'">';
					if ($ewf_image_id){
						echo'<li>';
							echo '<img src="'.$ewf_image_url[0].'" width="70" alt="" >';
					}else{
						echo'<li class="no-image">';
					}

						
						echo '<p>';
							echo '<a href="'. get_permalink($post->ID) .'">'.$post->post_title.'</a><br/>';
							echo '<small>'.__('by', EWF_SETUP_THEME_DOMAIN).' <a href="#"><strong>'.get_the_author().'</strong></a> '.__('on', EWF_SETUP_THEME_DOMAIN).' '.get_the_date().' </small>';
						echo '</p>';
									
					echo '</li>'; 
					
				endwhile;
			echo '</ul>';
			
			
			echo wp_kses_post($after_widget);
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
		#	Data Validation
		#
			$instance['title'] 	= sanitize_text_field( $new_instance['title'] );
			$instance['items'] 	= intval( $new_instance['items'] );

			return $instance;
		}
		

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'items' => 2);
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			
			?>
			<div class="ewf-meta">
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e('How many post to show:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<select id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" style="width:100%;">
					<?php
					
						$instance['items'] 	= intval( $instance['items'] );
						
						for($i = 1; $i <= 5; $i++){
							
							if ($i == $instance['items']){
								echo '<option  selected="selected">'.$i.'</option>';
							}else{
								echo '<option>'.$i.'</option>';
							}
						}

					?>
					</select>
				</p>
			</div>
 
		<?php
		}
	}

	
	register_widget( 'ewf_widget_latest_posts');

	
?>