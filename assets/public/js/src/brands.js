(function ($) {
    'use strict';

    $(document).ready(function(){

        $('#getBrandsInput').on( "keyup", function() {

            var inputText = $( this ).val();
            // console.log(inputText);

            if (inputText.length > 2) {
                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.getBrands,
                        q: inputText,
                    },
                    success: function (response) {

                        // console.log(response);

                        $('#getBrandsResults').empty();
                        $('#getBrandsResults').append( response.htmlList );

                    }

                });
            }

            if (inputText.length < 1) {
                $('#getBrandsResults').empty();
            }

        });

        $(document).on( "click", "#selectedBrands .brand-item" ,function() {
            var brand = $(this);
            var brandId = brand.attr("data-id");
            var selectedBrandsInput = $('#selectedBrandsInput').val();
            var selectedBrandsArray = selectedBrandsInput.split(",");
            var index = selectedBrandsArray.indexOf(brandId);

            if (index > -1) {
                selectedBrandsArray.splice(index, 1);
                $('#selectedBrandsInput').val(selectedBrandsArray.toString())
                $('.brand-item-'+brandId).remove();
            }

        })

        $(document).on( "click", "#getBrandsResults li" ,function() {


            var brand = $(this);
            var brandId = brand.attr("data-id")
            console.log(brand.html());
            console.log(brandId);
            var selectedBrandsArray = [];
            var selectedBrandsInput = $('#selectedBrandsInput').val();

            if (selectedBrandsInput.length > 0) {
                selectedBrandsArray = selectedBrandsInput.split(",");
            }
 
            if (!selectedBrandsArray.includes(brandId)) {

                selectedBrandsArray.push(brandId);

                $('#selectedBrandsInput').val(selectedBrandsArray.toString())

                $('#selectedBrands').append(
                    '<div class="brand-item brand-item-'+brandId+'" data-id="'+brandId+'">'+brand.text()+'</div>'
                );
            }


        })

        // Specific Brands
        $('#getSpecificBrandsInput').on( "keyup", function() {

            var inputText = $( this ).val();
            // console.log(inputText);

            if (inputText.length > 2) {
                jQuery.ajax({
                    url: AjaxController.ajax_url,
                    type: 'POST',
                    data: {
                        action: AjaxController.getBrands,
                        q: inputText,
                    },
                    success: function (response) {

                        // console.log(response);

                        $('#getSpecificBrandsResults').empty();
                        $('#getSpecificBrandsResults').append( response.htmlList );

                    }

                });
            }

            if (inputText.length < 1) {
                $('#getSpecificBrandsResults').empty();
            }

        });

        $(document).on( "click", "#selectedSpecificBrands .brand-item" ,function() {
            var brand = $(this);
            var brandId = brand.attr("data-id");
            var selectedBrandsInput = $('#selectedSpecificBrandsInput').val();
            var selectedBrandsArray = selectedBrandsInput.split(",");
            var index = selectedBrandsArray.indexOf(brandId);

            if (index > -1) {
                selectedBrandsArray.splice(index, 1);
                $('#selectedSpecificBrandsInput').val(selectedBrandsArray.toString())
                $('.brand-item-'+brandId).remove();
            }

        })

        $(document).on( "click", "#getSpecificBrandsResults li" ,function() {


            var brand = $(this);
            var brandId = brand.attr("data-id")
            console.log(brand.html());
            console.log(brandId);
            var selectedBrandsArray = [];
            var selectedBrandsInput = $('#selectedSpecificBrandsInput').val();

            if (selectedBrandsInput.length > 0) {
                selectedBrandsArray = selectedBrandsInput.split(",");
            }

            if (!selectedBrandsArray.includes(brandId)) {

                selectedBrandsArray.push(brandId);

                $('#selectedSpecificBrandsInput').val(selectedBrandsArray.toString())

                $('#selectedSpecificBrands').append(
                    '<div class="brand-item brand-item-'+brandId+'" data-id="'+brandId+'">'+brand.text()+'</div>'
                );
            }


        })

    });

})( jQuery );