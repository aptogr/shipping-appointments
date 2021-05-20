/* global AjaxController */
(function ($) {
    'use strict';

    $(document).ready(function(){


        var loading = $('.loading-field ');
        var yesterdayDate = new Date(Date.now() - 864e5).toJSON().slice(0,10).toString();


        function insertParam(key, value) {

            // key = escape(key); value = escape(value);
            //
            // var kvp = document.location.search.substr(1).split('&');
            // if (kvp === '') {
            //     document.location.search = '?' + key + '=' + value;
            // }
            // else {
            //
            //     var i = kvp.length; var x; while (i--) {
            //         x = kvp[i].split('=');
            //
            //         if (x[0] === key) {
            //             x[1] = value;
            //             kvp[i] = x.join('=');
            //             break;
            //         }
            //     }
            //
            //     if (i < 0) { kvp[kvp.length] = [key, value].join('='); }
            //
            //     if (history.pushState) {
            //
            //         var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + kvp.join('&');
            //         window.history.pushState({path: newurl}, '', newurl);
            //     }
            //
            // }

        }


        function initCalendar(){

            var calendar = $('.calendar');
            // Calendar things
            if (calendar.length > 0) {

                if (calendar.attr('data-bookinadvance')) {
                    var bookinadvance = calendar.data('bookinadvance');
                    yesterdayDate = new Date(new Date().getTime() + ( (24 * 60 * 60 * 1000) * ( bookinadvance - 1 ) ) ).toJSON().slice(0,10)
                }

                if (calendar.attr('data-disabledates')) {
                    var disabledatesHTML = calendar.data('disabledates').split(",");
                }


                if (calendar.attr('data-selecteddate')) {
                    var selecteddateHTML = calendar.data('selecteddate');
                }

                var disabledWeekdaysHTML = calendar.attr('data-disabledweekdays')

                if (!disabledWeekdaysHTML) {
                    var disabledWeekdaysHTML = "-1";
                }

                var disabledWeekdaysHTML = disabledWeekdaysHTML.split(",").map(Number);

                calendar.pignoseCalendar({
                    week: 1,
                    format: 'YYYY-MM-DD',
                    date: moment(selecteddateHTML),
                    disabledDates: disabledatesHTML,
                    disabledWeekdays: disabledWeekdaysHTML,
                    disabledRanges: [['2000-01-01', yesterdayDate]],

                    click: function (event, context) {

                        var that = $(this);
                        var date = that[0].dataset.date; //Hmerominia sto click
                        // console.log(date);

                        if (!that.hasClass('pignose-calendar-unit-disabled')) {

                            $('#date').val(date);
                            $('#date').trigger('change');

                            // var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                            // bookingSteps(stepNum);


                        } else {
                            console.log( date + ' has passed..' )
                        }

                    }

                });
            } // Calendar things END

        }

        function bookingSteps(stepNow) {

            var stepNow = parseInt(stepNow);
            var nextStep = stepNow + 1;

            $('.book-step-' + stepNow).addClass('completed');
            $('.book-step-' + nextStep).removeClass('disabled');


            if (nextStep !== 7) {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $('.book-step-' + nextStep).offset().top - 150
                }, 500);
            }

        }

        function initTimePicker(){

            if ($('#anyone').is(':checked')) {
                var disabledTimes = $('#depDisableTime').text();
                // console.log(disabledTimes);
                disabledTimes = JSON.parse( disabledTimes );
            } else {
                var disabledTimes = $('#userDisableTime').text();
                // console.log(disabledTimes);
                disabledTimes = JSON.parse( disabledTimes );
            }


            // console.log( disabledTimes );

            var defaultTime = $('#bookTime').val()
            console.log(defaultTime)

            $('#bookTime').timepicker({
                'timeFormat': 'H:i',
                'step': 15,
                'show2400': true,
                'disableTimeRanges': disabledTimes,
            });

            $('#bookTime').on('changeTime', function() {

                $(this).attr("value", $(this).val());
                $('#bookTimeHidden').attr("value", $(this).val());
                insertParam($(this).attr('name'), $(this).val());
                var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                bookingSteps(stepNum);
            });

        }


        function updateSteps(){

            jQuery.ajax({
                url: AjaxController.ajax_url,
                type: 'POST',
                data: {
                    action: AjaxController.bookGetEmployeesField,
                    data: $('#bookAppointment form').serialize()
                },
                beforeSend: function() {

                    loading.removeClass('hide');

                },
                success: function (response) {

                    // console.log(response);
                    loading.addClass('hide');
                    $('#employeeStep').find('.booking-step-field').html(response.employeeStep);
                    $('#dateStep').find('.booking-step-field').html(response.dateStep);
                    $('#timeStep').find('.booking-step-field').html(response.timeStep);
                    $('#meetingTypeStep').find('.booking-step-field').html(response.meetingTypeStep);

                    initCalendar();
                    initTimePicker();


                }

            });//end ajax

        }

        if( $('#bookAppointment').length > 0 ) {


            $(document).on('submit','form',function(e){


                if ($('#bookTime').val() === "" ) {

                    e.preventDefault();

                    // $('#bookTime').stop().css("background-color", "#FFFF9C").animate({ backgroundColor: "#FFFFFF"}, 1500);
                    $('#bookTime').addClass('shadow-required');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#bookTime").offset().top - 150
                    }, 1500);

                }

            });

            $(document).on('change', '#departmentField input', function(){

                insertParam($(this).attr('name'), $(this).val());

                var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                bookingSteps(stepNum);

                updateSteps();


            });

            $(document).on('click', '.select-employee-btn', function (e) {

                e.preventDefault();

                if (!$(this).closest('tr').hasClass('selected')) {

                    $('.select-employees-table tr.selected').find('.select-employee-btn').text('Select this Employee');
                    $('.select-employees-table').find('tr.selected').removeClass('selected');
                    $(this).closest('tr').addClass('selected');
                    $(this).text('Selected');

                    $('#selectedEmployee').val($(this).attr('data-id'));
                    $('#employeeStep').addClass('completed');

                    insertParam('selectedEmployee', $('#selectedEmployee').val());

                    var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                    bookingSteps(stepNum);

                    updateSteps();


                }


            });


            $(document).on('change', '#employeeType input', function(){

                if( $('#employeeType input:checked').val() === 'specific' ){

                    $('.select-employees-table').removeClass('hide');
                    $('#employeeStep').removeClass('completed');
                    $('#view-availability-dep').addClass('hide');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $('.select-employees-table').offset().top - 150
                    }, 1500);


                }

                else {
                    $('#employeeStep').addClass('completed');
                    $('.select-employees-table').addClass('hide');
                    $('.select-employees-table tr.selected').removeClass('selected');
                    $('#selectedEmployee').val('');
                    $('#view-availability-dep').removeClass('hide');

                    insertParam($(this).attr('name'), $(this).val());
                    var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                    bookingSteps(stepNum);

                }

                updateSteps();
            });

            $(document).on('change', '#meetingTypeStep input', function(){

                insertParam($(this).attr('name'), $(this).val());

                var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                bookingSteps(stepNum);

                updateSteps();
            });

            $(document).on('change', '#meetingInformationStep input', function(){

                insertParam($(this).attr('name'), $(this).val());

                var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                bookingSteps(stepNum);

                updateSteps();
            });

            $(document).on('change', '#date', function(){

                if( $(this).val() ){
                    $('#dateStep').addClass('completed');
                }
                else{
                    $('#dateStep').removeClass('completed');
                }

                insertParam($(this).attr('name'), $(this).val());

                var stepNum = $(this).closest('.booking-step-wrapper').find('.step-counter').text();
                bookingSteps(stepNum);

                updateSteps();

            });

            $(document).on('click', '.view-availability', function(e){

                e.preventDefault();

                var userID = $(this).attr('data-id');
                var name   = $(this).closest('tr').find('.employee-name').text();

                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.bookGetEmployeeAvailability,
                        user_id: userID
                    },
                    beforeSend: function() {

                        $('#availabilityModal').addClass('active');
                        $('.modal-overlay').addClass('active');
                        $('.profenda-modal-header').text('Availability of ' + name );

                    },
                    success: function (response) {

                        $('#availabilityModal .profenda-modal-content').html( response.html );

                    }

                });//end ajax

            });

            $(document).on('click', '.view-availability-dep', function(e){

                var depID = $(this).attr('data-depid');
                console.log(depID);

                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.bookGetDepartmentAvailability,
                        depid: depID
                    },
                    beforeSend: function() {

                        $('#availabilityModal').addClass('active');
                        $('.modal-overlay').addClass('active');
                        $('.profenda-modal-header').text('Availability of Department' );

                    },
                    success: function (response) {
                        // console.log(response);
                        $('#availabilityModal .profenda-modal-content').html( response.html );

                    }

                });//end ajax

            });

        }

    });

})( jQuery );
