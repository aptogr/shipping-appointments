<?php

namespace ShippingAppointments\Controller\Save\Service;

use Exception;
use ShippingAppointments\Service\Entities\User\PlatformUser;

class ServiceSaveController {

    public $platformUser;
    public $fieldsSlug;

    public function __construct(){

        $this->platformUser = new PlatformUser( get_current_user_id() );

    }


    public function save( $formData ){

    	$this->actionsBeforeSave($formData);

        if( is_array( $this->fieldsSlug) && !empty( $this->fieldsSlug ) ){

            foreach( $this->fieldsSlug as $formField => $metaKey ){

                if( isset( $formData[ $formField ] ) && !empty( $formData[ $formField ] ) ){

                    $value = ( is_array( $formData[ $formField ] ) ? implode( ',', $formData[ $formField ] ) : $formData[ $formField ] );

                    try {
                        $this->saveField( $metaKey, $value );
                    }
                    catch( Exception $e ){

                    }


                }

            }

            return true;

        }

        return false;

    }


    public function saveField( $metaKey, $value ){

    }


    public function actionsBeforeSave($formData){

    }

}
