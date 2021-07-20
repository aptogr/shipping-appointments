<?php


namespace ShippingAppointments\Service\PostType;


use ShippingAppointments\Includes\ShippingAppointments;
use ShippingAppointments\Interfaces\PostType\SupplierInvitationInterface;
use ShippingAppointments\Interfaces\TemplatesInterface;
use ShippingAppointments\Traits\Core\Plugin;

class SupplierInvitationPost implements TemplatesInterface, SupplierInvitationInterface {

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
            'name'               => __( 'Supplier Invitations', ShippingAppointments::PLUGIN_NAME ),
            'singular_name'      => __( 'Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'menu_name'          => _x( 'Supplier Invitations', 'admin menu', ShippingAppointments::PLUGIN_NAME ),
            'name_admin_bar'     => _x( 'Supplier Invitation', 'add new on admin bar', ShippingAppointments::PLUGIN_NAME ),
            'add_new'            => _x( 'Add New Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'add_new_item'       => __( 'Add New Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'new_item'           => __( 'New Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'edit_item'          => __( 'Edit Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'view_item'          => __( 'View Supplier Invitation', ShippingAppointments::PLUGIN_NAME ),
            'all_items'          => __( 'All Supplier Invitations', ShippingAppointments::PLUGIN_NAME ),
            'search_items'       => __( 'Search Supplier Invitations', ShippingAppointments::PLUGIN_NAME ),
            'parent_item_colon'  => __( 'Parent Supplier Invitations:', ShippingAppointments::PLUGIN_NAME ),
            'not_found'          => __( 'No Supplier Invitations found.', ShippingAppointments::PLUGIN_NAME ),
            'not_found_in_trash' => __( 'No Supplier Invitations found in Trash.', ShippingAppointments::PLUGIN_NAME )
        );

        $args = array(
            'label'                 => __( 'Invitations', ShippingAppointments::PLUGIN_NAME ),
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'delete_with_user'      => false,
            'show_in_rest'          => true,
            'rest_base'             => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'rewrite'               => array( 'slug' => 'dashboard/invitations/supplier', 'with_front' => false ),
            'has_archive'           => false,
            'show_in_menu'          => 'edit.php?post_type=supplier_company',
            'show_in_nav_menus'     => true,
            'exclude_from_search'   => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'query_var'             => true,
            'supports'              => array( 'title',  'author'),
        );

        register_post_type( self::POST_TYPE_NAME, $args );

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
            'title'      => esc_html__( 'Supplier Invitation Information', ShippingAppointments::PLUGIN_NAME ),
            'post_types' => array( self::POST_TYPE_NAME ),
            'context'    => 'normal',
            'priority'   => 'default',
            'autosave'   => 'false',
            'fields'     => self::INVITATION_FIELDS,
        );


        return $meta_boxes;

    }


}