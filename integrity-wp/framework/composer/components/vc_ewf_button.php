<?php

	global $ewf_composer_class, $ewf_composer_class_field;


	add_shortcode( 'ewf-button', 'ewf_vc_button' );
	
	function ewf_vc_button( $atts, $content ) {
		extract( shortcode_atts( array(
			'title' => __("Sample title", EWF_SETUP_THEME_DOMAIN),
			'url' => '#',
			'icon' => null,
			'icon_pos' => 'left',
			'style' => 'btn',
			'border_color' => '#3382b8',
			'color' => '#4fb7ff',
			'color_text' => '#ffffff',
			'size' => 'small',
			'align' => 'text-left',
			'css' => null,
			'link' => null
		), $atts ) );
		
		$link = vc_build_link($link); 
		$class_extra = null;
		$attr_target = null;
		$custom_color = null;
		$border_color_css = null;
		
		if ($link['target'] != null){
			$attr_target .= ' target="_black" ';		
		}
		
		if ($border_color && $style == "btn-custom"){
			$border_color_css = 'border:1px solid '.$border_color.';';
		}
		
		switch($style){
			
			case 'btn-black':
				$class_extra .= ' '.$style;
				break;
				
			case 'btn-white':
				$class_extra .= ' '.$style;
				break;
		
			case 'btn-green-dark':
				$class_extra .= ' '.$style;
				break;		
				
			case 'btn-green-light':
				$class_extra .= ' '.$style;
				break;
				
			case 'btn-custom':
				$class_extra .= ' '.$style;
				$custom_color .= 'background-color:'.$color.';color:'.$color_text.';';
				break;
			
			default:
				$class_extra .= null;
				break;
		}

		if ($size == 'large') { $class_extra .= ' btn-large'; }
		if ($css) { $class_extra .= ' '.$css; }
		
		// if ($icon_pos == 'left') { $class_extra .= ' btn-icon-left'; }else{ $class_extra .= ' btn-icon-right'; }
		
		
		
		$src = '<a href="'.$link['url'].'" class="btn '.$class_extra.'" style="'.$custom_color.$border_color_css.'" '.$attr_target.' >';
			if ($icon_pos == 'left'){
				if ($icon){	$src .= '<i class="'.$icon.' icon-left"></i>'; }
				$src .= $link['title'];
			}else{
				$src .= $link['title'];
				if ($icon){	$src .= '<i class="'.$icon.' icon-right"></i>'; }
			}		
		$src .=  '</a>';
		
		
		if ($align != 'text-left'){
			$src = '<p class="'.$align.'">'.$src.'</p>';
		}
		
		return $src;
	}

	

	
	vc_map( array(
	   "name" => __("Button", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-button",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-button",
	   "description" => __("Customizable button with text and icon", EWF_SETUP_THEME_DOMAIN),  
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		  array(
			"type" => "vc_link",
			"holder" => "div",
			"class" => "",
			"heading" => __("Link title & URL", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "link",
			"value" => null,
			"description" => __("Specify the link pointing to another page", EWF_SETUP_THEME_DOMAIN) 
		  ),
		  array(
			"type" => "ewf-icon",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "icon",
			"value" => null,
			"description" => __("Select the icon you want", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon position", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "icon_pos",
			"value" => array(
				__('Left', EWF_SETUP_THEME_DOMAIN) => 'left', 
				__('Right', EWF_SETUP_THEME_DOMAIN) => 'right' 
				),
			"description" => __("Specify the position of the icon", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"group" => __("Design options", EWF_SETUP_THEME_DOMAIN),
			"heading" => __("Button Color", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "style",
			"value" => array(
				__('Default', EWF_SETUP_THEME_DOMAIN) => 'btn', 
				__('Black', EWF_SETUP_THEME_DOMAIN) => 'btn-black', 
				__('White', EWF_SETUP_THEME_DOMAIN) => 'btn-white', 
				__('Custom color', EWF_SETUP_THEME_DOMAIN) => 'btn-custom'
			),
			"description" => __("Specify the type size of the button", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"group" => __("Design options", EWF_SETUP_THEME_DOMAIN),
			"heading" => __("Button Border Color", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "border_color",
			"value" => '#3382b8',
			"description" => __("Select the border color", EWF_SETUP_THEME_DOMAIN),
			"dependency" => array( "element" => "style","value" => array("btn-custom"))
		  ),
		  array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"group" => __("Design options", EWF_SETUP_THEME_DOMAIN),
			"heading" => __("Button Background Color", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "color",
			"value" => '#4fb7ff',
			"description" => __("Select the color of the text on button", EWF_SETUP_THEME_DOMAIN),
			"dependency" => array( "element" => "style","value" => array("btn-custom") )
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "group" => __("Design options", EWF_SETUP_THEME_DOMAIN),
			 "heading" => __("Button Text Color", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "color_text",
			 "value" => '#ffffff',
			 "description" => __("Select the color of the button", EWF_SETUP_THEME_DOMAIN),
			 "dependency" => array("element" => "style","value" => array("btn-custom"))
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Size", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "size",
			 "value" => array( 
				__('Small', EWF_SETUP_THEME_DOMAIN) => 'small', 
				__('Large', EWF_SETUP_THEME_DOMAIN) => 'large'
			),
			 "description" => __("Specify the type size of the button", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Alignment", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "align",
			 "value" => array( 
				__('Left', EWF_SETUP_THEME_DOMAIN) => 'text-left', 
				__('Center', EWF_SETUP_THEME_DOMAIN) => 'text-center',
				__('Right', EWF_SETUP_THEME_DOMAIN) => 'text-right'
			),
			 "description" => __("Align the button on left, center or right", EWF_SETUP_THEME_DOMAIN)
		  )
	   )));

?>