<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\Entities\DepartmentType;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\PostType\DepartmentPost;

class CreateDepartment extends ServiceSaveController {

    public $department;

    public function __construct() {

        parent::__construct();
        $this->fieldsSlug = DepartmentPost::META_FIELDS_SLUG;

    }

    public function saveField( $metaKey, $value ){

        update_post_meta( $this->department, $metaKey, $value );

    }

    public function actionsBeforeSave($formData) {

        $companyID = $formData['company'];
        $departmentID = $formData['departmentID'];

        $companyOBJ = new ShippingCompany($companyID);
        $companyName = $companyOBJ->post->post_title;

        $departmentOBJ = new DepartmentType($departmentID);
        $departmentName = $departmentOBJ->term->name;

        if ( $formData['depAdmin'] == 1 ) {
            $author = $formData['loggedInUser'];
        } else {
            $author = $formData['selectedDepartmentAdmin'];
        }

        $postData = array(
            'post_title'    => $departmentName.' - '.$companyName,
            'post_status'   => 'publish',
            'post_type'     => DepartmentPost::POST_TYPE_NAME,
            'post_author'   => $author,
        );

        $this->department = wp_insert_post( $postData );

        $taxonomy = 'department_type';
        wp_set_post_terms($this->department, array($departmentName), $taxonomy);

//        echo "<pre>";
//        var_dump($postData);
//        echo "</pre>";

    }

}