(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('.company-settings').length > 0 ){

            $('#meeting_type input').on('change', function(){

                if( $('#meeting_type input:checked').val() === 'company' ){

                    $('#meeting_types_available').removeClass('hide');
                }
                else {
                    $('#meeting_types_available').addClass('hide');
                }

            });

            $('#minimum_notice_section input').on('change', function(){

                if( $('#minimum_notice_section input:checked').val() === 'minimum_notice_in_advance' ){

                    $('#book_in_advance_field').removeClass('hide');
                }
                else {
                    $('#book_in_advance_field').addClass('hide');
                }

            });

            $('#meeting_repetition_section input').on('change', function(){

                if( $('#meeting_repetition_section input:checked').val() === 'meeting_repetition_limit' ){

                    $('#meeting_repetition_time_section').removeClass('hide');

                }
                else {
                    $('#meeting_repetition_time_section').addClass('hide');
                }

            });


            $('#instant_booking input').on('change', function(){

                if( $('#instant_booking input:checked').val() === 'accept_specific' ){

                    $('#instant_booking_products_brands').removeClass('hide');

                }
                else {
                    $('#instant_booking_products_brands').addClass('hide');
                }

            });

        }


    });

})( jQuery );
