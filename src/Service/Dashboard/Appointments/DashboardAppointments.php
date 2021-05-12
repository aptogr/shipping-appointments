<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\User\PlatformUser;

class DashboardAppointments extends DashboardAppointmentsRepository {

	/**
	 * DashboardPosts constructor.
	 * @param $platformUser PlatformUser
	 */
	public function __construct( PlatformUser $platformUser ){

	    parent::__construct();
		$this->employeeUser     = $platformUser;

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

	public function getEmployeeConfirmedAppointmentsByDate( $date ){

		$metaQuery = array(
			'relation' => 'AND',
			$this->userConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->specificDateConditionArgs( $date ),
		);

		return $this->getPosts( $metaQuery );

	}

}
