(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('.company-settings').length > 0 ){


            $('.departmentCheckBox').on( 'change', function () {

                var that = $(this);

                if(this.checked) {

                    if (that.closest('tr').hasClass('existing-department')) {
                        console.log('existing-department');

                        if ( that.closest('.department_availability').text() == 'Availability not set' ) {
                            console.log('Availability not set');
                        }

                    } else {

                        $('#departmentModal').addClass('active')
                        $('#departmentModalOverlay').addClass('active')

                        that.closest('.department-row').addClass('department-active')
                        that.closest('.department-row').removeClass('department-inactive')

                        var departmentName = that.closest('.department-row').find('.department-table-name').text()
                        $('.profenda-modal-header').html('<h2>' + departmentName + '</h2>')

                        var companyID = $('#com_id').val();
                        var departmentID = that.val();
                        $('#departmentID').val(departmentID);

                        jQuery.ajax({
                            url: AjaxController.ajax_url,
                            type: 'POST',
                            data: {
                                action: AjaxController.getAdminsForDepartment,
                                companyID: companyID
                            },
                            success: function (response) {
                                // console.log('response',response);
                                $('#selectedDepartmentAdmin').empty().append(response.html);
                            }

                        });//end ajax

                    }

                }

            } );


            // DATATABLE
            var companyEmployeesTable = $('#companyEmployeesTable').DataTable({
                "pageLength": 25
            });

            $('#searchEmployee').keyup(function(){
                companyEmployeesTable.columns( 0 ).search($(this).val()).draw() ;
            })

            $('#departmentFilter').on( 'change', function () {

                var value = $( "#departmentFilter option:selected" ).text()

                if ($(this).val() !== 'all') {
                    companyEmployeesTable.columns( 2 ).search( value ).draw();
                } else {
                    companyEmployeesTable.columns( 2 ).search('').draw();
                }
            } );

            $('#userRoleFilter').on( 'change', function () {

                var value = $( "#userRoleFilter option:selected" ).text()

                if ($(this).val() !== 'all') {
                    companyEmployeesTable.columns( 3 ).search( value ).draw();
                } else {
                    companyEmployeesTable.columns( 3 ).search('').draw();
                }

            } );

            // DATATABLE END


            $('#meeting_type input').on('change', function(){

                if( $('#meeting_type input:checked').val() === 'company' ){

                    $('#meeting_types_available').removeClass('hide');
                }
                else {
                    $('#meeting_types_available').addClass('hide');
                }

            });

            $('#minimum_notice_section input').on('change', function(){

                if( $('#minimum_notice_section input:checked').val() === 'minimum_notice_in_advance' ){

                    $('#book_in_advance_field').removeClass('hide');
                }
                else {
                    $('#book_in_advance_field').addClass('hide');
                }

            });

            $('#meeting_repetition_section input').on('change', function(){

                if( $('#meeting_repetition_section input:checked').val() === 'meeting_repetition_limit' ){

                    $('#meeting_repetition_time_section').removeClass('hide');

                }
                else {
                    $('#meeting_repetition_time_section').addClass('hide');
                }

            });


            $('#instant_booking input').on('change', function(){

                if( $('#instant_booking input:checked').val() === 'accept_specific' ){

                    $('#instant_booking_products_brands').removeClass('hide');

                }
                else {
                    $('#instant_booking_products_brands').addClass('hide');
                }

            });

        }


    });

})( jQuery );
