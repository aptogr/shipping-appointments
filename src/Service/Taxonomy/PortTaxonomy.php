<?php


namespace ShippingAppointments\Service\Taxonomy;


use ShippingAppointments\Includes\ShippingAppointments;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Traits\Core\Plugin;

class PortTaxonomy {

	use Plugin;


	/**
	 * Post Brand Slug
	 * @var string
	 */
	const TAXONOMY_SLUG = 'port';

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

		$this->pluginName    = $pluginName;
		$this->pluginDirPath = $pluginDirPath;

	}

	public function registerTaxonomy() {

		$labels = array(
			'name'              => _x( 'Ports', 'taxonomy general name', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'     => _x( 'Port', 'taxonomy singular name', ShippingAppointments::PLUGIN_NAME ),
			'search_items'      => __( 'Search Ports', ShippingAppointments::PLUGIN_NAME ),
			'all_items'         => __( 'All Ports', ShippingAppointments::PLUGIN_NAME ),
			'parent_item'       => __( 'Parent Port', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon' => __( 'Parent Port:', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'         => __( 'Edit Port', ShippingAppointments::PLUGIN_NAME ),
			'update_item'       => __( 'Update Port', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'      => __( 'Add New Port', ShippingAppointments::PLUGIN_NAME ),
			'new_item_name'     => __( 'New Port Name', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'         => __( 'Ports', ShippingAppointments::PLUGIN_NAME ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'port' ),
		);

		register_taxonomy( self::TAXONOMY_SLUG, array( SupplierCompanyPost::POST_TYPE_NAME ), $args );

	}

}
