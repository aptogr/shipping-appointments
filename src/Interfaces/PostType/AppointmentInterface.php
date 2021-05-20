<?php

namespace ShippingAppointments\Interfaces\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;

Interface AppointmentInterface {

	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'user_appointments';


	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'status'                        => self::POST_TYPE_NAME . '_status',
		'date'                          => self::POST_TYPE_NAME . '_date',
		'time'                          => self::POST_TYPE_NAME . '_from_time',
		'duration'                      => self::POST_TYPE_NAME . '_meeting_time_duration',
		'buffer'                        => self::POST_TYPE_NAME . '_buffer',

		//participating:
		'company'                       => self::POST_TYPE_NAME . '_company',
		'department'                    => self::POST_TYPE_NAME . '_department',
		'employee'                      => self::POST_TYPE_NAME . '_employee',
		'requested_by'                  => self::POST_TYPE_NAME . '_requested_by',
		'supplier_company'              => self::POST_TYPE_NAME . '_supplier_company',
		'supplier_employee'             => self::POST_TYPE_NAME . '_supplier_employee',
		'guests'                        => self::POST_TYPE_NAME . '_guests',

		//Meeting Method
		'available_methods'             => self::POST_TYPE_NAME . '_available_methods',
		'appointment_method'            => self::POST_TYPE_NAME . '_appointment_method',

		'one_to_one_location'           => self::POST_TYPE_NAME . '_one_to_one_location',
		'location'                      => self::POST_TYPE_NAME . '_location',
		'phone'                         => self::POST_TYPE_NAME . '_phone',

		//Web Links
		'zoom_link'                     => self::POST_TYPE_NAME . '_zoom_link',
		'webex_link'                    => self::POST_TYPE_NAME . '_webex_link',
		'teams_link'                    => self::POST_TYPE_NAME . '_teams_link',
		'web_link'                      => self::POST_TYPE_NAME . '_web_link',

		//Additional Information
		'reason'                        => self::POST_TYPE_NAME . '_reason',
		'questions'                     => self::POST_TYPE_NAME . '_invite_questions',
		'file'                          => self::POST_TYPE_NAME . '_file',

	];


	const ALL_FIELDS = array(
		'status' => array(
			'id'              => self::META_FIELDS_SLUG['status'],
			'name'            =>  'Status',
			'type'            => 'select',
			'options'         => array(
				'confirmed'         => 'Confirmed',
				'pending_approval'  => 'Pending Approval',
				'rejected'          => 'Rejected',
				'cancelled'         => 'Cancelled',
			),
			'multiple'        => false,
			'placeholder'     => 'Select Status',
		),
		'date' => array(
			'name'       =>  'Date',
			'id'         => self::META_FIELDS_SLUG['date'],
			'type'       => 'date',

			'js_options' => array(
				'dateFormat'      => 'yy-mm-dd',
				'showButtonPanel' => false,
			),
			'inline'     => false,
			'timestamp'  => false,
		),
		'time' => array(
			'name'       =>  'Time',
			'id'         => self::META_FIELDS_SLUG['time'],
			'type'       => 'time',
			'js_options' => array(
				'stepMinute'      => 15,
				'controlType'     => 'select',
				'showButtonPanel' => false,
				'oneLine'         => true,
			),
			'inline'     => false,
		),
		'duration' => array(
			'name'          =>  'Meeting Duration (in minutes)',
			'id'            => self::META_FIELDS_SLUG['duration'],
			'type'          => 'number',
		),
		'buffer' => array(
			'name'          =>  'Meeting Buffer (in minutes)',
			'id'            => self::META_FIELDS_SLUG['buffer'],
			'type'          => 'number',
		),
		'requested_by' => array(
			'name'          =>  'Who made the request for the appointment',
			'id'            => self::META_FIELDS_SLUG['requested_by'],
			'type'          => 'radio',
			'options'       => array(
				'supplier'              => 'Supplier',
				'shipping_company'      => 'Shipping Company',
			),
			'inline'    => true,
		),
		'company' => array(
			'id'   => self::META_FIELDS_SLUG['company'],
			'name' => 'Company',
			'type'        => 'post',
			'post_type'   => ShippingCompanyPost::POST_TYPE_NAME,
			'field_type'  => 'select_advanced',
			'placeholder' => 'Select a company',
		),
		'department' => array(
			'id'            => self::META_FIELDS_SLUG['department'],
			'name'          => 'Department',
			'type'          => 'post',
			'post_type'     => DepartmentPost::POST_TYPE_NAME,
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select a Department',
		),
		'employee' => array(
			'id'            => self::META_FIELDS_SLUG['employee'],
			'name'          => 'Employee',
			'type'          => 'user',
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select an Employee',
			'multiple'      => false,
			'query_args'    => array(),
		),
		'supplier_company'  => array(
			'id'            => self::META_FIELDS_SLUG['supplier_company'],
			'name'          => 'Supplier Company',
			'type'          => 'post',
			'post_type'     => SupplierCompanyPost::POST_TYPE_NAME,
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select a Supplier',
		),
		'supplier_employee' => array(
			'id'            => self::META_FIELDS_SLUG['supplier_employee'],
			'name'          => 'Supplier Employee',
			'type'          => 'user',
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select a supplier employee',
			'multiple'      => false,
			'query_args'    => array(),
		),
		'guests' => array(
			'id'            => self::META_FIELDS_SLUG['guests'],
			'name'          => 'Guests',
			'type'          => 'user',
			'field_type'    => 'select_advanced',
			'placeholder'   => 'Select Guests',
			'multiple'      => true,
			'query_args'    => array(),
		),

		'available_methods' => array(
			'id'              => self::META_FIELDS_SLUG['available_methods'],
			'name'            =>  'Available Appointment Methods',
			'type'            => 'checkbox_list',
			'options'         => array(
				'physical_location'     => 'Physical Location',
				'phone_call'            => 'Phone Call',
				'remote_online'         => 'Remote Online',
			),
			'inline' => true,
		),
		'appointment_method' => array(
			'name'          =>  'Selected Appointment Method',
			'id'            => self::META_FIELDS_SLUG['appointment_method'],
			'type'          => 'radio',
			'options'       => array(
				'physical_location'     => 'One to One',
				'phone_call'            => 'Phone',
				'remote_online'         => 'Web',
			),
			'inline'    => true,
		),
		'one_to_one_location' => array(
			'name'          =>  'One to One Location',
			'id'            => self::META_FIELDS_SLUG['one_to_one_location'],
			'type'          => 'radio',
			'options'       => array(
				'premises'          => 'Premises',
				'other'             => 'Other',
			),
			'inline'    => true,
		),
		'location' => array(
			'id'    => self::META_FIELDS_SLUG['location'],
			'name'  =>  'Other Location',
			'type'  => 'text',
		),
		'phone' => array(
			'name'  =>  'Phone',
			'id'    => self::META_FIELDS_SLUG['phone'],
			'type'  => 'tel',
		),
		'zoom_link' => array(
			'id'    => self::META_FIELDS_SLUG['zoom_link'],
			'name'  =>  'Zoom Link',
			'type'  => 'text',
		),
		'webex_link' => array(
			'id'    => self::META_FIELDS_SLUG['webex_link'],
			'name'  =>  'Webex Link',
			'type'  => 'text',
		),
		'teams_link' => array(
			'id'    => self::META_FIELDS_SLUG['teams_link'],
			'name'  =>  'Microsoft Team Link',
			'type'  => 'text',
		),
		'web_link' => array(
			'id'    => self::META_FIELDS_SLUG['web_link'],
			'name'  =>  'Web Link',
			'type'  => 'text',
		),
		'reason' => array(
			'name'          =>  'Appointment Reason',
			'id'            => self::META_FIELDS_SLUG['reason'],
			'type'          => 'radio',
			'options'       => array(
				'company_introduction'          => 'Company Introduction',
				'new_product'                   => 'New Product',
				'product_introduction'          => 'Product Introduction',
			),
			'inline'    => true,
		),
		'questions' => array(
			'id'            => self::META_FIELDS_SLUG['questions'],
			'name'          =>  'Invite Questions',
			'type'          => 'wysiwyg',
			'raw'           => true,
			'options'       => array(
				'textarea_rows' => 4,
				'teeny'         => true,
			),
		),
		'file' => array(
			'id'    => self::META_FIELDS_SLUG['file'],
			'name'  =>  'File Attached',
			'type'  => 'file_advanced',
		),
	);

	const PRIMARY_FIELDS = array(
		self::ALL_FIELDS['status'],
		self::ALL_FIELDS['requested_by'],
		self::ALL_FIELDS['date'],
		self::ALL_FIELDS['time'],
		self::ALL_FIELDS['duration'],
		self::ALL_FIELDS['buffer'],
	);

	const PARTICIPANTS_FIELDS = array(
		self::ALL_FIELDS['company'],
		self::ALL_FIELDS['department'],
		self::ALL_FIELDS['employee'],
		self::ALL_FIELDS['supplier_company'],
		self::ALL_FIELDS['supplier_employee'],
		self::ALL_FIELDS['guests'],
	);

	const MEETING_FIELDS = array(
		self::ALL_FIELDS['available_methods'],
		self::ALL_FIELDS['appointment_method'],
		self::ALL_FIELDS['one_to_one_location'],
		self::ALL_FIELDS['location'],
		self::ALL_FIELDS['phone'],
		self::ALL_FIELDS['zoom_link'],
		self::ALL_FIELDS['webex_link'],
		self::ALL_FIELDS['teams_link'],
		self::ALL_FIELDS['web_link'],
		self::ALL_FIELDS['reason'],
		self::ALL_FIELDS['questions'],
		self::ALL_FIELDS['file'],
	);

}
