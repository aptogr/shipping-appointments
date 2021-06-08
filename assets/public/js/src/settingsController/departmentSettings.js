(function ($) {
    'use strict';

    $(document).ready(function(){

        if( $('.department-settings').length > 0 ){

            var companyEmployeesTable = $('#departmentEmployeesTable').DataTable({
                "pageLength": 25
            });

            $('#searchEmployee').keyup(function(){
                companyEmployeesTable.columns( 0 ).search($(this).val()).draw() ;
            })

            $('#userRoleFilter').on( 'change', function () {

                var value = $( "#userRoleFilter option:selected" ).text()

                if ($(this).val() !== 'all') {
                    companyEmployeesTable.columns( 3 ).search( value ).draw();
                } else {
                    companyEmployeesTable.columns( 3 ).search('').draw();
                }

            } );

            $('#meeting_type input').on('change', function(){

                if( $('#meeting_type input:checked').val() === 'department' ){

                    $('#meeting_types_available').removeClass('hide');
                }
                else {
                    $('#meeting_types_available').addClass('hide');
                }

            });

            $('#minimum_notice_section input').on('change', function(){

                if( $('#minimum_notice_section input:checked').val() === 'minimum_notice_in_advance' ){

                    $('#minimum_notice_hours_field').removeClass('hide');
                }
                else {
                    $('#minimum_notice_hours_field').addClass('hide');
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

// DATATABLE invitationTable

            var invitationTable = $('#invitationTable').DataTable({
                "pageLength": 25
            });

            $('#searchEmployeeInvitation').keyup(function(){
                invitationTable.columns( 0 ).search($(this).val()).draw() ;
            })

            $('#statusFilterInvitation').on( 'change', function () {

                var value = $( "#statusFilterInvitation option:selected" ).text()

                if ($(this).val() !== 'all') {
                    invitationTable.columns( 1 ).search( value ).draw();
                } else {
                    invitationTable.columns( 1 ).search('').draw();
                }
            } );

            $('#userRoleFilterInvitation').on( 'change', function () {

                var value = $( "#userRoleFilterInvitation option:selected" ).text()

                if ($(this).val() !== 'all') {
                    invitationTable.columns( 2 ).search( value ).draw();
                } else {
                    invitationTable.columns( 2 ).search('').draw();
                }
            } );

            $('.copyLink').on( 'click', function () {
                var code = $(this).attr('data-code');
                var copyText = "https://profenda.com/register/shipping/employee/invitation/" + code + "/"
                var $temp = $("<input class='hidden'>");
                $("body").append($temp);
                $temp.val(copyText).select();
                document.execCommand("copy");
                $temp.remove();

                $.toast({
                    type: 'success',
                    autoDismiss: true,
                    message: 'Link copied.',
                });

            } );

            // DATATABLE invitationTable END


        }


    });

})( jQuery );
