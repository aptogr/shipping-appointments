<?php


namespace ShippingAppointments\Service\Auth;


use ShippingAppointments\Controller\Notifications\UserAuthNotificationsController;
use ShippingAppointments\Service\Emails\AuthenticationEmails;
use WP_User;

class Password {

    public $notificationsController;


    public function __construct(){

        $this->notificationsController = new UserAuthNotificationsController();

    }

    public function set_content_type( $content_type ) {
        return 'text/html';
    }


    /**
     * Filters the default wordpress password change/lost url
     * with out custom page for lost password
     *
     * @param $lostpassword_url string The URL for retrieving a lost password.
     * @param $redirect string The path to redirect to.
     * @return string
     */
    public function change_lostpassword_url( $lostpassword_url, $redirect  ){

        return site_url( AuthPermalinks::PASSWORD_LOST_URL );

    }


    /**
     * Set the custom template for password lost
     * Redirects the user to the custom "Forgot your password?" page instead of
     * wp-login.php?action=lostpassword.
     * In order for this code to work you have to create a page on
     * the wordpress site with the name set in the PASSWORD_LOST_URL constant
     *
     * @return void
     */
    public function customLostPasswordPage() {

        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {

            if ( is_user_logged_in() ) {

                wp_redirect( home_url() );
                exit;

            }

            wp_redirect( home_url( AuthPermalinks::PASSWORD_LOST_URL ) );
            exit;

        }
        //Handles the Lost Password after the form submit
        else if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {

            $errors = retrieve_password();

            if ( is_wp_error( $errors ) ) {

                // Errors found
                $redirect_url = home_url( AuthPermalinks::PASSWORD_LOST_URL . '/?errors='.join( ',', $errors->get_error_codes() ) );

            }
            else {

                // Email sent
                $redirect_url = home_url( AuthPermalinks::PASSWORD_LOST_URL . '/?checkemail=confirm' );
            }

            wp_redirect( $redirect_url );
            exit;

        }

    }



    /**
     * Gets the error message based on the error code param
     *
     * @param $error_code string
     *
     * @return string
     */
    public function get_error_message( $error_code ){

        switch( $error_code ){

            case 'empty_username':
                return __( 'You need to enter your email address to continue.', 'personalize-login' );

            case 'invalid_email':
            case 'invalidcombo':
                return __( 'There is no user registered with the email address you entered. Make sure the email address you entered is correct.', 'personalize-login' );

            case 'expiredkey':
            case 'invalidkey':
                return __( 'The password reset link you used is not valid anymore. Please fill in your email on the form below to send you a new email with the instructions to reset your password.', 'personalize-login' );

            case 'password_reset_mismatch':
                return __( "The two passwords you entered don't match.", 'personalize-login' );

            case 'password_reset_empty':
                return __( "Sorry, we don't accept empty passwords.", 'personalize-login' );

        }

        return '';

    }


    /**
     * Checks whether the user was just registered on the site.
     * This function detects if the register date of the user is within 10 min
     *
     * @param WP_User $user WP_User object.
     *
     * @return bool
     */
    private function user_just_registered( $user ){

        return ( round(( time() - strtotime( $user->user_registered ) ) / 60,2 ) < 10 );

    }



    /**
     * Filters the subject of the password reset email.
     * Hooked on 'retrieve_password_title' filter.
     *
     * Reference: https://developer.wordpress.org/reference/hooks/retrieve_password_title/
     *
     * @param string  $title        The default email subject.
     * @param string  $user_login   The username for the user.
     * @param WP_User $user         WP_User object.
     *
     * @return string   The mail message to send.
     */
    public function resetPasswordEmailSubject( $title, $user_login, $user ) {

        return "HOMI: Αλλαγή κωδικού πρόσβασης";

    }




    /**
     * Returns the message body for the password reset mail.
     * Called through the retrieve_password_message filter.
     *
     * @param string  $message      Default mail message.
     * @param string  $key          The activation key.
     * @param string  $user_login   The username for the user.
     * @param WP_User $user         WP_User object.
     *
     * @return string   The mail message to send.
     */
    public function resetPasswordEmailMessage( $message, $key, $user_login, $user ) {

        $passwordUrl = home_url( "wp-login.php?action=rp&key=$key&lang=el&login=" . rawurlencode( $user_login ), 'login' );

        //Handle the notifications except the email notification
        $this->notificationsController->sendNotifications( $user, 'password_reset', $passwordUrl );

        //For the email notification we just return the template
        $authenticationEmails  = new AuthenticationEmails( $user, true );

        return $authenticationEmails->email_password_change_request( $passwordUrl );

    }



    /**
     * Set the custom template for password reset
     * In order for this code to work you have to create a page on
     * the wordpress site with the name set in the PASSWORD_RESET_URL constant
     *
     * @return void
     */
    public function customResetPasswordPage(){

        global $TRP_LANGUAGE;

        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {

            // Verify key / login combo
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );

            if ( ! $user || is_wp_error( $user ) ) {

                $redirect_url = ( !empty( $TRP_LANGUAGE ) && $TRP_LANGUAGE !== 'en'?  home_url( 'el/' . AuthPermalinks::PASSWORD_LOST_URL ) : home_url( AuthPermalinks::PASSWORD_LOST_URL ) );
                $redirect_url = ( $user && $user->get_error_code() === 'expired_key' ? add_query_arg( 'errors', 'expiredkey', $redirect_url ) : add_query_arg( 'errors', 'invalidkey', $redirect_url ) );


            }
            else {

                $redirect_url = ( !empty( $TRP_LANGUAGE ) && $TRP_LANGUAGE !== 'en'?  home_url( 'el/' . AuthPermalinks::PASSWORD_RESET_URL ) : home_url( AuthPermalinks::PASSWORD_RESET_URL ) );
                $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
                $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
                $redirect_url = add_query_arg( 'lang', esc_attr( $_REQUEST['lang'] ), $redirect_url );

            }

            wp_redirect( $redirect_url );
            exit;

        }
        else if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

            $rp_key = $_REQUEST['rp_key'];
            $rp_login = $_REQUEST['rp_login'];

            $user = check_password_reset_key( $rp_key, $rp_login );

            if ( ! $user || is_wp_error( $user ) ) {

                // If the reset key sent to the email is invalid or has expired
                // then redirect user to the Password Lost page and display a message

                $redirect_url = ( !empty( $TRP_LANGUAGE ) && $TRP_LANGUAGE !== 'en'?  home_url( 'el/' . AuthPermalinks::PASSWORD_LOST_URL ) : home_url( AuthPermalinks::PASSWORD_LOST_URL ) );
                $redirect_url = ( $user && $user->get_error_code() === 'expired_key' ? add_query_arg( 'error', 'expiredkey', $redirect_url ) : add_query_arg( 'error', 'invalidkey', $redirect_url ) );

                wp_redirect( $redirect_url );
                exit;

            }

            if ( isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {

                if ( $_POST['pass1'] != $_POST['pass2'] ) {

                    // If Passwords don't match redirect user to reset password page and display the error message
                    $redirect_url = ( !empty( $TRP_LANGUAGE ) && $TRP_LANGUAGE !== 'en'?  home_url( 'el/' . AuthPermalinks::PASSWORD_RESET_URL ) : home_url( AuthPermalinks::PASSWORD_RESET_URL ) );
                    $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                    $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                    $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );

                    wp_redirect( $redirect_url );
                    exit;

                }


                //If passwords are same and not empty do the password reset
                //Send a confirmation email to the user and redirect the user to the login page
                //The password=changed param is added to the Login url to display the message

                reset_password( $user, $_POST['pass1'] );

                $this->notificationsController->sendNotifications( $user, 'password_reset_success');

                $redirect_url = ( !empty( $TRP_LANGUAGE ) && $TRP_LANGUAGE !== 'en'?  home_url( 'el/' . AuthPermalinks::PASSWORD_LOGIN_URL ) : home_url( AuthPermalinks::PASSWORD_LOGIN_URL ) );
                $redirect_url = add_query_arg( 'password', 'changed', $redirect_url );
                $redirect_url = add_query_arg( 'e', base64_encode( $user->user_email ) , $redirect_url );

                wp_redirect( $redirect_url );

            }
            else {

                //If Password is empty redirect user to reset password page and display the error message
                $redirect_url = home_url( AuthPermalinks::PASSWORD_RESET_URL );
                $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );

                wp_redirect( $redirect_url );
                exit;

            }

            exit;
        }

    }


}
