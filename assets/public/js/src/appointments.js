(function ($) {
    'use strict';

    $(document).ready(function(){


        if ($('body.appointment-receiver').length > 0) {

            $('input[type=radio][name=appointment_method_selected]').change(function() {

                var appointment_method_selected = this.value;

                $( ".appointment_method" ).removeClass( "display-block" )
                $( ".appointment_method" ).addClass( "hide" )

                switch(appointment_method_selected) {

                    case 'physical_location':

                        $( ".method_selected_location" ).removeClass( "hide" )
                        $( ".method_selected_location" ).addClass( "display-block" )

                        $( ".method_selected_event_location" ).removeClass( "hide" )
                        $( ".method_selected_event_location" ).addClass( "display-block" )

                        break;

                    case 'phone_call':

                        $( ".method_selected_telephone" ).removeClass( "hide" )
                        $( ".method_selected_telephone" ).addClass( "display-block" )

                        break;


                    case 'remote_online':

                        $( ".method_selected_zoom_link" ).removeClass( "hide" )
                        $( ".method_selected_zoom_link" ).addClass( "display-block" )

                        $( ".method_selected_webex_link" ).removeClass( "hide" )
                        $( ".method_selected_webex_link" ).addClass( "display-block" )

                        $( ".method_selected_teams_link" ).removeClass( "hide" )
                        $( ".method_selected_teams_link" ).addClass( "display-block" )

                        break;


                    default:
                        console.log('default');
                }

            });

        }

    });

})( jQuery );