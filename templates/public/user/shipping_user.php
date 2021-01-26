<?php
get_header();


$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );



echo "<pre>";
print_r($platformUser->availability->postMeta);
print_r($platformUser);
echo "</pre>";

//echo $platformUser->availability->excluded_dates;


function weekdaysDisalable($weekDays) {

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

?>

<div class="container row">
    <form action="">

        <div class="col m6 l6">
            <div
                    class="calendar col l6 m6"
                    data-disabledates="<?php echo $platformUser->availability->excluded_dates;?>"
                    data-disabledweekdays="<?php weekdaysDisalable($platformUser->availability->weekdays_available);?>"
                    data-scheduledates="null/2001-01-01"
            ></div>
        </div>

        <div class="col m6 l6">
            <div id="selectedShippingDates">
                <input type="hidden" id='shippingDay' name='shippingDay' value=''>

                <div class="col l4 m4 flex flex-dir-col">
                    <div class="dayDisplay">
                        <?php echo date("Y-m-d");?>
                    </div>
                    <div class="timeFrom">
                        <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="shippingDayFrom" name="shippingDayFrom" value="06:00" data-disTime="08:00,10:00|">
                    </div>

                    <div class="timeTo">
                        <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="shippingDayTo" name="shippingDayTo" value="23:00">
                    </div>

                </div>
 
            </div>
        </div>

        <div class="col l12 m12">
            <button type="submit" class="saveAvailability save-button" name="refresh_action" value="create_appointment">CREATE APPOINTMENT</button>
        </div>

    </form>
</div>

<?php
get_footer();
