<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\AppointmentPost;

class CancelAppointmentController extends ServiceSaveController {

    public $appointmentID;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = AppointmentPost::META_FIELDS_SLUG;

    }

    public function save( $formData ): bool {

        $this->appointmentID = $formData['appointmentID'];

        update_post_meta($this->appointmentID, $this->fieldsSlug['status'], 'cancelled');
        return true;

    }


}