(function ($) {
    'use strict';

    $(document).ready(function(){

        $('input[name=one_to_one_location]').on('change', function(){

            var inputValue = $(this).val();

            if ( inputValue == 'other' ) {
                $( "#locationAddress" ).removeClass( "hide" );
            } else {
                $( "#locationAddress" ).addClass( "hide" );
            }

        });

        function methodCases(method) {

            switch(method) {

                case 'physical_location':

                    $( "#locationType" ).removeClass( "hide" );
                    $( "#locationAddress" ).removeClass( "hide" );

                    $( "#webLink" ).addClass( "hide" );
                    $( "#phoneNumber" ).addClass( "hide" );

                    break;

                case 'phone_call':

                    $( "#phoneNumber" ).removeClass( "hide" );

                    $( "#locationType" ).addClass( "hide" );
                    $( "#locationAddress" ).addClass( "hide" );
                    $( "#webLink" ).addClass( "hide" );

                    break;

                case 'remote_online':

                    $( "#webLink" ).removeClass( "hide" );

                    $( "#locationType" ).addClass( "hide" );
                    $( "#locationAddress" ).addClass( "hide" );
                    $( "#phoneNumber" ).addClass( "hide" );

                    break;

                default:
                    console.log('default');
            }

        }

        methodCases($('input[name=appointment_method]').val());

        $('input[name=appointment_method]').on('change', function(){

            var that = $(this)
            var appointment_method_selected = that.val();

            // console.log(appointment_method_selected);

            methodCases(appointment_method_selected);


        });


    });

})( jQuery );