<?php


namespace ShippingAppointments\Service\Invitation;


use ShippingAppointments\Service\Entities\SupplierInvitation;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Service\PostType\SupplierInvitationPost;
use WP_Query;

class InvitationTableSupplier {

    public function getSupplierCompanyInvitationTable( $companyID ){

        return $this->displayInvitationsTable( $this->getSupplierCompanyInvitations( $companyID ) );

    }

    private function getSupplierCompanyInvitations( $companyID ){

        $metaQuery = array(
            'key'     => SupplierInvitationPost::META_FIELDS_SLUG['supplier'],
            'value'   => intval($companyID),
            'compare' => '=',
        );

        return $this->getPosts( $metaQuery );

    }

    private function getPosts( $metaQuery ){

        $args = array(
            'post_type'         => SupplierInvitationPost::POST_TYPE_NAME,
            'posts_per_page'    => -1,
            'meta_query'        => array($metaQuery),
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

                <?php foreach( $invitations as $invitationID ): $invitation = new SupplierInvitation( $invitationID ); ?>

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