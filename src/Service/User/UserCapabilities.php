<?php


namespace ShippingAppointments\Service\User;


class UserCapabilities {


	/**
	 * An associative array where the key is the 'capability' name
	 * Value is an array of user roles slugs
	 */
	const CUSTOM_USER_CAPABILITIES = array(
		'edit_shipping_company_profile'             => array(
			'shipping_company_admin'
		),
		'edit_shipping_company_department'          => array(
			'shipping_company_admin',
			'shipping_company_department_admin'
		),
		'view_shipping_company_public_profile'      => array(
			'shipping_company_admin',
			'shipping_company_department_admin',
			'shipping_company_employee',
			'supplier_company_admin',
			'supplier_company_employee'
		),
		'edit_supplier_company_profile'             => array(
			'supplier_company_admin'
		),
		'view_supplier_company_public_profile'      => array(
			'shipping_company_admin',
			'shipping_company_department_admin',
			'shipping_company_employee',
			'supplier_company_admin',
			'supplier_company_employee'
		),
		'edit_shipping_company_employee_info'        => array(
			'shipping_company_admin',
			'shipping_company_department_admin',
			'shipping_company_employee',
		),
		'edit_supplier_company_employee_info'        => array(
			'supplier_company_admin',
			'supplier_company_employee'
		),
		'book_shipping_company_employee'             => array(
			'supplier_company_admin',
			'supplier_company_employee'
		),
		'book_supplier_company_employee'            => array(
			'shipping_company_admin',
			'shipping_company_department_admin',
			'shipping_company_employee',
		),
		'add_shipping_company_employee' => array(
			'shipping_company_admin',
			'shipping_company_department_admin',
		),
		'add_supplier_company_employee' => array(
			'supplier_company_admin',
		),
	);



	/**
	 * This function is responsible for adding custom capabilities
	 * to the user roles define in the constant @see UserCapabilities::CUSTOM_USER_CAPABILITIES
	 */
	public function registerUserCapabilities(){

		foreach( self::CUSTOM_USER_CAPABILITIES as $capability => $userRoles ){

			foreach( $userRoles as $userRoleSlug ){

				// gets the user role object based on the $userRoleSlug
				$role = get_role( $userRoleSlug );

				// add the custom capability to the user role
				$role->add_cap( $capability, true);

			}

		}

	}

}
