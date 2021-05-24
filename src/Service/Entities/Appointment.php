<?php

namespace ShippingAppointments\Service\Entities;

use DateInterval;
use DateTime;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Traits\Core\PostEntity;
use ShippingAppointments\Traits\InputFunctions;
use WP_User;

class Appointment {

	use PostEntity;
    use InputFunctions;

	public $status;
	public $requested_by;
	public $date;
    public $time;
    public $duration;
    public $buffer;

    public $available_methods;
    public $appointment_method;
    public $one_to_one_location;
    public $location;
    public $phone;
    public $zoom_link;
    public $webex_link;
    public $teams_link;
    public $web_link;

    public $reason;
    public $questions;
    public $file;

    public $company;
    public $department;
    public $employee;
    public $supplier_company;
    public $supplier_employee;
    public $guests;


	/**
	 * @var $companyObject ShippingCompany
	 */
    public $companyObject;

	/**
	 * @var $departmentObject Department
	 */
    public $departmentObject;

	/**
	 * @var $employeeUser PlatformUser
	 */
    public $employeeUser;

	/**
	 * @var $supplierCompanyObject SupplierCompany
	 */
    public $supplierCompanyObject;

	/**
	 * @var $supplierEmployeeUser PlatformUser
	 */
    public $supplierEmployeeUser;

    public $guestsUsers;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = AppointmentPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setEntities();

	}


	private function setEntities(){

       $this->companyObject         = new ShippingCompany( intval( $this->company ) );
       $this->departmentObject      = new Department( intval( $this->department ) );
       $this->employeeUser          = new PlatformUser( intval( $this->employee ) );
       $this->supplierCompanyObject = new SupplierCompany( intval( $this->supplier_company ) );
       $this->supplierEmployeeUser  = new PlatformUser( intval( $this->supplier_employee ) );
       $this->guestsUsers           = array();

       if( !empty( $this->guests ) ){

       	    foreach ( $this->guests as $guest ){

	            $this->guestsUsers[] = new PlatformUser( intval( $guest ) );

            }

       }

    }

	public function getFieldToString( $field ){

		if( property_exists( $this, $field ) ){

			return (isset( AppointmentPost::ALL_FIELDS[$field]['options'][$this->{$field}] ) ? AppointmentPost::ALL_FIELDS[$field]['options'][$this->{$field}] : $this->{$field} );


		}
		else {
			return '-';
		}


	}

	public function getDisplayDate(){

		return date('d/m/Y', strtotime( $this->date ) );

	}

	/**
	 * @param $user PlatformUser
	 *
	 * @return bool
	 */
	public function canAccess( PlatformUser $user ): bool {

		if( $user->isWebsiteAdmin() ){
			return true;
		}

		if( $user->isShippingCompanyAdmin() && $user->shippingCompany->ID === $this->companyObject->ID ){
			return true;
		}

		if( $user->isDepartmentAdmin() && $user->department->ID === $this->departmentObject->ID ){
			return true;
		}

		if( $user->isShippingCompanyEmployee() && $user->ID === $this->employeeUser->ID ){
			return true;
		}

		if( $user->isSupplierCompanyAdmin() && $user->supplierCompany->ID === $this->supplierCompanyObject->ID ){
			return true;
		}

		if( $user->isSupplierCompanyEmployee() && $user->ID === $this->supplierEmployeeUser->ID ){
			return true;
		}

		return false;

    }

    public function getAppointmentTimeRange(){

	    $from   = $this->time;
	    $from   = date("h:i", strtotime("-30 minutes", strtotime("2021-01-01 $this->time")));
        $to     = date("h:i", strtotime($this->time) + ( $this->duration*60 ) + ( $this->buffer*60 ) );

	    return array( $from, $to );

    }

    public function getTrueAppointmentTimeRange(){

	    $from   = date("h:i", strtotime($this->time ) );
	    $to     = date("h:i", strtotime($this->time) + ( $this->duration*60 ) + ( $this->buffer*60 ) );

	    return array( $from, $to );

    }

	public function getDisplayDateTime() {

		return $this->getDisplayDate() . ' at ' . $this->time;

	}


	public function isCompleted(): bool {

		return $this->date <= date('Y-m-d') && $this->status === 'confirmed';

	}


}
