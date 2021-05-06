<?php


namespace ShippingAppointments\Service\Entities\User;

use ShippingAppointments\Interfaces\PlatformUserInterface;
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

class PlatformUser extends WP_User implements PlatformUserInterface{

	public $location;
	public $timezone;
	public $shipping_company_id;
	public $shipping_company_department_id;
	public $supplier_company_id;
	public $availability_id;
	public $meeting_duration;
	public $meeting_buffer;
	public $max_meetings_per_day;
    public $minimum_notice;
	public $book_in_advance_days;
	public $booking_request_type;
	public $meeting_repetition;
	public $meet_same_supplier_times;
	public $cancellation_policy;
	public $booking_method;
    public $selected_products;
    public $selected_brands;
    public $visible;
    public $availability_period;
    public $availability_period_saved_date;
    public $instant_booking;
    public $instant_booking_products;
    public $instant_booking_brands;

    // Avail
    public $weekdays_available;
    public $excluded_dates;
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
    public $weekdays_available_toArray;
    public $excluded_dates_toArray;


	/**
	 * @var $availability Availability
	 */
	public $availability;


	/**
	 * @var $shippingCompany ShippingCompany
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
//		$this->setAppointments();


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

	public function getWeekdaysToArray(){

        if (isset($this->weekdays_available)) {
            return explode(",", $this->weekdays_available);
        }
        else {
            return array();
        }

    }

	public function getExcludedDatesToArray(){

        if (isset($this->excluded_dates)) {

            return explode(",", $this->excluded_dates);
        }
        else {
            return array();
        }

    }

	public function isWebsiteAdmin(): bool {

		return in_array( 'administrator', $this->roles, true );

	}

	public function isShippingCompanyAdmin(): bool {

		return in_array( 'shipping_company_admin', $this->roles, true );

	}

	public function isDepartmentAdmin(): bool {

		return in_array( 'shipping_company_department_admin', $this->roles, true );

	}

	public function isShippingCompanyEmployee(): bool {

		return in_array( 'shipping_company_employee', $this->roles, true );

	}

	public function isSupplierCompanyAdmin(): bool {

		return in_array( 'supplier_company_admin', $this->roles, true );

	}

	public function isSupplierCompanyEmployee(): bool {

		return in_array( 'supplier_company_employee', $this->roles, true );

	}


	public function isVisible(): bool {

		if( $this->isWebsiteAdmin() || $this->isShippingCompanyAdmin() || $this->isDepartmentAdmin() ||  $this->isShippingCompanyEmployee() ){

			if( $this->shippingCompany->isAllUsersVisible() ){
				return true;
			}
			else if( $this->shippingCompany->isAllUsersInvisible() ){
				return false;
			}
			else {

				if( $this->department->isAllUsersVisible() ){
					return true;
				}
				else if ( $this->department->isAllUsersInvisible() ){
					return false;
				}
				else {
					return $this->visible === 'user_visibile';
				}

			}

		}
		else {
			return true;
		}

	}

	/**
	 * @return bool
	 */
	public function canEditVisibility() {

		if( $this->shippingCompany->company_users_visibility !== 'company_users_department'){
			return false;
		}
		elseif( $this->department->users_visibility !== 'department_users_department' ){
			return false;
		}
		else {
			return true;
		}

    }



	public function canEditAvailability() {

    }

	public function canEditMeetingType() {

		if( $this->shippingCompany->meeting_type !== 'department'){
			return false;
		}
		elseif( $this->department->meeting_types !== 'user' ){
			return false;
		}
		else {
			return true;
		}

    }

	public function canEditInstantBooking() {

		if( $this->shippingCompany->instant_booking !== 'department'){
			return false;
		}
		elseif( $this->department->instant_booking !== 'user' ){
			return false;
		}
		else {
			return true;
		}

    }

	public function canEditMinimumNotice() {

		if( $this->shippingCompany->minimum_notice !== 'minimum_notice_department'){
			return false;
		}
		elseif( $this->department->minimum_notice !== 'minimum_notice_user' ){
			return false;
		}
		else {
			return true;
		}

    }

	public function canEditMeetingRepetition() {

		if( $this->shippingCompany->meeting_repetition !== 'meeting_repetition_department'){
			return false;
		}
		elseif( $this->department->meeting_repetition !== 'meeting_repetition_users' ){
			return false;
		}
		else {
			return true;
		}

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

    public function getBookingMethods($booking_methods){

        $booking_methodTotal = count($booking_methods);
        $booking_methodCount = 1;

        foreach ($booking_methods as $booking_method) {

            echo ucfirst(str_replace("_"," ",$booking_method));

            if ($booking_methodCount < $booking_methodTotal) {
                echo ", ";
            }

            $booking_methodCount++;
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

	public function weekdaysDisalable($weekDays) {

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

        $weekDaysReturn = implode(",", $weekDaysReturnArray);
        echo $weekDaysReturn;
    }

    /**
     * @param $weekDays
     * @param $day
     * @param $time
     * @return string
     */
    public function dayActive($weekDays, $day, $time) {
// ( condition ? true : false)

        return (!stristr($weekDays, $day)? '-' : $time);

    }

	public function getFullName(): string {

    	return $this->first_name . ' ' . $this->last_name;

	}


	public function getAvailabilityTable(){

    	ob_start();

    	?>

		<table>
			<tr>
				<th></th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
				<th>Sunday</th>
			</tr>
			<tr>
				<td>From</td>
				<?php foreach ( self::ALL_DAYS as $day) { ?>
					<td><?php echo $this->dayActive($this->weekdays_available,$day,$this->{$day.'_time_from'}); ?></td>
				<?php } ?>
			</tr>
			<tr>
				<td>To</td>
				<?php foreach (self::ALL_DAYS as $day) { ?>
					<td><?php echo $this->dayActive($this->weekdays_available,$day,$this->{$day.'_time_to'}); ?></td>
				<?php } ?>
			</tr>
		</table>

		<?php

    	return ob_get_clean();

	}

}
