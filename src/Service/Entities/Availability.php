<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Traits\Core\PostEntity;

class Availability {

	use PostEntity;

	public $weekdays_available;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = AvailabilityPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

	}

}
