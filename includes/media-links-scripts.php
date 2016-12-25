<?php

// Add Scripts
function ml_add_scripts(){
	wp_enqueue_style('ml-main-style', plugins_url().'/media-links/css/style.css');
	wp_enqueue_script('ml-main-script', plugins_url().'/media-links/js/main.js');
}

add_action('wp_enqueue_scripts', 'ml_add_scripts');
