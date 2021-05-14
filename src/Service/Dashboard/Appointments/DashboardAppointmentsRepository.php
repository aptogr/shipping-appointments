<?php


namespace ShippingAppointments\Service\Dashboard\Appointments;


use ShippingAppointments\Service\Entities\Appointment;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;
use WP_Query;

class DashboardAppointmentsRepository {

	public $postType;
	public $postMetaSlugs;
	public $shippingCompany;
	public $department;
	public $employeeUser;
	public $supplierCompany;

	/**
	 * DashboardPosts constructor.
	 */
	public function __construct(){

		$this->postType         = AppointmentPost::POST_TYPE_NAME;
		$this->postMetaSlugs    = AppointmentPost::META_FIELDS_SLUG;

	}

	protected function shippingCompanyConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['company'],
			'value'   => $this->shippingCompany->ID,
			'compare' => '=',
		);

	}

	protected function departmentConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['department'],
			'value'   => $this->department->ID,
			'compare' => '=',
		);

	}

	protected function supplierCompanyConditionArgs(){

		return array(
			'key'     => $this->postMetaSlugs['supplier_company'],
			'value'   => $this->supplierCompany->ID,
			'compare' => '=',
		);

	}

	protected function userConditionArgs(){

		return  array(
			'relation' => 'OR',
			array(
				'key'     => $this->postMetaSlugs['employee'],
				'value'   => $this->employeeUser->ID,
				'compare' => '=',
			),
			array(
				'key'     => $this->postMetaSlugs['supplier_employee'],
				'value'   => $this->employeeUser->ID,
				'compare' => '=',
			),
		);

	}

	protected function dateConditionArgs( $compare ){

		return array(
			'key'     => $this->postMetaSlugs['date'],
			'value'   => date('Y-m-d'),
			'compare' => $compare,
		);

	}

	protected function specificDateConditionArgs( $date ){

		return array(
			'key'     => $this->postMetaSlugs['date'],
			'value'   => $date,
			'compare' => '=',
		);

	}

	protected function statusConditionsArgs( $statuses ){

		if( count( $statuses ) > 1 ){

			$args = array(
				'relation' => 'OR',
			);

			foreach( $statuses as $status ){

				$args[] = array(
					'key'     => $this->postMetaSlugs['status'],
					'value'   => $status,
					'compare' => '=',
				);

			}

			return $args;

		}
		else {

			return array(
				'key'     => $this->postMetaSlugs['status'],
				'value'   => $statuses[0],
				'compare' => '=',
			);

		}

	}

	protected function getPosts( $metaQuery ){

		$args = array(
			'post_type'         => $this->postType,
			'posts_per_page'    => -1,
			'meta_key'          => $this->postMetaSlugs['date'],
			'orderby'           => 'meta_value',
			'meta_type'         => 'DATE',
			'order'             => 'DESC',
			'meta_query'        => $metaQuery,
		);

		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {

			$ids = array();

			while ( $query->have_posts() ) {
				$query->the_post();
				$ids[] = get_the_ID();
			}

		}
		else {
			$ids = false;
		}

		// Restore original Post Data
		wp_reset_query();
		wp_reset_postdata();

		return $ids;

	}

	public function displayAppointments( $appointments ){

		?>

		<?php if( !empty( $appointments ) ): ?>

			<div class="appointments-list margin-top-30">

				<?php foreach( $appointments as $post_id ): $appointment = new Appointment( $post_id );

                    $this->displayListItem($appointment);

                endforeach ; ?>

			</div>

		<?php endif; ?>

		<?php

	}

	public function displayListItem($appointment) {
	    ?>

        <div class="appointment-list-item single-appointment-block margin-bottom-30">

            <div class="single-appointment-block--header">
                <h3 class="flex flex-center full-width">
                    #<?php echo $appointment->ID; ?>
                    <div class="margin-left-auto status <?php echo $appointment->status; ?>">
                        <?php echo $appointment->getFieldToString('status'); ?>
                    </div>
                </h3>
            </div>
            <div class="single-appointment-block--content no-border">

                <div class="flex flex-center full-width">

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">
                            <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><g><circle cx="386" cy="210" r="20"></circle><path d="M432,40h-26V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-91V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-90V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v20H80C35.888,40,0,75.888,0,120v312c0,44.112,35.888,80,80,80h153c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H80c-22.056,0-40-17.944-40-40V120c0-22.056,17.944-40,40-40h25v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h90v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h91v20c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80h26c22.056,0,40,17.944,40,40v114c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V120C512,75.888,476.112,40,432,40z"></path><path d="M391,270c-66.72,0-121,54.28-121,121s54.28,121,121,121s121-54.28,121-121S457.72,270,391,270z M391,472c-44.663,0-81-36.336-81-81s36.337-81,81-81c44.663,0,81,36.336,81,81S435.663,472,391,472z"></path><path d="M420,371h-9v-21c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v41c0,11.046,8.954,20,20,20h29c11.046,0,20-8.954,20-20C440,379.954,431.046,371,420,371z"></path><circle cx="299" cy="210" r="20"></circle><circle cx="212" cy="297" r="20"></circle><circle cx="125" cy="210" r="20"></circle><circle cx="125" cy="297" r="20"></circle><circle cx="125" cy="384" r="20"></circle><circle cx="212" cy="384" r="20"></circle><circle cx="212" cy="210" r="20"></circle></g></g></g></svg>
                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--date font-weight-700 ">
                                <span class="font-weight-400">Date:</span>
                                <?php echo $appointment->getDisplayDate(); ?>
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">

                            <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952C357.766,320.208,355.981,307.775,347.216,301.211z"></path></g></g><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341S375.275,472.341,256,472.341z"></path></g></g></svg>

                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--time font-weight-700 ">
                                <span class="font-weight-400">Time:</span>
                                <?php echo $appointment->time; ?>
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">

                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m391 123v-33h30c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-330c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h30v33c0 67.604 49.952 123.758 114.884 133.5-65.071 9.763-114.884 66.052-114.884 133.5v32h-30c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15h330c8.284 0 15-6.716 15-15v-60c0-8.284-6.716-15-15-15h-30v-32c0-67.394-49.759-123.729-114.884-133.5 64.932-9.742 114.884-65.896 114.884-133.5zm-285-93h300v30h-300zm255 60c-1.252 23.881 4.151 46.344-9.215 76h-191.57c-13.425-29.788-7.944-51.775-9.215-76zm45 392h-300v-30h300zm-255-60c.277-28.476-.734-35.29 1.217-48h73.783c11.187 0 21.746-4.057 30.002-11.476 7.974 7.132 18.493 11.476 29.998 11.476h73.783c.801 5.218 1.217 10.561 1.217 16v32zm199.372-78h-64.372c-8.285 0-15.036-6.74-15.05-15.025-.014-8.276-6.727-14.975-14.999-14.975-.009 0-.018 0-.025 0-8.284.014-14.989 6.74-14.976 15.025.014 8.272-6.677 14.975-14.95 14.975h-64.372c38.408-78.477 150.262-78.629 188.744 0zm-169.767-148h150.789c-41.312 42.655-109.448 42.684-150.789 0z"/></g></svg>

                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--time font-weight-700 ">
                                <span class="font-weight-400">Duration:</span>
                                <?php echo $appointment->duration; ?>min
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">

                            <?php echo $appointment->departmentObject->departmentType->svg; ?>

                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--time font-weight-700 ">
                                <span class="font-weight-400">Department:</span>
                                <?php echo $appointment->departmentObject->departmentType->term->name; ?>
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">

                            <svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0c-68.925,0-125,56.075-125,125s56.075,125,125,125s125-56.075,125-125S324.925,0,256,0z M256,220c-52.383,0-95-42.617-95-95s42.617-95,95-95s95,42.617,95,95S308.383,220,256,220z"/></g></g><g><g><path d="M453.716,447.961C438.977,351.019,355.583,280,257.6,280h-3.888c-97.756,0-180.761,71.49-195.429,167.961L48.547,512h414.906L453.716,447.961z M241,482H83.453l4.49-29.529c8.541-56.173,45.231-105.152,98.771-128.487L241,407.928V482z M216.159,314.269c12.238-2.814,24.832-4.269,37.554-4.269h3.887c12.947,0,25.753,1.487,38.185,4.357L256,375.877L216.159,314.269z M271,482.001L271,482.001v-74.073l54.229-83.855c53.81,23.417,90.319,72.427,98.828,128.399l4.49,29.529H271z"/></g></g></svg>

                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--time font-weight-700 ">

                                            <span class="font-weight-400">
                                                Employee:
                                            </span>

                                <?php echo $appointment->employeeUser->first_name . ' ' . $appointment->employeeUser->last_name; ?>

                            </div>

                        </div>

                    </div>

                    <div class="flex flex-center appointment-item-info">

                        <div class="icon">

                            <svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M406,241c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C481,274.647,447.353,241,406,241z"/></g></g><g><g><path d="M479.251,391c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C313.217,410.08,301,436.608,301,466v31c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-31C512,436.608,498.783,410.08,479.251,391z"/></g></g><g><g><path d="M106,0C64.647,0,31,34.647,31,76c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C181,34.647,147.353,0,106,0z"/></g></g><g><g><path d="M179.251,151c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C13.217,170.08,0,196.608,0,226v30c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-30C211,196.608,198.783,170.08,179.251,151z"/></g></g><g><g><path d="M256,61c-15.621,0-30.95,2.278-45.919,5.903C210.348,69.95,211,72.885,211,76c0,7.551-0.883,14.886-2.404,21.989C223.874,93.415,239.81,91,256,91c75.688,0,139.473,51.292,158.833,120.894c11.459,0.974,22.513,3.347,32.635,7.72C430.359,129.441,351.074,61,256,61z"/></g></g><g><g><path d="M256,421c-75.366,0-138.95-50.85-158.604-120H66.451C86.847,386.864,163.99,451,256,451c5.574,0,11.083-0.379,16.577-0.839c1.262-10.704,3.571-21.114,7.293-31.077C272.009,420.222,264.073,421,256,421z"/></g></g></svg>

                        </div>

                        <div class="appointment-item--appointment">

                            <div class="appointment-item--time font-weight-700 ">

                                        <span class="font-weight-400">
                                            Meeting Type:
                                        </span>

                                <?php echo $appointment->getFieldToString('appointment_method'); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="appointment-item--footer no-padding-top no-padding-bottom">

                <div class="flex flex-center appointment-actions">

                    <div class="participant-item no-margin-left">

                        <div class="appointment-supplier-company appointment-company-block">

                            <?php echo get_the_post_thumbnail( $appointment->supplierCompanyObject->ID, 'thumbnail'); ?>

                            <div class="participant-content">

                                <h3>
                                    <?php echo get_the_title( $appointment->supplierCompanyObject->ID ); ?>
                                </h3>

                                <div class="participant-user">
                                    <?php echo $appointment->supplierEmployeeUser->first_name . ' ' . $appointment->supplierEmployeeUser->last_name; ?>
                                </div>

                            </div>

                        </div>

                    </div>

                    <a href="<?php echo get_the_permalink( $appointment->ID ); ?>" class="profenda-btn filled margin-left-auto no-margin-right">
                        View Appointment Details
                    </a>

                </div>

            </div>


        </div>

        <?php
    }

	public function getAllAppointmentsJSON( $pendingAppointments,$scheduledAppointments,$pastAppointments ) {
//	    var_dump($pendingAppointments);
//	    var_dump($scheduledAppointments);
//	    var_dump($pastAppointments);
	    $allAppointments = array();
	    if (is_array($pendingAppointments)) {
            $allAppointments = array_merge($allAppointments,$pendingAppointments);
        }
        if (is_array($scheduledAppointments)) {
            $allAppointments = array_merge($allAppointments,$scheduledAppointments);
        }
        if (is_array($pastAppointments)) {
            $allAppointments = array_merge($allAppointments,$pastAppointments);
        }
//        echo "<pre>";
//        print_r($allAppointments);
//        echo "</pre>";

        $allAppointmentsJSON = array();

        foreach ($allAppointments as $key => $singleAppointmentID) {

            $singleAppointmentOBJ   = new Appointment($singleAppointmentID);
            $appointmentEmployeeOBJ = new \WP_User($singleAppointmentOBJ->employee);

            if (!empty($appointmentEmployeeOBJ->display_name)) {
                $appointmentEmployeeName = $appointmentEmployeeOBJ->first_name." ".$appointmentEmployeeOBJ->last_name[0] . '.';
            } else {
                $appointmentEmployeeName = "By Assignment";
            }

            if ($singleAppointmentOBJ->status === "pending_approval" ) {
                $appointmentStatusColor = '#FF9800';
            } elseif ($singleAppointmentOBJ->status === "confirmed") {
                $appointmentStatusColor = '#388E3C';
            } elseif ($singleAppointmentOBJ->status === "cancelled") {
                $appointmentStatusColor = '#FF0C00';
            }

            $singleAppointmentArray = array();

            $singleAppointmentTimeFrom  = $singleAppointmentOBJ->date.'T'.$singleAppointmentOBJ->time.':00.000Z';
            $singleAppointmentTimeTo      = $singleAppointmentOBJ->date.'T'.date("h:i", strtotime($singleAppointmentOBJ->time) + ( $singleAppointmentOBJ->duration*60 ) + ( $singleAppointmentOBJ->buffer*60 ) ).':00.000Z';

            $singleAppointmentArray['start']    = $singleAppointmentTimeFrom;
            $singleAppointmentArray['end']      = $singleAppointmentTimeTo;
            $singleAppointmentArray['title']    = $appointmentEmployeeName."<span class='calendarTime'>".$singleAppointmentOBJ->time."</span>";
            $singleAppointmentArray['color']    = $appointmentStatusColor;
            $singleAppointmentArray['id']       = $singleAppointmentOBJ->ID;

            array_push($allAppointmentsJSON,$singleAppointmentArray);

//            echo "<pre>";
//            print_r($singleAppointmentArray);
//            echo "</pre>";
//            echo "<br><br><br>";
        }

//            echo "<pre>";
//            print_r($allAppointmentsJSON);
//            echo "</pre>";
        ?>
        <div id="jsontest" class="hide"><?php echo json_encode($allAppointmentsJSON, JSON_HEX_QUOT | JSON_HEX_TAG); ?></div>

        <div class="appointments_schedule">

            <div style="height:100%">
                <div id="appointments_schedule" style="height:100%"></div>
            </div>


        </div>

        <?php

    }

}
