<?php


namespace ShippingAppointments\Service\Invitation;


use ShippingAppointments\Service\Entities\ShippingInvitation;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;
use WP_Query;

class InvitationTable {


	public function getShippingCompanyInvitationTable( $companyID ){

		return $this->displayInvitationsTable( $this->getShippingCompanyInvitations( $companyID ) );

	}

	public function getDepartmentInvitationTable( $departmentID ){

		return $this->displayInvitationsTable( $this->getDepartmentInvitations( $departmentID ) );

	}


	private function getShippingCompanyInvitations( $companyID ){

		$metaQuery = array(
			'key'     => ShippingInvitationPost::META_FIELDS_SLUG['company'],
			'value'   => $companyID,
			'compare' => '=',
		);

		return $this->getPosts( $metaQuery );

	}


	private function getDepartmentInvitations( $departmentID ){

		$metaQuery = array(
			'key'     => ShippingInvitationPost::META_FIELDS_SLUG['department'],
			'value'   => $departmentID,
			'compare' => '=',
		);

		return $this->getPosts( $metaQuery );

	}


	private function getPosts( $metaQuery ){

		$args = array(
			'post_type'         => ShippingInvitationPost::POST_TYPE_NAME,
			'posts_per_page'    => -1,
			'meta_query'        => $metaQuery,
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


	private function displayInvitationsTable( $invitations ){

		ob_start();

		?>

		<?php if( !empty( $invitations ) && is_array( $invitations ) ): ?>

			<table id="invitationTable">
				<thead>
					<tr>
						<th>
							Email
						</th>
                        <th>
                            Status
                        </th>
						<th>
							Role
						</th>
						<th>
							Department
						</th>
						<th>
							Inviter
						</th>
						<th>
							Code
						</th>
                        <th>
							Actions
						</th>
					</tr>
				</thead>
				<tbody>

				<?php foreach( $invitations as $invitationID ): $invitation = new ShippingInvitation( $invitationID ); ?>

					<tr>
						<td>
							<?php echo $invitation->email; ?>
						</td>
                        <td>
                            <div class="status <?php echo $invitation->status;?>">
                                <?php echo $invitation->getFieldToString('status'); ?>
                            </div>
                        </td>
						<td>
							<?php echo $invitation->getFieldToString('role'); ?>
						</td>
						<td>
							<?php echo $invitation->departmentObject->departmentType->term->name; ?>
						</td>
						<td>
							<?php echo $invitation->inviterUser->getFullName(); ?>
						</td>
						<td>
							<?php echo $invitation->code; ?>
						</td>
                        <td data-code="<?php echo $invitation->code; ?>" class="copyLink">
                            Copy link
                        </td>
					</tr>

				<?php endforeach; ?>

				</tbody>
			</table>

		<?php else: ?>

			<h3>
				There are no invitations
			</h3>

		<?php endif; ?>

		<?php

		return ob_get_clean();

	}

}
