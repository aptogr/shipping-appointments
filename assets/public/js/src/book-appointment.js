/* global AjaxController */
(function ($) {
    'use strict';

    $(document).ready(function(){

        var loading = $('.loading-field ');

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

                    console.log(response);
                    loading.addClass('hide');
                    $('#employeeStep').find('.booking-step-field').html(response.employeeStep);
                    $('#dateStep').find('.booking-step-field').html(response.dateStep);
                    $('#timeStep').find('.booking-step-field').html(response.timeStep);
                    $('#meetingTypeStep').find('.booking-step-field').html(response.meetingTypeStep);

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


                }
                else {
                    $('#employeeStep').addClass('completed');
                    $('.select-employees-table').addClass('hide');
                    $('.select-employees-table tr.selected').removeClass('selected');
                    $('#selectedEmployee').val('');

                    updateSteps();
                }

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

        }

    });

})( jQuery );
