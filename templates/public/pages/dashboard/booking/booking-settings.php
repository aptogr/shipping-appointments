<?php
get_header();

$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );



function displayInputValue ($value) {
    echo (!empty($value)) ? $value : "" ;
}

function displayRadioValue ($id,$value) {
    echo ($id == $value) ? 'checked' : "" ;
}

function displayCheckboxValue ($id,$value) {
    echo (in_array($id,$value)) ? 'checked' : "" ;
}

?>
    <div class="row booking-settings no-margin-bottom full-width">

       <div class="container">

           <div class="col s12">

               <form action="" method="post">

                   <div class="col l12 m12">

                       <section class="main-section full-width">

                           <h1>Booking Settings</h1>

                           <p>Set up your booking settings.</p>

                       </section>

                       <section class="main-section full-width setting-field-wrapper <?php echo ( $platformUser->department->users_visibility !== 'department_users_department' ? 'disabled' : ''); ?>">

                           <div class="full-width">
                               <h2>Visibility</h2>
                               <!--                            <p>Select if the department's employees will be visible to the suppliers.</p>-->
                           </div>

                           <div id="department_users_visibility_section" class="full-width relative profenda-field">

                               <input type="radio" id="visibile_yes" class="checkboxradio" name="visible" value="user_visibile" <?php displayRadioValue('user_visibile',$platformUser->visible);?>>
                               <label for="visibile_yes">Yes</label>

                               <input type="radio" id="visibile_no" class="checkboxradio" name="visible" value="user_not_visibile" <?php displayRadioValue('user_not_visibile',$platformUser->visible);?>>
                               <label for="visibile_no">No</label>

                           </div>

                       </section>

                       <section class="main-section full-width setting-field-wrapper <?php echo ( $platformUser->department->meeting_types !== 'user' ? 'disabled' : ''); ?>">

                           <h2>Booking Methods</h2>

                           <p>Select your booking methods.</p>

                           <div class="full-width flex profenda-field">

                               <div class="col no-padding-left">

                                   <input type="checkbox" id="booking_method_physical_location" class="checkboxradio"  name="booking_method[]" value="physical_location" <?php displayCheckboxValue ('physical_location',$platformUser->booking_method);?>>
                                   <label for="booking_method_physical_location">Physical Location</label><br>

                               </div>

                               <div class="col no-padding-left">

                                   <input type="checkbox" id="booking_method_phone_call" class="checkboxradio"  name="booking_method[]" value="phone_call" <?php displayCheckboxValue ('phone_call',$platformUser->booking_method);?>>
                                   <label for="booking_method_phone_call">Phone Call</label><br>

                               </div>

                               <div class="col no-padding-left">

                                   <input type="checkbox" id="booking_method_online" class="checkboxradio"  name="booking_method[]" value="online" <?php displayCheckboxValue ('online',$platformUser->booking_method);?>>
                                   <label for="booking_method_online">Online</label><br>

                               </div>

                           </div>

                       </section>

                       <section class="main-section full-width setting-field-wrapper">


                           <div class="full-width">
                               <h2>Products</h2>
                               <p>Select your products.</p>
                           </div>

                           <div id="getProducts" class="full-width relative">

                               <input id="getProductsInput" type="text" placeholder="Type to search..">

                               <div class="row flex">
                                   <div id="getProductsResults" class="relative col l6 m6"></div>

                                   <div class="col l6 m6">
                                       <div id="selectedProducts" class="relative flex">
									       <?php


									       if ((!empty($platformUser->selected_products))) {

										       $selected_products = explode(",", $platformUser->selected_products);

										       foreach ($selected_products as $selected_product_id) {
											       $product = get_term_by('ID', $selected_product_id, 'profenda_product_type');
											       ?>
                                                   <div class="product-item product-item-<?php echo $selected_product_id;?>" data-id="<?php echo $selected_product_id;?>"><?php echo $product->name;?></div>
											       <?php

										       }
									       }

									       ?>
                                       </div>
                                       <input type="hidden" name="selected_products" id="selectedProductsInput" value="<?php displayInputValue($platformUser->selected_products); ?>">
                                   </div>
                               </div>

                           </div>


                       </section>

                       <section class="main-section full-width setting-field-wrapper">


                           <div class="full-width">
                               <h2>Brands</h2>
                               <p>Select your Brands.</p>
                           </div>

                           <div id="getBrands" class="full-width relative">

                               <input id="getBrandsInput" type="text" placeholder="Type to search..">

                               <div class="row flex">
                                   <div id="getBrandsResults" class="relative col l6 m6"></div>

                                   <div class="col l6 m6">
                                       <div id="selectedBrands" class="relative flex">
									       <?php

									       if ((!empty($platformUser->selected_brands))) {

										       $selected_Brands = explode(",", $platformUser->selected_brands);

										       foreach ($selected_Brands as $selected_brand_id) {
											       $brand = get_term_by('ID', $selected_brand_id, 'profenda_product_brand');
											       ?>
                                                   <div class="brand-item brand-item-<?php echo $selected_brand_id;?>" data-id="<?php echo $selected_brand_id;?>"><?php echo $brand->name;?></div>
											       <?php

										       }
									       }

									       ?>
                                       </div>
                                       <input type="hidden" name="selected_brands" id="selectedBrandsInput" value="<?php displayInputValue($platformUser->selected_brands); ?>">
                                   </div>
                               </div>

                           </div>


                       </section>

                       <section class="main-section full-width setting-field-wrapper">

                           <h2>Book in advance days</h2>

                           <p>The minimum days notice to book the current user for.</p>

                           <div id="minimum_notice_section" class="full-width relative profenda-field">

                               <input type="radio" id="minimum_notice_in_advance" class="checkboxradio radioChecker" name="minimum_notice" value="minimum_notice_in_advance" <?php displayRadioValue('minimum_notice_in_advance',$platformUser->minimum_notice);?>>
                               <label for="minimum_notice_in_advance">Book an appointment at least xxx days in advance</label>

                               <input type="radio" id="minimum_notice_no_limit" class="checkboxradio" name="minimum_notice" value="minimum_notice_no_limit" <?php displayRadioValue('minimum_notice_no_limit',$platformUser->minimum_notice);?>>
                               <label for="minimum_notice_no_limit">No time limit</label>


                           </div>

                           <input name="book_in_advance_days" id="book_in_advance_days" class="spinner0" value="<?php displayInputValue($platformUser->book_in_advance_days);?>">

                       </section>

                       <section class="main-section full-width setting-field-wrapper">

                           <h2>Meeting Time Duration</h2>

                           <p>Timeframe of the meeting in minutes (ex.30)</p>

                           <input name="meeting_duration" id="meeting_duration" class="spinner15" value="<?php displayInputValue($platformUser->meeting_duration);?>">

                       </section>


                       <section class="main-section full-width setting-field-wrapper">

                           <h2>Meeting Time Buffer</h2>

                           <p>Buffer duration (in minutes) before and after meetings</p>

                           <input name="meeting_buffer" id="meeting_buffer" class="spinner15" value="<?php displayInputValue($platformUser->meeting_buffer);?>">

                       </section>


                       <section class="main-section full-width setting-field-wrapper">

                           <h2>Max meetings per day</h2>

                           <p>The maximum meetings the current user can be booked for.</p>

                           <input name="max_meetings_per_day" id="max_meetings_per_day" class="spinner0" value="<?php displayInputValue($platformUser->max_meetings_per_day);?>">

                       </section>



                       <section class="main-section full-width setting-field-wrapper">

                           <h2>Booking request type</h2>

                           <p>The way the booking requests are made. Email or instant booking</p>

                           <div class="full-width flex">

                               <div class="col no-padding-left">

                                   <input type="radio" id="booking_request_type_email" class="checkboxradio"  name="booking_request_type" value="email" <?php displayRadioValue('email',$platformUser->booking_request_type);?>>
                                   <label for="booking_request_type_email">Ask via Email first</label><br>

                               </div>

                               <div class="col no-padding-left">

                                   <input type="radio" id="booking_request_type_instant" class="checkboxradio"  name="booking_request_type" value="instant" <?php displayRadioValue('instant',$platformUser->booking_request_type);?>>
                                   <label for="booking_request_type_instant">Instant Booking</label><br>

                               </div>

                           </div>

                       </section>


                       <section class="main-section full-width setting-field-wrapper">

                           <h2>How many times to meet same supplier</h2>

                           <p>The maximum number of times the user can meet a supplier</p>

                           <input name="meet_same_supplier_times" id="meet_same_supplier_times" class="spinner0" value="<?php displayInputValue($platformUser->meet_same_supplier_times);?>">

                       </section>


                   </div>
                   <div class="col l12 m12">
                       <section class="main-section full-width setting-field-wrapper">
                           <button type="submit" class="saveBooking save-button" name="refresh_action" value="save_booking_settings">SAVE</button>
                       </section>
                   </div>

               </form>

           </div>

       </div>

    </div>

<?php

get_footer();
