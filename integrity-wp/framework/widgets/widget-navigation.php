<?php 



	class ewf_widget_navigation extends WP_Widget {

		function ewf_widget_navigation() {
			$widget_ops = array( 'classname' => 'ewf_widget_navigation', 'description' => __('A widget that displays sub pages navigation', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_navigation' );
			$this->WP_Widget( 'ewf_widget_navigation', __('EWF - Navigation', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		 

		function widget( $args, $instance ) {
			extract( $args );
			global $post;

			
			echo wp_kses_post($before_widget);

			$title = esc_html( apply_filters('widget_title', $instance['title'] ));
			if ( $title ){
				echo wp_kses_post($before_title) . esc_html($title) . wp_kses_post($after_title);
			}
				
				
				$page_nav_obj = get_page_by_title( esc_html( $instance['nav-page'] ) );
				$page_nav_id = 0;
				$parent = false; 
			
				if (is_object($page_nav_obj)) $page_nav_id = $page_nav_obj->ID;
				if (esc_html( $instance['show-parent'] ) == 'on') $parent = true;
				
				$order = 'ASC';
				$current_url = strtolower($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
				
				$parent_page = get_post($page_nav_id); 
				$parent_title = $parent_page->post_title;
				$parent_permalink = get_permalink($parent_page->ID);
				$parent_url = str_replace(array('http://', 'https://'),'',strtolower($parent_permalink));  
				
				if ($page_nav_id){
					$opt = 'child_limit=10&';
					echo '<ul>';
					
					$wp_query_childs =  new WP_Query(array( 'post_type' => 'page', 'post_parent'=>$page_nav_id, 'order'=> 'ASC', 'orderby'=>'date', 'posts_per_page' => -1 ));
					
					if ($order == 'ASC' && $parent == true ){
						if ($current_url==$parent_url){ $extra = "class='current' "; }else{ $extra = null; }				
						echo '<li '.$extra.'><a href="'.$parent_permalink.'">'.$parent_title.'</a></li>';
					} 
					
					while ($wp_query_childs->have_posts()) : $wp_query_childs->the_post();
						$item_url = str_replace(array('http://', 'https://'),'',strtolower(get_permalink()));
						
						if ($current_url==$item_url){
							$extra = "class='current' ";
						}else{
							$extra = null;
						}
						
						echo '<li '.$extra.'><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
					endwhile;

					if ($order == 'DESC' && $parent == true ){
						if ($current_url==$parent_url){ $extra = "class='current' "; }else{ $extra = null; }				
						echo '<li '.$extra.'><a href="'.$parent_permalink.'">'.$parent_title.'</a></li>';
					}
					
					wp_reset_postdata();
					
					echo '</ul>';
				}
				
			
			echo wp_kses_post($after_widget);
		}
	
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			
		#	Data Validation
		#
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['show-parent'] = sanitize_text_field( $new_instance['show-parent'] );
			$instance['nav-page'] = sanitize_text_field( $new_instance['nav-page'] );

			return $instance; 
		}
		

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'nav-page' => null, 'show-parent' => false);
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			
			?>
			
			<div class="ewf-meta">
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Section title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" style="width:95%;" /> 
				</p>
				 
				<p>
				<?php
				
					$pages_list = get_pages();
					
					echo '<select id="'.$this->get_field_id( 'nav-page' ).'" name="'.$this->get_field_name( 'nav-page' ).'" style="width:95%;">';
					foreach($pages_list as $current_page){
						if ($current_page->post_parent == 0 ){
							if (esc_html( $instance['nav-page'] ) == $current_page->post_title){
								echo '<option selected="selected" >'.$current_page->post_title.'</option>';
							}else{
								echo '<option>'.$current_page->post_title.'</option>';
							}
						}
					}  
					echo '</select>';
				
				?>
				</p>
				
				<p class="ewf-meta-checkbox">
					<input type="checkbox" id="<?php echo $this->get_field_id( 'show-parent' ); ?>" name="<?php echo $this->get_field_name( 'show-parent' ); ?>" <?php check_checkbox( esc_html( $instance['show-parent'] )); ?> />
					<label for="<?php echo $this->get_field_id( 'show-parent' ); ?>"><?php _e('Show parent', EWF_SETUP_THEME_DOMAIN); ?></label>
				</p>
			</div>
 
		<?php
		}
	}
	
	
	function check_checkbox($value){
		if ($value == "on"){
			echo " checked='yes' ";
		}
	}

	register_widget( 'ewf_widget_navigation' 	);
	
?>