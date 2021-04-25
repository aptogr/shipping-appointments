<?php


namespace ShippingAppointments\Service\Emails;


use ShippingAppointments\Service\Entities\User\PlatformUser;
use WP_User;

class AuthenticationEmails extends EmailSender {

	/**
	 * @var $user WP_User
	 */
	public $user;

	/**
	 * AuthenticationEmails constructor.
	 * @param $user WP_User
	 * @param $returnTemplate bool
	 */
	public function __construct( $user, $returnTemplate = false ){

		parent::__construct();
		$this->user                 = $user;
		$this->returnTemplate       = $returnTemplate;

	}


	public function email_after_register(){

		$subject        = "Δημιουργία νέου λογαριασμού";
		$header         = "Δημιουργία νέου λογαριασμού";
		$recipient      = $this->user;
		$token          = "?token=" . $this->dashboardEncryption->encrypt( $this->user->user_email );

		ob_start();
		?>
		<p>
			Λαμβάνεις αυτό το email επειδή δημιούργησες επιτυχώς έναν λογαριασμό στη HOMI.
		</p>

		<?php

		$body = ob_get_clean();

		return $this->sendEmail( $recipient, $subject, $header, $body );

	}


	/**
	 * @param $recipient PlatformUser
	 * @return bool|string
	 */
	public function email_after_register_admin( $recipient ){

		$subject        = "Notification: New User Registration";
		$header         = "Notification: New User Registration";
		$token          = "?token=" .$this->dashboardEncryption->encrypt( $recipient->user_email );
		$token          = "";

		$platformUser = new PlatformUser( $this->user->ID );

		ob_start();
		?>
		<p>
			A new user has been registered on the site: <?php echo site_url(); ?>
		</p>

		<div style="font-weight: bold;border-bottom: 1px solid #cce0ff;padding-bottom: 15px;margin-bottom: 15px;font-size: 15px;margin-top: 20px;">
			User Details:
		</div>

		<div style="color: #6f7b8e;margin: 15px 0 5px;">
			Name:
		</div>

		<div style="font-weight: bold;">
			<?php echo $this->user->first_name . ' ' . $this->user->last_name; ?>
		</div>

		<div style="color: #6f7b8e;margin: 15px 0 5px;">
			Email:
		</div>

		<div style="font-weight: bold;">
			<?php echo $this->user->user_email; ?>
		</div>

		<div style="color: #6f7b8e;margin: 15px 0 5px;">
			Register Method:
		</div>

		<div style="font-weight: bold;">
			<?php echo ( !empty( $platformUser->register_method ) ? $platformUser->register_method : $platformUser->login_method ); ?>
		</div>

		<div style="text-align: center;">

			<a href="<?php echo get_edit_user_link( $this->user->ID ) . $token; ?>" style="display: inline-block;margin: 30px 10px;width: 200px;text-align: center;padding: 16px 0;border: 2px solid #045fb4;background-color: #045fb4;text-decoration: none;font-weight: bold;color: #fff;">
				Edit User
			</a>

		</div>

		<?php

		$body = ob_get_clean();

		return $this->sendEmail( $recipient, $subject, $header, $body );

	}


	public function email_password_change_request( $password_change_url ){
		$subject        = "Αλλαγή Κωδικού Πρόσβασης";
		$header         = "Αλλαγή Κωδικού Πρόσβασης";
		$recipient      = $this->user;
		$token          = "?token=" . $this->dashboardEncryption->encrypt( $this->user->user_email );

		ob_start();
		?>

		<p>
			Λαμβάνεις αυτό το email επειδή έκανες πρόσφατα αίτημα αλλαγής του κωδικού σου.
		</p>

		<p>
			Για να αλλάξεις τον κωδικό σου, κάνε κλικ εδώ <a href="<?php echo $password_change_url; ?>"><?php echo $password_change_url; ?></a>
		</p>


		<?php

		$body = ob_get_clean();

		return $this->sendEmail( $recipient, $subject, $header, $body );

	}

	public function email_password_change_success(){
		$subject        = "Επιτυχής Αλλαγή Κωδικού Πρόσβασης";
		$header         = "Επιτυχής Αλλαγή Κωδικού Πρόσβασης";
		$recipient      = $this->user;
		$token          = "?token=" . $this->dashboardEncryption->encrypt( $this->user->user_email );

		ob_start();
		?>

		<p>
			Λαμβάνεις αυτό το email επειδή άλλαξες επιχτυώς τον κωδικού σου.
		</p>

		<?php

		$body = ob_get_clean();

		return $this->sendEmail( $recipient, $subject, $header, $body );

	}


	/**
	 * @param $recipient PlatformUser
	 * @return bool|string
	 */
	public function email_password_change_success_admin( $recipient ){

		$subject        = "Notification: User Changed Password";
		$header         = "Notification: User Changed Password";
		$token          = "?token=" .$this->dashboardEncryption->encrypt( $recipient->user_email );
		$token          = "";

		$platformUser = new PlatformUser( $this->user->ID );

		ob_start();
		?>
		<p>
			A user has successfully changed the password on the site: <?php echo site_url(); ?>
		</p>

		<div style="font-weight: bold;border-bottom: 1px solid #cce0ff;padding-bottom: 15px;margin-bottom: 15px;font-size: 15px;margin-top: 20px;">
			User Details:
		</div>

		<div style="color: #6f7b8e;margin: 15px 0 5px;">
			Name:
		</div>

		<div style="font-weight: bold;">
			<?php echo $this->user->first_name . ' ' . $this->user->last_name; ?>
		</div>

		<div style="color: #6f7b8e;margin: 15px 0 5px;">
			Email:
		</div>

		<div style="font-weight: bold;">
			<?php echo $this->user->user_email; ?>
		</div>


		<div style="text-align: center;">

			<a href="<?php echo get_edit_user_link( $this->user->ID ) . $token; ?>" style="display: inline-block;margin: 30px 10px;width: 200px;text-align: center;padding: 16px 0;border: 2px solid #045fb4;background-color: #045fb4;text-decoration: none;font-weight: bold;color: #fff;">
				Edit User
			</a>

		</div>

		<?php

		$body = ob_get_clean();

		return $this->sendEmail( $recipient, $subject, $header, $body );

	}

}
