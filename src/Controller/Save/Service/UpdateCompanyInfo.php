<?php


namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Traits\MediaUploader;

class UpdateCompanyInfo extends ServiceSaveController {

    use MediaUploader;

    public $companyId;

    public function __construct()
    {

        parent::__construct();
        $this->fieldsSlug = ShippingCompanyPost::META_FIELDS_SLUG;

    }

    public function saveField($metaKey, $value)
    {

        update_post_meta($this->companyId, $metaKey, $value);

    }

    public function actionsBeforeSave($formData) {

        $this->companyId = $formData['companyId'];

    }

    public function uploadAndSaveImage( $formData ){

        if( isset( $formData['myFileThumbnail'] ) ){

            $attachmentId = $this->uploadFile( $formData['myFileThumbnail'] );

            if ( $attachmentId ){

                set_post_thumbnail( $this->companyId, $attachmentId );

            }

        }

    }


}