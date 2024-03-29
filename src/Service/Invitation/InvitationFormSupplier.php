<?php


namespace ShippingAppointments\Service\Invitation;


use ShippingAppointments\Service\Entities\SupplierCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\ShippingInvitationPost;
use ShippingAppointments\Service\PostType\SupplierInvitationPost;

class InvitationFormSupplier {

    public function getSupplierInvitationForm( $companyID, $departmentID = false ){

        ob_start();
        ?>

        <form id="userInvitationForm" method="post" class="display-inline-block full-width">

            <input type="hidden" name="status" value="pending">
            <input type="hidden" name="supplier" value="<?php echo $companyID; ?>">
            <input type="hidden" name="inviter" value="<?php echo get_current_user_id(); ?>">

            <?php echo $this->getInvitationFieldsItem( $companyID ); ?>

        </form>

        <?php
        return ob_get_clean();

    }

    public function getInvitationFieldsItem( $companyID ){

        $companyObject = new SupplierCompany( $companyID );
        ob_start();

        ?>

        <div class="invitation-item-fields flex full-width flex-center">

            <div class="icon">

                <svg id="Layer_1" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m71.119 155.607c2.559 0 5.119-.976 7.071-2.929l.028-.028c3.905-3.905 3.891-10.223-.014-14.128-3.905-3.904-10.25-3.89-14.157.014-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.513 2.928 7.072 2.928z"/><path d="m511.993 113.633c0-62.657-50.974-113.633-113.63-113.633-53.02 0-97.671 36.504-110.152 85.698-22.282-7.469-45.584-11.262-69.443-11.262-43.49 0-85.511 12.738-121.522 36.838-4.59 3.072-5.82 9.283-2.749 13.873 1.929 2.882 5.094 4.439 8.32 4.439 1.912 0 3.845-.547 5.553-1.69 32.708-21.889 70.883-33.459 110.398-33.459 22.815 0 45.06 3.811 66.243 11.313-.179 2.605-.278 5.233-.278 7.883 0 62.642 50.974 113.604 113.63 113.604 2.644 0 5.266-.098 7.866-.277 7.513 21.25 11.33 43.496 11.33 66.244 0 26.506-5.232 51.807-14.69 74.95-5.559-18.162-18.977-33.255-36.453-40.864 5.876-9.273 9.294-20.25 9.294-32.016 0-33.07-26.917-59.974-60.001-59.974-9.921 0-19.498 2.409-28.047 6.935-9.253-29.227-36.635-50.474-68.893-50.474-32.257 0-59.638 21.245-68.892 50.47-8.535-4.524-18.112-6.931-28.049-6.931-33.069 0-59.972 26.904-59.972 59.974 0 11.767 3.416 22.744 9.289 32.017-17.479 7.609-30.897 22.708-36.453 40.877-9.457-23.146-14.685-48.454-14.685-74.963 0-39.196 11.402-77.121 32.974-109.674 3.051-4.604 1.792-10.809-2.812-13.86s-10.809-1.791-13.86 2.812c-23.749 35.838-36.302 77.583-36.302 120.721 0 58.442 22.753 113.386 64.068 154.71 41.318 41.327 96.256 64.086 154.694 64.086 58.439 0 113.382-22.759 154.707-64.085s64.083-96.27 64.083-154.71c0-23.797-3.798-47.099-11.279-69.441 49.202-12.473 85.713-57.117 85.713-110.131zm-293.224 98.127c28.809 0 52.246 23.425 52.246 52.219 0 28.81-23.438 52.248-52.246 52.248s-52.246-23.438-52.246-52.248c-.001-28.793 23.437-52.219 52.246-52.219zm-109.548 166.227v81.007c-22.85-15.154-42.401-34.897-57.326-57.912v-14.252c0-20.574 14.358-38.591 34.02-43.533 7.753 5.818 16.957 9.793 26.959 11.298-2.366 7.433-3.653 15.297-3.653 23.392zm12.607-42.712c-22.041 0-39.972-17.945-39.972-40.002 0-22.042 17.932-39.974 39.972-39.974 9.081 0 17.704 3.009 24.698 8.537 0 .048-.004.095-.004.143 0 15.21 4.736 29.33 12.795 40.984-15.377 6.02-28.352 16.767-37.24 30.308-.084.001-.164.004-.249.004zm186.489 135.379c-26.927 13.645-57.354 21.346-89.548 21.346-32.195 0-62.622-7.704-89.548-21.352v-92.661c0-27.146 19.243-50.866 45.406-56.874 12.218 9.462 27.528 15.114 44.142 15.114s31.925-5.652 44.143-15.115c26.162 6.004 45.405 29.725 45.405 56.874zm7.125-135.386c-8.889-13.533-21.849-24.288-37.222-30.305 8.058-11.654 12.794-25.773 12.794-40.983 0-.051-.004-.101-.004-.153 7.022-5.522 15.645-8.528 24.698-8.528 22.057 0 40.001 17.932 40.001 39.974 0 22.057-17.944 40.002-40.001 40.002-.091 0-.175-.007-.266-.007zm70.229 65.77c-14.934 23.031-34.485 42.804-57.354 57.966v-81.017c0-8.094-1.276-15.961-3.642-23.392 10.005-1.506 19.211-5.481 26.966-11.299 19.668 4.941 34.03 22.961 34.03 43.534zm12.692-193.801c-51.628 0-93.63-41.991-93.63-93.604 0-51.629 42.002-93.633 93.63-93.633s93.63 42.003 93.63 93.633c0 51.613-42.002 93.604-93.63 93.604z"/><path d="m443.489 103.633h-35.125v-35.155c0-5.523-4.477-10-10-10s-10 4.477-10 10v35.155h-35.154c-5.523 0-10 4.477-10 10s4.477 10 10 10h35.154v35.126c0 5.523 4.477 10 10 10s10-4.477 10-10v-35.126h35.125c5.523 0 10-4.477 10-10s-4.477-10-10-10z"/></g></g></svg>

            </div>

            <div class="content flex flex-end">

                <div class="input-field profenda-field flex-grow">

                    <label for="email">Email:</label>
                    <input id="email" name="email" value="">

                </div>

                <div class="input-field profenda-field flex-grow">

                    <label for="role">Role:</label>

                    <select id="role" name="role">

                        <?php foreach( SupplierInvitationPost::ALL_FIELDS['role']['options'] as $value => $label ): ?>

                            <?php

                            $currentUser = new PlatformUser( get_current_user_id() );
                            if( $value === 'shipping_company_admin' && ! $currentUser->isWebsiteAdmin() && ! $currentUser->isShippingCompanyAdmin() ){

                                continue;

                            }

                            ?>

                            <option value="<?php echo $value; ?>">
                                <?php echo $label; ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="input-field profenda-field margin-left-auto no-margin-right">

                    <button type="submit" class="invitationSupplierSend profenda-btn filled" name="refresh_action" value="invitation_supplier_send">
                        Send Invitation
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448 448" style="enable-background:new 0 0 448 448;" xml:space="preserve"><g><g><polygon points="0.213,32 0,181.333 320,224 0,266.667 0.213,416 448,224 "/></g></g></svg>
                    </button>

                </div>

            </div>


        </div>

        <?php

        return ob_get_clean();

    }

}