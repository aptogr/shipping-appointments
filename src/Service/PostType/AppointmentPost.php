<?php


namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\PostType\AppointmentInterface;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

class AppointmentPost implements TemplatesInterface, AppointmentInterface {

	use Plugin;


	/**
	 * Post Type Icon
	 * @var string
	 */
	const POST_TYPE_ICON = '<svg fill="#9ea3a8" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m91 15c0-8.284-6.716-15-15-15s-15 6.716-15 15v17h30z"/><path d="m181 15c0-8.284-6.716-15-15-15s-15 6.716-15 15v17h30z"/><path d="m271 15c0-8.284-6.716-15-15-15s-15 6.716-15 15v17h30z"/><path d="m361 15c0-8.284-6.716-15-15-15s-15 6.716-15 15v17h30z"/><path d="m451 15c0-8.284-6.716-15-15-15s-15 6.716-15 15v17h30z"/><path d="m361 381h30v30h-30z"/><path d="m241 381h30v30h-30z"/><path d="m121 262h30v30h-30z"/><path d="m497 32h-46v45c0 8.284-6.716 15-15 15s-15-6.716-15-15v-45h-60v45c0 8.284-6.716 15-15 15s-15-6.716-15-15v-45h-60v45c0 8.284-6.716 15-15 15s-15-6.716-15-15v-45h-60v45c0 8.284-6.716 15-15 15s-15-6.716-15-15v-45h-60v45c0 8.284-6.716 15-15 15s-15-6.716-15-15v-45h-46c-8.284 0-15 6.716-15 15v95h512v-95c0-8.284-6.716-15-15-15z"/><path d="m241 262h30v30h-30z"/><path d="m361 262h30v30h-30z"/><path d="m0 497c0 8.284 6.716 15 15 15h482c8.284 0 15-6.716 15-15v-325h-512zm331-250c0-8.284 6.716-15 15-15h60c8.284 0 15 6.716 15 15v60c0 8.284-6.716 15-15 15h-60c-8.284 0-15-6.716-15-15zm0 119c0-8.284 6.716-15 15-15h60c8.284 0 15 6.716 15 15v60c0 8.284-6.716 15-15 15h-60c-8.284 0-15-6.716-15-15zm-120-119c0-8.284 6.716-15 15-15h60c8.284 0 15 6.716 15 15v60c0 8.284-6.716 15-15 15h-60c-8.284 0-15-6.716-15-15zm0 119c0-8.284 6.716-15 15-15h60c8.284 0 15 6.716 15 15v60c0 8.284-6.716 15-15 15h-60c-8.284 0-15-6.716-15-15zm-120-119c0-8.284 6.716-15 15-15h60c8.284 0 15 6.716 15 15v60c0 8.284-6.716 15-15 15h-60c-8.284 0-15-6.716-15-15zm3.401 153.088c5.253-6.405 14.704-7.342 21.11-2.087l8.352 6.849 30.498-37.513c5.226-6.426 14.673-7.402 21.101-2.176s7.402 14.673 2.176 21.102l-40 49.2c-5.228 6.431-14.712 7.416-21.15 2.136l-20-16.4c-6.405-5.254-7.34-14.705-2.087-21.111z"/></g></svg>';



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
			'name'               => __( 'Appointments', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Appointment', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Appointments', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Appointment', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Appointment', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Appointment', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Appointment', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Appointment', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Appointment', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'All Appointments', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Appointments', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Appointments:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Appointments found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Appointments found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Appointments', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'dashboard/appointments/meeting', 'with_front' => false ),
			'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode( self::POST_TYPE_ICON ),
			'has_archive'           => false,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'query_var'             => true,
			'supports'              => array( 'title',  'author'),
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
			'title'      => esc_html__( 'Primary Information', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => self::PRIMARY_FIELDS,
		);

		$meta_boxes[] = array(
			'id'         => self::POST_TYPE_NAME . '_participating',
			'title'      => esc_html__( 'Participants Overview', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => self::PARTICIPANTS_FIELDS,
		);

		$meta_boxes[] = array(
			'id'         => self::POST_TYPE_NAME . '_participants',
			'title'      => esc_html__( 'Meeting Information', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => self::MEETING_FIELDS,
		);

		return $meta_boxes;

	}



	/**
	 * This function filters the default single template for the posts
	 * It's responsible for loading a custom template for the single custom type post
	 *
	 * The function is hooked on the 'single_template' hook @param $single_template string - Path to the template.
	 * @return string
		  *@see \ShippingAppointments\Traits\Hooks
	 *
	 */
	public function customPostTypeTemplateSingle( string $single_template ): string {

		global $post;

		$template   = $this->getPluginDirPath() . self::SINGLE_TEMPLATES_FOLDER . "appointment.php";

		return (  $post->post_type === self::POST_TYPE_NAME && file_exists( $template ) ? $template : $single_template );

	}

	/**
	 * This function filters the default archive template for the posts
	 * It's responsible for loading a custom template for the archive custom type post
	 *
	 * The function is hooked on the 'archive_template' hook @see \ShippingAppointments\Traits\Hooks
	 *
	 * @param $archive_template string - Path to the template.
	 * @return string
	 */
	public function customPostTypeTemplateArchive( $archive_template ) {

		$template = $this->getPluginDirPath() . self::ARCHIVE_TEMPLATES_FOLDER . "appointments-employee.php";
		return (  is_post_type_archive ( self::POST_TYPE_NAME ) && file_exists( $template ) ? $template : $archive_template );

	}

}

