<?php

namespace ShippingAppointments\Controller\Save\Service;

use ShippingAppointments\Service\User\UserFields;

class SaveBookingSettingsController extends ServiceSaveController {

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = UserFields::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ) {

        update_user_meta( $this->platformUser->ID, $metaKey, $value );

    }

}
