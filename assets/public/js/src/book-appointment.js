/* global AjaxController */
(function ($) {
    'use strict';

    $(document).ready(function(){

        var loading = $('.loading-field ');
        var yesterdayDate = new Date(Date.now() - 864e5).toJSON().slice(0,10).toString();


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
                        // console.log('context',context);
                        console.log('that',that[0]);
                        console.log('event',event);
                        console.log('context',context);

                        if (!that.hasClass('pignose-calendar-unit-disabled')) {

                            $('#date').val(date);
                            $('#date').trigger('change');



                        } else {
                            console.log( date + ' has passed..' )
                        }

                    }

                });
            } // Calendar things END

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

            $('#bookTime').timepicker({
                'timeFormat': 'H:i',
                'step': 15,
                'show2400': true,
                'disableTimeRanges': disabledTimes
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


            $(document).on('change', '#departmentField input', function(){

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

                    updateSteps();

                }


            });


            $(document).on('change', '#employeeType input', function(){

                if( $('#employeeType input:checked').val() === 'specific' ){

                    $('.select-employees-table').removeClass('hide');
                    $('#employeeStep').removeClass('completed');
                    $('#view-availability-dep').addClass('hide');

                }

                else {
                    $('#employeeStep').addClass('completed');
                    $('.select-employees-table').addClass('hide');
                    $('.select-employees-table tr.selected').removeClass('selected');
                    $('#selectedEmployee').val('');
                    $('#view-availability-dep').removeClass('hide');

                }

                updateSteps();
            });

            $(document).on('change', '#date', function(){

                if( $(this).val() ){
                    $('#dateStep').addClass('completed');
                }
                else{
                    $('#dateStep').removeClass('completed');
                }

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
