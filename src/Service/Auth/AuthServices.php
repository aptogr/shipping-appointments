<?php


namespace ShippingAppointments\Service\Auth;


use Exception;
use ShippingAppointments\Controller\Notifications\UserAuthNotificationsController;
use WP_User;

class AuthServices {


    public function sendNewUserNotifications( $user_id ){

        $user = get_user_by('ID', $user_id );

        if( $user instanceof WP_User ){

            $notificationsController = new UserAuthNotificationsController();
            $notificationsController->sendNotifications( $user, 'new_user_register' );

        }

    }

}
