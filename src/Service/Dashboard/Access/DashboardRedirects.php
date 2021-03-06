<?php


namespace ShippingAppointments\Service\Dashboard\Access;


use ShippingAppointments\Service\Entities\User\PlatformUser;

class DashboardRedirects {

	public function dashboardPageRedirect(){

		$this->managementPagesRedirects();
		$this->appointmentsRedirects();

	}


	public function managementPagesRedirects(){

		$redirectUrl = null;

		if( is_page(153) && empty( get_query_var('company') )){

			$platformUser = new PlatformUser( get_current_user_id() );

			if( $platformUser->isShippingCompanyAdmin() || $platformUser->isWebsiteAdmin() ){

				$redirectUrl = site_url('dashboard/manage/edit-company/company/' . $platformUser->shippingCompany->ID );

			}

		}

		if( !empty( $redirectUrl ) ){

			wp_redirect( $redirectUrl );
			exit();

		}

	}

	public function appointmentsRedirects(){

		$redirectUrl = null;

		if( is_page(426 ) ){

			$platformUser = new PlatformUser( get_current_user_id() );

			if( $platformUser->isShippingCompanyAdmin() || $platformUser->isWebsiteAdmin() ){

				$redirectUrl = site_url( 'dashboard/appointments/company/' .$platformUser->shippingCompany->ID );

			}

		}

		if( is_page(428) ){

			$platformUser = new PlatformUser( get_current_user_id() );

			if( $platformUser->isShippingCompanyAdmin() || $platformUser->isDepartmentAdmin() || $platformUser->isWebsiteAdmin() ){

				$redirectUrl = site_url( 'dashboard/appointments/department/' .$platformUser->department->ID );

			}

		}

		if( !empty( $redirectUrl ) ){

			wp_redirect( $redirectUrl );
			exit();

		}

	}


}
