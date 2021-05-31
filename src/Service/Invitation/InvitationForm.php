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


	public function getInvitationFieldsItem( $companyID, $departmentID, $index = 0 ){

		$companyObject = new ShippingCompany( $companyID );
	    ob_start();

	    ?>

        <div class="invitation-item-fields flex full-width flex-center">

            <div class="input-field col l4 s12">

                <label for="invitation[<?php echo $index; ?>][email]">Email</label>
                <input id="invitation[<?php echo $index; ?>][email]" name="invitation[<?php echo $index; ?>][email]" value="">

            </div>

            <div class="input-field col l4 s12">

                <label for="invitation[<?php echo $index; ?>][role]">Role</label>

                <select id="invitation[<?php echo $index; ?>][role]" name="invitation[<?php echo $index; ?>][role]">

					<?php foreach( ShippingInvitationPost::ALL_FIELDS['role']['options'] as $value => $label ): ?>

                        <option value="<?php echo $value; ?>">
							<?php echo $label; ?>
                        </option>

					<?php endforeach; ?>

                </select>

            </div>

            <div class="input-field col l4 s12 <?php echo ( $departmentID !== false ? 'predefined' : ''); ?>">

                <label for="invitation[<?php echo $index; ?>][department]">Department</label>

                <select id="invitation[<?php echo $index; ?>][department]" name="invitation[<?php echo $index; ?>][department]">

					<?php foreach( $companyObject->departments as $departmentID ): $department = new Department( $departmentID ); ?>

                        <option value="<?php echo $department->ID; ?>" <?php echo ( $departmentID !== false &&  $department->ID === $departmentID ? 'selected' : ''); ?>>
							<?php echo $department->departmentType->term->name; ?>
                        </option>

					<?php endforeach; ?>

                </select>

            </div>

        </div>

        <?php

	    return ob_get_clean();

	}

}
