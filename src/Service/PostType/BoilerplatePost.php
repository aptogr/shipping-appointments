<?php

namespace ShippingAppointments\Service\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

class BoilerplatePost implements TemplatesInterface{

	use Plugin;


	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'boilerplate_post';



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
			'name'               => __( 'Episodes', ShippingAppointments::PLUGIN_NAME ),
			'singular_name'      => __( 'Episode', ShippingAppointments::PLUGIN_NAME ),
			'menu_name'          => _x( 'Episodes', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
			'name_admin_bar'     => _x( 'Episode', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
			'add_new'            => _x( 'Add New Episode', ShippingAppointments::PLUGIN_NAME ),
			'add_new_item'       => __( 'Add New Episode', ShippingAppointments::PLUGIN_NAME ),
			'new_item'           => __( 'New Episode', ShippingAppointments::PLUGIN_NAME ),
			'edit_item'          => __( 'Edit Episode', ShippingAppointments::PLUGIN_NAME ),
			'view_item'          => __( 'View Episode', ShippingAppointments::PLUGIN_NAME ),
			'all_items'          => __( 'All Episodes', ShippingAppointments::PLUGIN_NAME ),
			'search_items'       => __( 'Search Episodes', ShippingAppointments::PLUGIN_NAME ),
			'parent_item_colon'  => __( 'Parent Episodes:', ShippingAppointments::PLUGIN_NAME ),
			'not_found'          => __( 'No Episodes found.', ShippingAppointments::PLUGIN_NAME ),
			'not_found_in_trash' => __( 'No Episodes found in Trash.', ShippingAppointments::PLUGIN_NAME )
		);

		$args = array(
			'label'                 => __( 'Episodes', ShippingAppointments::PLUGIN_NAME ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'delete_with_user'      => false,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => array( 'slug' => 'episodes', 'with_front' => false ),
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

		$template   = $this->getPluginDirPath() . self::SINGLE_TEMPLATES_FOLDER . "boilerplate-post.php";
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

		$template = $this->getPluginDirPath() . self::ARCHIVE_TEMPLATES_FOLDER . "boilerplate-post.php";
		return (  is_post_type_archive ( self::POST_TYPE_NAME ) && file_exists( $template ) ? $template : $archive_template );

	}

}
