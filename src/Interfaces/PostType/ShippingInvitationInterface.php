<?php

namespace ShippingAppointments\Interfaces\PostType;

use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;

Interface ShippingInvitationInterface {

	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'shipping_invitation';


	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'company'                           => self::POST_TYPE_NAME . '_company',
		'department'                        => self::POST_TYPE_NAME . '_department',
		'role'                              => self::POST_TYPE_NAME . '_role',
		'user'                              => self::POST_TYPE_NAME . '_user',
		'status'                            => self::POST_TYPE_NAME . '_status',
		'email'                             => self::POST_TYPE_NAME . '_email',
		'notified'                          => self::POST_TYPE_NAME . '_notified',
	];

	const ALL_FIELDS = array(
		'company' => array(
			'id'            => self::META_FIELDS_SLUG['company'],
			'name'          => 'Company',
			'type'          => 'post',
			'post_type'     => ShippingCompanyPost::POST_TYPE_NAME,
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select a company',
		),
		'department' => array(
			'id'            => self::META_FIELDS_SLUG['department'],
			'name'          => 'Department',
			'type'          => 'post',
			'post_type'     => DepartmentPost::POST_TYPE_NAME,
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select a Department',
		),
		'role' => array(
			'name'              => 'Role',
			'id'                => self::META_FIELDS_SLUG['role'],
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'shipping_company_admin'                => 'Company Admin',
				'shipping_company_department_admin'     => 'Department Admin',
				'shipping_company_employee'             => 'Employee',
			),
		),
		'user' => array(
			'name'              => 'Platform User',
			'id'                => self::META_FIELDS_SLUG['user'],
			'type'              => 'user',
			'field_type'        => 'select_advanced',
			'placeholder'       => 'Select an Employee',
			'multiple'          => false,
			'query_args'        => array(),
		),
		'status' => array(
			'name'              => 'Status',
			'id'                => self::META_FIELDS_SLUG['status'],
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'pending'           => 'Pending',
				'accepted'          => 'Accepted',
				'expired'           => 'Expired',
			),
		),
		'email' => array(
			'name'       => 'Invited User Email',
			'id'         => self::META_FIELDS_SLUG['email'],
			'type'       => 'text',
		),
		'notified' => array(
			'name'       => 'Notified',
			'id'         => self::META_FIELDS_SLUG['notified'],
			'type'       => 'text',
		),
	);


	const INVITATION_FIELDS = array(
		self::ALL_FIELDS['company'],
		self::ALL_FIELDS['department'],
		self::ALL_FIELDS['role'],
		self::ALL_FIELDS['user'],
		self::ALL_FIELDS['status'],
		self::ALL_FIELDS['email'],
		self::ALL_FIELDS['notified'],
	);

}