<?php


namespace ShippingAppointments\Service\Emails\Template;


use ShippingAppointments\Service\Entities\User\PlatformUser;
use WP_User;

class ProfendaEmailTemplate {

	public $user;
	public $header;
	public $body;

	/**
	 * HomiEmailTemplate constructor.
	 * @param $userToMail WP_User | PlatformUser | int
	 * @param $header string
	 * @param $body string
	 * @return false|string
	 */
	public function getTemplate( $userToMail, $header, $body ){

		$this->user     = ( is_numeric( $userToMail ) ? get_user_by('ID', intval( $userToMail ) ) : $userToMail );
		$this->header   = $header;
		$this->body     = $body;

		ob_start();

		?>

		<div style="background-color: #cce0ff;padding: 25px;">
			<div id="homiEmail" style="max-width: 650px;width: 100%;margin: 0 auto;font-family: arial, helvetica, sans, serif, EmojiFont;">
				<div id="emailHeader" style="background-color: #045fb4;padding: 15px 0;">
					<div class="logo" style="">
						<a class="custom-logo-link" rel="home" href="http://homi.com.gr/"><img src="http://staging.homi.com.gr/wp-content/uploads/2020/02/cropped-HOMI-realeastate-company-logo.png" class="custom-logo" alt="HOMI" srcset="https://staging.homi.com.gr/wp-content/uploads/2020/02/cropped-HOMI-realeastate-company-logo.png 558w, https://staging.homi.com.gr/wp-content/uploads/2020/02/cropped-HOMI-realeastate-company-logo-300x102.png 300w, https://staging.homi.com.gr/wp-content/uploads/2020/02/cropped-HOMI-realeastate-company-logo-16x5.png 16w" sizes="(max-width: 558px) 100vw, 558px" style="width: 100px;height: auto;margin: 0 auto;display: block;" width="558" height="190"></a>
					</div>
				</div>
				<div id="emailSubHeader" style="padding: 25px 0;background-color: #044e93;color: #fff;text-align: center;font-size: 16px;font-weight: bold;">
					<?php echo $this->header; ?>
				</div>
				<div id="emailBody" style="background-color: #fff;padding: 20px; color:#000;">

					<p>
						Hello,
					</p>

					<?php echo $this->body; ?>

					<p>
						Sent by <strong style="color:#045fb4;">Profenda</strong>
					</p>

				</div>

				<div id="emailFooter" style="text-align: center;background-color: #045fb4;color: #fff;padding: 30px 20px;font-size:12px;">
					Το παρόν email αποτελεί ανακοίνωση νομικού περιεχομένου. Δεν αποτελεί προϊόν μάρκετινγκ ή προοωθητική ενέργεια. Για το λόγο αυτό λάβατε το προκείμενο email, παρόλο που ενδέχεται να είχατε απεγγραφεί
					από τις προωθητικές μας ενημερώσεις.
				</div>
				<div id="emailSubFooter" style="background-color: #044e93;text-align: center;color: #fff;padding: 20px;font-size:12px;">
					Copyright © 2021 homi.com.gr
					<br>Με επιφύλαξη κάθε νόμιμου δικαιώµατος
					<div style="margin-top: 15px;font-size: 12px;color: #95c0e8;">Profenda</div>
				</div>
				<div id="sentTo" style="text-align: center;color: #000;padding: 20px 0">
					Sent to: <a href="mailto:<?php echo $this->user->user_email; ?>"><?php echo $this->user->user_email; ?></a>
				</div>
			</div>
		</div>

		<?php

		return ob_get_clean();

	}

}
