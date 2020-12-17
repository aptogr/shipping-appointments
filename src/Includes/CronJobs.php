<?php


namespace ShippingAppointments\Includes;

use ShippingAppointments\Controller\Cron\CronController;

class CronJobs {

    protected $loader;
    protected $cronEvents;

    public function __construct( $loader ){

        $this->loader       = $loader;
        $this->cronEvents   = ( defined('ShippingAppointments\Controller\Cron\CronController::CRON_EVENTS') ? CronController::CRON_EVENTS : false );

    }


    /**
     * This function is responsible for registering the scheduled
     * cron jobs to the site and set them to run on a recurrence set
     * in the cron events callback.
     *
     * All the cron events and their callbacks are defined on
     * the @see \ShippingAppointments\Controller\Cron\CronController class
     *
     */
    public function registerScheduledEvents(){

        $availableSchedules = wp_get_schedules();

        if( is_array( $this->cronEvents ) && !empty( $this->cronEvents ) ){

            foreach( $this->cronEvents as $cron_job => $cronData ){

                if( !wp_next_scheduled( $cron_job ) ){

                    $recurrence = ( isset( $cronData['recurrence'] ) && isset( $availableSchedules[ $cronData['recurrence'] ] ) ? $cronData['recurrence'] : 'hourly' );

                    wp_schedule_event ( time(), $recurrence, $cron_job );

                }

            }

        }

    }


    public function addCallbackHooks(){

        $cronController = new CronController();

        foreach( $this->cronEvents as $cron_job => $cronData ){

            if( isset( $cronData['callback'] ) && method_exists( $cronController, $cronData['callback'] ) ){
                $this->loader->addAction( $cron_job , $cronController, $cronData['callback'] );
            }

        }


    }

}
