<?php

use ShippingAppointments\Service\Dashboard\Company\DashboardCompany;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\Entities\DepartmentType;
use ShippingAppointments\Service\Dashboard\Settings\DashboardSettingsCompany;

get_header();
$logedInUserObj = new PlatformUser( get_current_user_id() );
$companyId = get_query_var('company');
$companyObj = new ShippingCompany($companyId);
$dashboardSettingsCompany = new DashboardSettingsCompany();
$invitationForm = new \ShippingAppointments\Service\Invitation\InvitationForm();

$dashboardCompany = new DashboardCompany();


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

                            <li class="tab-link">
                                Invitations
                            </li>

                        </ul>

                    </div>

                    <article id="pages-container">

                        <div id="pages-container-inner">

                            <div class="swiper-wrapper">

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <form action="" method="post">

                                            <input type="hidden" name="companyId" value="<?php echo $companyId; ?>" >

                                            <section class="main-section full-width setting-field-wrapper">

                                                <div class="full-width">
                                                    <h2>Users Visibility</h2>
                                                    <p>Select your visibility settings.</p>
                                                </div>

                                                <div id="company_users_visibility_section" class="full-width relative">

                                                    <input type="radio" id="company_users_visibile" class="checkboxradio" name="company_users_visibility" value="company_users_visibile" <?php $dashboardSettingsCompany->displayRadioValue('company_users_visibile',$companyObj->company_users_visibility);?>>
                                                    <label for="company_users_visibile">Visibile Users</label>

                                                    <input type="radio" id="company_users_invisibile" class="checkboxradio" name="company_users_visibility" value="company_users_invisibile" <?php $dashboardSettingsCompany->displayRadioValue('company_users_invisibile',$companyObj->company_users_visibility);?>>
                                                    <label for="company_users_invisibile">Invisible Users</label>

                                                    <input type="radio" id="company_users_department" class="checkboxradio" name="company_users_visibility" value="company_users_department" <?php $dashboardSettingsCompany->displayRadioValue('company_users_department',$companyObj->company_users_visibility);?>>
                                                    <label for="company_users_department">Let the department define</label>
                                                </div>

                                            </section>

                                            <section class="main-section full-width setting-field-wrapper">

                                                <h2>Meeting Type</h2>

                                                <p>Define the meeting types that the company will accept for bookings or let each department define.</p>

                                                <div id="meeting_type" class="full-width relative">

                                                    <input type="radio" id="meeting_type_company" class="checkboxradio" name="meeting_type" value="company" <?php $dashboardSettingsCompany->displayRadioValue('company',$companyObj->meeting_type);?>>
                                                    <label for="meeting_type_company">Defined by Company</label>

                                                    <input type="radio" id="meeting_type_company_department" class="checkboxradio" name="meeting_type" value="department" <?php $dashboardSettingsCompany->displayRadioValue('department',$companyObj->meeting_type);?>>
                                                    <label for="meeting_type_company_department">Let the departments define</label>


                                                </div>

                                                <div id="meeting_types_available" class="full-width flex margin-top-30 <?php echo ( $companyObj->meeting_type !== 'company' ? 'hide' : ''); ?>">

                                                    <input type="checkbox" id="booking_method_physical_location" class="checkboxradio" name="meeting_types_available[]" value="physical_location" <?php $dashboardSettingsCompany->displayCheckboxValue ('physical_location',$companyObj->meeting_types_available);?>>
                                                    <label for="booking_method_physical_location">One to one</label><br>

                                                    <input type="checkbox" id="booking_method_phone_call" class="checkboxradio" name="meeting_types_available[]" value="phone_call" <?php $dashboardSettingsCompany->displayCheckboxValue ('phone_call',$companyObj->meeting_types_available);?>>
                                                    <label for="booking_method_phone_call">Phone Call</label><br>

                                                    <input type="checkbox" id="booking_method_online" class="checkboxradio" name="meeting_types_available[]" value="online" <?php $dashboardSettingsCompany->displayCheckboxValue ('online',$companyObj->meeting_types_available);?>>
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

                                                    <input type="radio" id="minimum_notice_in_advance" class="checkboxradio" name="minimum_notice" value="minimum_notice_in_advance" <?php $dashboardSettingsCompany->displayRadioValue('minimum_notice_in_advance',$companyObj->minimum_notice);?>>
                                                    <label for="minimum_notice_in_advance">Book an appointment at least xxx days in advance</label>

                                                    <input type="radio" id="minimum_notice_no_limit" class="checkboxradio" name="minimum_notice" value="minimum_notice_no_limit" <?php $dashboardSettingsCompany->displayRadioValue('minimum_notice_no_limit',$companyObj->minimum_notice);?>>
                                                    <label for="minimum_notice_no_limit">No time limit</label>

                                                    <input type="radio" id="minimum_notice_department" class="checkboxradio" name="minimum_notice" value="minimum_notice_department"  <?php $dashboardSettingsCompany->displayRadioValue('minimum_notice_department',$companyObj->minimum_notice);?>>
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

                                                    <input type="radio" id="meeting_repetition_limit" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_limit" <?php $dashboardSettingsCompany->displayRadioValue('meeting_repetition_limit',$companyObj->meeting_repetition);?>>
                                                    <label for="meeting_repetition_limit">Do not let the same supplier to visit our company xxx times</label>

                                                    <input type="radio" id="meeting_repetition_no_limit" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_no_limit" <?php $dashboardSettingsCompany->displayRadioValue('meeting_repetition_no_limit',$companyObj->meeting_repetition);?>>
                                                    <label for="meeting_repetition_no_limit">No time limit</label>

                                                    <input type="radio" id="meeting_repetition_department" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_department" <?php $dashboardSettingsCompany->displayRadioValue('meeting_repetition_department',$companyObj->meeting_repetition);?>>
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

                                    <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <h2>
                                            Profile Settings (Under development)
                                        </h2>

                                        <p>
                                            Settings can be: company logo, description, premises
                                        </p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <h2>
                                            Manage departments
                                        </h2>

                                        <p>
                                            The company administrators will be able to add/delete the company's departments here
                                        </p>

                                        <?php $departments = $dashboardCompany->getDepartmentsList($companyObj); ?>

                                        <table class="margin-top-50">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Department
                                                </th>
                                                <th>
                                                    Employees
                                                </th>
                                                <th>
                                                    Enabled
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Availability
                                                </th>
                                                <th>
                                                    Edit
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
		                                    <?php foreach( $departments as $departmentType ): /** @var $departmentType DepartmentType */ ?>

                                                <?php $companyDepartment = $companyObj->getDepartmentByType( $departmentType ); ?>

                                                <?php if( $companyDepartment !== false ): ?>
                                                <tr class="<?php echo ( $companyDepartment->status == 'enabled' ? 'department-active' : 'department-inactive' ); ?> department-row existing-department">
                                                    <td>
                                                        <div class="department-table-name flex flex-center">
		                                                    <?php echo $departmentType->svg; ?>
		                                                    <?php echo $departmentType->term->name; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo count( $companyDepartment->users ); ?>
                                                    </td>
                                                    <td>
                                                        <div class="toggle-switch margin-left-auto toggle-trigger">
                                                            <input type="checkbox" class="departmentCheckBox" data-department="<?php echo $companyDepartment->ID;?>" id="<?php echo $departmentType->ID; ?>" value="<?php echo $departmentType->ID; ?>" name="departments[]" <?php echo ( $companyDepartment->status == 'enabled' ? 'checked' : '' ); ?>  />
                                                            <label for="<?php echo $departmentType->ID; ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td class="departmentStatus">
                                                        <?php echo ( $companyDepartment->status == 'enabled' ? 'Enabled' : 'Disabled' ); ?>
                                                    </td>
                                                    <td class="department_availability">

                                                        <?php
                                                            if ($companyDepartment->hasAvailability()) {
                                                                ?>
                                                                <div id="view-availability-single-department" data-depid="<?php echo $companyDepartment->ID;?>" class="profenda-btn display-inline-block view-availability-single-department">Preview Availability</div>
                                                                <?php
                                                            } else {
                                                                echo "Not set.";
                                                            }
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('dashboard/manage/edit-departments/department/' . $companyDepartment->ID ); ?>">
                                                            Edit Department
                                                        </a>
                                                    </td>

                                                </tr>

                                                <?php else: ?>

                                                    <tr class="department-inactive department-row">
                                                        <td>
                                                            <div class="department-table-name flex flex-center">
	                                                            <?php echo $departmentType->svg; ?>
	                                                            <?php echo $departmentType->term->name; ?>
                                                            </div>
                                                        </td>
                                                        <td>
						                                    0
                                                        </td>
                                                        <td>
                                                            <div class="toggle-switch margin-left-auto toggle-trigger">
                                                                <input type="checkbox" class="departmentCheckBox" id="<?php echo $departmentType->ID; ?>" value="<?php echo $departmentType->ID; ?>" name="departments[]" />
                                                                <label for="<?php echo $departmentType->ID; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            Inactive
                                                        </td>
                                                        <td>
                                                           -
                                                        </td>
                                                        <td>
                                                           -
                                                        </td>
                                                    </tr>

                                                <?php endif; ?>

		                                    <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50 swiper-no-swiping">

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
                                                        <?php
                                                        foreach ($companyObj->departments as $dadepartment ) {
                                                            $dadepartmentOBJ = new \ShippingAppointments\Service\Entities\Department($dadepartment);
                                                            echo "<option value=".$dadepartmentOBJ->departmentType->term->slug.">";
                                                            echo $dadepartmentOBJ->departmentType->term->name;
                                                            echo "</option>";
                                                        }
                                                        ?>
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
                                                        <?php
                                                            foreach ($companyObj->departments as $dadepartment ) {
                                                                $dadepartmentOBJ = new \ShippingAppointments\Service\Entities\Department($dadepartment);
                                                                echo "<option value=".$dadepartmentOBJ->departmentType->term->slug.">";
                                                                echo $dadepartmentOBJ->departmentType->term->name;
                                                                echo "</option>";
                                                            }
                                                        ?>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <table id="companyEmployeesTable">
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

                                <div class="swiper-slide">

                                    <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <h2>
                                            Invitations
                                        </h2>

                                        <p>
                                            This section will be used for the company admins in order to send invitations for
                                            company administrators and department administrators.
                                            <br>
                                            We can include invitations for the employees too at this section.
                                        </p>

                                        <div class="company-users-filters flex-grow flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <?php

                                                echo $invitationForm->getShippingInvitationForm($companyId);

                                            ?>

                                        </div>

                                        <div class="company-users-filters flex-grow flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <div class="profenda-filter-item flex flex-center">

                                                <label for="searchEmployeeInvitation" class="filter-label">
                                                    Search Employee:
                                                </label>

                                                <div class="filter-field">

                                                    <input id="searchEmployeeInvitation" name="employee_name" placeholder="Type a name or email">

                                                </div>

                                            </div>

                                            <div class="profenda-filter-item flex-grow flex flex-center margin-left-auto">

                                                <label for="statusFilterInvitation" class="filter-label">
                                                    Status:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="statusFilterInvitation">
                                                        <option value="all">All</option>
                                                        <option value="expired">Expired</option>
                                                        <option value="accepted">Accepted</option>
                                                        <option value="pending">Pending</option>
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="profenda-filter-item  flex-grow flex flex-center margin-left-auto">

                                                <label for="departmentFilterInvitation" class="filter-label">
                                                    Department:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="departmentFilterInvitation">
                                                        <option value="all">All</option>
                                                        <?php
                                                        foreach ($companyObj->departments as $dadepartment ) {

                                                            $dadepartmentOBJ = new \ShippingAppointments\Service\Entities\Department($dadepartment);

                                                            echo "<option value=".$dadepartmentOBJ->departmentType->term->slug.">";
                                                            echo $dadepartmentOBJ->departmentType->term->name;
                                                            echo "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>

                                            </div>


                                            <div class="profenda-filter-item flex-grow flex flex-center no-margin-right">

                                                <label for="userRoleFilterInvitation" class="filter-label">
                                                    User Role:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="userRoleFilterInvitation">
                                                        <option value="all">All</option>
                                                        <option value="shipping_company_admin">Company Admin</option>
                                                        <option value="shipping_company_department_admin">Department Admin</option>
                                                        <option value="shipping_company_employee">Employee</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="invitationTableDiv">

                                            <?php

                                            $invitationTable = new \ShippingAppointments\Service\Invitation\InvitationTable();

                                            echo $invitationTable->getShippingCompanyInvitationTable($companyId);

                                            ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </article>



                </div>

            </div>

        </div>

    </div>

    <div id="departmentModal" class="profenda-modal">

        <form method="post">

            <input type="hidden" id="com_id" name="company" value="<?php echo $companyId;?>">
            <input type="hidden" id="departmentID" name="departmentID" value="">
            <input type="hidden" id="loggedInUser" name="loggedInUser" value="<?php echo get_current_user_id();?>">

            <div class="profenda-modal-header">
                Department
            </div>

            <div class="profenda-modal-content padding-top-30 padding-bottom-30">


                <div class="main-section full-width setting-field-wrapper">
                    <div class="full-width">
                        <h2>Be the department admin</h2>
                    </div>
                    <div class="full-width margin-top-20">
                        <div class="toggle-switch margin-left-auto toggle-trigger">
                            <input id="depAdmin" type="checkbox" value="1" name="depAdmin">
                            <label for="depAdmin"></label>
                        </div>
                    </div>
                </div>


                <div class="main-section full-width setting-field-wrapper">

                    <div class="full-width">
                        <h2>Assign a department admin</h2>
                    </div>

                    <div class="full-width margin-top-20">
                        <select name="selectedDepartmentAdmin" id="selectedDepartmentAdmin"></select>
                    </div>

                </div>


                <div class="main-section full-width setting-field-wrapper">

                    <div class="full-width">
                        <h2>Invite user</h2>
                    </div>

                    <div class="full-width margin-top-20">
                        <?php
                            echo $invitationForm->getShippingInvitationForm($companyId);
                        ?>
                    </div>

                </div>

                <div class="main-section full-width setting-field-wrapper">

                    <div class="full-width">
                        <button type="submit" class="saveBooking save-button" name="refresh_action" value="create_department">Create Department</button>
                    </div>

                </div>


            </div>

        </form>

    </div>
    <div id='departmentModalOverlay' class="modal-overlay"></div>
    <div id="availabilityModal" class="profenda-modal">

        <div class="profenda-modal-header">
            Availability
        </div>
        <div class="profenda-modal-content">

        </div>

    </div>
    <div class="modal-overlay"></div>

<?php
get_footer();
