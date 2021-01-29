(function ($) {
    'use strict';

    var excludedDatesSelected = new Array();
    var excludedDatesSelectedTemp = new Array();
    var yesterdayDate = new Date(Date.now() - 864e5).toJSON().slice(0,10).toString();



    $(document).ready(function(){

        if ($('body.shippingappointments').length > 0) {
            var disableTimeRanges = [
                ['11:00', '11:31'],
                ['15:00', '17:00'],
                ['20:00', '21:31']
            ];
            $('input.timepicker').timepicker({
                'timeFormat': 'H:i',
                'show2400': true,
                // 'disableTimeRanges': disableTimeRanges
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

        function timeAddMinutes(time, min) {

            var t = time.split(":"),
                h = Number(t[0]),
                m = Number(t[1]);

            m+= min % 60;
            h+= Math.floor(min/60);

            if (m >= 60) { h++; m-=60 }

            return (h+"").padStart(2,"0")  +":" +(m+"").padStart(2,"0") //create string padded with zeros for HH and MM
        }

        function shippingUserAjaxAppend(date) {

            $('#shippingDay').attr('value', date)

            // fullDay
            jQuery.ajax({
                url: AjaxController.ajax_url,
                type: 'POST',
                data: {
                    action: AjaxController.getTime,
                    date: date
                },
                success: function (response) {

                    console.log(response);
                    // console.log(response.disableTime);


                    $('#selectedShippingDates').empty()
                    $('#selectedShippingDates').append(response.html).ready(function () {

                        $('input.timepicker').timepicker({
                            'timeFormat': 'H:i',
                            'show2400': true,
                            'disableTimeRanges': response.disableTime
                        });

                    })

                    $('.dayDisplay').html(
                        response.fullDay + ' ' + response.date +
                        ' <br> ' +
                        'Meeting time duration: ' + response.meetingDuration + ' minutes'
                    )

                    $('input.timepicker').on("selectTime", function() {
                        var that = $(this)
                        that.attr('value', that.val())
                        console.log(that.val());

                        var newDateObj = timeAddMinutes(that.val(),response.meetingDuration)

                        $('.shippingDayTo').val(newDateObj);
                        $('.shippingDayTo').attr('value', newDateObj)
                    });

                }

            });//end ajax

        }

        $('input.timepicker').on("selectTime", function() {
            var that = $(this)
            that.attr('value', that.val())
            console.log(that.val());
        });

        if ($('.calendar').length > 0) {
            console.log('calendar detected');

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

                    var that = $(this);
                    var date = that[0].dataset.date; //Hmerominia sto click
                    // console.log(date)
                    event.preventDefault();
                    // console.log(that)

                    if (!that.hasClass('pignose-calendar-unit-disabled')) {


                        if (that.closest('.calendar').hasClass( "shippingUser" )) {

                            shippingUserAjaxAppend( date )

                        }

                        if (that.closest('.calendar').hasClass( "availability" )) {

                            availabilityCalendar( date )

                        }


                    } else {
                        console.log( date + ' has passed..' )
                    }


                }

            });

        }

        if ($('body.page-template-booking-settings').length > 0) {

            $( "#meeting_duration" ).spinner({min: 0});
            $( "#meeting_buffer" ).spinner({min: 0});
            $( "#max_meetings_per_day" ).spinner({min: 0});
            $( "#book_in_advance_days" ).spinner({min: 0});
            $( "#meet_same_supplier_times" ).spinner({min: 0});

            $( "#booking_request_type_email" ).checkboxradio();
            $( "#booking_request_type_instant" ).checkboxradio();

        }

        if ($('body.page-template-availability').length > 0) {

            var excludedDatesSelectedInput = $('#excluded_dates').val();

            if (excludedDatesSelectedInput.length > 0) {
                excludedDatesSelected = excludedDatesSelectedInput.split(",");
            }

            console.log(excludedDatesSelectedInput);

            $('input.timepicker').timepicker({
                'timeFormat': 'H:i',
                'show2400': true,
            });

            //




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


            });


            $(".dayBox").on("click", function () {
                var that = $(this);


                if (that.find('.weekDay').prop("checked")) {

                    that.parent().removeClass('active');
                    that.find('.weekDay').attr('checked', false)
                    that.parent().find('.timeFromTo').hide(500);
                    // that.parent().find('.timeFromTo').removeClass('display-block')

                } else {

                    that.parent().addClass('active');
                    that.find('.weekDay').attr('checked', true);
                    // that.parent().find('.timeFromTo').addClass('display-block')
                    that.parent().find('.timeFromTo').show(500);

                }

            })

        }
    });

})( jQuery );