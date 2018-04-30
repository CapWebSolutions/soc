
		<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		</div><!-- end #content -->

		<?php
		#	Check if is a blank page template

			$page_blank = ewf_is_page_blank();
			$data_footer = null;

			if (!$page_blank){
		?>

		<?php
			global $ewf_admin_defaults;

			/*
			$ewf_footer_top = get_option(EWF_SETUP_THNAME."_footer_top", "true");
			$ewf_footer_top_layout = get_option(EWF_SETUP_THNAME."_footer_top_columns", $ewf_admin_defaults['footer_top_columns']);
			$ewf_footer_top_layout_spans = explode(',', $ewf_footer_top_layout );

			if ($ewf_footer_top == "true") {

				echo '<div id="footer-top">';
				echo '<!-- /// FOOTER TOP  ///////////////////////////////////////////////////////////////////////////////////////////////////// -->';

					echo '<div class="container">';
						echo '<div class="row">';
						foreach($ewf_footer_top_layout_spans as $index => $col_span){
							echo '<div class="span'.$col_span.'" id="footer-top-widget-area-'.($index+1).'">';

								if (is_active_sidebar('footer-top-widgets-'.($index+1))){
									dynamic_sidebar('footer-top-widgets-'.($index+1));
								}else{
									echo __("Footer top widget area", EWF_SETUP_THEME_DOMAIN).' '.($index+1);
								}

							echo '</div>';
						}
						echo '</div>';
					echo '</div>';


				echo '<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->';
				echo '</div>';

			}
			*/
		?>


		<?php

			$ewf_footer = get_option(EWF_SETUP_THNAME."_footer_section", "true");

			if ($ewf_footer == "true") {
				echo '<div id="footer">';
				echo '<!-- /// FOOTER     ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->';

					$ewf_footer_layout = get_option(EWF_SETUP_THNAME."_footer_columns", $ewf_admin_defaults['footer_columns']);
					$ewf_footer_layout_spans = explode(',', $ewf_footer_layout );

						echo '<div class="container">';
							echo '<div class="row">';
							foreach($ewf_footer_layout_spans as $index => $col_span){
								echo '<div class="span'.$col_span.'" id="footer-middle-widget-area-'.($index+1).'">';

									if (is_active_sidebar('footer-widgets-'.($index+1))){
										dynamic_sidebar('footer-widgets-'.($index+1));
									}else{
										echo __("Footer middle widget area", EWF_SETUP_THEME_DOMAIN).' '.($index+1);
									}

								echo '</div>';
							}
							echo '</div>';
						echo '</div>';


				echo '<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->';
				echo '</div><!-- end #footer -->';
			}

		?>

		<?php

			$ewf_footer_bottom = get_option(EWF_SETUP_THNAME."_footer_bottom", "true");
			$ewf_footer_bottom_layout = get_option(EWF_SETUP_THNAME."_footer_bottom_columns", $ewf_admin_defaults['footer_bottom_columns']);
			$ewf_footer_bottom_layout_spans = explode(',', $ewf_footer_bottom_layout );

			if ($ewf_footer_bottom == "true") {

				echo '<div id="footer-bottom">';
				echo '<!-- /// FOOTER BOTTOM  ///////////////////////////////////////////////////////////////////////////////////////////////////// -->';

					echo '<div class="container">';
						echo '<div class="row">';
						foreach($ewf_footer_bottom_layout_spans as $index => $col_span){
							echo '<div class="span'.$col_span.'" id="footer-bottom-widget-area-'.($index+1).'">';

								if (is_active_sidebar('footer-bottom-widgets-'.($index+1))){
									dynamic_sidebar('footer-bottom-widgets-'.($index+1));
								}else{
									echo __("Footer bottom widget area", EWF_SETUP_THEME_DOMAIN).' '.($index+1);
								}

							echo '</div>';
						}
						echo cws_copyright() . ' Systems of Change LLC';
						echo '</div>';
					echo '</div>';


				echo '<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->';
				echo '</div>';

			}

		?>
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		<?php

		#	Check if is a blank page template

			}
		?>

	</div><!-- end #wrap -->

	<?php

		if (get_option(EWF_SETUP_THNAME."_backtotop_button", 'true') == 'true' && !$page_blank){
			echo '<a id="back-to-top" href="#">
				<i class="ifc-up4"></i>
			</a>';
		}

	?>

	<?php wp_footer(); ?>

</body>
</html>
