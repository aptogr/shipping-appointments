<?php


namespace ShippingAppointments\Service\Auth;


class AuthPermalinks {

    const PASSWORD_LOST_URL     = 'password-lost';
    const PASSWORD_RESET_URL    = 'password-reset';
    const PASSWORD_LOGIN_URL    = 'login';

    public function registerUrl( $register_url ) {

        return site_url( 'register' );

    }



    /**
     * Filters the login URL and replaces the default one with a custom login page.
     * The custom login page is being displayed from the page with name 'login'
     *
     * @param string $login_url The login URL. Not HTML-encoded.
     * @param string $redirect The path to redirect to on login, if supplied.
     *
     * @return string
     */
    public function loginUrl( $login_url, $redirect ) {

        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $custom_login_url = (strpos( $actual_link, 'el') !== false ? 'el/login' : 'login' );

        return str_replace("wp-login.php", $custom_login_url ,$login_url);

    }

}
