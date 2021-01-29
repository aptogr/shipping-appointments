<?php
get_header();

$plugin_dir = ABSPATH . 'wp-content/plugins/shipping-appointments/templates/public/user/';


$user = get_queried_object();


if( user_can($user->ID, 'supplier_user') ){

	include $plugin_dir . 'supplier_user.php';

}
else {
	include $plugin_dir . 'shipping_user.php';
}

?>

<?php

get_footer();
