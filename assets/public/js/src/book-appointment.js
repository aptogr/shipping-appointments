/* global AjaxController */
(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('#bookAppointment').length > 0 ) {

            var loading = $('.loading-field ');

            $(document).on('change', '#departmentField input', function(){

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
                        $('#employeeStep').find('.booking-step-field').html(response.html);

                    }

                });//end ajax

            });

            $(document).on('click', '.select-employee-btn', function (e) {

                e.preventDefault();

                if (!$(this).closest('tr').hasClass('selected')) {

                    $('.select-employees-table tr.selected').find('.select-employee-btn').text('Select this Employee');
                    $('.select-employees-table').find('tr.selected').removeClass('selected');
                    $(this).closest('tr').addClass('selected');
                    $(this).text('Selected');

                    $('#selectedEmployee').val($(this).attr('data-id'));

                }


            });

            $(document).on('change', '#employeeType input', function(){

                if( $('#employeeType input:checked').val() === 'specific' ){

                    $('.select-employees-table').removeClass('hide');

                }
                else {
                    $('.select-employees-table').addClass('hide');
                    $('#selectedEmployee').val();
                }

            });

        }

    });

})( jQuery );
