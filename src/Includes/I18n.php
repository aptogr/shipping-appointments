<?php

namespace ShippingAppointments\Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/app
 * @author     APTO OE <info@apto.gr>
 */
class I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function loadTextDomain() {

		load_plugin_textdomain(
			'shippingappointments',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
