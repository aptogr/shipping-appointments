<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.apto.gr
 * @since             1.0.0
 * @package           ShippingAppointments
 *
 * @wordpress-plugin
 * Plugin Name:       Shipping Appointments
 * Plugin URI:        https://www.apto.gr
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            APTO OE
 * Author URI:        https://www.apto.gr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shippingappointments
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
define( 'SHIPPINGAPPOINTMENTS_VERSION', '1.0.0' );

require_once 'vendor/autoload.php';


use ShippingAppointments\Includes\ShippingAppointments;
use ShippingAppointments\Includes\Activator;
use ShippingAppointments\Includes\Deactivator;

/**
 * The code that runs during plugin activation.
 * This action is documented in:
 * @see \ShippingAppointments\Includes\Activator
 */
function activate_shipping_appointments() {
    Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in:
 * @see \ShippingAppointments\Includes\Deactivator
 */
function deactivate_shipping_appointments() {
    Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_shipping_appointments' );
register_deactivation_hook( __FILE__, 'deactivate_shipping_appointments' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runShippingAppointments() {

    $plugin = new ShippingAppointments();
    $plugin->run();

}
runShippingAppointments();



