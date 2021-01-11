<?php


namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use Castify\Traits\PostEntity;

class ShippingCompany {

	use PostEntity;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = ShippingCompanyPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

	}

}
