<?php
/**
 * jstart-dots Theme functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package jstart-dots
 * @since 1.0.0
 */
/** Define Constants */
define( 'CHILD_THEME_JSTART_DOTS_VERSION', '1.0.0' );
/** Enqueue styles */
function child_enqueue_resources() {
	wp_enqueue_style( 'jstart-dots-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_JSTART_DOTS_VERSION, 'all' );
	// wp_enqueue_script( 'jstart-dots-theme-js', get_stylesheet_directory_uri() . '/lib.js', array(), CHILD_THEME_JSTART_DOTS_VERSION, 'true');
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_resources', 15 );
