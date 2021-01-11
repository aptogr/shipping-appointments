<?php

use ShippingAppointments\Service\Entities\SupplierCompany;

get_header();

$companyID = get_queried_object_id();
$supplierCompany = new SupplierCompany( $companyID );
?>

	Template for : <?php echo $supplierCompany->post->post_title; ?>

<?php

get_footer();
