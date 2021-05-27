<?php


namespace ShippingAppointments\Controller\Save;

use ShippingAppointments\Controller\Save\Service\RejectAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveAvailabilityController;
use ShippingAppointments\Controller\Save\Service\SaveBookingSettingsController;
use ShippingAppointments\Controller\Save\Service\ApproveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveDepartmentSettingsController;
use ShippingAppointments\Controller\Save\Service\UpdateAppointmentController;
use ShippingAppointments\Controller\Save\Service\CancelAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveCompanySettingsController;
use ShippingAppointments\Controller\Save\Service\CreateDepartment;

class SaveController {

	public function saveFields(){

		if( isset( $_POST['refresh_action'] ) ){

            $action = false;

			switch( $_POST['refresh_action'] ){

				case 'save_availability':


					$saveAvailabilityController = new SaveAvailabilityController();
					$action                     = $saveAvailabilityController->save( $_POST );
					$redirectUrl                = site_url( 'dashboard/booking/availability' );

					break;

				case 'save_booking_settings':

//                    echo '<pre>';
//                    var_dump($_POST);
//                    echo '</pre>';

					$saveBookingSettingsController  = new SaveBookingSettingsController();
					$action                         = $saveBookingSettingsController->save( $_POST );
                    $redirectUrl                    = site_url('dashboard/booking/settings');

					break;

                case 'create_appointment':

                    $saveAppointmentController      = new SaveAppointmentController();
                    $action                         = $saveAppointmentController->save( $_POST );
                    $redirectUrl                    = site_url('dashboard/book/success/req/' . $saveAppointmentController->appointmentID );

                    break;

                case 'approve_appointment':

                    $approveAppointmentController  = new ApproveAppointmentController();
                    $action                         = $approveAppointmentController->save( $_POST );
                    $redirectUrl                    = get_the_permalink( $approveAppointmentController->appointmentID );

                    break;

                case 'reject_appointment':

                    $rejectAppointmentController    = new RejectAppointmentController();
                    $action                         = $rejectAppointmentController->save( $_POST );
                    $redirectUrl                    = get_the_permalink( $rejectAppointmentController->appointmentID );

                    break;

                case 'update_appointment':


                    $updateAppointmentController  = new UpdateAppointmentController();
                    $action                         = $updateAppointmentController->save( $_POST );
                    $redirectUrl                    = get_the_permalink( $updateAppointmentController->appointmentID );

                    break;

                case 'cancel_appointment':


                    $cancelAppointmentController  = new CancelAppointmentController();
                    $action                         = $cancelAppointmentController->save( $_POST );
                    $redirectUrl                    = site_url('dashboard');

                    break;

                case 'save_dep_settings':
//                    echo '<pre>';
//                    var_dump($_POST);
//                    echo '</pre>';

                    $saveDepartmentSettingsController  = new SaveDepartmentSettingsController();
                    $action                         = $saveDepartmentSettingsController->save( $_POST );
                    $redirectUrl                    = site_url('dashboard/manage/edit-departments/department/'.$_POST['departmentId'] );

                    break;

                case 'save_company_settings':

                    $saveCompanySettingsController  = new SaveCompanySettingsController();
                    $action                         = $saveCompanySettingsController->save( $_POST );
                    $redirectUrl                    = site_url('dashboard/manage/edit-company/company/'.$_POST['companyId'] );

                    break;

                case 'create_department':

                    $createDepartment  = new CreateDepartment();
                    $action                         = $createDepartment->save( $_POST );
//                    $redirectUrl                    = site_url('dashboard/manage/edit-company/company/'.$_POST['companyId'] );

//                    echo '<pre>';
//                    var_dump($_POST);
//                    echo '</pre>';

                    break;

			}

			if( !empty( $redirectUrl ) ) {

                $status = ( $action ? 'success' : 'failed' );
                wp_redirect( $redirectUrl . "?status=$status" );
                exit();

            }

		}

	}

}
