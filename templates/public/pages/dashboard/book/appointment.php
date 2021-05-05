<?php

use ShippingAppointments\Service\Dashboard\Booking\DashboardBooking;
use ShippingAppointments\Service\Entities\ShippingCompany;

get_header();

$companyID  = get_query_var('company');

$dashboardBooking = new DashboardBooking( $companyID, $_GET );

?>

	<div class="dashboard-panel-page-header full-width flex flex-center">

		<div class="container">

			<div class="col s12 flex flex-center">

				<h1>Book an Appointment with <strong class="company-name"><?php echo $dashboardBooking->company->post->post_title; ?></strong></h1>

			</div>

		</div>

	</div>

<div id="bookAppointment" class="row no-margin-bottom full-width">

	<div class="container">

		<form method="post" class="col s12">

			<div class="booking-steps margin-top-80 margin-bottom-50">

                <div class="booking-step-wrapper flex flex-center full-width padding-bottom-30">

                    <div class="step-counter">
                        1
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Select a Company Department
                            </h3>

                            <p>
                                Choose the department with which you will book an appointment with.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php echo $dashboardBooking->getDepartmentsField(); ?>

                        </div>


                    </div>

                </div>


                <div class="booking-step-wrapper flex flex-center full-width padding-top-30 padding-bottom-30">

                    <div class="step-counter">
                        2
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Select an employee
                            </h3>

                            <p>
                                You can choose to have an appointment with a specific employee of the department or with anyone in the department.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php echo $dashboardBooking->getEmployeesField(); ?>

                        </div>


                    </div>

                </div>

                <div class="booking-step-wrapper flex flex-center full-width padding-top-30 padding-bottom-30">

                    <div class="step-counter">
                        3
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Select the appointment date
                            </h3>

                            <p>
                                Choose the date you want to book the appointment based on the department's availability.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php //echo $dashboardBooking->getDepartmentsField(); ?>

                        </div>


                    </div>

                </div>

                <div class="booking-step-wrapper flex flex-center full-width padding-top-30 padding-bottom-30">

                    <div class="step-counter">
                        4
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Select the appointment time
                            </h3>

                            <p>
                                Choose the time the meeting will start. Note that the meeting duration is define by the Shipping Company once the appointment is confirmed.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php //echo $dashboardBooking->getDepartmentsField(); ?>

                        </div>


                    </div>

                </div>

                <div class="booking-step-wrapper flex flex-center full-width padding-top-30 padding-bottom-30">

                    <div class="step-counter">
                        5
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Select the meeting type
                            </h3>

                            <p>
                                Choose one of the available meeting types below. The final meeting type will be defined by the Shipping Company once the appointment is confirmed.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php echo $dashboardBooking->getMeetingTypeField(); ?>

                        </div>


                    </div>

                </div>

                <div class="booking-step-wrapper flex flex-center full-width padding-top-30 padding-bottom-30">

                    <div class="step-counter">
                        6
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Add Meeting Information
                            </h3>

                            <p>
                                Choose one of the available meeting types below. The final meeting type will be defined by the Shipping Company once the appointment is confirmed.
                            </p>

                        </div>

                        <div class="booking-step-field">

			                <?php //echo $dashboardBooking->getDepartmentsField(); ?>

                        </div>


                    </div>

                </div>



			</div>

		</form>

	</div>

</div>

<?php
get_footer();
