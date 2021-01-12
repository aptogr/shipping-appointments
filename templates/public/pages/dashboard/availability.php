<?php
get_header();

$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );

//$availability = new \ShippingAppointments\Service\Entities\Availability(1234);
//$availability->weekdays_available;

//var_dump($platformUser);
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
                                        <input type="checkbox" id="weekDayMonday" class="weekDay" data-timediv="mon_time" name="weekdays_available[]" value="mon">
                                        <span class="checkmark"></span>
                                        <span for="weekDayMonday">Monday</span>
                                    </div>

                                    <div class="timeFromTo" id="mon_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="mon_time_from" name="mon_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="mon_time_to" name="mon_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayTuesday" class="weekDay" data-timediv="tue_time" name="weekdays_available[]" value="tue">
                                        <span class="checkmark"></span>
                                        <span for="weekDayTuesday">Tuesday</span>
                                    </div>

                                    <div class="timeFromTo" id="tue_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="tue_time_from" name="tue_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="tue_time_to" name="tue_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayWednesday" class="weekDay" data-timediv="wed_time" name="weekdays_available[]" value="wed">
                                        <span class="checkmark"></span>
                                        <span for="weekDayWednesday">Wednesday</span>
                                    </div>

                                    <div class="timeFromTo" id="wed_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="wed_time_from" name="wed_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="wed_time_to" name="wed_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayThursday" class="weekDay" data-timediv="thu_time" name="weekdays_available[]" value="thu">
                                        <span class="checkmark"></span>
                                        <span for="weekDayThursday">Thursday</span>
                                    </div>

                                    <div class="timeFromTo" id="thu_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="thu_time_from" name="thu_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="thu_time_to" name="thu_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDayFriday" class="weekDay" data-timediv="fri_time" name="weekdays_available[]" value="fri">
                                        <span class="checkmark"></span>
                                        <span for="weekDayFriday">Friday</span>
                                    </div>

                                    <div class="timeFromTo" id="fri_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="fri_time_from" name="fri_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="fri_time_to" name="fri_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDaySaturday" class="weekDay" data-timediv="sat_time" name="weekdays_available[]" value="sat">
                                        <span class="checkmark"></span>
                                        <span for="weekDaySaturday">Saturday</span>
                                    </div>

                                    <div class="timeFromTo" id="sat_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sat_time_from" name="sat_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sat_time_to" name="sat_time_to" value="23:00">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="daDay">

                                    <div class="dayBox">
                                        <input type="checkbox" id="weekDaySunday" class="weekDay" data-timediv="sun_time" name="weekdays_available[]" value="sun">
                                        <span class="checkmark"></span>
                                        <span for="weekDaySunday">Sunday</span>
                                    </div>

                                    <div class="timeFromTo" id="sun_time">

                                        <div class="full-width flex flex-dir-col">

                                            <div class="timeFrom">
                                                <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sun_time_from" name="sun_time_from" value="06:00">
                                            </div>

                                            <div class="timeTo">
                                                <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sun_time_to" name="sun_time_to" value="23:00">
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
                                <div id="excludedDatesDiv" class="col l6 m6"></div>
                                <input type="hidden" name="excluded_dates" id="excluded_dates" value="">
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
