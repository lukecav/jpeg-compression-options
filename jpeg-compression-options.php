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
    add_submenu_page('upload.php', 'JPG Compression Options', 'JPG Compression Options', 'manage_options', 'jpg_compression_display_settings');
}

//displays the settings page
function jpg_compression_display_settings() {
	//first part here displays a form to change the settings
	echo "<form method=\"post\" action=\"options.php\">";
	settings_fields( 'jpg_compression_display_settings-group' );
	do_settings_sections( 'jpg_compression_display_settings-group' );
    echo "
	
	<style>.seperator { border-bottom: 1px solid black; }</style>
	
	<div><h1>JPG Compression Options</h1><p>
Welcome to the AWS S3 Browser Plugin. Please set your AWS access key and secret key that have the appripriate iams permissions to access the buckets you're going to wish to display.
</p><p>You can use the shortcode of the format: <b>[s3browse bucket=bucketname]</b> to display the files listing in a page or a post. The bucket attribute is required.</p>
<p><b>Features</b>
<ul><li>All files hosted on AWS S3: No local server traffic / space required.</li>
<li>Links auto-expire after 60 minutes. No worries about hot-linking</li>
<li>Searching without ever leaving the page.</li>
<li>Since this is run via shortcode, able to put in a password protected page or post</li>
</ul>
<b>Limitations:</b>
<ul>
<li>Must Use AWS</li>
<li>View / Download only (for now, uploading in a future version)</li>
<li>Only works for 3 levels deep. Bucket (and items in), Folders (and items in), and Subfolders (and items in). Any deeper and they will not display correctly, although they will still show in search. This is being worked on for a future version.</li>
</ul></p>
<table class=\"form-table\">
	<tr><td colspan=\"3\"><h2>General AWS S3 Settings (All REQUIRED)</h2></td></tr> 
       <tr valign=\"top\">
        <th scope=\"row\">AWS Access Key</th>
        <td><input type=\"text\" name=\"s3_browse_aws_access_key\" value=\"".esc_attr( get_option('s3_browse_aws_access_key') )."\" /></td>
<td><p>Enter your AWS access key here.</p></td>
        </tr>
         
        <tr valign=\"top\">
        <th scope=\"row\">AWS Secret Key</th>
        <td><input type=\"text\" name=\"s3_browse_aws_secret\" value=\"".esc_attr( get_option('s3_browse_aws_secret') )."\" /></td>
<td><p>Shown only when creating account.</p></td>
        </tr>
		
		<tr valign=\"top\" class=\"seperator\">
        <th scope=\"row\">AWS Region</th>
        <td><input type=\"text\" name=\"s3_browse_aws_region\" value=\"".esc_attr( get_option('s3_browse_aws_region') )."\" /></td>
<td><p>Get your region from your S3 url. Ex) us-west-1</p></td>
        </tr></table>";
    
    submit_button();
	echo "</form><br><br>";
	echo "</div>";
}

add_filter('jpeg_quality', create_function('', 'return 100;'));
add_filter('wp_editor_set_quality', create_function('', 'return 100;'));
?>
