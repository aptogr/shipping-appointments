<?php


namespace ShippingAppointments\Service\User;

use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;

class UserFields {

	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'shipping_company_id'               => 'user_shipping_company',
		'shipping_company_department_id'    => 'user_shipping_company_department',
		'supplier_company_id'               => 'user_supplier_company_id',
		'availability_id'                   => 'user_availability',
		'meeting_duration'                  => 'user_meeting_duration',
		'meeting_buffer'                    => 'user_meeting_buffer',
		'max_meetings_per_day'              => 'user_max_meetings_per_day',
		'book_in_advance_days'              => 'user_book_in_advance_days',
		'booking_request_type'              => 'user_booking_request_type',
		'meet_same_supplier_times'          => 'user_meet_same_supplier_times',
		'cancellation_policy'               => 'user_cancellation_policy',
	];

	public function registerUserFields( $meta_boxes ) {


		$meta_boxes[] = array(
			'title' => 'Company Info',
			'type'  => 'user',
			'fields' => array(
				array(
					'name'              => 'Shipping Company',
					'id'                => self::META_FIELDS_SLUG['shipping_company_id'],
					'desc'              => 'The shipping company the user belongs to. Applicable only if the user is a Shipping Company Admin, Department Admin or Shipping company employee',
					'type'              => 'post',
					'post_type'         => ShippingCompanyPost::POST_TYPE_NAME,
					'field_type'        => 'select',
					'placeholder'       => 'Select a company',
				),
				array(
					'name'              => 'Shipping Company Department',
					'id'                => self::META_FIELDS_SLUG['shipping_company_department_id'],
					'desc'              => 'The shipping company department the user belongs to. Applicable only if the user is a Shipping Company Department Admin or Shipping company employee',
					'type'              => 'post',
					'post_type'         => DepartmentPost::POST_TYPE_NAME,
					'field_type'        => 'select_advanced',
					'placeholder'       => 'Select a department',
				),
				array(
					'name'              => 'Supplier Company',
					'id'                => self::META_FIELDS_SLUG['supplier_company_id'],
					'desc'              => 'The shipping company department the user belongs to. Applicable only if the user is a Supplier Company Admin or Supplier company employee',
					'type'              => 'post',
					'post_type'         => SupplierCompanyPost::POST_TYPE_NAME,
					'field_type'        => 'select_advanced',
					'placeholder'       => 'Select a supplier company',
				),
			),
		);

		$meta_boxes[] = array(
			'title' => 'Booking Settings',
			'type'  => 'user', // Specifically for user
			'fields' => array(
				array(
					'name'              => 'User Availability',
					'id'                => self::META_FIELDS_SLUG['availability_id'],
					'type'              => 'post',
					'post_type'         => AvailabilityPost::POST_TYPE_NAME,
					'field_type'        => 'select',
					'placeholder'       => 'Select an availability object',
				),
				array(
					'name'              => 'Meeting Time Duration',
					'id'                => self::META_FIELDS_SLUG['meeting_duration'],
					'desc'              => 'Timeframe of the meeting in minutes (ex.30)',
					'type'              => 'number',
				),
				array(
					'name'              => 'Meeting Time Buffer',
					'id'                => self::META_FIELDS_SLUG['meeting_buffer'],
					'desc'              => 'Buffer duration (in minutes) before and after meetings',
					'type'              => 'number',
				),
				array(
					'name'              => 'Max meetings per day',
					'id'                => self::META_FIELDS_SLUG['max_meetings_per_day'],
					'desc'              => 'The maximum meetings the current user can be booked for.',
					'type'              => 'number',
				),
				array(
					'name'              => 'Book in advance days',
					'id'                => self::META_FIELDS_SLUG['book_in_advance_days'],
					'desc'              => 'The minimum days notice to book the current user for.',
					'type'              => 'number',
				),
				array(
					'name'              => 'Booking request type',
					'id'                => self::META_FIELDS_SLUG['booking_request_type'],
					'desc'              => 'The way the booking requests are made. Email or instant booking',
					'type'              => 'radio',
					'options'         => array(
						'email'             => 'Ask via Email first',
						'instant'           => 'Instant Booking',
					),
				),
				array(
					'name'              => 'How many times to meet same supplier',
					'id'                => self::META_FIELDS_SLUG['meet_same_supplier_times'],
					'desc'              => 'The maximum number of times the user can meet a supplier',
					'type'              => 'number',
				),
				array(
					'name'              => 'Cancellation Policy',
					'id'                => self::META_FIELDS_SLUG['cancellation_policy'],
					'desc'              => 'The cancellation policy for bookings.',
					'type'              => 'textarea',
				),
			),
		);

		return $meta_boxes;

	}

}
