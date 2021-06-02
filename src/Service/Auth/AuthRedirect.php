<?php


namespace ShippingAppointments\Service\Auth;

use WP_Error;

class AuthRedirect {

    public function redirectAfterLogin( $redirectUrl ){

        if( $redirectUrl === site_url('login/') ){
            $redirectUrl = null;
        }

        $redirect_to = $redirectUrl;

        if( empty( $redirectUrl ) ){

            $defaultUrl = site_url('dashboard');
            if( isset( $_SERVER['HTTP_REFERER'] ) ){

                if( $_SERVER['HTTP_REFERER'] !== site_url('login/') &&  $_SERVER['HTTP_REFERER'] !== site_url('register/') ){

                    $defaultUrl =  $_SERVER['HTTP_REFERER'];

                }

            }

//            $defaultUrl = ( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : site_url('dashboard') );

            $redirect_to = ( current_user_can('administrator') ? home_url('wp-admin') : $defaultUrl );

            if( isset( $_SERVER['HTTP_REFERER'] ) ) {

                $parts = parse_url($_SERVER['HTTP_REFERER']);

                if( isset( $parts['query'] ) ){

                    parse_str($parts['query'], $query);

                    if (isset($query['redirect_to'])) {

                        $redirect_to = $query['redirect_to'];

                    }

                }

            }

            if( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ){

                $redirect_to = $_POST['redirect_to'];

            }

            if( isset( $_GET['redirect_to'] ) && !empty( $_GET['redirect_to'] ) ){

                $redirect_to = $_GET['redirect_to'];

            }

        }

        if( class_exists('WpFastestCache') ){

            $cache = new WpFastestCache();
            $cache->deleteCache( true );

        }

        $redirect_to = add_query_arg(
            array(
                'redirectedBack' => 'true',
            ),
            $redirect_to
        );

        return $redirect_to;

    }


    public function redirectAfterRegister( $user_id, $companyID = false ){

        if ( ! $user_id instanceof WP_Error ) {

            setcookie('new_user_message', true, time() + (86400 * 30), "/");

            wp_set_current_user( $user_id );
            wp_set_auth_cookie( $user_id );
            $user = get_user_by( 'id', $user_id );
            do_action( 'wp_login', $user->user_login, $user );

            global $wp;

            $redirect = home_url($wp->request);

            if( $companyID !== false ){

            	$redirect = site_url("dashboard/manage/edit-company/company/$companyID");

            }
            else {

	            if( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ){

		            $redirect = $_POST['redirect_to'];

	            }

	            if( isset( $_GET['redirect_to'] ) && !empty( $_GET['redirect_to'] ) ){

		            $redirect = $_GET['redirect_to'];

	            }


	            if( empty( $redirect ) ){
		            $redirect = home_url('dashboard');
	            }

            }

        }
        else {

           $redirect = site_url('register') . '?new_user=fail&error_message=' . sanitize_title_for_query( $user_id->get_error_message() );

        }

        $redirect = add_query_arg(
            array(
                'redirectedBack' => 'true',
            ),
            $redirect
        );

        return $redirect;

    }



    /**
     * Redirect after a user login has failed.
     * The function redirects the user to the login page and
     * appends a fail notice
     *
     * @return string
     */
    public function redirectAfterFailedLogin(){

        $redirect_url = site_url( 'login' );

        if( isset( $_SERVER['HTTP_REFERER'] ) ){

            $referrer = $_SERVER['HTTP_REFERER'];

            if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {

                if( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ){
                    $redirect_url = site_url( 'login' ) . "/?login=failed&redirect_to=".$_POST['redirect_to'];
                }
                else {
                    $redirect_url = site_url( 'login' ) . "/?login=failed";
                }

            }

        }

        return $redirect_url;

    }

}
