<?php


namespace ShippingAppointments\Service\Entities;

use WP_Term;
use ShippingAppointments\Service\Taxonomy\DepartmentType as TaxonomyDepartmentType;

class DepartmentType {

	public $term;
	public $ID;
	public $image;
	public $imageID;
	public $svg;

	public function __construct( $department ) {

		if( $department instanceof WP_Term ){
			$this->term = $department;
			$this->ID   = $this->term->term_id;
		}
		else {
			$this->ID   = $department;
			$this->term = get_term_by('ID', $this->ID, TaxonomyDepartmentType::TAXONOMY_SLUG );
		}

		$this->setImage();

	}


	private function setImage(){

		$this->imageID = get_term_meta( $this->ID, 'image', true );
		$this->image = wp_get_attachment_image( $this->imageID, 'full');

		$svg_file = file_get_contents( wp_get_attachment_image_url($this->imageID, 'full') );

		$find_string   = '<svg';
		$position = strpos($svg_file, $find_string);

		$this->svg = substr($svg_file, $position);

	}

}
