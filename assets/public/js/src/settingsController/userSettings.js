(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('.user-settings').length > 0 ){

            $('#minimum_notice_section input').on('change', function(){

                if( $('#minimum_notice_section input:checked').val() === 'minimum_notice_in_advance' ){

                    $('#book_in_advance_days').removeClass('hide');
                }
                else {
                    $('#book_in_advance_days').addClass('hide');
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
