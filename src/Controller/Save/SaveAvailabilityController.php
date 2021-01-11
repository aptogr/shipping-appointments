<?php


namespace ShippingAppointments\Controller\Save;

use ShippingAppointments\Service\Entities\Availability;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\User\UserFields;

class SaveAvailabilityController {

	public $platformUser;

	public function __construct(){

		$this->platformUser = new PlatformUser( get_current_user_id() );

	}

	public function save( $formData ){

		if( ! $this->platformUser->availability instanceof Availability ){

			$this->createAvailabilityItem();

		}

		foreach( AvailabilityPost::META_FIELDS_SLUG as $formField => $metaKey ){

			if( isset( $formData[ $formField ] ) ){

				$value = ( is_array( $formData[ $formField ] ) ? implode( ',', $formData[ $formField ] ) : $formData[ $formField ] );

				update_post_meta( $this->platformUser->availability->ID, $metaKey, $value );

			}

		}

		return true;

	}


	public function createAvailabilityItem(){

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
