<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Traits\Core\PostEntity;

class Department {

	use PostEntity;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = DepartmentPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

	}

}
