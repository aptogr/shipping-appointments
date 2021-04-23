<?php

namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Traits\Core\PostEntity;
use ShippingAppointments\Traits\InputFunctions;
use WP_User;

class Appointment {

	use PostEntity;
    use InputFunctions;

	public $status;
	public $date;
    public $from_time;
    public $to_time;
    public $appointment_method;
    public $appointment_method_selected;
    public $location;
    public $telephone;
    public $zoom_link;
    public $webex_link;
    public $teams_link;
    public $meeting_type;
    public $requester;
    public $invite_questions;
    public $guests;
    public $meeting_time_duration;
    public $receiver;

    /**
     * @var $requester_user WP_User
     */
    public $requester_user;

    /**
     * @var $receiver_user WP_User
     */
    public $receiver_user;


	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = AppointmentPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setUserObjects();

	}


	private function setUserObjects(){

        $this->receiver         = $this->post->post_author;
        $this->receiver_user    = get_user_by('ID',$this->receiver);
        $this->requester_user   = get_user_by('ID',$this->requester);

    }

}
