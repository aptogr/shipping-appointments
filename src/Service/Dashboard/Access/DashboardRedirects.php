<?php


namespace ShippingAppointments\Service\Dashboard\Access;


use ShippingAppointments\Service\Entities\User\PlatformUser;

class DashboardRedirects {


	public function managementPagesRedirects(){

		$redirectUrl = null;

		if( is_page(153) && empty( get_query_var('company') )){

			$platformUser = new PlatformUser( get_current_user_id() );

			if( $platformUser->isShippingCompanyAdmin() || $platformUser->isWebsiteAdmin() ){

				$redirectUrl = site_url('dashboard/manage/edit-company/company/' . $platformUser->shippingCompany->ID );

			}

		}


		if( !empty( $redirectUrl ) ){

//    		var_dump($redirectUrl);
			wp_redirect( $redirectUrl );
			exit();

		}

	}

}
