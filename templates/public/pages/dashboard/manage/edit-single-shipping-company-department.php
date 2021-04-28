<?php

$departmentId = intval(get_query_var('department'));
//echo $departmentId;
$department = new \ShippingAppointments\Service\Entities\Department($departmentId);


//echo "<pre>";
//print_r($department);
//echo "</pre>";

function displayInputValue ($value) {
    echo (!empty($value)) ? $value : "" ;
}

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

function displayDay($day, $availability_weekdays,$type) {

    if (!empty($availability_weekdays)) {
        if (in_array($day,$availability_weekdays)) {
            if ($type == 'div') {
                echo "display:block;";
            } elseif ($type == 'input') {
                echo "checked";
            } elseif ($type == 'act') {
                echo "active";
            }

        }
    }

}

function excludedDatesDisplay($excluded_dates) {

    if (!empty($excluded_dates[0])) {
        $excluded_dates = explode(",", $excluded_dates);
        foreach ($excluded_dates as $value) {
            echo "<div class='exludeDaysBox' data-selecteddate='".$value."'>".$value." <div class='selectedDateDelete' data-selecteddate='".$value."' >x</div></div>";
        }
    }
}

if (isset($department->weekdays_available)) {
    $availability_weekdays = explode(",", $department->weekdays_available);
}

if (isset($department->excluded_dates)) {
    $excluded_dates = explode(",", $department->excluded_dates);
}

//if (isset($department->instant_booking_products)) {
//    $instant_booking_products = explode(",", $department->instant_booking_products);
//}


//echo 'instant_booking_products<br><pre>';
//print_r($department);
//echo '</pre>';

?>

    <div class="row department-settings no-margin-bottom full-width">

        <div class="container">


            <div class="col l12 m12">

                <form action="" method="post">

                    <input type="hidden" name="departmentId" value="<?php echo $department->ID; ?>" >
                    <input type="hidden" name="availability_period_saved_date" value="<?php echo date("m/d/y");  ?>" >

                    <section class="main-section full-width">

                        <h2><?php echo $department->departmentType->term->name; ?> - Settings</h2>

                    </section>

                    <?php if(  $department->companyObject->company_users_visibility !== 'company_users_department' ): ?>

                        <div class="notice-in-page flex flex-center margin-bottom-30">

                            <div class="content flex flex-center">

                                <div class="icon">

                                    <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                </div>

                                <div class="notice-message">
                                    <strong>Notice: The company administrator has set the Employees visibility.</strong>
                                    <br>You cannot change this setting unless the company administrator allows you to do it.
                                </div>

                            </div>

                        </div>

                    <?php endif; ?>

                    <section class="main-section full-width setting-field-wrapper <?php echo ( $department->companyObject->company_users_visibility !== 'company_users_department' ? 'disabled' : ''); ?>">

                        <div class="full-width">
                            <h2>Employees Visibility</h2>
                            <p>Select if the department's employees will be visible to the suppliers.</p>
                        </div>

                        <div id="department_users_visibility_section" class="full-width relative profenda-field">

                            <input type="radio" id="department_users_visibile" class="checkboxradio" name="users_visibility" value="department_users_visibile" <?php displayRadioValue('department_users_visibile',$department->users_visibility);?>>
                            <label for="department_users_visibile">Visibile Users</label>

                            <input type="radio" id="department_users_invisibile" class="checkboxradio" name="users_visibility" value="department_users_invisibile" <?php displayRadioValue('department_users_invisibile',$department->users_visibility);?>>
                            <label for="department_users_invisibile">Invisible Users</label>

                            <input type="radio" id="department_users_department" class="checkboxradio" name="users_visibility" value="department_users_department" <?php displayRadioValue('department_users_department',$department->users_visibility);?>>
                            <label for="department_users_department">Let the users define</label>

                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <div class="full-width">
                            <h2>Department Availability - Extra Hours</h2>
                            <p>Define the additional days and times you will accept bookings as a department.</p>
                        </div>

                        <div class="full-width flex margin-top-20 margin-bottom-20">

                            <div class="daDay <?php displayDay('mon',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDayMonday" class="weekDay" data-timediv="mon_time" name="weekdays_available[]" value="mon" <?php displayDay('mon',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDayMonday">Monday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('mon',$availability_weekdays,'div'); ?>" id="mon_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="mon_time_from" name="mon_time_from" value="<?php displayInputValue($department->mon_time_from,'from');?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="mon_time_to" name="mon_time_to" value="<?php displayInputValue($department->mon_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div class="daDay  <?php displayDay('tue',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDayTuesday" class="weekDay" data-timediv="tue_time" name="weekdays_available[]" value="tue" <?php displayDay('tue',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDayTuesday">Tuesday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('tue',$availability_weekdays,'div'); ?>" id="tue_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="tue_time_from" name="tue_time_from" value="<?php displayInputValue($department->tue_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="tue_time_to" name="tue_time_to" value="<?php displayInputValue($department->tue_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="daDay  <?php displayDay('wed',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDayWednesday" class="weekDay" data-timediv="wed_time" name="weekdays_available[]" value="wed" <?php displayDay('wed',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDayWednesday">Wednesday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('wed',$availability_weekdays,'div'); ?>" id="wed_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="wed_time_from" name="wed_time_from" value="<?php displayInputValue($department->wed_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="wed_time_to" name="wed_time_to" value="<?php displayInputValue($department->wed_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="daDay  <?php displayDay('thu',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDayThursday" class="weekDay" data-timediv="thu_time" name="weekdays_available[]" value="thu" <?php displayDay('thu',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDayThursday">Thursday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('thu',$availability_weekdays,'div'); ?>" id="thu_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="thu_time_from" name="thu_time_from" value="<?php displayInputValue($department->thu_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="thu_time_to" name="thu_time_to" value="<?php displayInputValue($department->thu_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="daDay  <?php displayDay('fri',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDayFriday" class="weekDay" data-timediv="fri_time" name="weekdays_available[]" value="fri" <?php displayDay('fri',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDayFriday">Friday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('fri',$availability_weekdays,'div'); ?>" id="fri_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="fri_time_from" name="fri_time_from" value="<?php displayInputValue($department->fri_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="fri_time_to" name="fri_time_to" value="<?php displayInputValue($department->fri_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="daDay  <?php displayDay('sat',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDaySaturday" class="weekDay" data-timediv="sat_time" name="weekdays_available[]" value="sat" <?php displayDay('sat',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDaySaturday">Saturday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('sat',$availability_weekdays,'div'); ?>" id="sat_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sat_time_from" name="sat_time_from" value="<?php displayInputValue($department->sat_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sat_time_to" name="sat_time_to" value="<?php displayInputValue($department->sat_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="daDay  <?php displayDay('sun',$availability_weekdays,'act'); ?>">

                                <div class="dayBox">
                                    <input type="checkbox" id="weekDaySunday" class="weekDay" data-timediv="sun_time" name="weekdays_available[]" value="sun" <?php displayDay('sun',$availability_weekdays,'input'); ?>>
                                    <span class="checkmark"></span>
                                    <span for="weekDaySunday">Sunday</span>
                                </div>

                                <div class="timeFromTo" style="<?php displayDay('sun',$availability_weekdays,'div'); ?>" id="sun_time">

                                    <div class="full-width flex flex-dir-col">

                                        <div class="timeFrom">
                                            <i class="fa fa-clock-o"></i>From: <input type="text" class="timeSelect timepicker" id="sun_time_from" name="sun_time_from" value="<?php displayInputValue($department->sun_time_from,'from'); ?>">
                                        </div>

                                        <div class="timeTo">
                                            <i class="fa fa-clock-o"></i>To: <input type="text" class="timeSelect timepicker" id="sun_time_to" name="sun_time_to" value="<?php displayInputValue($department->sun_time_to,'to'); ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <div class="full-width">
                            <h2>Availability Period</h2>
                            <p>Select your availability period, per year or per month.</p>
                        </div>

                        <div id="meeting_repetition_section" class="full-width relative profenda-field">

                            <input type="radio" id="availability_period_year" class="checkboxradio radioChecker" name="availability_period" value="year"  <?php displayRadioValue('year',$department->availability_period);?>>
                            <label for="availability_period_year">Per Year</label>

                            <input type="radio" id="availability_period_month" class="checkboxradio" name="availability_period" value="month"  <?php displayRadioValue('month',$department->availability_period);?>>
                            <label for="availability_period_month">Per Month</label>

                        </div>

                    </section>

                    <section class="main-section full-width setting-field-wrapper">

                        <div class="full-width margin-top-30 margin-bottom-30">
                            <h2>Exlude specific dates you are not available</h2>
                            <p>Add specific dates you are not available regardlress the week days selected</p>
                        </div>

                        <div class="full-width flex">
                            <div
                                    class="calendar availability col l6 m6"
                                    data-disabledates="2021-01-04"
                                    data-disabledweekdays=""
                                    data-bookinadvance=""
                                    data-scheduledates="null/2001-01-01"
                            ></div>
                            <div id="excludedDatesDiv" class="col l6 m6">
                                <?php
                                    excludedDatesDisplay($department->excluded_dates);
                                ?>
                            </div>
                            <input type="hidden" name="excluded_dates" id="excluded_dates" value="<?php
                            if (isset($department->excluded_dates)) {
                                echo $department->excluded_dates;
                            }
                            ?>">
                        </div>

                    </section>

                    <?php if( $department->companyObject->meeting_type !== 'department' ): ?>

                        <div class="notice-in-page flex flex-center margin-bottom-30">

                            <div class="content flex flex-center">

                                <div class="icon">

                                    <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                </div>

                                <div class="notice-message">
                                    <strong>Notice: The company administrator does not allow you to set the meeting types.</strong>
                                    <br>You cannot change this setting unless the company administrator allows you to do it.
                                </div>

                            </div>

                        </div>

                    <?php endif; ?>

                    <section class="main-section full-width setting-field-wrapper  <?php echo ( $department->companyObject->meeting_type !== 'department' ? 'disabled' : ''); ?>">

                        <h2>Meeting Type</h2>

                        <p>Define the meeting types that the department will accept for bookings or let each employee of the department define.</p>

                        <div id="meeting_type" class="full-width relative profenda-field">

                            <input type="radio" id="meeting_type_company" class="checkboxradio" name="meeting_types" value="department" <?php displayRadioValue('department',$department->meeting_types);?>>
                            <label for="meeting_type_company">Defined by Department</label>

                            <input type="radio" id="meeting_type_company_department" class="checkboxradio" name="meeting_types" value="user" <?php displayRadioValue('user',$department->meeting_types);?>>
                            <label for="meeting_type_company_department">Let the employees define</label>


                        </div>

                        <div id="meeting_types_available" class="full-width flex margin-top-30 profenda-field <?php echo ( $department->meeting_types !== 'department' ? 'hide' : ''); ?>">

                            <input type="checkbox" id="booking_method_physical_location" class="checkboxradio" name="meeting_types_available[]" value="physical_location" <?php displayCheckboxValue ('physical_location',$department->meeting_types_available);?>>
                            <label for="booking_method_physical_location">One to one</label><br>

                            <input type="checkbox" id="booking_method_phone_call" class="checkboxradio" name="meeting_types_available[]" value="phone_call" <?php displayCheckboxValue ('phone_call',$department->meeting_types_available);?>>
                            <label for="booking_method_phone_call">Phone Call</label><br>

                            <input type="checkbox" id="booking_method_online" class="checkboxradio" name="meeting_types_available[]" value="online" <?php displayCheckboxValue ('online',$department->meeting_types_available);?>>
                            <label for="booking_method_online">Web</label><br>
                        </div>


                    </section>


                    <section class="main-section full-width setting-field-wrapper">

                        <div class="full-width">
                            <h2>Products & Services</h2>
                            <p>Define the products, brands and services for which you want to meet a supplier.</p>
                        </div>

                        <div id="getProducts" class="full-width relative">

                            <input id="getProductsInput" type="text" placeholder="Type to search..">

                            <div class="row flex">
                                <div id="getProductsResults" class="relative col l6 m6"></div>

                                <div class="col l6 m6">
                                    <div id="selectedProducts" class="relative flex">
                                        <?php

                                        if ((!empty($department->selected_products))) {

                                            $selected_products = explode(",", $department->selected_products);

                                            foreach ($selected_products as $selected_product_id) {
                                                $product = get_term_by('ID', $selected_product_id, 'profenda_product_type');
                                                ?>
                                                <div class="product-item product-item-<?php echo $selected_product_id;?>" data-id="<?php echo $selected_product_id;?>"><?php echo $product->name;?></div>
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    <input type="hidden" name="selected_products" id="selectedProductsInput" value="<?php displayInputValue($department->selected_products); ?>">
                                </div>
                            </div>

                        </div>

                        <div id="getBrands" class="full-width relative">

                            <input id="getBrandsInput" type="text" placeholder="Type to search..">

                            <div class="row flex">
                                <div id="getBrandsResults" class="relative col l6 m6"></div>

                                <div class="col l6 m6">
                                    <div id="selectedBrands" class="relative flex">
                                        <?php

                                        if ((!empty($department->selected_brands))) {

                                            $selected_Brands = explode(",", $department->selected_brands);

                                            foreach ($selected_Brands as $selected_brand_id) {
                                                $brand = get_term_by('ID', $selected_brand_id, 'profenda_product_brand');
                                                ?>
                                                <div class="brand-item brand-item-<?php echo $selected_brand_id;?>" data-id="<?php echo $selected_brand_id;?>"><?php echo $brand->name;?></div>
                                                <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                    <input type="hidden" name="selected_brands" id="selectedBrandsInput" value="<?php displayInputValue($department->selected_brands); ?>">
                                </div>
                            </div>

                        </div>

                    </section>

                    <?php if( $department->companyObject->instant_booking !== 'department' ): ?>

                        <div class="notice-in-page flex flex-center margin-bottom-30">

                            <div class="content flex flex-center">

                                <div class="icon">

                                    <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                </div>

                                <div class="notice-message">
                                    <strong>Notice: The company administrator does not allow you to set the instant booking.</strong>
                                    <br>You cannot change this setting unless the company administrator allows you to do it.
                                </div>

                            </div>

                        </div>

                    <?php endif; ?>

                    <section class="main-section full-width setting-field-wrapper  <?php echo ( $department->companyObject->instant_booking !== 'department' ? 'disabled' : ''); ?>">

                        <h2>Instant Booking</h2>

                        <p>Instant booking settings</p>

                        <div id="instant_booking" class="full-width flex profenda-field">

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_accept_specific" class="checkboxradio"  name="instant_booking" value="accept_specific"
                                    <?php echo ( $department->instant_booking === 'accept_specific' ? 'checked' : '');?>>
                                <label for="instant_booking_accept_specific">Accept for specific</label><br>

                            </div>

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_decline" class="checkboxradio"  name="instant_booking" value="decline"
                                    <?php echo ( $department->instant_booking === 'decline' ? 'checked' : '');?>>
                                <label for="instant_booking_decline">Do not accept</label><br>

                            </div>

                            <div class="col no-padding-left">

                                <input type="radio" id="instant_booking_user" class="checkboxradio"  name="instant_booking" value="user"
                                    <?php echo ( $department->instant_booking === 'user' ? 'checked' : '');?>>
                                <label for="instant_booking_user">Let the user define</label><br>

                            </div>


                        </div>

                        <div id="instant_booking_products_brands" class="<?php echo ( $department->instant_booking !== 'accept_specific' ? 'hide' : ''); ?>">

                            <div id="getSpecificProducts" class="full-width relative">
                                <p>Select Specific Products</p>
                                <input id="getSpecificProductsInput" type="text" placeholder="Type to search..">

                                <div class="row flex">
                                    <div id="getSpecificProductsResults" class="relative col l6 m6"></div>

                                    <div class="col l6 m6">
                                        <div id="selectedSpecificProducts" class="relative flex">
                                            <?php

                                            if ((!empty($department->instant_booking_products))) {

                                                $instant_booking_products = explode(",", $department->instant_booking_products);

                                                foreach ($instant_booking_products as $instant_selected_product_id) {
                                                    $instant_product = get_term_by('ID', $instant_selected_product_id, 'profenda_product_type');
                                                    ?>
                                                    <div class="product-item product-item-<?php echo $instant_selected_product_id;?>" data-id="<?php echo $instant_selected_product_id;?>"><?php echo $instant_product->name;?></div>
                                                    <?php

                                                }
                                            }

                                            ?>
                                        </div>
                                        <input type="hidden" name="instant_booking_products" id="selectedSpecificProductsInput" value="<?php echo $department->instant_booking_products; ?>">
                                    </div>
                                </div>

                            </div>

                            <div id="getSpecificBrands" class="full-width relative">
                                <p>Select Specific Brands</p>
                                <input id="getSpecificBrandsInput" type="text" placeholder="Type to search..">

                                <div class="row flex">
                                    <div id="getSpecificBrandsResults" class="relative col l6 m6"></div>

                                    <div class="col l6 m6">
                                        <div id="selectedSpecificBrands" class="relative flex">
                                            <?php

                                            if ((!empty($department->instant_booking_brands))) {

                                                $instant_booking_brands = explode(",", $department->instant_booking_brands);

                                                foreach ($instant_booking_brands as $instant_selected_brand_id) {
                                                    $instant_brand = get_term_by('ID', $instant_selected_brand_id, 'profenda_product_brand');
                                                    ?>
                                                    <div class="brand-item brand-item-<?php echo $instant_selected_brand_id;?>" data-id="<?php echo $instant_selected_brand_id;?>"><?php echo $instant_brand->name;?></div>
                                                    <?php

                                                }
                                            }

                                            ?>
                                        </div>
                                        <input type="hidden" name="instant_booking_brands" id="selectedSpecificBrandsInput" value="<?php echo $department->instant_booking_brands; ?>">
                                    </div>
                                </div>

                            </div>


                        </div>


                    </section>

	                <?php if( $department->companyObject->minimum_notice !== 'minimum_notice_department' ): ?>

                        <div class="notice-in-page flex flex-center margin-bottom-30">

                            <div class="content flex flex-center">

                                <div class="icon">

                                    <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                </div>

                                <div class="notice-message">
                                    <strong>Notice: The company administrator does not allow you to set the minimum notice period.</strong>
                                    <br>You cannot change this setting unless the company administrator allows you to do it.
                                </div>

                            </div>

                        </div>

	                <?php endif; ?>

                    <section class="main-section full-width setting-field-wrapper  <?php echo ( $department->companyObject->minimum_notice !== 'minimum_notice_department' ? 'disabled' : ''); ?>">

                        <h2>Minimum Notice Period</h2>

                        <p>The minimum days notice to book the current user for.</p>

                        <div id="minimum_notice_section" class="full-width relative profenda-field">

                            <input type="radio" id="minimum_notice_in_advance" class="checkboxradio radioChecker" name="minimum_notice" value="minimum_notice_in_advance" <?php displayRadioValue('minimum_notice_in_advance',$department->minimum_notice);?>>
                            <label for="minimum_notice_in_advance">Book an appointment at least xxx days in advance</label>

                            <input type="radio" id="minimum_notice_no_limit" class="checkboxradio" name="minimum_notice" value="minimum_notice_no_limit" <?php displayRadioValue('minimum_notice_no_limit',$department->minimum_notice);?>>
                            <label for="minimum_notice_no_limit">No time limit</label>

                            <input type="radio" id="minimum_notice_user" class="checkboxradio" name="minimum_notice" value="minimum_notice_user" <?php displayRadioValue('minimum_notice_user',$department->minimum_notice);?>>
                            <label for="minimum_notice_user">Let the users define</label>

                        </div>

                        <div id="minimum_notice_hours_field" class="full-width relative margin-top-20 profenda-field radioCheckerOutput">

                            <input name="minimum_notice_hours" id="minimum_notice_hours" class="spinner0" value="<?php displayInputValue($department->minimum_notice_hours);?>">

                        </div>

                    </section>


	                <?php if( $department->companyObject->meeting_repetition !== 'meeting_repetition_department' ): ?>

                        <div class="notice-in-page flex flex-center margin-bottom-30">

                            <div class="content flex flex-center">

                                <div class="icon">

                                    <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                </div>

                                <div class="notice-message">
                                    <strong>Notice: The company administrator does not allow you to set the meeting repetition.</strong>
                                    <br>You cannot change this setting unless the company administrator allows you to do it.
                                </div>

                            </div>

                        </div>

	                <?php endif; ?>

                    <section class="main-section full-width setting-field-wrapper  <?php echo ( $department->companyObject->meeting_repetition !== 'meeting_repetition_department' ? 'disabled' : ''); ?>">

                        <div class="full-width">
                            <h2>Meeting Repetition</h2>
                            <p>Repetition settings.</p>
                        </div>

                        <div id="meeting_repetition_section" class="full-width relative profenda-field">

                            <input type="radio" id="meeting_repetition_limit" class="checkboxradio radioChecker" name="meeting_repetition" value="meeting_repetition_limit"  <?php displayRadioValue('meeting_repetition_limit',$department->meeting_repetition);?>>
                            <label for="meeting_repetition_limit">Do not let the same supplier to visit our company</label>

                            <input type="radio" id="meeting_repetition_no_limit" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_no_limit"  <?php displayRadioValue('meeting_repetition_no_limit',$department->meeting_repetition);?>>
                            <label for="meeting_repetition_no_limit">No time limit</label>

                            <input type="radio" id="meeting_repetition_users" class="checkboxradio" name="meeting_repetition" value="meeting_repetition_users"  <?php displayRadioValue('meeting_repetition_users',$department->meeting_repetition);?>>
                            <label for="meeting_repetition_users">Let the users define</label>

                        </div>

                        <div id="meeting_repetition_time_section" class="full-width relative margin-top-20 profenda-field radioCheckerOutput">

                            <input name="meeting_repetition_time" id="meeting_repetition_time" class="spinner0" value="<?php displayInputValue($department->meeting_repetition_time);?>">

                        </div>

                    </section>


                    <section class="main-section full-width setting-field-wrapper">

                        <h2>Simultaneous Booking</h2>

                        <p>Define the number of simultaneous bookings you can accept for the same datetime.</p>

                        <input name="simultaneous_meetings" id="simultaneous_meetings" class="spinner0" value="<?php displayInputValue($department->simultaneous_meetings);?>">

                    </section>



                    <section class="hide">

                        <div class="col l12 m12 margin-top-30">

                            <table>
                                <tr>
                                    <th>Employee</th>
                                    <th>Department Visible</th>
                                    <th>Department Availability</th>
                                </tr>

                                <?php

                                $employees = $department->users;



                                foreach ($employees as $employee) {

                                    $employeeObj = new \ShippingAppointments\Service\Entities\User\PlatformUser( $employee->data->ID );

//                                echo '<pre>';
//                                print_r($employeeObj);
//                                echo '</pre>';

                                    ?>

                                    <tr>

                                        <td><?php echo $employee->data->display_name;?></td>
                                        <td><?php echo $employeeObj->department_visible;?></td>
                                        <td><?php echo $employeeObj->department_availability;?></td>

                                    </tr>

                                    <?

                                }

                                ?>

                            </table>


                        </div>

                    </section>

                    <section>

                        <div class="col l12 m12 margin-top-30">

                            <button type="submit" class="save-button" name="refresh_action" value="save_dep_settings">Save Settings</button>

                        </div>

                    </section>

                </form>

            </div>



        </div>

    </div>

<?php
