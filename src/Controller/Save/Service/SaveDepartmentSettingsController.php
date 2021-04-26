<?php


namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\PostType\DepartmentPost;

class SaveDepartmentSettingsController extends ServiceSaveController {

    public $departmentId;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = DepartmentPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ) {

        if ( $metaKey == DepartmentPost::META_FIELDS_SLUG['meeting_types_available'] ) {

            $value = explode(',',$value);

            delete_post_meta( $this->departmentId, $metaKey );

                foreach ( $value as $val ){

                    add_post_meta( $this->departmentId, $metaKey, $val );

                }

        }
//        elseif ($metaKey == DepartmentPost::META_FIELDS_SLUG['instant_booking_products']) {
//            $value = explode(',',$value);
//
//            delete_post_meta( $this->departmentId, $metaKey );
//
//            foreach ( $value as $val ){
//
//                add_post_meta( $this->departmentId, $metaKey, $val );
//
//            }
//        }

        else {
            update_post_meta( $this->departmentId, $metaKey, $value );
        }

    }

    public function actionsBeforeSave($formData) {

        $this->departmentId = $formData['departmentId'];

        if (empty($formData['selected_brands'])) {
            delete_post_meta( $this->departmentId, DepartmentPost::META_FIELDS_SLUG['selected_brands'] );
        }

        if (empty($formData['selected_products'])) {
            delete_post_meta( $this->departmentId, DepartmentPost::META_FIELDS_SLUG['selected_products'] );
        }

//        if (empty($formData['instant_booking_products'])) {
//            delete_post_meta( $this->departmentId, DepartmentPost::META_FIELDS_SLUG['instant_booking_products'] );
//        }

        if (empty($formData['excluded_dates'])) {
            delete_post_meta( $this->departmentId, DepartmentPost::META_FIELDS_SLUG['excluded_dates'] );
        }

    }

}
//$department
