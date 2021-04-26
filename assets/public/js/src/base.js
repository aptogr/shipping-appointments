(function ($) {
    'use strict';

    $(document).ready(function(){

        $( ".checkboxradio" ).checkboxradio();
        $( ".spinner15" ).spinner({min: 0,step: 15});
        $( ".spinner0" ).spinner({min: 0});
        $( ".spinner1" ).spinner({min: 1});

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


        $(".dayBox").on("click", function () {
            var that = $(this);

            if (that.find('.weekDay').prop("checked")) {

                that.parent().removeClass('active');
                that.find('.weekDay').attr('checked', false)
                that.parent().find('.timeFromTo').hide(500);
                // that.parent().find('.timeFromTo').removeClass('display-block');

            } else {

                that.parent().addClass('active');
                that.find('.weekDay').attr('checked', true);
                // that.parent().find('.timeFromTo').addClass('display-block');
                that.parent().find('.timeFromTo').show(500);

            }

        })

        // $(".radioChecker").change(function(){
        //     console.log('asd');
        // });

        function radioDisplay(id,name) {

            $(id + ' input').on('change', function() {
                console.log($('input[name='+ name +']:checked', id).val())
            });


        }

        // radioDisplay('#minimum_notice_section','minimum_notice');

    });

})( jQuery );
