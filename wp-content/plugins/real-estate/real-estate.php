<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://gameweeds.com
 * @since             1.0.0
 * @package           Real_Estate
 *
 * @wordpress-plugin
 * Plugin Name:       RealEstate
 * Plugin URI:        https://http://smarty-lab.com/
 * Description:       Creating custom post-type and taxonomy. Show it in frontend search section.
 * Version:           1.0.0
 * Author:            Yuri Kralia
 * Author URI:        https://https://gameweeds.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       real-estate
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
define( 'REAL_ESTATE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-real-estate-activator.php
 */
function activate_real_estate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-real-estate-activator.php';
	Real_Estate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-real-estate-deactivator.php
 */
function deactivate_real_estate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-real-estate-deactivator.php';
	Real_Estate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_real_estate' );
register_deactivation_hook( __FILE__, 'deactivate_real_estate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-real-estate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_real_estate() {

	$plugin = new Real_Estate();
	$plugin->run();

}
run_real_estate();
