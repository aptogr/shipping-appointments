<?php


namespace ShippingAppointments\Service\Emails;


use ShippingAppointments\Service\Dashboard\Access\DashboardEncryption;
use ShippingAppointments\Service\Emails\Template\ProfendaEmailTemplate;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use WP_User;

class EmailSender {

	public $dashboardEncryption;
	public $returnTemplate;


	const ADMINS_NOTIFY = array( 1426, 11, 336);
	const EMAIL_HEADERS = array('Content-Type: text/html; charset=UTF-8', 'From: HOMI <info@profenda.com>');

	public function __construct(){

		$this->dashboardEncryption  = new DashboardEncryption();

	}

	/**
	 * @param $recipientUser WP_User | PlatformUser | int
	 * @param $subject
	 * @param $header
	 * @param $body
	 * @return bool | string
	 */
	public function sendEmail( $recipientUser, $subject, $header, $body ){

		$homiEmailTemplate  = new ProfendaEmailTemplate();
		$emailTemplate      = $homiEmailTemplate->getTemplate( $recipientUser, $header, $body );

		if( $this->returnTemplate ){

			ob_start();

			if( is_admin() ){
				echo "<h3><strong>Subject:</strong> $subject</h3>";
			}

			echo $emailTemplate;

			return ob_get_clean();
		}
		else {
			return wp_mail( $recipientUser->user_email, $subject, $emailTemplate, self::EMAIL_HEADERS );
		}

	}


	public function getAdminsToNotify(){

		$admins = array();

		foreach( self::ADMINS_NOTIFY as $userId ){

			$admins[] = new PlatformUser( $userId );

		}

		return $admins;

	}


}
