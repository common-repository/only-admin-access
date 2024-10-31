<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://startnet.co.uk
 * @since             1.0.0
 * @package           Only_admin_access
 *
 * @wordpress-plugin
 * Plugin Name:       Only Admin Access
 * Plugin URI:        https://startnet.co.uk/only_admin_access
 * Description:       This plugin redirects all non-admins to the homepage - admins can still view/edit the website.
 * Version:           1.0.0
 * Author:            Startnet Ltd
 * Author URI:        https://startnet.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       only_admin_access
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ONLY_ADMIN_ACCESS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-only_admin_access-activator.php
 */
function activate_only_admin_access() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-only_admin_access-activator.php';
	Only_admin_access_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-only_admin_access-deactivator.php
 */
function deactivate_only_admin_access() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-only_admin_access-deactivator.php';
	Only_admin_access_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_only_admin_access' );
register_deactivation_hook( __FILE__, 'deactivate_only_admin_access' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-only_admin_access.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_only_admin_access() {

	$plugin = new Only_admin_access();
	$plugin->run();

}
run_only_admin_access();
