(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('.department-settings').length > 0 ){

            $('#meeting_type input').on('change', function(){

                if( $('#meeting_type input:checked').val() === 'department' ){

                    $('#meeting_types_available').removeClass('hide');
                }
                else {
                    $('#meeting_types_available').addClass('hide');
                }

            });

            $('#minimum_notice_section input').on('change', function(){

                if( $('#minimum_notice_section input:checked').val() === 'minimum_notice_in_advance' ){

                    $('#minimum_notice_hours_field').removeClass('hide');
                }
                else {
                    $('#minimum_notice_hours_field').addClass('hide');
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

        }


    });

})( jQuery );
