<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\Appointment;
use ShippingAppointments\Service\Entities\Department;

class DashboardAppointmentsDepartment extends DashboardAppointmentsRepository {

	/**
	 * DashboardPosts constructor.
	 *
	 * @param $department Department
	 */
	public function __construct( Department $department ) {

		parent::__construct();
		$this->department = $department;

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


	public function getDepartmentConfirmedAppointmentsByDate( $date ){

		$metaQuery = array(
			'relation' => 'AND',
			$this->departmentConditionArgs(),
			$this->statusConditionsArgs( array('confirmed') ),
			$this->specificDateConditionArgs( $date ),
		);

		return $this->getPosts( $metaQuery );

	}


	public function confirmedAppointmentByDateTime( $date, $time ): array {

		$confirmedAppointments = array();
		$appointments = $this->getDepartmentConfirmedAppointmentsByDate( $date );

		foreach( $appointments as $appointmentID ){

			$bookedAppointment  = new Appointment( intval( $appointmentID ) );

			if( $bookedAppointment->time === $time ){

				$confirmedAppointments[] = $bookedAppointment;

			}

		}

		return $confirmedAppointments;

	}

}
