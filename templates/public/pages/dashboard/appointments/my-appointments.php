<?php
get_header();


$logedInUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );

//echo "<pre>";
//print_r($logedInUser);
//echo "</pre>";



?>
<!--    My Appointments page here-->
    <section id="my-appointment-template" class="my-appointment-template full-width padding-top-30 padding-bottom-30">

        <table>

            <tr>
                <th>Requestor</th>
                <th>Date</th>
                <th>Starting Time</th>
                <th>Duration</th>
                <th>Appointment Method</th>
                <th>Status</th>
            </tr>

            <?php

                $appointmentArgs = array(
                    'author'            => get_current_user_id(),
                    'post_type'         => 'user_appointments',
                    'post_status'       => 'publish',
                    'posts_per_page'    => '-1',
//                    'posts_per_page'    => '1',
                );

                $appointments = get_posts( $appointmentArgs );

                foreach ( $appointments as $key => $appointment ) {

                    $appointmentObj = new \ShippingAppointments\Service\Entities\Appointment($appointment->ID);

//                    echo "<tr class='appointmentRow'>";
//                        echo "<pre>";
//                        print_r($appointmentObj);
//                        echo "</pre>";
//                    echo "</tr>";

                    echo "<tr class='appointmentRow'>";
                        echo "<td>".$appointmentObj->requester_user->data->display_name."</td>";
                        echo "<td><a href='".get_post_permalink($appointment->ID)."'> ".$appointmentObj->date."</a></td>";
                        echo "<td>".$appointmentObj->from_time."</td>";
                        echo "<td>".$appointmentObj->meeting_time_duration."</td>";
                        echo "<td>".ucfirst(str_replace('_', ' ', $appointmentObj->appointment_method_selected))."</td>";
                        echo "<td>".ucfirst(str_replace('_', ' ', $appointmentObj->status))."</td>";
                    echo "</tr>";

                }

            ?>

        </table>

    </section>

<?php

get_footer();
