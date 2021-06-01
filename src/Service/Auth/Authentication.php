<?php


namespace ShippingAppointments\Service\Auth;


use ShippingAppointments\Interfaces\Auth\RegisterInterface;
use ShippingAppointments\Service\Dashboard\Access\DashboardEncryption;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;
use ShippingAppointments\Service\User\UserFields;
use WP_Error;
use WP_User;

class Authentication implements RegisterInterface {


    /**
     * Create a new User
     *
     * @return void
     */
    public function registerNewUser() {

        if( isset( $_POST['new_user'] ) ) {

            $user_args = array();

            foreach ( self::DEFAULT_USER_FIELDS as $userField ) {

                $user_args[ $userField['field_name'] ] = filter_input( INPUT_POST, $userField['field_name'], constant( $userField['sanitize'] ) );
            }

	        $email = $user_args['user_email'];
	        $parts = explode('@', $email );


	        $username = $parts[0];
	        if( empty( $username ) || username_exists( $username ) ){
		        $username = $username . time();
	        }

            $user_args['user_login'] = $username;
            $user_args['role']       = ( $_POST['role'] ?? 'subscriber' );

            $user_id = wp_insert_user( $user_args );

            if( $user_id ){

                $platformUser = new PlatformUser( $user_id );

                if( $platformUser->isSupplierCompanyAdmin() || $platformUser->isSupplierCompanyEmployee() ){

	                update_user_meta( $user_id, UserFields::META_FIELDS_SLUG['supplier_company_id'], intval( $_POST['supplier'] ) );

                }
                else {

	                update_user_meta( $user_id, UserFields::META_FIELDS_SLUG['shipping_company_id'], intval( $_POST['company'] ) );
	                update_user_meta( $user_id, UserFields::META_FIELDS_SLUG['shipping_company_department_id'], intval( $_POST['department'] ) );

                }

                if( isset( $_POST['invitation'] ) ){

                    update_post_meta( $_POST['invitation'], ShippingInvitationPost::META_FIELDS_SLUG['status'], 'accepted' );

                }

	            do_action('profenda_user_registered', $user_id );

            }

            $authRedirect = new AuthRedirect();
            wp_redirect( $authRedirect->redirectAfterRegister( $user_id ) );
            exit();

        }

    }


    public function forceLogin( $email ){

        if( email_exists( $email ) && !is_user_logged_in() ){

            $userToLogin = get_user_by('email', $email );

            if( $userToLogin instanceof WP_User ){

                wp_set_current_user( $userToLogin->ID, $userToLogin->user_login );
                wp_set_auth_cookie( $userToLogin->ID );
                do_action( 'wp_login', $userToLogin->ID, $userToLogin );


                if( is_user_logged_in() ){

                    $redirectUrl = site_url( parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH) );

                    wp_safe_redirect( $redirectUrl );
                    exit();

                }


            }


        }

    }


    function allow_programmatic_login( $user, $username, $password ) {
        return get_user_by( 'login', $username );
    }


    /**
     * Filters the wp_authenticate and adds custom errors
     * if there's an empty username or password
     *
     * @param $user null|WP_User|WP_Error
     * @param $username string 	Username or email address.
     * @param $password string User password
     * @return mixed
     */
    public function authenticateLogin( $user, $username, $password ) {

        if( !is_user_logged_in() && isset( $_GET['token'] ) && !empty( $_GET['token'] ) ){

            $dashboardEncryption = new DashboardEncryption();
            $email = $dashboardEncryption->decrypt( $_GET['token'] );

            return get_user_by('email', $email );

        }


        if ( is_wp_error( $user ) && isset( $_SERVER[ 'HTTP_REFERER' ] ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-admin' ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-login.php' ) ) {

            $referrer = $_SERVER[ 'HTTP_REFERER' ];

            foreach ( $user->errors as $key => $error ) {

                if ( in_array( $key, array( 'empty_password', 'empty_username') ) ) {

                    unset( $user->errors[ $key ] );
                    $user->errors[ 'custom_'.$key ] = $error;

                }

            }

        }


        return $user;

    }



    /**
     * Redirect after a user login has failed.
     * The function redirects the user to the login page and
     * appends a fail notice
     *
     * @param string $username Username entered.
     *
     * @return void
     */
    public function failedLogin( $username ){

        $authRedirect = new AuthRedirect();

        wp_redirect( $authRedirect->redirectAfterFailedLogin() );
        exit;

    }


    public function showNewUserModalMessage(){

        if( isset( $_COOKIE['new_user_message'] ) ): ?>

            <div class="register-overlay">

                <div id="registerModal" class="register-success">

                    <div class="icon">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 351.08 346"><defs><linearGradient id="linear-gradient" x1="202.21" y1="174.54" x2="200.25" y2="372.45" gradientUnits="userSpaceOnUse"><stop offset="0.01"/><stop offset="0.12" stop-opacity="0.75"/><stop offset="1" stop-opacity="0"/></linearGradient><linearGradient id="linear-gradient-2" x1="82.93" y1="245.95" x2="81.8" y2="359.81" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-3" x1="103.72" y1="191.75" x2="77.2" y2="195.93" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-4" x1="67.23" y1="186.41" x2="105.38" y2="177.24" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-5" x1="103.17" y1="139.99" x2="100.25" y2="172.16" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-6" x1="98.59" y1="143.82" x2="98.32" y2="187.16" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-7" x1="105.04" y1="143.86" x2="104.78" y2="187.2" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-8" x1="235.12" y1="266.15" x2="106.67" y2="165.89" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-9" x1="282.59" y1="73.53" x2="282.88" y2="153.63" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-10" x1="240.51" y1="319.12" x2="195.08" y2="-49.62" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-11" x1="200.89" y1="167.78" x2="199.14" y2="202.44" gradientUnits="userSpaceOnUse"><stop offset="0.02" stop-color="#fff" stop-opacity="0"/><stop offset="0.58" stop-color="#fff" stop-opacity="0.39"/><stop offset="1" stop-color="#fff"/></linearGradient><linearGradient id="linear-gradient-12" x1="271.14" y1="279.93" x2="267.93" y2="225.76" xlink:href="#linear-gradient-11"/><linearGradient id="linear-gradient-13" x1="240.83" y1="215.93" x2="235.01" y2="245.93" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-14" x1="210.84" y1="210.1" x2="205.01" y2="240.1" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-15" x1="169.01" y1="264.29" x2="225.52" y2="266.62" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-16" x1="179.11" y1="223.03" x2="190.91" y2="296.43" xlink:href="#linear-gradient"/></defs><title>Real Estate Agent</title><g style="isolation:isolate"><g id="Layer_1" data-name="Layer 1"><path d="M376.27,239.46c-.1,3-.28,6-.58,9.06-2.12,22.15-9.91,44.27-26.7,58.52-19.94,16.91-48.22,19.4-74.35,18.44s-52.93-4.5-77.94,3.13c-13.69,4.18-26.22,11.56-39.88,15.82-26,8.1-55.25,4.09-78.59-9.88s-40.56-37.47-47.79-63.69a125.41,125.41,0,0,1-3.14-15c-4.12-27.7-.08-56.5-.67-84.75C26.11,146,22,120,31,96.53,37,80.9,48.42,68,61.49,57.79c45.73-35.65,103.32-54.85,161-55.21,34.36-.22,69.48,5.26,99.63,21.74,9.8,5.35,19.11,12,26,20.72,5.13,6.52,8.79,14.08,11.8,21.8a158.94,158.94,0,0,1,10,41.76c1.84,18.59.39,37.35,1.13,56C372.08,189.62,377,214.45,376.27,239.46Z" transform="translate(-25.26 -2.57)" fill="#1259af" opacity="0.18" style="isolation:isolate"/><path d="M375.69,248.52l-.12,1.18c-1.77,16.86-6.85,33.63-16.74,46.83A63.08,63.08,0,0,1,349,307c-19.94,16.91-48.22,19.4-74.35,18.44s-52.93-4.5-77.94,3.13c-13.69,4.18-26.22,11.56-39.88,15.82-26,8.1-55.25,4.09-78.59-9.88a106,106,0,0,1-37-38,109.55,109.55,0,0,1-10.77-25.67,125.41,125.41,0,0,1-3.14-15l132.27-2.79Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M375.57,249.7c-1.77,16.86-6.85,33.63-16.74,46.83H41.21a109.55,109.55,0,0,1-10.77-25.67,125.41,125.41,0,0,1-3.14-15l132.27-2.79Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient)"/><ellipse cx="82.37" cy="302.63" rx="48.93" ry="14.42" fill="url(#linear-gradient-2)"/><path d="M117.33,293.17l.59,6.13s-2.35,3.56-5.42,3.78-4.11-1.24-4.11-1.24l.51-9" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><path d="M108.39,301.84l.21-3.62,9-2.42.69,4.92a12.07,12.07,0,0,1-5.77,2.36C109.44,303.31,108.39,301.84,108.39,301.84Z" transform="translate(-25.26 -2.57)" fill="#fff"/><path d="M88.62,293.82l-.6,6.3s2.41,3.65,5.56,3.88,4.22-1.28,4.22-1.28l-.52-9.26" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><path d="M97.8,302.72,97.59,299l-9.23-2.49-.34,3.6s2.41,3.65,5.56,3.88S97.8,302.72,97.8,302.72Z" transform="translate(-25.26 -2.57)" fill="#fff"/><path d="M96.16,156.08S84,162,83.71,163.9s1.37,49.37,1.37,49.37,4,5.13,16.07,5.13c12.41,0,15.61-3.55,16.16-5.21s2.53-48.92,2.25-50.95-11.51-6.13-11.51-6.13Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><polygon points="89.12 175.85 86.63 212.65 92.05 210.62 92.81 198.88 89.12 175.85" fill="url(#linear-gradient-3)"/><path d="M103.41,188.7s-14.34.12-15.25-.79-4.35-24.74-4.45-24c-.2,1.39.6,24.16,1.06,36.86a146.47,146.47,0,0,0,15.33-5.9,7.89,7.89,0,0,0,3.4-2.78C104.28,190.93,104.73,189.56,103.41,188.7Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-4)"/><path d="M98.18,149.36a54.22,54.22,0,0,1-2,6.72c-.8,2.18.84,6.78,5.78,6.78s5.51-5.68,5.42-6.78c-.06-.79-1.34-3.4-1.66-5.92C105.37,147.45,98.45,147.47,98.18,149.36Z" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><polygon points="73.96 161.34 76.06 164.28 74.56 203.97 78.55 208.36 81.34 202.97 78.05 163.79 78.8 160.9 76.59 159.53 73.96 161.34" fill="#3f3d56"/><polygon points="79.59 182.36 80.08 175.32 91.38 172.53 87.79 194.47 78.88 195.53 79.59 182.36" fill="#fff"/><path d="M97.5,152.5s0,7.58,4.18,6.91,4.86-6.45,4.86-6.45Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-5)"/><path d="M87,213.92s-2.43,8.32-1,34.94S88,294.1,88,294.1s.18,2.17,4.76,2.23,5.8-3,5.8-3L103,225.14l4.68,69.63s5.5,3.17,9.79.79c2.37-1.31,2.16-49.87,1.09-71.27a25.67,25.67,0,0,0-2.5-10.07S104.47,221.92,87,213.92Z" transform="translate(-25.26 -2.57)" fill="#3f3d56"/><path d="M119.56,162.24s5.54,23.25,6,27.2S120,204.38,119,202.29c-1.4-2.73-2.8-13.1-2.8-13.1Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M129.57,188.57a1,1,0,0,0,.54.91,1.49,1.49,0,0,0,1.17-.19c2.76-1.31,4.37-3.22,6.43-5.28a27.06,27.06,0,0,0,4.23-4.72c.94-1.57.15-8.43-.76-8.54s-.77,2.09-.61,3.46-1.33,3-1.7,3.66-1.63-.55-2.76,1.33c-.83,1.39-.86,2.42-2.08,3.56a27.68,27.68,0,0,0-3.88,4.42,2.7,2.7,0,0,0-.57,1.18A1.48,1.48,0,0,0,129.57,188.57Z" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><path d="M120.44,190c.19-.32,13.48-8,13.48-8s1.72,1.05,3,4.28c0,0-16,15.45-17.32,16.14s.55-2.5-1.69-6.84S120.44,190,120.44,190Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M81.65,304.64a9,9,0,0,0-2.79,3,3.06,3.06,0,0,0,.69,3.75,3.74,3.74,0,0,0,1.53.54,13.7,13.7,0,0,0,12.37-4.23,3.2,3.2,0,0,1,.91-.81c.78-.39,1.76,0,2.6-.3,1.17-.41,1.53-1.87,1.7-3.11s.31-2.75-.56-3.7c-.9,1.49-2.85,1.93-4.59,2a7.77,7.77,0,0,1-3.14-.31c-.94-.34-1.7-1.34-2.78-1.2s-2,1.23-2.76,1.83Z" transform="translate(-25.26 -2.57)" fill="#3f3d56"/><path d="M124.78,304.64a9,9,0,0,1,2.79,3,3.06,3.06,0,0,1-.69,3.75,3.74,3.74,0,0,1-1.53.54A13.7,13.7,0,0,1,113,307.71a3.2,3.2,0,0,0-.91-.81c-.78-.39-1.76,0-2.6-.3-1.17-.41-1.53-1.87-1.7-3.11s-.31-2.75.56-3.7c.9,1.49,2.85,1.93,4.59,2a7.77,7.77,0,0,0,3.14-.31c.94-.34,1.7-1.34,2.78-1.2s2,1.23,2.76,1.83Z" transform="translate(-25.26 -2.57)" fill="#3f3d56"/><path d="M98.06,186.35c.42-.29,1-.41,1.48-.75s6.31-4.23,6.76-3.2c.2.47-.23,1-.64,1.3s-.89.72-.8,1.24l5.92-2.92a.51.51,0,0,1,.33-.08c.2,0,.28.27.32.48a5.74,5.74,0,0,1-1.07,4.17,12.11,12.11,0,0,1-5.85,4.25c-3,1-5.75,2.38-6.51.09-.34-1-.93-2.65-.55-3.75A1.55,1.55,0,0,1,98.06,186.35Z" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><path d="M86,161.69a17,17,0,0,0-4.41,4.42c-1.93,2.85-5.12,26.75-3.65,33.23.62,2.74,23.17-7.49,23.17-7.49s-.52-4.58-2.91-6.14c0,0-11.06,2.37-11.89,1.54S86,161.69,86,161.69Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M93.77,139.47s-.26,10.37,3.73,13,5.58,2.26,8.44.93c1.73-.81,3-7.15,3.73-12a9.62,9.62,0,0,0-6.25-10.59,6.45,6.45,0,0,0-4.6,0A7.81,7.81,0,0,0,93.77,139.47Z" transform="translate(-25.26 -2.57)" fill="#eacbc6"/><path d="M109.74,141a6.66,6.66,0,0,0,.49-1.63,13.6,13.6,0,0,0-.61-5.57,10.22,10.22,0,0,0-1.09-3,5.1,5.1,0,0,0-2.1-1.86c-.46,0-.88-.47-1.22-.78a3.23,3.23,0,0,0-2.52-.58c-.88.1-1.73.38-2.62.46-1.51.14-3.25-.26-4.41.72a8.54,8.54,0,0,0-1.44,2.29c-.41.69-1,1.26-1.46,1.91a3.37,3.37,0,0,0-.77,2.23,11.61,11.61,0,0,0,.71,2.08,28.76,28.76,0,0,1,.31,3.35c.24,1.29,1,2.46,1,3.76l.27-6.86a1,1,0,0,1,.11-.55c.21-.34.68-.36,1.07-.46.93-.24,1.59-1.1,2.49-1.44a4.69,4.69,0,0,1,1.94-.16l4.93.24a1.77,1.77,0,0,1,.85.2,5,5,0,0,1,.53.49c.55.45,1.37.36,2,.72.86.5,1,1.66,1.05,2.66l.18,3.71A4.39,4.39,0,0,1,109.74,141Z" transform="translate(-25.26 -2.57)" fill="#3f3d56"/><path d="M96.48,155.27s2.48,5.94,5.37,6.84l-5,3.45-1.69-9Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M107,155l1,1.07-.8,9.25-5.4-3.25S106.3,158.93,107,155Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M96.48,155.27s2.48,5.94,5.37,6.84l-5,3.45-1.69-9Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-6)"/><path d="M107,155l1,1.07-.8,9.25-5.4-3.25S106.3,158.93,107,155Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-7)"/><path d="M218.88,222.57c1.3,12.13-3,37.08-16.46,42-3.31,1.21-6.9,1.36-10.43,1.47q-20.7.68-41.42.34a112.46,112.46,0,0,1-16.51-1.14c-2.66-.44-5.41-1.11-7.48-2.84-3.49-2.94-4.06-8.55-1.71-12.47s7.09-6,11.65-5.85a10.15,10.15,0,0,1-9.42-15.32c3.21-5.38,10.34-6.6,16.57-7.27-3.92-4.7-6.84-10.49-7-16.61s2.9-12.53,8.38-15.26,13.18-.76,15.77,4.79c-2-10.39.72-21.81,7.93-29.56,6.48-7,19.6-12.47,29-8.28,9,4,12.35,17.66,14.34,26.2A330.91,330.91,0,0,1,218.88,222.57Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M218.88,222.57c1.3,12.13-3,37.08-16.46,42-3.31,1.21-6.9,1.36-10.43,1.47q-20.7.68-41.42.34a112.46,112.46,0,0,1-16.51-1.14c-2.66-.44-5.41-1.11-7.48-2.84-3.49-2.94-4.06-8.55-1.71-12.47s7.09-6,11.65-5.85a10.15,10.15,0,0,1-9.42-15.32c3.21-5.38,10.34-6.6,16.57-7.27-3.92-4.7-6.84-10.49-7-16.61s2.9-12.53,8.38-15.26,13.18-.76,15.77,4.79c-2-10.39.72-21.81,7.93-29.56,6.48-7,19.6-12.47,29-8.28,9,4,12.35,17.66,14.34,26.2A330.91,330.91,0,0,1,218.88,222.57Z" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-8)"/><rect x="272.73" y="85.21" width="20" height="49.99" fill="#1259af"/><rect x="272.73" y="85.21" width="20" height="49.99" fill="url(#linear-gradient-9)"/><rect x="268.64" y="78.12" width="28.17" height="9.58" rx="2.32" fill="#1259af"/><polygon points="222.32 72.71 150.25 144.45 150.25 164.77 150.25 259.34 302.72 259.34 302.72 164.77 302.72 151.23 222.32 72.71" fill="#1259af"/><polygon points="222.32 72.71 150.25 144.45 150.25 164.77 150.25 259.34 302.72 259.34 302.72 164.77 302.72 151.23 222.32 72.71" fill="url(#linear-gradient-10)"/><g opacity="0.2" style="mix-blend-mode:multiply"><path d="M249.67,70.39l-74.15,73.94V156.1l74.15-70.3L328,160.06v-7.4a2.17,2.17,0,0,0,1.49-3.76Z" transform="translate(-25.26 -2.57)" fill="#1259af"/></g><rect x="144.32" y="259.34" width="164.34" height="12.08" fill="#1259af"/><rect x="169.52" y="183" width="58.74" height="48.74" fill="#1259af"/><rect x="169.52" y="183" width="58.74" height="48.74" fill="url(#linear-gradient-11)"/><rect x="248.25" y="180.81" width="38.74" height="78.53" fill="#1259af"/><rect x="251.39" y="185.81" width="32.47" height="69.46" fill="#1259af"/><rect x="251.39" y="185.81" width="32.47" height="69.46" fill="url(#linear-gradient-12)"/><rect x="245.65" y="176.44" width="44.16" height="6.56" rx="1.69" fill="#1259af"/><path d="M246.22,70.31,166.75,147.6a5,5,0,0,0,3.45,8.5h0a4.94,4.94,0,0,0,3.42-1.37l72.64-69.12a4.94,4.94,0,0,1,6.82,0l72.64,69.12a4.93,4.93,0,0,0,3.41,1.37h0a5,5,0,0,0,3.45-8.5L253.12,70.31A4.94,4.94,0,0,0,246.22,70.31Z" transform="translate(-25.26 -2.57)" fill="#1259af"/><rect x="167.83" y="180.81" width="62.12" height="2.19" fill="#1259af"/><rect x="183.84" y="183" width="1.98" height="44.68" fill="#1259af"/><rect x="197.9" y="183" width="1.98" height="44.68" fill="#1259af"/><rect x="211.96" y="183" width="1.98" height="44.68" fill="#1259af"/><rect x="169.52" y="206.54" width="58.74" height="1.67" fill="#1259af"/><path d="M251.73,231a6.18,6.18,0,0,0,3.31-5.14c0-1-.35-2.14-1.3-2.28a2.2,2.2,0,0,0-1.16.27,8.73,8.73,0,0,0-2.83,2.14,8.73,8.73,0,0,0,.35-3,2.65,2.65,0,0,0-4.79-1.58,7.75,7.75,0,0,0-1.58,3.15,9.46,9.46,0,0,0-3.14-4.22,2,2,0,0,0-.82-.41,1.79,1.79,0,0,0-1,.24,5.68,5.68,0,0,0-3.08,4.74,1.83,1.83,0,0,0-1.58-1.34,1.21,1.21,0,0,0-1.21,1.45,5.62,5.62,0,0,0-5.5-1.54,4.26,4.26,0,0,0-2.94,4.63,1.76,1.76,0,0,0-2.38,1.25,3.6,3.6,0,0,0,.83,2.9" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M195.26,230.9,193,229a2.42,2.42,0,0,1-1-1.41c-.1-1,1-1.65,2-1.49a4.69,4.69,0,0,1,2.37,1.55c-.28-2.08-.43-4.51,1.1-6a4.11,4.11,0,0,1,4.44-.51,6.83,6.83,0,0,1,3.13,3.42,11.25,11.25,0,0,1,3.85-5.52,1.29,1.29,0,0,1,2,.07,7.56,7.56,0,0,1,2.34,5.63,10.33,10.33,0,0,1,1.05-1.86.89.89,0,0,1,.46-.4c.31-.09.6.15.83.37.6.59,1.2,1.37,1,2.18a7.41,7.41,0,0,1,2-3.5c1-.87,2.86-.95,3.61.18a3.11,3.11,0,0,1,.36,2,9.55,9.55,0,0,1-1.38,4.13c0-.49.74-.68,1.13-.39a1.44,1.44,0,0,1,.43,1.32c0,.48-.22.95-.24,1.44" transform="translate(-25.26 -2.57)" fill="#1259af"/><path d="M251.73,231a6.18,6.18,0,0,0,3.31-5.14c0-1-.35-2.14-1.3-2.28a2.2,2.2,0,0,0-1.16.27,8.73,8.73,0,0,0-2.83,2.14,8.73,8.73,0,0,0,.35-3,2.65,2.65,0,0,0-4.79-1.58,7.75,7.75,0,0,0-1.58,3.15,9.46,9.46,0,0,0-3.14-4.22,2,2,0,0,0-.82-.41,1.79,1.79,0,0,0-1,.24,5.68,5.68,0,0,0-3.08,4.74,1.83,1.83,0,0,0-1.58-1.34,1.21,1.21,0,0,0-1.21,1.45,5.62,5.62,0,0,0-5.5-1.54,4.26,4.26,0,0,0-2.94,4.63,1.76,1.76,0,0,0-2.38,1.25,3.6,3.6,0,0,0,.83,2.9" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-13)"/><rect x="166.01" y="227.68" width="65.77" height="13.75" rx="3.7" fill="#1259af"/><path d="M195.26,230.9,193,229a2.42,2.42,0,0,1-1-1.41c-.1-1,1-1.65,2-1.49a4.69,4.69,0,0,1,2.37,1.55c-.28-2.08-.43-4.51,1.1-6a4.11,4.11,0,0,1,4.44-.51,6.83,6.83,0,0,1,3.13,3.42,11.25,11.25,0,0,1,3.85-5.52,1.29,1.29,0,0,1,2,.07,7.56,7.56,0,0,1,2.34,5.63,10.33,10.33,0,0,1,1.05-1.86.89.89,0,0,1,.46-.4c.31-.09.6.15.83.37.6.59,1.2,1.37,1,2.18a7.41,7.41,0,0,1,2-3.5c1-.87,2.86-.95,3.61.18a3.11,3.11,0,0,1,.36,2,9.55,9.55,0,0,1-1.38,4.13c0-.49.74-.68,1.13-.39a1.44,1.44,0,0,1,.43,1.32c0,.48-.22.95-.24,1.44" transform="translate(-25.26 -2.57)" fill="url(#linear-gradient-14)"/><rect x="181.47" y="235.17" width="8.5" height="59.63" fill="#1259af"/><rect x="181.47" y="235.17" width="8.5" height="59.63" fill="url(#linear-gradient-15)"/><rect x="157.88" y="238.26" width="52.43" height="28.84" fill="#1259af"/><rect x="157.66" y="238.26" width="52.43" height="28.84" fill="url(#linear-gradient-16)"/><path d="M192.23,252.45a2.6,2.6,0,0,0-.88-.76,2.66,2.66,0,0,0-1.28-.29,2.76,2.76,0,0,0-.79.12,2.32,2.32,0,0,0-.72.36,2,2,0,0,0-.53.62,1.8,1.8,0,0,0-.2.87,1.7,1.7,0,0,0,.19.83,1.78,1.78,0,0,0,.51.55,2.8,2.8,0,0,0,.73.38l.84.3c.37.11.73.24,1.1.38a4.17,4.17,0,0,1,1,.54,2.49,2.49,0,0,1,.72.85,2.62,2.62,0,0,1,.28,1.29,2.86,2.86,0,0,1-.3,1.35,2.74,2.74,0,0,1-.77.94,3.3,3.3,0,0,1-1.09.55,4.43,4.43,0,0,1-1.24.18,4.38,4.38,0,0,1-1-.1,4.11,4.11,0,0,1-.9-.29,3.31,3.31,0,0,1-.8-.49,3.23,3.23,0,0,1-.65-.68l.92-.68a2.76,2.76,0,0,0,1,.94,2.63,2.63,0,0,0,1.44.38,3,3,0,0,0,.82-.12,2.55,2.55,0,0,0,.75-.39,2,2,0,0,0,.54-.64,1.67,1.67,0,0,0,.22-.88,1.73,1.73,0,0,0-.22-.91,1.81,1.81,0,0,0-.57-.6,3.08,3.08,0,0,0-.81-.41l-1-.33a8.84,8.84,0,0,1-1-.37,3.09,3.09,0,0,1-.91-.54,2.49,2.49,0,0,1-.64-.82,3,3,0,0,1,.06-2.5,2.85,2.85,0,0,1,.79-.9,3.37,3.37,0,0,1,1.08-.52,4.39,4.39,0,0,1,1.17-.16,4,4,0,0,1,1.82.38,3.22,3.22,0,0,1,1.14.89Z" transform="translate(-25.26 -2.57)" fill="#fff"/><path d="M198.86,261.24h-1.17l4.53-10.47h1l4.5,10.47h-1.18l-1.16-2.75H200Zm1.54-3.73H205L202.7,252Z" transform="translate(-25.26 -2.57)" fill="#fff"/><path d="M213.79,260.29h4.88v.95h-5.95V250.77h1.07Z" transform="translate(-25.26 -2.57)" fill="#fff"/><path d="M224.68,260.29h5.61v.95h-6.68V250.77h6.5v.94h-5.43v3.6h5.07v.95h-5.07Z" transform="translate(-25.26 -2.57)" fill="#fff"/></g></g></svg>

                    </div>

                    <h3>
                        You have successfully created an account.
                    </h3>

                    <p>
                        You can now enjoy all the features of Profenda Dashboard.
                    </p>

                </div>

            </div>

            <script>
                document.cookie = "new_user_message=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            </script>

        <?php endif;

    }

}
