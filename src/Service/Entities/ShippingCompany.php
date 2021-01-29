<?php


namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Traits\Core\PostEntity;
use WP_Query;

class ShippingCompany {

	use PostEntity;

	public $departments;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = ShippingCompanyPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setDepartments();

	}


	public function setDepartments(){

		$this->departments = array();

		$arr = array(
			'post_type'         => DepartmentPost::POST_TYPE_NAME,
			'posts_per_page'    => -1,
			'meta_query' => array(
				array(
					'key'     => DepartmentPost::META_FIELDS_SLUG['company'],
					'value'   => $this->ID,
					'compare' => '='
				),
			)
		);

		$query = new WP_Query($arr);

		// The Loop
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$this->departments[] = get_the_ID();
			}

		}

		// Restore original Post Data
		wp_reset_postdata();

	}

}
