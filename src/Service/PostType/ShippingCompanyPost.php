<?php


namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

/**
 * Class ShippingCompanyPost
 *
 * @package ShippingAppointments\Service\PostType
 */
class ShippingCompanyPost implements TemplatesInterface{

	use Plugin;


	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'shipping_company';



	/**
	 * Post Type Icon
	 * @var string
	 */
	const POST_TYPE_ICON = '<svg fill="#9ea3a8" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512.001 512.001" xml:space="preserve"><g><g><path d="M401.851,295.316c0,0-64.599-39.86-64.68-39.91c-4.649-2.869-10.91-1.356-13.77,3.259c-2.866,4.625-1.345,10.921,3.26,13.76c0,0,64.64,39.886,64.68,39.91c4.647,2.867,10.903,1.392,13.76-3.259C407.958,304.424,406.502,298.183,401.851,295.316z"/></g></g><g><g><path d="M297.883,232.915c-6.387-0.001-11.203,6.079-9.743,12.295c0.581,2.476,2.283,4.725,4.525,6.145c1.539,0.975,3.333,1.56,5.196,1.56c3.499,0,6.689-1.769,8.519-4.748C310.278,241.821,305.378,232.916,297.883,232.915z"/></g></g><g><g><path d="M194.333,258.148c-2.821-4.493-9.325-5.945-13.792-3.123c0,0-64.182,40.472-64.29,40.54c-4.625,2.916-6.036,9.164-3.123,13.785c1.751,2.779,5.13,4.408,8.475,4.502c1.882,0.053,3.753-0.38,5.318-1.367c0,0,64.245-40.521,64.29-40.55C195.835,269.019,197.239,262.776,194.333,258.148z"/></g></g><g><g><path d="M219.691,232.145c-4.644,0-8.713,3.264-9.74,7.788c-1.399,6.163,3.48,12.212,9.76,12.212c4.635,0,8.727-3.263,9.75-7.791C230.862,238.154,226.028,232.145,219.691,232.145z"/></g></g><g><g><path d="M509.548,455.464c-3.624-4.168-9.94-4.608-14.108-0.984c-10.663,9.271-20.531,18.883-34.522,22.75c-15.553,4.298-30.334,0.906-44.41-6.132l52.079-175.224c1.296-4.359-0.514-9.044-4.403-11.401l-48.183-29.195v-85.253c0-5.522-4.477-10-10-10h-20v-30c0-5.522-4.477-10-10-10h-31.5v-30c0-5.522-4.477-10-10-10h-48.5v-70c0-5.522-4.477-10-10-10h-40c-5.523,0-10,4.478-10,10v70h-48.5c-5.523,0-10,4.478-10,10v30h-31.5c-5.523,0-10,4.478-10,10v30h-20c-5.523,0-10,4.478-10,10v85.253l-48.182,29.194c-3.89,2.357-5.699,7.042-4.403,11.401c0,0,51.951,174.79,51.973,174.866c-0.887-2.984-16.889-4.949-19.718-5.315c-29.117-3.768-51.258,10.818-72.232,29.055c-4.168,3.624-4.608,9.939-0.985,14.107c3.459,3.978,9.896,4.646,14.107,0.985c21.608-18.784,45.969-33.103,74.559-18.806c25.864,12.931,52.636,18.476,79.575,4.3c21.722-11.434,42.684-21.307,66.93-9.763l24.927,11.87c21.326,10.156,45.674,9.922,66.799-0.642c13.018-6.509,26.249-15.171,41.119-16.193c14.576-1.001,28.66,4.426,41.467,10.835c16.919,8.46,36.726,10.15,54.894,4.971c16.735-4.771,28.914-15.429,41.731-26.573C512.731,465.947,513.171,459.632,509.548,455.464z M396.001,180.025v63.135l-104.198-63.135H396.001z M246.001,20.025h20v60h-20V20.025z M187.501,100.025h137v20h-137V100.025z M116.001,180.025h104.198L116.001,243.16V180.025z M246.001,467.14c0.002-1.777-14.255-5.055-16.12-5.459c-17.404-3.767-36.088-1.375-51.866,6.93c-11.448,6.025-22.493,13.054-35.586,14.74c-0.024,0.003-0.048,0.006-0.072,0.009c-7.65,0.93-15.48,0.367-22.884-1.792L64.786,297.577l181.215-109.8C246.001,187.777,246.001,467.129,246.001,467.14z M146.001,160.025v-20h220v20H146.001z M398.023,463.084c0.111-3.094-28.039-3.066-29.925-2.867c-17.358,1.836-32.374,10.767-47.692,18.426c-18.096,9.048-36.716,6.447-54.405-1.98V187.777l181.215,109.8L398.023,463.084z"/></g></g></svg>';




	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'company_users_visibility'      => self::POST_TYPE_NAME . '_company_users_visibility',
		'booking_method'                => self::POST_TYPE_NAME . '_booking_method',
		'booking_method_department'     => self::POST_TYPE_NAME . '_booking_method_department',
		'booking_request'               => self::POST_TYPE_NAME . '_booking_request',
		'booking_request_type'          => self::POST_TYPE_NAME . '_booking_request_type',
		'minimum_notice'                => self::POST_TYPE_NAME . '_minimum_notice',
		'book_in_advance_days'          => self::POST_TYPE_NAME . '_book_in_advance_days',

        'products_specific_suppliers'   => self::POST_TYPE_NAME . '_products_specific_suppliers',
        'brands_specific_suppliers'     => self::POST_TYPE_NAME . '_brands_specific_suppliers',

        'meeting_repetition'            => self::POST_TYPE_NAME . '_meeting_repetition',
        'meeting_repetition_time'       => self::POST_TYPE_NAME . '_meeting_repetition_time',


        //New
        'meeting_type'                  => self::POST_TYPE_NAME . '_meeting_types',
        'meeting_types_available'       => self::POST_TYPE_NAME . '_meeting_types_available',
        'instant_booking'               => self::POST_TYPE_NAME . '_instant_booking',

        'premises'                      => self::POST_TYPE_NAME . '_premises',
        'company_email'                 => self::POST_TYPE_NAME . '_company_email',
        'company_phone'                 => self::POST_TYPE_NAME . '_company_phone',

        'cancellations'                 => self::POST_TYPE_NAME . '_cancellations',



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
			'name'               => __( 'Shipping Companies', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Shipping Companies', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Shipping Company', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Shipping Company', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'All Shipping Companies', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Shipping Companies', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Shipping Companies:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Shipping Companies found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Shipping Companies found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Shipping Companies', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'dashboard/companies/shipping', 'with_front' => false ),
			'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode( self::POST_TYPE_ICON ),
			'has_archive'           => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'query_var'             => true,
			'supports'              => array( 'title', 'thumbnail', 'editor', 'excerpt', 'author'),
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
			'title'      => esc_html__( 'Information', ShippingAppointments::PLUGIN_NAME ),
			'post_types' => array( self::POST_TYPE_NAME ),
			'context'    => 'normal',
			'priority'   => 'default',
			'autosave'   => 'false',
			'fields'     => array(
                array(
                    'name'              => 'Users Visibility',
                    'id'                => self::META_FIELDS_SLUG['company_users_visibility'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'company_users_visibile'             => 'Visibile Users',
                        'company_users_invisibile'           => 'Invisible Users',
                        'company_users_department'           => 'Let the department define',
                    ),
                ),

                array(
                    'type' => 'divider',
                ),
                array(
                    'name'       => 'Cancellations',
                    'id'         => self::META_FIELDS_SLUG['cancellations'],
                    'type'       => 'number',
                ),
                array(
                    'type' => 'divider',
                ),

                array(
                    'name'              => 'Meeting Type Settings',
                    'id'                => self::META_FIELDS_SLUG['meeting_type'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'company'             => 'Defined by company',
                        'department'          => 'Let the department define',
                    ),
                ),
                array(
                    'name'              => 'Meeting Types Available',
                    'id'                => self::META_FIELDS_SLUG['meeting_types_available'],
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
                    'type' => 'divider',
                ),
                array(
                    'name'              => 'Instant Booking',
                    'id'                => self::META_FIELDS_SLUG['instant_booking'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'accept_specific'               => 'Accept for specific',
                        'decline'                       => 'Do not accept',
                        'department'                    => 'Let the department define',
                    ),
                ),
                array(
                    'name'              => 'Specific Products',
                    'id'                => self::META_FIELDS_SLUG['products_specific_suppliers'],
                    'type'              => 'text',
                ),
                array(
                    'name'              => 'Specific Brands',
                    'id'                => self::META_FIELDS_SLUG['brands_specific_suppliers'],
                    'type'              => 'text',
                ),
//                array(
//                    'name'          => 'Specific Products',
//                    'id'            => self::META_FIELDS_SLUG['products_specific_suppliers'],
//                    'type'          => 'taxonomy',
//                    'multiple'      => true,
//                    'field_type'    => 'select_advanced',
//                    'taxonomy'      => 'profenda_product_type',
//                    'placeholder'   => 'Select Products',
//                ),
//                array(
//                    'name'          => 'Specific Brands',
//                    'id'            => self::META_FIELDS_SLUG['brands_specific_suppliers'],
//                    'type'          => 'taxonomy',
//                    'multiple'      => true,
//                    'field_type'    => 'select_advanced',
//                    'taxonomy'      => 'profenda_product_brand',
//                    'placeholder'   => 'Select Brands',
//                ),
                array(
                    'type' => 'divider',
                ),
                array(
                    'name'              => 'Minimum Notice Period',
                    'id'                => self::META_FIELDS_SLUG['minimum_notice'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'minimum_notice_in_advance'             => 'Book an appointment at least xxx(example 24hours) in advance',
                        'minimum_notice_no_limit'               => 'No time limit',
                        'minimum_notice_department'             => 'Let the department define',
                    ),
                ),

                array(
                    'name'              => 'Book in advance days',
                    'id'                => self::META_FIELDS_SLUG['book_in_advance_days'],
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
                        'meeting_repetition_department'     => 'Let the department define',
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
                    'name'              => 'Premises',
                    'id'                => self::META_FIELDS_SLUG['premises'],
                    'type'              => 'text',
                ),
                array(
                    'name'              => 'Company Email',
                    'id'                => self::META_FIELDS_SLUG['company_email'],
                    'type'              => 'text',
                ),
                array(
                    'name'              => 'Company Phone',
                    'id'                => self::META_FIELDS_SLUG['company_phone'],
                    'type'              => 'text',
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

		$template   = $this->getPluginDirPath() . self::SINGLE_TEMPLATES_FOLDER . "shipping-company.php";
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

		$template = $this->getPluginDirPath() . self::ARCHIVE_TEMPLATES_FOLDER . "shipping-company.php";
		return (  is_post_type_archive ( self::POST_TYPE_NAME ) && file_exists( $template ) ? $template : $archive_template );

	}

}
