(function ($) {
    'use strict';

    $(document).ready(function(){


        $('.invitationSend').on('click', function(event){
            event.preventDefault();

            var formData = $('#userInvitationForm').serialize();

            jQuery.ajax({

                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.createInvitation,
                        formData: formData
                    },

                    success: function (response) {

                        $('#invitationTableDiv').empty().append(response.html)

                    }

                });//end ajax

        });

    });

})( jQuery );
