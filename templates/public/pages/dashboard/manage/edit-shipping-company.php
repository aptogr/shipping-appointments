<?php
get_header();
$logedInUserObj = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );
$companyId = get_query_var('company');
$companyObj = new \ShippingAppointments\Service\Entities\ShippingCompany($companyId);

//echo "<pre>";
//print_r($companyObj);
//echo "</pre>";

function displayRadioValue ($id,$value) {
    echo ($id == $value) ? 'checked' : "" ;
}

function displayCheckboxValue ($id,$value) {
    if (is_array($value)) {
        if (in_array($id,$value)) {
            echo 'checked';
        } else {
            echo '';
        }
    } else {
        if ($id == $value) {
            echo 'checked';
        }
    }
}

?>

    <div class="container">

        <div class="row company-settings no-margin-bottom full-width">

            <div class="col l12 m12">

                <form action="" method="post">

                    <input type="hidden" name="companyId" value="<?php echo $companyId; ?>" >

                    <section class="main-section full-width">

                        <h1>Company Settings</h1>
                        <p>Set up your company settings.</p>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <div class="full-width">
                            <h2>Users Visibility</h2>
                            <p>Select your visibility settings.</p>
                        </div>

                        <div id="company_users_visibility_section" class="full-width relative">

                            <input type="radio" id="company_users_visibile" class="checkboxradio" name="company_users_visibility" value="company_users_visibile" <?php displayRadioValue('company_users_visibile',$companyObj->company_users_visibility);?>>
                            <label for="company_users_visibile">Visibile Users</label>

                            <input type="radio" id="company_users_invisibile" class="checkboxradio" name="company_users_visibility" value="company_users_invisibile" <?php displayRadioValue('company_users_invisibile',$companyObj->company_users_visibility);?>>
                            <label for="company_users_invisibile">Invisible Users</label>

                            <input type="radio" id="company_users_department" class="checkboxradio" name="company_users_visibility" value="company_users_department" <?php displayRadioValue('company_users_department',$companyObj->company_users_visibility);?>>
                            <label for="company_users_department">Let the department define</label>
                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <h2>Meeting Type</h2>

                        <p>Define the meeting types that the company will accept for bookings or let each department define.</p>

                        <div id="company_users_visibility_section" class="full-width relative">

                            <input type="radio" id="meeting_type_company" class="checkboxradio" name="meeting_type" value="company" <?php displayRadioValue('company',$companyObj->meeting_type);?>>
                            <label for="meeting_type_company">Defined by Company</label>

                            <input type="radio" id="meeting_type_company_department" class="checkboxradio" name="meeting_type" value="department" <?php displayRadioValue('department',$companyObj->meeting_type);?>>
                            <label for="meeting_type_company_department">Let the departments define</label>


                        </div>

                        <div class="full-width flex margin-top-30">

                            <input type="checkbox" id="booking_method_physical_location" class="checkboxradio" name="meeting_types_available[]" value="physical_location" <?php displayCheckboxValue ('physical_location',$companyObj->meeting_types_available);?>>
                            <label for="booking_method_physical_location">One to one</label><br>

                            <input type="checkbox" id="booking_method_phone_call" class="checkboxradio" name="meeting_types_available[]" value="phone_call" <?php displayCheckboxValue ('phone_call',$companyObj->meeting_types_available);?>>
                            <label for="booking_method_phone_call">Phone Call</label><br>

                            <input type="checkbox" id="booking_method_online" class="checkboxradio" name="meeting_types_available[]" value="online" <?php displayCheckboxValue ('online',$companyObj->meeting_types_available);?>>
                            <label for="booking_method_online">Web</label><br>
                        </div>


                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <h2>Instant Booking</h2>

                        <p>Define if the company will accept instant bookings. Instant bookings do not require the acceptance of the employee or the department administrator.</p>

                        <div class="full-width flex profenda-field">

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_accept_specific" class="checkboxradio"  name="instant_booking" value="accept_specific"
                                    <?php echo ( $companyObj->instant_booking === 'accept_specific' ? 'checked' : '');?>>
                                <label for="instant_booking_accept_specific">Accept for specific</label><br>

                            </div>

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_decline" class="checkboxradio"  name="instant_booking" value="decline"
                                    <?php echo ( $companyObj->instant_booking === 'decline' ? 'checked' : '');?>>
                                <label for="instant_booking_decline">Do not accept</label><br>

                            </div>

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_user" class="checkboxradio"  name="instant_booking" value="department"
                                    <?php echo ( $companyObj->instant_booking === 'department' ? 'checked' : '');?>>
                                <label for="instant_booking_user">Let the department define</label><br>

                            </div>


                        </div>


                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <h2>Minimum Notice Period</h2>

                        <p>The minimum days notice to book the current user for.</p>

                        <div id="minimum_notice_section" class="full-width relative">

                            <input type="radio" id="minimum_notice_in_advance" class="checkboxradio" name="minimum_notice" value="minimum_notice_in_advance" <?php displayRadioValue('minimum_notice_in_advance',$companyObj->minimum_notice);?>>
                            <label for="minimum_notice_in_advance">Book an appointment at least xxx days in advance</label>

                            <input type="radio" id="minimum_notice_no_limit" class="checkboxradio" name="minimum_notice" value="minimum_notice_no_limit" <?php displayRadioValue('minimum_notice_no_limit',$companyObj->minimum_notice);?>>
                            <label for="minimum_notice_no_limit">No time limit</label>

                            <input type="radio" id="minimum_notice_department" class="checkboxradio" name="minimum_notice" value="minimum_notice_department"  <?php displayRadioValue('minimum_notice_department',$companyObj->minimum_notice);?>>
                            <label for="minimum_notice_department">Let the department define</label>

                        </div>

                        <div class="full-width relative margin-top-20">

                            <input name="book_in_advance_days" id="book_in_advance_days" class="spinner0" value="<?php echo $companyObj->book_in_advance_days; ?>">

                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">


                        <div class="full-width">
                            <h2>Meeting Repetition</h2>
                        </div>

                        <div id="meeting_repetition_section" class="full-width relative">

                            <input type="radio" id="meeting_repetition_limit" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_limit" <?php displayRadioValue('meeting_repetition_limit',$companyObj->meeting_repetition);?>>
                            <label for="meeting_repetition_limit">Do not let the same supplier to visit our company xxx times</label>

                            <input type="radio" id="meeting_repetition_no_limit" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_no_limit" <?php displayRadioValue('meeting_repetition_no_limit',$companyObj->meeting_repetition);?>>
                            <label for="meeting_repetition_no_limit">No time limit</label>

                            <input type="radio" id="meeting_repetition_department" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_department" <?php displayRadioValue('meeting_repetition_department',$companyObj->meeting_repetition);?>>
                            <label for="meeting_repetition_department">Let the department define</label>

                        </div>

                        <div id="meeting_repetition_time_section" class="full-width relative margin-top-20">

                            <input name="meeting_repetition_time" id="meeting_repetition_time" class="spinner0" value="<?php echo $companyObj->meeting_repetition_time; ?>">

                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <button type="submit" class="save-button" name="refresh_action" value="save_company_settings">Save Settings</button>

                    </section>

                </form>

            </div>

        </div>

    </div>

<?php
get_footer();