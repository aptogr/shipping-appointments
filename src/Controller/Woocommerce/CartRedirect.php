<?php

namespace ShippingAppointments\Controller\Woocommerce;


class CartRedirect {

    public function checkoutRedirection ($url) {
        global $woocommerce;
        return wc_get_checkout_url();
    }

}