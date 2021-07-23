<?php

get_header();

use ShippingAppointments\Service\Woocommerce\PricingTable;

$PricingTable = new PricingTable();

?>

<div class="pricing row no-margin-bottom bg-white">

    <svg class="water-effect">
        <defs>
            <!--   https://developer.mozilla.org/en-US/docs/Web/SVG/Element/filter -->
            <filter id="turbulence" x="0" y="0" width="100%" height="100%">
                <feTurbulence id="sea-filter" numOctaves="3" seed="2" baseFrequency="0.02 0.05"></feTurbulence>
                <feDisplacementMap scale="20" in="SourceGraphic"></feDisplacementMap>
                <!--     https://developer.mozilla.org/en-US/docs/Web/SVG/Element/animate -->
                <!--     <animate xlink:href="#sea-filter" attributeName="baseFrequency" dur="60s" keyTimes="0;0.5;1" values="0.02 0.06;0.04 0.08;0.02 0.06" repeatCount="indefinite" /> -->
                <animate xlink:href="#sea-filter" attributeName="baseFrequency" dur="60s" keyTimes="0;0.5;1" values="0.02 0.06;0.04 0.08;0.02 0.06" repeatCount="indefinite" calcMode="spline" keySplines="0.25 0 0.75 1;0.25 0 0.75 1"/>
            </filter>
        </defs>
    </svg>

    <section id="aboutOpener" class="relative padding-top-50 padding-bottom-50">

        <div class="flex full-width">

            <div class="col l6 m6 s12 padding-top-50 padding-bottom-50 relative flex flex-center">

                <div class="container relative z-index-1 center">

                    <h2 class="section-heading relative display-inline-block">
                        PRICING & FEES
                        <span class="bg-heading">
                   PRICING
                </span>
                    </h2>

                    <h3 class="section-subheading">
                        A cost efficient personal assistant
                    </h3>

                    <p class="color-black center">
                        Profenda is an online appointment scheduling platform that connects Shipping Companies with Suppliers. It's a professional agenda which simplifies how you schedule and run customer meetings.
                        Let your clients choose how, when and where to meet you in just a few clicks.

                    </p>

                </div>

            </div>

            <div class="col l6 m6 s12 no-padding-right no-padding-left water-filter">

                <div class="container padding-top-50 padding-bottom-50 relative z-index-1">

					<?php echo wp_get_attachment_image( 886, 'full' ); ?>

                </div>


            </div>

        </div>

        <svg width="1280" height="517" viewBox="0 0 1280 517" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute;bottom: 26px;z-index: 0;left: -10%;width: 110%;height: 100%;">
            <path d="M-809 422.805C-510.936 542.865 -405.413 -3.92245 146.206 422.805C392.568 620.432 668.75 429.161 909.382 231.535C1025.49 138.777 1389.55 19.4762 1507 11" stroke="#006BFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #eaf2ff;"></path>
            <path d="M909.383 231.535C668.75 429.162 392.569 620.432 146.207 422.806" stroke="#E55CFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #02569c;"></path>
        </svg>

        <div class="clearfix"></div>

    </section>

    <section class="profenda-section bg-light-grey relative padding-top-80 padding-bottom-80">

        <div class="container relative z-index-1 center">

            <h2 class="section-heading relative display-inline-block">
                FOR SUPPLIERS
                <span class="bg-heading">
                   PRICING
                </span>
            </h2>

            <h3 class="section-subheading">
                Subscription Plans
            </h3>

            <p class="color-black center">
                Profenda supports 2 subscription plans that can be billed either monthly or annually. We accept payments via Credit Card and Paypal.
            </p>


        </div>

        <div  id="pricing" class="relative z-index-1">

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

        <svg id="contactLines" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1440" height="560" preserveAspectRatio="none" viewBox="0 0 1440 560" style="width: 180%;opacity: 0.04;"><g mask="url(&quot;#SvgjsMask1006&quot;)" fill="none"><path d="M417.94 582.71C573.22 582.71 719.72 564.43 1038.73 562.42 1357.74 560.41 1489.94 294.05 1659.52 288.02" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M668.54 594.42C848.18 547.81 904.55 62.71 1178.99 55.42 1453.43 48.13 1557.48 188.7 1689.44 189.82" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M402.34 650.15C539.69 599.8 487.08 189.17 761.54 188.2 1036 187.23 1289.65 436.58 1479.94 440.2" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M181.29 623.79C305.59 622.58 420.4 491.35 660.53 491.32 900.66 491.29 900.15 561.32 1139.77 561.32 1379.39 561.32 1497.93 491.5 1619.01 491.32" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M562.88 660.24C702.37 583.65 622.32 123.21 889.63 113.97 1156.95 104.73 1377.14 231.1 1543.14 231.57" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path></g><defs><mask id="SvgjsMask1006"><rect width="1440" height="560" fill="#ffffff"></rect></mask></defs></svg>

        <div class="clearfix"></div>

    </section>

</div>


<?php
get_footer();
?>
