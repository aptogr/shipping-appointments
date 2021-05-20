<?php

use ShippingAppointments\Service\Dashboard\Booking\DashboardBooking;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
$daUser = new PlatformUser( get_current_user_id() );

//echo "<pre>";
////echo get_current_user_id();
//print_r($daUser);
//echo "</pre>";

get_header();

$companyID  = get_query_var('company');

$dashboardBooking = new DashboardBooking( $companyID, $_GET );

?>

	<div class="dashboard-panel-page-header full-width flex flex-center">

		<div class="container">

			<div class="col s12 flex flex-center">

				<h1>Book an Appointment with <strong class="book-company-name"><?php echo $dashboardBooking->company->post->post_title; ?></strong></h1>

			</div>

		</div>

	</div>

<div id="bookAppointment" class="row no-margin-bottom full-width relative">

    <div class="loading-field hide">
        <div class="loader-1 center margin-bottom-30 margin-top--50 relative"><span></span></div>
    </div>

	<div class="container">

		<form method="post" class="col s12">



            <input type="hidden" name="company" value="<?php echo $companyID; ?>">
            <input type="hidden" name="appointmentUserId" value="<?php echo get_current_user_id(); ?>">

            <?php $companyType = (!is_null($daUser->shipping_company_id) ? 'shipping_company' : 'supplier'); ?>
            <input type="hidden" name="requested_by" value="<?php echo $companyType; ?>">

            <input type="hidden" name="supplier_company" value="<?php echo $daUser->supplier_company_id; ?>">
            <input type="hidden" name="supplier_employee" value="<?php echo get_current_user_id(); ?>">


            <input type="hidden" name="duration" value="20">
            <input type="hidden" name="buffer" value="10">

			<div class="booking-steps margin-top-80 margin-bottom-50">

                <div class="booking-step-wrapper book-step-1 flex flex-center full-width padding-bottom-30 <?php echo( $dashboardBooking->department !== false ? 'completed' : ''); ?>">

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

<!--                        <div class="booking-step-actions">-->
<!---->
<!--                            <div class="profenda-btn">-->
<!--                                Continue-->
<!--                                <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z"></path></g></g></svg>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->

                    </div>

                </div>


                <div id="employeeStep" class="booking-step-wrapper book-step-2 flex flex-center full-width padding-top-30 padding-bottom-30">

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

                <div id="dateStep" class="booking-step-wrapper book-step-3 flex flex-center full-width padding-top-30 padding-bottom-30 disabled">

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

			                <?php echo $dashboardBooking->getDateField(); ?>

                        </div>


                    </div>

                </div>

                <div id="timeStep" class="booking-step-wrapper book-step-4 flex flex-center full-width padding-top-30 padding-bottom-30 disabled">

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

			                <?php echo $dashboardBooking->getTimeField(); ?>

                        </div>


                    </div>

                </div>

                <div id="meetingTypeStep" class="booking-step-wrapper book-step-5 flex flex-center full-width padding-top-30 padding-bottom-30 disabled">

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

                <div id="meetingInformationStep" class="booking-step-wrapper book-step-6 flex flex-center full-width padding-top-30 padding-bottom-30 disabled">

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

			                <?php echo $dashboardBooking->getMeetingReasonField(); ?>

                        </div>


                    </div>

                </div>

                <div class="booking-step-wrapper book-step-7 flex flex-center full-width padding-top-30 padding-bottom-30 disabled">

                    <div class="step-counter">
                        7
                    </div>

                    <div class="booking-step">

                        <div class="booking-step-header">

                            <h3>
                                Book Appointment
                            </h3>

                        </div>

                        <div class="booking-step-field">
                            <button type="submit" class="saveBooking save-button" name="refresh_action" value="create_appointment">Book Appointment</button>
                        </div>

                    </div>

                </div>

			</div>

		</form>

	</div>

    <div id="availabilityModal" class="profenda-modal">

        <div class="profenda-modal-header">
            Availability
        </div>
        <div class="profenda-modal-content">

        </div>

    </div>
    <div class="modal-overlay"></div>

</div>

<?php
get_footer();
