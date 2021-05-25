(function ($) {
    'use strict';

    $(document).ready(function(){

        $("#toggleAppointmentsView").on( "click", function() {

            if ($( "#appointmentsListView" ).hasClass( "hide" )) {
                $("#toggleAppointmentsView").html('Calendar View');
            } else {
                $("#toggleAppointmentsView").html('List View');
            }

            $( "#appointmentsCalendarView" ).toggleClass( "hide" );
            $( "#appointmentsListView" ).toggleClass( "hide" );

        });

        $('#appointmentCalendarOverlay').on( "click", function() {
            $('#appointmentCalendarClick').addClass('hide');
            $('#appointmentCalendarOverlay').addClass('hide');
        })

        if ($('.appointments_schedule').length > 0) {

            console.log('appointments_schedule loaded');

            // tuiCalendar
            var calendar = new tui.Calendar(document.getElementById('tuiCalendar'), {
                defaultView: 'week',
                taskView: true,    // Can be also ['milestone', 'task']
                scheduleView: true,  // Can be also ['allday', 'time']
                template: {
                    milestone: function(schedule) {
                        return '<span style="color:red;"><i class="fa fa-flag"></i> ' + schedule.title + '</span>';
                    },
                    milestoneTitle: function() {
                        return 'Milestone';
                    },
                    task: function(schedule) {
                        return '&nbsp;&nbsp;#' + schedule.title;
                    },
                    taskTitle: function() {
                        return '<label><input type="checkbox" />Task</label>';
                    },
                    allday: function(schedule) {
                        return schedule.title + ' <i class="fa fa-refresh"></i>';
                    },
                    alldayTitle: function() {
                        return 'All Day';
                    },
                    time: function(schedule) {
                        return schedule.title + ' <i class="fa fa-refresh"></i>' + schedule.start;
                    }
                },
                month: {
                    daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    startDayOfWeek: 0,
                    narrowWeekend: true
                },
                week: {
                    daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    startDayOfWeek: 0,
                    narrowWeekend: true
                }
            });
            // mobiscroll.setOptions({
            //     locale: mobiscroll.localeEn,                // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            //     theme: 'ios',                               // Specify theme like: theme: 'ios' or omit setting to use default
            //     themeVariant: 'light'                   // More info about themeVariant: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-themeVariant
            // });


            // var inst = $('#appointments_schedule').mobiscroll().eventcalendar({
            //
            //     height: 697,              // More info about height: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-height
            //     view: {                                 // More info about view: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-view
            //         calendar: { labels: true }
            //     },
            //     onEventClick: function (event, inst) {  // More info about onEventClick: https://docs.mobiscroll.com/5-4-0/eventcalendar#event-onEventClick
            //
            //         jQuery.ajax({
            //             url: AjaxController.ajax_url,
            //             type: 'POST',
            //             data: {
            //                 action: AjaxController.getAppointmentsSchedule,
            //                 appointment_id: event.event.id,
            //
            //             },
            //             success: function (response) {
            //                 console.log(response);
            //                 $('#appointmentCalendarClick').html(response.html);
            //                 $('#appointmentCalendarClick').removeClass('hide');
            //                 $('#appointmentCalendarOverlay').removeClass('hide');
            //
            //             }
            //
            //         });//end ajax
            //
            //     }
            // }).mobiscroll('getInst');
            //
            // // $.getJSON('https://trial.mobiscroll.com/events/?vers=5&callback=?', function (events) {
            // //     console.log('AJAX JSON',events);
            // //     inst.setEvents(events);
            // // }, 'jsonp');
            //
            // var appointmentsJSON = JSON.parse($('#jsontest').html());
            // // console.log('appointmentsJSON',appointmentsJSON)
            // inst.setEvents(appointmentsJSON);





        }

    });

})( jQuery );