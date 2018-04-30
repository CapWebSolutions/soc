<?php

	add_shortcode( 'ewf-countdown', 'ewf_vc_countdown' );
	
	
	function ewf_vc_countdown( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'st_days' 		=> __("days", EWF_SETUP_THEME_DOMAIN),
		  'st_day' 			=> __("day", EWF_SETUP_THEME_DOMAIN),
		  'st_hours' 		=> __("hours", EWF_SETUP_THEME_DOMAIN),
		  'st_hour' 		=> __("hour", EWF_SETUP_THEME_DOMAIN),
		  'st_minutes'		=> __("minutes", EWF_SETUP_THEME_DOMAIN),
		  'st_minute' 		=> __("minute", EWF_SETUP_THEME_DOMAIN),
		  'st_seconds'		=> __("seconds", EWF_SETUP_THEME_DOMAIN),
		  'st_second' 		=> __("second", EWF_SETUP_THEME_DOMAIN),
		  'date' 			=> '',
		  'css' 			=> ''
	   ), $atts ) );
	   
	   $class_extra = ' '.$css;
	   
		ob_start();
		
		if ($date){
			echo '<div class="ewf-countdown" data-st-days="' . $st_days . '" data-st-day="' . $st_day . '" data-st-hours="' . $st_hours . '" data-st-hour="' . $st_hour . '" data-st-minutes="' . $st_minutes . '" data-st-minute="' . $st_minute . '" data-st-seconds="' . $st_seconds . '" data-st-second="' . $st_second . '" data-countdown="' . $date . '"></div>';
		}
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Countdown", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-countdown",
	   "class" => "",
	   "category" => EWF_SETUP_VC_GROUP,
	   "icon" => "icon-wpb-ewf-countdown",
	   // "description" => __("Image and link", EWF_SETUP_THEME_DOMAIN),  
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Countdown date", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "date",
			 "value" => '',
			 "description" => __("The date should have this form: <strong>mmmm, dd, yyyy hh:mm:ss</strong>", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Days Text (plural)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_days",
			 "value" => __("days", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Day Text (singluar)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_day",
			 "value" => __("day", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Hours Text (plural)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_hours",
			 "value" => __("hours", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Hour Text (singluar)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_hour",
			 "value" => __("hour", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Minutes Text (plural)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_minutes",
			 "value" => __("minutes", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Minute Text (singluar)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_minute",
			 "value" => __("minute", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Seconds Text (plural)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_seconds",
			 "value" => __("seconds", EWF_SETUP_THEME_DOMAIN),
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "group" => "Strings",
			 "heading" => __("Second Text (singluar)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "st_second",
			 "value" => __("second", EWF_SETUP_THEME_DOMAIN),
		  ),
	   )
	));


?>