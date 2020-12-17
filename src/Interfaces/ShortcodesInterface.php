<?php

namespace ShippingAppointments\Interfaces;

Interface ShortcodesInterface {

	/**
	 * Returns the name of the shortcode that will be registered
	 * @return string
	 */
    public function getShortcodeName();

	/**
	 * The function responsible for displaying the shortcode
	 * @return string
	 */
	public function display();

}
