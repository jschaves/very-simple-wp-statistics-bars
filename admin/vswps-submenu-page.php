<?php

/**
 * Creates the submenu page for the plugin.
 *
 * @package very_simple_wp_statistics_Admin_Settings
 */
 
/**
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package very_simple_wp_statistics_Admin_Settings
 */
class VSWPS_Submenu_Page {
	/**
	* This function renders the contents of the page associated with the Submenu
	* that invokes the render method. In the context of this plugin, this is the
	* Submenu class.
	*/
	private $deserializer_vswps;
	public function __construct( $deserializer_vswps ) {
		$this->deserializer_vswps = $deserializer_vswps;
	}
	
    public function render() {
        include_once( 'views/vswps-settings.php' );
    }
}