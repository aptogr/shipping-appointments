<?php


namespace ShippingAppointments\Service\User;


use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

class UserTemplates implements TemplatesInterface{

	use Plugin;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @param $pluginName
	 * @param $pluginDirPath
	 *
	 * @since    1.0.0
	 */
	public function __construct( $pluginName, $pluginDirPath ) {

		$this->pluginName       = $pluginName;
		$this->pluginDirPath    = $pluginDirPath;

	}

	public function changeAuthorBaseUrl() {
		global $wp_rewrite;
		$wp_rewrite->author_base = 'user';
	}


	public function customUserTemplate( $template ) {

		return $this->getPluginDirPath() . self::USER_TEMPLATES_FOLDER . "shipping_user.php";

	}

}
