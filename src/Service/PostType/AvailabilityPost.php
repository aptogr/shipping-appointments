<?php


namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

class AvailabilityPost implements TemplatesInterface{

	use Plugin;

	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'user_availability';

	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'weekdays_available'    => self::POST_TYPE_NAME . '_weekdays_available',
		'mon_time_from'         => self::POST_TYPE_NAME . '_mon_time_from',
		'mon_time_to'           => self::POST_TYPE_NAME . '_mon_time_to',
		'tue_time_from'         => self::POST_TYPE_NAME . '_tue_time_from',
		'tue_time_to'           => self::POST_TYPE_NAME . '_tue_time_to',
		'wed_time_from'         => self::POST_TYPE_NAME . '_wed_time_from',
		'wed_time_to'           => self::POST_TYPE_NAME . '_wed_time_to',
		'thu_time_from'         => self::POST_TYPE_NAME . '_thu_time_from',
		'thu_time_to'           => self::POST_TYPE_NAME . '_thu_time_to',
		'fri_time_from'         => self::POST_TYPE_NAME . '_fri_time_from',
		'fri_time_to'           => self::POST_TYPE_NAME . '_fri_time_to',
		'sat_time_from'         => self::POST_TYPE_NAME . '_sat_time_from',
		'sat_time_to'           => self::POST_TYPE_NAME . '_sat_time_to',
		'sun_time_from'         => self::POST_TYPE_NAME . '_sun_time_from',
		'sun_time_to'           => self::POST_TYPE_NAME . '_sun_time_to',
		'excluded_dates'        => self::POST_TYPE_NAME . '_excluded_dates',
	];



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



	/**
	 * This function is responsible for registering the custom post type
	 * to the WordPress site.
	 *
	 * It's hooked on the 'init' action on @see \ShippingAppointments\Traits\Hooks
	 *
	 * Reference: https://developer.wordpress.org/reference/functions/register_post_type/
	 *
	 * @since    1.0.0
	 */
	public function registerPostType() {

		$labels = array(
			'name'               => __( 'User Availability', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Availability', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Availabilities', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Availability', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Availability', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Availability', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Availability', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Availability', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Availability', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'User Availability', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Availabilities', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Availabilities:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Availabilities found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Availabilities found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Availabilities', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'availability', 'with_front' => false ),
			'has_archive'           => false,
			'show_in_menu'          => 'users.php',
			'show_in_nav_menus'     => true,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'query_var'             => true,
			'supports'              => array( 'title','author'),
		);

		register_post_type( self::POST_TYPE_NAME, $args );

//		add_rewrite_tag('%episodes%', '([^/]+)', 'castify_episode=');
//		add_permastruct('episodes', '/podcasts/%podcast%/%episode%', false);
//		add_rewrite_rule('^podcasts/([^/]+)/([^/]+)/?$','index.php?castify_episode=$matches[2]','top');

	}




	/**
	 * This function is responsible for creating meta boxes for the custom post type
	 * It's hooked on the filter 'rwmb_meta_boxes' @see \ShippingAppointments\Traits\Hooks
	 *
	 * Reference: https://docs.metabox.io/creating-meta-boxes/
	 *
	 * @param $meta_boxes array The array of meta box settings
	 *
	 * @return array
	 */
	public function addMetaBoxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'id'         => self::POST_TYPE_NAME . '_information',
			'title'      => esc_html__( 'Availability', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => array(
				array(
					'id'   => self::META_FIELDS_SLUG['weekdays_available'],
					'name' => esc_html__( 'Week days Available', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['mon_time_from'],
					'name' => esc_html__( 'Monday time from', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['mon_time_to'],
					'name' => esc_html__( 'Monday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['tue_time_from'],
					'name' => esc_html__( 'Tuesday time from', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['tue_time_to'],
					'name' => esc_html__( 'Tuesday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['wed_time_from'],
					'name' => esc_html__( 'Wednesday time from', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['wed_time_to'],
					'name' => esc_html__( 'Wednesday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
                array(
					'id'   => self::META_FIELDS_SLUG['thu_time_from'],
					'name' => esc_html__( 'Thursday time from', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['thu_time_to'],
					'name' => esc_html__( 'Thursday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['fri_time_from'],
					'name' => esc_html__( 'Friday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['fri_time_to'],
					'name' => esc_html__( 'Friday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['sat_time_from'],
					'name' => esc_html__( 'Saturday time from', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['sat_time_to'],
					'name' => esc_html__( 'Saturday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['sun_time_from'],
					'name' => esc_html__( 'Sunday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['sun_time_to'],
					'name' => esc_html__( 'Sunday time to', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
				array(
					'id'   => self::META_FIELDS_SLUG['excluded_dates'],
					'name' => esc_html__( 'Excluded Dates', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
				),
			),
		);

		return $meta_boxes;

	}

}
