<?php


namespace ShippingAppointments\Controller\Save;

use ShippingAppointments\Controller\Save\Service\SaveAppointmentController;
use ShippingAppointments\Controller\Save\Service\SaveAvailabilityController;
use ShippingAppointments\Controller\Save\Service\SaveBookingSettingsController;

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

			}

			if( !empty( $redirectUrl ) ) {

                $status = ( $action ? 'success' : 'failed' );
                wp_redirect( home_url( $redirectUrl . "?status=$status"  ) );
                exit();

            }

		}

	}

}
