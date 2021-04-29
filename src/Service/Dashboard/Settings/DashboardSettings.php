<?php


namespace ShippingAppointments\Service\Dashboard\Settings;


class DashboardSettings {

    public function displayInputValue ($value) {
        echo (!empty($value)) ? $value : "" ;
    }


    public function displayRadioValue ($id,$value) {
        echo ($id == $value) ? 'checked' : "" ;
    }

    public function displayCheckboxValue ($id,$value) {
        echo (in_array($id,$value)) ? 'checked' : "" ;
    }

    public function excludedDatesDisplay($excluded_dates) {
        if (!empty($excluded_dates[0])) {
            foreach ($excluded_dates as $value) {
                echo "<div class='exludeDaysBox' data-selecteddate='".$value."'>".$value." <div class='selectedDateDelete' data-selecteddate='".$value."' >x</div></div>";
            }
        }
    }


    public function checkIfNull($time, $type) {
        if (empty($time)) {
            if ($type == 'from') {
                echo '6:00';
            } else {
                echo '23:00';
            }
        } else {
            echo $time;
        }
    }

    public function displayDay($day, $availability_weekdays,$type) {

        if (!empty($availability_weekdays)) {
            if (in_array($day,$availability_weekdays)) {
                if ($type == 'div') {
                    echo "display:block;";
                } elseif ($type == 'input') {
                    echo "checked";
                } elseif ($type == 'act') {
                    echo "active";
                }

            }
        }

    }

}
