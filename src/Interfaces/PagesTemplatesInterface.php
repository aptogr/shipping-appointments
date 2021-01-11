<?php

namespace ShippingAppointments\Interfaces;

Interface PagesTemplatesInterface {

	/**
	 * Folder with the page templates
	 */
	const TEMPLATES_FOLDER  = 'templates/public/pages/';


	/**
	 * The array of templates that this plugin tracks.
	 * Set the array key as the page template file and
	 * set as value value the name of the template
	 */
	const PAGE_TEMPLATES    = array(
		'shipping-appointments-custom.php'      => 'Shipping Appointments Custom Template',
		'dashboard/dashboard.php'               => 'Profenda Dashboard',
		'dashboard/availability.php'            => 'Profenda Availability',
		'dashboard/appointments.php'            => 'Profenda Appointments',
		'dashboard/booking-settings.php'        => 'Profenda Booking Settings',
		'dashboard/personal-settings.php'       => 'Profenda Personal Settings',
	);


}
