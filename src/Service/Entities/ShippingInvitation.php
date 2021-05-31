<?php


namespace ShippingAppointments\Service\Entities;

use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;
use ShippingAppointments\Traits\Core\PostEntity;

class ShippingInvitation {

	use PostEntity;

	public $inviter;
	public $company;
	public $department;
	public $role;
	public $invitee;
	public $status;
	public $email;
	public $code;
	public $notified;


	/**
	 * @var $companyObject ShippingCompany
	 */
	public $companyObject;

	/**
	 * @var $departmentObject Department
	 */
	public $departmentObject;

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
		$this->metaSlugs  = ShippingInvitationPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setEntities();

	}

	private function setEntities(){

		$this->companyObject    = new ShippingCompany( intval($this->company) );
		$this->departmentObject = new Department( intval($this->department) );
		$this->inviterUser      = new PlatformUser( intval( $this->inviter ) );
		$this->inviteeUser      = ( !empty( $this->inviteeUser) ? new PlatformUser( intval( $this->invitee ) ) : false );
	}

}
