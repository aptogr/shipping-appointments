/*  global AjaxController */
(function ($) {
    'use strict';

    var excludedDatesSelected = new Array();
    var excludedDatesSelectedTemp = new Array();


    $(document).ready(function(){

        if ($('body.shippingappointments').length > 0) {
            var disableTimeRanges = [
                ['11:00', '11:31'],
                ['15:00', '17:00'],
                ['20:00', '21:31']
            ];
            // $('input.timepicker').timepicker({
            //     'timeFormat': 'HH:mm',
            //     // scrollbar: true,
            //     change: timeChange
            // });
            $('input.timepicker').timepicker({
                'timeFormat': 'H:i',
                'show2400': true,
                'disableTimeRanges': disableTimeRanges
            });

        }

        function timeChange() {
            // var that = $(this)
            // that.attr('value', that.val())
            // console.log(that.val());
            console.log('ou lala');
        }

        $('input.timepicker').on("selectTime", function() {
            var that = $(this)
            that.attr('value', that.val())
            console.log(that.val());
        });

        if ($('.calendar').length > 0) {
            console.log('calendar detected');

            if ($('.calendar').data('disabledates').length > 0) {
                var disabledatesHTML = $('.calendar').data('disabledates');
                var disabledatesHTML = disabledatesHTML.split(",");
            }


            if ($('.calendar').data('scheduledates').length > 0) {
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
                    event.preventDefault();

                    if ($('body.shippingappointments').length > 0) {
                        console.log('shippingappointments click');
                        // var dateId = date.replace(new RegExp('-', 'g'),"")
                        // console.log(dateId)
                        $('#shippingDay').attr('value', date)
                        $('.dayDisplay').html(date)
                    }


                    if (excludedDatesSelected.indexOf(date) === -1) {

                        excludedDatesSelected.push(date);
                        console.log(excludedDatesSelected);
                        $('#excluded_dates').val(excludedDatesSelected);
                        var dateDiv = "<div class='exludeDaysBox' data-selecteddate='" + date + "'>" + date + " <div class='selectedDateDelete' data-selecteddate='" + date + "' >x</div></div>";
                        $('#excludedDatesDiv').append(dateDiv)

                    } else {
                        console.log("This date already exists");
                        // excludedDatesSelectedTemp = excludedDatesSelected.filter(function(x){
                        //     return x !== date;
                        // });
                        //
                        // excludedDatesSelected = excludedDatesSelectedTemp;
                        //
                        // $('#excluded_dates').val(excludedDatesSelected);
                        // $('*[data-selecteddate='+date+']').remove();
                    }

                }

            });

        }

        if ($('body.page-template-booking-settings').length > 0) {

            $( "#meeting_duration" ).spinner();
            $( "#meeting_buffer" ).spinner();
            $( "#max_meetings_per_day" ).spinner();
            $( "#book_in_advance_days" ).spinner();
            $( "#meet_same_supplier_times" ).spinner();

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

            });

            $('.kati').on('click', function(){


                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.getBookingTimes,
                        data: $modalContent.find('form').serialize()
                    },
                    beforeSend: function () {

                        $modalLoader.removeClass('hide');

                    },
                    success: function (response) {

                        console.log(response);

                        $.each( response.formData, function(index, value){
                            $(".edit-property-object-block--content--field[data-field='" + index + "']").find('.col-value').text(value);
                        });

                        closeModal();
                    }

                });//end ajax

            });

        }
    });

})( jQuery );
