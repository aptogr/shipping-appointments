(function ($) {
    'use strict';



    // $(window).load(function() {
    //     $('#appointmentsListView').addClass('hide');
    //     console.log('page loaded')
    // });

    $(document).ready(function(){

        // $('#appointmentsListView').addClass('hide');

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

            var appointmentsJSON = JSON.parse($('#jsonAppointments').html());

            var cal = new tui.Calendar('#tuiCalendar', {
                defaultView: 'month',
                taskView: true,
                useCreationPopup: false,
                useDetailPopup: false,
                disableClick: true,
                disableDblClick: true,
                month: {
                    narrowWeekend: false,
                    startDayOfWeek: 1, // monday
                },
            });

            function monthDisplay() {
                var daDate = cal._renderDate._date;
                var daMonth = daDate.toLocaleString('en-EN', { month: 'long' });
                var daYear = daDate.toLocaleString('en-EN', { year: 'numeric' });
                // console.log(daYear)
                $('#renderRange').text( daMonth + ' ' + daYear)
            }

            monthDisplay()

            cal.createSchedules(appointmentsJSON);


            $('.prev-month').on( "click", function() {
                cal.prev();
                monthDisplay()
            })

            $('.next-month').on( "click", function() {
                cal.next();
                monthDisplay()
            })

            $('.move-today').on( "click", function() {
                cal.today();
                monthDisplay()
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

            cal.on({
                'clickSchedule': function(e) {
                    // console.log('clickSchedule', e.schedule);

                    jQuery.ajax({
                        url: AjaxController.ajax_url,
                        type: 'POST',
                        data: {
                            action: AjaxController.getAppointmentsSchedule,
                            appointment_id: e.schedule.id,

                        },
                        success: function (response) {
                            // console.log(response);
                            $('#appointmentCalendarClick').html(response.html);
                            $('#appointmentCalendarClick').removeClass('hide');
                            $('#appointmentCalendarOverlay').removeClass('hide');

                        }

                    });//end ajax

                }
            });

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