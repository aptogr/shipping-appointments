<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\ShippingCompany;

class DashboardAppointmentsShippingCompany extends DashboardAppointmentsRepository {

	/**
	 * DashboardPosts constructor.
	 * @param $shippingCompany ShippingCompany
	 */
	public function __construct( ShippingCompany $shippingCompany ){

		parent::__construct();
		$this->shippingCompany = $shippingCompany;

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

}
