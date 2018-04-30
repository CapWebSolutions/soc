<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">

<?php

$favicon = ewf_get_option_UIImage(EWF_SETUP_THNAME."_favicon");
$favicon_retina = ewf_get_option_UIImage(EWF_SETUP_THNAME."_favicon_retina");

echo '<link rel="shortcut icon" href="'.$favicon.'" />';
echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.$favicon_retina.'" />';

?>

<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>> 
	
	<div id="wrap">

		<?php 
		#	Check if is a blank page template
		
			$page_blank = ewf_is_page_blank();
			
			if (!$page_blank){ 
		?>
	
		<div id="header-top">
		
		<!-- /// HEADER TOP  //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
			<div class="container">
				<div class="row">
					<div class="span5" id="header-top-widget-area-1">
					<?php
						
						if (is_active_sidebar('header-left')){
							dynamic_sidebar('header-left');
						}else{
							echo __('Header widget area left', EWF_SETUP_THEME_DOMAIN);
						}
						
					?>
					</div><!-- end .span5 -->

					<?php
						
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
						
						if (is_plugin_active('woocommerce/woocommerce.php')){
						
							global $woocommerce;
							
							$cart_qty = $woocommerce->cart->get_cart_contents_count();
							$total = $woocommerce->cart->get_cart_total();
							$cart_url = $woocommerce->cart->get_cart_url();
							$cart_class = 'fa fa-shopping-cart';
						
							echo '<div class="ewf-shopping-cart-placeholder">';
								echo '<a href="'.$cart_url.'" class="ewf-shop-cart"><i class="'.$cart_class.'"></i>';
									echo '<span>'.$cart_qty.'</span>';
								echo '</a>';
							echo '</div>';
						
						}

					?>
					
					<div class="span7" id="header-top-widget-area-2">
					<?php
						
						if (is_active_sidebar('header-right')){
							dynamic_sidebar('header-right');
						}else{
							echo __('Header widget area right', EWF_SETUP_THEME_DOMAIN);
						}
						 
					?>
					
					</div><!-- end .span7 -->
				</div><!-- end .row -->
			</div><!-- end .container-->
			
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			
		</div><!-- end #header-top -->
	
		<div id="header-wrap">
		
			<div id="header"> 
			
			<!-- /// HEADER  //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

				<div class="container">
					<div class="row">
						<div class="span3">
							
							<!-- // Logo // -->
							<?php 
											
								$logo_url = ewf_get_option_UIImage(EWF_SETUP_THNAME."_logo_url");
								
								echo '<a href="'.get_home_url().'" id="logo">
										<img class="responsive-img" src="'.$logo_url.'" alt="">
									</a><!-- end #logo -->';
									
							?>
							
						</div><!-- end .span3 -->
						
						<div class="span9">
						
							<a id="mobile-menu-trigger" href="#">
								<i class="fa fa-bars"></i>
							</a>					
							
							<?php
								
								if (get_option(EWF_SETUP_THNAME."_header_search", 'false') != 'false'){
									echo '<!-- // Custom search // -->';
									echo '<form action="'.get_site_url().'/" id="custom-search-form" method="get" role="search">';
										echo '<input type="text" value="" name="s" id="s" placeholder="'.__('type and press enter to search...', EWF_SETUP_THEME_DOMAIN).'">';
										echo '<input type="submit" id="custom-search-submit" value="">'; 
									echo '</form>'; 
									
									echo '<a id="custom-search-button" href="#"></a>';
								} 
							
							?>
							
							<!-- // Menu // -->
							<?php  	do_action('ewf-menu-top'); ?>
											
						</div><!-- end .span9 -->
					</div><!-- end .row -->		
				</div><!-- end .container -->		

			<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

			</div><!-- end #header -->
		</div>
		
		<?php 
			
		#	Check if is a blank page template
		
			} 
		?>
		
		<div id="content">

		<!-- /// CONTENT  //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
		<?php	
			
			if (!$page_blank){ 
				
				#	Load page header
				#				
				get_template_part('framework/modules/ewf-header/templates/page-header');  
		
			}
		
		?>
	