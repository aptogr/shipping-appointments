<?php


namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

/**
 * Class DepartmentPost
 *
 * @package ShippingAppointments\Service\PostType
 */
class DepartmentPost implements TemplatesInterface{

	use Plugin;

	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'shipping_department';

	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'company'                       => self::POST_TYPE_NAME . '_company',
		'department_users_visibility'   => self::POST_TYPE_NAME . '_department_users_visibility',
		'type'                          => self::POST_TYPE_NAME . '_type',
        'weekdays_available'            => self::POST_TYPE_NAME . '_weekdays_available',
        'mon_time_from'                 => self::POST_TYPE_NAME . '_mon_time_from',
        'mon_time_to'                   => self::POST_TYPE_NAME . '_mon_time_to',
        'tue_time_from'                 => self::POST_TYPE_NAME . '_tue_time_from',
        'tue_time_to'                   => self::POST_TYPE_NAME . '_tue_time_to',
        'wed_time_from'                 => self::POST_TYPE_NAME . '_wed_time_from',
        'wed_time_to'                   => self::POST_TYPE_NAME . '_wed_time_to',
        'thu_time_from'                 => self::POST_TYPE_NAME . '_thu_time_from',
        'thu_time_to'                   => self::POST_TYPE_NAME . '_thu_time_to',
        'fri_time_from'                 => self::POST_TYPE_NAME . '_fri_time_from',
        'fri_time_to'                   => self::POST_TYPE_NAME . '_fri_time_to',
        'sat_time_from'                 => self::POST_TYPE_NAME . '_sat_time_from',
        'sat_time_to'                   => self::POST_TYPE_NAME . '_sat_time_to',
        'sun_time_from'                 => self::POST_TYPE_NAME . '_sun_time_from',
        'sun_time_to'                   => self::POST_TYPE_NAME . '_sun_time_to',
        'excluded_dates'                => self::POST_TYPE_NAME . '_excluded_dates',
        'max_meetings_per_day'          => self::POST_TYPE_NAME . '_max_meetings_per_day',
        'book_in_advance_days'          => self::POST_TYPE_NAME . '_book_in_advance_days',
        'minimum_notice'                => self::POST_TYPE_NAME . '_minimum_notice',
        'booking_request_type'          => self::POST_TYPE_NAME . '_booking_request_type',
        'booking_request'               => self::POST_TYPE_NAME . '_booking_request',
        'meet_same_supplier_times'      => self::POST_TYPE_NAME . '_meet_same_supplier_times',
        'booking_method'                => self::POST_TYPE_NAME . '_booking_method',
        'booking_method_user'           => self::POST_TYPE_NAME . '_booking_method_user',
        'selected_products'             => self::POST_TYPE_NAME . '_selected_products',
        'selected_brands'               => self::POST_TYPE_NAME . '_selected_brands',
        'meeting_repetition_time'       => self::POST_TYPE_NAME . '_meeting_repetition_time',
        'meeting_repetition'            => self::POST_TYPE_NAME . '_meeting_repetition',

        //new
        'instant_booking'               => self::POST_TYPE_NAME . '_instant_booking',

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
			'name'               => __( 'Departments', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Department', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Departments', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Department', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Department', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Department', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Department', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Department', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Department', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'All Departments', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Departments', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Departments:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Departments found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Departments found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Departments', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'departments', 'with_front' => false ),
			'has_archive'           => false,
			'show_in_menu'          => 'edit.php?post_type=shipping_company',
			'show_in_nav_menus'     => true,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'query_var'             => true,
			'supports'              => array( 'title', 'thumbnail', 'editor', 'excerpt', 'author'),
		);

		register_post_type( self::POST_TYPE_NAME, $args );

		add_rewrite_tag('%departments%', '([^/]+)', 'shipping_department=');
		add_permastruct('departments', '/shipping-companies/%company%/%department%', false);
		add_rewrite_rule('^shipping-companies/([^/]+)/([^/]+)/?$','index.php?shipping_department=$matches[2]','top');

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
			'title'      => esc_html__( 'Information', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => array(
				array(
					'id'   => self::META_FIELDS_SLUG['company'],
					'name' => esc_html__( 'Company', ShippingAppointments::PLUGIN_NAME ),
					'type'        => 'post',
					'post_type'   => ShippingCompanyPost::POST_TYPE_NAME,
					'field_type'  => 'select_advanced',
					'placeholder' => 'Select a company',
				),

                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Users Visibility',
                    'id'                => self::META_FIELDS_SLUG['department_users_visibility'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'department_users_visibile'             => 'Visibile Users',
                        'department_users_invisibile'           => 'Invisible Users',
                        'department_users_department'           => 'Let the users define',
                    ),
                ),
                array(
                    'name'              => 'Instant Booking',
                    'id'                => self::META_FIELDS_SLUG['instant_booking'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'accept_specific'               => 'Accept for specific',
                        'decline'                       => 'Do not accept',
                        'user'                          => 'Let the user define',
                    ),
                ),

                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Booking Method',
                    'id'                => self::META_FIELDS_SLUG['booking_method'],
                    'type'              => 'checkbox_list',
                    'options'           => array(
                        'physical_location'     => 'Physical Location',
                        'phone_call'            => 'Phone Call',
                        'online'                => 'Remote Online',
                    ),
                    'inline'            => false,
                    'select_all_none'   => true,
                ),

                array(
                    'name'              => 'Let the users define Booking Method',
                    'id'                => self::META_FIELDS_SLUG['booking_method_user'],
                    'type' => 'checkbox',
                    'std'  => 0, // 0 or 1
                ),

                array(
                    'type' => 'divider',
                ),
                array(
                    'name'       => 'Products',
                    'id'         => self::META_FIELDS_SLUG['selected_products'],
                    'type'       => 'text',
                ),
                array(
                    'name'       => 'Brands',
                    'id'         => self::META_FIELDS_SLUG['selected_brands'],
                    'type'       => 'text',
                ),

                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Booking request type',
                    'id'                => self::META_FIELDS_SLUG['booking_request_type'],
                    'desc'              => 'The way the booking requests are made. Email or instant booking',
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'email'             => 'Ask via Email first',
                        'instant'           => 'Instant Booking',
                    ),
                ),
                array(
                    'name'              => 'Booking request',
                    'id'                => self::META_FIELDS_SLUG['booking_request'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'booking_request_specific_suppliers'    => 'Accept for specific suppliers',
                        'booking_request_user'                  => 'Let the user define',
                    ),
                ),

                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Minimum Notice Period',
                    'id'                => self::META_FIELDS_SLUG['minimum_notice'],
                    'desc'              => 'The way the booking requests are made. Email or instant booking',
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'minimum_notice_in_advance'             => 'Book an appointment at least xxx(example 24hours) in advance',
                        'minimum_notice_no_limit'               => 'No time limit',
                        'minimum_notice_user'                   => 'Let the user define',
                    ),
                ),
                array(
                    'name'              => 'Book in advance days',
                    'id'                => self::META_FIELDS_SLUG['book_in_advance_days'],
                    'desc'              => 'The minimum days notice to book the current user for.',
                    'type'              => 'number',
                ),

                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Meeting Repetition',
                    'id'                => self::META_FIELDS_SLUG['meeting_repetition'],
                    'type'              => 'radio',
                    'options'           => array(
                        'meeting_repetition_limit'          => 'Do not let the same supplier to visit our company',
                        'meeting_repetition_no_limit'       => 'No time limit',
                        'meeting_repetition_users'          => 'Let the users define',
                    ),
                    'inline'            => false,
                    'select_all_none'   => true,
                ),

                array(
                    'name'              => 'Meeting Repetition Time Limit',
                    'id'                => self::META_FIELDS_SLUG['meeting_repetition_time'],
                    'type'              => 'number',
                ),


                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Max meetings per day',
                    'id'                => self::META_FIELDS_SLUG['max_meetings_per_day'],
                    'desc'              => 'The maximum meetings the current user can be booked for.',
                    'type'              => 'number',
                ),

                array(
                    'name'              => 'How many times to meet same supplier',
                    'id'                => self::META_FIELDS_SLUG['meet_same_supplier_times'],
                    'desc'              => 'The maximum number of times the user can meet a supplier',
                    'type'              => 'number',
                ),


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

                array(
                    'type' => 'divider',
                ),

			),
		);

		return $meta_boxes;

	}



	/**
	 * This function filters the default single template for the posts
	 * It's responsible for loading a custom template for the single custom type post
	 *
	 * The function is hooked on the 'single_template' hook @see \ShippingAppointments\Traits\Hooks
	 *
	 * @param $single_template string - Path to the template.
	 * @return string
	 */
	public function customPostTypeTemplateSingle( $single_template ) {

		global $post;

		$template   = $this->getPluginDirPath() . self::SINGLE_TEMPLATES_FOLDER . "department.php";
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

		$template = $this->getPluginDirPath() . self::ARCHIVE_TEMPLATES_FOLDER . "department.php";
		return (  is_post_type_archive ( self::POST_TYPE_NAME ) && file_exists( $template ) ? $template : $archive_template );

	}


	/**
	 * Function changePermalinks()
	 * Changes the permalinks of departments
	 *
	 * @param $permalink
	 * @param $post
	 * @param $leavename
	 *
	 * @return string|string[]
	 */
	public function changePermalinks( $permalink, $post, $leavename) {

		if( $post->post_type === self::POST_TYPE_NAME ) {

			$company = get_post_meta( $post->ID, self::META_FIELDS_SLUG['company'], true );

			$linkParts = explode('/', $permalink );
			$departmentTitle = $linkParts[ count($linkParts) - 2 ];

			if( !empty( $company ) ){

				$companySlug    = get_post_field('post_name', $company );
				$permalink      = str_replace('departments',  "shipping-companies/$companySlug", $permalink);

			}

//			if( !empty($departmentTitle) ){
//
//				$permalink  = str_replace( $departmentTitle,  "sales-department", $permalink);
//
//			}

		}


		return $permalink;

	}

}
