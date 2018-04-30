<?php

	add_shortcode( 'ewf_animation', 'ewf_vc_animation' );


	function ewf_vc_animation( $atts, $content ) {
		extract( shortcode_atts( array(
			'an_style' => null,
			'an_speed' => null,
			'an_delay' => null,
			'an_offset'=> null,
			'el_class' => null,
		), $atts ) );
		
		$attr_extra = null;
		$class_extra = null;
		
		if ($el_class){
			$class_extra = ' '.$el_class;
		}
		
		if ($an_style){
			$attr_extra .= ' data-animation="'.$an_style.'"';
		}
		
		if ($an_speed){
			$attr_extra .= ' data-animation-speed="'.$an_speed.'"';
		}
		
		if ($an_offset){
			$attr_extra .= ' data-animation-offset="'.$an_offset.'"';
		}
		
		if ($an_delay){
			$attr_extra .= ' data-animation-delay="'.$an_delay.'"';
		}
		
		return '<div class="animate fixed'.$class_extra.'"'.$attr_extra.'>'.do_shortcode($content).'</div>';
	}

	
	
	vc_map( array(
		"name" => __("Animation", EWF_SETUP_THEME_DOMAIN),
		"base" => "ewf_animation",
		"as_parent" => array('except' => 'ewf_timeline_item'),
		"content_element" => true,
		"icon" => "icon-wpb-ewf-animation",
		"description" => __("Animate a number of elements however you wish", EWF_SETUP_THEME_DOMAIN),  
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				// "group" => __("Design options", EWF_SETUP_THEME_DOMAIN),
				"heading" => __("Animation style", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "an_style",
				"value" => array(
				__('Bounce'					, EWF_SETUP_THEME_DOMAIN) => 'bounce', 
				__('Flash'					, EWF_SETUP_THEME_DOMAIN) => 'flash', 
				__('Pulse'					, EWF_SETUP_THEME_DOMAIN) => 'pulse', 
				__('Rubber Band'			, EWF_SETUP_THEME_DOMAIN) => 'rubberBand', 
				__('Snake'					, EWF_SETUP_THEME_DOMAIN) => 'shake', 
				__('Swing'					, EWF_SETUP_THEME_DOMAIN) => 'swing', 
				__('Tada'					, EWF_SETUP_THEME_DOMAIN) => 'tada', 
				__('Wobble'					, EWF_SETUP_THEME_DOMAIN) => 'wobble', 
				__('Bounce In'				, EWF_SETUP_THEME_DOMAIN) => 'bounceIn', 
				__('Bounce In Down'			, EWF_SETUP_THEME_DOMAIN) => 'bounceInDown', 
				__('Bounce In Left'			, EWF_SETUP_THEME_DOMAIN) => 'bounceInLeft', 
				__('Bounce In Right'		, EWF_SETUP_THEME_DOMAIN) => 'bounceInRight', 
				__('Bounce In Up'			, EWF_SETUP_THEME_DOMAIN) => 'bounceInUp', 
				__('Bounce Out'				, EWF_SETUP_THEME_DOMAIN) => 'bounceOut', 
				__('Bounce Out Down'		, EWF_SETUP_THEME_DOMAIN) => 'bounceOutDown', 
				__('Bounce Out Left'		, EWF_SETUP_THEME_DOMAIN) => 'bounceOutLeft', 
				__('Bounce Out Right'		, EWF_SETUP_THEME_DOMAIN) => 'bounceOutRight', 
				__('Bounce Out Up'			, EWF_SETUP_THEME_DOMAIN) => 'bounceOutUp', 
				__('Fade In'				, EWF_SETUP_THEME_DOMAIN) => 'fadeIn', 
				__('Fade In Down'			, EWF_SETUP_THEME_DOMAIN) => 'fadeInDown', 
				__('Fade In Down Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeInDownBig', 
				__('Fade In Left'			, EWF_SETUP_THEME_DOMAIN) => 'fadeInLeft', 
				__('Fade In Left Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeInLeftBig', 
				__('Fade In Right'			, EWF_SETUP_THEME_DOMAIN) => 'fadeInRight', 
				__('Fade In Right Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeInRightBig', 
				__('Fade In Up'				, EWF_SETUP_THEME_DOMAIN) => 'fadeInUp', 
				__('Fade In Up Big'			, EWF_SETUP_THEME_DOMAIN) => 'fadeInUpBig', 
				__('Fade Out'				, EWF_SETUP_THEME_DOMAIN) => 'fadeOut', 
				__('Fade Out Down'			, EWF_SETUP_THEME_DOMAIN) => 'fadeOutDown', 
				__('Fade Out Down Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeOutDownBig', 
				__('Fade Out Left'			, EWF_SETUP_THEME_DOMAIN) => 'fadeOutLeft', 
				__('Fade Out Left Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeOutLeftBig', 
				__('Fade Out Right'			, EWF_SETUP_THEME_DOMAIN) => 'fadeOutRight', 
				__('Fade Out Right Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeOutRightBig', 
				__('Fade Out Up'			, EWF_SETUP_THEME_DOMAIN) => 'fadeOutUp', 
				__('Fade Out Up Big'		, EWF_SETUP_THEME_DOMAIN) => 'fadeOutUpBig', 
				__('Flip InX'				, EWF_SETUP_THEME_DOMAIN) => 'flipInX', 
				__('Flip InY'				, EWF_SETUP_THEME_DOMAIN) => 'flipInY', 
				__('Flip OutX'				, EWF_SETUP_THEME_DOMAIN) => 'flipOutX', 
				__('Flip OutY'				, EWF_SETUP_THEME_DOMAIN) => 'flipOutY', 
				__('Light Speed In'			, EWF_SETUP_THEME_DOMAIN) => 'lightSpeedIn', 
				__('Light Speed Out'		, EWF_SETUP_THEME_DOMAIN) => 'lightSpeedOut', 
				__('Rotate In'				, EWF_SETUP_THEME_DOMAIN) => 'rotateIn', 
				__('Rotate In Down Left'	, EWF_SETUP_THEME_DOMAIN) => 'rotateInDownLeft', 
				__('Rotate In Down Right'	, EWF_SETUP_THEME_DOMAIN) => 'rotateInDownRight', 
				__('Rotate In Up Left'		, EWF_SETUP_THEME_DOMAIN) => 'rotateInUpLeft', 
				__('Rotate In Up Right'		, EWF_SETUP_THEME_DOMAIN) => 'rotateInUpRight', 
				__('Rotate Out'				, EWF_SETUP_THEME_DOMAIN) => 'rotateOut', 
				__('Rotate Out Down Left'	, EWF_SETUP_THEME_DOMAIN) => 'rotateOutDownLeft', 
				__('Rotate Out Down Righ'	, EWF_SETUP_THEME_DOMAIN) => 'rotateOutDownRight', 
				__('Rotate Out Up Left'		, EWF_SETUP_THEME_DOMAIN) => 'rotateOutUpLeft', 
				__('Rotate Out Up Right'	, EWF_SETUP_THEME_DOMAIN) => 'rotateOutUpRight', 
				__('Hinge'					, EWF_SETUP_THEME_DOMAIN) => 'hinge', 
				__('Roll In'				, EWF_SETUP_THEME_DOMAIN) => 'rollIn', 
				__('Roll Out'				, EWF_SETUP_THEME_DOMAIN) => 'rollOut', 
				__('Zoom In'				, EWF_SETUP_THEME_DOMAIN) => 'zoomIn', 
				__('Zoom In Down'			, EWF_SETUP_THEME_DOMAIN) => 'zoomInDown', 
				__('Zoom In Left'			, EWF_SETUP_THEME_DOMAIN) => 'zoomInLeft', 
				__('Zoom In Right'			, EWF_SETUP_THEME_DOMAIN) => 'zoomInRight', 
				__('Zoom In Up'				, EWF_SETUP_THEME_DOMAIN) => 'zoomInUp', 
				__('Zoom Out'				, EWF_SETUP_THEME_DOMAIN) => 'zoomOut', 
				__('Zoom Out Down'			, EWF_SETUP_THEME_DOMAIN) => 'zoomOutDown', 
				__('Zoom Out Left'			, EWF_SETUP_THEME_DOMAIN) => 'zoomOutLeft', 
				__('Zoom Out Right'			, EWF_SETUP_THEME_DOMAIN) => 'zoomOutRight', 
				__('Zoom Out Up'			, EWF_SETUP_THEME_DOMAIN) => 'zoomOutUp', 
				__('Slide In Down'			, EWF_SETUP_THEME_DOMAIN) => 'slideInDown', 
				__('Slide In Left'			, EWF_SETUP_THEME_DOMAIN) => 'slideInLeft', 
				__('Slide In Right'			, EWF_SETUP_THEME_DOMAIN) => 'slideInRight', 
				__('Slide In Up'			, EWF_SETUP_THEME_DOMAIN) => 'slideInUp', 
				__('Slide Out Down'			, EWF_SETUP_THEME_DOMAIN) => 'slideOutDown', 
				__('Slide Out Left'			, EWF_SETUP_THEME_DOMAIN) => 'slideOutLeft', 
				__('Slide Out Right'		, EWF_SETUP_THEME_DOMAIN) => 'slideOutRight', 
				__('Slide Out Up'			, EWF_SETUP_THEME_DOMAIN) => 'slideOutUp',
			),
			"description" => __("Choose the animation style you want", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"heading" => __("Delay", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "an_delay",
				"description" => __("Time delay from when you reach the component to when the animation starts. Value in milliseconds, default 0", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"heading" => __("Speed", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "an_speed",
				"description" => __("How fast should the animation take place. Value in milliseconds, default 1000", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"heading" => __("Offset", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "an_offset",
				"description" => __("Add an animation offset. Value in percentages, default 90%", EWF_SETUP_THEME_DOMAIN)
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", EWF_SETUP_THEME_DOMAIN),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", EWF_SETUP_THEME_DOMAIN)
				)
			),
		"js_view" => 'VcColumnView'
	) );
	
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_ewf_animation extends WPBakeryShortCodesContainer {
		}
	}
	


?>