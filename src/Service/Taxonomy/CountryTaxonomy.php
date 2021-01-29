<?php


namespace ShippingAppointments\Service\Taxonomy;


use ShippingAppointments\Includes\ShippingAppointments;
use ShippingAppointments\Interfaces\CountriesInterface;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Traits\Core\Plugin;

class CountryTaxonomy  implements CountriesInterface {

	use Plugin;


	/**
	 * Post Brand Slug
	 * @var string
	 */
	const TAXONOMY_SLUG = 'profenda_country';

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
			'name'              => _x( 'Countries', 'taxonomy general name', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'     => _x( 'Country', 'taxonomy singular name', ShippingAppointments::PLUGIN_NAME ),
			'search_items'      => __( 'Search Countries', ShippingAppointments::PLUGIN_NAME ),
			'all_items'         => __( 'All Countries', ShippingAppointments::PLUGIN_NAME ),
			'parent_item'       => __( 'Parent Country', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon' => __( 'Parent Country:', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'         => __( 'Edit Country', ShippingAppointments::PLUGIN_NAME ),
			'update_item'       => __( 'Update Country', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'      => __( 'Add New Country', ShippingAppointments::PLUGIN_NAME ),
			'new_item_name'     => __( 'New Country Name', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'         => __( 'Countries', ShippingAppointments::PLUGIN_NAME ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'country' ),
		);

		register_taxonomy( self::TAXONOMY_SLUG, array(  ShippingCompanyPost::POST_TYPE_NAME, SupplierCompanyPost::POST_TYPE_NAME ), $args );

	}

	public function addCountries() {

		$country_array = self::COUNTRIES_ARRAY;

		// Loop through array and insert terms
		foreach($country_array as $abbr => $name)
		{
			if(!get_term_by('name', ucwords(strtolower($name)), self::TAXONOMY_SLUG))
				wp_insert_term(ucwords(strtolower($name)), self::TAXONOMY_SLUG);
		}
	}

}

