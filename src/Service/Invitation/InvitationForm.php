<?php


namespace ShippingAppointments\Service\Invitation;


use ShippingAppointments\Service\Entities\Department;
use ShippingAppointments\Service\Entities\ShippingCompany;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;

class InvitationForm {


	public function getShippingInvitationForm( $companyID, $departmentID = false ){

		ob_start();
		?>

		<form id="userInvitationForm" method="post">

			<input type="hidden" name="status" value="pending">
			<input type="hidden" name="company" value="<?php echo $companyID; ?>">
			<input type="hidden" name="inviter" value="<?php echo get_current_user_id(); ?>">

			<?php echo $this->getInvitationFieldsItem( $companyID, $departmentID ); ?>

		</form>

		<?php
		return ob_get_clean();

	}


	public function getInvitationFieldsItem( $companyID, $departmentID){

		$companyObject = new ShippingCompany( $companyID );
	    ob_start();

	    ?>

        <div class="invitation-item-fields flex full-width flex-center">

            <div class="input-field col l4 s12">

                <label for="email">Email</label>
                <input id="email" name="email" value="">

            </div>

            <div class="input-field col l4 s12">

                <label for="role">Role</label>

                <select id="role" name="role">

					<?php foreach( ShippingInvitationPost::ALL_FIELDS['role']['options'] as $value => $label ): ?>

                        <option value="<?php echo $value; ?>">
							<?php echo $label; ?>
                        </option>

					<?php endforeach; ?>

                </select>

            </div>

            <div class="input-field col l4 s12 <?php echo ( $departmentID !== false ? 'predefined' : ''); ?>">

                <label for="department">Department</label>

                <select id="department" name="department">

					<?php foreach( $companyObject->departments as $departmentID ): $department = new Department( $departmentID ); ?>

                        <option value="<?php echo $department->ID; ?>" <?php echo ( $departmentID !== false &&  $department->ID === $departmentID ? 'selected' : ''); ?>>
							<?php echo $department->departmentType->term->name; ?>
                        </option>

					<?php endforeach; ?>

                </select>

            </div>
            <div class="input-field col l4 s12">

                <div class="full-width">
                    <button type="submit" class="saveBooking save-button" name="refresh_action" value="invitation_send">Create Department</button>
                </div>

            </div>

        </div>

        <?php

	    return ob_get_clean();

	}

}
