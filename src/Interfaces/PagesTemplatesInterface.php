<?php

namespace ShippingAppointments\Interfaces;

Interface PagesTemplatesInterface {

	/**
	 * Folder with the page templates
	 */
	const TEMPLATES_FOLDER  = 'templates/public/pages/';

    const SUPPORTED_ENDPOINTS = array(
        'department',
        'company',
        'req',
        'invitation',
    );

	/**
	 * The array of templates that this plugin tracks.
	 * Set the array key as the page template file and
	 * set as value value the name of the template
	 */
	const PAGE_TEMPLATES    = array(
		'front/homepage.php'                                            => 'Profenda Homepage',
		'dashboard/dashboard.php'                                       => 'Profenda Dashboard',
		'dashboard/availability.php'                                    => 'Profenda Availability',
        'dashboard/appointments/appointments.php'                       => 'Profenda / Appointments',
        'dashboard/appointments/company-appointments.php'               => 'Profenda / Appointments / Company',
        'dashboard/appointments/department-appointments.php'            => 'Profenda / Appointments / Department',
		'dashboard/booking/booking-settings.php'                        => 'Profenda Booking Settings',
		'dashboard/settings/personal-settings.php'                      => 'Profenda Personal Settings',
		'dashboard/find/find.php'                                       => 'Profenda Find Companies',
		'dashboard/find/shipping-companies.php'                         => 'Profenda Find Shipping Companies',
		'dashboard/find/supplier-companies.php'                         => 'Profenda Find Suppliers',
		'dashboard/manage/edit-shipping-company-department.php'         => 'Profenda / Manage / Edit Department',
		'dashboard/manage/edit-shipping-company.php'                    => 'Profenda / Manage / Edit Shipping Company',
		'dashboard/book/appointment.php'                                => 'Profenda / Book / Appointment',
		'dashboard/book/success.php'                                    => 'Profenda / Book / Success',


		//=============================================================================================
		// Authentication Pages
		//=============================================================================================

		'auth/register.php'                               => 'Profenda Auth / Register',
		'auth/register/register-shipping.php'             => 'Profenda Auth / Register / Shipping',
		'auth/register/register-shipping-company.php'     => 'Profenda Auth / Register / Shipping / Company',
		'auth/register/register-shipping-employee.php'    => 'Profenda Auth / Register / Shipping / Employee',
		'auth/register/register-supplier.php'             => 'Profenda Auth / Register / Supplier',
		'auth/register/register-supplier-company.php'     => 'Profenda Auth / Register / Supplier / Company',
		'auth/register/register-supplier-employee.php'    => 'Profenda Auth / Register / Supplier / Employee',
		'auth/login.php'                                  => 'Profenda Auth / Login',
		'auth/password-lost.php'                          => 'Profenda Auth / Password Lost',
		'auth/password-reset.php'                         => 'Profenda Auth / Password Reset',

	);



}
