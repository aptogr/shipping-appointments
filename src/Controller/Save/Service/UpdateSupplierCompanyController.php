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