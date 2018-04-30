<?php

/*	
 *	EWF - Admin Options Framework
 *
 *	ver: 1.5.0.16
 *	upd: 20 Feb 2014
 *	
 *
 *	
 */

	add_action('admin_enqueue_scripts'							, 'ewf_admin_load_includes');
	

#	Default image sizes
#		
	add_image_size( 'ewf-header-logo'							, 274	,9999	,false 	);
	
	
	function ewf_admin_options_install(){
		global $ewf_admin_options;
		
		$ewf_media_images = ewf_admin_ui_image_mediaImages();
		
		foreach ($ewf_admin_options as $value) {
			if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' ||  $value['type']=='checkbox'  ||  $value['type']=='ewf-ui-font' ||  $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-columns-size' ||  $value['type']=='ewf-ui-image' || $value['type']=='select' || $value['type']=='color' )) {
				update_option( $value['id'], $value['std'] ); 
				
				if ($value['type'] == 'ewf-ui-image' && array_key_exists('import', $value) && $value['import'] != null){
					$media_image_url = ewf_admin_ui_image_mediaImport($value, $ewf_media_images);
					
					if ($media_image_url){
						update_option( $value['id'], sanitize_text_field($media_image_url));
					}
				}
			}
		}	
		
		do_action('ewf_modLayout_resetSidebars');
		
	}
	
	add_action("after_switch_theme", "ewf_admin_options_install", 10, 2 );

	
	function ewf_admin_options_render($ewf_admin_options){
		
		ob_start();
		
		$ewf_media_images = ewf_admin_ui_image_mediaImages();
		
		$panel_active = get_option(EWF_SETUP_THNAME."_admin_tab_active", 'ewf-panel-general');
		
		foreach ($ewf_admin_options as $value) {
			switch ( $value['type'] ) {

			
				case "panel": 
					if ($value['mode']=="open"){
						$extra = null;
						if (array_key_exists('active', $value)){
							$extra = ' active ';
						}
					
						if ($value['id'] == $panel_active) {
							$extra = ' active ';
						}
					
						echo '<div class="ewf-panel '.$extra.$value['id'].'">
								<div class="ewf-panel-content fixed">';
					}
					
					if ($value['mode']=="close"){
						echo '</div></div>';
					}
					break;

				case "open": 
					echo '<div class="section">';
					break;


				case "close":
					echo '</div>';
					break;

					
				case "label":
					echo '<label>'.$value['name'].'</label>';
					break;

					
				case "title":
					echo '<h2>'.$value['name'].'</h2>';
					break;
				
				
				case "ewf-ui-section":
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
			   echo '<div class="ewf-ui ewf-ui-section'.$group_class.'">
						<h2>'.$value['name'].'</h2>
						
						<div class="ewf-disabled"></div>
					</div>';
					break;
				
				case 'ewf-ui-options':
					$ewf_ui_options_value = get_option($value['id'], $value['std']);
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-options '.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-options">';
								
								if ( is_array($value['options']) ){
									foreach($value['options'] as $index => $item_option){
										
										$class_active_option = null;
										
										if ($item_option['value'] == $ewf_ui_options_value) {
											$class_active_option = ' ewf-state-active';
										}
										
										echo '<div class="ewf-ui-options-item'.$class_active_option.' '.$item_option['class'].'" data-value="'.$item_option['value'].'">';
											echo '<div><span></span></div>';
											echo '<span>'.$item_option['label'].'</span>';
										echo '</div>';
									}
								}
								
						   echo '</div>';

 						  echo '<input class="ewf-ui-input-option" name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$ewf_ui_options_value.'" />							
							</div>';

						echo '<div class="ewf-disabled"></div>
						</div>';
						break;
				
				
				case 'ewf-ui-background':
					// $textVal = '';
					// if ( get_option( $value['id'] ) != "") {  
						// $textVal = stripslashes(get_option( $value['id'] ));  
						// $ewf_ui_image_class = ' active';
					// } else {  
						// $textVal = $value['std']; 
					
					// }
					
					$default_patterns_url = get_template_directory_uri().'/framework/admin/includes/images/patterns/';
					$default_patterns = array( 'bg-body.png', 'bg-body2.png', 'bg-body3.png', 'bg-body4.png', 'bg-body4.png', 'bg-body5.png', 'bg-body6.png', 'bg-body7.png', 'bg-body8.png', 'bg-body9.png', 'bg-body10.png', 'bg-body11.png', 'bg-body12.png', 'bg-body13.png', 'bg-body14.png', 'bg-body15.png', 'bg-body16.png', 'bg-body17.png', 'bg-body18.png', 'bg-body19.png', 'bg-body20.png' );
					
					$background_data_raw = stripslashes(get_option($value['id'], $value['std']));
					$background_data = json_decode( $background_data_raw, true);
					$background_properties = array(); 
					
					foreach($background_data as $key => $item_properties){
						$background_properties[$item_properties['name']] = $item_properties['value'];
					}
					
					
					
					// 	Debug
					// 	echo '<pre>';
					// 		print_r($background_properties);
					// 	echo '</pre>';
					
					
					
					echo '<div class="ewf-ui ewf-ui-background fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							
							<div class="ewf-col-action">
								<div class="ewf-ui-control-background" data-image-size="'.$value['image-size'].'">
									
								
								
									<div class="ewf-ui-background-setting ewf-ui-hlp-property">
										<div class="fixed">
											<span>'.__('Background color', EWF_SETUP_THEME_DOMAIN).'</span>
											<input class="active ewf-ui-input-background-color" data-value="'.$background_properties['background-color'].'" data-property="background-color" type="text" value="'.$background_properties['background-color'].'" />
										</div>
									</div>
									
									<div class="ewf-ui-background-separator"></div>
									
									<div class="ewf-ui-background-image">
										
										<span>'.__('Background image', EWF_SETUP_THEME_DOMAIN).'</span>';
										

										$background_preview_class = 'image-none';
										if (trim($background_properties['background-image']) != null) { $background_preview_class = 'image-selected'; }
																			
										echo '<div class="ewf-ui-background-setting ewf-ui-background-image-property ewf-ui-hlp-property '.$background_preview_class.'">
												<div class="ewf-ui-background-image-preview active fixed" data-value="'.$background_properties['background-image'].'" >
													<div class="no-image"></div>
													<img src="'.$background_properties['background-image-preview'].'" alt="" />
													
													<div class="image-patterns">
														<ul class="ewf-ui-background-presets fixed">';
														
															foreach($default_patterns as $index => $item_pattern){
																echo '<li data-preview="'.$default_patterns_url.'preview-'.$item_pattern.'" data-value="'.$default_patterns_url.$item_pattern.'" ><img src="'.$default_patterns_url.'thumb-'.$item_pattern.'"></li>';
															}
															
												   echo '</ul>
													</div>
												</div>
												
												<a class="button button-primary button-large ewf-ui-background-image-upload" href="#">'.__('Upload image', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-remove" href="#">'.__('Remove image', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-pattern" href="#">'.__('Choose pattern', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-cancel" href="#">'.__('Cancel', EWF_SETUP_THEME_DOMAIN).'</a>
												
												<input class="ewf-ui-input-background-image" data-property="background-image" type="hidden" value="'.$background_properties['background-image'].'" />
											</div>
											
											
											
											<div class="ewf-ui-background-setting ewf-ui-background-image-preview-property ewf-ui-hlp-property">
												<div class="active"  data-value="'.$background_properties['background-image-preview'].'" ></div>
												<input class="ewf-ui-input-background-image-preview" data-property="background-image-preview" type="hidden" value="'.$background_properties['background-image-preview'].'" />
											</div>
										
										<div class="ewf-ui-background-separator"></div>
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background repeat', EWF_SETUP_THEME_DOMAIN).'</span>';
												
												$background_repeat = array('repeat-all'=>null, 'repeat-x'=>null, 'repeat-y'=>null, 'no-repeat'=> null);
												$background_repeat[$background_properties['background-repeat']] = ' active';
												
										   echo '<ul class="fixed">
													<li title="" class="ewf-tooltip ewf-ui-icon-bg-repeatall'.$background_repeat['repeat-all'].'" data-value="repeat-all"></li>
													<li title="'.__('Repeat Horizontal', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-repeatx'.$background_repeat['repeat-x'].'" data-value="repeat-x"></li>
													<li title="'.__('Repeat Vertical', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-repeaty'.$background_repeat['repeat-y'].'" data-value="repeat-y"></li>
													<li title="'.__('No Repeat', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-norepeat'.$background_repeat['no-repeat'].'" data-value="no-repeat"></li>
												</ul>
												
												<input class="ewf-ui-input-background-repeat" data-property="background-repeat" type="hidden" value="'.$background_properties['background-repeat'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background position', EWF_SETUP_THEME_DOMAIN).'</span>';
												
												$background_position = array('right top'=>null, 'center top'=>null, 'left top'=>null, 'right center'=>null, 'center center'=>null, 'left center'=>null, 'left bottom'=>null, 'center bottom'=>null, 'right bottom'=>null);
												$background_position[$background_properties['background-position']] = ' active';
												
										   echo '<ul class="background-position fixed">
													<li title="'.__('Align Right Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rt'.$background_position['right top'].'" data-value="right top"></li>
													<li title="'.__('Align Center Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-ct'.$background_position['center top'].'" data-value="center top"></li>
													<li title="'.__('Align Left Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lt'.$background_position['left top'].'" data-value="left top"></li>
													<li title="'.__('Align Right Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rc'.$background_position['right center'].'" data-value="right center"></li>
													<li title="'.__('Align Center Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-cc'.$background_position['center center'].'" data-value="center center"></li>
													<li title="'.__('Align Left Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lc'.$background_position['left center'].'" data-value="left center"></li>
													<li title="'.__('Align Right Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rb'.$background_position['right bottom'].'" data-value="right bottom"></li>
													<li title="'.__('Align Center Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-cb'.$background_position['center bottom'].'" data-value="center bottom"></li>
													<li title="'.__('Align Left Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lb'.$background_position['left bottom'].'" data-value="left bottom"></li>
												</ul>
												
												<input class="ewf-ui-input-background-position" data-property="background-position" type="hidden" value="'.$background_properties['background-position'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background attachment', EWF_SETUP_THEME_DOMAIN).'</span>
												
												<ul class="fixed">';

													$background_attachment = array('fixed' => null, 'scroll' => null);
													$background_attachment[$background_properties['background-attachment']] = ' active';
													
													echo '<li title="'.__('Background Fixed', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-attach-fixed'.$background_attachment['fixed'].'" data-value="fixed"></li>';
													echo '<li title="'.__('Background Scroll', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-attach-scroll'.$background_attachment['scroll'].'" data-value="scroll"></li>';
													
										   echo '</ul>
												
												<input class="ewf-ui-input-background-attachment" data-property="background-attachment" type="hidden" value="'.$background_properties['background-attachment'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background stretch & fit', EWF_SETUP_THEME_DOMAIN).'</span>
												<div class="toggle active" data-value="'.$background_properties['background-stretch'].'" ></div>
												
												<input class="ewf-ui-input-background-stretch" data-property="background-stretch" type="hidden" value="'.$background_properties['background-stretch'].'" />
											</div>
										</div>
										
									</div>';
									
								
								#	<div class="ewf-ui-image-wrapper'.$ewf_ui_image_class.'"><div></div><img src="'.get_option($value['id'], $value['std']).'" class="ewf-ui-image-preview" height="'.$value['image-height'].'" ></div>
								#	<a href="#" class="button button-primary button-large ewf-ui-image-upload">'.__('Upload Image', EWF_SETUP_THEME_DOMAIN).'</a> 
								#	<input class="ewf-ui-input-image" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$textVal.'" />							
									
									
								echo '<textarea class="ewf-ui-input-background" style="width:394px;height:200px;" name="'.$value['id'].'" id="'.$value['id'].'" type="text" >'.$background_data_raw.'</textarea>
									
								</div>
								
								
							</div>
						
							<div class="ewf-disabled"></div>
						  </div>';
					break;				
					
				
				# TODO: check scenario where the import image does not exist
				# TODO: check for the current image in the upload folder and see it exists before checking the image size

				case 'ewf-ui-image':
					$textVal = null;
					$extra_class = null;
					
					$ewf_ui_image_class = null;
					$image_url = ewf_get_option_UIImage($value, $ewf_media_images);
					
					if ($image_url){
						$image_info = getimagesize( $image_url );
						
						$ewf_ui_image_class .= ' active';
						
						if ($image_info[0] > 230) {
							$extra_class = ' ewf-image-fit';
						}
						
					}
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-image fixed'.$group_class.'">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-image" data-image-size="'.$value['image-size'].'">
									<div class="ewf-ui-image-wrapper'.$ewf_ui_image_class.'"><div></div><img src="'.$image_url.'" class="ewf-ui-image-preview'.$extra_class.'" ></div>
									<a href="#" class="button button-primary button-large ewf-ui-image-upload">'.__('Change Image', EWF_SETUP_THEME_DOMAIN).'</a> 
								</div>
								
								<input class="ewf-ui-input-image" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="' . $image_url . '" />							
							</div>
						
							<div class="ewf-disabled"></div>
						  </div>';
					break;
					
					
				case 'ewf-ui-columns':			
				
					$columns_size = get_option( $value['id'], $value['std']);
					$columns_number = count(explode(',',$columns_size));				
					$columns_class = array( '1'=>null, '2'=>null, '3'=>null, '4'=>null );
					$columns_class[$columns_number] = ' active';
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-columns'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
							
								<div class="ewf-ui-control-columns expanded" data-columns="'.$columns_number.'">';
								
									#	Tabs section
									#
									echo '<div class="ewf-ui-columns-tabs">';
										echo '<div class="ewf-ui-columns-tab-columns active" data-related="ewf-ui-columns-setcol-wrapper"><span>'.$columns_number.'</span> '.__('Columns', EWF_SETUP_THEME_DOMAIN).'</div>';
										echo '<div class="ewf-ui-columns-tab-editor" data-related="ewf-ui-columns-editor-wrapper">'.__('Edit Size', EWF_SETUP_THEME_DOMAIN).'</div>';
									echo '</div>';
									
									
									#	Tab - Set columns
									#									
									echo '<div class="ewf-ui-columns-setcol-wrapper ewf-ui-columns-tab-content active">';
										echo '<span>'.__('Layout', EWF_SETUP_THEME_DOMAIN).'</span>';
										
										echo '<ul class="ewf-ui-controls-setnumbers ewf-ui-columns-tab-content">';
											echo '<li><a class="ft-col1'.$columns_class[1].'" data-columns="1" data-size="12" href="#"></a></li>';
											echo '<li><a class="ft-col2'.$columns_class[2].'" data-columns="2" data-size="6,6" href="#"></a></li>';
											echo '<li><a class="ft-col3'.$columns_class[3].'" data-columns="3" data-size="4,4,4" href="#"></a></li>';
											echo '<li><a class="ft-col4'.$columns_class[4].'" data-columns="4" data-size="3,3,3,3" href="#"></a></li>';
										echo '</ul>';
									echo '</div>';
									
									
									#	Tab - Edit columns
									#
									echo '<div class="ewf-ui-columns-editor-wrapper ewf-ui-columns-tab-content">';
										echo '<p>'.__('Press the plus button to increase column size', EWF_SETUP_THEME_DOMAIN).'</p>';
										echo '<div class="ewf-ui-column-editor"></div>';
									echo '</div>';
									
									echo '<input type="hidden" autocomplete="off" id="'.$value['id'].'" name="'.$value['id'].'" class="ewf-ui-input-columns" value="'.$columns_size.'" readonly />'; 							
							
						  echo '</div> <!-- .ewf-ui-control-columns -->
						  
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
				
				
				case 'ewf-ui-columns-size':
				
					$columns_size = get_option( $value['id'], $value['std']);
					$columns_number = count(explode(',',$columns_size));				
					$columns_class = array( '1'=>null, '2'=>null, '3'=>null, '4'=>null );
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-columns-size'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
							
								<div class="ewf-ui-control-columns-size" data-columns="'.$columns_number.'" data-min="'.$value['min'].'" data-max="'.$value['max'].'" >';
								
									echo '<div class="ewf-ui-columns-size-wrapper">';
										// echo '<p>'.__('Press the plus button to increase column size', EWF_SETUP_THEME_DOMAIN).'</p>';
										echo '<div class="ewf-ui-column-size-editor">';
											echo '<div class="ewf-content-size" data-columns="6"><span class="right"></span></div>';
											echo '<div class="ewf-sidebar-size" data-columns="6"><span class="left"></span></div>';
										echo '</div>';
									echo '</div>';
									
									echo '<input type="hidden" autocomplete="off" id="'.$value['id'].'" name="'.$value['id'].'" class="ewf-ui-input-columns-size" value="'.$columns_size.'" readonly />'; 							
							
						  echo '</div> <!-- .ewf-ui-control-columns-size -->
						  
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
				
				
				case 'ewf-ui-slider':
					$textVal = '';
					if ( get_option( $value['id'] ) != "") {  $textVal = stripslashes(get_option( $value['id'] ));  } else {  $textVal = $value['std']; }
					
					$ui_slider_min = 0;
					$ui_slider_max = 100;
					$ui_slider_step = 1;
					$ui_slider_unit = 'px';
					
					if (array_key_exists('min', $value)){  $ui_slider_min = intval($value['min']);  }
					if (array_key_exists('max', $value)){  $ui_slider_max = intval($value['max']);  }
					if (array_key_exists('step', $value)){  $ui_slider_step = intval($value['step']);  }
					if (array_key_exists('unit', $value)){  $ui_slider_unit = $value['unit'];  }

					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
				   echo '<div class="ewf-ui ewf-ui-slider'.$group_class.' fixed" >
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input class="ewf-ui-input-slider" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$textVal.'" readonly/>							
								<div class="ewf-ui-control-slider" data-step="'.$ui_slider_step.'" data-unit="'.$ui_slider_unit.'" data-max="'.$ui_slider_max.'" data-min="'.$ui_slider_min.'" ></div>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
				
				
				
				case 'ewf-ui-toggle':
					$toggle_value = get_option($value['id'], $value['std']);
					$toggle_class = null;
					$toggle_dependency = null;
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					if (array_key_exists('dependency', $value) && $value['dependency']){
						$toggle_dependency = 'data-dependency="'.$value['dependency'].'"';
					}
					
					if ($toggle_value){
						if ($toggle_value == 1){ $toggle_value = 'true'; }
						
						$toggle_class = ' data-enabled="'.$toggle_value.'"';
					}
					
				   echo '<div class="ewf-ui ewf-ui-toggle '.$group_class.' fixed"'.$toggle_dependency.'>
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>';
								
								if (!empty($value['section-description'])){
									echo '<span>'.$value['section-description'].'</span>';
								}
								
							echo '</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-toggle"'.$toggle_class.'>
									<div class="toggle"></div>
									<input class="ewf-ui-input-toggle" name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$toggle_value.'" />
								</div>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;

					
				case 'ewf-ui-font':
					$group_class = null;
					
					$font_data_row = stripslashes(get_option($value['id'], $value['std']));
					$font_data = json_decode($font_data_row,true);
					$font_properties = array(); 
					
					
					foreach($font_data as $key => $item_properties){
						$font_properties[$item_properties['name']] = $item_properties['value'];
					}
					
					$font_properties['font-family'] = ucwords($font_properties['font-family']);
					$font_variants = ewf_admin_ui_font_getVariants($font_properties['font-family']);
					$font_variants = $font_variants['variants'];
					
					// $font_properties['font-italic-class'] = null;
					// if ($font_properties['font-italic'] == 'true'){
						// $font_properties['font-italic-class'] = 'ewf-state-active';
					// }
					
					if ($font_properties['font-weight'] == null){
						$font_properties['font-weight'] = 'regular';
					}
					
					
					// DEBUG
					// echo '<pre>';
						// echo '<br/>Value:';
						// print_r($value);
						
						// echo '<br/>Data:';
						// print_r($font_data);
						
						// echo '<br/>Properties:';
						// print_r($font_properties);
						
						// echo '<br/>Font Family:'.$font_properties['font-family'];

						// echo '<br/>Variants:';
						// print_r($font_variants);
					// echo '</pre>';
					
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-font'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								
								<div class="ewf-ui-control-font">
									<div class="ewf-ui-font-preview">
										<h3>'.__('Title Sample', EWF_SETUP_THEME_DOMAIN).'</h3>
										<p>'.__('paragraph sample here', EWF_SETUP_THEME_DOMAIN).'</p>
									</div>
									<div class="ewf-font-ui-options ewf-ui-hlp-property-set">
									
											<div class="ewf-font-ui-selector ewf-ui-hlp-property">
												<span class="ewf-ui-font-current active" data-value="'.$font_properties['font-family'].'">'.$font_properties['font-family'].'</span> 
												
												<div class="ewf-ui-font-search hidden">
													<div class="ewf-ui-font-dropdown">
															<input class="ewf-ui-input-font-search" type="text" value="" />
														<ul>'.ewf_admin_ui_font_generateList().'</ul>
													</div>
												</div>
												
												<input class="ewf-ui-input-font-family" data-property="font-family" type="hidden" value="" />
											</div>
											
											<div class="ewf-ui-font-variant ewf-ui-hlp-property">
												<div class="ewf-ui-cp-dropdown">
													<span class="ewf-cp-dropdown-current active" data-value="'.$font_properties['font-weight'].'">'.$font_properties['font-weight'].'</span> 
													<ul>';

														if (is_array($font_variants)){
															foreach($font_variants as $key => $weight){
																echo '<li data-value="'.$weight.'">'.$weight.'</li>';
															}
														}
														
													echo '</ul>
												</div> 
												
												<input class="ewf-ui-input-font-variant" data-property="font-weight" type="hidden" value="" />
											</div>';
											
											
											
											// <div class="ewf-ui-font-italic ewf-ui-hlp-property">
												// <div class="ewf-ui-cp-button-toggle '.$font_properties['font-italic-class'].' -ewf-state-disabled active" data-value="'.$font_properties['font-italic'].'"><span></span></div>
												
												// <input class="ewf-ui-input-font-italic" data-property="font-italic" type="hidden" value="" />
											// </div>
											
											
											echo '
											<textarea class="ewf-ui-input-font-set ewf-ui-hlp-property-set-input" name="'.$value['id'].'" id="'.$value['id'].'" >'.$font_data_row.'</textarea>
									</div>									
									
								</div>
								
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
					
					
				
				case 'ewf-ui-color':
					$color_value = get_option($value['id'], $value['std']);
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-color'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input class="ewf-ui-input-color" name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$color_value.'"/>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;

					
				case 'ewf-mod-import-export':
					ewf_import_uploadFile();
					break;
					

				case 'textarea':
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-textarea'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
							<textarea name="'.$value['id'].'" type="'.$value['type'].'" cols="" rows="6">';
								if ( get_option( $value['id'] ) != "") { 
									echo stripslashes(get_option($value['id']) ); 
								} else { 
									echo wp_kses_post($value['std']); 
								}
				 	  echo '</textarea>
						   </div>
						   
						   <div class="ewf-disabled"></div>
						</div>';
					break;


				case 'text':
					$textVal = '';
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					if ( get_option( $value['id'] ) != "") {  $textVal = stripslashes(get_option( $value['id'] ));  } else {  $textVal = $value['std']; }
					
					echo '<div class="ewf-ui ewf-ui-text'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$textVal.'"/>
							</div>
							
							<div class="ewf-disabled"></div>
						  </div>';
					break;
					
					
				case 'ewf-ui-select':
					$select_value = get_option($value['id'], $value['std']);
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-select'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">';
								echo '<select name="'.$value['id'].'" id="'.$value['id'].'">';
									foreach ($value['options'] as $key => $option) {
										if ($option['id'] == $select_value){ 
											echo '<option value="'.$option['id'].'" selected="selected" >'.$option['title'].'</option>';
										}else{
											echo '<option value="'.$option['id'].'" >'.$option['title'].'</option>';
										}
									}
								echo '</select>';
							echo '</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
					


			}
		}
	
		return ob_get_clean();
	}
	
	function ewf_admin_options_update() {
		global $ewf_admin_options;
		
		$currentSession = $ewf_admin_options;
		
		if ( array_key_exists('page', $_GET) && $_GET['page'] == EWF_SETUP_PAGE) {
			if ( array_key_exists('save', $_REQUEST) ) {		
			
				foreach ($ewf_admin_options as $value) {
				
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-font' || $value['type']=='ewf-ui-background' || $value['type']=='ewf-ui-columns' || $value['type']=='ewf-ui-columns-size' || $value['type']=='ewf-ui-toggle' || $value['type']=='ewf-ui-color' || $value['type']=='ewf-ui-slider' || $value['type']=='ewf-ui-image' || $value['type']=='color' || $value['type']=='upload' || $value['type']=='input-skins' || $value['type']=='checkbox' || $value['type']=='select') && array_key_exists($value['id'], $_REQUEST) ) {
						if ($value['type']=='checkbox' && $_REQUEST[ $value['id'] ]=='on') { $_REQUEST[ $value['id'] ]='true'; }
						 
						 $option_value = sanitize_text_field($_REQUEST[ $value['id'] ]);
						 
						 update_option( $value['id'],  $option_value);
						 // echo '<br/>Update: '.$value['id'].' - ['.update_option( $value['id'], $_REQUEST[ $value['id'] ] ).']['.$_REQUEST[ $value['id'] ].']'; 					
						
					}else{
						if ($value['type']=='checkbox' ){
							update_option( $value['id'], 'false' ); 
						}
					}
				}
				
			} else if( array_key_exists('action', $_REQUEST) && ($_REQUEST['action']=='reset')) {
				
				$ewf_media_images = ewf_admin_ui_image_mediaImages();
				
				foreach ($ewf_admin_options as $value) {
					if (($value['type']=='textarea' || $value['type']=='upload'|| $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' || $value['type']=='ewf-ui-font' || $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-columns-size' ||  $value['type']=='ewf-ui-image' || $value['type']=='text' || $value['type']=='checkbox' || $value['type']=='select' || $value['type']=='color')) {
						update_option( $value['id'], $value['std'] ); 
						
						// echo '<br/>Updated: '.$value['id'].' - '.$value['std'];
					}
					
					if ($value['type'] == 'ewf-ui-image' && array_key_exists('import', $value) && $value['import'] != null){
						$media_image_id = ewf_admin_ui_image_mediaImport($value, $ewf_media_images);
						
						if ($media_image_id){
							update_option( $value['id'], $media_image_id );
						}
					}
				} 				
				
				
				//	Force ModLayout to reset sidebars
				//
				do_action('ewf_modLayout_resetSidebars');
				
				header("Location: themes.php?page=functions.php&action=defaults&confirm=reset"); 
				
			}else if(array_key_exists('install', $_REQUEST)){
				foreach ($ewf_admin_options as $value) {
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' ||  $value['type']=='checkbox'  ||  $value['type']=='ewf-ui-font' ||  $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-columns-size' ||  $value['type']=='ewf-ui-image' || $value['type']=='select' || $value['type']=='color' )) {
						update_option( $value['id'], $value['std'] ); 
					}
				}	
				
				
				//	Force ModLayout to reset sidebars
				//
				do_action('ewf_modLayout_resetSidebars');
			}
		} 

		
		$icon_path = null;		
		add_menu_page('EWF Admin'	, __('Theme Options', EWF_SETUP_THEME_DOMAIN)	, 'edit_theme_options' , EWF_SETUP_PAGE	, 'ewf_admin_options'	, $icon_path, 90);
	}
	
	add_action('admin_menu', 'ewf_admin_options_update' );

	
	function ewf_admin_options() {
	
		global $ewf_admin_options;
		global $_wp_admin_css_colors;
		
		$color_scheme = get_user_option( 'admin_color' ); 
		
			
		$theme_colors = $_wp_admin_css_colors[$color_scheme]->colors;
		
		echo '<style class="ewf-admin-dynamic-style">';
			echo '#ewf-admin-header { background-color:'.$theme_colors[1].'; }';
			echo '#ewf-admin-sidebar li a:hover { color:'.$theme_colors[3].'; }';
			echo '#ewf-admin-sidebar li.active a { color:'.$theme_colors[3].'; }';
			echo '.ewf-ui.ewf-ui-slider .ui-slider-range { background:'.$theme_colors[3].'; }';
			echo '.ewf-ui-background-setting .ewf-ui-background-presets .active { border-color:'.$theme_colors[3].'; }';
		echo '</style>';
		
		// foreach($_wp_admin_css_colors[$color_scheme]->colors as $color){
			// echo '<div style="background-color:'.$color.';width:20px;height:20px;"></div>';
		// }
			
		?>
		
		<div class="ewf-admin-options">
		<form method="post" autocomplete="off">
		

			<div class="ewf-admin-options-wrapper fixed">

				<div id="ewf-admin-header">
					<h3><?php echo EWF_SETUP_THEME_NAME ?></h3>
					<p>Version <?php echo EWF_SETUP_THEME_VERSION ?></p>

					<div class="header-settings">
						<input class="button button-primary button-large" name="save" type="submit" style="cursor:pointer" value="<?php echo __('Save changes', EWF_SETUP_THEME_DOMAIN);  ?>" />
						<input type="hidden" class="ewf-admin-action" name="action" value="save" />&nbsp;
						<input 
							data-modal-title="<?php echo __('Restore default settings ?', EWF_SETUP_THEME_DOMAIN); ?>" 
							data-modal-text="<?php echo __('current settings will be lost', EWF_SETUP_THEME_DOMAIN); ?>"
							data-modal-cancel="<?php echo __('Cancel', EWF_SETUP_THEME_DOMAIN); ?>" 
							data-modal-confirm="<?php echo __('Restore default settings!', EWF_SETUP_THEME_DOMAIN); ?>" 
							data-modal-confirm-color="<?php echo sanitize_text_field($theme_colors[3]); ?>" 
							class="button button-primary button-large ewf-admin-option-restore" 
							name="reset" 
							type="submit" 
							value="<?php echo __('Restore Defaults', EWF_SETUP_THEME_DOMAIN);  ?>" 						/>
					</div>
				</div>	
				
				
				<div class="fixed">
				<?php
				
					if ( array_key_exists('save', $_REQUEST)){ 
						echo '<div class="ewf-admin-notice">'.__('The settings have been successfully saved!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}
						
					if ( array_key_exists('action', $_REQUEST) && ($_REQUEST['action'] == 'defaults')){ 
						echo '<div class="ewf-admin-notice">'.__('Default settings have been restored!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}

					if ( array_key_exists('install', $_REQUEST)){ 
						echo '<div class="ewf-admin-notice">'.__('The theme settings have been restored to default, install triggered!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}

				?>
				</div>
				
				
				<div class="ewf-admin-content-wrapper fixed">
					<div id="ewf-admin-sidebar">					
						<?php
						
						
							$panel_active = get_option(EWF_SETUP_THNAME."_admin_tab_active", 'ewf-panel-general');
							
							$panel_array = array( 
								'ewf-panel-general' 		=> array('icon' => 'ewf-icon-general'		, 'class'=> null 	, 'title' => __('General', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-colors'			=> array('icon' => 'ewf-icon-colors'		, 'class'=> null 	, 'title' => __('Colors', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-header'			=> array('icon' => 'ewf-icon-header'		, 'class'=> null 	, 'title' => __('Header', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-footer'			=> array('icon' => 'ewf-icon-footer'		, 'class'=> null 	, 'title' => __('Footer', EWF_SETUP_THEME_DOMAIN)),
								// 'ewf-panel-typography'		=> array('icon' => 'ewf-icon-typography'	, 'class'=> null 	, 'title' => __('Typography', EWF_SETUP_THEME_DOMAIN)),
							 	// 'ewf-panel-import-export'	=> array('icon' => 'ewf-icon-export'		, 'class'=> null 	, 'title' => __('Import / Export', EWF_SETUP_THEME_DOMAIN)),
							);
						
							
							//	Check if shop is active first
							//
							if (is_plugin_active('woocommerce/woocommerce.php')){
								$panel_array['ewf-panel-shop'] =  array('icon' => 'ewf-icon-shop'			, 'class'=> null 	, 'title' => __('Shop', EWF_SETUP_THEME_DOMAIN));
							}							
							
							$panel_array[$panel_active]['class'] = "active";
							
							
							echo '<ul class="ewf-admin-vertical-nav">';
							
							foreach($panel_array as $panel_index => $panel_item){
								$data_class = null;
								if ($panel_item['class']){
									$data_class = 'class="'.$panel_item['class'].'" ';
								}
								
								echo '<li '.$data_class.'data-panel="'.$panel_index.'"><a class="'.$panel_item['icon'].'" href="#">'.$panel_item['title'].'</a></li>';
							
							}
							
							echo '</ul>';
							
						?>
					</div>	<!-- .ewf-admin-sidebar -->
					
					<div id="ewf-admin-content">
						<?php  echo ewf_admin_options_render($ewf_admin_options);  ?>
					</div>
					
				</div>	<!-- .ewf-admin-content-wrapper	-->
				
				
			</div>	<!--  .ewf-admin-options-wrapper  -->

		</form>	
		</div>	<!--  .ewf-admin-options -->
		
		<?php
	}
	

/*
 *	Attach required css & js in admin scripts header
 */	
	function ewf_admin_load_includes() {
	
		
	
	   wp_enqueue_script('media-upload');
	   
	   wp_enqueue_script('jquery-ui-slider');
	   wp_enqueue_style('jquery-ui-slider'); 
	   
	   wp_enqueue_script('thickbox');
	   wp_enqueue_style('thickbox'); 

	   wp_enqueue_media(); 
	   
	   wp_enqueue_script ('wp-color-picker');
	   wp_enqueue_style ('wp-color-picker');
	   
	}

	



/*
 * Check if default image is added to media manager, in case not is copying
 * the image form layout/images/default folder on wordpress upload folder,
 * is adding the image in the media manager and saves the path on option's 
 * current value
 *
 * @param $option - current theme option item array
 * @return - Image URL
 * @since: 1.5.0
 */
	function ewf_admin_ui_image_mediaImport($option, $ewf_media_images){
		$ewf_debug = array();
		$file_attachment_id = 0;
		
		
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		
		if (empty($option)){
						
		}
		
		$ewf_debug['start-with-option'] = $option;
		
		
		$wp_upload_dir 		= wp_upload_dir();
		$file_default 		= get_stylesheet_directory().$option['import'];
		$file_uploaded 		= $wp_upload_dir['basedir'] . '/' . basename($file_default);
		$file_uploaded_url 	= $wp_upload_dir['baseurl'] . '/' . basename($file_default);
		
		
		/*
		if(wp_mkdir_p($wp_upload_dir['path'])){
			$ewf_debug[] = 'The folder exists!';
			$ewf_debug['wp-upload-dir'] = $wp_upload_dir;
		}else{
			$ewf_debug[] = 'The folder does not exist!';
			$ewf_debug['wp-upload-dir'] = $wp_upload_dir;
		}
		*/
		
		if (is_array($ewf_media_images)){
			$ewf_debug['media-found'] = '*';
			
			foreach($ewf_media_images as $media_image_id => $media_image_url){
				if ($media_image_url == $file_uploaded_url){
					$file_attachment_id = $media_image_id;
					
					$ewf_debug['media-found'] = $media_image_id;
				}
			}	
		}
		
		
		$ewf_debug['media-is-array'] = is_array($ewf_media_images);
		$ewf_debug['media-count'] = count($ewf_media_images);
		
		#	  Check if file exists						
		#
		if (( file_exists($file_uploaded) == true && (is_array($ewf_media_images) == true && count($ewf_media_images) == 0 )) || !file_exists($file_uploaded) ){

			$file_type = wp_check_filetype( basename( $file_default ), null );
			$file_data = file_get_contents($file_default);
			file_put_contents($file_uploaded, $file_data);

		
			$attachment = array(
				'guid'           => $wp_upload_dir['baseurl'] . '/' . basename( $file_uploaded ), 
				'post_mime_type' => $file_type['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_uploaded ) ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			
			
			$attach_id = wp_insert_attachment( $attachment, $file_uploaded);
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file_uploaded );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			
			$file_attachment_id = $attach_id;
			
			
			$ewf_debug['attachment-data'] 	= $attach_data;
			$ewf_debug['file-type'] 		= $file_type;
			$ewf_debug['set'] 				= 1;
			
		}else{	
			$ewf_debug[] = 'File already exists [' . $file_uploaded . ']!';
			$ewf_debug['set'] 	= 2;
		}

		
		$ewf_debug['option'] 				= $option;
		$ewf_debug['wp-upload-dir'] 		= $wp_upload_dir;
		$ewf_debug['media-images'] 			= $ewf_media_images;
		$ewf_debug['image-id'] 				= $file_attachment_id;
		$ewf_debug['image-uploaded']		= $file_uploaded;
		$ewf_debug['image-uploaded-url']	= $file_uploaded_url;
		
		
		/*
		echo '<pre>';
			print_r($ewf_debug);
		echo '</pre>';
		*/
		
		
		if ($file_attachment_id){
			$image_size = $option['image-size'];
			$ewf_ui_image_url = wp_get_attachment_image_src( $file_attachment_id, $image_size);
			
			return $ewf_ui_image_url[0];
		}else{
			return '';
		}
		
		
	
	}



/*
 * Get a list will all the images from media gallery
 *
 * @return array( ID => Image-URL ) 
 * @since: 1.5.0
 */
	function ewf_admin_ui_image_mediaImages() {
		$images = array();
		$args 	= array(
			'post_type' => 'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit',
			'posts_per_page' => -1,
			'orderby' => 'rand'
		);
		
		$query_images = new WP_Query( $args );
		
		foreach ( $query_images->posts as $image) {
			$images[$image->ID]= $image->guid;
		}
		
		return $images;
	}

		
/*
 * 	Get the image URL of an theme option type ewf-ui-image
 *
 *	@param $option_id - it can be either the option ID or the admin settings array
 *	@return - Image URL
 * 	@since: 1.5.0
 */
	function ewf_get_option_UIImage($option_id, $ewf_media_images = null){
		global $ewf_debug_live;	
		
		$debug = array();
		
		$option = null;
		$image_url = null;
		
		
	
		#	If the option id or settings option is not provided return null
		#
		if ($option_id == null){
			$debug[] = '# getImageURL - No option ID ['.$option_id.']';
			
			return null;
		}
	
	
		#	If the first argument is an array than I'm getting the entire settings array
		#
		if (is_array($option_id)){
			$option = $option_id;
			$option_value = get_option($option['id'], null);
			
			$debug[] = '# getImageURL - Option Array ['.$option_id['id'].']';
		}else{
			$option_value = get_option($option_id, null);
			
			$debug[] = '# getImageURL - Option ID ['.$option_id.'] ['.$option_value.']';
		}
		
			
		if ( $option_value != null) {  
		
			#	If the obtain URL is not NULL
			#
			$image_url = esc_url($option_value);  
			
			$debug[] = array( 'message' => '# option has value', 'option' => $option_id, 'image_url' => $image_url );
			
		} else {  
			
			#	If the URL is NULL get the option array from settings 
			#
			$option = ewf_admin_options_getByID($option_id);
			
			if ($option['std'] != null){
				
				$image_url = $option['std'];
				
			}else{
			
				#	If the media images array is not provided extract it
				#
				if (!$ewf_media_images){
					$ewf_media_images = ewf_admin_ui_image_mediaImages();
				}
				
				
				$media_image_url = ewf_admin_ui_image_mediaImport($option, $ewf_media_images);
				
				if ($media_image_url){
					$image_url = $media_image_url;
					update_option( $option['id'], $media_image_url );
					
				}
			}

		}
		
		
		
		
		if ($image_url == null) {
			return null;
		}
		
		
		$image_upload_dir = wp_upload_dir();
		$image_upload_path = str_replace( $image_upload_dir['baseurl'], $image_upload_dir['basedir'], $image_url );

		$image_path = str_replace( $image_upload_dir['baseurl'], $image_upload_dir['basedir'], $image_url );
		$image_exists = file_exists( $image_path );
		
		#	If the image doesn't exist import it
		#
		if (!$image_exists){

			$debug[] = '# Image not null but not found!';
		
			#	If the media images array is not provided extract it
			#
			if (!$ewf_media_images){
				$ewf_media_images = ewf_admin_ui_image_mediaImages();
				
				$debug[] = '# Media array empty, loading again!';
			}
				
			#	If the URL is NULL get the option array from settings 
			#
			$option = ewf_admin_options_getByID($option_id);
				
			$media_image_url = ewf_admin_ui_image_mediaImport($option, $ewf_media_images);
			
			if ($media_image_url){
				$image_url = $media_image_url;
				update_option( $option['id'], $media_image_url );
				
			}
		}
		
		
		// echo '<pre>';
			// print_r($debug);
		// echo '</pre>';
		
		
		return $image_url;
		
	}
	
	
	

/*
 *	Set a new image via AJAX on admin ui image selector
 */
	function ajax_ewf_admin_ui_image(){
		$response = array();
		
		if (array_key_exists('image_id', $_POST)){
			$image_id = filter_var($_POST['image_id'] , FILTER_SANITIZE_NUMBER_INT);
			$image_size = $_POST['image_size'];
		
			if ($image_id){
				$ewf_ui_image_preview = wp_get_attachment_image_src( $image_id, $image_size);
					
					$image_info = getimagesize ( $ewf_ui_image_preview[0] );
					
					$response['image_id'] = $image_id;
					$response['image_url'] = $ewf_ui_image_preview[0];
					$response['width'] = $image_info[0];
					$response['class'] = null;
					
					if ($image_info[0] > 230){
						$response['class'] = 'ewf-image-fit';
					}
					
					$response['state'] = '1'; 
					
					echo wp_send_json_success($response);
					exit;
					
			}else{
				echo wp_send_json_error('Error image id!');
				exit;
			}
			
		}else{
			echo wp_send_json_error('Error data check!');
			exit;
		} 
	
	}
	
	add_action('wp_ajax_ewf_ui_setImage', 'ajax_ewf_admin_ui_image' );



/*
 * 	Get the theme option setting array
 *
 * 	@param $option_id
 * 	@return - array
 * 	@since: 1.5.0
 */
	function ewf_admin_options_getByID($option_id){
		global $ewf_admin_options;
		
		foreach ($ewf_admin_options as $value) {
			if (array_key_exists('id', $value) && $value['id'] == $option_id){
				return $value;
			}
		}
		
	}
	

/*
 *	Include all fonts from UI Font control on theme options
 */
	function ewf_admin_ui_font_includes(){
		global $ewf_admin_options;
		$font_urls = array();
	
		
		foreach($ewf_admin_options as $index => $ewf_font_option){
			if ($ewf_font_option['type'] == 'ewf-ui-font'){
				
				$font_settings = ewf_admin_ui_font_decode($ewf_font_option['id'], true, $ewf_font_option['std']);
				$font_settings['url'] = ewf_admin_ui_font_googleurl($font_settings['font-family']);
				$font_settings['font-family'] = ucwords(str_replace(' ', '+', $font_settings['font-family']));
				
				$font_urls[$font_settings['url']] = $font_settings['font-family'];
			}
		}
		
		foreach($font_urls as $font_url => $font_name){
			wp_enqueue_style('googlefonts-'.$font_name	, $font_url);
		}
		
	}


/*
 *	Decode font data and convert it to CSS
 */
	function ewf_admin_ui_font_decode($admin_option, $properties_show = false, $admin_option_default = null){
		$result = array();



		
		$option_raw = stripslashes(get_option($admin_option, $admin_option_default));
		$options_data = json_decode($option_raw, true);
		$options_prop = array();

				
		// if (empty($options_data)){
			
			// echo '<pre>';
				// echo '<br/> Data ROW ##'.$admin_option_default.'##<br/>';
			// echo '</pre>';
			
			// echo '<pre>';
				// echo '<br/> Data empty ['.$admin_option.']<br/>';
				
				// echo '<br/>'.$admin_option.' - ';
				// print_r($options_data);
			// echo '</pre>';
			
		// }

		
		 
		foreach($options_data as $key => $item_properties){
			if (!empty($item_properties['value'])){
				$options_prop[$item_properties['name']] = $item_properties['value'];			
			}
		}
		
		unset($options_prop['background-image-preview']);

		
		$result_css = null;
		foreach($options_prop as $item_property => $item_value){
			if ($properties_show){
				$result[$item_property] = $item_value;
			}
			
			switch($item_property){
				case 'font-family':
						$result_css .= "\nfont-family:'".$item_value."', Arial, sans-serif;";
					break;
			
				case 'font-weight':
				
					$italic_array = explode('italic', $item_value);
					
					if (count($italic_array) == 2){
						if ($italic_array[0] != null){
							$result_css .= "\nfont-weight:".$item_value.";";
						}

						$result_css .= "\nfont-style:italic;";
					}else{
						$item_value = str_ireplace('regular', '400', $item_value);
						$result_css .= "\nfont-weight:".$item_value.";";
					}
					break;
					
				case 'background-color':
						$result_css .= "\nbackground-color:".$item_value.";";
					break;
					
				case 'background-repeat':
						$result_css .= "\nbackground-repeat:".$item_value.";";
					break;			
					
				case 'background-position':
						$result_css .= "\nbackground-position:".$item_value.";";
					break;
					
				case 'background-attachment':
						$result_css .= "\nbackground-attachment:".$item_value.";";
					break;					
					
				case 'background-image':
						$result_css .= "\nbackground-image:url('".$item_value."');";
					break;					
					
				case 'background-stretch':
					if ($item_value == 'true'){
						$result_css .= "\nbackground-size:cover;";
					}
					break;
					
				case 'background-pattern':
						$result_css .= "\nbackground-image:url('".$item_value."');";
					break;		
					
				case 'font-italic':
						$result_css .= "\nfont-style:italic;";
					break;
					
			}
		}
		
		if ($properties_show){
			$result['css'] = $result_css;
		}else{
			$result = $result_css;
		}
		
		return $result;
	}


/*
 *	Get font variants
 */
	function ewf_admin_ui_font_getVariants($font){
		global $_ewf_google_fonts;
		
		$font_data = array();
		$fonts_array = json_decode($_ewf_google_fonts, true);

		foreach($fonts_array as $item_index => $item_font){
			if ($item_font['family'] == $font){
				$font_data = $item_font;
			}
		}
		
		return $font_data;
	}


/*
 *	Make a list with all the available fonts (font fonts fropdown)
 */
	function ewf_admin_ui_font_generateList($selection = null){
		global $_ewf_google_fonts_families;

		ob_start();

		foreach($_ewf_google_fonts_families as $index => $font){
			echo '<li>'.$font.'</li>';
		}	

		return ob_get_clean();
	}


/*
 *	Build proper URL for Google Fonts
 */
	function ewf_admin_ui_font_googleurl($font){
		$font = ucwords($font);
		$_body_font_variants = ewf_admin_ui_font_getVariants($font);
		
		$fnt = str_replace(' ', '+', $font);
		$url = 'http://fonts.googleapis.com/css?family='.$fnt.':';
		$var = null;
		
		if (array_key_exists('variants', $_body_font_variants)){
			foreach($_body_font_variants['variants'] as $key => $variant){
				if ($var){
					$var .= ','.$variant;
				}else{
					$var .= $variant;
				}
			}
		}
		
		return $url.$var;
	}
	
	
/*
 *	Get font variants via AJAX on admin font selector
 */
	function ajax_ewf_admin_ui_font_variants(){
		$response = array();
		
		if (array_key_exists('font', $_POST)){
			$font = esc_html($_POST['font']);		
			$font_data = ewf_admin_ui_font_getVariants($font);
					
			$response['state'] = 1;
			$response['variants'] = $font_data['variants'];
			$response['subsets'] = $font_data['subsets'];
		
			echo wp_send_json_success($response);
		
		}else{
			echo wp_send_json_error('Error data check!');
			exit;
		} 
	
	}	

	add_action('wp_ajax_ewf_admin_ui_font_variants', 'ajax_ewf_admin_ui_font_variants' );

	
	
/*
 * 	The active tab from admin options is saved as a theme option
 */
	function ajax_ewf_admin_ui_selectTab(){
		$response = array();
		
		if (array_key_exists('admin_tab', $_POST)){
		
			$admin_tab = filter_var($_POST['admin_tab'] , FILTER_SANITIZE_SPECIAL_CHARS);
			if (update_option(EWF_SETUP_THNAME."_admin_tab_active", $admin_tab)){
				echo wp_send_json_success($response);
				exit;
			}else{
				echo wp_send_json_error('Error saving data!');
				exit;					
			}
			
		}else{
			echo wp_send_json_error('Error data check!');
			exit;		
		}
		
	}

	add_action('wp_ajax_ewf_ui_setTab', 'ajax_ewf_admin_ui_selectTab' );
	
	
/*
 *	Append extra CSS code that the user ads in the theme options
 */
	function ewf_append_css(){
		$css_code = stripslashes_deep(get_option(EWF_SETUP_THNAME."_include_css",null));
		
		if ( $css_code != null){ 
			echo '<style>';
				echo $css_code;
			echo '</style>';
		}
	}
	
	add_action('wp_head', 'ewf_append_css' );
	
	



/*
 *	At page loading check if there's a download request for theme options export file
	function ewf_import_action_contentDownload(){

		// Export requested
		if ( ! empty( $_GET['export-options'] ) ) {

			// Build filename
			$parse_url = parse_url(site_url( '', 'http' ));
			$filename = $parse_url['host'].'-theme-options-['. date('d-M-Y').'].txt';		

			// Generate export file contents
			$file_contents = ewf_import_contentEncode();
			$filesize = strlen( $file_contents );

			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate' );
			header( 'Pragma: public' );
			header( 'Content-Length: ' . $filesize );

			@ob_end_clean();
			flush();

			echo $file_contents;
			
			exit;

		}

	}
	
	add_action( 'init', 'ewf_import_action_contentDownload');
 */


/*
 *	Define a new mime type to store the theme options data
 *	
 *	$param $mime_types - array passed from the filter with current registered mime types
 */
	function ewf_import_filter_addMimeTypes( $mime_types ) {
		$mime_types['txt'] = 'text/plain';

		return $mime_types;
	}

	add_filter( 'upload_mimes', 'ewf_import_filter_addMimeTypes' );	


/*
 *	Upload theme options import data
 */
	function ewf_import_uploadFile() {

		// check_admin_referer prints fail page and dies
		if ( ! empty( $_POST ) && ! empty( $_FILES['ewf_import_file'] ) && check_admin_referer( 'ewf_import', 'ewf_import_nonce' ) ) {  

			$uploaded_file = $_FILES['ewf_import_file'];
			$uploaded_file_type = wp_check_filetype_and_ext( $uploaded_file['tmp_name'], $uploaded_file['name'] );
			
			if ( 'txt' != $uploaded_file_type['ext'] && ! wp_match_mime_types( 'txt', $uploaded_file_type['type'] ) ) {
				echo '<div>'.'<strong>'.'Error: '.'</strong>'.'You must upload a <b>.txt</b> file.'.'</div>';
				
				return false;
			}

			$uploaded_file_data = wp_handle_upload( $uploaded_file, array( 'test_form' => false ));
			if ( isset( $uploaded_file_data['error'] ) ) {
				echo '<div>'.'<strong>'.'Error: '.'</strong>'.$uploaded_file_data['error'].'</div>';
				
				return false;
			}
			
			// echo '<pre>';
				// print_r( $uploaded_file_data );
			// echo '</pre>';

		// }else{
			// echo '<div>'.'<strong>'.'Error: '.'</strong>'.'Something went wrong!'.'</div>';
		}
	}


/*
 *	Get all the current theme options and encode them with base64
 *	
 *	@return string - serialized data
	function ewf_import_contentEncode(){
		global $ewf_admin_options;
	
		$ewf_exportData = array();
		$ewf_exportData_serialized = null;
	
		$tmp_panel = null;
		
		foreach ($ewf_admin_options as $option_index => $option_element){
			if ($option_element['type'] == 'panel' && $option_element['mode'] == 'open'){
				$tmp_panel = $option_element;
			}elseif (array_key_exists('id', $option_element)){
				
				$ewf_exportData['meta']['date'] = date('H:i:s, d M Y');
				$ewf_exportData['meta']['theme'] = EWF_SETUP_THEME_NAME;
				$ewf_exportData['meta']['version'] = EWF_SETUP_THEME_VERSION;

				$ewf_exportData['options']['panels'][$tmp_panel['id']] = $tmp_panel['name'];
				$ewf_exportData['options']['settings'][$tmp_panel['id']][$option_element['id']]['id'] = $option_element['id'];
				$ewf_exportData['options']['settings'][$tmp_panel['id']][$option_element['id']]['std'] = $option_element['std']; 
				
			}
		}
	
		$ewf_exportData_serialized = base64_encode( serialize($ewf_exportData));
		
		return $ewf_exportData_serialized;
		
	}
 */
	
	
	
/*
 *	Add extra body class on front end depending on backend settings
 */
	
	function ewf_frontend_filter_addBodyClass($classes) {
		
		if (get_option(EWF_SETUP_THNAME."_page_layout", 'full-width') == 'boxed-in'){
			$classes[] = 'ewf-boxed-layout';
		}
		
		if (get_option(EWF_SETUP_THNAME."_header_sticky", 'true') == 'true'){
			$classes[] = 'ewf-sticky-header';
		}
		
		return $classes;
	}
	
	add_filter('body_class','ewf_frontend_filter_addBodyClass');




/*
 *	Get the sidebar size in spans
 *	
 *	@param $page_id - is optional, first searches for the current post
 *  @since: 1.4.2
 */
	function ewf_get_sidebarSizes($page_id = null, $custom_sidebar_size = null){
		global $post, $ewf_admin_defaults;
		
		$retun_data = array();
		$page_spans = null;
		$page_type = null;
		$page_blog = false;
		
		if(!$custom_sidebar_size){
			
			//	Get website blog page
			$page_for_posts = get_option('page_for_posts');
			$page_type = 'page';

			
			if ( $page_for_posts == $page_id || ( is_object($post) && ($post->post_type == 'post' || $page_for_posts == $post->ID)) ){
				$page_type = 'blog';
			}elseif(function_exists('is_shop') && (is_shop() || is_cart() || is_account_page() || is_checkout() )){
				$page_type = 'shop';
			}
			
			
			// 	Get span sizes for blog, shop and page
			$sidebar_sizes = array(
				'blog' => get_option(EWF_SETUP_THNAME."_blog_sidebar_size", $ewf_admin_defaults["blog_sidebar_size"]),
				'page' => get_option(EWF_SETUP_THNAME."_page_sidebar_size", $ewf_admin_defaults["page_sidebar_size"]),
				'shop' => get_option(EWF_SETUP_THNAME."_shop_sidebar_size", $ewf_admin_defaults["shop_sidebar_size"]),
			);
			
			
			$page_spans = explode(',', $sidebar_sizes[$page_type]);
		
		}else{
			$page_spans = explode(',', $custom_sidebar_size);
			$retun_data['settings'] = 'custom';
		}
		

		$retun_data['settings'] = $page_type;
		$retun_data['content'] = $page_spans[0]; 
		$retun_data['sidebar'] = $page_spans[1];
		
		return $retun_data;
	}
	
	
	
/*
 *	Load the pages list necessary for 404 page option on theme options
 */
	function ewf_load_site_pages($exclude = null){
		$pages_list = get_pages();
		$pages_return = array(); 
		
		$pages_return[] = array('id' => 0, 'title' => __('Select page', EWF_SETUP_THEME_DOMAIN));
		
		if (is_array($exclude)){
			foreach($pages_list as $current_page){
				if (!array_key_exists($current_page->post_title, $exclude)){
					$pages_return[] = $current_page->post_title;
				}
			}
		}else{
			foreach($pages_list as $current_page){
				$page_title = $current_page->post_title;
				
				if ($page_title == null){
					$page_title = __('No title', EWF_SETUP_THEME_DOMAIN).' (id: '.$current_page->ID.')';
				}
				
				$pages_return[] = array( 'id' => $current_page->ID, 'title'=> $page_title );
			} 
		}
		
		return $pages_return;
	}
	
	
	
	
	/* 	
	 *	Temporary Removed
	
	
	
	function ewf_admin_ui_font_os() {
	
		$os_faces = array(
			'Arial, sans-serif' => 'Arial',
			'"Avant Garde", sans-serif' => 'Avant Garde',
			'Cambria, Georgia, serif' => 'Cambria',
			'Copse, sans-serif' => 'Copse',
			'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
			'Georgia, serif' => 'Georgia',
			'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
			'Tahoma, Geneva, sans-serif' => 'Tahoma'
		);
		
		return $os_faces;
	}
	
	
	function ewf_load_skins(){
		$themeSkins_full = array();
		$themeSkins_opt = array();
		
		$dir = opendir($themePath);
		while ($dir && ($file = readdir($dir)) !== false) {
			if (strtolower(pathinfo($file, PATHINFO_EXTENSION))== "css"){
				$skinName = str_replace(array('-', '_', '#'), ' ', pathinfo($file, PATHINFO_FILENAME));
				$skinName = ucwords(strtolower($skinName));
				
				$themeSkins_full[$skinName] = $file;
				$themeSkins_opt[] = $skinName;
		  }
		}
		
		foreach($themeSkins_full as $key=>$value){
			apply_filters("debug", "Skin: $key - ".$value);
		} 
		
		return array('full'=>$themeSkins_full, 'options'=>$themeSkins_opt);
	}
	
	*/






?>