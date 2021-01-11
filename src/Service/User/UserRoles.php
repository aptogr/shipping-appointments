<?php


namespace ShippingAppointments\Service\User;


class UserRoles {

	const CUSTOM_USER_ROLES = array(
		'shipping_company_admin' => array(
			'display_name'          => 'Shipping Company Admin',
			'default_capabilities'  => array(
				'read'         => true,
				'edit_posts'   => true,
				'upload_files' => true,
			)
		),
		'shipping_company_department_admin' => array(
			'display_name'          => 'Shipping Company Department Admin',
			'default_capabilities'  => array(
				'read'         => true,
				'edit_posts'   => true,
				'upload_files' => true,
			)
		),
		'shipping_company_employee' => array(
			'display_name'          => 'Shipping Company Employee',
			'default_capabilities'  => array(
				'read'         => true,
				'edit_posts'   => true,
				'upload_files' => true,
			)
		),
		'supplier_company_admin' => array(
			'display_name'          => 'Supplier Company Admin',
			'default_capabilities'  => array(
				'read'         => true,
				'edit_posts'   => true,
				'upload_files' => true,
			)
		),
		'supplier_company_employee' => array(
			'display_name'          => 'Supplier Company Employee',
			'default_capabilities'  => array(
				'read'         => true,
				'edit_posts'   => true,
				'upload_files' => true,
			)
		),
	);



	/**
	 * This function is responsible for adding custom user roles
	 * User roles are defined in the constant @see UserRoles::CUSTOM_USER_ROLES
	 */
	public function registerUserRoles(){

		foreach( self::CUSTOM_USER_ROLES as $userRoleSlug => $userRole ){

			add_role(
				$userRoleSlug,
				$userRole['display_name'],
				$userRole['default_capabilities']
			);

		}

	}

}
