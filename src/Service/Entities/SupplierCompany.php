<?php

namespace ShippingAppointments\Service\Entities;


use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Service\Taxonomy\BrandTaxonomy;
use ShippingAppointments\Service\Taxonomy\CountryTaxonomy;
use ShippingAppointments\Service\Taxonomy\DepartmentType;
use ShippingAppointments\Service\Taxonomy\PortTaxonomy;
use ShippingAppointments\Service\Taxonomy\ProductType;
use ShippingAppointments\Service\User\UserFields;
use ShippingAppointments\Traits\Core\PostEntity;

class SupplierCompany {

	use PostEntity;

	public $countries;
	public $ports;
	public $productCategories;
	public $brands;
	public $employees;

	public $company_email;
	public $company_phone;
	public $company_products;
	public $company_brands;

	public function __construct( $id ) {

		$this->ID         = $id;
		$this->post       = get_post( $this->ID );
		$this->metaSlugs  = SupplierCompanyPost::META_FIELDS_SLUG;
		$this->postMeta   = get_post_meta( $this->ID );
		$this->setProperties();
		$this->setTaxonomies();
		$this->setEmployees();

	}


	private function setTaxonomies(){

		$this->countries            = get_the_terms( $this->ID, CountryTaxonomy::TAXONOMY_SLUG );
		$this->ports                = get_the_terms( $this->ID, PortTaxonomy::TAXONOMY_SLUG );
		$this->productCategories    = get_the_terms( $this->ID, ProductType::TAXONOMY_SLUG );
		$this->brands               = get_the_terms( $this->ID, BrandTaxonomy::TAXONOMY_SLUG );

	}


	private function setEmployees(){

		$this->employees = get_users(array(
			'role'          => 'supplier_company_employee',
			'meta_key'      => UserFields::META_FIELDS_SLUG['supplier_company_id'],
			'meta_value'    => $this->ID
		));

	}


	public function showTagItems( $tags, $items){

		if( is_array( $tags ) ){

			$tags = array_slice( $tags, 0, $items );

			$display = array();
			foreach( $tags as $tag ){
				$display[] = $tag->name;
			}

			return implode(', ', $display );

		}
		else {
			return '';
		}

	}

}
