(function ($) {
    'use strict';

    $(document).ready(function(){

        $( ".checkboxradio" ).checkboxradio();


        $('input.timepickerGeneral').timepicker({
            'timeFormat': 'H:i',
            'show2400': true,
            'step': 15,
        });


        if ($('body.shippingappointments').length > 0) {

            $('input.timepicker').timepicker({
                'timeFormat': 'H:i',
                'show2400': true,
                'step': 15,
            });
        }


        $('input.timepicker, input.timepickerGeneral').on("selectTime", function() {

            var that = $(this)
            that.attr('value', that.val())
            console.log(that.val());
        });


        if ($('body.page-template-booking-settings').length > 0) {

            $( ".spinner15" ).spinner({min: 0,step: 15});
            $( ".spinner0" ).spinner({min: 0});
            $( ".checkboxradio" ).checkboxradio();
        }

    });

})( jQuery );