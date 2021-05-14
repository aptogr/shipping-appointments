<?php

use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointmentsDepartment;
use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointmentsShippingCompany;
use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;

get_header();

$platformUser = new PlatformUser( get_current_user_id() );

if( !empty( get_query_var('company') ) ){

    $shippingCompany        = new ShippingCompany( get_query_var('company') );
	$dashboardAppointments  = new DashboardAppointmentsShippingCompany( $shippingCompany );
	$pendingAppointments    = $dashboardAppointments->getShippingCompanyPendingAppointments();
	$scheduledAppointments  = $dashboardAppointments->getShippingCompanyConfirmedAppointments();
	$pastAppointments       = $dashboardAppointments->getShippingCompanyPastAppointments();

}
else if( !empty( get_query_var('department') ) ){

    $department             = new Department( get_query_var('department') );
	$dashboardAppointments  = new DashboardAppointmentsDepartment( $department );
	$pendingAppointments    = $dashboardAppointments->getDepartmentPendingAppointments();
	$scheduledAppointments  = $dashboardAppointments->getDepartmentConfirmedAppointments();
	$pastAppointments       = $dashboardAppointments->getDepartmentPastAppointments();

}
else {

	$dashboardAppointments  = new DashboardAppointments( $platformUser );
	$pendingAppointments    = $dashboardAppointments->getEmployeePendingAppointments();
	$scheduledAppointments  = $dashboardAppointments->getEmployeeConfirmedAppointments();
	$pastAppointments       = $dashboardAppointments->getEmployeePastAppointments();
}


?>

    <div class="dashboard-panel-page-header full-width flex flex-center">

        <div class="container">

            <div class="flex flex-center full-width">

                <?php if( !empty( get_query_var('company') ) ): ?>

                    <h1>Company Appointments</h1>

                <?php elseif( !empty( get_query_var('department') ) ): ?>

                    <h1>
                        <?php echo $department->departmentType->term->name; ?> Appointments
                    </h1>

                <?php else: ?>

                    <h1>My Appointments</h1>

                <?php endif; ?>

                <div id="toggleAppointmentsView" class="profenda-btn margin-left-auto no-margin-right">
                    Calendar View
                </div>

            </div>


        </div>

    </div>

    <div class="appointments-page full-width padding-top-50 padding-bottom-50">

        <div class="container">

            <?php if( !empty( get_query_var('company') ) ): ?>

                <div class="flex full-width department-appointments-items margin-bottom-50">

                    <?php foreach ( $shippingCompany->departments as $departmentID ): $departmentEntity = new Department( $departmentID ); ?>

                        <div class="department-appointments-item flex flex-center flex-grow">

                            <div class="icon">

                                <?php echo $departmentEntity->departmentType->svg; ?>

                            </div>

                            <div class="content">

                                <h3>
                                    <?php echo $departmentEntity->departmentType->term->name; ?>
                                </h3>


                                <a href="<?php echo site_url( 'dashboard/appointments/department/' . $departmentEntity->ID ); ?>" class="profenda-btn">
                                    View Department's Appointments
                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <div id="trial-message"></div>

            <div id="appointmentsCalendarView" class="row relative company-settings no-margin-bottom full-width hide">
                <div id="appointmentCalendarOverlay" class="hide"></div>
                <div id="appointmentCalendarClick" class="hide"></div>
                <?php $dashboardAppointments->getAllAppointmentsJSON($pendingAppointments,$scheduledAppointments,$pastAppointments);?>
            </div>

            <div id="appointmentsListView" class="row company-settings no-margin-bottom full-width">

                <div id="main-navigation" class="">

                    <ul class="links-container">

                        <li class="tab-link active">
                            Pending Appointments
                            <span class="count-appointments pending">
							<?php echo ( is_array( $pendingAppointments ) ? count($pendingAppointments) : 0 ); ?>
						</span>
                        </li>

                        <li class="tab-link">
                            Scheduled Appointments
                            <span class="count-appointments confirmed">
							<?php echo ( is_array( $scheduledAppointments ) ? count($scheduledAppointments) : 0 ); ?>
						</span>
                        </li>

                        <li class="tab-link">
                            History
                            <span class="count-appointments past">
							<?php echo ( is_array( $pastAppointments ) ? count($pastAppointments) : 0 ); ?>
						</span>
                        </li>

                    </ul>

                </div>

                <article id="pages-container">

                    <div id="pages-container-inner">

                        <div class="swiper-wrapper">

                            <div class="swiper-slide">

                                <?php $dashboardAppointments->displayAppointments( $pendingAppointments ); ?>

                            </div>

                            <div class="swiper-slide">

								<?php $dashboardAppointments->displayAppointments( $scheduledAppointments ); ?>

                            </div>

                            <div class="swiper-slide">

								<?php $dashboardAppointments->displayAppointments( $pastAppointments ); ?>

                            </div>

                        </div>

                    </div>

                </article>

            </div>

        </div>

    </div>

<?php

get_footer();
