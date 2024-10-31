<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://startnet.co.uk
 * @since      1.0.0
 *
 * @package    Only_admin_access
 * @subpackage Only_admin_access/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Only_admin_access
 * @subpackage Only_admin_access/includes
 * @author     Startnet Ltd <info@startnet.co.uk>
 */
class Only_admin_access_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'only_admin_access',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
