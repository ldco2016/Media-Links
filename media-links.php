<?php
/**
* Plugin Name: Media Links
* Description: Adds social icons with links to profiles
* Version: 1.0
* Author: Daniel Cortes
*
**/

// Exit if Accessed Directly
if(!defined('ABSPATH')){
	exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/media-links-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__) . '/includes/media-links-class.php');

// Register Widget
function register_media_links(){
    register_widget('Media_Links_Widget');
}

add_action('widgets_init', 'register_media_links');
