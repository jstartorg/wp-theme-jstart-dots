<?php
/**
 * jstart-dots Theme functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package jstart-dots
 * @since 1.4.0
 */
/** Define Constants */
define( 'CHILD_THEME_JSTART_DOTS_VERSION', '1.0.0' );
/** Enqueue styles */
function child_enqueue_resources() {
	wp_enqueue_style( 'jstart-dots-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_JSTART_DOTS_VERSION, 'all' );
	// wp_enqueue_script( 'jstart-dots-theme-js', get_stylesheet_directory_uri() . '/lib.js', array(), CHILD_THEME_JSTART_DOTS_VERSION, 'true');
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_resources', 15 );

/** Include the TGM_Plugin_Activation class. */
require_once get_stylesheet_directory() . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', function () {
	$plugins = array(
		array('name' => 'All in One SEO', 'slug' => 'all-in-one-seo-pack', 'required' => false),
		array('name' => 'Astra Widgets', 'slug' => 'astra-widgets', 'required' => false),
		array('name' => 'Azure Groups for WordPress', 'slug' => 'azure-groups-for-wordpress', 'required' => false, 'source' => 'https://github.com/dannysummerlin/azure-groups-for-wordpress/archive/main.zip'),
		array('name' => 'Content Control', 'slug' => 'content-control', 'required' => false),
		array('name' => 'Display Posts', 'slug' => 'display-posts-shortcode', 'required' => false),
		array('name' => 'Duplicate Page', 'slug' => 'duplicate-page', 'required' => false),
		array('name' => 'Enable Media Replace', 'slug' => 'enable-media-replace', 'required' => false),
		array('name' => 'Media Library Assistant', 'slug' => 'media-library-assistant', 'required' => false),
		array('name' => 'Simple History', 'slug' => 'simple-history', 'required' => false),
		array('name' => 'Spectra for Astra', 'slug' => 'ultimate-addons-for-gutenberg', 'required' => false),
		array('name' => 'Wordfence', 'slug' => 'wordfence', 'required' => false),
		array('name' => 'WP Code Lite', 'slug' => 'insert-headers-and-footers', 'required' => false),
		array('name' => 'WP Rough Notation', 'slug' => 'wp-rough-notation', 'required' => false, 'source' => 'https://github.com/dannysummerlin/wp-rough-notation/archive/main.zip'),
		array('name' => 'WP SAML Authentication', 'slug' => 'wp-saml-auth', 'required' => false),
	);
	$config = array(
		'id'           => 'wp-theme-jstart-dots',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'plugins.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title' => __( 'Install Suggested Plugins', 'wp-theme-jstart-dots' ),
			'menu_title' => __( 'Suggested Plugins', 'wp-theme-jstart-dots' ),
		),
	);
	tgmpa( $plugins, $config );
});
