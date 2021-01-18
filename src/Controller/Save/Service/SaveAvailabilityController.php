<?php


namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\Entities\Availability;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\User\UserFields;

class SaveAvailabilityController extends ServiceSaveController {

	public $platformUser;

	public function __construct(){

        parent::__construct();
        $this->fieldsSlug = AvailabilityPost::META_FIELDS_SLUG;

	}

	public function saveField( $metaKey, $value ){

        update_post_meta( $this->platformUser->availability->ID, $metaKey, $value );

    }


    public function actionsBeforeSave() {

        if( ! $this->platformUser->availability instanceof Availability ){

            $postData = array(
                'post_title'    => $this->platformUser->user_email . " Availability",
                'post_status'   => 'publish',
                'post_type'     => AvailabilityPost::POST_TYPE_NAME,
                'post_author'   => $this->platformUser->ID,
            );

            $newAvailabilityID = wp_insert_post( $postData );

            add_user_meta( $this->platformUser->ID, UserFields::META_FIELDS_SLUG['availability_id'], $newAvailabilityID );

            $this->platformUser = new PlatformUser( get_current_user_id() );

        }

    }

}
