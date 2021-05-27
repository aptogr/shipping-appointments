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
						Book an Appointment
					</a>

				</div>

			</div>

		</div>


		<?php

		return ob_get_clean();

	}

}
