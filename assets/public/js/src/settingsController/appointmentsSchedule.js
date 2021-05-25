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
            cal.today();
        });

        $('#appointmentCalendarOverlay').on( "click", function() {
            $('#appointmentCalendarClick').addClass('hide');
            $('#appointmentCalendarOverlay').addClass('hide');
        })

        if ($('.appointments_schedule').length > 0) {
            console.log('appointments_schedule loaded!');


            var appointmentsJSON = JSON.parse($('#jsontest').html());

            var cal = new tui.Calendar('#tuiCalendar', {
                defaultView: 'month',
                taskView: true,
                // useCreationPopup: true, // Did you turn this option on?
                useDetailPopup: true,
                disableClick: true,
                disableDblClick: true
            });

            cal.createSchedules(appointmentsJSON);


            $('.prev-month').on( "click", function() {
                cal.prev();
            })

            $('.next-month').on( "click", function() {
                cal.next();
            })

            $('.move-today').on( "click", function() {
                cal.today();
            })

            function setRenderRangeText() {
                var renderRange = document.getElementById('renderRange');
                var options = cal.getOptions();
                var viewName = cal.getViewName();
                var html = [];
                if (viewName === 'day') {
                    html.push(moment(cal.getDate().getTime()).format('YYYY.MM.DD'));
                } else if (viewName === 'month' &&
                    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
                    html.push(moment(cal.getDate().getTime()).format('YYYY.MM'));
                } else {
                    html.push(moment(cal.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
                    html.push(' ~ ');
                    html.push(moment(cal.getDateRangeEnd().getTime()).format(' MM.DD'));
                }
                renderRange.innerHTML = html.join('');
            }

            // mobiscroll.setOptions({
            //     locale: mobiscroll.localeEn,                // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            //     theme: 'ios',                               // Specify theme like: theme: 'ios' or omit setting to use default
            //     themeVariant: 'light'                   // More info about themeVariant: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-themeVariant
            // });
            //
            //
            //     var inst = $('#appointments_schedule').mobiscroll().eventcalendar({
            //
            //         height: 697,              // More info about height: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-height
            //         view: {                                 // More info about view: https://docs.mobiscroll.com/5-4-0/eventcalendar#opt-view
            //             calendar: { labels: true }
            //         },
            //         onEventClick: function (event, inst) {  // More info about onEventClick: https://docs.mobiscroll.com/5-4-0/eventcalendar#event-onEventClick
            //
            //             jQuery.ajax({
            //                 url: AjaxController.ajax_url,
            //                 type: 'POST',
            //                 data: {
            //                     action: AjaxController.getAppointmentsSchedule,
            //                     appointment_id: event.event.id,
            //
            //                 },
            //                 success: function (response) {
            //                     console.log(response);
            //                     $('#appointmentCalendarClick').html(response.html);
            //                     $('#appointmentCalendarClick').removeClass('hide');
            //                     $('#appointmentCalendarOverlay').removeClass('hide');
            //
            //                 }
            //
            //             });//end ajax
            //
            //         }
            //     }).mobiscroll('getInst');
            //
            //     // $.getJSON('https://trial.mobiscroll.com/events/?vers=5&callback=?', function (events) {
            //     //     console.log('AJAX JSON',events);
            //     //     inst.setEvents(events);
            //     // }, 'jsonp');
            //
            //     var appointmentsJSON = JSON.parse($('#jsontest').html());
            //     // console.log('appointmentsJSON',appointmentsJSON)
            //     inst.setEvents(appointmentsJSON);





        }

    });

})( jQuery );