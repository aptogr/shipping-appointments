<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;

class SaveCompanySettingsController extends ServiceSaveController {

    public $companyId;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = ShippingCompanyPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ) {


        if ( $metaKey == ShippingCompanyPost::META_FIELDS_SLUG['meeting_types_available'] ) {

            $value = explode(',',$value);

            delete_post_meta( $this->companyId, $metaKey );

            foreach ( $value as $val ){

                add_post_meta( $this->companyId, $metaKey, $val );

            }

        }

        else {
            update_post_meta( $this->companyId, $metaKey, $value );
        }


    }

    public function actionsBeforeSave($formData) {
        $this->companyId = $formData['companyId'];

    }

}