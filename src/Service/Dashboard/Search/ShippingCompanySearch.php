<?php


namespace ShippingAppointments\Service\Dashboard\Search;


use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use WP_Query;

class ShippingCompanySearch {


	public function getShippingCompanies(){

		return $this->getPosts();

	}


	protected function getPosts(){

		$args = array(
			'post_type'         => ShippingCompanyPost::POST_TYPE_NAME,
			'posts_per_page'    => -1,
		);

		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {

			$ids = array();

			while ( $query->have_posts() ) {
				$query->the_post();
				$ids[] = get_the_ID();
			}

		}
		else {
			$ids = false;
		}

		// Restore original Post Data
		wp_reset_query();
		wp_reset_postdata();

		return $ids;

	}


	public function displayShippingCompanyBlock( $companyID ){

		ob_start();

		$shippingCompany = new ShippingCompany( $companyID );
		?>

		<div class="col l4 s12">

			<div class="company-item">

				<div class="company-item--logo">
					<?php echo get_the_post_thumbnail( $shippingCompany->ID, 'thumbnail'); ?>
				</div>

				<h3 class="company-item--title">
					<?php echo get_the_title($companyID); ?>
				</h3>

				<div class="company-item--info">

					Departments: <?php echo count( $shippingCompany->departments ); ?>

				</div>

				<div class="company-item--actions flex full-width">

					<a href="<?php echo get_the_permalink( $shippingCompany->ID ); ?>" class="profenda-btn">
						View Profile
					</a>

					<a href="<?php echo site_url( "dashboard/book/appointment/company/$shippingCompany->ID" ); ?>" class="profenda-btn margin-left-auto no-margin-right">
                        <svg id="Capa_1" style="padding: 3px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><g><circle cx="386" cy="210" r="20"></circle><path d="M432,40h-26V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-91V20c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v20h-90V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v20H80C35.888,40,0,75.888,0,120v312c0,44.112,35.888,80,80,80h153c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H80c-22.056,0-40-17.944-40-40V120c0-22.056,17.944-40,40-40h25v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h90v20c0,11.046,8.954,20,20,20s20-8.954,20-20V80h91v20c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V80h26c22.056,0,40,17.944,40,40v114c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20V120C512,75.888,476.112,40,432,40z"></path><path d="M391,270c-66.72,0-121,54.28-121,121s54.28,121,121,121s121-54.28,121-121S457.72,270,391,270z M391,472c-44.663,0-81-36.336-81-81s36.337-81,81-81c44.663,0,81,36.336,81,81S435.663,472,391,472z"></path><path d="M420,371h-9v-21c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v41c0,11.046,8.954,20,20,20h29c11.046,0,20-8.954,20-20C440,379.954,431.046,371,420,371z"></path><circle cx="299" cy="210" r="20"></circle><circle cx="212" cy="297" r="20"></circle><circle cx="125" cy="210" r="20"></circle><circle cx="125" cy="297" r="20"></circle><circle cx="125" cy="384" r="20"></circle><circle cx="212" cy="384" r="20"></circle><circle cx="212" cy="210" r="20"></circle></g></g></g></svg>
                        Book Appointment
					</a>

				</div>

			</div>

		</div>


		<?php

		return ob_get_clean();

	}

}
