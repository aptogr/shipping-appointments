<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Traits\Core\PostEntity;

class Availability {

	use PostEntity;

	public $weekdays_available;
	public $excluded_dates;
	public $mon_time_from;
	public $mon_time_to;
	public $tue_time_from;
	public $tue_time_to;
	public $wed_time_from;
	public $wed_time_to;
	public $thu_time_from;
	public $thu_time_to;
	public $fri_time_from;
	public $fri_time_to;
	public $sat_time_from;
	public $sat_time_to;
	public $sun_time_from;
	public $sun_time_to;
	public $weekdays_available_toArray;
	public $excluded_dates_toArray;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = AvailabilityPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

		$this->weekdays_available_toArray   = explode(',', $this->weekdays_available );
		$this->excluded_dates_toArray       = explode(',', $this->excluded_dates );

	}

}
