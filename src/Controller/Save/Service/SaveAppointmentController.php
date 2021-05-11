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

//        var_dump($value);
//        update_post_meta( $this->appointmentID, $metaKey, $value );

        if ( is_array( explode( ',', $value ) ) && count(explode( ',', $value )) > 1 ){
            $value = explode( ',', $value );
        }

        if (is_array($value)) {

            delete_post_meta( $this->appointmentID, $metaKey );

            foreach ( $value as $val ){
                add_post_meta( $this->appointmentID, $metaKey, $val );
            }


        } else {
            update_post_meta( $this->appointmentID, $metaKey, $value );
        }


    }

    public function actionsBeforeSave($formData) {

//        var_dump($formData);

            $postData = array(
                'post_title'    => "Appointment " . $formData["date"],
                'post_status'   => 'publish',
                'post_type'     => AppointmentPost::POST_TYPE_NAME,
                'post_author'   => $formData["appointmentUserId"],
            );

            $this->appointmentID = wp_insert_post( $postData );
            update_post_meta($this->appointmentID, $this->fieldsSlug['status'], 'pending_approval');

    }

}