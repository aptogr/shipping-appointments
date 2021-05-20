<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\Appointment;
use ShippingAppointments\Service\Entities\User\PlatformUser;

class DashboardSingleAppointment {

    public $appointment;

    /**
     * DashboardSingleAppointment constructor.
     * @param $appointment Appointment
     */
    public function __construct( Appointment $appointment) {

        $this->appointment = $appointment;
    }



    public function getMethodInfoBox(){

	    ob_start();


	    if( $this->appointment->status === 'confirmed' && !empty( $this->appointment->appointment_method ) ):
        ?>

        <div class="final-meeting-method-block margin-top-50 full-width flex flex-center">

            <?php

                switch( $this->appointment->appointment_method ){

                    case 'physical_location':

	                    $icon       = '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0C161.896,0,85.333,76.563,85.333,170.667c0,28.25,7.063,56.26,20.49,81.104L246.667,506.5c1.875,3.396,5.448,5.5,9.333,5.5s7.458-2.104,9.333-5.5l140.896-254.813c13.375-24.76,20.438-52.771,20.438-81.021C426.667,76.563,350.104,0,256,0z M256,256c-47.052,0-85.333-38.281-85.333-85.333c0-47.052,38.281-85.333,85.333-85.333s85.333,38.281,85.333,85.333C341.333,217.719,303.052,256,256,256z"></path></g></g></svg>';
	                    $title      = 'One to One Meeting';
	                    $btnText    = 'Get Directions';

                        if( $this->appointment->one_to_one_location === 'premises' ){

	                        $value = $this->appointment->companyObject->premises;

                        }
                        else {

	                        $value = $this->appointment->location;

                        }

	                    $link       = "https://www.google.com/maps/?q=$value";

                        break;

                    case 'phone_call':

	                    $icon      = '<svg height="512" viewBox="0 0 58 58" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="003---Call" fill="rgb(0,0,0)" fill-rule="nonzero" transform="translate(-1)"><path id="Shape" d="m25.017 33.983c-5.536-5.536-6.786-11.072-7.068-13.29-.0787994-.6132828.1322481-1.2283144.571-1.664l4.48-4.478c.6590136-.6586066.7759629-1.685024.282-2.475l-7.133-11.076c-.5464837-.87475134-1.6685624-1.19045777-2.591-.729l-11.451 5.393c-.74594117.367308-1.18469338 1.15985405-1.1 1.987.6 5.7 3.085 19.712 16.855 33.483s27.78 16.255 33.483 16.855c.827146.0846934 1.619692-.3540588 1.987-1.1l5.393-11.451c.4597307-.9204474.146114-2.0395184-.725-2.587l-11.076-7.131c-.7895259-.4944789-1.8158967-.3783642-2.475.28l-4.478 4.48c-.4356856.4387519-1.0507172.6497994-1.664.571-2.218-.282-7.754-1.532-13.29-7.068z"></path><path id="Shape" d="m47 31c-1.1045695 0-2-.8954305-2-2-.0093685-8.2803876-6.7196124-14.9906315-15-15-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c10.4886126.0115735 18.9884265 8.5113874 19 19 0 1.1045695-.8954305 2-2 2z"></path><path id="Shape" d="m57 31c-1.1045695 0-2-.8954305-2-2-.0154309-13.800722-11.199278-24.9845691-25-25-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c16.008947.01763587 28.9823641 12.991053 29 29 0 .530433-.2107137 1.0391408-.5857864 1.4142136-.3750728.3750727-.8837806.5857864-1.4142136.5857864z"></path></g></g></svg>';
	                    $title      = 'Phone Call Meeting';
	                    $value      = $this->appointment->phone;
	                    $link       = "tel:".$this->appointment->phone;
	                    $btnText    = 'Call';

                        break;

                    case 'remote_online':

	                    $icon       = '<svg id="bold" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23 17h-22c-.552 0-1 .447-1 1s.448 1 1 1h22c.552 0 1-.447 1-1s-.448-1-1-1z"></path><path d="m10.5 6.25c0 .26.03.51.1.75h-6.6v10h-2v-10c0-1.1.9-2 2-2h6.5z"></path><path d="m22 9.11v7.89h-2v-7.59c.53-.12 1.01-.38 1.4-.73l.5.37c.03.02.06.05.1.06z"></path><circle cx="11" cy="11" r="2"></circle><path d="m15 16.75v.25h-8v-.25c0-1.52 1.23-2.75 2.75-2.75h2.5c1.52 0 2.75 1.23 2.75 2.75z"></path><path d="m23.25 8c-.159 0-.318-.051-.45-.15l-1.816-1.362c-.116.853-.85 1.512-1.734 1.512h-5.5c-.965 0-1.75-.785-1.75-1.75v-4.75c0-.692.458-1.5 1.75-1.5h5.5c.932 0 1.696.732 1.747 1.651l1.773-1.477c.222-.187.534-.227.798-.103s.432.388.432.679v6.5c0 .284-.161.544-.415.671-.106.053-.221.079-.335.079z"></path></svg>';
	                    $title      = 'Web Meeting';
	                    $value      = $this->appointment->web_link;
	                    $link       = $this->appointment->web_link;
	                    $btnText    = 'Open Link';

                        break;

                }

            ?>

            <div class="icon">

                <?php echo $icon; ?>

            </div>

            <div class="info-text">

                <h3>
	                <?php echo $title; ?>
                </h3>

                <div class="method-value">
	                <?php echo $value; ?>
                </div>

            </div>

            <a href="<?php echo $link; ?>" class="profenda-btn margin-left-auto filled">
	            <?php echo $btnText; ?>
            </a>

        </div>

        <?php
        endif;


	    return ob_get_clean();

    }

    public function getAvailableUsers(){
        ob_start();

        $dashboardAppointments  = new DashboardAppointmentsDepartment( $this->appointment->departmentObject );
	    $appointments           = $dashboardAppointments->getDepartmentConfirmedAppointmentsByDate( $this->appointment->date );
        $finalAppointments      = array();

	    foreach( $appointments as $appointment ){

	        if( $appointment !== $this->appointment->ID ){

		        $finalAppointments[] = $appointment;

	        }

	    }

	    var_dump( $finalAppointments );
        ?>

        <select class="assignEmployee" name="employee" id="assignEmployee">
            <?php

            foreach ($this->appointment->departmentObject->users as $user) {

                echo '<option value="'.$user->data->ID.'">';
                echo $user->data->display_name;
                echo '</option>';

            }

            ?>
        </select>

        <?php
        return ob_get_clean();
    }

    public function getEditForm(){

        ob_start();
        ?>

        <form method="post">

            <input type="hidden" name="refresh_action" value="update_appointment">
            <input type="hidden" name="appointmentID" value="<?php echo $this->appointment->ID; ?>">

            <div class="flex flex-center full-width">

                <div class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m391 123v-33h30c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-330c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h30v33c0 67.604 49.952 123.758 114.884 133.5-65.071 9.763-114.884 66.052-114.884 133.5v32h-30c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h330c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-30v-32c0-67.394-49.759-123.729-114.884-133.5 64.932-9.742 114.884-65.896 114.884-133.5zm-285-93h300v30h-300zm255 60c-1.252 23.881 4.151 46.344-9.215 76h-191.57c-13.425-29.788-7.944-51.775-9.215-76zm45 392h-300v-30h300zm-255-60c.277-28.476-.734-35.29 1.217-48h73.783c11.187 0 21.746-4.057 30.002-11.476 7.974 7.132 18.493 11.476 29.998 11.476h73.783c.801 5.218 1.217 10.561 1.217 16v32zm199.372-78h-64.372c-8.285 0-15.036-6.74-15.05-15.025-.014-8.276-6.727-14.975-14.999-14.975-.009 0-.018 0-.025 0-8.284.014-14.989 6.74-14.976 15.025.014 8.272-6.677 14.975-14.95 14.975h-64.372c38.408-78.477 150.262-78.629 188.744 0zm-169.767-148h150.789c-41.312 42.655-109.448 42.684-150.789 0z"/></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Duration:</span>


                            <div class="input-field no-margin-right margin-left-auto">
                                <input type="text" name="duration" class="spinner1" value="<?php echo ( !empty( $this->appointment->duration) ? $this->appointment->duration : 20); ?>">
                            </div>

                        </div>

                    </div>

                </div>


                <div class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M458.406,380.681c-8.863-6.593-21.391-4.752-27.984,4.109c-3.626,4.874-7.506,9.655-11.533,14.21c-7.315,8.275-6.538,20.915,1.737,28.231c3.806,3.364,8.531,5.016,13.239,5.016c5.532,0,11.04-2.283,14.992-6.754c4.769-5.394,9.364-11.056,13.658-16.829C469.108,399.803,467.269,387.273,458.406,380.681z"></path><path d="M491.854,286.886c-10.786-2.349-21.447,4.496-23.796,15.288c-1.293,5.937-2.855,11.885-4.646,17.681c-3.261,10.554,2.651,21.752,13.204,25.013c1.967,0.607,3.955,0.896,5.911,0.896c8.54,0,16.448-5.514,19.102-14.102c2.126-6.878,3.98-13.937,5.514-20.98C509.492,299.89,502.647,289.236,491.854,286.886z"></path><path d="M362.139,444.734c-5.31,2.964-10.808,5.734-16.34,8.233c-10.067,4.546-14.542,16.392-9.996,26.459c3.34,7.396,10.619,11.773,18.239,11.773c2.752,0,5.549-0.571,8.22-1.777c6.563-2.964,13.081-6.249,19.377-9.764c9.645-5.384,13.098-17.568,7.712-27.212C383.968,442.803,371.784,439.35,362.139,444.734z"></path><path d="M236,96v151.716l-73.339,73.338c-7.81,7.811-7.81,20.474,0,28.284c3.906,3.906,9.023,5.858,14.143,5.858c5.118,0,10.237-1.953,14.143-5.858l79.196-79.196c3.75-3.75,5.857-8.838,5.857-14.142V96c0-11.046-8.954-20-20-20C244.954,76,236,84.954,236,96z"></path><path d="M492,43c-11.046,0-20,8.954-20,20v55.536C425.448,45.528,344.151,0,256,0C187.62,0,123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512c0.169,0,0.332-0.021,0.5-0.025c0.168,0.004,0.331,0.025,0.5,0.025c7.208,0,14.487-0.304,21.637-0.902c11.007-0.922,19.183-10.592,18.262-21.599c-0.923-11.007-10.58-19.187-21.6-18.261C269.255,471.743,263.099,472,257,472c-0.169,0-0.332,0.021-0.5,0.025c-0.168-0.004-0.331-0.025-0.5-0.025c-119.103,0-216-96.897-216-216S136.897,40,256,40c76.758,0,147.357,40.913,185.936,106h-54.993c-11.046,0-20,8.954-20,20s8.954,20,20,20H448c12.18,0,23.575-3.423,33.277-9.353c0.624-0.356,1.224-0.739,1.796-1.152C500.479,164.044,512,144.347,512,122V63C512,51.954,503.046,43,492,43z"></path></g></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Buffer:</span>
                            <div class="input-field margin-left-auto no-margin-right">
                                <input type="text" name="buffer" class="spinner1" value="<?php echo ( !empty( $this->appointment->buffer) ? $this->appointment->buffer : 10); ?>">
                            </div>

                        </div>

                    </div>

                </div>

                <div class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M421.054,414.843c-4.142,0-7.5,3.358-7.5,7.5v70.514c0,2.283-1.858,4.141-4.141,4.141h-40.317V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-81.185l23.543-25.9c2.572-2.83,3.785-6.861,3.244-10.787c-0.01-0.076-0.022-0.152-0.035-0.228L277.24,327.617l6.041-9.094c3.34,2.372,5.913,4.656,10.738,4.656c4.908,0,9.497-2.747,11.755-7.269v-0.001l23.65-47.4l53.876,20.865c1.949,0.836,30.252,13.582,30.252,47.238v50.73c-0.001,4.141,3.357,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-50.73c0-44.344-37.969-60.463-39.585-61.128c-0.047-0.02-0.095-0.039-0.143-0.057l-89.668-34.726v-21.03c14.242-11.076,24.117-27.495,26.596-46.227c7.101-0.5,13.69-3.152,19.071-7.779c7.027-6.043,11.059-14.838,11.059-24.126c0-7.708-2.781-15.068-7.737-20.803V92.953C348.144,41.699,306.446,0,255.192,0c-51.254,0-92.952,41.699-92.952,92.953v28.511c-5.009,5.677-7.733,12.665-7.733,20.074c0,9.291,4.03,18.085,11.059,24.129c5.377,4.625,11.962,7.274,19.061,7.775c2.499,19.083,12.662,36.114,28.117,47.339v19.92l-89.571,34.725c-0.047,0.018-0.094,0.037-0.141,0.056c-1.617,0.665-39.585,16.784-39.585,61.128v156.245c0,10.555,8.587,19.142,19.142,19.142h71.457c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5h-16.137V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-40.319c-2.283,0-4.141-1.858-4.141-4.141V336.611c0-33.769,28.493-46.486,30.243-47.234l53.834-20.87l23.652,47.402c2.263,4.533,6.858,7.27,11.756,7.27c4.801,0,7.349-2.249,10.738-4.656l6.041,9.094l-22.421,132.468c-0.013,0.075-0.024,0.15-0.035,0.226c-0.542,3.924,0.671,7.957,3.244,10.789l23.543,25.9h-29.995c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h200.365c10.555,0,19.142-8.588,19.142-19.142v-70.514C428.554,418.201,425.196,414.843,421.054,414.843z M315.375,263.069l-22.049,44.19c-0.548-0.389-12.233-8.691-26.517-18.834c6.198-7.651-1.053,1.299,27.235-33.617L315.375,263.069z M271.043,309.833l-5.718,8.607h-18.703l-5.718-8.607l15.07-10.703L271.043,309.833z M227.743,243.121v-14.036c9.112,3.673,18.85,5.376,28.36,5.376c9.833,0,19.476-2.096,28.052-5.846v14.567l-28.181,34.785L227.743,243.121z M340.881,141.539c-0.001,4.913-2.129,9.562-5.839,12.753c-2.453,2.11-5.416,3.459-8.661,3.987v-33.477C335.001,126.202,340.881,133.352,340.881,141.539z M184.007,158.279c-8.718-1.415-14.5-8.623-14.5-16.741c0-8.018,6.647-14.544,14.5-16.359V158.279z M184.41,109.896c-2.389,0.274-5.127,0.921-7.168,1.615V92.953c0-42.983,34.968-77.952,77.951-77.952c42.983,0,77.951,34.969,77.951,77.952v18.043c-2.18-0.663-4.441-1.101-6.762-1.307c0-7.237,0.063-5.841-23.612-31.294c-4.354-4.678-11.556-5.658-17.037-2.077c-26.13,17.069-58.005,25.644-87.415,23.532C191.867,99.367,185.991,103.616,184.41,109.896z M199.008,164.184v-46.792v-2.465c32.375,1.896,66.318-7.722,93.739-25.283c10.858,11.658,16.738,17.773,18.634,20.099c0,5.884,0,47.705,0,54.44c0,30.447-24.826,55.276-55.277,55.276C221.91,219.46,199.008,192.934,199.008,164.184z M218.623,307.259l-22.049-44.19l21.293-8.247l27.241,33.625C231.255,298.284,219.88,306.366,218.623,307.259z M227.228,461.702l21.709-128.263h14.071l21.709,128.263l-28.744,31.623L227.228,461.702z"></path></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Assign Employee:</span>


                            <div class="input-field no-margin-right margin-left-auto">
                                <?php
                                   echo $this->getAvailableUsers();
                                ?>
                            </div>

                        </div>

                    </div>

                </div>

                <div id="meetingType" class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M406,241c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C481,274.647,447.353,241,406,241z"></path></g></g><g><g><path d="M479.251,391c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C313.217,410.08,301,436.608,301,466v31c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-31C512,436.608,498.783,410.08,479.251,391z"></path></g></g><g><g><path d="M106,0C64.647,0,31,34.647,31,76c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C181,34.647,147.353,0,106,0z"></path></g></g><g><g><path d="M179.251,151c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C13.217,170.08,0,196.608,0,226v30c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-30C211,196.608,198.783,170.08,179.251,151z"></path></g></g><g><g><path d="M256,61c-15.621,0-30.95,2.278-45.919,5.903C210.348,69.95,211,72.885,211,76c0,7.551-0.883,14.886-2.404,21.989C223.874,93.415,239.81,91,256,91c75.688,0,139.473,51.292,158.833,120.894c11.459,0.974,22.513,3.347,32.635,7.72C430.359,129.441,351.074,61,256,61z"></path></g></g><g><g><path d="M256,421c-75.366,0-138.95-50.85-158.604-120H66.451C86.847,386.864,163.99,451,256,451c5.574,0,11.083-0.379,16.577-0.839c1.262-10.704,3.571-21.114,7.293-31.077C272.009,420.222,264.073,421,256,421z"></path></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Meeting Type:</span>

                            <div class="input-field margin-left-auto no-margin-right">

						        <?php

						        $availableMeetingTypes = $this->getAvailableMeetingTypes();

						        ?>

                                <div class="flex full-width simple-radio">

                                    <div class="radio-item">

                                        <input id="one_to_one" type="radio" value="physical_location" name="appointment_method" <?php echo ( $this->appointment->appointment_method === 'physical_location' ? 'checked' : ''); ?>>

                                        <label for="one_to_one" class="flex-grow flex flex-center <?php echo ( $this->appointment->appointment_method === 'physical_location' ? 'selected' : ''); ?> <?php echo ( !in_array('one_to_one', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">
                                            One to One Meeting <?php echo ( !in_array('one_to_one', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                                        </label>

                                    </div>

                                    <div class="radio-item">

                                        <input id="phone" type="radio" value="phone_call" name="appointment_method" <?php echo ( $this->appointment->appointment_method === 'phone_call' ? 'checked' : ''); ?>>


                                        <label for="phone" class="flex-grow flex flex-center <?php echo ( $this->appointment->appointment_method === 'phone_call' ? 'selected' : ''); ?> <?php echo ( !in_array('phone', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">
                                            Phone Meeting <?php echo ( !in_array('phone', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                                        </label>

                                    </div>

                                    <div class="radio-item">

                                        <input id="web" type="radio" value="remote_online" name="appointment_method" <?php echo ( $this->appointment->appointment_method === 'remote_online' ? 'checked' : ''); ?>>

                                        <label for="web" class="flex-grow flex flex-center no-margin-right <?php echo ( $this->appointment->appointment_method === 'remote_online' ? 'selected' : ''); ?> <?php echo ( !in_array('web', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">
                                            Web Meeting <?php echo ( !in_array('web', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                                        </label>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div id="locationType" class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0C161.896,0,85.333,76.563,85.333,170.667c0,28.25,7.063,56.26,20.49,81.104L246.667,506.5c1.875,3.396,5.448,5.5,9.333,5.5s7.458-2.104,9.333-5.5l140.896-254.813c13.375-24.76,20.438-52.771,20.438-81.021C426.667,76.563,350.104,0,256,0z M256,256c-47.052,0-85.333-38.281-85.333-85.333c0-47.052,38.281-85.333,85.333-85.333s85.333,38.281,85.333,85.333C341.333,217.719,303.052,256,256,256z"/></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Location Type:</span>

                            <div class="input-field margin-left-auto no-margin-right">


                                <div class="flex full-width simple-radio">

                                    <div class="radio-item">

                                        <input id="premises" class="one_to_one_location" type="radio" value="premises" name="one_to_one_location" <?php echo ( $this->appointment->one_to_one_location === 'premises' ? 'checked' : ''); ?>>

                                        <label for="premises" class="flex-grow flex flex-center <?php echo ( $this->appointment->one_to_one_location === 'premises' ? 'selected' : ''); ?>">

                                            Company Premises

                                        </label>

                                    </div>

                                    <div class="radio-item">

                                        <input id="otherLocation" class="one_to_one_location" type="radio" value="other" name="one_to_one_location" <?php echo ( $this->appointment->one_to_one_location === 'other' ? 'checked' : ''); ?>>

                                        <label for="otherLocation" class="flex-grow flex flex-center <?php echo ( $this->appointment->one_to_one_location === 'other' ? 'selected' : ''); ?>">

                                            Another Location

                                        </label>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div id="locationAddress" class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.01 512.01" style="enable-background:new 0 0 512.01 512.01;" xml:space="preserve"><g transform="translate(0 -1)"><g><g><path d="M388.89,314.055c-11.435-2.773-22.955,4.373-25.664,15.829c-2.731,11.456,4.373,22.955,15.829,25.664c66.261,15.723,90.283,38.976,90.283,50.795c0,25.493-85.077,64-213.333,64c-128.235,0-213.333-38.507-213.333-64c0-11.819,24.043-35.072,90.261-50.795c11.477-2.709,18.56-14.208,15.829-25.664c-2.709-11.456-14.229-18.603-25.664-15.829C43.717,332.871,0.005,365.639,0.005,406.343c0,70.016,128.811,106.667,256,106.667c127.211,0,256-36.651,256-106.667C512.005,365.639,468.293,332.871,388.89,314.055z"/><path d="M256.015,171.681c11.776,0,21.333-9.557,21.333-21.333s-9.557-21.333-21.333-21.333s-21.333,9.557-21.333,21.333S244.239,171.681,256.015,171.681z"/><path d="M228.239,398.518l8.683,17.365c3.627,7.232,11.008,11.797,19.093,11.797s15.467-4.565,19.093-11.797l18.389-36.779c22.379-44.779,49.984-88.149,76.672-130.091l12.16-19.136c15.061-23.808,23.019-51.307,23.019-79.531c0-42.496-18.197-83.115-49.92-111.445C323.727,10.592,281.082-2.975,238.565,2.017C172.175,9.569,117.349,63.03,108.154,129.121c-5.44,39.168,4.352,78.059,27.541,109.547C171.877,287.691,200.122,342.241,228.239,398.518z M256.015,86.347c35.285,0,64,28.715,64,64c0,35.285-28.715,64-64,64s-64-28.715-64-64C192.015,115.062,220.73,86.347,256.015,86.347z"/></g></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Location Address:</span>
                            <div class="input-field margin-left-auto no-margin-right">
                                <input type="text" name="location" value="<?php echo $this->appointment->location; ?>">
                            </div>

                        </div>

                    </div>

                </div>

                <div id="phoneNumber" class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg height="512" viewBox="0 0 58 58" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="003---Call" fill="rgb(0,0,0)" fill-rule="nonzero" transform="translate(-1)"><path id="Shape" d="m25.017 33.983c-5.536-5.536-6.786-11.072-7.068-13.29-.0787994-.6132828.1322481-1.2283144.571-1.664l4.48-4.478c.6590136-.6586066.7759629-1.685024.282-2.475l-7.133-11.076c-.5464837-.87475134-1.6685624-1.19045777-2.591-.729l-11.451 5.393c-.74594117.367308-1.18469338 1.15985405-1.1 1.987.6 5.7 3.085 19.712 16.855 33.483s27.78 16.255 33.483 16.855c.827146.0846934 1.619692-.3540588 1.987-1.1l5.393-11.451c.4597307-.9204474.146114-2.0395184-.725-2.587l-11.076-7.131c-.7895259-.4944789-1.8158967-.3783642-2.475.28l-4.478 4.48c-.4356856.4387519-1.0507172.6497994-1.664.571-2.218-.282-7.754-1.532-13.29-7.068z"></path><path id="Shape" d="m47 31c-1.1045695 0-2-.8954305-2-2-.0093685-8.2803876-6.7196124-14.9906315-15-15-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c10.4886126.0115735 18.9884265 8.5113874 19 19 0 1.1045695-.8954305 2-2 2z"></path><path id="Shape" d="m57 31c-1.1045695 0-2-.8954305-2-2-.0154309-13.800722-11.199278-24.9845691-25-25-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c16.008947.01763587 28.9823641 12.991053 29 29 0 .530433-.2107137 1.0391408-.5857864 1.4142136-.3750728.3750727-.8837806.5857864-1.4142136.5857864z"></path></g></g></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Phone Number:</span>
                            <div class="input-field margin-left-auto no-margin-right">
                                <input type="text" name="phone" class="spinner1" value="<?php echo $this->appointment->phone; ?>">
                            </div>

                        </div>

                    </div>

                </div>

                <div id="webLink" class="flex flex-center appointment-item-info">

                    <div class="icon">

                        <svg id="bold" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23 17h-22c-.552 0-1 .447-1 1s.448 1 1 1h22c.552 0 1-.447 1-1s-.448-1-1-1z"></path><path d="m10.5 6.25c0 .26.03.51.1.75h-6.6v10h-2v-10c0-1.1.9-2 2-2h6.5z"></path><path d="m22 9.11v7.89h-2v-7.59c.53-.12 1.01-.38 1.4-.73l.5.37c.03.02.06.05.1.06z"></path><circle cx="11" cy="11" r="2"></circle><path d="m15 16.75v.25h-8v-.25c0-1.52 1.23-2.75 2.75-2.75h2.5c1.52 0 2.75 1.23 2.75 2.75z"></path><path d="m23.25 8c-.159 0-.318-.051-.45-.15l-1.816-1.362c-.116.853-.85 1.512-1.734 1.512h-5.5c-.965 0-1.75-.785-1.75-1.75v-4.75c0-.692.458-1.5 1.75-1.5h5.5c.932 0 1.696.732 1.747 1.651l1.773-1.477c.222-.187.534-.227.798-.103s.432.388.432.679v6.5c0 .284-.161.544-.415.671-.106.053-.221.079-.335.079z"></path></svg>

                    </div>

                    <div class="appointment-item--appointment">

                        <div class="appointment-item--time font-weight-700 full-width flex flex-center">
                            <span class="font-weight-400">Web Link:</span>
                            <div class="input-field margin-left-auto no-margin-right">
                                <input type="text" name="web_link" value="">
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col s12 no-padding-left padding-top-30">

                    <button type="submit" name="refresh_action" value="update_appointment" class="profenda-btn filled">
                        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.13 512.13" xml:space="preserve"><g><g><path d="M256.065,0C114.43,0,0,114.298,0,256.065S114.298,512.13,256.065,512.13S512.13,397.832,512.13,256.065S397.702,0,256.065,0z M256.065,477.892c-122.891,0-221.828-98.937-221.828-221.828S133.175,34.236,256.065,34.236s221.828,98.937,221.828,221.828S378.956,477.892,256.065,477.892z"></path></g></g><g><g><path d="M378.956,180.952c-6.769-6.771-17.054-6.771-23.953-0.001L223.651,312.304l-66.523-66.522c-6.769-6.769-17.054-6.769-23.953,0c-6.769,6.769-6.769,17.053,0,23.953l78.498,78.498c3.385,3.385,6.769,5.077,11.977,5.077c5.077,0,8.592-1.692,11.977-5.077l143.329-143.328C385.725,198.136,385.725,187.853,378.956,180.952z"></path></g></g></svg>
                        Save Appointment Details
                    </button>

                </div>

            </div>

        </form>

        <?php

        return ob_get_clean();

    }


	private function mapMeetingTypes( $meetingTypes ): array {

		$mapped = array();

		$mapping = array(
			'physical_location'    => 'one_to_one',
			'phone_call'           => 'phone',
			'online'               => 'web',
		);

		foreach( $meetingTypes as $type ){

			if( isset( $mapping[ $type ] ) ){

				$mapped[] = $mapping[ $type ];

			}

		}

		return $mapped;

	}

	private function getAvailableMeetingTypes(): array {

		if( $this->appointment->companyObject->meeting_type === 'company' ){

			return $this->mapMeetingTypes( $this->appointment->companyObject->meeting_types_available );

		}
		else {

			if( $this->appointment->departmentObject->meeting_types === 'department' ){

				return $this->mapMeetingTypes( $this->appointment->departmentObject->meeting_types_available );

			}
			else {

				return $this->mapMeetingTypes(  $this->appointment->employeeUser->booking_method );

			}

		}

	}

}
