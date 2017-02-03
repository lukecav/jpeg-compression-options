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
function jpg_compression_plugin_menu() {
    add_submenu_page('upload.php', 'JPG Compression Options', 'JPG Compression Options', 'manage_options' 'jpg_compression_display_settings');
}

add_filter('jpeg_quality', create_function('', 'return 100;'));
add_filter('wp_editor_set_quality', create_function('', 'return 100;'));
?>
