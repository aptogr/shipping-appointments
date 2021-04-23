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
        'dashboard/appointments/my-appointments.php'                    => 'Profenda / My Appointments',
        'dashboard/appointments/company-appointments.php'               => 'Profenda / Company Appointments',
		'dashboard/booking/booking-settings.php'                        => 'Profenda Booking Settings',
		'dashboard/settings/personal-settings.php'                      => 'Profenda Personal Settings',
		'dashboard/find/find.php'                                       => 'Profenda Find Companies',
		'dashboard/find/shipping-companies.php'                         => 'Profenda Find Shipping Companies',
		'dashboard/find/supplier-companies.php'                         => 'Profenda Find Suppliers',
		'dashboard/manage/edit-shipping-company-department.php'         => 'Profenda / Manage / Edit Department',
		'dashboard/manage/edit-shipping-company.php'                    => 'Profenda / Manage / Edit Shipping Company',
	);



}
