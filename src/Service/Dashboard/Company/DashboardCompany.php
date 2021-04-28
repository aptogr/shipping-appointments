<?php


namespace ShippingAppointments\Service\Dashboard\Company;


use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\Entities\DepartmentType as DepartmentTypeEntity;
use ShippingAppointments\Service\Taxonomy\DepartmentType;

class DashboardCompany {


	/**
	 * @param $company ShippingCompany
	 */
	public function getDepartmentsList( ShippingCompany $company ){

		$active     = array();
		$inactive   = array();

		$departmentTerms = get_terms( array(
			'taxonomy' => DepartmentType::TAXONOMY_SLUG,
			'hide_empty' => false,
		) );

		foreach( $departmentTerms as $departmentTerm ){

			$departmentTypeObject = new DepartmentTypeEntity( $departmentTerm );

			if( $company->getDepartmentByType( $departmentTypeObject ) !== false ){
				$active[] = $departmentTypeObject;
			}
			else {
				$inactive[] = $departmentTypeObject;
			}

		}

		return array_merge( $active, $inactive );

	}


}
