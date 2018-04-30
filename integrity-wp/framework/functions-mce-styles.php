<?php



#	Attach functions to filters
#
	add_action( 'init'  										, 'ewf_loat_tinyMCE_style');
	add_filter( 'tiny_mce_before_init'							, 'ewf_load_mce_styles' );
	add_filter( 'mce_buttons_2'									, 'my_mce_buttons_2' );


	function  ewf_loat_tinyMCE_style() {
		add_editor_style ( get_template_directory_uri().'/layout/css/fontawesome/font-awesome.min.css');
		add_editor_style ( get_template_directory_uri().'/layout/css/iconfontcustom/icon-font-custom.css');
		add_editor_style ( get_template_directory_uri().'/layout/css/mce.css');
	}
	
	
#	Show the style dropdown by default
#
	function my_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	

#	Attach new styles to dropdown
#
	function ewf_load_mce_styles( $settings ) {

		$style_formats = array( 
			// array(
				// 'title' => 'Highlight',
				// 'selector' => '*',
				// 'attributes' => array( 'classes' => 'text-highlight')
			// ),
			// array(
				// 'title' => 'Uppercase',
				// 'selector' => '*',
				// 'attributes' => array( 'classes' => 'text-uppercase')
			// ),
			// array(
				// 'title' => 'Mute',
				// 'selector' => '*',
				// 'attributes' => array( 'classes' => 'mute')
			// ),
			array(
				'title' => 'List - Unstyled',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'unstyled')
			),
			array(
				'title' => 'List - Check',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'check')
			),	
			array(
				'title' => 'List - Square Check',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'square-check')
			),	
			array(
				'title' => 'List - Square',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'square')
			),
			array(
				'title' => 'List - Circle',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'fill-circle')
			),
			array(
				'title' => 'List - Diamond',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'diamond')
			),
		);

		$settings['style_formats'] = json_encode( $style_formats );
		return $settings;
		
	}


?>