(function ($) {
    'use strict';
    var excludedDatesSelected = new Array();
    var excludedDatesSelectedTemp = new Array();
    var yesterdayDate = new Date(Date.now() - 864e5).toJSON().slice(0,10).toString();

    $(document).ready(function(){

        console.log('calendar.js loaded')


        function departmentBook(day) {

            // console.log(day);

            var timeRanges = '00:00,' + $("#"+day+"TimeRange").val() + ',23:59' ;
            // console.log(timeRanges);
            var timeRangesArray = timeRanges.split(',');

            // console.log(timeRangesArray.length);

            var i;
            var timeRangesArray2D = [];

            for (i = 0; i < timeRangesArray.length;) {

                var from = moment(timeRangesArray[i], 'HH:mm').add( 1, 'minutes').format('HH:mm');
                var to = timeRangesArray[i+1];

                // console.log('from to',from, to);

                timeRangesArray2D.push( [ from,to ] )
                i = i + 2;
            }
            // console.log(timeRangesArray2D);

            $('#departmentBookTimeFrom').timepicker({
                'timeFormat': 'H:i',
                'step': 15,
                'show2400': true,
                'disableTimeRanges': timeRangesArray2D
            });

            $('#departmentBookTimeTo').timepicker({
                'timeFormat': 'H:i',
                'step': 15,
                'show2400': true,
                'disableTimeRanges': timeRangesArray2D
            });


        }
        function availabilityCalendar(date) {

            if (excludedDatesSelected.indexOf(date) === -1) {

                excludedDatesSelected.push(date);
                // console.log(excludedDatesSelected);
                $('#excluded_dates').val(excludedDatesSelected);
                var dateDiv = "<div class='exludeDaysBox' data-selecteddate='" + date + "'>" + date + " <div class='selectedDateDelete' data-selecteddate='" + date + "' >x</div></div>";
                $('#excludedDatesDiv').append(dateDiv)

            } else {
                console.log("This date already exists");
            }
        }

        /**
         * Prosthetei minutes se time
         */
        function timeAddMinutes(time, min) {

            var t = time.split(":"),
                h = Number(t[0]),
                m = Number(t[1]);

            m+= min % 60;
            h+= Math.floor(min/60);

            if (m >= 60) { h++; m-=60 }

            return (h+"").padStart(2,"0")  +":" +(m+"").padStart(2,"0") //create string padded with zeros for HH and MM
        }


        /**
         * Diafora xronou anamesa se 2 times (10:00 - 11:15 = 01:15)
         */
        function timeSubtractMinutes(now, then) {

            return moment.utc(moment(now,"HH:mm").diff(moment(then,"HH:mm"))).format("HH:mm")
        }

        /**
         * Ajax call function, imerominia kai to id tou xristi poy theloyme na kleisei rantevou
         */
        function ajaxFunction(date,da_post_author) {

            $('#shippingDay').attr('value', date)

            // fullDay
            jQuery.ajax({
                url: AjaxController.ajax_url,
                type: 'POST',
                data: {
                    action: AjaxController.getTime,
                    date: date,
                    da_post_author: da_post_author,
                },
                success: function (response) {

                    // console.log(response);

                    $('#bookingMethods').empty();
                    $('#selectedShippingDates').empty()

                    /**
                     * Elenxos gia to an exei diathesimo slot gia rantevou
                     */
                    if (response.appointmentLimit == true) {

                        $('#selectedShippingDates').append('<div class="full-width">Select time:</div>')
                        $('#selectedShippingDates').append(response.html).ready(function () {

                            $('input.timepicker').timepicker({
                                'timeFormat': 'H:i',
                                'step': 15,
                                'show2400': true,
                                'disableTimeRanges': response.disableTime
                            });

                        });

                        $('#bookingMethods').append('<div class="full-width margin-bottom-20">Select booking method:</div>');

                        $.each( response.booking_method, function( key, value ) {

                            var labelName =  value.replace("_", " ");
                            labelName = labelName.charAt(0).toUpperCase() + labelName.slice(1);

                            var bookingCheckBox = '<div class="col no-padding-left">' +
                                '<input type="checkbox" id="booking_method_'+value+'" name="appointment_method[]" value="'+ value +'">' +
                                '<label for="booking_method_'+value+'">'+labelName+'</label><br>' +
                                '</div>';
                            $('#bookingMethods').append(bookingCheckBox).ready(function () {
                                $( '#booking_method_'+value ).checkboxradio();
                            })
                        });

                        /**
                         * Elenxos gia to an to booking_request_type einai instant i email
                         * Sto instant dialegei 'from time' kai aftomata simplironete to 'to time' analoga to meetingDuration pou exei dialeksei
                         * Sto email epilegei kai ta 2
                         */

                        if (response.booking_request_type=='instant') {

                            $('.dayDisplay').html(
                                '<strong>' +
                                response.fullDay + ' ' + response.date +
                                '</strong> <br> ' +
                                'Meeting time duration: ' + response.meetingDuration + ' minutes'
                            )

                            $('.shippingDayFrom').on("selectTime", function() {
                                var that = $(this)
                                that.attr('value', that.val())
                                console.log(that.val());

                                var newDateObj = timeAddMinutes(that.val(),response.meetingDuration)

                                $('.shippingDayTo').val(newDateObj);
                                $('.shippingDayTo').attr('value', newDateObj)
                            });

                        } else if (response.booking_request_type=='email') {

                            $('.dayDisplay').html(
                                '<strong>' +
                                response.fullDay + ' ' + response.date +
                                '</strong>'
                            )

                            $('.shippingDayTo').on("selectTime", function() {
                                var that = $(this)
                                that.attr('value', that.val())

                                var meeting_time_duration = timeSubtractMinutes(that.val(), $('.shippingDayFrom').val());
                                console.log(meeting_time_duration)
                                $('#meeting_time_duration').attr('value', meeting_time_duration)
                            });

                            // var meeting_time_duration = timeSubtractMinutes(now, then);

                        }

                        /**
                         * Stin periptosi pou den exei diathesimo slot gia rantevou
                         */
                    } else {

                        $('.dayDisplay').html(
                            '<strong>' +
                            response.fullDay + ' ' + response.date +
                            '</strong> <br> ' +
                            'Max Appointments for this Day.'
                        )

                    }



                }

            });//end ajax

        }



        /**
         * Elenxos an uparxei calendar sto page, oste na treksoun ta functions
         */
        if ($('.calendar').length > 0) {
            // console.log('calendar detected');

            if ($('.calendar').attr('data-bookinadvance')) {
                var bookinadvance = $('.calendar').data('bookinadvance');
                yesterdayDate = new Date(new Date().getTime() + ( (24 * 60 * 60 * 1000) * ( bookinadvance - 1 ) ) ).toJSON().slice(0,10)
            }


            if ($('.calendar').attr('data-disabledates')) {
                var disabledatesHTML = $('.calendar').data('disabledates');
                var disabledatesHTML = disabledatesHTML.split(",");
            }


            if ($('.calendar').attr('data-timefromto')) {
                var timefromto = $('.calendar').data('timefromto');
                console.log(timefromto);
            }


            if ($('.calendar').attr('data-scheduledates')) {
                var scheduledatesHTML = $('.calendar').data('scheduledates');
                var scheduledatesHTML = scheduledatesHTML.split(",");
            }

            var disabledWeekdaysHTML = $('.calendar').attr('data-disabledweekdays')

            if (!disabledWeekdaysHTML) {
                var disabledWeekdaysHTML = "-1";
            }

            var disabledWeekdaysHTML = disabledWeekdaysHTML.split(",").map(Number);

            var schedules = ['null/2020-01-17'];

            scheduledatesHTML.forEach(function (entry) {

                var namedate = entry.split("/");
                var namedate = {
                    name: namedate[0],
                    date: namedate[1]
                }

                schedules.push(namedate);

            });

            // console.log(schedules);

            $('.calendar').pignoseCalendar({
                week: 1,
                format: 'YYYY-MM-DD',
                schedules: schedules,
                disabledDates: disabledatesHTML,
                disabledWeekdays: disabledWeekdaysHTML,
                disabledRanges: [['2000-01-01', yesterdayDate]],
                // disabledRanges: [['2000-01-01', '2021-01-26']],

                init: function (context) {

                    Object.keys(schedules).forEach(function (key) {

                        var daName = schedules[key].name;
                        var daDate = schedules[key].date;

                        $('#scheduleList').append('<div class="schedule schedule-' + key + '" data-eventdate="' + daDate + '">' + daName + ' / ' + daDate + '</div>')
                        $('[data-date=' + daDate + ']').find('a').css('border', '1px solid');
                        $('[data-date=' + daDate + ']').find('a').css('border-color', '#059100');

                    });
                },

                select: function (date, context) {

                    if (context.storage.schedules.length > 0) {

                        console.log('Events for this date: ', context.storage.schedules[0].name);
                        $('.schedule').css('background-color', '#fff')
                        $('[data-eventdate=' + context.storage.schedules[0].date + ']').css('background-color', '#059100');

                    }

                },

                click: function (event, context) {

                    // console.log('context',context);
                    // console.log('that',$(this));

                    var that = $(this);
                    var date = that[0].dataset.date; //Hmerominia sto click
                    event.preventDefault();

                    if (!that.hasClass('pignose-calendar-unit-disabled')) {

                        if (that.closest('.calendar').hasClass( "shippingUser" )) {

                            var da_post_author = $('#da_post_author').val();
                            ajaxFunction( date,da_post_author )

                        }

                        if (that.closest('.calendar').hasClass( "availability" )) {

                            availabilityCalendar( date )

                        }

                        if (that.closest('.calendar').hasClass( "departmentBook" )) {

                            // console.log(context.storage);
                            var day = moment(date).format('ddd').toLowerCase();
                            departmentBook(day);

                        }

                    } else {
                        console.log( date + ' has passed..' )
                    }

                }

            });

        }

        if ($('body.page-template-availability').length > 0) {

            $('input.timepicker').timepicker({
                'timeFormat': 'H:i',
                'show2400': true,
                'step': 15,
            });




        }

        if ($('#excluded_dates').length) {

            var excludedDatesSelectedInput = $('#excluded_dates').val();

            if (excludedDatesSelectedInput.length > 0) {
                excludedDatesSelected = excludedDatesSelectedInput.split(",");
            }
            // console.log('excludedDatesSelected',excludedDatesSelected);
            // console.log('excludedDatesSelectedInput',excludedDatesSelectedInput);
        }

        $("#excludedDatesDiv").on("click", ".selectedDateDelete", function () {

            var that = $(this);

            var date = that.parent().data('selecteddate');

            // console.log(date);

            excludedDatesSelectedTemp = [];

            excludedDatesSelectedTemp = excludedDatesSelected.filter(function (x) {
                return x !== date;
            });

            excludedDatesSelected = excludedDatesSelectedTemp;
            $('#excluded_dates').val(excludedDatesSelected);
            that.parent().remove();
            // console.log(excludedDatesSelected);

        });

    });

})( jQuery );