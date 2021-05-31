<?php


namespace ShippingAppointments\Controller\Save\Service;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;


class InvitationSend extends ServiceSaveController {

    public $invitation;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = ShippingInvitationPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ){

        update_post_meta( $this->invitation, $metaKey, $value );

    }

    public function actionsBeforeSave($formData) {

        $postData = array(
            'post_title'    => 'Invitation - ' . time(),
            'post_status'   => 'publish',
            'post_type'     => ShippingInvitationPost::POST_TYPE_NAME,
            'post_author'   => $formData['inviter'],
        );

        $this->invitation = wp_insert_post( $postData );

    }

    public function actionsAfterSave($formData) {

        $code = base64_encode($this->invitation);
        update_post_meta( $this->invitation, $this->fieldsSlug['code'], $code );

        $postData = array(
            'post_title'    => 'Invitation - ' . $code,
            'ID'            => $this->invitation
        );

        $this->invitation = wp_update_post( $postData );

    }

}