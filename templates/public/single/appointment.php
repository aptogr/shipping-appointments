<?php

use ShippingAppointments\Service\Entities\Appointment;

get_header();

$appointment = new Appointment( get_queried_object_id() );
?>

	<div class="container">

		<div class="row company-settings no-margin-bottom full-width">

			<div class="col s12">

				<div class="single-appointment-block">

					<div class="single-appointment-block--header">
						<h3>
							Appointment - <?php echo $appointment->ID; ?>
						</h3>
					</div>
					<div class="single-appointment-block--content">

						<div class="appointment-status-message">
							<?php echo $appointment->getFieldToString('status'); ?>
						</div>

						<div class="flex flex-center full-width">

							<div class="flex flex-center viewing-item-info">

								<div class="icon">
									<svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><g><circle cx="386" cy="210" r="20"></circle><path d="M432,40h-26V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-91V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-90V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v20H80C35.888,40,0,75.888,0,120v312c0,44.112,35.888,80,80,80h153c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H80c-22.056,0-40-17.944-40-40V120c0-22.056,17.944-40,40-40h25v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h90v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h91v20c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80h26c22.056,0,40,17.944,40,40v114c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V120C512,75.888,476.112,40,432,40z"></path><path d="M391,270c-66.72,0-121,54.28-121,121s54.28,121,121,121s121-54.28,121-121S457.72,270,391,270z M391,472c-44.663,0-81-36.336-81-81s36.337-81,81-81c44.663,0,81,36.336,81,81S435.663,472,391,472z"></path><path d="M420,371h-9v-21c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v41c0,11.046,8.954,20,20,20h29c11.046,0,20-8.954,20-20C440,379.954,431.046,371,420,371z"></path><circle cx="299" cy="210" r="20"></circle><circle cx="212" cy="297" r="20"></circle><circle cx="125" cy="210" r="20"></circle><circle cx="125" cy="297" r="20"></circle><circle cx="125" cy="384" r="20"></circle><circle cx="212" cy="384" r="20"></circle><circle cx="212" cy="210" r="20"></circle></g></g></g></svg>
								</div>

								<div class="viewing-item--appointment">

									<div class="viewing-item--date font-weight-700 ">
										<?php echo $appointment->getDisplayDate(); ?>
									</div>

								</div>

							</div>

							<div class="flex flex-center viewing-item-info">

								<div class="icon">

									<svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952C357.766,320.208,355.981,307.775,347.216,301.211z"></path></g></g><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341S375.275,472.341,256,472.341z"></path></g></g></svg>

								</div>

								<div class="viewing-item--appointment">

									<div class="viewing-item--time font-weight-700 ">
										<?php echo $appointment->time; ?>
									</div>

								</div>

							</div>

							<div class="flex flex-center viewing-item-info">

								<div class="icon">

									<svg id="Layer_1" enable-background="new 0 0 511.453 511.453" height="512" viewBox="0 0 511.453 511.453" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m425.525 211.802v-211.802h-339.078v211.511l-69.456 42.109v257.833h477.471v-257.83zm24.336 49.852-24.335 13.835v-28.598zm-54.336-231.654v262.543l-139.798 79.477-139.28-79.181v-262.839zm-309.078 245.783-24.847-14.125 24.847-15.063zm-39.456 205.67v-193.591l208.735 118.667 208.735-118.667v193.591z"/><path d="m239.924 124.912c4.878-4.554 11.259-6.813 17.975-6.343 11.757.811 21.235 10.288 22.046 22.046.799 11.58-6.745 22.024-17.938 24.834-12.265 3.08-20.831 13.958-20.831 26.455v36.211h30v-34.072c24.271-7.017 40.452-30.044 38.697-55.492-1.836-26.618-23.293-48.075-49.91-49.911-15.108-1.041-29.486 4.052-40.51 14.341-10.871 10.146-17.105 24.491-17.105 39.356h30c.001-6.677 2.692-12.865 7.576-17.425z"/><path d="m240.472 255.545h31.411v31.41h-31.411z"/></g></svg>

								</div>

								<div class="viewing-item--appointment">

									<div class="viewing-item--time font-weight-700 ">

									</div>

								</div>

							</div>

							<div class="flex flex-center viewing-item-info viewing-item-participants">

								<?php

//								if( $appointment->currentUserHomiAgent() ){
//
//									echo $appointment->displayViewingUserInfo( $appointment->requesterUser );
//
//								}
//								elseif ( $appointment->currentUserRequester() ){
//
//									echo $appointment->displayViewingUserInfo( $appointment->homiAgentUser );
//
//								}
//								else {
//
//									echo $appointment->displayViewingUserInfo( $appointment->requesterUser );
//									echo $appointment->displayViewingUserInfo( $appointment->homiAgentUser );
//
//								}

								?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>



<?php
get_footer();
