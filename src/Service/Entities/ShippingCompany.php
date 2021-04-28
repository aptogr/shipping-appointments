<?php


namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Traits\Core\PostEntity;
use WP_Query;

class ShippingCompany {

	use PostEntity;

	public $departments;

	//Setting 1: Visibility
	public $company_users_visibility;

	//Setting 3: Meeting Type
    public $meeting_type;
    public $meeting_types_available;

	public $booking_method;
	public $booking_method_department;
	public $booking_request;
	public $booking_request_type;

    //Setting 5: Instant Booking
    public $instant_booking;
    public $products_specific_suppliers;
    public $brands_specific_suppliers;

    //Setting 6: Minimum Notice
    public $minimum_notice;
    public $book_in_advance_days;

    //Setting 7: Meeting Repetition
    public $meeting_repetition;
    public $meeting_repetition_time;


	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = ShippingCompanyPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setDepartments();

	}


	public function setDepartments(){

		$this->departments = array();

		$arr = array(
			'post_type'         => DepartmentPost::POST_TYPE_NAME,
			'posts_per_page'    => -1,
			'meta_query' => array(
				array(
					'key'     => DepartmentPost::META_FIELDS_SLUG['company'],
					'value'   => $this->ID,
					'compare' => '='
				),
			)
		);

		$query = new WP_Query($arr);

		// The Loop
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$this->departments[] = get_the_ID();
			}

		}

		// Restore original Post Data
		wp_reset_postdata();

	}


	public function getEmployees(){

		$employees = array();

		$args = array(
			'meta_query'=>
				array(
					array(
						'relation' => 'AND',
						array(
							'key' => UserFields::META_FIELDS_SLUG['shipping_company_id'],
							'value' => $this->ID,
							'compare' => "=",
							'type' => 'numeric'
						)
					)
				)
		);

		$users = get_users( $args );

		foreach( $users as $user ){

			$platformUser = new PlatformUser( $user->ID );

			$employees[] = $platformUser;

		}

		return $employees;

	}


    /**
     * @param $type DepartmentType
     *
     * @return Department | bool
     */
    public function getDepartmentByType( DepartmentType $type ){

        foreach( $this->departments as $departmentID ){

            $department = new Department( $departmentID );

            if( $department->departmentType->ID === $type->ID ){

                return $department;

            }

        }

        return false;

    }


}
