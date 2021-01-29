<?php


namespace ShippingAppointments\Service\Entities\User;

use ShippingAppointments\Service\Entities\Appointment;
use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\SupplierCompany;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Service\Taxonomy\CountryTaxonomy;
use ShippingAppointments\Service\User\UserFields;
use WP_Query;
use WP_User;
use ShippingAppointments\Service\Entities\Availability;

class PlatformUser extends WP_User  {

	public $location;
	public $timezone;
	public $shipping_company_id;
	public $shipping_company_department_id;
	public $supplier_company_id;
	public $availability_id;
	public $meeting_duration;
	public $meeting_buffer;
	public $max_meetings_per_day;
	public $book_in_advance_days;
	public $booking_request_type;
	public $meet_same_supplier_times;
	public $cancellation_policy;


	/**
	 * @var $availability Availability
	 */
	public $availability;


	/**
	 * @var $availability ShippingCompany
	 */
	public $shippingCompany;


	/**
	 * @var $department Department
	 */
	public $department;


	/**
	 * @var $supplierCompany SupplierCompany
	 */
	public $supplierCompany;

	/**
	 * @var $appointments array
	 */
	public $appointments;


	/**
	 * Construct the class
	 *
	 * @param int $id
	 * @param string $name
	 * @param string $site_id
	 */
	public function __construct( $id = 0, $name = '', $site_id = '' ) {
		parent::__construct( $id, $name, $site_id );

		$this->setProperties();
		$this->setPropertiesObjects();
		$this->setAppointments();


	}


	public function setProperties(){

		$metaSlugs = UserFields::META_FIELDS_SLUG;

		foreach ( $metaSlugs as $property => $metaKey ){

			if( property_exists( $this, $property ) ){

				$value = rwmb_meta( $metaKey, array( 'object_type' => 'user' ), $this->ID );

				if ( @unserialize( $value ) !== false ){

					$this->$property = unserialize( $value );

				}
				else {

					$this->$property = $value;

				}

			}

		}

	}


	public function setPropertiesObjects(){

		$this->availability         = ( !empty( $this->availability_id ) ? new Availability( $this->availability_id )  : false );
		$this->shippingCompany      = ( !empty( $this->shipping_company_id ) ? new ShippingCompany( $this->shipping_company_id ) : false );
		$this->department           = ( !empty( $this->shipping_company_department_id ) ? new Department( $this->shipping_company_department_id ) : false );
		$this->supplierCompany      = ( !empty( $this->supplier_company_id ) ? new SupplierCompany( $this->supplier_company_id )  : false );

	}


	public function setAppointments(){

		$this->appointments = array();

		$args = array(
			'post_type'         => AppointmentPost::POST_TYPE_NAME,
			'posts_per_page'    => -1,
			'author'            => $this->ID
		);

		$query = new WP_Query( $args );

		if( $query->have_posts() ){

			while ( $query->have_posts() ) {
				$query->the_post();
				$this->appointments[] = new Appointment( get_the_ID() );
			}

			wp_reset_query();

		}

	}

	public function getCountryDisplayName(){

		if( !empty( $this->location ) ){

			$countries = CountryTaxonomy::COUNTRIES_ARRAY;

			return ( isset( $countries[$this->location] ) ? ucfirst( strtolower($countries[$this->location])) : '');


		}
		else {
			return '';
		}

	}


	public function getTimezoneDisplayName(){


		if( !empty( $this->timezone ) ){

			$timeZones = UserFields::TIME_ZONES;

			return ( isset( $timeZones[$this->timezone] ) ? $timeZones[$this->timezone] : '');


		}
		else {
			return '';
		}

	}

}
