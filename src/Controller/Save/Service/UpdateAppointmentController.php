<?php


namespace ShippingAppointments\Controller\Save\Service;


use ShippingAppointments\Service\PostType\AppointmentPost;

class UpdateAppointmentController extends ServiceSaveController
{

    public $appointmentID;

    public function __construct()
    {

        parent::__construct();
        $this->fieldsSlug = AppointmentPost::META_FIELDS_SLUG;

    }

    public function saveField($metaKey, $value)
    {


        if (is_array(explode(',', $value)) && count(explode(',', $value)) > 1) {

            $value = explode(',', $value);

        }

        if (is_array($value)) {

            delete_post_meta($this->appointmentID, $metaKey);

            foreach ($value as $val) {
                add_post_meta($this->appointmentID, $metaKey, $val);
            }

        } else {
            update_post_meta($this->appointmentID, $metaKey, $value);
        }

    }

    public function actionsBeforeSave($formData)
    {

        $this->appointmentID = $formData['appointmentID'];


    }

}
