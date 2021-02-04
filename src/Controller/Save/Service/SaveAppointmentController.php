<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\AppointmentPost;

class SaveAppointmentController extends ServiceSaveController {

    public $appointmentID;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = AppointmentPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ){

        update_post_meta( $this->appointmentID, $metaKey, $value );

    }

    public function actionsBeforeSave($formData) {

//        var_dump($formData);

            $postData = array(
//                'post_title'    => $this->platformUser->user_email . " Appointment",
                'post_title'    => "Appointment " . $formData["date"],
                'post_status'   => 'publish',
                'post_type'     => AppointmentPost::POST_TYPE_NAME,
                'post_author'   => $formData["appointmentUserId"],
            );

            $this->appointmentID = wp_insert_post( $postData );


    }


}