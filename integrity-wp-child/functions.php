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
