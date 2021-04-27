<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;
use WP_Query;

class DashboardAppointments {

	public $postType;
	public $postMetaSlugs;


	/**
	 * @var $platformUser PlatformUser
	 */
	public $platformUser;

	/**
	 * DashboardPosts constructor.
	 * @param $platformUser PlatformUser
	 */
	public function __construct( $platformUser ){

		$this->platformUser     = $platformUser;
		$this->postType         = AppointmentPost::POST_TYPE_NAME;
		$this->postMetaSlugs    = AppointmentPost::META_FIELDS_SLUG;

	}


	public function getShippingCompanyPendingAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->shippingCompanyConditionArgs(),
			$this->statusConditionsArgs( array('pending_approval') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}

	public function getShippingCompanyConfirmedAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->shippingCompanyConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getShippingCompanyPastAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->shippingCompanyConditionArgs(),
			$this->dateConditionArgs('<'),
		);

		return $this->getPosts( $metaQuery );

	}

	public function getDepartmentPendingAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->departmentConditionArgs(),
			$this->statusConditionsArgs( array('pending_approval') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}

	public function getDepartmentConfirmedAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->departmentConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getDepartmentPastAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->departmentConditionArgs(),
			$this->dateConditionArgs('<'),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getEmployeePendingAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->userConditionArgs(),
			$this->statusConditionsArgs( array('pending_approval') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}

	public function getEmployeeConfirmedAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->userConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getEmployeePastAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->userConditionArgs(),
			$this->dateConditionArgs('<'),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getSupplierCompanyPendingAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->supplierCompanyConditionArgs(),
			$this->statusConditionsArgs( array('pending_approval') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}

	public function getSupplierCompanyConfirmedAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->supplierCompanyConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->dateConditionArgs('>='),
		);

		return $this->getPosts( $metaQuery );

	}


	public function getSupplierCompanyPastAppointments(){

		$metaQuery = array(
			'relation' => 'AND',
			$this->supplierCompanyConditionArgs(),
			$this->dateConditionArgs('<'),
		);

		return $this->getPosts( $metaQuery );

	}


	protected function shippingCompanyConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['company'],
			'value'   => $this->platformUser->shippingCompany->ID,
			'compare' => '=',
		);

	}

	protected function departmentConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['department'],
			'value'   => $this->platformUser->department->ID,
			'compare' => '=',
		);

	}

	protected function supplierCompanyConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['supplier_company'],
			'value'   => $this->platformUser->supplierCompany->ID,
			'compare' => '=',
		);

	}

	protected function userConditionArgs(){

		return  array(
			'relation' => 'OR',
			array(
				'key'     => $this->postMetaSlugs['employee'],
				'value'   => $this->platformUser->ID,
				'compare' => '=',
			),
			array(
				'key'     => $this->postMetaSlugs['supplier_employee'],
				'value'   => $this->platformUser->ID,
				'compare' => '=',
			),
		);

	}

	protected function dateConditionArgs( $compare ){

		return array(
			'key'     => $this->postMetaSlugs['date'],
			'value'   => date('Y-m-d'),
			'compare' => $compare,
		);

	}

	protected function statusConditionsArgs( $statuses ){

		if( count( $statuses ) > 1 ){

			$args = array(
				'relation' => 'OR',
			);

			foreach( $statuses as $status ){

				$args[] = array(
					'key'     => $this->postMetaSlugs['status'],
					'value'   => $status,
					'compare' => '=',
				);

			}

			return $args;

		}
		else {

			return array(
				'key'     => $this->postMetaSlugs['status'],
				'value'   => $statuses[0],
				'compare' => '=',
			);

		}

	}

	protected function getPosts( $metaQuery ){

		$args = array(
			'post_type'         => $this->postType,
			'posts_per_page'    => -1,
			'meta_key'          => $this->postMetaSlugs['date'],
			'orderby'           => 'meta_value',
			'meta_type'         => 'DATE',
			'order'             => 'DESC',
			'meta_query'        => $metaQuery,
		);

		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {

			$ids = array();

			while ( $query->have_posts() ) {
				$query->the_post();
				$ids[] = get_the_ID();
			}

		}
		else {
			$ids = false;
		}

		// Restore original Post Data
		wp_reset_query();
		wp_reset_postdata();

		return $ids;

	}

}
