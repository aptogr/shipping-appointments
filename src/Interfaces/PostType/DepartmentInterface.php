<?php

namespace ShippingAppointments\Interfaces\PostType;

use ShippingAppointments\Includes\ShippingAppointments as ShippingAppointments;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;

Interface DepartmentInterface {

	/**
	 * Post Type Slug
	 * @var string
	 */
	const POST_TYPE_NAME = 'shipping_department';

	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'company'                           => self::POST_TYPE_NAME . '_company',
		'type'                              => self::POST_TYPE_NAME . '_type',
		'status'                            => self::POST_TYPE_NAME . '_status',

		//Setting 1
		'users_visibility'                  => self::POST_TYPE_NAME . '_users_visibility',

		//Setting 2
		'availability_type'                 => self::POST_TYPE_NAME . '_availability_type',
		'cancellations'                     => self::POST_TYPE_NAME . '_cancellations',
		'weekdays_available'                => self::POST_TYPE_NAME . '_weekdays_available',
		'mon_time_from'                     => self::POST_TYPE_NAME . '_mon_time_from',
		'mon_time_to'                       => self::POST_TYPE_NAME . '_mon_time_to',
		'tue_time_from'                     => self::POST_TYPE_NAME . '_tue_time_from',
		'tue_time_to'                       => self::POST_TYPE_NAME . '_tue_time_to',
		'wed_time_from'                     => self::POST_TYPE_NAME . '_wed_time_from',
		'wed_time_to'                       => self::POST_TYPE_NAME . '_wed_time_to',
		'thu_time_from'                     => self::POST_TYPE_NAME . '_thu_time_from',
		'thu_time_to'                       => self::POST_TYPE_NAME . '_thu_time_to',
		'fri_time_from'                     => self::POST_TYPE_NAME . '_fri_time_from',
		'fri_time_to'                       => self::POST_TYPE_NAME . '_fri_time_to',
		'sat_time_from'                     => self::POST_TYPE_NAME . '_sat_time_from',
		'sat_time_to'                       => self::POST_TYPE_NAME . '_sat_time_to',
		'sun_time_from'                     => self::POST_TYPE_NAME . '_sun_time_from',
		'sun_time_to'                       => self::POST_TYPE_NAME . '_sun_time_to',
		'excluded_dates'                    => self::POST_TYPE_NAME . '_excluded_dates',

		//Setting 3
		'meeting_types'                     => self::POST_TYPE_NAME . '_meeting_types',
		'meeting_types_available'           => self::POST_TYPE_NAME . '_meeting_types_available',

		//Setting 4
		'selected_products'                 => self::POST_TYPE_NAME . '_selected_products',
		'selected_brands'                   => self::POST_TYPE_NAME . '_selected_brands',

		//Setting 5
		'instant_booking'                   => self::POST_TYPE_NAME . '_instant_booking',
		'instant_booking_products'          => self::POST_TYPE_NAME . '_instant_booking_products',
		'instant_booking_brands'            => self::POST_TYPE_NAME . '_instant_booking_brands',
		'instant_booking_suppliers'         => self::POST_TYPE_NAME . '_instant_booking_brandsDDDDDD',

		//Setting 6
		'minimum_notice'                    => self::POST_TYPE_NAME . '_minimum_notice',
		'minimum_notice_hours'              => self::POST_TYPE_NAME . '_minimum_notice_hours',

		//Setting 7
		'meeting_repetition'                => self::POST_TYPE_NAME . '_meeting_repetition',
		'meeting_repetition_time'           => self::POST_TYPE_NAME . '_meeting_repetition_time',

		//Setting 8
		'simultaneous_meetings'             => self::POST_TYPE_NAME . '_simultaneous_meetings',


		'availability_period'               => self::POST_TYPE_NAME . '_availability_period',
		'availability_period_saved_date'    => self::POST_TYPE_NAME . '_availability_period_saved_date',

	];


	const ALL_FIELDS = array(
		'company' => array(
			'id'   => self::META_FIELDS_SLUG['company'],
			'name' => 'Company',
			'type'        => 'post',
			'post_type'   => ShippingCompanyPost::POST_TYPE_NAME,
			'field_type'  => 'select_advanced',
			'placeholder' => 'Select a company',
		),

        'status' => array(
			'id'        => self::META_FIELDS_SLUG['status'],
			'name'      => 'Department status',
            'type'      => 'radio',
            'options'   => array(
                'enabled'   => 'Enabled',
                'disabled'  => 'Disabled',
                'inactive'  => 'Inactive',
            ),
            'inline'    => true,
		),

		'users_visibility'   =>array(
			'name'              => 'Users Visibility',
			'id'                => self::META_FIELDS_SLUG['users_visibility'],
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'department_users_visibile'             => 'Visibile Users',
				'department_users_invisibile'           => 'Invisible Users',
				'department_users_department'           => 'Let the users define',
			),
		),
		'meeting_types' => array(
			'name'              => 'Meeting Type Settings',
			'id'                => self::META_FIELDS_SLUG['meeting_types'],
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'department'            => 'Defined by Department',
				'user'                  => 'Let the Employees define',
			),
		),
		'meeting_types_available' => array(
			'name'              => 'Meeting Types Available',
			'id'                => self::META_FIELDS_SLUG['meeting_types_available'],
			'type'              => 'checkbox_list',
			'options'           => array(
				'physical_location'     => 'Physical Location',
				'phone_call'            => 'Phone Call',
				'online'                => 'Remote Online',
			),
			'inline'            => false,
			'select_all_none'   => true,
		),
		'selected_products' => array(
			'name'       => 'Products',
			'id'         => self::META_FIELDS_SLUG['selected_products'],
			'type'       => 'text',
		),
		'selected_brands' => array(
			'name'       => 'Brands',
			'id'         => self::META_FIELDS_SLUG['selected_brands'],
			'type'       => 'text',
		),

		'instant_booking' => array(
			'name'              => 'Instant Booking',
			'id'                => self::META_FIELDS_SLUG['instant_booking'],
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'accept_specific'               => 'Accept for specific',
				'decline'                       => 'Do not accept',
				'user'                          => 'Let the users define',
			),
		),
        'instant_booking_products' => array(
            'name'       => 'Instant Booking: Specific Products',
            'id'         => self::META_FIELDS_SLUG['instant_booking_products'],
            'type'       => 'text',
        ),
        'instant_booking_brands' => array(
            'name'       => 'Instant Booking: Specific Brands',
            'id'         => self::META_FIELDS_SLUG['instant_booking_brands'],
            'type'       => 'text',
        ),
//		'instant_booking_products' => array(
//			'name'          => 'Instant Booking: Specific Products',
//			'id'            => self::META_FIELDS_SLUG['instant_booking_products'],
//			'type'          => 'taxonomy',
//			'multiple'      => true,
//			'field_type'    => 'select_advanced',
//			'taxonomy'      => 'profenda_product_type',
//			'placeholder'   => 'Select Products',
//		),
//		'instant_booking_brands' => array(
//			'name'          => 'Instant Booking: Specific Brands',
//			'id'            => self::META_FIELDS_SLUG['instant_booking_brands'],
//			'type'          => 'taxonomy',
//			'multiple'      => true,
//			'field_type'    => 'select_advanced',
//			'taxonomy'      => 'profenda_product_brand',
//			'placeholder'   => 'Select Brands',
//		),
		'instant_booking_suppliers' => array(
			'name'          => 'Instant Booking: Specific Suppliers',
			'id'            => self::META_FIELDS_SLUG['instant_booking_suppliers'],
			'type'          => 'taxonomy',
			'multiple'      => true,
			'field_type'    => 'select_advanced',
			'taxonomy'      => 'profenda_product_brandDDDDDDD',
			'placeholder'   => 'Select Brands',
		),
		'minimum_notice' => array(
			'name'              => 'Minimum Notice Period',
			'id'                => self::META_FIELDS_SLUG['minimum_notice'],
			'desc'              => 'The way the booking requests are made. Email or instant booking',
			'type'              => 'radio',
			'inline'            => false,
			'options'           => array(
				'minimum_notice_in_advance'             => 'Book an appointment at least xxx(example 24hours) in advance',
				'minimum_notice_no_limit'               => 'No time limit',
				'minimum_notice_user'                   => 'Let the user define',
			),
		),
		'minimum_notice_hours' => array(
			'name'              => 'Minimum notice hours',
			'id'                => self::META_FIELDS_SLUG['minimum_notice_hours'],
			'desc'              => 'The minimum hours notice to book the department or an employee.',
			'type'              => 'number',
		),
		'meeting_repetition'            =>array(
			'name'              => 'Meeting Repetition',
			'id'                => self::META_FIELDS_SLUG['meeting_repetition'],
			'type'              => 'radio',
			'options'           => array(
				'meeting_repetition_limit'          => 'Do not let the same supplier to visit our company',
				'meeting_repetition_no_limit'       => 'No time limit',
				'meeting_repetition_users'          => 'Let the users define',
			),
			'inline'            => false,
			'select_all_none'   => true,
		),
		'meeting_repetition_time' => array(
			'name'              => 'Meeting Repetition Time Limit',
			'id'                => self::META_FIELDS_SLUG['meeting_repetition_time'],
			'type'              => 'number',
		),
		'simultaneous_meetings' => array(
			'name'              => 'Simultaneous Meetings',
			'id'                => self::META_FIELDS_SLUG['simultaneous_meetings'],
			'desc'              => 'The maximum simultaneous meetings for the same datetime.',
			'type'              => 'number',
		),
		'availability_type'            =>array(
			'name'              => 'Availability Type',
			'id'                => self::META_FIELDS_SLUG['availability_type'],
			'type'              => 'radio',
			'options'           => array(
				'every_week'          => 'Apply Every Week',
				'every_month'           => 'Apply for a Month',
			),
			'inline'            => false,
			'select_all_none'   => true,
		),

        'cancellations' => array(
            'id'   => self::META_FIELDS_SLUG['cancellations'],
            'name' => 'Cancellations',
            'type' => 'number',
        ),
		'weekdays_available' => array(
			'id'   => self::META_FIELDS_SLUG['weekdays_available'],
			'name' => 'Week days Available',
			'type' => 'text',
		),
		'mon_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['mon_time_from'],
			'name' => 'Monday time from',
			'type' => 'text',
		),
		'mon_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['mon_time_to'],
			'name' => 'Monday time to',
			'type' => 'text',
		),
		'tue_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['tue_time_from'],
			'name' => 'Tuesday time from',
			'type' => 'text',
		),
		'tue_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['tue_time_to'],
			'name' => 'Tuesday time to',
			'type' => 'text',
		),
		'wed_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['wed_time_from'],
			'name' => 'Wednesday time from',
			'type' => 'text',
		),
		'wed_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['wed_time_to'],
			'name' => 'Wednesday time to',
			'type' => 'text',
		),
		'thu_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['thu_time_from'],
			'name' => 'Thursday time from',
			'type' => 'text',
		),
		'thu_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['thu_time_to'],
			'name' => 'Thursday time to',
			'type' => 'text',
		),
		'fri_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['fri_time_from'],
			'name' => 'Friday time to',
			'type' => 'text',
		),
		'fri_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['fri_time_to'],
			'name' => 'Friday time to',
			'type' => 'text',
		),
		'sat_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['sat_time_from'],
			'name' => 'Saturday time from',
			'type' => 'text',
		),
		'sat_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['sat_time_to'],
			'name' => 'Saturday time to',
			'type' => 'text',
		),
		'sun_time_from' => array(
			'id'   => self::META_FIELDS_SLUG['sun_time_from'],
			'name' => 'Sunday time to',
			'type' => 'text',
		),
		'sun_time_to' => array(
			'id'   => self::META_FIELDS_SLUG['sun_time_to'],
			'name' => 'Sunday time to',
			'type' => 'text',
		),
		'excluded_dates' => array(
			'id'   => self::META_FIELDS_SLUG['excluded_dates'],
			'name' => 'Excluded Dates',
			'type' => 'text',
		),
        'availability_period' => array(
            'name'       => 'Availability Period',
            'id'         => self::META_FIELDS_SLUG['availability_period'],
            'type'    => 'radio',
            'options' => array(
                'year'      => 'Year',
                'month'     => 'Month',
            ),
            'inline' => true,
		),
		'availability_period_saved_date' => array(
            'name'       => 'Availability Period Saved Date - mm/dd/yy',
            'id'         => self::META_FIELDS_SLUG['availability_period_saved_date'],
            'type'       => 'text',
		),
	);



	const SETTINGS_FIELDS = array(
		self::ALL_FIELDS['company'],
		self::ALL_FIELDS['status'],
		self::ALL_FIELDS['users_visibility'],
		self::ALL_FIELDS['availability_type'],
		self::ALL_FIELDS['cancellations'],
		self::ALL_FIELDS['weekdays_available'],
		self::ALL_FIELDS['mon_time_from'],
		self::ALL_FIELDS['mon_time_to'],
		self::ALL_FIELDS['tue_time_from'],
		self::ALL_FIELDS['tue_time_to'],
		self::ALL_FIELDS['wed_time_from'],
		self::ALL_FIELDS['wed_time_to'],
		self::ALL_FIELDS['thu_time_from'],
		self::ALL_FIELDS['thu_time_to'],
		self::ALL_FIELDS['fri_time_from'],
		self::ALL_FIELDS['fri_time_to'],
		self::ALL_FIELDS['sat_time_from'],
		self::ALL_FIELDS['sat_time_to'],
		self::ALL_FIELDS['sun_time_from'],
		self::ALL_FIELDS['sun_time_to'],
		self::ALL_FIELDS['excluded_dates'],
		self::ALL_FIELDS['meeting_types'],
		self::ALL_FIELDS['meeting_types_available'],
		self::ALL_FIELDS['selected_products'],
		self::ALL_FIELDS['selected_brands'],
		self::ALL_FIELDS['instant_booking'],
		self::ALL_FIELDS['instant_booking_products'],
		self::ALL_FIELDS['instant_booking_brands'],
		self::ALL_FIELDS['instant_booking_suppliers'],
		self::ALL_FIELDS['minimum_notice'],
		self::ALL_FIELDS['minimum_notice_hours'],
		self::ALL_FIELDS['meeting_repetition'],
		self::ALL_FIELDS['meeting_repetition_time'],
		self::ALL_FIELDS['simultaneous_meetings'],
		self::ALL_FIELDS['availability_period'],
		self::ALL_FIELDS['availability_period_saved_date'],

	);

}
