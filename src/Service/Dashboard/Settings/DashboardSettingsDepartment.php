<?php


namespace ShippingAppointments\Service\Dashboard\Settings;


class DashboardSettingsDepartment extends DashboardSettings {

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

    public function excludedDatesDisplay($excluded_dates) {
        if (!empty($excluded_dates[0])) {
            $excluded_dates = explode(",", $excluded_dates);
            foreach ($excluded_dates as $value) {
                echo "<div class='exludeDaysBox' data-selecteddate='".$value."'>".$value." <div class='selectedDateDelete' data-selecteddate='".$value."' >x</div></div>";
            }
        }
    }

}
