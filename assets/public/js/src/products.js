(function ($) {
    'use strict';

    $(document).ready(function(){

        $('#getProductsInput').on( "keyup", function() {

            var inputText = $( this ).val();

            if (inputText.length > 2) {
                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.getProducts,
                        q: inputText,
                    },
                    success: function (response) {

                        // console.log(response);

                        $('#getProductsResults').empty();
                        $('#getProductsResults').append( response.htmlList );

                    }

                });
            }

            if (inputText.length < 1) {
                $('#getProductsResults').empty();
            }

        });

        $(document).on( "click", "#selectedProducts .product-item" ,function() {
            var product = $(this);
            var productId = product.attr("data-id")
            var selectedProductsInput = $('#selectedProductsInput').val();
            var selectedProductsArray = selectedProductsInput.split(",");
            var index = selectedProductsArray.indexOf(productId);

            if (index > -1) {
                selectedProductsArray.splice(index, 1);
                $('#selectedProductsInput').val(selectedProductsArray.toString())
                $('.product-item-'+productId).remove();
            }

        })

        $(document).on( "click", "#getProductsResults li" ,function() {

            var product = $(this);
            var productId = product.attr("data-id")
            var selectedProductsArray = [];
            var selectedProductsInput = $('#selectedProductsInput').val();

            if (selectedProductsInput.length > 0) {
                selectedProductsArray = selectedProductsInput.split(",");
            }

            if (!selectedProductsArray.includes(productId)) {

                selectedProductsArray.push(productId);

                $('#selectedProductsInput').val(selectedProductsArray.toString())

                $('#selectedProducts').append(
                    '<div class="product-item product-item-'+productId+'" data-id="'+productId+'">'+product.text()+'</div>'
                );
            }


        })


        $('#getSpecificProductsInput').on( "keyup", function() {

            var inputText = $( this ).val();


            if (inputText.length > 2) {
                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.getProducts,
                        q: inputText,
                    },
                    success: function (response) {

                        // console.log(response);

                        $('#getSpecificProductsResults').empty();
                        $('#getSpecificProductsResults').append( response.htmlList );

                    }

                });
            }

            if (inputText.length < 1) {
                $('#getSpecificProductsResults').empty();
            }

        });

        $(document).on( "click", "#selectedSpecificProducts .product-item" ,function() {
            var product = $(this);
            var productId = product.attr("data-id")
            var selectedProductsInput = $('#selectedSpecificProductsInput').val();
            var selectedProductsArray = selectedProductsInput.split(",");
            var index = selectedProductsArray.indexOf(productId);

            if (index > -1) {
                selectedProductsArray.splice(index, 1);
                $('#selectedSpecificProductsInput').val(selectedProductsArray.toString())
                $('.product-item-'+productId).remove();
            }

        })

        $(document).on( "click", "#getSpecificProductsResults li" ,function() {

            var product = $(this);
            var productId = product.attr("data-id")
            var selectedProductsArray = [];
            var selectedProductsInput = $('#selectedSpecificProductsInput').val();

            if (selectedProductsInput.length > 0) {
                selectedProductsArray = selectedProductsInput.split(",");
            }

            if (!selectedProductsArray.includes(productId)) {

                selectedProductsArray.push(productId);

                $('#selectedSpecificProductsInput').val(selectedProductsArray.toString())

                $('#selectedSpecificProducts').append(
                    '<div class="product-item product-item-'+productId+'" data-id="'+productId+'">'+product.text()+'</div>'
                );
            }


        })


    });

})( jQuery );