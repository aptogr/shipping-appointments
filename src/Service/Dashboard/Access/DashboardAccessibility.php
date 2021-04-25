<?php


namespace ShippingAppointments\Service\Dashboard\Access;


use ShippingAppointments\Service\Auth\Authentication;
use ShippingAppointments\Service\Dashboard\Dashboard;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use stdClass;
use WP_Post;

class DashboardAccessibility {

    public $dashboard;
    public $dashboardEncryption;
    public $platformUser;

    public function __construct(){

        $this->dashboard            = new Dashboard();
        $this->dashboardEncryption  = new DashboardEncryption();

    }

    public function checkAccess(){

        $this->checkLoginToken();

        $access = $this->canAccess();

        if( $access->canAccess === false ){

            wp_redirect( $access->redirectUrl );
            exit();

        }

    }


    private function canAccess(){

        global $post;
        $access = new stdClass();
        $access->canAccess      = true;

        //If the user is on a dashboard page and is not logged in
        if( $this->dashboard->isDashboardPage() && !is_user_logged_in() ){

            $currentLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $access->canAccess      = false;
            $access->redirectUrl    = site_url("login?redirect_to=$currentLink");
            return $access;

        }

        //Administrators can access everything
        if( current_user_can('administrator') ){

            $access->canAccess      = true;
            return $access;

        }


        return $access;

    }

    public function checkLoginToken(){

        if( !is_user_logged_in() && isset( $_GET['token'] ) && !empty( $_GET['token'] ) ){

            $email = $this->dashboardEncryption->decrypt( $_GET['token'] );

            $authentication = new Authentication();
            $authentication->forceLogin( $email );

        }

    }


}
