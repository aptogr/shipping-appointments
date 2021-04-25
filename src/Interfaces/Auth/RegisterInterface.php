<?php

namespace ShippingAppointments\Interfaces\Auth;

Interface RegisterInterface {

	const DEFAULT_USER_FIELDS = array(
		'user_login'    => array(
			'field_name'    => 'user_login',
			'type'          => 'text',
			'label'         => 'User Login',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_STRING',
			'required'      => true,
			'display'       => false,
		),
		'first_name'=> array(
			'field_name'    => 'first_name',
			'type'          => 'text',
			'label'         => 'First Name',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_STRING',
			'required'      => true,
			'display'       => true,
		),
		'last_name'=> array(
			'field_name'    => 'last_name',
			'type'          => 'text',
			'label'         => 'Last Name',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_STRING',
			'required'      => true,
			'display'       => true,
		),
		'user_email' => array(
			'field_name'    => 'user_email',
			'type'          => 'email',
			'label'         => 'Email',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_EMAIL',
			'required'      => true,
			'display'       => true,
		),
		'user_pass'=> array(
			'field_name'    => 'user_pass',
			'type'          => 'password',
			'label'         => 'Password',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_STRING',
			'required'      => true,
			'display'       => true,
		),
		'repeat_password'=> array(
			'field_name'    => 'repeat_password',
			'type'          => 'password',
			'label'         => 'Confirm Password',
			'placeholder'   => '',
			'sanitize'      => 'FILTER_SANITIZE_STRING',
			'required'      => true,
			'display'       => true,
		),
	);

}
