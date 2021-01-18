<?php
get_header();

$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );

//echo "<pre>";
//print_r($platformUser);
//echo "</pre>";

//echo $platformUser->booking_request_type;

function displayInputValue ($value) {
//    if (!empty($value)) {
//        echo $value;
//    }

    echo (!empty($value)) ? $value : "" ;
}

function displayRadioValue ($id,$value) {
//    if ($id == $value) {
//        echo 'checked';
//    }
    echo ($id == $value) ? 'checked' : "" ;
}

?>
    <div class="row booking-settings no-margin-bottom full-width">

        <div class="col m9 l9 no-padding">

            <form action="" method="post">

                <div class="col l12 m12">

                    <section class="main-section full-width">

                        <h1>Booking Settings</h1>

                        <p>Set up your booking settings.</p>

                    </section>


                    <section class="main-section full-width">

                        <h2>Meeting Time Duration</h2>

                        <p>Timeframe of the meeting in minutes (ex.30)</p>

                        <input name="meeting_duration" id="meeting_duration" value="<?php displayInputValue($platformUser->meeting_duration);?>">

                    </section>


                    <section class="main-section full-width">

                        <h2>Meeting Time Buffer</h2>

                        <p>Buffer duration (in minutes) before and after meetings</p>

                        <input name="meeting_buffer" id="meeting_buffer" value="<?php displayInputValue($platformUser->meeting_buffer);?>">

                    </section>


                    <section class="main-section full-width">

                        <h2>Max meetings per day</h2>

                        <p>The maximum meetings the current user can be booked for.</p>

                        <input name="max_meetings_per_day" id="max_meetings_per_day" value="<?php displayInputValue($platformUser->max_meetings_per_day);?>">

                    </section>


                    <section class="main-section full-width">

                        <h2>Book in advance days</h2>

                        <p>The minimum days notice to book the current user for.</p>

                        <input name="book_in_advance_days" id="book_in_advance_days" value="<?php displayInputValue($platformUser->book_in_advance_days);?>">

                    </section>


                    <section class="main-section full-width">

                        <h2>Booking request type</h2>

                        <p>The way the booking requests are made. Email or instant booking</p>

                        <div class="full-width flex">

                            <div class="col no-padding-left">

                                <input type="radio" id="booking_request_type_email" name="booking_request_type" value="email" <?php displayRadioValue('email',$platformUser->booking_request_type);?>>
                                <label for="booking_request_type_email">Ask via Email first</label><br>

                            </div>

                            <div class="col no-padding-left">

                                <input type="radio" id="booking_request_type_instant" name="booking_request_type" value="instant" <?php displayRadioValue('instant',$platformUser->booking_request_type);?>>
                                <label for="booking_request_type_instant">Instant Booking</label><br>

                            </div>

                        </div>

                    </section>


                    <section class="main-section full-width">

                        <h2>How many times to meet same supplier</h2>

                        <p>The maximum number of times the user can meet a supplier</p>

                        <input name="meet_same_supplier_times" id="meet_same_supplier_times" value="<?php displayInputValue($platformUser->meet_same_supplier_times);?>">

                    </section>


                    <section class="main-section full-width">

                        <h2>Cancellation Policy</h2>

                        <p>The cancellation policy for bookings.</p>

                        <textarea id="cancellation_policy" name="cancellation_policy" rows="5" cols="80"><?php displayInputValue($platformUser->cancellation_policy);?></textarea>

                    </section>

                </div>
                <div class="col l12 m12">

                    <button type="submit" class="saveBooking save-button margin-top-30" name="refresh_action" value="save_booking_settings">SAVE MY AVAILABILITY</button>

                </div>

            </form>

        </div>

    </div>

<?php

get_footer();
