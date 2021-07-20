(function ($) {
    'use strict';

    $(document).ready(function(){



        $('.invitationSupplierSend').on('click', function(event){

            event.preventDefault();

            var formData = $('#userInvitationForm').serialize();

            console.log(formData);

            jQuery.ajax({

                url: AjaxController.ajax_url,
                type: 'POST',
                data: {
                    action: AjaxController.createSupplerInvitation,
                    formData: formData
                },

                success: function (response) {

                    $('#invitationTableDiv').empty().append(response.html)

                }

            }); //end ajax

        });

    });

})( jQuery );
