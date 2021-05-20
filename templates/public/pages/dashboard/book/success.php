<?php

use ShippingAppointments\Service\Entities\Appointment;

get_header();

$request =  new Appointment( get_query_var('req') );


?>


	<section class="row no-margin-bottom padding-top-50 padding-bottom-50 bg-white full-width">

		<div class="container relative z-index-1">

			<div class="col s12">

				<div class="thank-you-block">

					<div class="icon">

						<svg enable-background="new 0 0 32 32" height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z" fill="#fff9dd"/><path d="m19.667 14c1.102 0 2.129.321 3 .868v-5.201c0-.921-.746-1.667-1.667-1.667h-11.333c-.921 0-1.667.746-1.667 1.667v6c0 .92.746 1.667 1.667 1.667h4.842c.891-1.963 2.865-3.334 5.158-3.334zm-10.334-4.353 6 2.8 6-2.8v1.107l-5.647 2.633c-.113.053-.233.08-.353.08s-.24-.027-.353-.08l-5.647-2.633z" fill="#ffd200"/><path d="m19.667 15.333c-2.389 0-4.333 1.944-4.333 4.333s1.943 4.334 4.333 4.334 4.333-1.944 4.333-4.333-1.944-4.334-4.333-4.334zm1.833 4.834h-1.833c-.276 0-.5-.224-.5-.5v-1.833c0-.276.224-.5.5-.5s.5.224.5.5v1.333h1.333c.276 0 .5.224.5.5s-.224.5-.5.5z" fill="#ffe777"/></svg>


					</div>

					<h1 class="center font-weight-700">
						You have successfully requested an appointment
					</h1>

					<p class="center">
						Your request for an appointment has been submitted and is awaiting approval.
						<br>
						You will be notified via email once your appointment has been confirmed.
					</p>

					<div class="contact-info center">

<!--						<span class="highlight">--><?php //echo $request->requesterUser->user_email; ?><!--</span>-->
<!--						<span class="highlight">--><?php //echo $viewing->requesterUser->mobilePhone; ?><!--</span>-->

					</div>

					<div class="viewing-request-info margin-top-50">


						<div class="appointment-info flex flex-center">
							<div class="icon">
								<svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><g><circle cx="386" cy="210" r="20"/><path d="M432,40h-26V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-91V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-90V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v20H80C35.888,40,0,75.888,0,120v312c0,44.112,35.888,80,80,80h153c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H80c-22.056,0-40-17.944-40-40V120c0-22.056,17.944-40,40-40h25v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h90v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h91v20c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80h26c22.056,0,40,17.944,40,40v114c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V120C512,75.888,476.112,40,432,40z"/><path d="M391,270c-66.72,0-121,54.28-121,121s54.28,121,121,121s121-54.28,121-121S457.72,270,391,270z M391,472c-44.663,0-81-36.336-81-81s36.337-81,81-81c44.663,0,81,36.336,81,81S435.663,472,391,472z"/><path d="M420,371h-9v-21c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v41c0,11.046,8.954,20,20,20h29c11.046,0,20-8.954,20-20C440,379.954,431.046,371,420,371z"/><circle cx="299" cy="210" r="20"/><circle cx="212" cy="297" r="20"/><circle cx="125" cy="210" r="20"/><circle cx="125" cy="297" r="20"/><circle cx="125" cy="384" r="20"/><circle cx="212" cy="384" r="20"/><circle cx="212" cy="210" r="20"/></g></g></g></svg>
							</div>

							<div class="display-inline-block content">

								<div class="value">
									<?php //echo $viewing->getDisplayDateTime(); ?>
								</div>

								<div class="label">
									Your appointment
								</div>

							</div>

						</div>

						<div class="appointment-info flex flex-center">

							<div class="icon">
								<svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="568.705px" height="568.705px" viewBox="0 0 568.705 568.705" style="enable-background:new 0 0 568.705 568.705;" xml:space="preserve"><g><g><g><path d="M529.117,317.082c-16.576,0-31.23,10.682-36.342,26.454c-27.636,85.372-107.769,147.314-202.232,147.314c-117.274,0-212.688-95.424-212.688-212.707c0-94.075,61.43-173.951,146.278-201.901c16.383-5.398,27.483-20.716,27.483-37.985c0-12.232-5.853-23.731-15.737-30.924c-9.884-7.204-22.62-9.237-34.251-5.492C84.793,39.468,0.001,148.976,0.001,278.147c0,160.218,130.332,290.558,290.541,290.558c128.654,0,237.793-84.126,275.828-200.219c3.912-11.938,1.861-25.024-5.514-35.2C553.5,323.116,541.699,317.082,529.117,317.082z"/><path d="M355.888,75.905c64.584,20.908,115.691,71.902,136.752,136.419c5.246,16.061,20.205,26.906,37.103,26.906h0.801c12.201,0,23.666-5.834,30.848-15.69c7.168-9.855,9.218-22.562,5.476-34.174c-28.49-88.591-98.416-158.661-186.933-187.36c-11.729-3.8-24.596-1.758-34.573,5.492c-9.979,7.26-15.89,18.856-15.89,31.198v0.847C329.468,56.099,340.148,70.801,355.888,75.905z"/></g></g></g></svg>
							</div>

							<div class="display-inline-block content">

								<div class="value">
									Pending approval
								</div>

								<div class="label">
									Status
								</div>

							</div>

						</div>

						<div class="viewing-links flex flex-center full-width">

							<a href="<?php echo get_the_permalink( $request->ID ); ?>" class="profenda-btn">
								<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g><g><path d="M496.063,62.299l-46.396-46.4c-21.199-21.199-55.689-21.198-76.888,0C352.82,35.86,47.964,340.739,27.591,361.113c-2.17,2.17-3.624,5.054-4.142,7.875L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143L143,488.549c2.895-0.54,5.741-2.008,7.875-4.143l345.188-345.214C517.311,117.944,517.314,83.55,496.063,62.299z M33.721,478.276l14.033-75.784l61.746,61.75L33.721,478.276z M140.269,452.585L59.41,371.721L354.62,76.488l80.859,80.865L140.269,452.585z M474.85,117.979l-18.159,18.161l-80.859-80.865l18.159-18.161c9.501-9.502,24.96-9.503,34.463,0l46.396,46.4C484.375,93.039,484.375,108.453,474.85,117.979z"/></g></g></svg>
								Manage Appointment Request
							</a>


						</div>

						<div class="help-block flex flex-center">
							<div class="icon display-inline-block">
								<svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0C114.497,0,0,114.507,0,256c0,141.503,114.507,256,256,256c141.503,0,256-114.507,256-256C512,114.497,397.492,0,256,0z M256,472c-119.393,0-216-96.615-216-216c0-119.393,96.615-216,216-216c119.393,0,216,96.615,216,216C472,375.393,375.384,472,256,472z"/></g></g><g><g><path d="M256,214.33c-11.046,0-20,8.954-20,20v128.793c0,11.046,8.954,20,20,20s20-8.955,20-20.001V234.33C276,223.284,267.046,214.33,256,214.33z"/></g></g><g><g><circle cx="256" cy="162.84" r="27"/></g></g></svg>

							</div>
							<div class="text display-inline-block">
								If you need help with your viewing you can contact us by sending an email at info@profenda.com
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
