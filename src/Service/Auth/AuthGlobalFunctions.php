<?php


namespace ShippingAppointments\Service\Auth;


class AuthGlobalFunctions {

    const AUTH_PAGES = [
        'register',
        'login',
        'password-lost',
        'password-reset',
    ];

    const AUTH_PAGES_IDS = [
       435,437,439, 441, 443, 445
    ];

    public function isAuthPage(){

        global $post;

        if( in_array( $post->post_name, self::AUTH_PAGES ) || in_array( $post->ID, self::AUTH_PAGES_IDS ) ){
	        return true;
        }
        else {
        	return false;
        }


    }

}
