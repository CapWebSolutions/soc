<?php

#
#	Set the number of columns on the shop
#	
	if (!function_exists('ewf_wooshop_columns_full')) {
		
		function ewf_wooshop_columns_full() {
			return 4;
		} 

		function ewf_wooshop_columns_sidebar() {
			return 3;
		} 	
	
	}
	
	
	add_filter('woocommerce_show_page_title', 'ewf_remove_shop_title');
	
	function ewf_remove_shop_title (){
		if (is_shop()){
			return false;
		}

		return true;
	}
	
	
#
#	Update the number of items on the cart Icon in header
#
	add_action('wp_ajax_ewf_wooshop_update'				, 'ewf_wooshop_quantity_update');
	add_action('wp_ajax_nopriv_ewf_wooshop_update'		, 'ewf_wooshop_quantity_update');
	
	function ewf_wooshop_quantity_update(){
		global $woocommerce;
		
		$cart_qty = $woocommerce->cart->get_cart_contents_count();
		
		wp_send_json_success(array('quantity' => $cart_qty));
	}

	

#
#	Load the number of items specified on theme admin
#
	$ewf_shop_items = intval(get_option(EWF_SETUP_THNAME."_shop_items", $ewf_admin_defaults["shop_items"]));
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$ewf_shop_items.';' ), 20 );