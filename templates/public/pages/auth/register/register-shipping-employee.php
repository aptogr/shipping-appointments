<?php

use ShippingAppointments\Service\Entities\ShippingInvitation;

get_header();

$invitation = false;
if( get_query_var('invitation') ){

    $postID     = base64_decode( get_query_var('invitation') );
    $invitation = new ShippingInvitation( $postID );

}

?>


	<section id="homiLogin" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-80">

		<div class="container">

			<div class="col s12 flex flex-center flex-just-center">

				<div class="login-card card center display-block">

					<div class="flex">

						<div class="login-content register-content">

                            <?php if( ! $invitation instanceof ShippingInvitation ): ?>

                                <div class="col s12">

                                    <div class="brand-logo">

                                        <a href="<?php echo site_url(); ?>">

				                            <?php echo wp_get_attachment_image( 424, 'original'); ?>

                                        </a>

                                    </div>

                                    <h1 class="font-weight-700">
                                        Create a new account
                                    </h1>

                                    <p class="account-page-description">
                                        You need an invitation code from the company or the department administrator in order to create an account as an employee.
                                    </p>

                                    <div class="input-field col s12">

                                        <label for="invitation_code">Your Invitation Code</label>
                                        <input id="invitation_code" type="text" name="invitation_code" placeholder="Enter your invitation code">

                                    </div>

                                    <div class="col s12 center">
                                        <a href="#registerModal" id="login-btn"  class="profenda-btn filled trigger-modal" >
                                            <svg style="padding: 3px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787L338.213,256L482,112.212V399.787z"></path></g></g></svg>
				                            <?php echo __('Register with your Email', 'Profenda'); ?>
                                        </a>
                                    </div>


                                    <div class="col s12 login-extra-links">

                                        <p>

                                            You already have an account?
                                            <a class="link-en_US" href="<?php echo wp_login_url(); ?>">
                                                Login Now
                                            </a>
                                        </p>

                                    </div>

                                </div>


                            <?php else: ?>

                                <div class="col s12">

                                    <div class="brand-logo">

                                        <a href="<?php echo site_url(); ?>">

			                                <?php echo wp_get_attachment_image( 424, 'original'); ?>

                                        </a>

                                    </div>

                                    <div class="col s12">

                                        <div class="invitation-register-item flex flex-center full-width">

                                            <div class="company-logo display-inline-block">
			                                    <?php echo get_the_post_thumbnail( $invitation->companyObject->ID, 'thumbnail'); ?>
                                            </div>

                                            <div class="content display-inline-block">

                                                <p>
                                                    An administrator from <strong><?php echo get_the_title( $invitation->companyObject->ID ); ?></strong> has invited you to join the platform
                                                    as a <strong><?php echo $invitation->getFieldToString('role'); ?></strong> for the
                                                    <strong><?php echo $invitation->departmentObject->departmentType->term->name; ?></strong> of the company.
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                    <?php if( $invitation->status === 'pending' ): ?>

                                    <form action="<?php echo site_url('/register'); ?>"  method="POST" enctype="multipart/form-data" class="full-width">

                                        <input type="hidden" name="new_user" id="new_user">
                                        <input type="hidden" name="role" id="role" value="<?php echo $invitation->role; ?>">
                                        <input type="hidden" name="company" value="<?php echo $invitation->companyObject->ID; ?>">
                                        <input type="hidden" name="department" value="<?php echo $invitation->departmentObject->ID; ?>">
                                        <input type="hidden" name="invitation" value="<?php echo $invitation->ID; ?>">

		                                <?php

		                                if( isset( $_GET['redirect_to'] ) ){

			                                $urlParts = parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_QUERY);

			                                if( strpos( $urlParts, 'redirect_to=') !== false ){

				                                $redirectLink = str_replace('redirect_to=', '', $urlParts );

				                                ?>
                                                <input type="hidden" name="redirect_to" value="<?php echo $redirectLink; ?>">
				                                <?php

			                                }

		                                }

		                                ?>

                                        <div class="input-field col s12 margin-bottom-30">

                                            <label for="user_email">Email Address: </label>
                                            <input type="text" id="user_email" name="user_email" class="validate check_email" value="<?php echo $invitation->email; ?>" size="40" readonly required>

                                            <label class="hide">

                                                <input type="checkbox" id="email_available" name="email_available" />
                                                <span>Email available</span>

                                            </label>

                                            <div class="email-message invalid hide">
                                                There's already an account with the email address you entered. Click <a href="<?php echo site_url('login'); ?>">here</a> to login with your email.
                                            </div>

                                        </div>

                                        <div class="input-field col l6 s12 margin-bottom-30">

                                            <label for="first_name">First Name: </label>
                                            <input type="text" id="first_name" name="first_name" class="validate" value="" size="40" required>

                                        </div>

                                        <div class="input-field col l6 s12 margin-bottom-30">

                                            <label for="last_name">Last Name: </label>
                                            <input type="text" id="last_name" name="last_name" class="validate" value="" size="40" required>

                                        </div>

                                        <div class="input-field col l6 s12 margin-bottom-30">

                                            <label for="user_pass">Password: </label>
                                            <input type="password" id="user_pass" name="user_pass" class="validate" value="" size="40" required>

                                        </div>

                                        <div class="input-field col l6 s12">

                                            <label for="repeat_password">Repeat Password: </label>
                                            <input type="password" id="repeat_password" name="repeat_password" class="validate" value="" size="40" required>

                                        </div>

                                        <div class="col s12 center margin-top-30 margin-bottom-30">

                                            <button id="" class="profenda-btn filled full-width" type="submit">
				                                <?php echo __('Create Account', 'Profenda'); ?>
                                            </button>

                                        </div>

                                        <div class="clearfix"></div>

                                    </form>

                                    <?php else: ?>

                                        <h3 class="font-weight">
                                            <?php if( $invitation->status === 'expired' ): ?>

                                                Your invitation has expired. Please contact your company in order to send you a new invitation code for the platform.

                                            <?php else: ?>

                                                There's already a user in the platform with this invitation.

                                            <?php endif; ?>
                                        </h3>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>

	<div id="registerModal" class="login-modal fixed top-0 left-0 full-width hide">

		<div class="login-modal-content">


		</div>


	</div>

<?php
get_footer();
