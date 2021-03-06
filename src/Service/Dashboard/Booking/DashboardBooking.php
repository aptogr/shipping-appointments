<?php


namespace ShippingAppointments\Service\Dashboard\Booking;


use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointments;
use ShippingAppointments\Service\Dashboard\Appointments\DashboardAppointmentsDepartment;
use ShippingAppointments\Service\Entities\Appointment;
use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\DepartmentType as DepartmentTypeEntity;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Service\Taxonomy\DepartmentType;

class DashboardBooking {

	public $selectedCompany;
	public $selectedDepartment;
	public $selectedEmployeeType;
	public $selectedEmployee;
	public $selectedDate;
	public $selectedTime;
	public $selectedMeetingType;
	public $selectedReason;

	/**
	 * @var $company ShippingCompany
	 */
	public $company;

	/**
	 * @var $department false|Department
	 */
	public $department;

	/**
	 * @var $selectedEmployeeUser false|PlatformUser
	 */
	public $selectedEmployeeUser;

	public function __construct( $companyID, $settings ){

		$this->selectedCompany      = $companyID;
		$this->company              = new ShippingCompany( $this->selectedCompany );
		$this->selectedDepartment   = ( isset( $settings['department'] ) && !empty( $settings['department'] ) ? intval( $settings['department'] ) : false );
		$this->department           = ( $this->selectedDepartment !== false  ? new Department( $this->selectedDepartment ) : false );
		$this->selectedEmployeeType = ( isset( $settings['employee_type'] ) && !empty( $settings['employee_type'] ) ? $settings['employee_type'] : false );
		$this->selectedEmployee     = ( isset( $settings['employee'] ) && !empty( $settings['employee'] ) ? $settings['employee'] : false );
		$this->selectedEmployeeUser = ( $this->selectedEmployee !== false  ? new PlatformUser( intval($this->selectedEmployee) ) : false );
		$this->selectedDate         = ( isset( $settings['date'] ) && !empty( $settings['date'] ) ? $settings['date'] : false );
		$this->selectedTime         = ( isset( $settings['time'] ) && !empty( $settings['time'] ) ? $settings['time'] : false );
		$this->selectedMeetingType  = ( isset( $settings['appointment_method'] ) && !empty( $settings['appointment_method'] ) ? $settings['appointment_method'] : false );
		$this->selectedReason       = ( isset( $settings['reason'] ) && !empty( $settings['reason'] ) ? $settings['reason'] : false );

	}

	public function getDepartmentsField(){

		$activeDepartments = array();

		$departmentTerms = get_terms( array(
			'taxonomy' => DepartmentType::TAXONOMY_SLUG,
			'hide_empty' => false,
		) );

		foreach( $departmentTerms as $departmentTerm ){

			$departmentTypeObject = new DepartmentTypeEntity( $departmentTerm );

			$departmentObject = $this->company->getDepartmentByType( $departmentTypeObject );

			if( $departmentObject !== false ){
				$activeDepartments[] = $departmentObject;
			}

		}

		ob_start();
		?>

        <div id="departmentField" class="flex full-width radio-with-icons">

	        <?php foreach( $activeDepartments as $department ): ?>

                <?php if( $department->status === 'enabled' ):?>

                    <label for="<?php echo $department->ID; ?>" class="radio-with-icon flex-grow flex flex-center  <?php echo ( $department->ID === $this->selectedDepartment ? 'selected' : ''); ?>">

                        <input id="<?php echo $department->ID; ?>" type="radio" value="<?php echo $department->ID; ?>" name="department" <?php echo ( $department->ID === $this->selectedDepartment ? 'checked' : ''); ?>>

                        <span class="department-icon">
                            <?php echo $department->departmentType->svg; ?>
                        </span>

                        <span class="department-name">
                             <?php echo $department->departmentType->term->name; ?>
                        </span>

                    </label>

                <?php endif; ?>

	        <?php endforeach; ?>

        </div>

		<?php

		return ob_get_clean();

	}

	public function getEmployeesField(){

		ob_start();
		?>

        <div id="employeeType" class="flex full-width radio-with-icons">

            <label for="anyone" class="radio-with-icon flex-grow flex flex-center  <?php echo ( $this->selectedEmployeeType === 'anyone' ? 'selected' : ''); ?>">

                <input id="anyone" type="radio" value="anyone" name="employee_type" <?php echo ( $this->selectedEmployeeType === 'anyone' ? 'checked' : ''); ?>>

                <span class="department-icon">
                    <svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g><g><path d="M504.501,421.9c-4.143,0-7.5,3.358-7.5,7.5v50.113c0,0.696-0.566,1.263-1.263,1.263H467.24V371.199c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v109.578H397.17l14.905-16.397c2.302-2.533,3.387-6.13,2.904-9.623c-0.011-0.075-0.022-0.149-0.035-0.224l-16.755-98.996l3.083-4.641l0.803,0.57c2.749,1.953,6.255,2.665,9.647,1.818c3.331-0.833,6.122-3.074,7.656-6.146v-0.001l17.049-34.171l38.945,15.083c1.537,0.668,21.625,9.879,21.625,33.845v32.504c0.001,4.143,3.358,7.501,7.501,7.501c4.143,0,7.5-3.358,7.5-7.5v-32.504c0-34.61-29.685-47.211-30.948-47.731c-0.048-0.02-0.095-0.039-0.143-0.057l-66.317-25.684v-13.66c10.352-8.328,17.622-20.331,19.805-34.014c5.163-0.648,9.953-2.715,13.928-6.134c5.7-4.902,8.971-12.035,8.971-19.568c0-6.013-2.087-11.767-5.824-16.337v-20.238c0-39.606-32.222-71.827-71.826-71.827c-17.781,0-34.061,6.508-46.618,17.25c-0.162-5.747-2.219-11.223-5.804-15.607V88.051c0-39.606-32.222-71.827-71.826-71.827c-39.606,0-71.827,32.222-71.827,71.827v20.765c-3.605,4.308-5.622,9.502-5.8,15.015c-8.012-6.847-17.601-12.002-28.288-14.816c-4.012-1.056-8.109,1.337-9.164,5.343s1.337,8.109,5.343,9.164c24.913,6.56,42.313,29.157,42.313,54.949v11.217c-0.324-0.067-1.364-0.246-1.404-0.252c-0.102-2.117-0.638-3.41-1.792-5.07c-1.92-2.759-5.368-6.196-16.458-18.116c-3.952-4.245-10.344-5.024-15.196-1.852c-18.995,12.408-42.072,18.732-63.488,17.475c-6.976-0.409-11.333,2.656-13.19,7.679c-0.166,0.027-2.021,0.401-2.124,0.426v-11.507c0-24.869,16.618-47.242,40.411-54.409c3.966-1.194,6.213-5.378,5.019-9.345c-1.195-3.967-5.385-6.214-9.346-5.018c-14.47,4.358-27.477,13.432-36.622,25.548c-9.463,12.534-14.464,27.481-14.464,43.225v20.766c-3.778,4.514-5.821,10-5.821,15.809c0,12.84,9.46,24.038,22.938,25.708c2.208,13.363,9.458,26.178,20.9,34.891v12.781l-66.243,25.682c-0.047,0.018-0.094,0.037-0.141,0.056C29.686,314.684,0,327.284,0,361.894v117.619c0,8.969,7.296,16.264,16.265,16.264h230.971c3.228,0,6.231-0.957,8.765-2.585c2.532,1.628,5.536,2.585,8.765,2.585h230.972c8.968,0,16.264-7.295,16.264-16.264v-50.113C512.001,425.258,508.644,421.9,504.501,421.9z M75.702,225.258c-4.397-1.596-7.206-5.663-7.206-10.213c0-4.413,3.2-8.039,7.206-9.76V225.258z M422.379,307.525l-14.722,29.506c-0.002-0.002-16.353-11.615-16.585-11.78c7.054-8.708,3.74-4.617,18.408-22.721L422.379,307.525z M380.23,314.803l-19.397-23.943v-7.195c6.305,2.18,13.097,3.186,19.49,3.188c0.001,0,0.003,0,0.004,0h0.001c6.61-0.001,13.302-1.256,19.262-3.499v7.552L380.23,314.803z M389.036,342.206l-2.759,4.153h-12.091l-2.759-4.153l8.805-6.253L389.036,342.206z M255.981,224.381l-19.397-23.943v-7.195c6.28,2.171,13.065,3.186,19.49,3.188c0.001,0,0.003,0,0.004,0h0.001c6.598,0,13.289-1.251,19.262-3.498v7.551L255.981,224.381z M264.786,251.786l-2.759,4.153h-12.091l-2.759-4.153l8.805-6.253L264.786,251.786z M196.918,149.614c1.226,0.334,2.486,0.561,3.765,0.719c2.208,13.363,9.458,26.178,20.9,34.891v12.781l-15.301,5.931c-0.887-1.863-1.996-3.618-3.312-5.227v-20.237C202.97,168.294,200.826,158.51,196.918,149.614z M295.836,141.672c0,21.953-17.908,39.756-39.757,39.756c-24.651,0-41.125-19.105-41.125-39.756V106.54c23.683,0.948,48.286-6.071,68.401-18.591c6.763,7.252,10.787,11.465,12.482,13.421C295.836,120.043,295.836,127.253,295.836,141.672z M310.147,150.328c1.272-0.16,2.526-0.388,3.745-0.721c-3.896,8.84-6.076,18.6-6.076,28.865v20.765c-1.153,1.377-2.145,2.844-2.966,4.383l-14.508-5.618v-13.66C300.693,176.013,307.964,164.01,310.147,150.328z M226.705,212.12l18.412,22.726l-12.556,8.918c-0.007,0.005-0.012,0.01-0.019,0.015l-3.985,2.831l-14.723-29.505L226.705,212.12z M273.243,226.904l11.987-14.796l12.899,4.995l-14.721,29.507l-3.994-2.836c-0.004-0.003-0.008-0.007-0.012-0.01l-12.579-8.935L273.243,226.904z M277.023,260.475l0.803,0.57c2.804,1.992,6.323,2.65,9.647,1.818c3.331-0.833,6.122-3.074,7.656-6.146v-0.001l12.658-25.369c4.349,5.36,10.639,8.62,17.117,9.429c2.288,14.34,10.039,26.578,20.929,34.87v12.78l-63.764,24.721l-8.13-48.03L277.023,260.475z M350.954,302.541l18.412,22.726c-8.05,5.719-16.143,11.468-16.56,11.764l-14.723-29.505L350.954,302.541z M420.084,232.094c0.002,21.417-17.391,39.756-39.756,39.756c-25.492,0-41.125-19.966-41.125-39.756v-35.132c23.514,0.939,48.149-5.987,68.4-18.591c6.763,7.252,10.787,11.465,12.482,13.421C420.084,210.464,420.084,217.675,420.084,232.094z M442.294,215.046c0,4.558-2.818,8.617-7.206,10.212v-20.403C439.624,206.507,442.294,210.652,442.294,215.046z M322.817,178.471c0-31.334,25.493-56.826,56.826-56.826c31.334,0,56.825,25.493,56.825,56.826v11.217c-0.341-0.071-1.279-0.233-1.404-0.252c-0.102-2.119-0.641-3.415-1.792-5.07c-1.971-2.831-5.381-6.209-16.458-18.116c-3.868-4.152-10.246-5.087-15.196-1.852c-18.48,12.072-41.828,18.891-64.045,17.448c-6.241-0.409-10.762,2.647-12.633,7.707c-0.167,0.027-2.019,0.401-2.124,0.426V178.471z M324.202,205.286v19.962c-4.41-1.59-7.206-5.668-7.206-10.203C316.995,210.632,320.193,207.008,324.202,205.286z M318.043,124.625c0,3.158-1.367,6.145-3.75,8.194c-1.023,0.88-2.189,1.556-3.456,2.017v-20.403C315.322,116.061,318.043,120.184,318.043,124.625z M255.393,31.224c31.334,0,56.826,25.492,56.826,56.826v11.217c-0.339-0.07-1.279-0.233-1.404-0.252c-0.111-2.297-0.773-3.709-2.124-5.536c-2.008-2.718-5.71-6.455-16.126-17.651c-3.933-4.223-10.321-5.038-15.196-1.852c-19.516,12.75-43.191,18.955-64.65,17.418c-5.25-0.397-10.193,2.775-12.027,7.736c-0.167,0.027-2.02,0.401-2.124,0.426V88.051h-0.001C198.567,56.716,224.06,31.224,255.393,31.224z M199.951,114.864v19.973c-4.397-1.596-7.206-5.663-7.206-10.213C192.745,120.236,195.92,116.597,199.951,114.864z M186.587,204.855c4.196,1.527,6.891,5.188,7.158,9.539c0.336,4.838-2.637,9.213-7.158,10.855V204.855z M185.892,240.774c7.074-0.885,13.567-4.613,17.825-10.348l13.118,26.29c0,0,0,0,0.001,0.001c1.533,3.073,4.324,5.313,7.655,6.146c3.293,0.823,6.816,0.193,9.647-1.818l0.803-0.57l3.083,4.641l-8.127,48.017l-63.804-24.711v-13.654h-0.001C176.715,266.203,183.76,254.101,185.892,240.774z M131.73,314.803l-19.397-23.943v-7.195c6.28,2.171,13.066,3.186,19.491,3.187c0.001,0,0.003,0,0.004,0c6.706,0,13.386-1.288,19.262-3.498v7.552L131.73,314.803z M140.536,342.206l-2.759,4.153h-12.091l-2.759-4.153l8.805-6.253L140.536,342.206z M160.979,302.53l12.9,4.996l-14.722,29.505l-3.994-2.836c-0.004-0.003-0.008-0.007-0.012-0.01l-12.579-8.934L160.979,302.53z M90.703,232.094v-35.132c23.809,0.951,48.428-6.161,68.4-18.591c6.699,7.184,10.785,11.463,12.482,13.421c0,18.673,0,25.884,0,40.302c0,21.813-17.785,39.756-39.757,39.756C107.365,271.85,90.703,252.963,90.703,232.094z M102.455,302.541l18.412,22.726l-12.556,8.918c-0.007,0.005-0.012,0.01-0.019,0.015l-3.985,2.831l-14.723-29.505L102.455,302.541z M59.763,480.778V371.199c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v109.578H16.265c-0.698,0-1.264-0.567-1.264-1.263V361.894c0-24.089,20.297-33.271,21.611-33.839l38.921-15.089l17.051,34.171c0,0,0,0,0.001,0.001c1.533,3.073,4.324,5.313,7.656,6.146c3.293,0.823,6.816,0.193,9.647-1.818l0.803-0.57l3.083,4.641l-16.755,98.996c-0.013,0.074-0.024,0.149-0.035,0.224c-0.482,3.491,0.603,7.088,2.906,9.625l14.903,16.395H59.763z M112.073,455.481l15.929-94.121h7.459l15.93,94.121l-19.659,21.627L112.073,455.481z M248.499,479.513c0,0.697-0.566,1.264-1.263,1.264H218.74V371.199c0-4.142-3.357-7.5-7.5-7.5c-4.143,0-7.5,3.358-7.5,7.5v109.578H148.67l14.905-16.397c2.302-2.533,3.387-6.13,2.904-9.623c-0.011-0.075-0.022-0.149-0.035-0.224l-16.755-98.996l3.083-4.641l0.803,0.57c2.007,1.426,4.383,2.17,6.794,2.17c4.399,0,8.496-2.465,10.51-6.498v-0.001l17.049-34.17l38.945,15.083c11.352,4.938,21.625,17.673,21.625,33.844V479.513z M256,334.64c-3.107-5.006-7.243-9.638-12.229-13.591l8.481-50.109h7.459l8.485,50.135C263.077,325.14,258.995,329.814,256,334.64z M308.262,480.778L308.262,480.778V371.199c0-4.142-3.357-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v109.578h-28.497c-0.697,0-1.264-0.567-1.264-1.263V361.894c0-8.916,2.796-17.128,8.752-24.027c3.971-4.555,9.238-8.243,12.86-9.812l38.921-15.09l17.051,34.172c0,0,0,0,0.001,0.001c1.533,3.073,4.324,5.313,7.655,6.146c3.293,0.823,6.816,0.193,9.647-1.818l0.803-0.57l3.083,4.641l-16.755,98.996c-0.013,0.074-0.024,0.149-0.035,0.224c-0.482,3.491,0.603,7.088,2.906,9.625l14.903,16.395H308.262z M360.572,455.482l15.93-94.121h7.459l15.93,94.121l-19.66,21.627L360.572,455.482z"/></g></g></svg>
                </span>

                <span class="department-name">
                     I want a meeting with anyone from the department
                </span>

            </label>

            <label for="specific" class="radio-with-icon flex-grow flex flex-center no-margin-right <?php echo ( $this->selectedEmployeeType === 'specific' ? 'selected' : ''); ?>">

                <input id="specific" type="radio" value="specific" name="employee_type" <?php echo ( $this->selectedEmployeeType === 'specific' ? 'checked' : ''); ?>>

                <span class="department-icon">
                    <svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M421.054,414.843c-4.142,0-7.5,3.358-7.5,7.5v70.514c0,2.283-1.858,4.141-4.141,4.141h-40.317V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-81.185l23.543-25.9c2.572-2.83,3.785-6.861,3.244-10.787c-0.01-0.076-0.022-0.152-0.035-0.228L277.24,327.617l6.041-9.094c3.34,2.372,5.913,4.656,10.738,4.656c4.908,0,9.497-2.747,11.755-7.269v-0.001l23.65-47.4l53.876,20.865c1.949,0.836,30.252,13.582,30.252,47.238v50.73c-0.001,4.141,3.357,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-50.73c0-44.344-37.969-60.463-39.585-61.128c-0.047-0.02-0.095-0.039-0.143-0.057l-89.668-34.726v-21.03c14.242-11.076,24.117-27.495,26.596-46.227c7.101-0.5,13.69-3.152,19.071-7.779c7.027-6.043,11.059-14.838,11.059-24.126c0-7.708-2.781-15.068-7.737-20.803V92.953C348.144,41.699,306.446,0,255.192,0c-51.254,0-92.952,41.699-92.952,92.953v28.511c-5.009,5.677-7.733,12.665-7.733,20.074c0,9.291,4.03,18.085,11.059,24.129c5.377,4.625,11.962,7.274,19.061,7.775c2.499,19.083,12.662,36.114,28.117,47.339v19.92l-89.571,34.725c-0.047,0.018-0.094,0.037-0.141,0.056c-1.617,0.665-39.585,16.784-39.585,61.128v156.245c0,10.555,8.587,19.142,19.142,19.142h71.457c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5h-16.137V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-40.319c-2.283,0-4.141-1.858-4.141-4.141V336.611c0-33.769,28.493-46.486,30.243-47.234l53.834-20.87l23.652,47.402c2.263,4.533,6.858,7.27,11.756,7.27c4.801,0,7.349-2.249,10.738-4.656l6.041,9.094l-22.421,132.468c-0.013,0.075-0.024,0.15-0.035,0.226c-0.542,3.924,0.671,7.957,3.244,10.789l23.543,25.9h-29.995c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h200.365c10.555,0,19.142-8.588,19.142-19.142v-70.514C428.554,418.201,425.196,414.843,421.054,414.843z M315.375,263.069l-22.049,44.19c-0.548-0.389-12.233-8.691-26.517-18.834c6.198-7.651-1.053,1.299,27.235-33.617L315.375,263.069z M271.043,309.833l-5.718,8.607h-18.703l-5.718-8.607l15.07-10.703L271.043,309.833z M227.743,243.121v-14.036c9.112,3.673,18.85,5.376,28.36,5.376c9.833,0,19.476-2.096,28.052-5.846v14.567l-28.181,34.785L227.743,243.121z M340.881,141.539c-0.001,4.913-2.129,9.562-5.839,12.753c-2.453,2.11-5.416,3.459-8.661,3.987v-33.477C335.001,126.202,340.881,133.352,340.881,141.539z M184.007,158.279c-8.718-1.415-14.5-8.623-14.5-16.741c0-8.018,6.647-14.544,14.5-16.359V158.279z M184.41,109.896c-2.389,0.274-5.127,0.921-7.168,1.615V92.953c0-42.983,34.968-77.952,77.951-77.952c42.983,0,77.951,34.969,77.951,77.952v18.043c-2.18-0.663-4.441-1.101-6.762-1.307c0-7.237,0.063-5.841-23.612-31.294c-4.354-4.678-11.556-5.658-17.037-2.077c-26.13,17.069-58.005,25.644-87.415,23.532C191.867,99.367,185.991,103.616,184.41,109.896z M199.008,164.184v-46.792v-2.465c32.375,1.896,66.318-7.722,93.739-25.283c10.858,11.658,16.738,17.773,18.634,20.099c0,5.884,0,47.705,0,54.44c0,30.447-24.826,55.276-55.277,55.276C221.91,219.46,199.008,192.934,199.008,164.184z M218.623,307.259l-22.049-44.19l21.293-8.247l27.241,33.625C231.255,298.284,219.88,306.366,218.623,307.259z M227.228,461.702l21.709-128.263h14.071l21.709,128.263l-28.744,31.623L227.228,461.702z"/></g></g></svg>
                </span>

                <span class="department-name">
                    I want a meeting with a specific employee
                </span>

            </label>

        </div>

        <input id="selectedEmployee" type="hidden" name="employee" value="<?php echo ( $this->selectedEmployee !== false ? $this->selectedEmployee : '' ); ?>">

        <?php if( $this->department !== false ): ?>

            <div id="view-availability-dep" data-depid="<?php echo $this->department->ID;?>" class="profenda-btn display-inline-block view-availability-dep margin-top-30 <?php echo( $this->selectedEmployeeType !== 'specific' ? '': 'hide'); ?>">Preview Availability</div>

            <?php if( $this->company->isAllUsersInvisible() === false && $this->department->isAllUsersInvisible() === false ): ?>

                <table class="select-employees-table margin-top-30 <?php echo( $this->selectedEmployeeType !== 'specific' ? 'hide': ''); ?>">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Preview Availability
                        </th>
                        <th>
                            Select
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach( $this->department->users as $user_id ): $employee = new PlatformUser( $user_id );  ?>

                        <?php if( $employee->isVisible() ): ?>

                            <tr class="<?php echo ( intval($this->selectedEmployee ) === $employee->ID ? 'selected' : '' ); ?>">
                                <td class="employee-name">
                                    <?php echo $employee->first_name . ' ' . $employee->last_name; ?>
                                </td>
                                <td>
                                    <a href="#" class="profenda-btn display-inline-block view-availability" data-id="<?php echo $employee->ID; ?>">
                                        Preview Availability
                                    </a>

                                </td>
                                <td>
                                    <a href="#" class="profenda-btn filled display-inline-block select-employee-btn" data-id="<?php echo $employee->ID; ?>">
                                        <?php echo ( intval($this->selectedEmployee ) === $employee->ID ? 'Selected' : 'Select this Employee' ); ?>
                                    </a>

                                </td>
                            </tr>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif ( $this->company->isAllUsersInvisible() ): ?>

                <p>
                    The company has invisible users
                </p>

			<?php elseif (  $this->department->isAllUsersInvisible() ): ?>

                <p>
                    The department has invisible users
                </p>

            <?php else: ?>



			<?php endif; ?>

        <?php endif; ?>

		<?php

		return ob_get_clean();

	}

	public function getDateField(){

		ob_start();

		?>

        <div class="col s12 input-field">

            <input id="date" type="hidden" name="date" value="<?php echo $this->selectedDate; ?>">

        </div>


        <?php

            if( $this->selectedEmployeeType === 'specific' && $this->selectedEmployeeUser !== false ){

	            $cal_excluded_dates     = $this->selectedEmployeeUser->excluded_dates;
	            $cal_weekdaysDisable    = $this->selectedEmployeeUser->getWeekdaysDisable($this->selectedEmployeeUser->weekdays_available);

            }
            else if( $this->selectedEmployeeType === 'specific' && $this->selectedEmployeeUser === false ){

	            $cal_excluded_dates     = false;
	            $cal_weekdaysDisable    = false;

            }
            else if( $this->department instanceof Department ){

	            $cal_excluded_dates     = $this->department->excluded_dates;
	            $cal_weekdaysDisable    = $this->department->getWeekdaysDisable($this->department->weekdays_available);

            }
            else {
	            $cal_excluded_dates     = false;
	            $cal_weekdaysDisable    = false;
            }

        ?>

        <?php if( $cal_excluded_dates !== false && $cal_weekdaysDisable !== false ): ?>

            <div
                    class="calendar availability col s12 margin-bottom-30"
                    data-disabledates="<?php echo $cal_excluded_dates; ?>"
                    data-disabledweekdays="<?php echo $cal_weekdaysDisable; ?>"
                    data-scheduledates="null/2001-01-01"
                    data-selecteddate="<?php echo $this->selectedDate; ?>"
            ></div>

        <?php else: ?>

            <div class="no-continue-step flex flex-dir-col flex-center flex-just-center">

                <div class="icon">
                    <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M421.054,414.843c-4.142,0-7.5,3.358-7.5,7.5v70.514c0,2.283-1.858,4.141-4.141,4.141h-40.317V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-81.185l23.543-25.9c2.572-2.83,3.785-6.861,3.244-10.787c-0.01-0.076-0.022-0.152-0.035-0.228L277.24,327.617l6.041-9.094c3.34,2.372,5.913,4.656,10.738,4.656c4.908,0,9.497-2.747,11.755-7.269v-0.001l23.65-47.4l53.876,20.865c1.949,0.836,30.252,13.582,30.252,47.238v50.73c-0.001,4.141,3.357,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-50.73c0-44.344-37.969-60.463-39.585-61.128c-0.047-0.02-0.095-0.039-0.143-0.057l-89.668-34.726v-21.03c14.242-11.076,24.117-27.495,26.596-46.227c7.101-0.5,13.69-3.152,19.071-7.779c7.027-6.043,11.059-14.838,11.059-24.126c0-7.708-2.781-15.068-7.737-20.803V92.953C348.144,41.699,306.446,0,255.192,0c-51.254,0-92.952,41.699-92.952,92.953v28.511c-5.009,5.677-7.733,12.665-7.733,20.074c0,9.291,4.03,18.085,11.059,24.129c5.377,4.625,11.962,7.274,19.061,7.775c2.499,19.083,12.662,36.114,28.117,47.339v19.92l-89.571,34.725c-0.047,0.018-0.094,0.037-0.141,0.056c-1.617,0.665-39.585,16.784-39.585,61.128v156.245c0,10.555,8.587,19.142,19.142,19.142h71.457c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5h-16.137V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-40.319c-2.283,0-4.141-1.858-4.141-4.141V336.611c0-33.769,28.493-46.486,30.243-47.234l53.834-20.87l23.652,47.402c2.263,4.533,6.858,7.27,11.756,7.27c4.801,0,7.349-2.249,10.738-4.656l6.041,9.094l-22.421,132.468c-0.013,0.075-0.024,0.15-0.035,0.226c-0.542,3.924,0.671,7.957,3.244,10.789l23.543,25.9h-29.995c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h200.365c10.555,0,19.142-8.588,19.142-19.142v-70.514C428.554,418.201,425.196,414.843,421.054,414.843z M315.375,263.069l-22.049,44.19c-0.548-0.389-12.233-8.691-26.517-18.834c6.198-7.651-1.053,1.299,27.235-33.617L315.375,263.069z M271.043,309.833l-5.718,8.607h-18.703l-5.718-8.607l15.07-10.703L271.043,309.833z M227.743,243.121v-14.036c9.112,3.673,18.85,5.376,28.36,5.376c9.833,0,19.476-2.096,28.052-5.846v14.567l-28.181,34.785L227.743,243.121z M340.881,141.539c-0.001,4.913-2.129,9.562-5.839,12.753c-2.453,2.11-5.416,3.459-8.661,3.987v-33.477C335.001,126.202,340.881,133.352,340.881,141.539z M184.007,158.279c-8.718-1.415-14.5-8.623-14.5-16.741c0-8.018,6.647-14.544,14.5-16.359V158.279z M184.41,109.896c-2.389,0.274-5.127,0.921-7.168,1.615V92.953c0-42.983,34.968-77.952,77.951-77.952c42.983,0,77.951,34.969,77.951,77.952v18.043c-2.18-0.663-4.441-1.101-6.762-1.307c0-7.237,0.063-5.841-23.612-31.294c-4.354-4.678-11.556-5.658-17.037-2.077c-26.13,17.069-58.005,25.644-87.415,23.532C191.867,99.367,185.991,103.616,184.41,109.896z M199.008,164.184v-46.792v-2.465c32.375,1.896,66.318-7.722,93.739-25.283c10.858,11.658,16.738,17.773,18.634,20.099c0,5.884,0,47.705,0,54.44c0,30.447-24.826,55.276-55.277,55.276C221.91,219.46,199.008,192.934,199.008,164.184z M218.623,307.259l-22.049-44.19l21.293-8.247l27.241,33.625C231.255,298.284,219.88,306.366,218.623,307.259z M227.228,461.702l21.709-128.263h14.071l21.709,128.263l-28.744,31.623L227.228,461.702z"></path></g></g></svg>
                </div>

                <h3>
                    You need to select the specific employee you want to have an appointment with.
                </h3>

                <a href="" class="profenda-btn filled">
                    Select an employee
                </a>

            </div>

        <?php endif; ?>


        <?php

        return ob_get_clean();

	}

	public function getTimeField(){

		ob_start();
        $selectedDay = strtolower(date('D', strtotime($this->selectedDate)));
		?>

        <div class="flex full-width flex-start">
		<?php if( $this->selectedEmployeeType === 'specific' && $this->selectedEmployeeUser !== false ): ?>

            Show times based on the availability of <?php echo $this->selectedEmployeeUser->getFullName(); ?> and the selected date: <?php echo $this->selectedDate; ?>

            <?php

                $from = $selectedDay."_time_from";
                $to = $selectedDay."_time_to";
                $to = date("H:i", strtotime('-29 minutes', strtotime($this->selectedEmployeeUser->{$to})));


                $disableTime = array(
                        array('00:00', $this->selectedEmployeeUser->{$from}),
                        array($to,'24:00'),
                );

                $userAppointments = $this->getBookedAppointments();

                foreach ($userAppointments as $userAppointment) {

                    array_push($disableTime, $userAppointment->getAppointmentTimeRange() );

                }

            ?>

            <div id="userDisableTime" class="hide">
                <?php echo json_encode($disableTime); ?>
            </div>


		<?php elseif( $this->department instanceof Department ): ?>

            <?php

                //Get the overall availability of the selected department
                $allAvailability = $this->department->getAllDepartmentAvailability();

                //Get all the possible time ranges for the selected day
                $timesRanges = $this->department->calculateAllBookingPossibleTimeRanges($allAvailability[$selectedDay]['times'],$selectedDay, $this->selectedDate, false );

                //Get the disabled time ranges of the department based on the availability
                $depDisableTime = $this->department->getDisabledTimeRangesArray( $timesRanges );


            ?>

            <div class="col l7 s12 no-padding-left">
                <?php $this->displayDepartmentAvailabilityTable([
                        'weekday'   =>  $selectedDay,
                ]);?>
            </div>

            <div id="depDisableTime" class="hide">
                <?php echo json_encode($depDisableTime); ?>
            </div>

        <?php else: ?>

            <div class="col l7 s12 no-padding-left">
                You need to select a department to book an appointment with.
            </div>

		<?php endif; ?>

            <div class="col l5 s12">

                <div class="input-field full-width time-select-field flex flex-center full-width">

                    <div class="icon">

                        <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952C357.766,320.208,355.981,307.775,347.216,301.211z"></path></g></g><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341S375.275,472.341,256,472.341z"></path></g></g></svg>

                    </div>

                    <label for="bookTime">Appointment time:</label>
                    <input id="bookTime" type="text" class="timeSelect timepicker"  name="time" value="<?php echo $this->selectedTime; ?>">

                </div>

                <?php

                    if( !empty( $this->selectedTime ) && !empty( $this->selectedDate ) ){

                        $departmentAppointments = new DashboardAppointmentsDepartment( $this->department );
                        $hasAppointment = $departmentAppointments->confirmedAppointmentByDateTime( $this->selectedDate, $this->selectedTime );

                        if( ( count($hasAppointment) + 1 ) > $this->department->simultaneous_meetings ){

                            ?>

                            <div class="notice-in-page notice-flat flex flex-center margin-top-20">

                                <div class="flex flex-center">

                                    <div class="icon">

                                        <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                    </div>

                                    <div class="notice-message">
                                        <strong>You cannot book an appointment for this time.</strong>
                                        <br>The department does not allow to have more than <?php echo $this->department->simultaneous_meetings; ?> meetings at the same time.
                                    </div>

                                </div>

                            </div>

                            <?php

                        }
                        else if( count($hasAppointment) > 0 ){

	                        ?>

                            <div class="notice-in-page notice-flat flex flex-center margin-top-20">

                                <div class="flex flex-center">

                                    <div class="icon">

                                        <svg height="509.87489pt" viewBox="0 0 509.87489 509.87489" width="509.87489pt" xmlns="http://www.w3.org/2000/svg"><path d="m23.503906 198.367188 174.863282-174.863282c31.242187-31.242187 81.898437-31.242187 113.140624 0l174.863282 174.863282c31.242187 31.242187 31.242187 81.898437 0 113.140624l-174.863282 174.863282c-31.242187 31.242187-81.898437 31.242187-113.140624 0l-174.863282-174.863282c-31.242187-31.242187-31.242187-81.898437 0-113.140624zm0 0" fill="#ffda6b" style="fill: #fba919;"></path><g fill="#fff"><path d="m254.929688 142.9375c8.835937 0 16 7.164062 16 16v128c0 8.835938-7.164063 16-16 16-8.835938 0-16-7.164062-16-16v-128c0-8.835938 7.164062-16 16-16zm0 0"></path><path d="m238.929688 334.9375h32v32h-32zm0 0"></path></g></svg>

                                    </div>

                                    <div class="notice-message">
                                        <strong>The selected datetime you have chosen is busy.</strong>
                                        <br>Please choose another time or note that your appointment might be rejected.
                                    </div>

                                </div>

                            </div>

	                        <?php

                        }

                    }

                ?>

            </div>


        </div>

        <div class="clearfix"></div>

		<?php

		return ob_get_clean();

	}

	public function getMeetingTypeField(){

	    ob_start();

	    $availableMeetingTypes = $this->getAvailableMeetingTypes();

//	    echo "<pre>";
//	    print_r($this);
//	    echo "</pre>";

	    ?>

        <div class="flex full-width radio-with-icons">

            <label for="one_to_one" class="radio-with-icon flex-grow flex flex-center <?php echo ( $this->selectedMeetingType === 'physical_location' ? 'selected' : ''); ?> <?php echo ( !in_array('one_to_one', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">

                <input id="one_to_one" type="radio" value="physical_location" name="appointment_method" <?php echo ( $this->selectedMeetingType === 'physical_location' ? 'checked' : ''); ?>>

                <span class="department-icon">
                    <svg  id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M406,241c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C481,274.647,447.353,241,406,241z"></path></g></g><g><g><path d="M479.251,391c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C313.217,410.08,301,436.608,301,466v31c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-31C512,436.608,498.783,410.08,479.251,391z"></path></g></g><g><g><path d="M106,0C64.647,0,31,34.647,31,76c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C181,34.647,147.353,0,106,0z"></path></g></g><g><g><path d="M179.251,151c-18.939,18.499-44.753,30-73.251,30c-28.498,0-54.313-11.501-73.251-30C13.217,170.08,0,196.608,0,226v30c0,8.291,6.709,15,15,15h181c8.291,0,15-6.709,15-15v-30C211,196.608,198.783,170.08,179.251,151z"></path></g></g><g><g><path d="M256,61c-15.621,0-30.95,2.278-45.919,5.903C210.348,69.95,211,72.885,211,76c0,7.551-0.883,14.886-2.404,21.989C223.874,93.415,239.81,91,256,91c75.688,0,139.473,51.292,158.833,120.894c11.459,0.974,22.513,3.347,32.635,7.72C430.359,129.441,351.074,61,256,61z"></path></g></g><g><g><path d="M256,421c-75.366,0-138.95-50.85-158.604-120H66.451C86.847,386.864,163.99,451,256,451c5.574,0,11.083-0.379,16.577-0.839c1.262-10.704,3.571-21.114,7.293-31.077C272.009,420.222,264.073,421,256,421z"></path></g></g></svg>
                </span>

                <span class="department-name">
                    One to One Meeting <?php echo ( !in_array('physical_location', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                </span>

            </label>

            <label for="phone" class="radio-with-icon flex-grow flex flex-center <?php echo ( $this->selectedMeetingType === 'phone_call' ? 'selected' : ''); ?> <?php echo ( !in_array('phone', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">

                <input id="phone" type="radio" value="phone_call" name="appointment_method" <?php echo ( $this->selectedMeetingType === 'phone_call' ? 'checked' : ''); ?>>

                <span class="department-icon">

                    <svg height="512" viewBox="0 0 58 58" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="003---Call" fill="rgb(0,0,0)" fill-rule="nonzero" transform="translate(-1)"><path id="Shape" d="m25.017 33.983c-5.536-5.536-6.786-11.072-7.068-13.29-.0787994-.6132828.1322481-1.2283144.571-1.664l4.48-4.478c.6590136-.6586066.7759629-1.685024.282-2.475l-7.133-11.076c-.5464837-.87475134-1.6685624-1.19045777-2.591-.729l-11.451 5.393c-.74594117.367308-1.18469338 1.15985405-1.1 1.987.6 5.7 3.085 19.712 16.855 33.483s27.78 16.255 33.483 16.855c.827146.0846934 1.619692-.3540588 1.987-1.1l5.393-11.451c.4597307-.9204474.146114-2.0395184-.725-2.587l-11.076-7.131c-.7895259-.4944789-1.8158967-.3783642-2.475.28l-4.478 4.48c-.4356856.4387519-1.0507172.6497994-1.664.571-2.218-.282-7.754-1.532-13.29-7.068z"/><path id="Shape" d="m47 31c-1.1045695 0-2-.8954305-2-2-.0093685-8.2803876-6.7196124-14.9906315-15-15-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c10.4886126.0115735 18.9884265 8.5113874 19 19 0 1.1045695-.8954305 2-2 2z"/><path id="Shape" d="m57 31c-1.1045695 0-2-.8954305-2-2-.0154309-13.800722-11.199278-24.9845691-25-25-1.1045695 0-2-.8954305-2-2s.8954305-2 2-2c16.008947.01763587 28.9823641 12.991053 29 29 0 .530433-.2107137 1.0391408-.5857864 1.4142136-.3750728.3750727-.8837806.5857864-1.4142136.5857864z"/></g></g></svg>

                </span>

                <span class="department-name">
                    Phone Meeting <?php echo ( !in_array('phone', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                </span>

            </label>

            <label for="web" class="radio-with-icon flex-grow flex flex-center no-margin-right <?php echo ( $this->selectedMeetingType === 'remote_online' ? 'selected' : ''); ?> <?php echo ( !in_array('web', $availableMeetingTypes ) ? 'disabled' : '' ); ?>">

                <input id="web" type="radio" value="remote_online" name="appointment_method" <?php echo ( $this->selectedMeetingType === 'remote_online' ? 'checked' : ''); ?>>

                <span class="department-icon">

                    <svg id="bold" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m23 17h-22c-.552 0-1 .447-1 1s.448 1 1 1h22c.552 0 1-.447 1-1s-.448-1-1-1z"/><path d="m10.5 6.25c0 .26.03.51.1.75h-6.6v10h-2v-10c0-1.1.9-2 2-2h6.5z"/><path d="m22 9.11v7.89h-2v-7.59c.53-.12 1.01-.38 1.4-.73l.5.37c.03.02.06.05.1.06z"/><circle cx="11" cy="11" r="2"/><path d="m15 16.75v.25h-8v-.25c0-1.52 1.23-2.75 2.75-2.75h2.5c1.52 0 2.75 1.23 2.75 2.75z"/><path d="m23.25 8c-.159 0-.318-.051-.45-.15l-1.816-1.362c-.116.853-.85 1.512-1.734 1.512h-5.5c-.965 0-1.75-.785-1.75-1.75v-4.75c0-.692.458-1.5 1.75-1.5h5.5c.932 0 1.696.732 1.747 1.651l1.773-1.477c.222-.187.534-.227.798-.103s.432.388.432.679v6.5c0 .284-.161.544-.415.671-.106.053-.221.079-.335.079z"/></svg>

                </span>

                <span class="department-name">
                    Web Meeting <?php echo ( !in_array('web', $availableMeetingTypes ) ? '<span>(Not Available)</span>' : '' ); ?>
                </span>

            </label>

        </div>

        <?php
        return ob_get_clean();

	}

	public function getMeetingReasonField(){

		ob_start();

		?>

        <div class="col s12 margin-bottom-50  no-padding-left">

            <h3>
                Select the reason of the appointment
            </h3>

            <div class="flex full-width radio-with-icons">

		        <?php foreach( AppointmentPost::ALL_FIELDS['reason']['options'] as $value => $label ): ?>

                    <label for="<?php echo $value; ?>" class="radio-with-icon flex-grow flex flex-center">

                        <input id="<?php echo $value; ?>" type="radio" value="<?php echo $value; ?>" name="reason">

                        <span class="department-name center">
                       <?php echo $label; ?>
                    </span>

                    </label>

		        <?php endforeach; ?>

            </div>

        </div>

        <div class="flex full-width margin-bottom-20">

            <div class="col l6 s12 no-margin-left input-field textarea-field  no-padding-left">

                <label for="questions">
                    <h3>Add a free text message</h3>
                </label>

                <textarea id="questions" name="questions"></textarea>

            </div>

            <div class="col l6 s12">

                <label for="file">
                    <h3>Upload a file (Optional)</h3>
                </label>

                <div class="drop-zone">
                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                    <input id="file" type="file" name="myFile" class="drop-zone__input">
                </div>

            </div>

        </div>



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

	    if( $this->company->meeting_type === 'company' ){

	        return $this->mapMeetingTypes( $this->company->meeting_types_available );

	    }
	    else {

	        if( $this->department->meeting_types === 'department' ){

		        return $this->mapMeetingTypes(  $this->department->meeting_types_available );

	        }
	        else {

	            $platformUser = new PlatformUser( intval( $this->selectedEmployee ) );
		        return $this->mapMeetingTypes(  $platformUser->booking_method );

	        }

	    }

	}

	public function getBookedAppointments() {

	    //query
        $appointments = array();

		if( $this->selectedEmployeeType === 'specific' && $this->selectedEmployeeUser !== false ){

		    $dashboardAppointments = new DashboardAppointments( $this->selectedEmployeeUser );
			$bookedAppointments = $dashboardAppointments->getEmployeeConfirmedAppointmentsByDate( $this->selectedDate );


		}
		else {

			$dashboardAppointments = new DashboardAppointmentsDepartment( new Department( $this->selectedDepartment ) );
			$bookedAppointments = $dashboardAppointments->getDepartmentConfirmedAppointmentsByDate( $this->selectedDate );

		}

		if( is_array( $bookedAppointments ) && !empty( $bookedAppointments ) ){

			foreach( $bookedAppointments as $appointment ){

				$appointments[] = new Appointment( intval( $appointment ) );

			}

		}

        return $appointments;

    }


    public function displayDepartmentAvailabilityTable( $args ){

	    $departmentAvailability = $this->department->getAllDepartmentAvailability();

	    if( isset( $args['weekday'] ) && !empty( $args['weekday'] ) ){

		    $weekday = $args['weekday'];

		    if( isset( $departmentAvailability[$weekday] ) && !empty( $departmentAvailability[$weekday] ) ){

			    $departmentAvailability = array(
				    $weekday => $departmentAvailability[$weekday]
			    );

		    }
		    else {
			    $departmentAvailability = array();
		    }

	    }

	    ?>

        <table class="full-width date-availability-table">

            <thead>
                <tr>
                    <th style="width:180px;">Department Availability</th>
                    <th>Availability Breakdown</th>
                </tr>
            </thead>
            <tbody>
		    <?php
		    $i = 0;


		    foreach ($departmentAvailability as $day => $availabilityArray ) { ?>

                <tr>

                    <td>
					    <?php

                            $possibleTimeRanges =  $this->department->calculateAllBookingPossibleTimeRanges( $availabilityArray['times'], $day, $this->selectedDate, true );
                            $this->department->displayTimeRanges( $possibleTimeRanges );

					    ?>
                    </td>

                    <td style="padding: 0;">

                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Employee
                                    </th>
                                    <th>
                                        <?php echo ucfirst($day); ?>.
                                    </th>
                                    <th>
                                        <?php echo date('d/m/Y', strtotime( $this->selectedDate ) ); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        By assignment
                                    </td>
                                    <td class="day-range">
	                                    <?php echo $availabilityArray['times']['department'][$day . "_time_from"]." - ".$availabilityArray['times']['department'][$day . "_time_to"];?>
                                    </td>
                                    <td>
	                                    <?php echo $availabilityArray['times']['department'][$day . "_time_from"]." - ".$availabilityArray['times']['department'][$day . "_time_to"];?>
                                    </td>
                                </tr>

                                <?php foreach ($availabilityArray['times'] as $emplId => $dayTimes) {

	                                if ($emplId !== 'department') {

		                                /** @var $employee PlatformUser */
		                                $employee = $dayTimes['user'];

		                                ?>

                                        <tr>
                                            <td>
	                                            <?php echo $employee->first_name . ' ' . $employee->last_name[0]; ?>
                                            </td>
                                            <td class="day-range">
	                                            <?php echo $dayTimes[$day . "_time_from"]." - ".$dayTimes[$day . "_time_to"];?>
                                            </td>
                                            <td>
	                                            <?php

                                                    echo $employee->timeRangesToString(  $employee->calculateAllTimeRanges( $employee->getAvailabilityTimeRangeByDate( $this->selectedDate ) )  );

	                                            ?>
                                            </td>

                                        </tr>

		                                <?php
	                                }
                                }
                                ?>

                            </tbody>
                        </table>

                    </td>
                </tr>

			    <?php

			    $i++;

		    }

		    ?>
            </tbody>
        </table>

	    <?php

    }

}
