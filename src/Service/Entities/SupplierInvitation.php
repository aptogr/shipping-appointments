<?php


namespace ShippingAppointments\Service\Entities;


use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\SupplierInvitationPost;
use ShippingAppointments\Traits\Core\PostEntity;

class SupplierInvitation {

    use PostEntity;

    public $inviter;
    public $supplier;
    public $role;
    public $invitee;
    public $status;
    public $email;
    public $code;
    public $notified;


    /**
     * @var $supplierCompanyObject SupplierCompany
     */
    public $supplierCompanyObject;


    /**
     * @var $inviterUser PlatformUser
     */
    public $inviterUser;


    /**
     * @var $inviteeUser PlatformUser
     */
    public $inviteeUser;

    public function __construct( $id ) {

        $this->ID         = $id;
        $this->post       = get_post( $this->ID );
        $this->metaSlugs  = SupplierInvitationPost::META_FIELDS_SLUG;
        $this->postMeta   = get_post_meta( $this->ID );
        $this->setProperties();
        $this->setEntities();

    }

    private function setEntities(){

        $this->supplierCompanyObject    = new SupplierCompany( intval($this->supplier) );
        $this->inviterUser              = new PlatformUser( intval( $this->inviter ) );
        $this->inviteeUser              = ( !empty( $this->inviteeUser) ? new PlatformUser( intval( $this->invitee ) ) : false );
    }

    public function getFieldToString( $field ){

        if( property_exists( $this, $field ) ){

            return ( SupplierInvitationPost::ALL_FIELDS[ $field ]['options'][ $this->{$field} ] ?? $this->{$field} );

        }
        else {
            return '-';
        }


    }


}