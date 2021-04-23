<?php
get_header();

global $post;

$appointment = new \ShippingAppointments\Service\Entities\Appointment($post->ID);


function displayFields ($method,$method_selected) {
    return (strpos($method, $method_selected) !== false) ? 'appointment_method display-block' : "appointment_method hide" ;
}

//echo "<pre>";
//print_r($post);
//echo "</pre>";
//
//echo "<pre>";
//print_r($appointment);
//echo "</pre>";
//?>

    <section id="appointment-requestor-template" class="appointment-requestor full-width padding-top-30 padding-bottom-30">
        <div class="container relative z-index-1">

            <div class="col l12 m12 s12">

                <div class="col x12 l12 m12 s12 margin-bottom-30">
                    <h2>
                        <?php echo $post->post_title?>
                    </h2>
                    <h3>
                        Meeting with <?php echo get_user_by( 'id', $post->post_author )->display_name; ?>.
                    </h3>
                </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Status</div>
                        <div class="label_input col l8 m8 s12">
                            <? echo str_replace("_"," ",ucfirst($appointment->displayInputValue ($appointment->status)));?>
                        </div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Date</div>
                        <div class="label_input col l8 m8 s12">
                            <? echo $appointment->displayInputValue ($appointment->date);?>
                        </div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Time From</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->from_time);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Meeting Time Duration</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->meeting_time_duration);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Appointment Method</div>
                        <div class="label_input col l8 m8 s12">
                            <?php echo str_replace("_"," ",ucfirst($appointment->appointment_method_selected));?>
                        </div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 <?php echo displayFields ('physical_location',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Location</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->location);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 <?php echo displayFields ('physical_location',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Event Location</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->event_location);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_telephone <?php echo displayFields ('phone_call',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Telephone</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->telephone);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Zoom Link</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->zoom_link);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Webex Link</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->webex_link);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20 method_selected_teams_link <?php echo displayFields ('online',$appointment->appointment_method_selected);?>">
                        <div class="label col l4 m4 s12">Microsoft Teams Link</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->teams_link);?></div>
                    </div>

                    <div class="col x12 l12 m12 s12 margin-bottom-20">
                        <div class="label col l4 m4 s12">Questions</div>
                        <div class="label_input col l8 m8 s12"><? echo $appointment->displayInputValue ($appointment->invite_questions);?></div>
                    </div>

            </div>

        </div>
    </section>

<?php

get_footer();