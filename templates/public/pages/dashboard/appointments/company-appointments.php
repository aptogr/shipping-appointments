<?php

use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointmentsShippingCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;

get_header();

$platformUser           = new PlatformUser( get_current_user_id() );
$dashboardAppointments  = new DashboardAppointmentsShippingCompany( $platformUser->shippingCompany );

wp_redirect('dashboard/appointments/company/' .$platformUser->shippingCompany->ID );
exit();
?>


<?php

get_footer();
