<?php


namespace ShippingAppointments\Service\Dashboard\Settings;


class DashboardSettingsCompany extends DashboardSettings {

    public function displayCheckboxValue ($id,$value) {
        if (is_array($value)) {
            if (in_array($id,$value)) {
                echo 'checked';
            } else {
                echo '';
            }
        } else {
            if ($id == $value) {
                echo 'checked';
            }
        }
    }

}