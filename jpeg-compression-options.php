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
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_action_links' );

function my_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'upload.php?page=jpg_compression_browse_settings') ) .'">Settings</a>';
   return $links;
}

//on-load, sets up the following settings for the plugin
add_action( 'admin_init', 'jpg_compression_browse_settings' );
function jpg_compression_browse_settings() {
	register_setting( 'jpg_compression_display_settings-group', 'jpg_disable_compression' );
	register_setting( 'jpg_compression_display_settings-group', 'jpg_high_compression' );
	register_setting( 'jpg_compression_display_settings-group', 'jpg_medium_compression' );
	register_setting( 'jpg_compression_display_settings-group', 'jpg_low_compression' );
}

add_filter('jpeg_quality', create_function('', 'return 100;'));
add_filter('wp_editor_set_quality', create_function('', 'return 100;'));

?>
