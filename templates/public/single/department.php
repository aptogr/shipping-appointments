<?php

use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\User\PlatformUser;

get_header();

global $post;
$department = new Department($post->ID);
$shippingCompanyId =  $department->companyObject->ID;


?>

    <div class="row shipping-company-department full-width">

        <section class="col m6 l6 s12">

            <?php $department->displayAvailabilityTable( array(
//                    'weekday'           => 'mon',
            )); ?>

        </section>


    </div>

<?php
get_footer();
