<?php

namespace ShippingAppointments\Controller\Front;

use ShippingAppointments\Controller\Ajax\AjaxController;
use ShippingAppointments\Interfaces\PublicInterface;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Traits\Core\Plugin;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.apto.gr/
 * @since      1.0.0
 *
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/Controller/Front
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    ShippingAppointments
 * @subpackage ShippingAppointments/Controller/Front
 * @author     APTO OE <info@apto.gr>
 */
class PublicController implements PublicInterface {

	use Plugin;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @param $pluginName
	 * @param $pluginDirUrl
	 *
	 * @since    1.0.0
	 */
	public function __construct( $pluginName, $pluginDirUrl ) {

		$this->pluginName       = $pluginName;
        $this->pluginDirUrl     = $pluginDirUrl;

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueueStyles() {

		wp_enqueue_style( $this->getPluginName(), $this->getPluginDirUrl() . self::PUBLIC_CSS_FOLDER . 'public.min.css', array(), null, 'all' );
		wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=5.5.3', array(), null, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueueScripts() {

		wp_enqueue_script( $this->getPluginName(), $this->getPluginDirUrl() . self::PUBLIC_JS_FOLDER . 'public.min.js', array( 'jquery' ), null, true );

        $ajaxController = new AjaxController();
        wp_localize_script(
            $this->getPluginName(),
            'AjaxController',
            array_merge( [
                'ajax_url'   => admin_url( 'admin-ajax.php' ),
                'security'   => wp_create_nonce( $this->getPluginName() ),
            ],
                $ajaxController->getJSAjaxActions()
            )
        );

	}



	/**
	 * Adds the plugin name to the classes of the body
	 * It helps overriding css rules
	 *
	 * @since     1.0.0
	 * @param     $classes array
	 * @return    array
	 */
	public function pluginNameBodyClass( $classes ){

		$classes[]  = $this->getPluginName();
		$classes[] = ( $this->isDashboardPage() ? 'platform-dashboard-page' : 'front-page ');

		$post = get_queried_object();

		if( $post->post_type === AppointmentPost::POST_TYPE_NAME ){


            $appointment = new \ShippingAppointments\Service\Entities\Appointment($post->ID);

            if( is_user_logged_in() ){


                $currentUser = get_current_user_id();

                if ($appointment->requester == $currentUser) {
                    $classes[] = 'appointment-requester';
                } elseif ($appointment->receiver == $currentUser) {
                    $classes[] = 'appointment-receiver';
                }

            }

        }

		return $classes;

	}


	private function isDashboardPage(){

        if( is_page() ){

            global $post;

            if ($post->post_parent)	{
                $ancestors=get_post_ancestors($post->ID);
                $root=count($ancestors)-1;
                $parent = $ancestors[$root];
            }
            else {
                $parent = $post->ID;
            }

            $slug = get_post_field( 'post_name', $parent );

            return $slug === 'dashboard';

        }
        else if( is_author() || is_singular(array('shipping_company', 'supplier_company', 'user_appointments') )  ){
            return true;
        }
        else {
            return false;
        }

	}

}
