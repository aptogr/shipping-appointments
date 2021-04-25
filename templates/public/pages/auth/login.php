<?php

use ShippingAppointments\Service\Auth\AuthPermalinks;

get_header();
?>


    <section id="homiLogin" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-50">

        <div class="col s12">

            <?php if( isset( $_GET['login'] ) && $_GET['login'] === 'failed'): ?>

                <div class="login-card failed-login card center">
                    The credentials you entered are invalid. If you forgot your password click <a href="<?php echo wp_lostpassword_url(); ?>">here</a> to reset it.
                </div>

            <?php endif; ?>

            <?php if( isset( $_GET['password'] ) && $_GET['password'] === 'changed'): ?>

                <div class="login-card failed-login card center">

                <span class="lost-password-message-icon success">
                    <i class="fas fa-check"></i>
                </span>

                    <?php _e( 'Your password has been changed successfully. Login with your new credentials.', 'Profenda' ); ?>

                </div>

            <?php endif; ?>

            <div class="login-card card display-block">

                <div class="brand-logo">

                    <a href="<?php echo site_url(); ?>">
                        <?php echo wp_get_attachment_image( 424, 'original'); ?>
                    </a>

                </div>

                <h1 class="center font-weight-700">
                    Sign in to your account
                </h1>

                <p class="account-page-description center">
                    Welcome back! Login to access all the Profenda features.
                </p>

                <form action="<?php echo site_url( 'wp-login.php' ); ?>"  method="post">

                    <?php if( isset( $_GET['redirect_to'] ) ): ?>
                        <input type="hidden" name="redirect_to" value="<?php echo $_GET['redirect_to']; ?>">
                    <?php endif; ?>

                    <div class="input-field col s12">
                        <label for="user_login">Email Address: </label>
                        <input type="text" name="log" id="user_login" class="validate" value="<?php echo (  isset( $_GET['e'] ) && !empty( $_GET['e'] ) ? base64_decode( $_GET['e'] ) : '' ); ?>" size="40" required>
                    </div>

                    <div class="input-field col s12">
                        <label for="user_pass">Password</label>
                        <input type="password" name="pwd" id="user_pass" class="validate"  value="" size="40" required>
                    </div>

                    <div class="input-field col s12 remember-field">
                        <label>
                            <input id="rememberme" name="rememberme" type="checkbox"  />
                            <span>
                           Remember me
                        </span>

                        </label>
                    </div>

                    <div class="col s12 center">
                        <button id="login-btn" type="submit" class="profenda-btn filled" name="apto-login" >
                            <svg style="padding: 3px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787L338.213,256L482,112.212V399.787z"></path></g></g></svg>
                            <span><?php echo __('Sign in with Email', 'Profenda'); ?></span>
                        </button>
                    </div>


                </form>

                <div class="col s12 login-extra-links center">

                    <p>

                        Did you

                        <a class="link-en" href="<?php echo site_url( AuthPermalinks::PASSWORD_LOST_URL ) ; ?>">
                            forget your password?
                        </a>

                    </p>

                    <p class="no-margin-top">

                        <?php

                           $redirect = ( isset( $_GET['redirect_to'] ) && !empty( $_GET['redirect_to'] ) ? '?redirect_to='.$_GET['redirect_to'] : '' );

                        ?>

                        Don't have an account?
                        <a class="link-en"  href="<?php echo home_url( 'register/' . $redirect ) ; ?>">
                            Register Now
                        </a>
                    </p>

                </div>

                <div class="clearfix"></div>

            </div>

        </div>

    </section>

<?php get_footer();


