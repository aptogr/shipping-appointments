<?php

namespace ShippingAppointments\Controller\Ajax;

use ShippingAppointments\Interfaces\AjaxInterface;

class AjaxController implements AjaxInterface {

    public function getJSAjaxActions(){

        $actions = array();
        foreach( self::AJAX_ACTIONS as $ajaxAction => $ajaxData ){
            $actions[ $ajaxAction ] = $ajaxAction;
        }

        return $actions;

    }


    public function getTime(){

        $platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );

//        $params = array();
//        parse_str( $_POST['data'], $params );

        $date = $_POST['date'];
        $day = strtolower(date('D', strtotime($date)));
        $fullDay = date('l', strtotime($date));

        $meeting_duration = $platformUser->meeting_duration;

        $time_from = $platformUser->availability->{$day."_time_from"};
        $time_to = $platformUser->availability->{$day."_time_to"};

        $meeting_duration_temp = $meeting_duration -1;
        $minusTime = "-".$meeting_duration_temp." minutes";
        $endTime = strtotime($minusTime, strtotime($time_to));
        $time_to_new = date('H:i', $endTime);

//        $time_to_new = strtotime($time_to) - 900;  //900 = 15 min X 60 sec


        $disableTime = array(array('00:00', $time_from),array($time_to_new,'24:00'));

        $result = array(
            'date' => $date,
            'day' => $day,
//            'time_from' => $time_from,
//            'time_to' => $time_to,
//            'time_to_new' => $time_to_new,
            'disableTime' => $disableTime,
            'fullDay' => $fullDay,
            'meetingDuration' => $meeting_duration,
            'status' => true,
            'html' => '<div class="col l4 m4 flex flex-dir-col">
                            <div class="timeFrom">
                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker shippingDayFrom" id="shippingDayFrom" name="appointment_time_from" value="10:00">
                            </div>
                                                       
                            <div class="timeTo">
                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker shippingDayTo" id="shippingDayTo" name="appointment_time_to" disabled>
                            </div>
                        </div>'
        );

        wp_send_json( $result );
        wp_die();

    }


}
