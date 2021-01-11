<?php


namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;


/**
 * Class SupplierCompanyPost
 *
 * @package ShippingAppointments\Service\PostType
 */
class SupplierCompanyPost implements TemplatesInterface{

	use Plugin;


	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'supplier_company';


	/**
	 * Post Type Icon
	 * @var string
	 */
	const POST_TYPE_ICON = '<svg fill="#9ea3a8" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 511.998 511.998" xml:space="preserve"><g><g><path d="M454.891,417.317c-2.773-4.804-8.916-6.451-13.724-3.677l-36.521,21.083c-4.805,2.774-6.452,8.919-3.677,13.724c1.861,3.223,5.238,5.026,8.711,5.026c1.704,0,3.431-0.435,5.013-1.348l36.521-21.083C456.018,428.267,457.666,422.123,454.891,417.317z"/></g></g><g><g><path d="M509.472,291.046c-0.003-0.409-0.027-0.818-0.081-1.227c-0.004-0.027-0.01-0.054-0.014-0.081c-0.051-0.366-0.127-0.729-0.219-1.091c-0.026-0.102-0.055-0.2-0.083-0.3c-0.084-0.292-0.184-0.581-0.296-0.868c-0.039-0.098-0.074-0.199-0.116-0.296c-0.154-0.358-0.323-0.711-0.522-1.057c-0.006-0.01-0.012-0.021-0.018-0.031c-0.199-0.344-0.42-0.666-0.652-0.977c-0.063-0.085-0.133-0.166-0.199-0.248c-0.192-0.241-0.393-0.471-0.604-0.691c-0.072-0.075-0.144-0.15-0.218-0.222c-0.267-0.262-0.546-0.509-0.838-0.737c-0.021-0.016-0.04-0.035-0.061-0.051c-0.327-0.25-0.668-0.476-1.021-0.683c-0.026-0.015-0.049-0.035-0.075-0.05l-116.696-67.369V80.316c0-0.029-0.005-0.056-0.006-0.085c-0.003-0.411-0.028-0.822-0.082-1.233c-0.003-0.021-0.008-0.041-0.011-0.061c-0.051-0.374-0.129-0.744-0.224-1.114c-0.024-0.095-0.052-0.19-0.079-0.285c-0.086-0.299-0.188-0.596-0.303-0.89c-0.036-0.092-0.069-0.186-0.108-0.276c-0.157-0.365-0.328-0.726-0.532-1.079c-0.203-0.352-0.429-0.68-0.666-0.998c-0.06-0.081-0.127-0.158-0.19-0.237c-0.195-0.245-0.399-0.479-0.613-0.701c-0.07-0.073-0.141-0.147-0.213-0.218c-0.268-0.263-0.548-0.511-0.84-0.74c-0.02-0.016-0.039-0.034-0.059-0.05c-0.328-0.251-0.67-0.477-1.024-0.685c-0.025-0.015-0.047-0.034-0.072-0.048L261.023,1.346c-3.108-1.794-6.938-1.795-10.047,0L129.265,71.615c-0.024,0.014-0.044,0.031-0.068,0.045c-0.356,0.209-0.7,0.436-1.031,0.69c-0.016,0.012-0.03,0.026-0.046,0.039c-0.297,0.231-0.581,0.484-0.853,0.75c-0.071,0.07-0.141,0.142-0.21,0.214c-0.214,0.223-0.418,0.457-0.613,0.702c-0.063,0.079-0.13,0.157-0.191,0.239c-0.237,0.317-0.462,0.646-0.665,0.997c-0.203,0.352-0.375,0.711-0.531,1.075c-0.04,0.094-0.074,0.192-0.112,0.287c-0.114,0.29-0.214,0.582-0.299,0.877c-0.028,0.097-0.056,0.195-0.082,0.293c-0.093,0.365-0.17,0.732-0.221,1.101c-0.003,0.025-0.01,0.048-0.013,0.073c-0.054,0.409-0.078,0.82-0.081,1.229c0,0.029-0.006,0.058-0.006,0.087v134.749L7.545,282.433c-0.025,0.014-0.046,0.033-0.07,0.047c-0.355,0.208-0.699,0.435-1.028,0.688c-0.016,0.012-0.031,0.027-0.047,0.039c-0.297,0.231-0.58,0.483-0.852,0.751c-0.072,0.07-0.141,0.143-0.211,0.215c-0.213,0.222-0.417,0.455-0.612,0.7c-0.064,0.08-0.132,0.159-0.193,0.241c-0.234,0.313-0.456,0.638-0.657,0.985c-0.003,0.005-0.007,0.01-0.01,0.016c-0.201,0.35-0.373,0.706-0.527,1.068c-0.041,0.096-0.076,0.196-0.115,0.294c-0.112,0.287-0.212,0.578-0.297,0.87c-0.029,0.099-0.057,0.198-0.083,0.298c-0.093,0.363-0.169,0.727-0.22,1.094c-0.004,0.026-0.01,0.052-0.014,0.079c-0.054,0.409-0.078,0.819-0.081,1.229c0,0.029-0.006,0.057-0.006,0.086v140.549h0.001c0,3.59,1.915,6.906,5.023,8.701l121.721,70.268c0.024,0.014,0.051,0.023,0.075,0.037c0.358,0.203,0.725,0.387,1.108,0.546c0.023,0.009,0.046,0.016,0.069,0.025c0.345,0.14,0.7,0.257,1.063,0.359c0.099,0.028,0.199,0.052,0.298,0.076c0.296,0.073,0.598,0.132,0.904,0.178c0.103,0.016,0.206,0.035,0.31,0.047c0.392,0.046,0.79,0.077,1.194,0.077c0.404,0,0.802-0.031,1.194-0.077c0.104-0.012,0.207-0.032,0.31-0.047c0.306-0.046,0.607-0.104,0.903-0.178c0.1-0.025,0.2-0.049,0.3-0.077c0.361-0.1,0.714-0.218,1.057-0.357c0.025-0.01,0.05-0.017,0.075-0.028c0.382-0.158,0.749-0.342,1.104-0.544c0.025-0.014,0.052-0.024,0.078-0.038l116.687-67.369l116.687,67.369c0.026,0.015,0.053,0.024,0.079,0.039c0.356,0.202,0.722,0.385,1.103,0.543c0.026,0.011,0.053,0.018,0.079,0.029c0.342,0.139,0.694,0.255,1.054,0.356c0.1,0.028,0.201,0.052,0.301,0.077c0.295,0.073,0.597,0.132,0.902,0.178c0.104,0.016,0.207,0.035,0.311,0.047c0.392,0.046,0.789,0.077,1.194,0.077c0.405,0,0.802-0.031,1.194-0.077c0.104-0.012,0.207-0.032,0.311-0.047c0.305-0.046,0.607-0.104,0.902-0.178c0.1-0.025,0.201-0.049,0.301-0.077c0.36-0.1,0.711-0.217,1.054-0.356c0.026-0.01,0.053-0.018,0.079-0.029c0.381-0.158,0.747-0.342,1.103-0.543c0.026-0.015,0.053-0.024,0.079-0.039l121.721-70.268c3.109-1.794,5.024-5.111,5.024-8.701V291.135C509.478,291.104,509.472,291.076,509.472,291.046z M418.588,256.065L316.97,314.734l-40.877-23.601l101.616-58.667L418.588,256.065z M367.663,215.065l-101.616,58.667V156.396L367.663,97.72V215.065z M255.999,21.648l40.877,23.6l-101.619,58.67l-40.875-23.602L255.999,21.648z M134.288,232.467l40.872,23.597l-101.62,58.668l-40.876-23.598L134.288,232.467z M124.242,484.551L22.615,425.883V308.536l43.286,24.989c1.341,1.397,3.026,2.352,4.845,2.797l53.496,30.884V484.551z M134.289,349.803l-40.653-23.469l101.617-58.669l40.652,23.47L134.289,349.803z M245.952,425.883L144.336,484.55V367.205l101.616-58.669V425.883z M245.952,273.733l-101.616-58.667V97.719l43.259,24.98c1.348,1.411,3.047,2.373,4.881,2.818l53.477,30.879V273.733z M215.352,115.522L316.97,56.849l40.646,23.467l-101.616,58.677L215.352,115.522z M367.662,484.549l-101.615-58.666V308.536l43.285,24.99c1.337,1.393,3.02,2.345,4.836,2.792l53.495,30.885V484.549z M377.71,349.803l-40.646-23.467l101.618-58.67l40.652,23.469L377.71,349.803z M489.383,425.883l-101.626,58.668V367.205l101.626-58.669V425.883z"/></g></g><g><g><path d="M471.342,399.171c-12.93,0-12.951,20.094,0,20.094C484.271,419.265,484.293,399.171,471.342,399.171z"/></g></g></svg>';



	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'google'  => self::POST_TYPE_NAME . '_google',
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
			'name'               => __( 'Suppliers', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Supplier', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Suppliers', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Supplier', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Supplier', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Supplier', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Supplier', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Supplier', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Supplier', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'All Suppliers', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Suppliers', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Suppliers:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Suppliers found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Suppliers found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Suppliers', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'suppliers', 'with_front' => false ),
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
					'id'   => self::META_FIELDS_SLUG['google'],
					'name' => esc_html__( 'Google Podcast', ShippingAppointments::PLUGIN_NAME ),
					'type' => 'text',
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

		$template   = $this->getPluginDirPath() . self::SINGLE_TEMPLATES_FOLDER . "supplier-company.php";
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

		$template = $this->getPluginDirPath() . self::ARCHIVE_TEMPLATES_FOLDER . "supplier-company.php";
		return (  is_post_type_archive ( self::POST_TYPE_NAME ) && file_exists( $template ) ? $template : $archive_template );

	}

}
