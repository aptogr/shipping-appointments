<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\Taxonomy\DepartmentType;
use ShippingAppointments\Service\Entities\DepartmentType as DepartmentTypeEntity;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Service\User\UserRoles;
use ShippingAppointments\Traits\Core\PostEntity;

class Department {

	use PostEntity;

	public $users;

	/**
	 * @var $departmentType DepartmentTypeEntity
	 */
	public $departmentType;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = DepartmentPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

		$this->setDepartmentType();
		$this->setDepartmentUsers();
	}


	private function setDepartmentType(){

		$departmentType         = get_the_terms( $this->ID, DepartmentType::TAXONOMY_SLUG );
		$this->departmentType   = new DepartmentTypeEntity( is_array( $departmentType ) ? $departmentType[0]->term_id : $departmentType->term_id );

	}


	private function setDepartmentUsers(){

		$this->users = get_users(array(
			'role'          => 'shipping_company_employee',
			'meta_key'      => UserFields::META_FIELDS_SLUG['shipping_company_department_id'],
			'meta_value'    => $this->ID
		));

	}

}
