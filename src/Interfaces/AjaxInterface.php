<?php

namespace ShippingAppointments\Interfaces;

Interface AjaxInterface {

    const AJAX_ACTIONS = array(
        'testAjax' => array(
            'callback' => 'testAjax',
            'nopriv'   => false,
        ),
        'getBookingTimes' => array(
            'callback' => 'getBookingTimes',
            'nopriv'   => false,
        ),
    );

}
