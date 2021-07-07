<?php


namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Traits\MediaUploader;

class SupplierCompanySaveController extends ServiceSaveController {

    use MediaUploader;

    public $companyID;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = SupplierCompanyPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ){

        update_post_meta( $this->companyID, $metaKey, $value );

    }

    public function actionsBeforeSave( $formData) {

        $postData = array(
            'post_title'    => $formData['company_name'],
            'post_status'   => 'publish',
            'post_type'     => SupplierCompanyPost::POST_TYPE_NAME,
            'post_author'   => $formData["user_id"],
        );

        $this->companyID = wp_insert_post( $postData );

    }


    public function uploadAndSaveFile( $fileData ){

        if( isset( $fileData['logo'] ) ){

            $attachID = $this->uploadFile( $fileData['logo'] );

            if ( $attachID ){

                set_post_thumbnail( $this->companyID, $attachID );

            }

        }

    }

}