<?php


namespace ShippingAppointments\Controller\Save;

class SaveController {

	public function saveFields(){

		if( isset( $_POST['refresh_action'] ) ){

			switch( $_POST['refresh_action'] ){

				case 'save_availability':

					$saveAvailabilityController = new SaveAvailabilityController();
					$action = $saveAvailabilityController->save( $_POST );

					break;

			}

		}

	}

}
