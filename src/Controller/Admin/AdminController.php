<?php

namespace ShippingAppointments\Controller\Admin;

use ShippingAppointments\Interfaces\AdminInterface;
use ShippingAppointments\Traits\Core\Plugin;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.apto.gr/
 * @since      1.0.0
 *
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/Controller/Admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/Controller/Admin
 * @author     APTO OE <info@apto.gr>
 */
class AdminController implements AdminInterface {

	use Plugin;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
     * @param $pluginName
     * @param $pluginDirUrl
     *
     * @since    1.0.0
     */
    public function __construct( $pluginName, $pluginDirUrl ) {

        $this->pluginName       = $pluginName;
        $this->pluginDirUrl     = $pluginDirUrl;

    }



	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueueStyles() {

		wp_enqueue_style( $this->getPluginName(), $this->getPluginDirUrl() . self::ADMIN_CSS_FOLDER . 'admin.min.css', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueueScripts() {

		wp_enqueue_script( $this->getPluginName(), $this->getPluginDirUrl() . self::ADMIN_JS_FOLDER . 'admin.min.js', array( 'jquery' ), null, true );

	}

}
