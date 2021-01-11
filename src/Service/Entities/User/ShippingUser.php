<?php


namespace ShippingAppointments\Service\Entities\User;


use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\User\UserFields;

class ShippingUser extends PlatformUser {

	public $shippingCompany;
	public $shippingCompanyDepartment;

	public function __construct( $id = 0, $name = '', $site_id = '' ) {
		parent::__construct( $id, $name, $site_id );
		$this->setUserAvailability();

		$shippingCompanyID      = rwmb_meta(UserFields::META_FIELDS_SLUG['shipping_company'], array( 'object_type' => 'user' ), $this->ID );
		$shippingDepartmentID   = rwmb_meta(UserFields::META_FIELDS_SLUG['shipping_company_department'], array( 'object_type' => 'user' ), $this->ID );

		$this->shippingCompany              = new ShippingCompany( $shippingCompanyID );
		$this->shippingCompanyDepartment    = new Department( $shippingDepartmentID );

	}

}
