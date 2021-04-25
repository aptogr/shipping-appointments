<?php

namespace ShippingAppointments\Service\Auth;

use Exception;

class Login {


    /**
     * Redirect user after successful login.
     *
     * @param string $redirect_to URL to redirect to.
     * @param string $request URL the user is coming from.
     * @param object $user Logged user's data.
     *
     * @return string
     */
    public function redirectAfterEmailLogin( $redirect_to, $request, $user ){

        $authRedirect = new AuthRedirect();
        return $authRedirect->redirectAfterLogin( $redirect_to );

    }


    public function redirectAfterLogout(){

        wp_redirect( ( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url('login') )  );
        exit();

    }

    public function afterEmailLoginServices( $user_login, $user ){

        try {
            $authServices = new AuthServices();
        }
        catch( Exception $e){

        }

    }

    public function afterEmailRegisterServices( $user_id  ){

        $authServices = new AuthServices();
        $authServices->sendNewUserNotifications( $user_id );

    }

}
