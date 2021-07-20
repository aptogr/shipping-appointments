<?php

namespace ShippingAppointments\Interfaces;

Interface AjaxInterface {

    const AJAX_ACTIONS = array(
        'testAjax' => array(
            'callback' => 'testAjax',
            'nopriv'   => false,
        ),
        'getTime' => array(
            'callback' => 'getTime',
            'nopriv'   => false,
        ),
        'getProducts' => array(
            'callback' => 'getProducts',
            'nopriv'   => false,
        ),
        'getBrands' => array(
            'callback' => 'getBrands',
            'nopriv'   => false,
        ),
        'bookGetEmployeesField' => array(
            'callback' => 'bookGetEmployeesField',
            'nopriv'   => false,
        ),
        'bookGetEmployeeAvailability' => array(
            'callback' => 'bookGetEmployeeAvailability',
            'nopriv'   => false,
        ),
        'bookGetDepartmentAvailability' => array(
            'callback' => 'bookGetDepartmentAvailability',
            'nopriv'   => false,
        ),
        'getAppointmentsSchedule' => array(
            'callback' => 'getAppointmentsSchedule',
            'nopriv'   => false,
        ),
        'getAdminsForDepartment' => array(
            'callback' => 'getAdminsForDepartment',
            'nopriv'   => false,
        ),
        'createInvitation' => array(
            'callback' => 'createInvitation',
            'nopriv'   => false,
        ),
        'updateDepartmentStatus' => array(
            'callback' => 'updateDepartmentStatus',
            'nopriv'   => false,
        ),
        'createSupplerInvitation' => array(
            'callback' => 'createSupplerInvitation',
            'nopriv'   => false,
        ),
    );

}
