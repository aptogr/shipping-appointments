<?php


namespace ShippingAppointments\Controller\Save;

use ShippingAppointments\Controller\Save\Service\SaveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveAvailabilityController;
use ShippingAppointments\Controller\Save\Service\SaveBookingSettingsController;
use ShippingAppointments\Controller\Save\Service\ApproveAppointmentController;
use ShippingAppointments\Controller\Save\Service\UpdateAppointmentController;
use ShippingAppointments\Controller\Save\Service\CancelAppointmentController;

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

			}

			if( !empty( $redirectUrl ) ) {

                $status = ( $action ? 'success' : 'failed' );
                wp_redirect( home_url( $redirectUrl . "?status=$status"  ) );
                exit();

            }

		}

	}

}
