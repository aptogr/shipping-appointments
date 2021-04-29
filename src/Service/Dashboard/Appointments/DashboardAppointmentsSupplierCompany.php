<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\SupplierCompany;

class DashboardAppointmentsSupplierCompany extends DashboardAppointmentsRepository {

	/**
	 * DashboardPosts constructor.
	 * @param $supplierCompany SupplierCompany
	 */
	public function __construct( SupplierCompany $supplierCompany ){

		parent::__construct();
		$this->supplierCompany = $supplierCompany;

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

}
