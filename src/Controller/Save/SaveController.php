<?php


namespace ShippingAppointments\Controller\Save;

use ShippingAppointments\Controller\Save\Service\SaveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveAvailabilityController;
use ShippingAppointments\Controller\Save\Service\SaveBookingSettingsController;
use ShippingAppointments\Controller\Save\Service\ApproveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveDepartmentSettingsController;
use ShippingAppointments\Controller\Save\Service\UpdateAppointmentController;
use ShippingAppointments\Controller\Save\Service\CancelAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveCompanySettingsController;

class SaveController {

	public function saveFields(){

		if( isset( $_POST['refresh_action'] ) ){

//		    var_dump( $_POST );

            $action = false;

			switch( $_POST['refresh_action'] ){

				case 'save_availability':


					$saveAvailabilityController = new SaveAvailabilityController();
					$action                     = $saveAvailabilityController->save( $_POST );
					$redirectUrl                = 'dashboard/booking/availability';

					break;

				case 'save_booking_settings':

					$saveBookingSettingsController  = new SaveBookingSettingsController();
					$action                         = $saveBookingSettingsController->save( $_POST );
                    $redirectUrl                    = 'dashboard/booking/settings';

					break;

                case 'create_appointment':


                    $saveAppointmentController  = new SaveAppointmentController();
                    $action                         = $saveAppointmentController->save( $_POST );
                    $redirectUrl                    = 'dashboard';

                    break;

                case 'approve_appointment':


                    $approveAppointmentController  = new ApproveAppointmentController();
                    $action                         = $approveAppointmentController->save( $_POST );
                    $redirectUrl                    = 'dashboard';

                    break;

                case 'update_appointment':


                    $updateAppointmentController  = new UpdateAppointmentController();
                    $action                         = $updateAppointmentController->save( $_POST );
                    $redirectUrl                    = 'dashboard';

                    break;

                case 'cancel_appointment':


                    $cancelAppointmentController  = new CancelAppointmentController();
                    $action                         = $cancelAppointmentController->save( $_POST );
                    $redirectUrl                    = 'dashboard';

                    break;

                case 'save_dep_settings':
                    echo '<pre>';
                    var_dump($_POST);
                    echo '</pre>';

                    $saveDepartmentSettingsController  = new SaveDepartmentSettingsController();
                    $action                         = $saveDepartmentSettingsController->save( $_POST );
//                    $redirectUrl                    = 'dashboard/manage/edit-departments/department/'.$_POST['departmentId'];

                    break;

                case 'save_company_settings':

                    $saveCompanySettingsController  = new SaveCompanySettingsController();
                    $action                         = $saveCompanySettingsController->save( $_POST );
//                    $redirectUrl                    = 'https://profenda.com/dashboard/manage/edit-company/company/93/';
                    $redirectUrl                    = 'dashboard/manage/edit-company/company/'.$_POST['companyId'];

                    break;

			}

			if( !empty( $redirectUrl ) ) {

                $status = ( $action ? 'success' : 'failed' );
                wp_redirect( home_url( $redirectUrl . "?status=$status"  ) );
                exit();

            }

		}

	}

}
