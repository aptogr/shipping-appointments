<?php

use ShippingAppointments\Service\Dashboard\Search\ShippingCompanySearch;
use ShippingAppointments\Service\Entities\User\PlatformUser;

get_header();
$platformUser       = new PlatformUser( get_current_user_id() );
$companiesSearch    = new ShippingCompanySearch();
$companies          = $companiesSearch->getShippingCompanies();

?>

    <div class="dashboard-panel-page-header full-width flex flex-center">

        <div class="container">

            <div class="col s12 flex flex-center">
                <h1>Find Shipping Companies</h1>
            </div>

        </div>

    </div>

    <div class="container">

        <div class="col s12">

            <div class="flex full-width margin-top-30">

                <?php foreach( $companies as $companyID ): ?>

                    <?php echo $companiesSearch->displayShippingCompanyBlock( $companyID ); ?>

                <?php endforeach; ?>

            </div>

        </div>


    </div>

<?php

get_footer();
