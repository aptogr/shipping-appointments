<?php

namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\User\UserFields;

class SaveBookingSettingsController extends ServiceSaveController {

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = UserFields::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ) {

        if ( $metaKey == 'user_selected_products' or $metaKey == 'user_selected_brands' ) {

            update_user_meta( $this->platformUser->ID, $metaKey, $value );

        } else {

            if ( is_array( explode( ',', $value ) ) && count(explode( ',', $value )) > 1 ){

                $value = explode( ',', $value );

            }

            if (is_array($value)) {

                delete_user_meta( $this->platformUser->ID, $metaKey );

                foreach ( $value as $val ){

                    add_user_meta( $this->platformUser->ID, $metaKey, $val );

                }

            } else {

                update_user_meta( $this->platformUser->ID, $metaKey, $value );

            }

        }




    }

}
