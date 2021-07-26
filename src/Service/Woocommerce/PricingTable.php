<?php


namespace ShippingAppointments\Service\Woocommerce;


class PricingTable {

    public function displayProduct($id) {

        ob_start();

        $product = wc_get_product( $id );

//        var_dump($product->get_category_ids());

//        echo $product->get_name();
//        echo $product->get_description();
//        echo $product->get_price();
//        echo $product->add_to_cart_url();
//        echo $product->get_short_description();
//        echo get_post_meta($id)['_subscription_period'][0];


        if ($product->get_category_ids()[0] == 2824) {
            $category = 'silver';
        } elseif ($product->get_category_ids()[0] == 2825) {
            $category = 'gold';
        } else {
            $category = 'uncategorized';
        }

        ?>

        <div class="pricing-card <?php echo $category;?>-pack flex flex-dir-col">

            <div class="pricing-card-head">
                <?php echo $product->get_name();?>
            </div>

            <div class="pricing-card-price">
                <?php echo $product->get_price().'€/'.ucfirst(get_post_meta($id)['_subscription_period'][0]);?>

            </div>

            <div class="pricing-card-body">
                <?php echo $product->get_description();?>
            </div>

            <div class="pricing-card-footer margin-top-auto">

                <?php

                if (is_user_logged_in()) {
                    $productUrl = $product->add_to_cart_url();
                } else {
                    $productUrl = '/register/supplier/new-company/';
                }

                ?>

                <a class='' href="<?php echo $productUrl; ?>">
                    <div class="pricing-card-subscribe">Start Free Trial</div>
                </a>
            </div>

        </div>

        <?php
        return ob_get_clean();
    }

}
