<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Traits\MediaUploader;

class SaveAppointmentController extends ServiceSaveController {

	use MediaUploader;

    public $appointmentID;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = AppointmentPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ){


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


            $postData = array(
                'post_title'    => "Appointment " . $formData["date"],
                'post_status'   => 'publish',
                'post_type'     => AppointmentPost::POST_TYPE_NAME,
                'post_author'   => $formData["appointmentUserId"],
            );

            $this->appointmentID = wp_insert_post( $postData );
            update_post_meta($this->appointmentID, $this->fieldsSlug['status'], 'pending_approval');

    }


    public function uploadAndSaveFile( $fileData ){

    	if( isset( $fileData['myFile'] ) ){

		    $attachID = $this->uploadFile( $fileData['myFile'] );

		    if ( $attachID ){

    			update_post_meta( $this->appointmentID, $this->fieldsSlug['file'], $attachID );

		    }

	    }

    }

}
