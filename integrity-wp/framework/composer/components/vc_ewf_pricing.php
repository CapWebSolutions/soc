<?php


	add_shortcode( 'ewf-pricing-item', 'ewf_vc_pricing_item' );
	
	
	function ewf_vc_pricing_item( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'plan' => __('Starter edition',EWF_SETUP_THEME_DOMAIN),
		  'cost' => '30',
		  'currency' => '$',
		  'description' => '&nbsp;',
		  'division' => '99',
		  'icon' => '',
		  'options' => '',
		  'period' => '&nbsp;',
		  'link' => '#',
		  'css' => ''
	   ), $atts ) );
	 
		$link = vc_build_link($link); 
		$class_extra = ' '.$css;
	 
		ob_start();
		
		
		
		echo '<div class="pricing-table'.$class_extra.'">';
			
			echo '<div class="pricing-table-header">';
			
				echo '<h4>'.$plan.'</h4>';
				
				if ($description){
					echo '<h6>'.$description.'</h6>';
				}
			
				if ($icon){
					echo '<i class="'.$icon.'"></i>';
				}
			echo '</div><!-- end .pricing-table-header -->';
				
		    echo '<h1>' . 
					'<span>' . $currency . '</span> ' . $cost;
					// $cost . '<sup>'.$division.'</sup>' .
					// if ($period){ }
					echo '<small>'.$period.'</small>';
					
			echo '</h1>';
				
			
			echo '<div class="pricing-table-offer">';
			echo '<ul>';
				$all_options = explode (',', $options);
				
				foreach($all_options as $index => $option_item){
					echo '<li>'.$option_item.'</li>';
				}
				
			echo '</ul>';
			echo '</div>';
			
			if ($link['title'] != ''){
				echo '<a class="btn" href="'.$link['url'].'">'.$link['title'].'</a>';
			}
			
		echo '</div>';

		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Pricing Table", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-pricing-item",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-pricing-item",
	   // "description" => __("Shows a pricing table row", EWF_SETUP_THEME_DOMAIN),  
	   "category" => EWF_SETUP_VC_GROUP,
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan name", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "plan",
			 "value" => __('Starter edition',EWF_SETUP_THEME_DOMAIN),
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan description", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "description",
			 "value" => '',
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  // array(
			 // "type" => "ewf-icon",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "icon",
			 // "value" => '',
			 // "description" => __("Select the icon you want to have asside plan name", EWF_SETUP_THEME_DOMAIN)
		  // ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Cost", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "cost",
			 "value" => '30',
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  // array(
			 // "type" => "textfield",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Division", EWF_SETUP_THEME_DOMAIN),
			 // "param_name" => "division",
			 // "value" => '99',
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  // ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Currency", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "currency",
			 "value" => '$',
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Period", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "period",
			 "value" => __('monthly',EWF_SETUP_THEME_DOMAIN)
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),		  
		  array(
			 "type" => "exploded_textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Plan features (add one per line)", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "options",
			 "value" => ''
			 // "description" => __("The final value will animate to, from 0 to the number provided by you", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "vc_link",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Read more button", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "link",
			 "value" => '#',
			 "description" => __("Specify an optional link pointing to a details page", EWF_SETUP_THEME_DOMAIN) 
		  )
	   )
	));



?>