<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\BoilerplatePost;
use Castify\Traits\PostEntity;
use WP_Query;

class BoilerplateEntity {

	use PostEntity;

	public $episodes;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = BoilerplatePost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

	}

}
