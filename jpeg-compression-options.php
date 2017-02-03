<?php
/*
Plugin Name: JPEG Compression Options
Plugin URI:
Description: Add options for JPEG compression in WordPress, which by default is 82.
Version: 1.0
Author: Luke Cavanagh
Author URI: https://github.com/lukecav
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('jpeg_quality', create_function('', 'return 100;'));
add_filter('wp_editor_set_quality', create_function('', 'return 100;'));
?>
