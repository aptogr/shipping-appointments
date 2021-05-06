<?php

namespace ShippingAppointments\Controller\Ajax;

use ShippingAppointments\Interfaces\AjaxInterface;
use ShippingAppointments\Service\Dashboard\Booking\DashboardBooking;
use ShippingAppointments\Service\Entities\User\PlatformUser;

class AjaxController implements AjaxInterface {

    public function getJSAjaxActions(){

        $actions = array();
        foreach( self::AJAX_ACTIONS as $ajaxAction => $ajaxData ){
            $actions[ $ajaxAction ] = $ajaxAction;
        }

        return $actions;

    }

    public function getProducts(){

        $resultArray = array();
        $arrayList = array();
        $htmlList = array();

        array_push($htmlList, '<ul>');


        $allProducts = get_terms([
            'taxonomy' => 'profenda_product_type',
            'hide_empty' => false,
        ]);

        $q = $_POST['q'];

        foreach( $allProducts as $key => $product ){
            if (strpos($product->name, $q) !== false) {
                array_push($arrayList, $product);
                array_push($htmlList, '<li data-id="'.$product->term_id.'">'.$product->name.'</li>');
            }
        }
        array_push($htmlList, '</ul>');

        $htmlList = implode("", $htmlList);

        $resultArray['arrayList'] = $arrayList;
        $resultArray['htmlList'] = $htmlList;

        wp_send_json( $resultArray );
        wp_die();

    }

    public function getBrands(){

        $resultArray = array();
        $arrayList = array();
        $htmlList = array();

        array_push($htmlList, '<ul>');


        $allProducts = get_terms([
            'taxonomy' => 'profenda_product_brand',
            'hide_empty' => false,
        ]);

        $q = $_POST['q'];

        foreach( $allProducts as $key => $product ){
            if (strpos($product->name, $q) !== false) {
                array_push($arrayList, $product);
                array_push($htmlList, '<li data-id="'.$product->term_id.'">'.$product->name.'</li>');
            }
        }
        array_push($htmlList, '</ul>');

        $htmlList = implode("", $htmlList);

        $resultArray['arrayList'] = $arrayList;
        $resultArray['htmlList'] = $htmlList;

        wp_send_json( $resultArray );
        wp_die();

    }

    public function getTime(){

        $date = $_POST['date'];
        $da_post_author = $_POST['da_post_author'];

        $platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( $da_post_author );
//        $platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );

//        $params = array();
//        parse_str( $_POST['data'], $params );


        $day = strtolower(date('D', strtotime($date)));
        $fullDay = date('l', strtotime($date));

        $max_meetings_per_day   = $platformUser->max_meetings_per_day;
        $meeting_duration       = $platformUser->meeting_duration;

        $time_from  = $platformUser->availability->{$day."_time_from"};
        $time_to    = $platformUser->availability->{$day."_time_to"};

        $meeting_duration_temp = $meeting_duration -1;
        $minusTime = "-".$meeting_duration_temp." minutes";
        $endTime = strtotime($minusTime, strtotime($time_to));
        $time_to_new = date('H:i', $endTime);

        $disableTime = array(array('00:00', $time_from),array($time_to_new,'24:00'));

        $appointmentArgs = array(
            'author'        => $da_post_author,
            'post_type'     => 'user_appointments',
            'meta_query'    => array(
                array(
                    'key'       => 'user_appointments_date',
                    'value'     => $date,
                )
            ),
        );

        $appointmentz = get_posts( $appointmentArgs );

        $appointmentzCount = count($appointmentz);

        foreach ( $appointmentz as $key => $appointment ) {
            $user_appointments_from_time    = get_post_meta( $appointment->ID, 'user_appointments_from_time', true );
            $user_appointments_to_time      = get_post_meta( $appointment->ID, 'user_appointments_to_time', true );
            array_push($disableTime, array($user_appointments_from_time,$user_appointments_to_time));
        }

        if ($max_meetings_per_day >= $appointmentzCount) {

            $result = array(
                'booking_request_type'  => $platformUser->booking_request_type,
                'booking_method'        => $platformUser->booking_method,
                'date'                  => $date,
                'day'                   => $day,
                'disableTime'           => $disableTime,
                'fullDay'               => $fullDay,
                'meetingDuration'       => $meeting_duration,
                'status'                => true,
                'appointmentLimit'      => true,
                'appointmentz'          => $appointmentz,
                'html'                  => '<div class="col l4 m4 flex flex-dir-col no-padding margin-top-20">
                                <div class="timeFrom">
                                    <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker shippingDayFrom" id="shippingDayFrom" name="from_time" value="10:00">
                                </div>
                                                           
                                <div class="timeTo">
                                    <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker shippingDayTo" id="shippingDayTo" name="to_time">
                                </div>
                            </div>'
            );

        } else {

            $result = array(
                'date'              => $date,
                'day'               => $day,
                'fullDay'           => $fullDay,
                'appointmentLimit'  => false,
                'status'            => true,
            );

        }



        wp_send_json( $result );
        wp_die();

    }

    public function bookGetEmployeesField(){

	    $params = array();
	    parse_str( $_POST['data'], $params );

	    $result = array(
	        'data'  => 	$params
	    );

	    $dashboardBooking = new DashboardBooking( $params['company'], $params );
	    $result['employeeStep'] = $dashboardBooking->getEmployeesField();
	    $result['dateStep'] = $dashboardBooking->getDateField();
	    $result['timeStep'] = $dashboardBooking->getTimeField();
	    $result['meetingTypeStep'] = $dashboardBooking->getMeetingTypeField();

	    wp_send_json( $result );
	    wp_die();


    }

    public function bookGetEmployeeAvailability(){

    	$platformUser =  new PlatformUser( intval( $_POST['user_id'] ) );

    	$result = array(
    		'html'  => $platformUser->getAvailabilityTable()
	    );

	    wp_send_json( $result );
	    wp_die();

    }

}
