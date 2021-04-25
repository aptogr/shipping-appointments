<?php


namespace ShippingAppointments\Service\Auth;


class AuthGlobalFunctions {

    const AUTH_PAGES = [
        'register',
        'login',
        'password-lost',
        'password-reset',
    ];

    public function isAuthPage(){

        global $post;
        return in_array( $post->post_name, self::AUTH_PAGES );

    }

}
