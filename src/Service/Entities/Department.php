<?php

namespace ShippingAppointments\Service\Entities;

use DateTime;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\Taxonomy\DepartmentType;
use ShippingAppointments\Service\Entities\DepartmentType as DepartmentTypeEntity;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Service\User\UserRoles;
use ShippingAppointments\Traits\Core\PostEntity;

class Department {

	use PostEntity;

	public $users;

	public $company;

	/**
	 * @var $companyObject ShippingCompany
	 */
	public $companyObject;

	/**
	 * @var $departmentType DepartmentTypeEntity
	 */
	public $departmentType;

	//Setting 1
	public $users_visibility;

	//Setting 2
    public $availability_type;
    public $weekdays_available;
    public $mon_time_from;
    public $mon_time_to;
    public $tue_time_from;
    public $tue_time_to;
    public $wed_time_from;
    public $wed_time_to;
    public $thu_time_from;
    public $thu_time_to;
    public $fri_time_from;
    public $fri_time_to;
    public $sat_time_from;
    public $sat_time_to;
    public $sun_time_from;
    public $sun_time_to;
	public $excluded_dates;

	//Setting 3
	public $meeting_types;
	public $meeting_types_available;

	//Setting 4
	public $selected_products;
	public $selected_brands;

	//Setting 5
	public $instant_booking;
	public $instant_booking_products;
	public $instant_booking_brands;
	public $instant_booking_suppliers;

	//Setting 6
	public $minimum_notice;
	public $minimum_notice_hours;

	//Setting 7
	public $meeting_repetition;
	public $meeting_repetition_time;

	//Setting 8
	public $simultaneous_meetings;


	public $availability_period;
	public $availability_period_saved_date;


	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = DepartmentPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();

		$this->setDepartmentType();
		$this->setDepartmentUsers();

		$this->companyObject = new ShippingCompany( $this->company );

	}


	private function setDepartmentType(){

		$departmentType         = get_the_terms( $this->ID, DepartmentType::TAXONOMY_SLUG );
		$this->departmentType   = new DepartmentTypeEntity( is_array( $departmentType ) ? $departmentType[0]->term_id : false );

	}


	private function setDepartmentUsers(){

		$this->users = get_users(array(
			'role'          => 'shipping_company_employee',
			'meta_key'      => UserFields::META_FIELDS_SLUG['shipping_company_department_id'],
			'meta_value'    => $this->ID
		));

	}

	public function isAllUsersVisible(): bool {

		return $this->users_visibility === 'department_users_visibile';

	}

	public function isAllUsersInvisible(): bool {

		return $this->users_visibility === 'department_users_invisibile';

	}

    public function weekdaysDisalable($weekDays) {

        echo $this->getWeekdaysDisable($weekDays);
    }

    public function getWeekdaysDisable($weekDays) {


        $weekDaysReturnArray = array();

        if (!stristr($weekDays, "mon")) {
            array_push($weekDaysReturnArray, "1");
        }
        if (!stristr($weekDays, "tue")) {
            array_push($weekDaysReturnArray, "2");
        }
        if (!stristr($weekDays, "wed")) {
            array_push($weekDaysReturnArray, "3");
        }
        if (!stristr($weekDays, "thu")) {
            array_push($weekDaysReturnArray, "4");
        }
        if (!stristr($weekDays, "fri")) {
            array_push($weekDaysReturnArray, "5");
        }
        if (!stristr($weekDays, "sat")) {
            array_push($weekDaysReturnArray, "6");
        }
        if (!stristr($weekDays, "sun")) {
            array_push($weekDaysReturnArray, "0");
        }

        return implode(",", $weekDaysReturnArray);

    }


    public function createTimeRange($start, $end, $interval = '30 mins') {
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $returnTimeFormat = 'H:i';

        $current = time();
        $addTime = strtotime('+'.$interval, $current);
        $diff = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }

    public function calculateAllPossibleTimeRanges( $availableTimes, $day ){

        $finalRanges = array();
        $timeAvailability = array();

        foreach( $availableTimes as $timeRange ){

            $times = $this->createTimeRange( $timeRange[$day . "_time_from"], $timeRange[$day . "_time_to"], '15 mins' );
            $timeAvailability = array_merge( $timeAvailability, $times );
        }

        asort($timeAvailability);
        $timeAvailability = array_values( array_unique( $timeAvailability ) );


        $startRangeTime = $timeAvailability[0];

        for ( $x = 1; $x <= count( $timeAvailability ); $x++) {

            if( isset( $timeAvailability[$x] ) ){

                $start_date = new DateTime( $timeAvailability[$x] );
                $since_start = $start_date->diff(new DateTime( $timeAvailability[$x - 1] ) );

                $totalMinDiff = $since_start->h * 60 + $since_start->i;

                if( $totalMinDiff !== 15 ){

                    $finalRanges[] = array(
                        'from' => $startRangeTime,
                        'to' => $timeAvailability[$x-1]
                    );

                    $startRangeTime = $timeAvailability[$x];

                }

            }

        }

        $finalRanges[] = array(
            'from' => $startRangeTime,
            'to' => $timeAvailability[count($timeAvailability)-1]
        );

        return $finalRanges;

    }


}
