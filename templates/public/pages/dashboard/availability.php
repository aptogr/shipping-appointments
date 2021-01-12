<?php
    get_header();

    $platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );


//    echo "<pre>";
//    print_r($platformUser->availability);
//    echo "</pre>";


    if (isset($platformUser->availability->postMeta['user_availability_excluded_dates'][0])) {
        $excluded_dates = explode(",", $platformUser->availability->postMeta['user_availability_excluded_dates'][0]);
    }

    if (isset($platformUser->availability->postMeta['user_availability_weekdays_available'][0])) {
        $availability_weekdays = explode(",", $platformUser->availability->postMeta['user_availability_weekdays_available'][0]);
    }

    function excluded_dates_display($excluded_dates) {
        if (!empty($excluded_dates[0])) {
            foreach ($excluded_dates as $value) {
                echo "<div class='exludeDaysBox' data-selecteddate='".$value."'>".$value." <div class='selectedDateDelete' data-selecteddate='".$value."' >x</div></div>";
            }
        }
    }


    function checkIfNull($day, $type) {
        if (empty($day)) {
            if ($type == 'from') {
                echo '6:00';
            } else {
                echo '23:00';
            }
        } else {
            echo $day;
        }
    }

    function displayDay($day, $availability_weekdays,$type) {
        if (in_array($day,$availability_weekdays)) {
            if ($type == 'div') {
                echo "display-block";
            } elseif ($type == 'input') {
                echo "checked";
            }

        }
    }

?>

    <main>
        <div class="row availability">

            <form action="" method="post">

                <div class="col l9 m9">

                    <div class="main-calendar">

                        <section class="main-section full-width">

                            <h1>Availability</h1>
                            <p>Set up your availability in order to allow suppliers book an appointment with you.</p>

                        </section>


                        <section class="main-section full-width">

                            <div class="full-width">
                                <h2>Which days of the week are you available?</h2>
                                <p>Suppliers will be able to book an appointment only on the days of the week you will set.</p>
                            </div>

                            <div class="full-width flex margin-top-20 margin-bottom-20">

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayMonday" class="weekDay" data-timediv="mon_time" name="weekdays_available[]" value="mon" <?php displayDay('mon',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDayMonday">Monday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('mon',$availability_weekdays,'div'); ?>" id="mon_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="mon_time_from" name="mon_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_mon_time_from'][0],'from');?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="mon_time_to" name="mon_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_mon_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayTuesday" class="weekDay" data-timediv="tue_time" name="weekdays_available[]" value="tue" <?php displayDay('tue',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDayTuesday">Tuesday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('tue',$availability_weekdays,'div'); ?>" id="tue_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="tue_time_from" name="tue_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_tue_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="tue_time_to" name="tue_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_tue_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayWednesday" class="weekDay" data-timediv="wed_time" name="weekdays_available[]" value="wed" <?php displayDay('wed',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDayWednesday">Wednesday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('wed',$availability_weekdays,'div'); ?>" id="wed_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="wed_time_from" name="wed_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_wed_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="wed_time_to" name="wed_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_wed_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayThursday" class="weekDay" data-timediv="thu_time" name="weekdays_available[]" value="thu" <?php displayDay('thu',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDayThursday">Thursday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('thu',$availability_weekdays,'div'); ?>" id="thu_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="thu_time_from" name="thu_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_thu_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="thu_time_to" name="thu_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_thu_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayFriday" class="weekDay" data-timediv="fri_time" name="weekdays_available[]" value="fri" <?php displayDay('fri',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDayFriday">Friday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('fri',$availability_weekdays,'div'); ?>" id="fri_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="fri_time_from" name="fri_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_fri_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="fri_time_to" name="fri_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_fri_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDaySaturday" class="weekDay" data-timediv="sat_time" name="weekdays_available[]" value="sat" <?php displayDay('sat',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDaySaturday">Saturday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('sat',$availability_weekdays,'div'); ?>" id="sat_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sat_time_from" name="sat_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_sat_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sat_time_to" name="sat_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_sat_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDaySunday" class="weekDay" data-timediv="sun_time" name="weekdays_available[]" value="sun" <?php displayDay('sun',$availability_weekdays,'input'); ?>>
                                        <span class="checkmark"></span>
                                        <span for="weekDaySunday">Sunday</span>
                                    </div>

                                    <div class="timeFromTo <?php displayDay('sun',$availability_weekdays,'div'); ?>" id="sun_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sun_time_from" name="sun_time_from" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_sun_time_from'][0],'from'); ?>">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sun_time_to" name="sun_time_to" value="<?php checkIfNull($platformUser->availability->postMeta['user_availability_sun_time_to'][0],'to'); ?>">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </section>


                        <section class="main-section full-width">

                            <div class="full-width margin-top-30 margin-bottom-30">
                                <h2>Exlude specific dates you are not available</h2>
                                <p>Add specific dates you are not available regardlress the week days selected</p>
                            </div>

                            <div class="full-width flex">
                                <div
                                        class="calendar col l6 m6"
                                        data-disabledates="2021-01-04,2021-01-14,2021-01-19,2021-01-27,2021-01-03"
                                        data-disabledweekdays=""
                                        data-scheduledates="Giorgos/2021-01-17,Nikos/2021-01-21,Kostas/2021-01-23,Matsamplokos/2021-01-30,Τα γενέθλια του Μένιου/2021-01-09"
                                        style="width: 500px;"
                                ></div>
                                <div id="excludedDatesDiv" class="col l6 m6">
                                    <?php excluded_dates_display($excluded_dates);?>
                                </div>
                                <input type="hidden" name="excluded_dates" id="excluded_dates" value="<?php
                                    if (isset($platformUser->availability->postMeta['user_availability_excluded_dates'][0])) {
                                        echo $platformUser->availability->postMeta['user_availability_excluded_dates'][0];
                                    }
                                ?>">
                            </div>

                        </section>

                    </div>



                </div>

                <div class="col l3 m4"></div>
                <div class="col l12 m12">
                    <button type="submit" class="saveAvailability" name="refresh_action" value="save_availability">SAVE MY AVAILABILITY</button>
                </div>

            </form>
        </div>
    </main>

<?php

get_footer();
