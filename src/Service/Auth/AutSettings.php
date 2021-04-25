<?php


namespace ShippingAppointments\Service\Auth;


class AutSettings {


    /**
     * Restricts access to the Admin Dashboard for Buyers and Sellers
     * HOMI User roles are defined in Homi_Addons class
     * If a user is a seller or buyer and tries to access the dashboard
     * then is redirected to the homepage
     *
     * Hooked on action: 'admin_init'
     *
     */
    public function restrictWPAdminAccess(){

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }

        if( is_user_logged_in() ){

            $user = wp_get_current_user();

            if ( !in_array( 'administrator', (array) $user->roles ) && !in_array( 'wpseo_manager', (array) $user->roles ) ) {

                wp_redirect( home_url() );
                exit;

            }

        }

    }


    /**
     * Hides the admin bar from buyers and sellers
     * HOMI User roles are defined in Homi_Addons class
     *
     * Hooked on action: 'after_setup_theme'
     *
     */
    public function disableAdminBar() {

        if( is_user_logged_in() ){

            $user = wp_get_current_user();

            if ( !in_array( 'administrator', (array) $user->roles ) && !in_array( 'wpseo_manager', (array) $user->roles ) ) {

                show_admin_bar(false);

            }

        }

    }



    /**
     * Filters the duration of the authentication cookie expiration period.
     *
     * @see https://developer.wordpress.org/reference/hooks/auth_cookie_expiration/
     * @param int $expire The login URL. Not HTML-encoded.
     *
     * @return int
     */
    public function extendLoginSessionTime( $expire ){

        return 2592000; // 30 days in seconds (Adjust to your needs)

    }

}
