<?php


namespace ShippingAppointments\Service\Auth;


class LoginModal {


    public function displayLoginModal(){

        global $TRP_LANGUAGE;
        ?>

        <div class="modal-overlay"></div>

        <?php if( !is_user_logged_in() ): ?>

        <div id="loginModal" class="login-modal fixed top-0 left-0 full-width hide">

            <div class="login-modal-content">

                <h2 class="center font-weight-700">
                    You need to login in order to continue
                </h2>

                <form action="<?php echo site_url( 'wp-login.php' ); ?>"  method="post">

                    <input id="redirectUrl" type="hidden" name="redirect_to" value="">

                    <div class="input-field col s12">
                        <label for="user_login">Email Address: </label>
                        <input type="text" name="log" id="user_login" class="validate" value="<?php echo (  isset( $_GET['e'] ) && !empty( $_GET['e'] ) ? base64_decode( $_GET['e'] ) : '' ); ?>" size="40" required>
                    </div>

                    <div class="input-field col s12">
                        <label for="user_pass">Password</label>
                        <input type="password" name="pwd" id="user_pass" class="validate"  value="" size="40" required>
                    </div>

                    <div class="input-field col s12 forgetmenot">
                        <label>
                            <input id="rememberme" name="rememberme" type="checkbox"  />
                            <span>
                           Remember me
                        </span>

                        </label>
                    </div>

                    <div class="col s12 center">
                        <button id="login-btn" type="submit" class="homi-btn filled" name="apto-login" >
                            <svg style="padding: 3px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787L338.213,256L482,112.212V399.787z"/></g></g></svg>
                            Sign in with Email
                        </button>
                    </div>

                    <div class="social-login-buttons col s12 margin-bottom-30">

                        <a href="<?php echo site_url('wp-login.php?loginSocial=google'); ?>" class="social-login-btn homi-btn" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                            <svg viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg"><path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/><path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/><path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"/><path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/></svg>
                            Sign in with Google
                        </a>

                        <a href="<?php echo site_url('wp-login.php?loginSocial=facebook'); ?>" class="social-login-btn homi-btn" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="475" data-popupheight="175">
                            <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 155.139 155.139" style="enable-background:new 0 0 155.139 155.139;" xml:space="preserve"><g><path id="f_1_" style="fill:#4267B2;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452v20.341H37.29v27.585h23.814v70.761H89.584z"/></g></svg>
                            Sign in with Facebook
                        </a>

                        <a id="registerModalBtn" href="<?php echo site_url( 'register' ); ?>" class="social-login-btn homi-btn">
                            <svg style="padding: 3px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787L338.213,256L482,112.212V399.787z"/></g></g></svg>
                            Register with Email
                        </a>

                    </div>

                </form>

                <div class="col s12 login-extra-links center">

                    <p class="no-margin-bottom">

                        Did you

                        <?php global $TRP_LANGUAGE;  ?>


                        <a class="link-<?php echo $TRP_LANGUAGE; ?>" href="<?php echo ( $TRP_LANGUAGE === 'el' ? 'https://homi.com.gr/el/password-lost/' : site_url( AuthPermalinks::PASSWORD_LOST_URL ) ) ; ?>">
                            forget your password?
                        </a>

                    </p>

                </div>

            </div>

        </div>

        <?php endif; ?>

        <?php

    }

}
