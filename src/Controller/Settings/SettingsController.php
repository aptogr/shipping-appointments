<?php

namespace ShippingAppointments\Controller\Settings;

use ShippingAppointments\Includes\Settings;

class SettingsController
{

    public $options;

    public function __construct(){

        $settings = new \ShippingAppointments\Includes\Settings('shipping-appointments');
        $this->options = $settings->getOptions();

    }

}
