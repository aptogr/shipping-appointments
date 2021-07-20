<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Traits\MediaUploader;

class UpdateSupplierCompanyController extends ServiceSaveController {

    use MediaUploader;

    public $companyID;


    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = SupplierCompanyPost::META_FIELDS_SLUG;

    }


    public function actionsAfterSave( $formData ) {

        if ( isset( $formData['selected_products'] ) ) {

            $selected_products = explode(",", $formData['selected_products']);

            wp_set_post_terms( $this->companyID, $selected_products, 'profenda_product_type',false  );

        }

        if ( isset( $formData['selected_brands'] ) ) {

            $selected_brands = explode(",", $formData['selected_brands']);
            $selected_brandsArr = [];

            foreach ( $selected_brands as $singleBrant ){

                $term = get_term_by( 'id', $singleBrant, 'profenda_product_brand' );
                array_push($selected_brandsArr,$term->name);

            }

            wp_set_post_terms( $this->companyID, $selected_brandsArr, 'profenda_product_brand',false  );

        }

    }


    public function saveField( $metaKey, $value ) {

        update_post_meta( $this->companyID, $metaKey, $value );

    }


    public function actionsBeforeSave($formData) {

        $this->companyID = $formData['companyId'];

    }

    public function uploadAndSaveImage( $fileData ){

        if( isset( $fileData['logo'] ) ){

            $attachID = $this->uploadFile( $fileData['logo'] );

            if ( $attachID ){

                set_post_thumbnail( $this->companyID, $attachID );

            }

        }

    }




}