<?php

namespace ShippingAppointments\Controller\Ajax;

use ShippingAppointments\Interfaces\AjaxInterface;

class AjaxController implements AjaxInterface {

    public function getJSAjaxActions(){

        $actions = array();
        foreach( self::AJAX_ACTIONS as $ajaxAction => $ajaxData ){
            $actions[ $ajaxAction ] = $ajaxAction;
        }

        return $actions;

    }


    public function getBookingTimes(){

        $params = array();
        parse_str( $_POST['data'], $params );


        $result = array(
            'html' => 'test',
            'status' => true
        );

        wp_send_json( $result );
        wp_die();

    }

}
