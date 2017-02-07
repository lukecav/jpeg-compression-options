<?php
/*
Plugin Name: JPEG Compression Options
Plugin URI: https://github.com/lukecav/jpeg-compression-options/
Description: Add options for JPEG compression in WordPress, which by default is 82.
Version: 1.0
Author: Luke Cavanagh
Author URI: https://github.com/lukecav
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//creates an entry on the media menu for JPG compression options
add_action('admin_menu', 'jpg_compression_options_menu');
//creates a menu page with the following settings
function jpg_compression_options_menu() {
    add_submenu_page('upload.php', 'JPG Compression Options', 'JPG Compression Options', 'manage_options', 'jpg_compression_browse_settings', 'jpg_compression_display_settings');
}

//creates a plugin action link for the JPG compression options
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'jpeg_plugin_action_links' );

function jpeg_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'upload.php?page=jpg_compression_browse_settings') ) .'">Settings</a>';
   return $links;
}

//on-load, sets up the following settings for the plugin
add_action( 'admin_init', 'jpg_compression_browse_settings' );
function jpg_compression_browse_settings() {
    register_setting( 'jpg_compression_display_settings-group', 'jpg_compression' );
}

//pulls the option value to use in case statement
$jpg_compression = get_option('jpg_compression');

switch ($jpg_compression) {
    case "jpg_disable_compression":
    $return_val = 100;
    break;
    case "jpg_high_compression":
    $return_val = 70;
    break;
    case "jpg_medium_compression":
    $return_val = 80;
    break;
    case "jpg_low_compression":
    $return_val = 92;
    break;
    default:
    $return_val=92;
}
add_filter('jpeg_quality', create_function('', "$return_val"));
add_filter('wp_editor_set_quality', create_function('', "$return_val"));

//displays the settings page
function jpg_compression_display_settings() {
	//first part here displays a form to change the settings
	echo "<form method=\"post\" action=\"options.php\">";
	settings_fields( 'jpg_compression_display_settings-group' );
	do_settings_sections( 'jpg_compression_display_settings-group' );
    echo "
	
	<style>.seperator { border-bottom: 1px solid black; }</style>
	
	<div><h1>JPG Compression Options</h1><p>
An easy way to set the JPG compression in WordPress.
</ul></p>
<table class=\"form-table\">
	<tr><td colspan=\"4\"><h2>Select one of the compression options.</h2></td></tr> 
       <tr valign=\"top\">
        <th scope=\"row\">Disable Compression</th>
        <td><input type=\"radio\" name=\"jpg_compression\" value=\"jpg_disable_compression\" ";

if(get_option(jpg_compression) == 'jpg_disable_compression') { 
        echo "checked='checked'"; 
}

echo "/></td>
<td><p>This will disable compression by setting it to 100.</p></td>
        </tr>

        <tr valign=\"top\">
        <th scope=\"row\">High Compression</th>
        <td><input type=\"radio\" name=\"jpg_compression\" value=\"jpg_high_compression\" ";

if(get_option(jpg_compression) == 'jpg_high_compression') { 
        echo "checked='checked'"; 
}

echo "/></td>
<td><p>This will set the compression at 70.</p></td>
        </tr>
		
	<tr valign=\"top\">
        <th scope=\"row\">Medium Compression</th>
        <td><input type=\"radio\" name=\"jpg_compression\" value=\"jpg_medium_compression\" ";

if(get_option(jpg_compression) == 'jpg_medium_compression') { 
        echo "checked='checked'"; 
}

echo "/></td>
<td><p>This will set the compression at 80.</p></td>
        </tr>
	
	<tr valign=\"top\">
        <th scope=\"row\">Low Compression</th>
        <td><input type=\"radio\" name=\"jpg_compression\" value=\"jpg_low_compression\" ";

if(get_option(jpg_compression) == 'jpg_low_compression') { 
        echo "checked='checked'"; 
}

echo "/></td>
<td><p>This will set the compression at 92.</p></td>
       </tr></table>";
    
    submit_button();
	echo "</form><br><br>";
	echo "</div>";
}

?>
