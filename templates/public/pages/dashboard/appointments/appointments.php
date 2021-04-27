<?php

use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Entities\User\PlatformUser;

get_header();

$platformUser           = new PlatformUser( get_current_user_id() );
$dashboardAppointments  = new DashboardAppointments( $platformUser );

$pendingAppointments    = $dashboardAppointments->getEmployeePendingAppointments();
$scheduledAppointments  = $dashboardAppointments->getEmployeeConfirmedAppointments();
$pastAppointments       = $dashboardAppointments->getEmployeePastAppointments();
?>
    <div class="appointments-page full-width">

        <div class="container">

            <div class="row company-settings no-margin-bottom full-width">

                <div id="main-navigation" class="margin-top-50">

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
