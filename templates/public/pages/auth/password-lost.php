<?php

use ShippingAppointments\Service\Auth\Password;

get_header();

global $TRP_LANGUAGE;
$passwordResetHandler = new Password();

// Check if the user just requested a new password
$attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

$attributes['errors'] = array();

if ( isset( $_REQUEST['errors'] ) ) {

    $error_codes = explode( ',', $_REQUEST['errors'] );

    foreach ( $error_codes as $error_code ) {

        $attributes['errors'] []= $passwordResetHandler->get_error_message( $error_code );

    }

}

?>

    <section id="pageHeader" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-50">

        <div class="container">

            <div class="col s12 flex flex-dir-col flex-center flex-just-center">

                <?php if ( count( $attributes['errors'] ) > 0 ) : ?>

                    <?php foreach ( $attributes['errors'] as $error ) : ?>

                        <div class="card auth-message lost-password-message">

                            <div class="lost-password-message-icon error left">
                                <i class="fas fa-exclamation"></i>
                            </div>

                            <?php echo $error; ?>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php if ( $attributes['lost_password_sent'] ) : ?>

                    <div class="card auth-message lost-password-message">

                        <div class="lost-password-message-icon success left">
                            <i class="fas fa-check"></i>
                        </div>

                        An email has been sent to the email address you provided to reset your password.
                    </div>

                <?php endif; ?>

                <div class="login-card card padding-bottom-50 padding-top-30 <?php echo ( isset( $_GET['checkemail'] ) &&  $_GET['checkemail'] === 'confirm'  ? 'password-email-sent': ''); ?>">

                    <div class="brand-logo">

                        <a href="<?php echo site_url(); ?>">

                            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108.2 64"  xml:space="preserve"><style type="text/css"> .st0{fill:#E1ECFD;}.st1{fill:url(#SVGID_1_);}.st2{fill:#0B4D9D;}.st3{fill:#0966D7;}.st4{fill:#FFFFFF;}.st5{fill:#1259AF;}</style> <path class="st0" d="M19.9,8L19.9,8c2.2,0,4-1.8,4-4l0,0c0-2.2-1.8-4-4-4l0,0c-2.2,0-4,1.8-4,4l0,0C15.9,6.2,17.7,8,19.9,8z"/> <path class="st0" d="M14.4,64L14.4,64c1.9,0,3.5-1.6,3.5-3.5l0,0c0-1.9-1.6-3.5-3.5-3.5l0,0c-1.9,0-3.5,1.6-3.5,3.5l0,0 C10.9,62.4,12.5,64,14.4,64z"/> <path class="st0" d="M105.1,20.5L105.1,20.5c0-2.5-3.5-4.5-7.9-4.5H73.5c-3.9,0-7-1.8-7-4l0,0c0-2.2,3.1-4,7-4H77c3.9,0,7-1.8,7-4 l0,0c0-2.2-3.1-4-7-4H35c-3.9,0-7,1.8-7,4l0,0c0,2.2,3.1,4,7,4h3.5c2.9,0,5.3,1.3,5.3,3l0,0c0,1.7-2.4,3-5.3,3H14.8 c-3.4,0-6.1,1.6-6.1,3.5l0,0c0,1.9,2.7,3.5,6.1,3.5h4.4c2.9,0,5.3,1.3,5.3,3l0,0c0,1.7-2.4,3-5.3,3h-8.8c-4.8,0-8.8,2.2-8.8,5l0,0 c0,2.8,3.9,5,8.8,5H20c3.4,0,6.1,1.6,6.1,3.5l0,0c0,1.9-2.7,3.5-6.1,3.5h-7.9c-3.9,0-7,1.8-7,4l0,0c0,2.2,3.1,4,7,4h14.9 c2.4,0,4.4,1.1,4.4,2.5l0,0c0,1.4-2,2.5-4.4,2.5l0,0c-3.4,0-6.1,1.6-6.1,3.5l0,0c0,1.9,2.7,3.5,6.1,3.5h52.6c3.4,0,6.1-1.6,6.1-3.5 l0,0c0-1.9-2.7-3.5-6.1-3.5h-0.9c-1.9,0-3.5-0.9-3.5-2l0,0c0-1.1,1.6-2,3.5-2h12.3c3.9,0,7-1.8,7-4l0,0c0-2.2-3.1-4-7-4H79.7 c-2.4,0-4.4-1.1-4.4-2.5l0,0c0-1.4,2-2.5,4.4-2.5h0.9c3.9,0,7-1.8,7-4l0,0c0-2.2-3.1-4-7-4h-2.6c-3.4,0-6.1-1.6-6.1-3.5l0,0 c0-1.9,2.7-3.5,6.1-3.5h19.3C101.6,25,105.1,23,105.1,20.5z"/> <path class="st0" d="M68.9,40L68.9,40c-2.2,0-4-1.8-4-4l0,0c0-2.2,1.8-4,4-4l0,0c2.2,0,4,1.8,4,4l0,0C72.9,38.2,71.2,40,68.9,40z"/> <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="31.2665" y1="60.5" x2="31.2665" y2="37.5" gradientTransform="matrix(1 0 0 -1 0 66)"> <stop offset="0" style="stop-color:#7E87A6"/> <stop offset="0.63" style="stop-color:#7E87A6"/> <stop offset="1" style="stop-color:#7E87A6"/> <stop offset="1" style="stop-color:#6F6F6F"/> </linearGradient> <path class="st1" d="M31.3,5.5c-7.2,0-13,5.8-13,13v10h5v-10c0-4.4,3.6-8,8-8s8,3.6,8,8v10h5v-10C44.3,11.3,38.4,5.5,31.3,5.5z"/> <path class="st2" d="M48.3,56.5h-34c-1.7,0-3-1.3-3-3v-19c0-5.5,4.5-10,10-10h20c5.5,0,10,4.5,10,10v19 C51.3,55.2,49.9,56.5,48.3,56.5z"/> <g> <path class="st3" d="M11.3,34.5v4h7.4c1.3,0,2.5-0.9,2.6-2.2c0.1-1.5-1-2.8-2.5-2.8h-0.4c-1,0-1.9-0.7-2.1-1.7 c-0.2-1.3,0.8-2.3,2-2.3h5c1.3,0,2.5-0.9,2.6-2.2c0.1-1.5-1-2.8-2.5-2.8h-2.1C15.7,24.5,11.3,29,11.3,34.5z"/> </g> <path class="st3" d="M40.3,42.5L40.3,42.5c0,1.7,1.3,3,3,3h0.5c1.4,0,2.5,1.1,2.5,2.5l0,0c0,1.4-1.1,2.5-2.5,2.5h-4.5 c-1.7,0-3,1.3-3,3l0,0c0,1.7,1.3,3,3,3h9c1.7,0,3-1.3,3-3v-14h-8C41.6,39.5,40.3,40.8,40.3,42.5z"/> <g> <path class="st4" d="M31.3,47.5c-1.1,0-2,0.9-2,2s0.9,2,2,2c1.1,0,2-0.9,2-2S32.4,47.5,31.3,47.5z M31.3,45.5c-1.1,0-2-0.9-2-2 c0-2.3,1.5-3.6,2.5-4.5c1-0.9,1.5-1.3,1.5-2.4c0-0.8-0.3-2.1-2-2.1c-1.7,0-2,1.3-2,2.1c0,1.1-0.9,2-2,2s-2-0.9-2-2 c0-3.6,2.5-6.1,6-6.1s6,2.5,6,6.1c0,3-1.7,4.5-2.9,5.4c-0.9,0.8-1.1,1-1.1,1.4C33.3,44.6,32.4,45.5,31.3,45.5z"/> </g> <polygon class="st5" points="61.3,29.9 61.3,51.4 67.2,51.4 67.2,33 79,24.7 91.7,33.1 91.7,51.4 97.6,51.4 97.6,29.9 78.9,17.6 "/> <polygon class="st5" points="83.7,51.4 83.7,35.6 74.3,35.6 74.3,51.4 66.5,56.4 76.2,56.4 "/></svg>

                        </a>

                    </div>

                    <div id="password-lost-form" class="widecolumn">

                        <h1 class="font-weight-700 center">
                            Forgot Your Password?
                        </h1>

                        <p class="account-page-description center">
                            Locked out? Enter your email address and we'll send instructions to reset your password and get you back on track.
                        </p>

                        <form id="lostpasswordform" action="<?php echo site_url('wp-login.php/?action=lostpassword'); ?>" method="post" class="col s12">

                            <input type="hidden" name="current_lang" value="<?php echo $TRP_LANGUAGE; ?>">

                            <div class="col s12">

                                <div class="input-field">

                                    <label for="user_login">Your email</label>
                                    <input type="text" name="user_login" id="user_login" placeholder="<?php _e( 'Email address', 'Profenda' ); ?>">

                                </div>

                            </div>

                            <div class="col s12">

                                <button type="submit" name="submit"  class="lostpassword-button homi-btn full-width">
                                    Send me instructions
                                </button>

                            </div>

                        </form>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </section>

<?php

get_footer();
