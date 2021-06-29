<?php

get_header();

use ShippingAppointments\Service\Woocommerce\PricingTable;

$PricingTable = new PricingTable();

?>

<div id="pricing" class="pricing row">



    <div class="full-width margin-bottom-50 flex flex-dir-row flex-just-center">

        <div class="toggle-switch toggle-trigger price-toggle">

            <div class="monthly-price-label">
                Monthly
            </div>

            <div class="price-checkbox">
                <input type="checkbox" class="priceSwitch" id="priceSwitch" name="priceSwitch">
                <label for="priceSwitch"></label>
            </div>

            <div class="annual-price-label">
                Annual
            </div>

        </div>
    </div>

    <div class="pricing-cards full-width flex flex-just-space-a monthly-price">

        <?php
            echo $PricingTable->displayProduct(579);
            echo $PricingTable->displayProduct(591);
        ?>

    </div>

    <div class="pricing-cards full-width flex flex-just-space-a annual-price hide">

        <?php
            echo $PricingTable->displayProduct(590);
            echo $PricingTable->displayProduct(592);
        ?>

    </div>

</div>


<?php
get_footer();
?>
