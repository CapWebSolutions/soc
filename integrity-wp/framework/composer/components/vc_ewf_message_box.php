<?php

	add_shortcode( 'ewf-message', 'ewf_vc_message' );
	
	$_ewf_alert_type = array(
		'info' => array(
			'title' => __('Info', EWF_SETUP_THEME_DOMAIN),
			'icon' => 'ifc-info',
			'class' => 'info'
		),
		'success' => array(
			'title' => __('Success', EWF_SETUP_THEME_DOMAIN),
			'icon' => 'ifc-checkmark',
			'class' => 'success'
		),
		'warning' => array(
			'title' => __('Warning', EWF_SETUP_THEME_DOMAIN),
			'icon' => 'ifc-error',
			'class' => 'warning'
		),
		'error' => array(
			'title' => __('Error', EWF_SETUP_THEME_DOMAIN),
			'icon' => 'ifc-close',
			'class' => 'error'
		),
		'default' => array(
			'title' => __('Default', EWF_SETUP_THEME_DOMAIN),
			'icon' => '',
			'class' => 'default'
		),
	);
		
	function ewf_vc_message( $atts, $content ) {
	
		$_ewf_alert_type = array(
			'info' => array(
				'title' => __('Info', EWF_SETUP_THEME_DOMAIN),
				'icon' => 'ifc-info',
				'class' => 'info'
			),
			'success' => array(
				'title' => __('Success', EWF_SETUP_THEME_DOMAIN),
				'icon' => 'ifc-checkmark',
				'class' => 'success'
			),
			'warning' => array(
				'title' => __('Warning', EWF_SETUP_THEME_DOMAIN),
				'icon' => 'ifc-error',
				'class' => 'warning'
			),
			'error' => array(
				'title' => __('Error', EWF_SETUP_THEME_DOMAIN),
				'icon' => 'ifc-close',
				'class' => 'error'
			),
			'default' => array(
				'title' => __('Default', EWF_SETUP_THEME_DOMAIN),
				'icon' => '',
				'class' => 'default'
			),
		);
		
		extract( shortcode_atts( array(
			'height' => 10,
			'type' => 'error',
			'css' => null
		), $atts ) );
	 		
		$class_extra = ' '.$css;
	
		$src = '<div data-type="'.$type.'" class="alert '.$_ewf_alert_type[$type]['class'].$class_extra.'">';
		if ($_ewf_alert_type[$type]['icon']){
			$src .= '<i class="fa '.$_ewf_alert_type[$type]['icon'].'"></i>';
		}
		$src .= $content.'</div>';
		
		return $src;
	}

	
	vc_map( array(
	   "name" => __("Message box", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-message",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-message",
	   "description" => __("Use to display notices, warnings, alerts", EWF_SETUP_THEME_DOMAIN),  
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Message type", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "type",
			 "value" => array($_ewf_alert_type['info']['title'] => $_ewf_alert_type['info']['class'], $_ewf_alert_type['error']['title'] => $_ewf_alert_type['error']['class'], $_ewf_alert_type['warning']['title'] => $_ewf_alert_type['warning']['class'], $_ewf_alert_type['success']['title'] => $_ewf_alert_type['success']['class'], $_ewf_alert_type['default']['title'] => $_ewf_alert_type['default']['class'] ),
			 "description" => __("Specify", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Message", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "content",
			 "value" => null,
			 "description" => __("Specify the content of the message", EWF_SETUP_THEME_DOMAIN)
		  ),
	   )
	));

?>