<?php

namespace ShippingAppointments\Service\Cancelations;

class Cancelations
{

    public function getTotalCancellations(){

    }


    public function getCancellationPaymentButton(){

        ?>

        <button class="profenda-btn" data-product="" name="refresh_action" value="cancel_appointment">
            Cancel Appointment
        </button>

        <?php

    }

}