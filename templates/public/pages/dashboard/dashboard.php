<?php
get_header();

$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );
var_dump( $platformUser->availability->ID );
var_dump( $platformUser->shippingCompany->ID );
var_dump( $platformUser->department->ID );
var_dump( $platformUser->supplierCompany->ID );
var_dump( $platformUser );
?>

	Main Dashboard page here

<?php

get_footer();
