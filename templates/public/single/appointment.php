<?php

use ShippingAppointments\Service\Entities\Appointment;

get_header();

$appointment = new Appointment( get_queried_object_id() );
?>

	<div class="container">

		<div class="row company-settings no-margin-bottom full-width">

			<div class="col s12">

				<div class="single-appointment-block margin-top-50">

					<div class="single-appointment-block--header">
						<h3 class="flex flex-center full-width">
							Appointment - <?php echo $appointment->ID; ?>
                            <div class="margin-left-auto status <?php echo $appointment->status; ?>">
	                            <?php echo $appointment->getFieldToString('status'); ?>
                            </div>
						</h3>
					</div>
					<div class="single-appointment-block--content">

						<div class="flex flex-center full-width">

							<div class="flex flex-center appointment-item-info">

								<div class="icon">
									<svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><g><circle cx="386" cy="210" r="20"></circle><path d="M432,40h-26V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-91V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-90V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v20H80C35.888,40,0,75.888,0,120v312c0,44.112,35.888,80,80,80h153c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H80c-22.056,0-40-17.944-40-40V120c0-22.056,17.944-40,40-40h25v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h90v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h91v20c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80h26c22.056,0,40,17.944,40,40v114c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V120C512,75.888,476.112,40,432,40z"></path><path d="M391,270c-66.72,0-121,54.28-121,121s54.28,121,121,121s121-54.28,121-121S457.72,270,391,270z M391,472c-44.663,0-81-36.336-81-81s36.337-81,81-81c44.663,0,81,36.336,81,81S435.663,472,391,472z"></path><path d="M420,371h-9v-21c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v41c0,11.046,8.954,20,20,20h29c11.046,0,20-8.954,20-20C440,379.954,431.046,371,420,371z"></path><circle cx="299" cy="210" r="20"></circle><circle cx="212" cy="297" r="20"></circle><circle cx="125" cy="210" r="20"></circle><circle cx="125" cy="297" r="20"></circle><circle cx="125" cy="384" r="20"></circle><circle cx="212" cy="384" r="20"></circle><circle cx="212" cy="210" r="20"></circle></g></g></g></svg>
								</div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--date font-weight-700 ">
                                        <span class="font-weight-400">Date:</span>
										<?php echo $appointment->getDisplayDate(); ?>
									</div>

								</div>

							</div>

							<div class="flex flex-center appointment-item-info">

								<div class="icon">

									<svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952C357.766,320.208,355.981,307.775,347.216,301.211z"></path></g></g><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341S375.275,472.341,256,472.341z"></path></g></g></svg>

								</div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--time font-weight-700 ">
                                        <span class="font-weight-400">Time:</span>
										<?php echo $appointment->time; ?>
									</div>

								</div>

							</div>

							<div class="flex flex-center appointment-item-info">

								<div class="icon">

                                    <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m391 123v-33h30c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-330c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h30v33c0 67.604 49.952 123.758 114.884 133.5-65.071 9.763-114.884 66.052-114.884 133.5v32h-30c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h330c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-30v-32c0-67.394-49.759-123.729-114.884-133.5 64.932-9.742 114.884-65.896 114.884-133.5zm-285-93h300v30h-300zm255 60c-1.252 23.881 4.151 46.344-9.215 76h-191.57c-13.425-29.788-7.944-51.775-9.215-76zm45 392h-300v-30h300zm-255-60c.277-28.476-.734-35.29 1.217-48h73.783c11.187 0 21.746-4.057 30.002-11.476 7.974 7.132 18.493 11.476 29.998 11.476h73.783c.801 5.218 1.217 10.561 1.217 16v32zm199.372-78h-64.372c-8.285 0-15.036-6.74-15.05-15.025-.014-8.276-6.727-14.975-14.999-14.975-.009 0-.018 0-.025 0-8.284.014-14.989 6.74-14.976 15.025.014 8.272-6.677 14.975-14.95 14.975h-64.372c38.408-78.477 150.262-78.629 188.744 0zm-169.767-148h150.789c-41.312 42.655-109.448 42.684-150.789 0z"/></g></svg>

								</div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--time font-weight-700 ">
                                        <span class="font-weight-400">Duration:</span>
										<?php echo $appointment->duration; ?>min
									</div>

								</div>

							</div>

							<div class="flex flex-center appointment-item-info">

								<div class="icon">

                                    <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M458.406,380.681c-8.863-6.593-21.391-4.752-27.984,4.109c-3.626,4.874-7.506,9.655-11.533,14.21c-7.315,8.275-6.538,20.915,1.737,28.231c3.806,3.364,8.531,5.016,13.239,5.016c5.532,0,11.04-2.283,14.992-6.754c4.769-5.394,9.364-11.056,13.658-16.829C469.108,399.803,467.269,387.273,458.406,380.681z"></path><path d="M491.854,286.886c-10.786-2.349-21.447,4.496-23.796,15.288c-1.293,5.937-2.855,11.885-4.646,17.681c-3.261,10.554,2.651,21.752,13.204,25.013c1.967,0.607,3.955,0.896,5.911,0.896c8.54,0,16.448-5.514,19.102-14.102c2.126-6.878,3.98-13.937,5.514-20.98C509.492,299.89,502.647,289.236,491.854,286.886z"></path><path d="M362.139,444.734c-5.31,2.964-10.808,5.734-16.34,8.233c-10.067,4.546-14.542,16.392-9.996,26.459c3.34,7.396,10.619,11.773,18.239,11.773c2.752,0,5.549-0.571,8.22-1.777c6.563-2.964,13.081-6.249,19.377-9.764c9.645-5.384,13.098-17.568,7.712-27.212C383.968,442.803,371.784,439.35,362.139,444.734z"></path><path d="M236,96v151.716l-73.339,73.338c-7.81,7.811-7.81,20.474,0,28.284c3.906,3.906,9.023,5.858,14.143,5.858c5.118,0,10.237-1.953,14.143-5.858l79.196-79.196c3.75-3.75,5.857-8.838,5.857-14.142V96c0-11.046-8.954-20-20-20C244.954,76,236,84.954,236,96z"></path><path d="M492,43c-11.046,0-20,8.954-20,20v55.536C425.448,45.528,344.151,0,256,0C187.62,0,123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512c0.169,0,0.332-0.021,0.5-0.025c0.168,0.004,0.331,0.025,0.5,0.025c7.208,0,14.487-0.304,21.637-0.902c11.007-0.922,19.183-10.592,18.262-21.599c-0.923-11.007-10.58-19.187-21.6-18.261C269.255,471.743,263.099,472,257,472c-0.169,0-0.332,0.021-0.5,0.025c-0.168-0.004-0.331-0.025-0.5-0.025c-119.103,0-216-96.897-216-216S136.897,40,256,40c76.758,0,147.357,40.913,185.936,106h-54.993c-11.046,0-20,8.954-20,20s8.954,20,20,20H448c12.18,0,23.575-3.423,33.277-9.353c0.624-0.356,1.224-0.739,1.796-1.152C500.479,164.044,512,144.347,512,122V63C512,51.954,503.046,43,492,43z"></path></g></g></g></svg>

								</div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--time font-weight-700 ">
                                        <span class="font-weight-400">Buffer:</span>
										<?php echo $appointment->buffer; ?>min
									</div>

								</div>

							</div>

							<div class="flex flex-center appointment-item-info">

                                <div class="icon">

                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M406,241c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C481,274.647,447.353,241,406,241z"/></g></g><g><g><path d="M479.251,391c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C313.217,410.08,301,436.608,301,466v31c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-31C512,436.608,498.783,410.08,479.251,391z"/></g></g><g><g><path d="M106,0C64.647,0,31,34.647,31,76c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C181,34.647,147.353,0,106,0z"/></g></g><g><g><path d="M179.251,151c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C13.217,170.08,0,196.608,0,226v30c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-30C211,196.608,198.783,170.08,179.251,151z"/></g></g><g><g><path d="M256,61c-15.621,0-30.95,2.278-45.919,5.903C210.348,69.95,211,72.885,211,76c0,7.551-0.883,14.886-2.404,21.989C223.874,93.415,239.81,91,256,91c75.688,0,139.473,51.292,158.833,120.894c11.459,0.974,22.513,3.347,32.635,7.72C430.359,129.441,351.074,61,256,61z"/></g></g><g><g><path d="M256,421c-75.366,0-138.95-50.85-158.604-120H66.451C86.847,386.864,163.99,451,256,451c5.574,0,11.083-0.379,16.577-0.839c1.262-10.704,3.571-21.114,7.293-31.077C272.009,420.222,264.073,421,256,421z"/></g></g></svg>

                                </div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--time font-weight-700 ">

                                        <span class="font-weight-400">
                                            Meeting Type:
                                        </span>

										<?php echo $appointment->getFieldToString('appointment_method'); ?>

                                    </div>

								</div>

							</div>

							<div class="flex flex-center appointment-item-info">

                                <div class="icon">

                                    <svg id="Layer_1" enable-background="new 0 0 511.453 511.453" height="512" viewBox="0 0 511.453 511.453" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m425.525 211.802v-211.802h-339.078v211.511l-69.456 42.109v257.833h477.471v-257.83zm24.336 49.852-24.335 13.835v-28.598zm-54.336-231.654v262.543l-139.798 79.477-139.28-79.181v-262.839zm-309.078 245.783-24.847-14.125 24.847-15.063zm-39.456 205.67v-193.591l208.735 118.667 208.735-118.667v193.591z"></path><path d="m239.924 124.912c4.878-4.554 11.259-6.813 17.975-6.343 11.757.811 21.235 10.288 22.046 22.046.799 11.58-6.745 22.024-17.938 24.834-12.265 3.08-20.831 13.958-20.831 26.455v36.211h30v-34.072c24.271-7.017 40.452-30.044 38.697-55.492-1.836-26.618-23.293-48.075-49.91-49.911-15.108-1.041-29.486 4.052-40.51 14.341-10.871 10.146-17.105 24.491-17.105 39.356h30c.001-6.677 2.692-12.865 7.576-17.425z"></path><path d="m240.472 255.545h31.411v31.41h-31.411z"></path></g></svg>

                                </div>

								<div class="appointment-item--appointment">

									<div class="appointment-item--time font-weight-700 ">

                                        <span class="font-weight-400">
                                            Reason:
                                        </span>

										<?php echo $appointment->getFieldToString('reason'); ?>

                                    </div>

								</div>

							</div>

						</div>

					</div>

                    <div class="flex full-width">

                        <div class="participant-item margin-top-30 margin-bottom-30">

                            <div class="appointment-shipping-company appointment-company-block">

								<?php echo get_the_post_thumbnail( $appointment->companyObject->ID, 'thumbnail'); ?>

                                <div class="participant-content">
                                    <h3>
		                                <?php echo get_the_title( $appointment->companyObject->ID ); ?>
                                    </h3>

                                    <div class="appointment-department">
		                                <?php echo $appointment->departmentObject->departmentType->term->name; ?>
                                    </div>

                                    <div class="participant-user">
		                                <?php echo $appointment->employeeUser->first_name . ' ' . $appointment->employeeUser->last_name; ?>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="participant-item margin-top-30">

                            <div class="appointment-supplier-company appointment-company-block">

								<?php echo get_the_post_thumbnail( $appointment->supplierCompanyObject->ID, 'thumbnail'); ?>

                                <div class="participant-content">

                                    <h3>
		                                <?php echo get_the_title( $appointment->supplierCompanyObject->ID ); ?>
                                    </h3>

                                    <div class="appointment-department">
                                        Role of Supplier here
                                    </div>

                                    <div class="participant-user">
		                                <?php echo $appointment->supplierEmployeeUser->first_name . ' ' . $appointment->supplierEmployeeUser->last_name; ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="participant-item margin-top-30">

                            <div class="appointment-supplier-company meeting-method-block">

                                <div class="icon">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;" xml:space="preserve"><g><g><path d="M454.672,194.872C470.024,183.176,480,164.752,480,144c0-35.288-28.712-64-64-64c-35.288,0-64,28.712-64,64c0,19.12,8.472,36.264,21.808,48h-42.496l-53.656-53.656c-3.128-3.128-8.184-3.128-11.312,0l-32,32c-3.128,3.128-3.128,8.184,0,11.312l72,72C307.84,255.16,309.872,256,312,256h64v56h-40h-97.056l39.712-59.56l-13.312-8.872L219.72,312H200v-40c0-4.424-3.576-8-8-8h-64v-32c0-16.864-10.528-31.256-25.328-37.128C118.024,183.176,128,164.752,128,144c0-35.288-28.712-64-64-64S0,108.712,0,144c0,20.752,9.976,39.176,25.328,50.872C10.528,200.744,0,215.136,0,232v112c0,22.056,17.944,40,40,40v96h16v-96h56v88c0,4.424,3.576,8,8,8h56c4.424,0,8-3.576,8-8V352c0-9-2.984-17.312-8.016-24H184h8h40v136h-32v16h80v-16h-32V328h56.208c-5.08,6.704-8.208,14.96-8.208,24v120c0,4.424,3.576,8,8,8h56c4.424,0,8-3.576,8-8v-88h56v96h16v-96c22.056,0,40-17.944,40-40V232C480,215.136,469.472,200.744,454.672,194.872z M16,144c0-26.472,21.528-48,48-48s48,21.528,48,48s-21.528,48-48,48S16,170.472,16,144z M184,312H80v-64H64v72c0,4.424,3.576,8,8,8h72c13.232,0,24,10.768,24,24v112h-40v-88c0-4.424-3.576-8-8-8H40c-13.232,0-24-10.768-24-24V232c0-13.232,10.768-24,24-24h48c13.232,0,24,10.768,24,24v40c0,4.424,3.576,8,8,8h64V312z M368,144c0-26.472,21.528-48,48-48s48,21.528,48,48s-21.528,48-48,48S368,170.472,368,144z M464,344c0,13.232-10.768,24-24,24h-80c-4.424,0-8,3.576-8,8v88h-40V352c0-13.232,10.768-24,24-24h48c4.424,0,8-3.576,8-8v-72c0-4.424-3.576-8-8-8h-68.688l-64-64L272,155.312l50.344,50.344C323.84,207.16,325.872,208,328,208h112c13.232,0,24,10.768,24,24V344z"/></g></g><g><g><path d="M320,0H160c-13.232,0-24,10.768-24,24v64c0,13.232,10.768,24,24,24h8v48c0,3.232,1.944,6.16,4.936,7.392c0.992,0.416,2.032,0.608,3.064,0.608c2.08,0,4.128-0.816,5.656-2.344L235.312,112H320c13.232,0,24-10.768,24-24V24C344,10.768,333.232,0,320,0z M328,88c0,4.416-3.584,8-8,8h-88c-2.128,0-4.16,0.84-5.656,2.344L184,140.688V104c0-4.424-3.576-8-8-8h-16c-4.416,0-8-3.584-8-8V24c0-4.416,3.584-8,8-8h160c4.416,0,8,3.584,8,8V88z"/></g></g><g><g><rect x="168" y="32" width="48" height="16"/></g></g><g><g><rect x="168" y="64" width="144" height="16"/></g></g><g><g><rect x="232" y="32" width="80" height="16"/></g></g></svg>
                                </div>

                                <div class="participant-content">

                                    <h3>
                                        Guests
                                    </h3>

                                    <div class="appointment-department">
                                        More users can be invited to the meeting
                                    </div>

                                    <div class="participant-user">
                                        There are no guests for the current meeting
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="appointment-item--footer">

                        <div class="flex flex-center appointment-actions">

                            <button type="submit" class="profenda-btn filled">
                                <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.13 512.13" xml:space="preserve"><g><g><path d="M256.065,0C114.43,0,0,114.298,0,256.065S114.298,512.13,256.065,512.13S512.13,397.832,512.13,256.065S397.702,0,256.065,0z M256.065,477.892c-122.891,0-221.828-98.937-221.828-221.828S133.175,34.236,256.065,34.236s221.828,98.937,221.828,221.828S378.956,477.892,256.065,477.892z"></path></g></g><g><g><path d="M378.956,180.952c-6.769-6.771-17.054-6.771-23.953-0.001L223.651,312.304l-66.523-66.522c-6.769-6.769-17.054-6.769-23.953,0c-6.769,6.769-6.769,17.053,0,23.953l78.498,78.498c3.385,3.385,6.769,5.077,11.977,5.077c5.077,0,8.592-1.692,11.977-5.077l143.329-143.328C385.725,198.136,385.725,187.853,378.956,180.952z"></path></g></g></svg>
                                Confirm Appointment
                            </button>

                            <button type="submit" class="profenda-btn">
                                <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 475.2 475.2" xml:space="preserve"><g><g><path d="M405.6,69.6C360.7,24.7,301.1,0,237.6,0s-123.1,24.7-168,69.6S0,174.1,0,237.6s24.7,123.1,69.6,168s104.5,69.6,168,69.6s123.1-24.7,168-69.6s69.6-104.5,69.6-168S450.5,114.5,405.6,69.6z M386.5,386.5c-39.8,39.8-92.7,61.7-148.9,61.7s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7,0-297.8C128.5,48.9,181.4,27,237.6,27s109.1,21.9,148.9,61.7C468.6,170.8,468.6,304.4,386.5,386.5z"></path><path d="M342.3,132.9c-5.3-5.3-13.8-5.3-19.1,0l-85.6,85.6L152,132.9c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1l85.6,85.6l-85.6,85.6c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.6-85.6l85.6,85.6c2.6,2.6,6.1,4,9.5,4c3.5,0,6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1l-85.4-85.6l85.6-85.6C347.6,146.7,347.6,138.2,342.3,132.9z"></path></g></g></svg>
                                Reject Appointment
                            </button>

                            <button type="submit" class="profenda-btn margin-left-auto no-margin-right">
                                <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" xml:space="preserve"><g><g><path d="M496.063,62.299l-46.396-46.4c-21.199-21.199-55.689-21.198-76.888,0C352.82,35.86,47.964,340.739,27.591,361.113c-2.17,2.17-3.624,5.054-4.142,7.875L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143L143,488.549c2.895-0.54,5.741-2.008,7.875-4.143l345.188-345.214C517.311,117.944,517.314,83.55,496.063,62.299z M33.721,478.276l14.033-75.784l61.746,61.75L33.721,478.276z M140.269,452.585L59.41,371.721L354.62,76.488l80.859,80.865L140.269,452.585z M474.85,117.979l-18.159,18.161l-80.859-80.865l18.159-18.161c9.501-9.502,24.96-9.503,34.463,0l46.396,46.4C484.375,93.039,484.375,108.453,474.85,117.979z"></path></g></g></svg>
                                Edit Appointment
                            </button>

                        </div>

                    </div>
				</div>

			</div>


		</div>

	</div>



<?php
get_footer();
