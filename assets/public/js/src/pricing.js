(function ($) {
    'use strict';

    $(document).ready(function(){

        $('#priceSwitch').on( 'change', function () {
            $('.monthly-price').toggleClass( "hide" );
            $('.annual-price').toggleClass( "hide" );
        });

    });

})( jQuery );