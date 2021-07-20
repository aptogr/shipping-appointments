<?php


namespace ShippingAppointments\Interfaces\PostType;


use ShippingAppointments\Service\PostType\SupplierCompanyPost;

Interface SupplierInvitationInterface {

    const POST_TYPE_NAME = 'supplier_invitation';


    /**
     * Post Type Meta Fields slugs
     * @var array
     */
    const META_FIELDS_SLUG = [
        'inviter'                           => self::POST_TYPE_NAME . '_inviter',
        'supplier'                          => self::POST_TYPE_NAME . '_supplier',
        'role'                              => self::POST_TYPE_NAME . '_role',
        'invitee'                           => self::POST_TYPE_NAME . '_invitee',
        'status'                            => self::POST_TYPE_NAME . '_status',
        'email'                             => self::POST_TYPE_NAME . '_email',
        'code'                              => self::POST_TYPE_NAME . '_code',
        'notified'                          => self::POST_TYPE_NAME . '_notified',
    ];

    const ALL_FIELDS = array(
        'inviter' => array(
            'id'                => self::META_FIELDS_SLUG['inviter'],
            'name'              => 'Inviter',
            'type'              => 'user',
            'field_type'        => 'select_advanced',
            'placeholder'       => 'Select an Employee',
            'multiple'          => false,
            'query_args'        => array(),
        ),
        'supplier' => array(
            'id'            => self::META_FIELDS_SLUG['supplier'],
            'name'          => 'Shipping Company',
            'type'          => 'post',
            'post_type'     => SupplierCompanyPost::POST_TYPE_NAME,
            'field_type'    => 'select_advanced',
            'placeholder'   => 'Select a company',
        ),
        'role' => array(
            'name'              => 'Role',
            'id'                => self::META_FIELDS_SLUG['role'],
            'type'              => 'radio',
            'inline'            => false,
            'options'           => array(
                'supplier_company_admin'                => 'Company Admin',
                'supplier_company_employee'             => 'Employee',
            ),
        ),
        'invitee' => array(
            'name'              => 'Invited User',
            'id'                => self::META_FIELDS_SLUG['invitee'],
            'type'              => 'user',
            'field_type'        => 'select_advanced',
            'placeholder'       => 'Select an Employee',
            'multiple'          => false,
            'query_args'        => array(),
        ),
        'status' => array(
            'name'              => 'Status',
            'id'                => self::META_FIELDS_SLUG['status'],
            'type'              => 'radio',
            'inline'            => false,
            'options'           => array(
                'pending'           => 'Pending',
                'accepted'          => 'Accepted',
                'expired'           => 'Expired',
            ),
        ),
        'email' => array(
            'name'       => 'Invited User Email',
            'id'         => self::META_FIELDS_SLUG['email'],
            'type'       => 'text',
        ),
        'code' => array(
            'name'       => 'Invitation Code',
            'id'         => self::META_FIELDS_SLUG['code'],
            'type'       => 'text',
        ),
        'notified' => array(
            'name'       => 'Notified',
            'id'         => self::META_FIELDS_SLUG['notified'],
            'type'       => 'text',
        ),
    );


    const INVITATION_FIELDS = array(
        self::ALL_FIELDS['inviter'],
        self::ALL_FIELDS['supplier'],
        self::ALL_FIELDS['role'],
        self::ALL_FIELDS['invitee'],
        self::ALL_FIELDS['status'],
        self::ALL_FIELDS['email'],
        self::ALL_FIELDS['code'],
        self::ALL_FIELDS['notified'],
    );



}