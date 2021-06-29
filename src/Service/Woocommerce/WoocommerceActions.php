<?php

namespace ShippingAppointments\Service\Woocommerce;

class WoocommerceActions {

    public function custom_rewrite_tag() {
        add_rewrite_tag('%dashboard/settings%', 'my-account');
    }


}