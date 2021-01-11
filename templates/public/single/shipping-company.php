<?php

use ShippingAppointments\Service\Entities\ShippingCompany;

get_header();

$companyID = get_queried_object_id();
$shippingCompany = new ShippingCompany( $companyID );
?>

Template for : <?php echo $shippingCompany->post->post_title; ?>

<?php

get_footer();
