<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/jschaves/
 * @since             1.1
 * @package           Very_Simple_Wp_Statistics
 *
 * @wordpress-plugin
 * Plugin Name:       Very Simple WP Statistics
 * Plugin URI:        https://github.com/jschaves/very-simple-wp-statistics
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.1
 * Author:            Juan Chaves
 * Author URI:        https://github.com/jschaves/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       very-simple-wp-statistics
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) {
    exit();
}
// Include the shared dependency.
include_once( plugin_dir_path( __FILE__ ) . 'shared/vswps-class-deserializer.php' );
// Include the dependencies needed to instantiate the plugin.
foreach( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}
add_action('plugins_loaded', 'very_simple_wp_statistics_menu');

// Update CSS within in Admin
function vswps_admin_style() {
	wp_enqueue_style( 'vswps-admin-styles', plugin_dir_url( __FILE__ ) . 'admin/css/style.css' );
}
add_action('admin_enqueue_scripts', 'vswps_admin_style');
// Register Script
function vswps_admin_footer_js() {
	wp_register_script( 'vswps-js', plugin_dir_url( __FILE__ ) . 'admin/js/script.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'vswps-js' );
}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'vswps_admin_footer_js' );
// Include the shared and public dependencies.
include_once( plugin_dir_path( __FILE__ ) . 'shared/vswps-class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'public/vswps-class-content-messenger.php' );
//add languages 
function vswps_add_languages() {
	load_plugin_textdomain( 'very-simple-wp-statistics', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'vswps_add_languages' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */
function very_simple_wp_statistics_menu() {
	// Setup and initialize the class for saving our options.
    $serializer_vswps = new VSWPS_Serializer();
    $serializer_vswps->init();
	// Setup the class used to retrieve our option value.
	$deserializer_vswps = new VSWPS_Deserializer();
	// Setup the administrative functionality.
    $plugin_vswps = new VSWPS_Submenu( new VSWPS_Submenu_Page( $deserializer_vswps ) );
    $plugin_vswps->init();
	// Setup the public facing functionality.
    $public_vswps = new VSWPS_Content_Messenger( $deserializer_vswps );
    $public_vswps->init();
}