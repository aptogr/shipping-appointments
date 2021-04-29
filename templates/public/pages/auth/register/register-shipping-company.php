<?php

get_header();

?>


	<section id="homiLogin" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-50">

		<div class="container">

			<div class="col s12 flex flex-center flex-just-center">

				<div class="login-card card center display-block">

					<div class="flex">

						<div class="login-content register-content">

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

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>


<?php
get_footer();
