<?php
get_header();

global $post;
$department = new \ShippingAppointments\Service\Entities\Department($post->ID);


//echo "<pre>";
//var_dump($department);
//echo "</pre>";

$shippingCompanyId =  $department->postMeta['shipping_department_company'][0];

$args = array(
    'meta_query' => array(
        'key'     => 'shipping_company_id',
        'value'   => $shippingCompanyId,
    )
);


$users = get_users( $args );


$allDays = array('mon','tue','wed','thu','fri','sat','sun');
$allDaysFull = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

$allAvailability = array();


foreach ( $allDays as $day ) {


    $allAvailability[$day] = array();
    $allAvailability[$day]['times'] = array();
    $allAvailability[$day]['employees'] = array();

    $available = false;
    foreach ( $users as $user ) {

        $userObj = new \ShippingAppointments\Service\Entities\User\PlatformUser( $user->ID );


//        echo "<pre>";
//        print_r($userObj);
//        echo "</pre>";

        if (!is_null($userObj->availability->weekdays_available_toArray)) {
            if( in_array( $day, $userObj->availability->weekdays_available_toArray ) ){
                $available = true;

                if ((!is_null($userObj->availability->{$day."_time_from"})) && (!is_null($userObj->availability->{$day."_time_to"}))) {

                    $allAvailability[$day]['times'][$user->ID] = array(
                        $day. '_time_from' => $userObj->availability->{$day."_time_from"},
                        $day. '_time_to' => $userObj->availability->{$day."_time_to"},
                    );

                }

            }
        }




//        array_push($allAvailability[$day]['employees'],$userObj);


    }


//        echo "<pre>";
//        print_r($department);
//        echo "</pre>";

    $weekdays_availableArray = $pieces = explode(",", $department->weekdays_available);

    if( in_array( $day, $weekdays_availableArray ) ){
        // echo "ok!<br>";
        if ((!is_null($department->{$day."_time_from"})) && (!is_null($department->{$day."_time_to"}))) {
            $allAvailability[$day]['times']['department'] = array(
                $day . '_time_from' => $department->{$day . "_time_from"},
                $day . '_time_to' => $department->{$day . "_time_to"},
            );
        }
    }




    $allAvailability[$day]['available'] = $available;

}

//echo "<pre>";
//var_dump($allAvailability['sun']['times']);
//echo "</pre>";


function createTimeRange($start, $end, $interval = '30 mins') {
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

function calculateAllPossibleTimeRanges( $availableTimes, $day ){

    $finalRanges = array();
    $timeAvailability = array();

    foreach( $availableTimes as $timeRange ){

        $times = createTimeRange( $timeRange[$day . "_time_from"], $timeRange[$day . "_time_to"], '15 mins' );
        $timeAvailability = array_merge( $timeAvailability, $times );
    }

    asort($timeAvailability);
    $timeAvailability = array_values( array_unique( $timeAvailability ) );

//    echo "<pre>";
//    var_dump($timeAvailability);
//    echo "</pre>";

    $startRangeTime = $timeAvailability[0];

    for ( $x = 1; $x <= count( $timeAvailability ); $x++) {

        $start_date = new DateTime( $timeAvailability[$x] );
        $since_start = $start_date->diff(new DateTime( $timeAvailability[$x - 1] ) );

        if( $since_start->i !== 15 ){

            $finalRanges[] = array(
                'from' => $startRangeTime,
                'to' => $timeAvailability[$x-1]
            );

            $startRangeTime = $timeAvailability[$x];


        }

    }

    return $finalRanges;

}


//$finalRanges = calculateAllPossibleTimeRanges( $availableTimes );

//print("<pre>".print_r( $finalRanges,true)."</pre>");



?>

    <div class="row shipping-company-department full-width">

        <section class="col m6 l6 s12">

            <table class="full-width">

                <tr>
                    <th></th>
                    <th>Available Time Ranges</th>
                    <th>Employees Time Ranges</th>
                </tr>

                <?php
                $i = 0;
                foreach ($allAvailability as $key => $day) {

//                        echo "<pre>";
//                        var_dump($day['times']['department']);
//                        echo "</pre>";

                    ?>

                    <tr>

                        <td>
                            <?php echo $allDaysFull[$i]?>
                        </td>

                        <td>


                            <?php
                            $timesRanges = calculateAllPossibleTimeRanges($day['times'],$key);

//                            echo "<pre>";
//                            var_dump($timesRanges);
//                            echo "</pre>";


                            $testor = '';

                            foreach ($timesRanges as $timesRangeSingle) {

                                $testor .= implode(",", $timesRangeSingle);
                                $testor .= ',';

                                echo "<div>";
                                foreach ($timesRangeSingle as $timesRangeSingleOneKey => $timesRangeSingleOne) {
                                    echo $timesRangeSingleOne;
                                    if ($timesRangeSingleOneKey == 'from') {
                                        echo "-";
                                    }
                                }
                                echo "</div>";
                            }

                            $testor = substr($testor, 0, -1);

                            ?>
                            <input id="<?php echo $key."TimeRange"; ?>" type="hidden" value="<?php echo $testor;?>">
                        </td>

                        <td>
                            <div class="employeeNameTimes flex flex-just-space-b" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="employeeName">
                                    By assignment
                                </div>
                                <div class="employeeTimes">

                                    <?php echo $day['times']['department']{$key . "_time_from"}." - ".$day['times']['department']{$key . "_time_to"};?>
                                </div>
                            </div>
                            <?php

                                foreach ($day['times'] as $emplId => $dayTimes) {
                                    if ($emplId != 'department') {

                                        $employee = new \ShippingAppointments\Service\Entities\User\PlatformUser( $emplId );

                                        ?>
                                            <div class="employeeNameTimes flex flex-just-space-b" style="border-bottom: 1px solid #f0f0f0;">
                                                <div class="employeeName">
                                                    <?php echo $employee->availability->author->first_name. ' ' . $employee->availability->author->last_name[0];?>.
                                                </div>
                                                <div class="employeeTimes">
                                                    <?php echo $dayTimes{$key . "_time_from"}." - ".$dayTimes{$key . "_time_to"};?>
                                                </div>
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

        </section>

        <section>

            <div
                    class="calendar departmentBook col l6 m6"
                    data-disabledates="2021-01-04"
                    data-disabledweekdays=""
                    data-bookinadvance=""
                    data-scheduledates="null/2001-01-01"
            ></div>

            <div>


                <div>

                    <div>
                        From
                    </div>

                    <div>
                        <input type="text" class="" id="departmentBookTimeFrom" name="from_time" value="09:00">
                    </div>

                </div>

                <div>

                    <div>
                        To
                    </div>

                    <div>
                        <input type="text" class="" id="departmentBookTimeTo" name="from_time" value="10:00">
                    </div>

                </div>


            </div>

        </section>

    </div>

<?php
get_footer();
