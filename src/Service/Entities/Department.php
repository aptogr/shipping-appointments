<?php

namespace ShippingAppointments\Service\Entities;

use DateTime;
use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\Taxonomy\DepartmentType;
use ShippingAppointments\Service\Entities\DepartmentType as DepartmentTypeEntity;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Service\User\UserRoles;
use ShippingAppointments\Traits\Core\PostEntity;
use ShippingAppointments\Traits\DateTimeFunctions;

class Department {

	use PostEntity;
	use DateTimeFunctions;

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
	public $status;

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
//		$this->status = boolval($this->status);

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



    public function getAllDepartmentAvailability(){

	    $allDays = array('mon','tue','wed','thu','fri','sat','sun');
	    $allAvailability = array();

	    foreach ( $allDays as $day ) {

		    $allAvailability[$day] = array();
		    $allAvailability[$day]['times'] = array();

		    $available = false;
		    foreach ( $this->users as $user ) {

			    $userObj = new PlatformUser( $user->ID );

			    $weekdays_available_toArray = explode(",", $userObj->weekdays_available);

			    if (!is_null($weekdays_available_toArray)) {

				    if( in_array( $day, $weekdays_available_toArray ) ){

					    $available = true;
					    if ((!is_null($userObj->{$day."_time_from"})) && (!is_null($userObj->{$day."_time_to"}))) {

						    $allAvailability[$day]['times'][$user->ID] = array(
							    $day. '_time_from' => $userObj->{$day."_time_from"},
							    $day. '_time_to' => $userObj->{$day."_time_to"},
							    'user'  => $userObj,
						    );

					    }

				    }
			    }

		    }

		    $weekdays_availableArray = explode(",", $this->weekdays_available);

		    if( in_array( $day, $weekdays_availableArray ) ){

			    if ((!is_null($this->{$day."_time_from"})) && (!is_null($this->{$day."_time_to"}))) {
				    $allAvailability[$day]['times']['department'] = array(
					    $day . '_time_from' => $this->{$day . "_time_from"},
					    $day . '_time_to' => $this->{$day . "_time_to"},
				    );
			    }
		    }

		    $allAvailability[$day]['available'] = $available;

	    }

	    return $allAvailability;

    }



    public function getDisabledTimeRangesArray( $timesRanges ){

	    $departmentDisabledTimeRanges = array();
	    $tempTimesRanges = array();

	    foreach ($timesRanges as $timeRange) {
		    $tempTimesRanges[] = $timeRange['from'];
		    $tempTimesRanges[] = $timeRange['to'];
	    }

	    array_unshift($tempTimesRanges,"00:00" );
	    array_push($tempTimesRanges, "24:00");


	    for ($x = 0; $x < count($tempTimesRanges); $x = $x +2) {
		    array_push($departmentDisabledTimeRanges,array($tempTimesRanges[$x],$tempTimesRanges[$x+1]));
	    }

	    return $departmentDisabledTimeRanges;

    }


    public function calculateAllPossibleTimeRanges( $availableTimes, $day ): array {

        $finalRanges = array();
        $timeAvailability = array();

        foreach( $availableTimes as $timeRange ){

            $times = $this->createTimeRange( $timeRange[$day . "_time_from"], $timeRange[$day . "_time_to"], '15 mins' );
            $timeAvailability = array_merge( $timeAvailability, $times );
        }

        asort($timeAvailability);
        $timeAvailability = array_values( array_unique( $timeAvailability ) );

        return $this->calculateAllTimeRanges( $timeAvailability );

    }




    public function calculateAllBookingPossibleTimeRanges( $availableTimes, $day, $date, $forDisplay = true ): array {

        $timeAvailability = array();

        foreach( $availableTimes as $timeRange ){

            $employee = end( $timeRange );

            if( $employee instanceof PlatformUser ){

	            $times = $employee->getAvailabilityTimeRangeByDate( $date, $forDisplay );

            }
            else {

                $timeTo = ( $forDisplay === false ? date("H:i",  strtotime( "-15 minutes", strtotime("2021-01-01 " . $timeRange[$day . "_time_to"] ) ) ) : $timeRange[$day . "_time_to"] );
	            $times = $this->createTimeRange( $timeRange[$day . "_time_from"], $timeTo, '15 mins' );

            }

            $timeAvailability = array_merge( $timeAvailability, $times );

        }

        asort($timeAvailability);
        $timeAvailability = array_values( array_unique( $timeAvailability ) );

	    return $this->calculateAllTimeRanges( $timeAvailability );

    }





    public function displayAvailabilityTable( $args ){

	    $departmentAvailability = $this->getAllDepartmentAvailability();

        if( isset( $args['weekday'] ) && !empty( $args['weekday'] ) ){

            $weekday = $args['weekday'];

            if( isset( $departmentAvailability[$weekday] ) && !empty( $departmentAvailability[$weekday] ) ){

	            $departmentAvailability = array(
		            $weekday => $departmentAvailability[$weekday]
	            );

            }
            else {
	            $departmentAvailability = array();
            }

        }

	    ?>

        <table class="full-width">

            <tr>
                <th>Day</th>
                <th>Overall Availability</th>
                <th>Employees Availability</th>
            </tr>

		    <?php
		    $i = 0;

            $weekDayNames = array(
                'mon' => 'Monday',
                'tue' => 'Tuesday',
                'wed' => 'Wednesday',
                'thu' => 'Thursday',
                'fri' => 'Friday',
                'sat' => 'Saturday',
                'sun' => 'Sunday'
            );

		    foreach ($departmentAvailability as $day => $availabilityArray ) { ?>

                <tr>
                    <td>
					    <?php echo $weekDayNames[$day]; ?>
                    </td>

                    <td>
					    <?php

					    $possibleTimeRanges =  $this->calculateAllPossibleTimeRanges( $availabilityArray['times'], $day );
					    $this->displayTimeRanges( $possibleTimeRanges );
					    ?>
                    </td>

                    <td>
                        <div class="employeeNameTimes flex flex-just-space-b" style="border-bottom: 1px solid #f0f0f0;">
                            <div class="employeeName">
                                By assignment
                            </div>
                            <div class="employeeTimes">
							    <?php echo $availabilityArray['times']['department'][$day . "_time_from"]." - ".$availabilityArray['times']['department'][$day . "_time_to"];?>
                            </div>
                        </div>
					    <?php

					    foreach ($availabilityArray['times'] as $emplId => $dayTimes) {

						    if ($emplId !== 'department') {

							    /** @var $employee PlatformUser */
							    $employee = $dayTimes['user'];

							    ?>
                                <div class="employeeNameTimes flex flex-just-space-b" style="border-bottom: 1px solid #f0f0f0;">
                                    <div class="employeeName">
									    <?php echo $employee->first_name . ' ' . $employee->last_name[0]; ?>
                                    </div>
                                    <div class="employeeTimes">
									    <?php echo $dayTimes[$day . "_time_from"]." - ".$dayTimes[$day . "_time_to"];?>
                                    </div>
                                    <?php if( isset( $args['date'] ) ): ?>

                                        <div class="employeeTimesDate">
                                            <?php

                                                $dateEmployeeAvailability = $employee->getAvailabilityTimeRangeByDate( $args['date'] );
                                                echo $employee->timeRangesToString(  $employee->calculateAllTimeRanges( $dateEmployeeAvailability )  );

                                            ?>

                                        </div>

                                    <?php endif; ?>
                                </div>

							    <?php
						    }
					    }
					    ?>
                    </td>
                </tr>

			    <?php

			    $i++;

		    }

		    ?>

        </table>

        <?php

    }


    public function displayTimeRanges( $timeRanges ){

		if( is_array( $timeRanges ) && !empty( $timeRanges ) ){

			foreach( $timeRanges as $timeRange ){

                if( $timeRange['from'] !== $timeRange['to'] ):	?>

                    <div class="time-range-item">
                        <?php echo $timeRange['from'] . ' - ' . $timeRange['to']; ?>
                    </div>

				<?php endif;

			}

		}

    }

}
