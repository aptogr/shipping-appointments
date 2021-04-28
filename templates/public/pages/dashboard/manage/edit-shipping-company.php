<?php

use ShippingAppointments\Service\Entities\User\PlatformUser;

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

    <div class="manage-company full-width padding-bottom-50">

        <section class="dashboard-template-opener full-width padding-top-30 padding-bottom-30 display-inline-block">

            <div class="container relative z-index-1">

                <div class="col s12">

                    <div class="flex flex-center full-width">

                        <div class="dashboard-template-opener-image display-inline-block">
							<?php echo get_the_post_thumbnail( $companyObj->ID, 'thumbnail'); ?>
                        </div>

                        <div class="dashboard-template-opener-title display-inline-block">
                            <h1>
								<?php echo $companyObj->post->post_title; ?>
                            </h1>

							<?php echo get_the_content( $companyObj->ID ); ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="full-width">

            <div class="container">

                <div class="row company-settings no-margin-bottom full-width">

                    <div id="main-navigation" class="margin-top-50">

                        <ul class="links-container">

                            <li class="tab-link active">
                                Platform Settings
                            </li>

                            <li class="tab-link">
                                Company Profile Settings
                            </li>

                            <li class="tab-link">
                                Manage Departments
                            </li>

                            <li class="tab-link">
                                Manage Employees
                            </li>

                        </ul>

                    </div>

                    <article id="pages-container">

                        <div id="pages-container-inner">

                            <div class="swiper-wrapper">

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50">

                                        <form action="" method="post">

                                            <input type="hidden" name="companyId" value="<?php echo $companyId; ?>" >

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

                                                <div id="meeting_type" class="full-width relative">

                                                    <input type="radio" id="meeting_type_company" class="checkboxradio" name="meeting_type" value="company" <?php displayRadioValue('company',$companyObj->meeting_type);?>>
                                                    <label for="meeting_type_company">Defined by Company</label>

                                                    <input type="radio" id="meeting_type_company_department" class="checkboxradio" name="meeting_type" value="department" <?php displayRadioValue('department',$companyObj->meeting_type);?>>
                                                    <label for="meeting_type_company_department">Let the departments define</label>


                                                </div>

                                                <div id="meeting_types_available" class="full-width flex margin-top-30 <?php echo ( $companyObj->meeting_type !== 'company' ? 'hide' : ''); ?>">

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

                                                <div id="book_in_advance_field" class="full-width relative margin-top-20 <?php echo ( $companyObj->minimum_notice !== 'minimum_notice_in_advance' ? 'hide' : ''); ?>">

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



                                                <div id="meeting_repetition_time_section" class="full-width relative margin-top-20 <?php echo ( $companyObj->meeting_repetition !== 'meeting_repetition_limit' ? 'hide' : ''); ?>">

                                                    <input name="meeting_repetition_time" id="meeting_repetition_time" class="spinner0" value="<?php echo $companyObj->meeting_repetition_time; ?>">

                                                </div>

                                            </section>

                                            <section class="main-section full-width setting-field-wrapper">

                                                <button type="submit" class="save-button" name="refresh_action" value="save_company_settings">Save Settings</button>

                                            </section>

                                        </form>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50">

                                        <h2>
                                            Profile Settings (Under development)
                                        </h2>

                                        <p>
                                            Settings can be: company logo, description, premises
                                        </p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50">

                                        <h2>
                                            Manage departments
                                        </h2>

                                        <p>
                                            The company administrators will be able to add/delete the company's departments here
                                        </p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50">

                                        <h2>
                                            Manage Employees
                                        </h2>

                                        <p>
                                            This section will be used for the company admins in order to send invitations for
                                            company administrators and department administrators.
                                            <br>
                                            We can include invitations for the employees too at this section.
                                        </p>


                                        <div class="company-users-filters flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <div class="profenda-filter-item flex flex-center">

                                                <label for="searchEmployee" class="filter-label">
                                                    Search Employee:
                                                </label>

                                                <div class="filter-field">

                                                    <input id="searchEmployee" name="employee_name" placeholder="Type a name or email">

                                                </div>

                                            </div>


                                            <div class="profenda-filter-item flex flex-center margin-left-auto">

                                                <label for="departmentFilter" class="filter-label">
                                                    Department:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="departmentFilter">
                                                        <option value="all">All</option>
                                                        <option value="shipping_company_admin">Technical</option>
                                                        <option value="shipping_company_department_admin">Financial</option>
                                                        <option value="shipping_company_employee">Marine</option>
                                                    </select>

                                                </div>

                                            </div>


                                            <div class="profenda-filter-item flex flex-center no-margin-right">

                                                <label for="userRoleFilter" class="filter-label">
                                                    User Role:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="userRoleFilter">
                                                        <option value="all">All</option>
                                                        <option value="shipping_company_admin">Company Admin</option>
                                                        <option value="shipping_company_department_admin">Department Admin</option>
                                                        <option value="shipping_company_employee">Employee</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Department
                                                </th>
                                                <th>
                                                    Role
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php foreach( $companyObj->getEmployees() as $employee ): /** @var $employee PlatformUser */ ?>

                                                <tr>
                                                    <td>
														<?php echo $employee->first_name . ' ' . $employee->last_name; ?>
                                                    </td>
                                                    <td>
														<?php echo $employee->user_email; ?>
                                                    </td>
                                                    <td>
														<?php echo $employee->department->departmentType->term->name; ?>
                                                    </td>
                                                    <td>
														<?php

														if( $employee->isShippingCompanyAdmin() ){
															echo "Company Admin";
														}
														else if(  $employee->isDepartmentAdmin() ){
															echo "Department Admin";
														}
														else {
															echo "Employee";
														}


														?>
                                                    </td>
                                                </tr>

											<?php endforeach; ?>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </article>



                </div>

            </div>

        </div>

    </div>

<?php
get_footer();
