<?php

namespace ShippingAppointments\Traits;

Trait InputFunctions {

    function displayInputValue ($value) {
        return (!empty($value)) ? $value : "" ;
    }

    function displayDropDownValue ($valueid,$value) {
        return ($valueid == $value) ? 'selected' : "" ;
    }
    function displayRadioValue ($valueid,$value) {
        return ($valueid == $value) ? 'checked' : "" ;
    }

}