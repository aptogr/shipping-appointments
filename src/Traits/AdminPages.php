<?php


namespace ShippingAppointments\Traits;

Trait AdminPages {

	protected $pages;

	public function setAdminPages(){

		$this->pages = array(
			'shipping-appointments' => array(
				'page_title'    => 'Shipping Appointments',
				'menu_title'    => 'Shipping Appointments',
				'capability'    => 'manage_options',
				'icon_url'      => 'dashicons-migrate',
				'position'      => 10,
				'subpages'      => array(
					'shipping-appointments-sub' => array(
						'page_title'    => 'Shipping Appointments SubPage',
						'menu_title'    => 'Shipping Appointments SubPage',
						'capability'    => 'manage_options',
					)
				)
			),
		);

	}


	public function getAdminPages(){

		return $this->pages;

	}

}
