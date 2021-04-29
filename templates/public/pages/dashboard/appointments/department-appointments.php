<?php

use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Entities\User\PlatformUser;

get_header();

$platformUser           = new PlatformUser( get_current_user_id() );

?>



<?php

get_footer();
