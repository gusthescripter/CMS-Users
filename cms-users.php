<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           CMS_Users
 *
 * @wordpress-plugin
 * Plugin Name:       CMS Users
 * Plugin URI:        http://example.com/cms-users-uri/
 * Description:       Allows your visitors to register with a multi-step form.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cms-users
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
define( 'CMS_USERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cms-users-activator.php
 */
function activate_cms_users() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cms-users-activator.php';
	CMS_Users_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cms-users-deactivator.php
 */
function deactivate_cms_users() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cms-users-deactivator.php';
	CMS_Users_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cms_users' );
register_deactivation_hook( __FILE__, 'deactivate_cms_users' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cms-users.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cms_users() {

	$plugin = new CMS_Users();
	$plugin->run();

}
run_cms_users();
