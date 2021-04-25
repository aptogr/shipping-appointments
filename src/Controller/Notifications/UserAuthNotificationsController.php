<?php


namespace ShippingAppointments\Controller\Notifications;


use Exception;
use ShippingAppointments\Service\Emails\AuthenticationEmails;
use WP_User;

class UserAuthNotificationsController {

	/**
	 * This function is responsible for notifying
	 * all the users involved in a listing request for any action.
	 *
	 * Notifications methods are:
	 *  - Emails
	 *  - Phone/Viber/SMS (Not yet)
	 *  - Push Notification to mobile (Not Yet)
	 *
	 * @param $user WP_User
	 * @param $notificationType string
	 * @param null $passwordReset
	 */
	public function sendNotifications( WP_User $user, $notificationType, $passwordReset = null ){

		try {

			$this->sendEmailNotifications( $user, $notificationType, $passwordReset  );

		}
		catch( Exception $e ){

		}

	}


	public function sendEmailNotifications( $user, $notificationType, $passwordReset ){

		$emails = new AuthenticationEmails( $user, false );

		switch( $notificationType ){

			case 'new_user_register':

				$emails->email_after_register();

				foreach( $emails->getAdminsToNotify() as $adminUser ){

					$emails->email_after_register_admin( $adminUser );

				}


				break;

			case 'password_reset':

//                $emails->email_password_change_request( $passwordReset );
				break;

			case 'password_reset_success':

				$emails->email_password_change_success();

				foreach( $emails->getAdminsToNotify() as $adminUser ){

					$emails->email_password_change_success_admin( $adminUser );

				}

				break;

		}

	}

}
