<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles() 
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

}
/**
 * This is a function to automatically plug the date of first post into footer.
 * 
 * @package CWS Core Functionality
 * @since   1.0.0
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * 
 * @return void
 */
function cws_copyright() 
{
    global $wpdb;
    $copyright_dates = $wpdb->get_results(
        "
  SELECT
  YEAR(min(post_date_gmt)) AS firstdate,
  YEAR(max(post_date_gmt)) AS lastdate
  FROM
  $wpdb->posts
  WHERE
  post_status = 'publish'
  "
    );
    $output = '';
    if ($copyright_dates ) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if ($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate ) {
            $copyright .= '-' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}
/**
 * Address issue with uplaoding images files. All images uploading resulting in
 * HTTP error.
 * Ref: https://wordpress.org/support/topic/http-error-when-uploading-images-17?replies=76#post-7578975
 */
add_filter('wp_image_editors', 'change_graphic_lib');
function change_graphic_lib($array) 
{
    return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

// Gravity Forms Specific Stuff =======================================
/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
add_filter('gform_tabindex', 'gform_tabindexer', 10, 2);
function gform_tabindexer( $tab_index, $form = false ) 
{
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if ($form ) {
        add_filter('gform_tabindex_' . $form['id'], 'gform_tabindexer');
    }
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}
// Enable Gravity Forms Visibility Setting
// Ref: https://www.gravityhelp.com/gravity-forms-v1-9-placeholders/
add_filter('gform_enable_field_label_visibility_settings', '__return_true');
// End of Gravity Forms Specific Stuff ================================

/**
 * Remove filter at top of TEC pages. 
 */
add_filter( 'tribe-events-bar-should-show', '__return_false', 9999 );

add_filter( 'tribe-events-bar-filters',  'remove_search_from_bar', 1000, 1 );
function remove_search_from_bar( $filters ) {
  if ( isset( $filters['tribe-bar-search'] ) ) {
        unset( $filters['tribe-bar-search'] );
    }
if ( isset( $filters['tribe-bar-date'] ) ) {
    unset( $filters['tribe-bar-date'] );
}
    return $filters;
}

// Shorten excerpt for events. 
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Remove dummy page header on Events page
function remove_undesired_styles(){
if ( is_archive('tribe_events') || is_post_type_archive('tribe_events') ) {
    ?>
    <style type="text/css">#page-header { padding: 25px 0 !important; }</style>
    <?php
}
}
add_filter( 'tribe-events-bar-filters',  'remove_undesired_styles', 1000, 1 );


/*
 * EXAMPLE OF CHANGING ANY TEXT (STRING) IN THE EVENTS CALENDAR
 * See the codex to learn more about WP text domains:
 * http://codex.wordpress.org/Translating_WordPress#Localization_Technology
 * Example Tribe domains: 'tribe-events-calendar', 'tribe-events-calendar-pro'...
 */
function tribe_custom_theme_text ( $translation, $text, $domain ) {
 
	// Put your custom text here in a key => value pair
	// Example: 'Text you want to change' => 'This is what it will be changed to'
	// The text you want to change is the key, and it is case-sensitive
	// The text you want to change it to is the value
	// You can freely add or remove key => values, but make sure to separate them with a comma
	// This example changes the label "Venue" to "Location", and "Related Events" to "Similar Events"
	$custom_text = array(
		'Venue' => 'Location',
        'Related %s' => 'Similar %s',
        'Find out more' => 'Show details',
	);
 
	// If this text domain starts with "tribe-", "the-events-", or "event-" and we have replacement text
    	if( (strpos($domain, 'tribe-') === 0 || strpos($domain, 'the-events-') === 0 || strpos($domain, 'event-') === 0) && array_key_exists($translation, $custom_text) ) {
		$translation = $custom_text[$translation];
	}

    return $translation;
}
add_filter('gettext', 'tribe_custom_theme_text', 20, 3);

// Changes past event views to reverse chronological order
function tribe_past_reverse_chronological ($post_object) {
	$past_ajax = (defined( 'DOING_AJAX' ) && DOING_AJAX && $_REQUEST['tribe_event_display'] === 'past') ? true : false;
	if(tribe_is_past() || $past_ajax) {
		$post_object = array_reverse($post_object);
	}
	return $post_object;
}
add_filter('the_posts', 'tribe_past_reverse_chronological', 100);

// On events pages, set default layout to full width. 
add_filter( 'body_class', 'my_custom_class' );
function my_custom_class( $classes ) {
    if ( is_archive('tribe_events') || is_post_type_archive('tribe_events') ) {
        $classes[] = 'page-template-default';
    }
    return $classes;
}