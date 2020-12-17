<?php

namespace ShippingAppointments\Controller\Cron;

class CronController {

    const CRON_EVENTS = array(
        'cron_boilerplate_event' => array(
            'recurrence'  => 'hourly',
            'callback'    => 'boilerplateCallback',
        )
    );


    public function boilerplateCallback(){

        //do something as a corn job callback

    }

}
