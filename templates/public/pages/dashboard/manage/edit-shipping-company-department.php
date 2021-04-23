<?php
get_header();
//$departmentId = intval(get_query_var('department'));

$plugin_dir = ABSPATH . 'wp-content/plugins/shipping-appointments/templates/public/pages/dashboard/manage/';

if (intval(get_query_var('department'))) {
    include $plugin_dir . 'edit-single-shipping-company-department.php';
} else {
    include $plugin_dir . 'list-shipping-company-departments.php';
}

get_footer();