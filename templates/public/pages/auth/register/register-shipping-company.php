<?php

get_header();

?>


	<section id="homiLogin" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-50">

		<div class="container">

			<div class="col s12 flex flex-center flex-just-center">

				<div class="login-card card center display-block">

					<div class="flex">

						<div class="login-content register-content full-width">

							<div class="col s12">

								<div class="brand-logo">

									<a href="<?php echo site_url(); ?>">

										<?php echo wp_get_attachment_image( 424, 'original'); ?>

									</a>

								</div>

								<h1 class="font-weight-700">
									Register a Shipping Company
								</h1>

								<p class="account-page-description">
									Register fields here for new shipping company
								</p>

                                <form action="<?php echo site_url('/register'); ?>"  method="POST" enctype="multipart/form-data" class="full-width">

                                    <input type="hidden" name="new_shipping_company" id="new_user">
                                    <input type="hidden" name="role" id="role" value="shipping_company_admin">

                                    <div id="main-navigation" class="margin-top-20">

                                        <ul class="links-container">

                                            <li class="tab-link active">
                                                Company Registration
                                            </li>

                                            <li class="tab-link">
                                                Personal Information
                                            </li>

                                        </ul>

                                    </div>

                                    <article id="pages-container">

                                        <div id="pages-container-inner">

                                            <div class="swiper-wrapper">

                                                <div class="swiper-slide swiper-no-swiping">

                                                    <div class="input-field col s12 margin-bottom-30">

                                                        <label for="company_name">Company Name: </label>
                                                        <input type="text" id="company_name" name="company_name" class="validate" value="" size="40" required>

                                                    </div>

                                                    <div class="input-field col l6 s12 margin-bottom-30">

                                                        <label for="company_email">Company Email: </label>
                                                        <input type="email" id="company_email" name="company_email" class="validate" value="" size="40" required>

                                                    </div>

                                                    <div class="input-field col l6 s12 margin-bottom-30">

                                                        <label for="company_phone">Company Phone: </label>
                                                        <input type="number" id="company_phone" name="company_phone" class="validate" value="" size="40" required>

                                                    </div>

                                                    <div class="input-field col s12 margin-bottom-30">

                                                        <label for="company_premises">Company Premises: </label>
                                                        <input type="text" id="company_premises" name="premises" class="validate" value="" size="40" required>

                                                    </div>

                                                    <div class="input-field col s12 margin-bottom-30">

                                                        <label for="companyLogo">Company Logo: </label>

                                                        <div class="drop-zone">
                                                            <span class="drop-zone__prompt">Drop your logo here or click to upload</span>
                                                            <input id="companyLogo" type="file" name="logo" class="drop-zone__input">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="swiper-slide swiper-no-swiping">

                                                    <div class="input-field col s12 margin-bottom-30">

                                                        <label for="user_email">Email Address: </label>
                                                        <input type="text" id="user_email" name="user_email" class="validate check_email" value="" size="40" required>

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

                                                </div>


                                            </div>

                                        </div>

                                    </article>

                                    <div class="col s12 center margin-top-30 margin-bottom-30">

                                        <button id="" class="profenda-btn filled full-width disabled" type="submit">
											<?php echo __('Create Account', 'Profenda'); ?>
                                        </button>

                                    </div>

                                    <div class="clearfix"></div>

                                </form>


								<div class="col s12 login-extra-links">

									<p>

										You already have an account?
										<a class="link-en_US" href="<?php echo wp_login_url(); ?>">
											Login Now
										</a>
									</p>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>


<?php
get_footer();
