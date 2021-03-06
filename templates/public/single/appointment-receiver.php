<?php
get_header();

global $post;

$appointment = new \ShippingAppointments\Service\Entities\Appointment($post->ID);


//function hideDiv ($valueid,$value) {
//    return ($valueid == $value) ? 'hide' : "" ;
//}

function displayFields ($method,$method_selected) {
    return (strpos($method, $method_selected) !== false) ? 'appointment_method display-block' : "appointment_method hide" ;
}


//echo "<pre>";
//print_r($post);
//echo "</pre>";

//echo "<pre>";
//print_r($appointment);
//echo "</pre>";


?>

<!--    <section class="dashboard-template-opener full-width padding-top-30 padding-bottom-30">-->
<!--        asd-->
<!--    </section>-->
    <section id="appointment-receiver-template" class="appointment-receiver full-width padding-top-30 padding-bottom-30">
        <div class="container relative z-index-1">

            <div class="col l12 m12 s12">

                <div class="col x12 l12 m12 s12 margin-bottom-30">
                    <h2>
                        <?php echo $post->post_title?>
                    </h2>
                    <h3>
                        <?php echo $appointment->requester_user->data->display_name; ?> requested a meeting.
                    </h3>
                </div>

                <form action="" method="post">

                    <input type="hidden" name="appointmentID" value="<?php echo $post->ID;?>">

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Date</div>
                        <div class="label_input col l8 m8 s12"><input disabled name="date" type="text" value="<? echo $appointment->displayInputValue ($appointment->date);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Time From</div>
                        <div class="label_input col l8 m8 s12"><input name="from_time" class="timepickerGeneral" type="text" value="<? echo $appointment->displayInputValue ($appointment->from_time);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Meeting Time Duration</div>
                        <div class="label_input col l8 m8 s12"><input name="meeting_time_duration" type="text" value="<? echo $appointment->displayInputValue ($appointment->meeting_time_duration);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Appointment Method</div>
                        <div class="label_input col l8 m8 s12">
                            <?php

                            if (is_array($appointment->appointment_method)) {

                                foreach ($appointment->appointment_method as $method) {

                                    ?>
                                    <div class="col no-padding-left">
                                        <input type="radio" class="checkboxradio" id="booking_method_<?php echo $method;?>" name="appointment_method_selected" value="<?php echo $method;?>" <?php echo $appointment->displayRadioValue($method,$appointment->appointment_method_selected);?>>
                                        <label for="booking_method_<?php echo $method;?>"><?php echo str_replace("_"," ",ucfirst($method));?></label>
                                    </div>
                                    <?php

                                }

                            } else {

                                ?>
                                <div class="col no-padding-left">
                                    <input type="radio" class="checkboxradio" id="booking_method_<?php echo $appointment->appointment_method;?>" name="appointment_method_selected" value="<?php echo $appointment->appointment_method;?>" <?php echo $appointment->displayRadioValue($appointment->appointment_method,$appointment->appointment_method_selected);?>>
                                    <label for="booking_method_<?php echo $appointment->appointment_method;?>"><?php echo str_replace("_"," ",ucfirst($appointment->appointment_method));?></label>
                                </div>
                                <?php

                            }

                            ?>
                        </div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_location <?php echo displayFields ('physical_location',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Location</div>
                        <div class="label_input col l8 m8 s12"><input name="location" type="text" value="<? echo $appointment->displayInputValue ($appointment->location);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_event_location <?php echo displayFields ('physical_location',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Event Location</div>
                        <div class="label_input col l8 m8 s12"><input name="event_location" type="text" value="<? echo $appointment->displayInputValue ($appointment->event_location);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_telephone <?php echo displayFields ('phone_call',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Telephone</div>
                        <div class="label_input col l8 m8 s12"><input name="telephone" type="text" value="<? echo $appointment->displayInputValue ($appointment->telephone);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_zoom_link <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Zoom Link</div>
                        <div class="label_input col l8 m8 s12"><input name="zoom_link" type="text" value="<? echo $appointment->displayInputValue ($appointment->zoom_link);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_webex_link <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Webex Link</div>
                        <div class="label_input col l8 m8 s12"><input name="webex_link" type="text" value="<? echo $appointment->displayInputValue ($appointment->webex_link);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_teams_link <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Microsoft Teams Link</div>
                        <div class="label_input col l8 m8 s12"><input name="teams_link" type="text" value="<? echo $appointment->displayInputValue ($appointment->teams_link);?>"></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Questions</div>
                        <div class="label_input col l8 m8 s12">
                            <textarea id="invite_questions" name="invite_questions" rows="4" cols="50"><?php echo $appointment->invite_questions;?></textarea>
                        </div>
                    </div>

                    <div class="col l12 m12 margin-top-30">

                            <button type="submit" class="saveBooking save-button" name="refresh_action" value="update_appointment">Save Appointment</button>

                            <button type="submit" class="approveBooking approve-button" name="refresh_action" value="approve_appointment">Approve Appointment</button>

                            <button type="submit" class="cancelBooking cancel-button" name="refresh_action" value="cancel_appointment">Cancel Appointment</button>

                    </div>

                </form>

            </div>

        </div>
    </section>


<?php

get_footer();